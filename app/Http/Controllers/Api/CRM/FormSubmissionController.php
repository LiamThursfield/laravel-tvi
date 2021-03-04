<?php

namespace App\Http\Controllers\Api\CRM;

use App\Actions\CRM\FormSubmission\FormSubmissionStoreAction;
use App\Http\Controllers\Controller;
use App\Models\CRM\Form;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class FormSubmissionController extends Controller
{
    /**
     * @param Request $request
     * @param Form $form
     * @return JsonResponse
     * @throws ValidationException
     */
    public function store(Request $request, Form $form)
    {
        app(FormSubmissionStoreAction::class)->handle($form, $request->all());

        // TODO: Add success message to form model. Add redirect url to form model
        return new JsonResponse([
            'message'       => 'Successfully submitted ' . $form->name . ' form',
            'redirect_url'  => false,
        ]);
    }
}