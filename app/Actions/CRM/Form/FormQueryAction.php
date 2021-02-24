<?php

namespace App\Actions\CRM\Form;

use App\Actions\AbstractQueryAction;
use App\Models\CRM\Form;
use Illuminate\Database\Eloquent\Builder;

class FormQueryAction extends AbstractQueryAction
{
    protected array $searchable_fields_likes = [
        'name' => 'template_name',
        'slug' => 'template_slug',
    ];

    protected string $order_by = 'name';


    protected function getQueryBuilder(): Builder
    {
        return Form::query();
    }
}
