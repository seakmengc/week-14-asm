@component('mail::message')
# Notification

Your post title "{{ $title }}" has been approved.

@component('mail::button', ['url' => $url])
Detail
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
