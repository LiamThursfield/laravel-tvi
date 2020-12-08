<?php

namespace App\Http\Requests\Admin\FileManager;

use Illuminate\Foundation\Http\FormRequest;

class FileManagerDirectoryStoreRequest extends FormRequest
{
    public function rules() : array
    {
        return [
            'directory' => 'required',
        ];
    }

}
