<?php

namespace App\Http\Requests\Admin\CMS\Page;

use App\Http\Requests\BaseRequest;
use App\Interfaces\CMS\CMSInterface;
use App\Interfaces\CMS\TemplateInterface;
use Illuminate\Validation\Rule;

class PageStoreRequest extends BaseRequest
{
    public function attributes() : array
    {
        $custom_attributes = [
            'content.*.template_field_id'   => 'template field',
            'template_id'                   => 'template',
            'metadata.canonical'            => 'canonical',
            'metadata.description'          => 'meta description',
            'metadata.og_description'       => 'og description ',
            'metadata.og_image'             => 'og image',
            'metadata.og_title'             => 'og title',
            'metadata.og_type'              => 'og type',
            'metadata.og_url'               => 'og url',
            'metadata.title'                => 'meta title',
            'url.expired_at'                => 'expired at',
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
            'layout_id' => [
                'required',
                'integer',
                Rule::exists('cms_layouts', 'id'),
            ],
            'metadata.canonical'        => 'nullable|string',
            'metadata.description'      => 'nullable|string',
            'metadata.og_description'   => 'nullable|string',
            'metadata.og_image'         => 'nullable|string',
            'metadata.og_title'         => 'nullable|string',
            'metadata.og_type'          => 'nullable|string',
            'metadata.og_url'           => 'nullable|string',
            'metadata.title'            => 'nullable|string',
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
            'slug' => [
                'required',
                'string',
                'max:' . CMSInterface::FIELD_SLUG_MAX_LENGTH,
                'unique:cms_pages'
            ],
            'template_id' => [
                'required',
                'integer',
                Rule::exists('cms_templates', 'id')->where(function ($query) {
                    $query->where('type', TemplateInterface::TYPE_PAGE);
                }),
            ],
            'url.expired_at'    => 'nullable|date',
            'url.is_enabled'    => 'required|boolean',
            'url.published_at'  => 'nullable|date',
            'url.url_main'      => 'required|string',
        ];
    }
}
