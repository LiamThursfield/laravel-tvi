<?php

namespace App\Http\Controllers\Api\EDU;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\EDU\CourseCheckoutRequest;
use App\Models\EDU\Course\Course;
use App\Models\EDU\Course\CourseInstalmentPlan;
use App\Traits\EDU\Course\CreatesCheckoutSessionForCourse;
use Illuminate\Http\JsonResponse;

class CourseCheckoutController extends Controller
{
    use CreatesCheckoutSessionForCourse;

    public function __invoke(CourseCheckoutRequest $request, Course $course)
    {
        if (!$course->is_purchasable) {
            abort(429);
        }

        $instalment_plan_id = $request->get('instalment_plan_id');
        if ($instalment_plan_id) {
            /** @var CourseInstalmentPlan $instalment_plan */
            $instalment_plan = $course->instalmentPlans()->where('id', $instalment_plan_id)->firstOrFail();
            $checkout_session = $this->buildCourseCheckoutSessionForInstalmentPlan($course, $instalment_plan);
        } else {
            $checkout_session = $this->buildCourseCheckoutSessionForPayInFull($course);
        }

        return new JsonResponse([
            'id' => $checkout_session->id,
            'url' => $checkout_session->url,
        ]);
    }
}
