<?php

namespace App\Http\Requests\Admin\CMS\Page;

use App\Interfaces\CMS\CMSInterface;
use App\Models\CMS\Page;
use Illuminate\Validation\Rule;

class PageUpdateRequest extends PageStoreRequest
{
    public function attributes() : array
    {
       $attributes = parent::attributes();

       $attributes['url.id'] = 'URL ID';

       return $attributes;
    }

    public function rules() : array
    {
        $rules = parent::rules();

        $rules['id'] = [
            'required',
            'integer',
            Rule::exists('cms_pages', 'id'),
        ];

        $rules['slug'] = [
            'required',
            'string',
            'max:' . CMSInterface::FIELD_SLUG_MAX_LENGTH,
            Rule::unique('cms_pages')->ignore($this->page->id, 'id')
        ];

        $rules['url.id'] = [
            'required',
            'integer',
            Rule::exists('cms_urls', 'id')->where(function ($query) {
                $query->where('urlable_type', Page::class)
                    ->where('urlable_id', '=', $this->request->get('id'));
            }),
        ];

        return $rules;
    }
}
