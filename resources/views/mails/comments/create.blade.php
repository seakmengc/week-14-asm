@component('mail::message')
# Notification

There is a new comment "{{ $content }}" in "{{ $title }}".

@component('mail::button', ['url' => $url])
Detail
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
