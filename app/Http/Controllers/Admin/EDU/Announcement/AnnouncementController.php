<?php

namespace App\Http\Controllers\Admin\EDU\Announcement;

use App\Actions\EDU\Announcement\AnnouncementPublishAction;
use App\Actions\EDU\Announcement\AnnouncementQueryAction;
use App\Actions\EDU\Announcement\AnnouncementStoreAction;
use App\Actions\EDU\Announcement\AnnouncementUpdateAction;
use App\Http\Controllers\AdminController;
use App\Http\Requests\Admin\EDU\Announcement\AnnouncementIndexRequest;
use App\Http\Requests\Admin\EDU\Announcement\AnnouncementStoreRequest;
use App\Http\Requests\Admin\EDU\Announcement\AnnouncementUpdateRequest;
use App\Http\Resources\Admin\EDU\Announcement\AnnouncementResource;
use App\Interfaces\AppInterface;
use App\Interfaces\PermissionInterface;
use App\Models\EDU\Announcement\Announcement;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;

class AnnouncementController extends AdminController
{

    public function __construct()
    {
        parent::__construct();
        $this->addMetaTitleSection('EDU');
        $this->addMetaTitleSection('Announcements');

        $this->middleware(
            PermissionInterface::getMiddlewareString(PermissionInterface::CREATE_EDU_ANNOUNCEMENTS)
        )->only(['create', 'store']);

        $this->middleware(
            PermissionInterface::getMiddlewareString(PermissionInterface::DELETE_EDU_ANNOUNCEMENTS)
        )->only('destroy');

        $this->middleware(
            PermissionInterface::getMiddlewareString(PermissionInterface::EDIT_EDU_ANNOUNCEMENTS)
        )->only(['edit', 'update']);

        $this->middleware(
            PermissionInterface::getMiddlewareString(PermissionInterface::VIEW_EDU_ANNOUNCEMENTS)
        )->only('index');

        $this->middleware(
            PermissionInterface::getMiddlewareString(PermissionInterface::PUBLISH_EDU_ANNOUNCEMENTS)
        )->only('publish');
    }

    public function create() : Response
    {
        $this->addMetaTitleSection('Create')->shareMeta();

        return Inertia::render('admin/edu/announcement/Create') ;
    }

    public function destroy(Announcement $announcement) : RedirectResponse
    {
        $announcement->delete();

        return Redirect::back(303)->with(
            'success',
            'Deleted.'
        );
    }

    public function edit(Announcement $announcement) : Response
    {
        $this->addMetaTitleSection('Edit - ' . $announcement->title)->shareMeta();

        return Inertia::render('admin/edu/announcement/Edit', [
            'announcement' => function () use ($announcement) {
                AnnouncementResource::withoutWrapping();
                return AnnouncementResource::make($announcement);
            }
        ]);
    }

    public function index(AnnouncementIndexRequest $request) : Response
    {
        $search_options = $request->validated();

        $this->shareMeta();

        return Inertia::render('admin/edu/announcement/Index', [
            'announcements' => function () use ($search_options) {
                return app(AnnouncementQueryAction::class)
                    ->handle($search_options)
                    ->with('creator')
                    ->paginate(AppInterface::getSearchPaginationParam($search_options));
            },
            'searchOptions' => $search_options
        ]);
    }

    public function store(AnnouncementStoreRequest $request) : RedirectResponse
    {
        $announcement = app(AnnouncementStoreAction::class)->handle($request->validated());

        return Redirect::to(route('admin.edu.announcements.edit', $announcement))
            ->with('success', 'Created');
    }

    public function update(AnnouncementUpdateRequest $request, Announcement $announcement) : RedirectResponse
    {
        $announcement = app(AnnouncementUpdateAction::class)->handle($announcement, $request->validated());

        return Redirect::to(route('admin.edu.announcements.edit', $announcement))
            ->with('success', 'Updated');
    }

    public function publish(Announcement $announcement): RedirectResponse
    {
        app(AnnouncementPublishAction::class)->handle($announcement);

        return Redirect::back(303)->with(
            'success',
            'Published.'
        );
    }
}
