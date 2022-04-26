@component('mail::message')
# Hi Editor!

Place **{{ $details['title'] }}** added by **{{ $user['name'] }}** is awaiting reveiw...

Please click on the button below to review this place.

@component('mail::button', ['url' => route('place.review', $details['id'])])
    Review Plac
@endcomponent

Regards,<br>
{{ config('app.name') }}

@component('mail::subcopy')
<sub>This is an automated message please do not reply.</sub>
@endcomponent

@endcomponent