@component('mail::message')
# Hi {{$user['name']}}!

Gread news! **{{ $details['title'] }}** has been reviewed and is now available to everyone!

Please click on the button below to view it.

@component('mail::button', ['url' => route('place.preview', $details['id'])])
    View Place
@endcomponent

@component('mail::subcopy')
    This is an automated message please do not reply.
@endcomponent

Regards,<br>
{{ config('app.name') }}
@endcomponent