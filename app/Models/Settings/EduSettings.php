<?php

namespace App\Models\Settings;

use Spatie\LaravelSettings\Settings;

class EduSettings extends Settings
{
    public ?string $course_checkout_success_url;

    public ?string $course_checkout_cancel_url;


    public static function group(): string
    {
        return 'edu';
    }

    public function formatCourseUrl(?string $url, $course, $default = null): string
    {
        if (!$url) {
            return $default;
        }

        // $slug = $course->slug; // TODO: Once courses are implemented
        $slug = $course;
        return str_replace('#slug#', $slug, $url);
    }
}