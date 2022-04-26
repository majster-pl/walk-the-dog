@component('mail::message')
# Hi {{$user['name']}}!

We've received your request for **{{ $details['title'] }}** and our team will reveiw it shortly.

Please click on the button below if you want to edit your entry.

@component('mail::button', ['url' => route('place.edit', $details['id'])])
    Edit Plac
@endcomponent

@component('mail::subcopy')
    This is an automated message please do not reply.
@endcomponent

Regards,<br>
{{ config('app.name') }}
@endcomponent