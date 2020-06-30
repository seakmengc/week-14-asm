@component('mail::message')
# Notification

A post title "{{ $title }}" has been created.

@component('mail::button', ['url' => $url])
Detail
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
