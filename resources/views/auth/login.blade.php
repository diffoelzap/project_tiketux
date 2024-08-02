@extends('layout.main-layout')
@section('body')

<div class="row mb-3">
    <form action="{{ route('postLogin') }}" method="POST" class="col-md-6 col-xs-12 offset-md-3 auth-form"  id="login_form">
          @csrf
         <div class="form-title">
            SIGN IN
         </div>
         
         <div class="mb-6">
            <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
            <input type="email" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" aria-describedby="emailHelp" placeholder="Enter email"/>
            @if($errors->any('email'))
                <span class="text-danger">{{$errors->first('email')}}</span>
            @endif
        </div> 
        <div class="mb-6">
            <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
            <input type="password" id="password" name="password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" autocomplete="false" placeholder="Password"/>
            @if($errors->any('password'))
                <span class="text-danger">{{$errors->first('password')}}</span>
            @endif
        </div> 
        <div class="flex items-start mb-6">
            <div class="flex items-center h-5">
            <input type="checkbox" {{(old('remember_me'))?'checked':''}} value="true" name="remember_me" id="remember_me" class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-blue-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-blue-600 dark:ring-offset-gray-800"/>
            </div>
            <label for="remember_me" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300 form-check-label">Remember Me</label>
        </div>
        <div class="g-recaptcha" data-sitekey="{{env('GOOGLE_CAPTCHA_KEY')}}"  data-callback="recaptchaDataCallbackLogin"  data-expired-callback="recaptchaExpireCallbackLogin"></div>

        <input type="hidden"  name="grecaptcha" id="hiddenRecaptchaLogin" >
        <div id="hiddenRecaptchaLoginError"></div>
            @if($errors->any('grecaptcha'))
                <span class="text-danger">{{$errors->first('grecaptcha')}}</span>
            @endif
        <br>
        <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>&nbsp; Don't have an account <a href="{{ route('getRegister') }}">sign up</a> here</div>
   </form>	
</div>

@endsection