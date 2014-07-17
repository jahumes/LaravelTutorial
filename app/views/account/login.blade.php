@extends ('layout.master')

@section('page_title')
  Laravel Authentication - Login
@endsection

@section('content')
  {{ Former::horizontal_open() }}
  {{ Former::xlarge_text('username')->require() }}
  {{ Former::xlarge_password('password') }}
  {{ Former::checkbox('remember')->text('Remember you for the future?')->unchecked_value(0) }}
  {{ Former::actions()->large_primary_submit('Login') }}
  {{ Former::close() }}
@endsection