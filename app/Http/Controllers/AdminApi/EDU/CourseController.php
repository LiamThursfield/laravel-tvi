<?php

namespace App\Http\Controllers\AdminApi\EDU;

use App\Actions\EDU\Course\CourseQueryAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\EDU\Course\CourseIndexRequest;
use App\Http\Resources\Web\EDU\CourseListResource;
use App\Interfaces\PermissionInterface;
use Illuminate\Http\Resources\Json\ResourceCollection;

class CourseController extends Controller
{
    public function __construct()
    {
        $this->middleware(
            PermissionInterface::getMiddlewareString(PermissionInterface::VIEW_EDU_COURSES)
        )->only('show');
    }

    public function index(CourseIndexRequest $request) : ResourceCollection
    {
        return CourseListResource::collection(
            app(CourseQueryAction::class)->handle($request->validated())->get()
        );
    }
}
