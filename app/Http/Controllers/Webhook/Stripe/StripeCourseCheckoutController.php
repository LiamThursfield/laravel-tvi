<?php

namespace App\Http\Controllers\Webhook\Stripe;

use App\Actions\EDU\Course\Purchase\RedeemUserCoursePurchasesAction;
use App\Http\Controllers\Controller;
use App\Interfaces\EDU\Course\CoursePurchaseInterface;
use App\Jobs\EDU\Course\ProcessCoursePurchaseRegister;
use App\Models\EDU\Course\CoursePurchasePayment;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Stripe\Event;
use Symfony\Component\Routing\Exception\MethodNotAllowedException;

class StripeCourseCheckoutController extends Controller
{
    public function __invoke(Request $request)
    {
        $event = Event::constructFrom(
            $request->toArray()
        );

        switch ($event->type) {
            case Event::CHECKOUT_SESSION_COMPLETED:
                return $this->handleSessionCompleted($event);
            default:
                throw new MethodNotAllowedException(
                    [Event::CHECKOUT_SESSION_COMPLETED],
                    'Invalid event type: ' . $event->type
                );
        }
    }

    protected function handleSessionCompleted(Event $event)
    {
        /** @var CoursePurchasePayment $payment */
        $payment = CoursePurchasePayment::findOrFail($event->data->object->metadata->payment_id);

        if (in_array($payment->status, [CoursePurchaseInterface::PAYMENT_STATUS_PAID, CoursePurchaseInterface::PAYMENT_STATUS_REFUNDED])) {
            throw new Exception("Payment has already been paid/refunded", 422);
        }

        $email = $event->data->object->customer_details->email;
        if (!$email) {
            throw new Exception('Email must be provided.', 400);
        }

        $user = User::where('email', $email)->first();

        // TODO: Consider moving to an action at some point
        DB::beginTransaction();
        $payment->update(
            [
                'paid_at' => now(),
                'payment_gateway_response' => $event->toArray(),
                'payment_gateway_response_id' => $event->id,
                'status' => CoursePurchaseInterface::PAYMENT_STATUS_PAID,
            ]
        );


        $purchase = $payment->purchase;
        if (!$purchase) {
            throw new Exception('Unable to find purchase for payment '.$payment->id, 400);
        }

        $purchase->email_address = $email;
        $purchase->payment_gateway = CoursePurchaseInterface::PAYMENT_GATEWAY_STRIPE;
        $purchase->total_price_paid = (int)$purchase->total_price_paid + (int)$payment->price;
        $purchase->user_id = $user->id ?? null;

        // If all payments have been made - update the purchase status/paid date
        if ((int)$purchase->total_price_outstanding === 0) {
            $purchase->status = CoursePurchaseInterface::PAYMENT_STATUS_PAID;
            $purchase->full_price_paid_at = now();
        }

        $purchase->update();

        // Redeem the user's purchases if they already exist
        if ($user) {
            app(RedeemUserCoursePurchasesAction::class)->handle($user);
        } else {
            // Send email to customer to register an account
            dispatch(new ProcessCoursePurchaseRegister($payment));
        }

        DB::commit();

        return response()->json([
            'success' => true,
        ]);
    }
}
