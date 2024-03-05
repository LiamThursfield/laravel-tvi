@php
    use App\Models\EDU\Course\CoursePurchasePayment;

    /** @var CoursePurchasePayment $payment */
@endphp

<x-mail::message>
# Crează cont {{ config('app.name') }}

Salut,

Ai cumpărat cu succes <strong>{{ $payment->purchase->course->name }}</strong>.

Crează-ți contul folosind butonul de mai jos:
<x-mail::button :url="$url">
    Crează cont
</x-mail::button>

Alternativ, poti crea un cont si accesând acest link:
<a href="{{ $url }}">{{ $url }}.</a>.

Bun venit!
<br>
Echipa {{ config('app.name') }}
<br><br>

<small>
    Dacă nu ai solicitat crearea unui cont în rețeaua {{ config('app.name') }} și crezi că nu ar trebui să primești acest e-mail,
    te rugăm contactează-ne la adresa <a href="mailTo:support@minducate.us">support@minducate.us</a>.
</small>

<br>
</x-mail::message>
