@component('mail::message')
# {{ $data['subject'] }}

{{ $data['message'] }}

{{-- @component('mail::button', ['url' => 'https://example.com'])
Visit Us
@endcomponent --}}

Thanks,<br>
{{ config('app.name') }}
@endcomponent
