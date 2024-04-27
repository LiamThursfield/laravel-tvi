<?php

namespace App\Actions\Setting;

use App\Http\Requests\AdminApi\Setting\MailerSettingTestRequest;
use App\Mail\Setting\MailerTest;
use App\Traits\Base\ManagesTenancyMailer;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Mail;

class MailerSettingTestAction
{
    use ManagesTenancyMailer;

    public function handle(MailerSettingTestRequest $request): void
    {
        $mailerSettings = Arr::except($request->validated(), 'recipient');

        $this->setMailConfigForTenant(tenant(), $mailerSettings);

        Mail::to($request->get('recipient'))
            ->send(new MailerTest($mailerSettings));

        $this->setMailConfigDefaults();
    }
}
