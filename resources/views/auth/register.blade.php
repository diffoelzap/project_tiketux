@extends('layout.main-layout')
@section('body')

<form action="{{ route('postRegister') }}" method="POST" class="col-md-6 col-xs-12 offset-md-3 auth-form" id="regitration_form">
  @csrf
  <div class="form-title">
    SIGN UP
 </div>
  <div class="grid gap-6 mb-6 md:grid-cols-2">
      <div>
          <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">First name</label>
          <input type="text" name="first_name" id="first_name" value="{{old('first_name')}}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="First Name"/>
          @if($errors->any('first_name'))
            <span class="text-danger">{{$errors->first('first_name')}}</span>
          @endif
      </div>
      <div>
          <label for="last_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Last name</label>
          <input type="text" name="last_name" id="last_name" value="{{old('last_name')}}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Last Name"/>
          @if($errors->any('last_name'))
            <span class="text-danger">{{$errors->first('last_name')}}</span>
          @endif
      </div>
  </div>
  <div class="mb-6">
      <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
      <input type="email" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" aria-describedby="emailHelp" placeholder="Enter email"/>
      <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
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
  <div class="mb-6">
      <label for="confirm_password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Confirm password</label>
      <input type="password" id="confirm_password" name="confirm_password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" autocomplete="false" placeholder="Confirm Password"/>
      @if($errors->any('confirm_password'))
          <span class="text-danger">{{$errors->first('confirm_password')}}</span>
      @endif
  </div> 
  <div class="flex items-start mb-6">
      <div class="flex items-center h-5">
      <input id="terms" name="terms" type="checkbox" {{(old('terms'))?'checked':''}} class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-blue-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-blue-600 dark:ring-offset-gray-800"/>
      </div>
      <label for="terms_check" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300 form-check-label">Check our <a href="#">terms</a> and <a href="#">conditions</a></label>
  </div>
  <div id="terms_error"></div>
           @if($errors->any('terms'))
               <span class="text-danger">{{$errors->first('terms')}}</span>
           @endif
          <div class="g-recaptcha" data-sitekey="{{env('GOOGLE_CAPTCHA_KEY')}}"  data-callback="recaptchaDataCallbackRegister"  data-expired-callback="recaptchaExpireCallbackRegister"></div>

          <input type="hidden"  name="grecaptcha" id="hiddenRecaptchaRegister" >
          <div id="hiddenRecaptchaRegisterError"></div>
           @if($errors->any('grecaptcha'))
               <span class="text-danger">{{$errors->first('grecaptcha')}}</span>
           @endif
  <br>
  <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>&nbsp; Already have an account <a href="{{ route('getLogin')}}">sign in</a> here</div>
</form>
@endsection