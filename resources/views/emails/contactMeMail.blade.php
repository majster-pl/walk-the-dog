@component('mail::message')
# Hi Szymon!

User **{{ $details['name'] }}** send you a message:

@component('mail::panel')
    {{ $details['body'] }}
@endcomponent

Respond to [sender](mailto:{{ $details['email'] }})

Regards,<br>
{{ config('app.name') }}
@endcomponent