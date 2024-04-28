<?php

namespace App\Http\Controllers\AdminApi\Settings;

use App\Actions\Setting\MailerSettingTestAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\AdminApi\Setting\MailerSettingTestRequest;
use App\Interfaces\PermissionInterface;

class MailerTestController extends Controller
{
    public function __construct()
    {
        $this->middleware(
            PermissionInterface::getMiddlewareString(PermissionInterface::EDIT_SETTINGS)
        );
    }

    public function __invoke(MailerSettingTestRequest $request)
    {
        app(MailerSettingTestAction::class)->handle($request);
        return response()->json([
            'message' => 'Test email sent.'
        ]);
    }
}
