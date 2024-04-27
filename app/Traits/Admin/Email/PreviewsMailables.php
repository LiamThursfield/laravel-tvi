<?php

namespace App\Traits\Admin\Email;

use App\Mail\CRM\Form\FormSubmittedInternal;
use App\Mail\EDU\Course\CoursePurchasePaymentDue;
use App\Mail\EDU\Course\CoursePurchaseRegister;
use App\Models\CRM\Form;
use App\Models\CRM\FormSubmission;
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

    protected function getMailableMap(): array
    {
        $map = $this->mailable_map;

        // Add any CRM forms -- NOTE: must have actual submissions for now
        Form::has('formSubmissions')->each(function (Form $form) use (&$map) {
            $map["crm-form-submitted-internal-{$form->id}"] = [
                'mailable' => 'getFormSubmittedInternal',
                'mailableParams' => ['form_id' => $form->id],
                'module' => 'CRM',
                'name' => "Form Submitted Internal: {$form->name}",
            ];
        });

        return $map;
    }

    protected function getMailablePreviewUrls(): Collection
    {
        return collect($this->getMailableMap())->mapWithKeys(function (array $mailable, string $id) {
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
        $mailable_map = $this->getMailableMap();
        $mailable = Arr::get($mailable_map, $mailable_id . '.mailable');
        $params = Arr::get($mailable_map, $mailable_id . '.mailableParams', []);

        if (!$mailable) {
            return null;
        }

        return $this->$mailable($params);
    }

    protected function getFormSubmittedInternal(array $params): Mailable
    {
        return new FormSubmittedInternal(
            FormSubmission::where('form_id', Arr::get($params, 'form_id'))->firstOrFail()
        );
    }

    protected function getCoursePurchasePaymentDueMailable(array $params): Mailable
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

    protected function getCoursePurchaseRegisterMailable(array $params): Mailable
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
