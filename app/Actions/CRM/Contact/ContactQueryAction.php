<?php

namespace App\Actions\CRM\Contact;

use App\Actions\AbstractQueryAction;
use App\Models\CRM\Contact;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Arr;

class ContactQueryAction extends AbstractQueryAction
{
    protected array $searchable_fields_likes = [
        'email'         => 'contact_email',
        'first_name'    => 'contact_first_name',
        'last_name'     => 'contact_last_name',
        'telephone'     => 'contact_telephone',
    ];

    protected string $order_by = 'name';


    protected function addOrderOptions()
    {
        $order_by = Arr::get($this->search_options, 'order_by', $this->order_by);
        $order_direction = Arr::get($this->search_options, 'order_direction', $this->order_direction);

        if ($order_by === 'name') {
            $this->query->orderBy('first_name', $order_direction);
            $this->query->orderBy('last_name', $order_direction);
        } else {
            $this->query->orderBy($order_by, $order_direction);
        }
    }

    protected function getQueryBuilder(): Builder
    {
        return Contact::query();
    }
}
