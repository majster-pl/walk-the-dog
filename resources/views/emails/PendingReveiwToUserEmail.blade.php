@component('mail::message')
# Hi {{$user['name']}}!

We've received your request for **{{ $details['title'] }}** to be added to our collection and our team will reveiw it shortly.

Please click on the button below if you want to edit this palce.

@component('mail::button', ['url' => route('place.edit', $details['id'])])
    Edit Plac
@endcomponent

Regards,<br>
{{ config('app.name') }}

@component('mail::subcopy')
<sub>This is an automated message please do not reply.</sub>
@endcomponent

@endcomponent