@component('mail::message')
# Hi Editor!

Place **{{ $details['title'] }}** has just been edited by **{{ $user['name'] }}** and is currently awaiting reveiw...

Please click on the button below to review this place.

@component('mail::button', ['url' => route('place.review', $details['slug'])])
    Review Plac
@endcomponent

Regards,<br>
{{ config('app.name') }}

@component('mail::subcopy')
<sub>This is an automated message please do not reply.</sub>
@endcomponent

@endcomponent