<?php

namespace App\Http\Controllers\Website\EDU;

use App\Actions\CMS\Page\PageQueryAction;
use App\Http\Controllers\Controller;
use App\Http\Resources\Web\CMS\FullPageResource;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class CourseController extends Controller
{
    // TODO: Once courses are implemented, bolster this out
    public function show(Request $request, $course): Response
    {
        return Inertia::render('website/edu/course/Show', [
            'course' => [
                'id' => $course,
                'name' => 'Test Course: ' . $course,
                'description' => 'This is a test course',
                'price' => 2000,
                'images' => ['https://i.imgur.com/EHyR2nP.png'],
                'is_standalone' => true,

                'programs' => [
                    [
                        'id' => 1,
                        'name' => 'Test Program 1',
                        'description' => 'This is a test program',
                    ]
                ]
            ]
        ]);
    }
}
