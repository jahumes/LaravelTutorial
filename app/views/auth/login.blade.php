@extends ('layout.master')

@section('page_title')
  Laravel Authentication - Login
@endsection

@section('content')
  {{ Former::horizontal_open() }}
  {{ Former::xlarge_text('email')->require() }}
  {{ Former::xlarge_password('password') }}
  {{ Former::actions()->large_primary_submit('Login') }}
  {{ Former::close() }}
@endsection