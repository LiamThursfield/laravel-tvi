<?php

namespace App\Http\Controllers\Webhook\Stripe;

use App\Actions\EDU\Purchase\RedeemUserPurchasesAction;
use App\Http\Controllers\Controller;
use App\Interfaces\EDU\Purchase\PurchaseInterface;
use App\Models\EDU\Purchase\Purchase;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Stripe\Event;
use Symfony\Component\Routing\Exception\MethodNotAllowedException;

class StripeCheckoutController extends Controller
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
        $purchase = Purchase::findOrFail($event->data->object->metadata->purchase_id);

        // TODO: Ensure the purchase is not already paid?

        $email = $event->data->object->customer_details->email;
        if (!$email) {
            throw new Exception('Email must be provided.');
        }

        $user = User::where('email', $email)->first();

        $purchase->update(
            [
                'email_address' => $email,
                'user_id' => $user ? $user->id : null,
                'payment_status' => PurchaseInterface::PAYMENT_STATUS_PAID,
                'payment_gateway' => PurchaseInterface::PAYMENT_GATEWAY_STRIPE,
                'payment_gateway_response_id' => $event->id,
                'payment_response' => $event->toArray(),
            ]
        );

        // Redeem the user's purchases if they already exist
        if ($user) {
            app(RedeemUserPurchasesAction::class)->handle($user);
        }

        return response()->json([
            'success' => true,
        ]);
    }
}