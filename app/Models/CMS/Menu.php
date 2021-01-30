<?php

namespace App\Models\CMS;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $table = 'cms_menus';

    protected $guarded = [];

    protected $casts = [
        'menu_items' => 'json'
    ];

}
