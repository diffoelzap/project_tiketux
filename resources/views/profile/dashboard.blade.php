@extends('profile.profile-layout')
@section('profile')
<div class="card">
    <div class="card-header">
      Dashboard
    </div>
    <div class="card-body">
      <h5 class="card-title">Welcome to your profile <b><i>{{ $user->first_name}}</i></b></h5>
    </div>
  </div>
@endsection