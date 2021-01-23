<?php

namespace App\Http\Requests\Admin\CMS\Page;

use App\Http\Requests\BaseRequest;
use App\Interfaces\CMS\CMSInterface;
use App\Interfaces\CMS\TemplateInterface;
use App\Models\CMS\Page;
use Illuminate\Validation\Rule;

class PageUpdateRequest extends BaseRequest
{
    public function attributes() : array
    {
        $custom_attributes = [
            'content.*.template_field_id'   => 'template field',
            'template_id'                   => 'template',
            'url.expired_at'                => 'expired at',
            'url.id'                        => 'URL ID',
            'url.is_enabled'                => 'is enabled',
            'url.published_at'              => 'published at',
            'url.url_main'                  => 'URL',
        ];

        return array_merge(parent::attributes(), $custom_attributes);
    }

    public function rules() : array
    {
        return [
            'content.*.data'                => 'nullable',
            'content.*.template_field_id'   => [
                'required',
                'integer',
                Rule::exists('cms_template_fields', 'id')->where(function ($query) {
                    return $query->where('template_id', $this->request->get('template_id'));
                }),
            ],
            'id' => [
                'required',
                'integer',
                Rule::exists('cms_pages', 'id'),
            ],
            'layout_id' => [
                'required',
                'integer',
                Rule::exists('cms_layouts', 'id'),
            ],
            'name' => [
                'required',
                'string',
                'max:' . CMSInterface::FIELD_NAME_MAX_LENGTH,
            ],
            'parent_id' => [
                'nullable',
                'integer',
                Rule::exists('cms_pages', 'id'),
            ],
            'template_id' => [
                'required',
                'integer',
                Rule::exists('cms_templates', 'id')->where(function ($query) {
                    $query->where('type', TemplateInterface::TYPE_PAGE);
                }),
            ],
            'slug' => [
                'required',
                'string',
                'max:' . CMSInterface::FIELD_SLUG_MAX_LENGTH,
                Rule::unique('cms_pages')->ignore($this->page->id, 'id')
            ],
            'url.expired_at'    => 'nullable|date',
            'url.id'            => [
                'required',
                'integer',
                Rule::exists('cms_urls', 'id')->where(function ($query) {
                    $query->where('urlable_type', Page::class)
                        ->where('urlable_id', '=', $this->request->get('id'));
                }),
            ],
            'url.is_enabled'    => 'required|boolean',
            'url.published_at'  => 'nullable|date',
            'url.url_main'      => 'required|string',
        ];
    }
}
