@extends ('layout.master')

@section('page_title')
  Laravel Authentication - Login
@endsection

@section('content')
  <?php
    echo Form::horizontal_open();

    echo Form::control_group(Form::label('email', 'Email', array('class'=>'col-sm-2')),
      '<div class="col-sm-10">' . Form::xlarge_text('email',Input::old('email')) . '</div>');

    echo Form::control_group(Form::label('password', 'Password', array('class'=>'col-sm-2')),
      '<div class="col-sm-10">' . Form::xlarge_password('password') . '</div>');

    echo '<div class="col-sm-10 col-sm-offset-2">' . Button::primary_submit('Logind') . '</div>';

    echo Form::close();
  ?>
@endsection