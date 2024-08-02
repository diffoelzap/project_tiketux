<x-mail::message>

Hello {{ $user->first_name}}

<x-mail::button :url="route('verify_email',$user->email_verification_code)">
Click here to verify your email address
</x-mail::button>

<p>Or copy paste the following link on your web browser to verify your email address</p>

<p><a href="{{ route('verify_email',$user->email_verification_code)}}">
    {{ route('verify_email',$user->email_verification_code)}}</a></p>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
