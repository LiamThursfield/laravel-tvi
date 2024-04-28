<x-mail::message>
    # Mailer Settings Test!

<ul>
@foreach($mailerSettings as $key => $value)
<li><strong>{{ $key }}:</strong> {{ $value ?? '-' }}</li>
@endforeach
</ul>


Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
