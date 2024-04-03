<?php

namespace App\Http\Controllers\Website\EDU;

use App\Http\Controllers\Controller;
use App\Http\Resources\Web\EDU\CourseShowResource;
use App\Models\EDU\Course\Course;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class CourseController extends Controller
{
    public function show(Request $request, Course $course): Response
    {
        if (!$course->is_purchasable) {
            abort(404);
        }

        return Inertia::render('website/edu/course/Show', [
            'course' => function () use ($course) {
                $course->load([
                    'instalmentPlans',
                    'sections',
                    'creator'
                ]);

                CourseShowResource::withoutWrapping();
                return CourseShowResource::make($course);
            }
        ]);
    }
}
