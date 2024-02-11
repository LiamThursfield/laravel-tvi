<?php

namespace App\Http\Controllers\Admin;

use App\Actions\Setting\SettingUpdateAction;
use App\Http\Controllers\AdminController;
use App\Http\Requests\Admin\Setting\CoreSettingsUpdateRequest;
use App\Http\Requests\Admin\Setting\EduSettingsUpdateRequest;
use App\Http\Requests\Admin\Setting\ThirdPartySettingsUpdateRequest;
use App\Http\Resources\Admin\Setting\CoreSettingEditResource;
use App\Http\Resources\Admin\Setting\EduSettingEditResource;
use App\Http\Resources\Admin\Setting\ThirdPartySettingEditResource;
use App\Interfaces\PermissionInterface;
use App\Models\Settings\CoreSettings;
use App\Models\Settings\EduSettings;
use App\Models\Settings\ThirdPartySettings;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
use Inertia\Inertia;
use Inertia\Response;

class SettingController extends AdminController
{

    public function __construct()
    {
        parent::__construct();
        $this->addMetaTitleSection('Settings');

        $this->middleware(
            PermissionInterface::getMiddlewareString(PermissionInterface::VIEW_SETTINGS)
        )->only('show');

        $this->middleware(
            PermissionInterface::getMiddlewareString(PermissionInterface::EDIT_SETTINGS)
        )->only('edit', 'update');
    }


    public function edit(string $group) : Response
    {
        $settingsClass = $this->getSettingClass($group);
        $settingsName = Str::ucfirst(
            Str::replace('-', ' ', $group)
        );

        $this->addMetaTitleSection('Edit - ' . $settingsName)->shareMeta();
        return Inertia::render('admin/setting/Edit', [
            'settings' => function () use ($settingsClass) {
                return $this->getSettingResource($settingsClass);
            },
            'settingsGroup' => $group,
            'settingsName' => $settingsName,
        ]);
    }


    public function update(Request $request, string $group): RedirectResponse
    {
        $data = app($this->getSettingUpdateRequestClass($group))->validated();
        app(SettingUpdateAction::class)->handle($group, $data);

        return Redirect::to(route('admin.settings.edit', $group))
            ->with('success', 'Settings updated.');
    }


    protected function getSettingClass(string $group): string
    {
        switch ($group) {
            case 'core':
                return CoreSettings::class;
            case 'edu':
                return EduSettings::class;
            case 'third-party':
                return ThirdPartySettings::class;
            default:
                abort(404);
        }
    }

    protected function getSettingResource(string $settingClass): JsonResource
    {
        switch ($settingClass) {
            case CoreSettings::class:
                CoreSettingEditResource::withoutWrapping();
                return CoreSettingEditResource::make(
                    app(CoreSettings::class)
                );
            case EduSettings::class:
                EduSettingEditResource::withoutWrapping();
                return EduSettingEditResource::make(
                    app(EduSettings::class)
                );
            case ThirdPartySettings::class:
                ThirdPartySettingEditResource::withoutWrapping();
                return ThirdPartySettingEditResource::make(
                    app(ThirdPartySettings::class)
                );
            default:
                abort(404);
        }
    }

    protected function getSettingUpdateRequestClass(string $group): string
    {
        switch ($group) {
            case 'core':
                return CoreSettingsUpdateRequest::class;
            case 'edu':
                return EduSettingsUpdateRequest::class;
            case 'third-party':
                return ThirdPartySettingsUpdateRequest::class;
            default:
                abort(404);
        }
    }
}
