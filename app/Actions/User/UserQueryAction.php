<?php

namespace App\Actions\User;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Arr;

class UserQueryAction
{
    protected string $order_by          = 'name';
    protected string $order_direction   = 'asc';

    /**
     * @param array $search_options
     * @return Builder
     */
    public function handle(array $search_options = []) {
        $query = User::query();


        $searchable_fields = [
            'email'         => 'user_email',
            'first_name'    => 'user_first_name',
            'last_name'     => 'user_last_name',
        ];

        foreach ($searchable_fields as $field => $search_option) {
            if (Arr::get($search_options, $search_option)) {
                $query->where(
                    $field,
                    'like',
                    '%' . Arr::get($search_options, $search_option) . '%'
                );
            }
        }


        $order_by = Arr::get($search_options, 'order_by', $this->order_by);
        $order_direction = Arr::get($search_options, 'order_direction', $this->order_direction);
        if ($order_by === 'name') {
            $query->orderBy('first_name', $order_direction);
            $query->orderBy('last_name', $order_direction);
        } else {
            $query->orderBy($order_by, $order_direction);
        }

        return $query;
    }
}
