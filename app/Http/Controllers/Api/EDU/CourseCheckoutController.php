<?php

namespace App\Http\Controllers\Api\EDU;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\EDU\CourseCheckoutRequest;
use App\Models\Settings\EduSettings;
use App\Models\Settings\ThirdPartySettings;
use Illuminate\Http\JsonResponse;
use Stripe\Checkout\Session;
use Stripe\Stripe;

class CourseCheckoutController extends Controller
{
    protected EduSettings $eduSettings;

    protected ThirdPartySettings $thirdPartySettings;

    public function __construct(
        EduSettings $eduSettings,
        ThirdPartySettings $thirdPartySettings
    ) {
        $this->eduSettings = $eduSettings;
        $this->thirdPartySettings = $thirdPartySettings;
    }

    public function __invoke(CourseCheckoutRequest $request, $course)
    {
        Stripe::setApiKey($this->thirdPartySettings->stripe_secret_key);

        // TODO: Once Courses are implemented, bolster this out
        $line_items = [
            [
                'price_data' => [
                    'product_data' => [
                        'name' => 'Test Course: ' . $course,
                        'images' => [
                            'https://i.imgur.com/EHyR2nP.png',
                            'https://i.imgur.com/EHyR2nP.png',
                            'https://i.imgur.com/EHyR2nP.png',
                        ],
                        'metadata' => [
                            'course_id' => $course,
                        ],
                    ],
                    'currency' => 'gbp',
                    'unit_amount' => 2000,
                ],
                'quantity' => 1,
            ],
        ];

        $checkout_session = Session::create([
            'client_reference_id' => 'customer_test_customer',
            'line_items' => $line_items,
            'mode' => 'payment',

            'success_url' => $this->eduSettings->formatCourseUrl(
                $this->eduSettings->course_checkout_success_url,
                $course,
                route('website.edu.courses.show', ['course' => $course]) . '?checkout=success'
            ),
            'cancel_url' => $this->eduSettings->formatCourseUrl(
                $this->eduSettings->course_checkout_cancel_url,
                $course,
                route('website.edu.courses.show', ['course' => $course]) . '?checkout=cancel'
            ),
        ]);

        // TODO: Save sessions?

        return new JsonResponse([
            'id' => $checkout_session->id,
            'url' => $checkout_session->url,
        ]);
    }
}
