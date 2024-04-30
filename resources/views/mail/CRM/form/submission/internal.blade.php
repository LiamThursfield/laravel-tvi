@php
    use App\Models\CRM\Contact;
    use App\Models\CRM\Form;
    use App\Models\CRM\FormField;use App\Models\CRM\FormSubmission;use Illuminate\Support\Arr;use Illuminate\Support\Collection;

    /** @var ?Contact $contact */
    /** @var Form $form */
    /** @var Collection<FormField> $formFields */
    /** @var FormSubmission $submission */
@endphp

<x-mail::message>
# Form Submitted: {{ $form->name }}

A new submission of {{ $form->name }} has been received

<x-mail::table>
| Field | Value |
|:------|:-----|
@foreach($formFields as $formField)
|{!! $formField->name !!}: |{!! Arr::get($submission->data, $formField->slug, '') !!}|
@endforeach
</x-mail::table>
<strong>{{ config('app.name') }}</strong>
</x-mail::message>

