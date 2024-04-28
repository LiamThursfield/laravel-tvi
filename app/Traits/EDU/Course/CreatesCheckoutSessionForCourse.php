<?php

namespace App\Traits\EDU\Course;

use App\Interfaces\EDU\Course\CoursePurchaseInterface;
use App\Models\EDU\Course\Course;
use App\Models\EDU\Course\CourseInstalmentPlan;
use App\Models\EDU\Course\CoursePurchase;
use App\Models\EDU\Course\CoursePurchasePayment;
use App\Models\Settings\EduSettings;
use App\Models\Settings\ThirdPartySettings;
use Exception;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\App;
use Stripe\Checkout\Session;
use Stripe\Stripe;

trait  CreatesCheckoutSessionForCourse
{
    protected function buildCourseCheckoutSessionForInstalmentPlan(Course $course, CourseInstalmentPlan $courseInstalmentPlan): Session
    {
        $this->setStripeKey();
        $purchase = $this->initialisePurchase($course, $courseInstalmentPlan);
        $payments = $this->initialiseInstalmentPlanPurchasePayments($purchase, $courseInstalmentPlan);

        return $this->buildCourseCheckoutSession($course, $purchase, $payments->first());
    }

    protected function buildCourseCheckoutSessionForPayInFull(Course $course): Session
    {
        $this->setStripeKey();
        $purchase = $this->initialisePurchase($course);
        $payment = $this->initialisePayInFullPurchasePayments($purchase);

        return $this->buildCourseCheckoutSession($course, $purchase, $payment);
    }

    protected function buildCourseCheckoutSessionForPayment(CoursePurchasePayment $payment): Session
    {
        $this->setStripeKey();

        $purchase = $payment->purchase;
        if (!$purchase) {
            throw new Exception('Payment belongs to an invalid purchase.');
        }

        $course = $purchase->course;
        if (!$course) {
            throw new Exception('Payment belongs to an invalid course.');
        }

        return $this->buildCourseCheckoutSession($course, $purchase, $payment);
    }

    protected function setStripeKey(): void
    {
        Stripe::setApiKey(app()->make(ThirdPartySettings::class)->stripe_secret_key);
    }

    protected function initialisePurchase(Course $course, CourseInstalmentPlan|null $courseInstalmentPlan = null): CoursePurchase
    {
        $purchase = new CoursePurchase([
            'course_id' => $course->id,
            'currency' => $course->currency,
            'email_address' => auth()->user()->email ?? null,
            'instalment_plan_id' => $courseInstalmentPlan?->id,
            'payment_gateway' => CoursePurchaseInterface::PAYMENT_GATEWAY_STRIPE,
            'status' => CoursePurchaseInterface::PAYMENT_STATUS_PENDING,
            'total_price_due' => $course->current_price,
            'type' => $courseInstalmentPlan ? CoursePurchaseInterface::PURCHASE_TYPE_INSTALMENTS : CoursePurchaseInterface::PURCHASE_TYPE_FULL,
            'user_id' => auth()->user() ?? null,
        ]);

        $purchase->save();

        return $purchase;
    }

    protected function initialiseInstalmentPlanPurchasePayments(CoursePurchase $purchase, CourseInstalmentPlan|null $courseInstalmentPlan): Collection
    {
        $payments = collect();

        $due_date = now();
        for ($i = 0; $i < $courseInstalmentPlan->instalment_count; $i++) {
            $payment = new CoursePurchasePayment([
                'course_purchase_id' => $purchase->id,
                'status' => CoursePurchaseInterface::PAYMENT_NOT_DUE,
                'price' => $courseInstalmentPlan->instalment_current_price,
                'currency' => $courseInstalmentPlan->currency,
                'due_date' => $due_date,
            ]);

            if ($i === 0) {
                $payment['status'] = CoursePurchaseInterface::PAYMENT_STATUS_PENDING;
            }

            $payment->save();
            $payments->push($payment);

            // Currently only monthly payments are supported, so increase the date by a month for the next payment
            $due_date->addMonth();
        }

        return $payments;
    }

    protected function initialisePayInFullPurchasePayments(CoursePurchase $purchase): CoursePurchasePayment
    {
        $payment = new CoursePurchasePayment([
            'course_purchase_id' => $purchase->id,
            'status' => CoursePurchaseInterface::PAYMENT_STATUS_PENDING,
            'price' => $purchase->total_price_due,
            'currency' => $purchase->currency,
            'due_date' => now(),
        ]);

        $payment->save();

        return $payment;
    }

    protected function buildCourseCheckoutSession(Course $course, CoursePurchase $purchase, CoursePurchasePayment $payment): Session
    {
        $eduSettings = app()->make(EduSettings::class);

        return Session::create([
            'client_reference_id' => $payment->id,
            'metadata' => [
                'course_id' => $course->id,
                'due_date' => $payment->due_date,
                'instalment_plan_id' => $purchase->instalment_plan_id,
                'payment_id' => $payment->id,
                'purchase_id' => $purchase->id,
            ],
            'mode' => 'payment',
            'line_items' => [
                [
                    'price_data' => [
                        'product_data' => [
                            'name' => $course->name,
                            'images' => array_filter([
                                $course->primary_image,
                                $course->banner
                            ]),
                            'metadata' => [
                                'course_id' => $course->id,
                            ],
                        ],
                        'currency' => $payment->currency,
                        'unit_amount' => $payment->price,
                    ],
                    'quantity' => 1,
                ],
            ],
            'success_url' => $eduSettings->formatCourseUrl(
                $eduSettings->course_checkout_success_url,
                $course,
                route('website.edu.courses.show', ['course' => $course]) . '?checkout=success'
            ),
            'cancel_url' => $eduSettings->formatCourseUrl(
                $eduSettings->course_checkout_cancel_url,
                $course,
                route('website.edu.courses.show', ['course' => $course]) . '?checkout=cancel'
            ),
            'locale' => App::getLocale(),
        ]);
    }
}
