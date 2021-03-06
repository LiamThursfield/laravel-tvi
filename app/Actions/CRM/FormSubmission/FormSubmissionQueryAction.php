<?php

namespace App\Actions\CRM\FormSubmission;

use App\Actions\AbstractQueryAction;
use App\Models\CRM\FormSubmission;
use Illuminate\Database\Eloquent\Builder;

class FormSubmissionQueryAction extends AbstractQueryAction
{
    protected array $searchable_fields_likes = [
        'form_id' => 'form_id',
    ];

    protected string $order_by          = 'submitted_at';
    protected string $order_direction   = 'desc';


    protected function getQueryBuilder(): Builder
    {
        return FormSubmission::query();
    }
}
