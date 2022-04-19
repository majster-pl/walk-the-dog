@component('mail::message')
# Welcome Editor!

Place **{{ $details['title'] }}** added by **{{ $user['name'] }}** is awaiting reveiw...

Please click on the button below to review this place.

@component('mail::button', ['url' => route('place.review', $details['id'])])
    Review Plac
@endcomponent

@component('mail::subcopy')
    This is an automated message please do not reply.
@endcomponent

Regards,<br>
{{ config('app.name') }}
@endcomponent