@extends('layout.master')

@section('page_title')
    Profile For {{ $user->fullName() }}
@endsection

@section('content')
  <div class="row">
    <div class="col-sm-6">
      <p>Your email: {{ $user->email }}</p>
      <p>Your account was created on: {{ $user
        ->created_at }}</p>
    </div>
    <div class="col-sm-6">
      <h2>Update Your Profile</h2>
      {{ Former::populate( $user ) }}
      {{ Former::horizontal_open() }}
      {{ Former::xlarge_text('email')->require() }}
      {{ Former::xlarge_text('first_name')->require() }}
      {{ Former::xlarge_text('last_name')->require() }}
      {{ Former::xlarge_password('password') }}
      {{ Former::xlarge_password('password_confirmation') }}
      {{ Former::actions()->large_primary_submit('Update Profile')->large_inverse_reset('Reset') }}
      {{ Former::close() }}
    </div>
  </div>

@endsection