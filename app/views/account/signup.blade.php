@extends ('layout.master')

@section('page_title')
    Laravel Authentication - Registration
@endsection

@section('content')
  {{ Former::populate( Input::old() ) }}
  {{ Former::horizontal_open() }}
  {{ Former::xlarge_text('username')->require() }}
  {{ Former::xlarge_text('email')->require() }}
  {{ Former::xlarge_text('first_name')->require() }}
  {{ Former::xlarge_text('last_name')->require() }}
  {{ Former::xlarge_password('password') }}
  {{ Former::xlarge_password('password_confirmation') }}
  {{ Former::actions()->large_primary_submit('Sign Up') }}
  {{ Former::close() }}
@endsection