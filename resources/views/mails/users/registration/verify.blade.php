@component('mail::message')
# Hey {{ $user->name }}, thanks for taking your time to signup with us.

Please click the below button to confirm your registration with us.

@component('mail::button', ['url' => $url])
    Complete Registration
@endcomponent

If you did not create an account, no further action is required.

Thanks,<br>
{{ config('app.name') }}
@endcomponent