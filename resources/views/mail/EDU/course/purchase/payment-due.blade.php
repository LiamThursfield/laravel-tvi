@php
    use App\Models\EDU\Course\CoursePurchasePayment;
    use App\Interfaces\EDU\Course\CoursePurchaseInterface;

    /** @var CoursePurchasePayment $payment */
@endphp

<x-mail::message>
# Payment Due!

@if($payment->purchase->user)
Hello {{ $payment->purchase->user->name }},
@else
Hello,
@endif

Payment is due for your purchase of course:
<strong>{{ $payment->purchase->course->name }}</strong>

Amount due:
<strong>{{ CoursePurchaseInterface::getPriceWithCurrency($payment->currency, $payment->price) }}</strong>

<x-mail::button :url="$url">
    Make Payment
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
