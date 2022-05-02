@component('mail::message')
# Hi {{$user['name']}}!

Great news! Your place **{{ $details['title'] }}** has now been published and is available to everyone!

Please click on the button below to view your place.

@component('mail::button', ['url' => route('place.preview', $details['slug'])])
    View Place
@endcomponent

Regards,<br>
{{ config('app.name') }}

@component('mail::subcopy')
<sub>This is an automated message please do not reply.</sub>
@endcomponent

@endcomponent