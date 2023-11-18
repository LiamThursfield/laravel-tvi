<?php

namespace App\Http\Controllers\Website;

use App\Actions\EDU\Course\CourseQueryAction;
use App\Http\Controllers\Controller;
use App\Http\Resources\Web\EDU\CourseListResource;
use Inertia\Inertia;
use Inertia\Response;

class HomeController extends Controller
{
    /**
     * Show the application homepage.
     *
     * @return Response
     */
    public function index()
    {
        if (!config('sigi.web.enabled')) {
            return redirect(route('admin.index'));
        }

        return Inertia::render('website/home/Index', [
            'courses' => function () {
                $courses = app(CourseQueryAction::class)
                    ->handle([
                        'is_purchasable' => true
                    ])->get();

                CourseListResource::withoutWrapping();

                return CourseListResource::collection($courses);
            },
        ]);
    }
}
