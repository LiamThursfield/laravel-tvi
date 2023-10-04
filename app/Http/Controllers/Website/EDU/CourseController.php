<?php

namespace App\Http\Controllers\Website\EDU;

use App\Http\Controllers\Controller;
use App\Models\EDU\Course\Course;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class CourseController extends Controller
{
    // TODO: Once courses are implemented, bolster this out
    public function show(Request $request, Course $course): Response
    {

        return Inertia::render('website/edu/course/Show', [
            'course' => [
                'id' => $course->id,
                'name' => $course->name,
                'description' => 'lorem ipsum dolor sit amet consectetur adipiscing elit sed do eiusmod tempor incididunt ut labore et dolore magna aliqua ut enim ad minim veniam quis nostrud exercitation ullamco.',
                'price' => 2000,
                'images' => ['https://i.imgur.com/EHyR2nP.png'],
                'is_standalone' => true,

                'programmes' => [
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
