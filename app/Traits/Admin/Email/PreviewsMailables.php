<?php

namespace App\Traits\Admin\Email;

use App\Mail\EDU\Course\CoursePurchasePaymentDue;
use App\Mail\EDU\Course\CoursePurchaseRegister;
use App\Models\EDU\Course\Course;
use App\Models\EDU\Course\CoursePurchase;
use App\Models\EDU\Course\CoursePurchasePayment;
use App\Models\User;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;

trait PreviewsMailables
{
    private array $mailable_map = [
        'edu-course-purchase-payment-due' => [
            'mailable' => 'getCoursePurchasePaymentDueMailable',
            'module' => 'EDU',
            'name' => 'Course Purchase Payment Due',
        ],
        'edu-course-purchase-register' => [
            'mailable' => 'getCoursePurchaseRegisterMailable',
            'module' => 'EDU',
            'name' => 'Course Register',
        ],
    ];

    protected function getMailablePreviewUrls(): Collection
    {
        return collect($this->mailable_map)->mapWithKeys(function (array $mailable, string $id) {
            return [
                $id => [
                    'module' => $mailable['module'],
                    'name' => $mailable['name'],
                    'url' => route('admin.email.preview.show', $id)
                ]
            ];
        })->groupBy('module', preserveKeys: true);
    }

    protected function getMailable(string $mailable_id): ?Mailable
    {
        $mailable = Arr::get($this->mailable_map, $mailable_id . '.mailable');

        if (!$mailable) {
            return null;
        }

        return $this->$mailable();
    }

    protected function getCoursePurchasePaymentDueMailable(): Mailable
    {
        // Create a payment - ensuring no data is persisted in the DB
        $payment = CoursePurchasePayment::factory()->make([
            'id' => 0,
            'course_purchase_id' => null,
            'created_at' => now(),
        ])->setRelation(
            'purchase',
            CoursePurchase::factory()->make([
                'course_id' => null,
                'user_id' => null
            ])->setRelations([
                'course' => Course::factory()->make(),
                'user' => User::factory()->make(),
            ])
        );

        return new CoursePurchasePaymentDue($payment);
    }

    protected function getCoursePurchaseRegisterMailable(): Mailable
    {
        // Create a payment - ensuring no data is persisted in the DB
        $payment = CoursePurchasePayment::factory()->make([
            'id' => 0,
            'course_purchase_id' => null,
            'created_at' => now(),
        ])->setRelation(
            'purchase',
            CoursePurchase::factory()->make([
                'course_id' => null,
                'user_id' => null
            ])->setRelations([
                'course' => Course::factory()->make(),
                'user' => User::factory()->make(),
            ])
        );

        return new CoursePurchaseRegister($payment);
    }
}
