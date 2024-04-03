@php
    use App\Models\EDU\Course\CoursePurchasePayment;

    /** @var CoursePurchasePayment $payment */
@endphp

<x-mail::message>
# Registration required

Hello,

You have successfully purchased <strong>{{ $payment->purchase->course->name }}</strong>.

Please click the button below to register and access the course.

<x-mail::button :url="$url">
    Register
</x-mail::button>

Alternatively, please use the link below to register:
    {{ $url }}.

<br>
<br>
{{ config('app.name') }}
</x-mail::message>
