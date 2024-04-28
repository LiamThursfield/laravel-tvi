<?php

namespace App\Http\Requests\AdminApi\Setting;

use App\Http\Requests\BaseRequest;
use App\Interfaces\ThirdPartyInterface;
use Illuminate\Validation\Rule;

class MailerSettingTestRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'recipient' => 'required|email',
            'mailer' => [
                'required',
                Rule::in(array_keys(ThirdPartyInterface::ALL_MAILERS_LABELLED))
            ],
            ThirdPartyInterface::MAILER_CONFIG_ENCRYPTION       => 'sometimes|nullable|string',
            ThirdPartyInterface::MAILER_CONFIG_FROM_ADDRESS     => 'sometimes|nullable|string',
            ThirdPartyInterface::MAILER_CONFIG_FROM_NAME        => 'sometimes|nullable|string',
            ThirdPartyInterface::MAILER_CONFIG_HOST             => 'sometimes|nullable|string',
            ThirdPartyInterface::MAILER_CONFIG_USERNAME         => 'sometimes|nullable|string',
            ThirdPartyInterface::MAILER_CONFIG_PASSWORD         => 'sometimes|nullable|string',
            ThirdPartyInterface::MAILER_CONFIG_PORT             => 'sometimes|nullable|numeric',
            ThirdPartyInterface::MAILER_CONFIG_SERVICE_DOMAIN   => 'sometimes|nullable|string',
            ThirdPartyInterface::MAILER_CONFIG_SERVICE_ENDPOINT => 'sometimes|nullable|string',
            ThirdPartyInterface::MAILER_CONFIG_SERVICE_KEY      => 'sometimes|nullable|string',
            ThirdPartyInterface::MAILER_CONFIG_SERVICE_REGION   => 'sometimes|nullable|string',
            ThirdPartyInterface::MAILER_CONFIG_SERVICE_SECRET   => 'sometimes|nullable|string',
            ThirdPartyInterface::MAILER_CONFIG_TIMEOUT          => 'sometimes|nullable|integer',

        ];
    }
}
