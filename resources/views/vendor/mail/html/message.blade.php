<x-mail::layout>
{{-- Header --}}
<x-slot:header>
<x-mail::header :url="config('app.url')">

</x-mail::header>
</x-slot:header>

{{-- Body --}}
{{ $slot }}

{{-- Subcopy --}}
@isset($subcopy)
<x-slot:subcopy>
<x-mail::subcopy>
{{ $subcopy }}
</x-mail::subcopy>
</x-slot:subcopy>
@endisset

{{-- Footer --}}
<x-slot:footer>
<x-mail::footer>
© {{ date('Y') }} {{ $tenant_name }}. @lang('All rights reserved.')
    Powered by <a href="https://sigi.ro" style="color: #3d4852;">{{ config('app.name') }}</a>.
</x-mail::footer>
</x-slot:footer>
</x-mail::layout>
