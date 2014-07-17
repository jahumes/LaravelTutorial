@extends('layout.master')

@section('page_title')
    Profile For {{ $user->full_name() }}
@endsection

@section('content')
  <div class="row">
    <div class="col-sm-6">
      {{ Session::get('notify') ?  "<p style='color: green'>" . Session::get('notify') . "</p>" : "" }}
      <p>Your email: {{ $user->email }}</p>
      <p>Your account was created on: {{ $user
        ->created_at }}</p>
    </div>
    <div class="col-sm-6">
      <?php
        echo Form::horizontal_open();

        echo Form::control_group(Form::label('email', 'Email', array('class'=>'col-sm-3')),
          '<div class="col-sm-9">' . Form::xlarge_text('email',$user->email) . '</div>');

        echo Form::control_group(Form::label('first_name', 'First Name', array('class'=>'col-sm-3')),
          '<div class="col-sm-9">' . Form::xlarge_text('first_name',$user->first_name) . '</div>');

        echo Form::control_group(Form::label('last_name', 'Last Name', array('class'=>'col-sm-3')),
          '<div class="col-sm-9">' . Form::xlarge_text('last_name',$user->last_name) . '</div>');

        echo Form::control_group(Form::label('password', 'Password', array('class'=>'col-sm-3')),
          '<div class="col-sm-9">' . Form::xlarge_password('password') . '</div>');

        echo Form::control_group(Form::label('password_confirmation', 'Confirm', array('class'=>'col-sm-3')),
          '<div class="col-sm-9">' . Form::xlarge_password('password_confirmation') . '</div>');

        echo Form::control_group(Form::label('admin', 'Admin?', array('class'=>'col-sm-3')),
          '<div class="col-sm-9">' . Form::labelled_checkbox('admin', 'Do you want to be an admin', 'Yes') . '</div>');

        echo '<div class="col-sm-10 col-sm-offset-2">' . Button::primary_submit('Register') . '</div>';

        echo Form::close();
        ?>
    </div>
  </div>

@endsection