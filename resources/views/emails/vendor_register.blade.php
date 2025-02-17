@component('mail:message')
    Hi {{ $user->name }},<br>
    Your Email Id: {{ $user->email }},<br>
    <p>Thanks for Joining {{ config('app.name') }}.</p>
    <p>Click on the button below, to Validate your email address.</p>
    @component('mail:button', ['url' => url('vendor/password/'.$user->forgot_token)])
        Login
    @endcomponent
    Thancks,<br>
    Property Management Service
@endcomponent
