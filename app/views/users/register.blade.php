@extends ('layout.master')

@section('page_title')
    Laravel Authentication - Registration
@endsection

@section('content')
    <?php
        echo Form::horizontal_open();

        echo Form::control_group(Form::label('email', 'Email', array('class'=>'col-sm-2')),
            '<div class="col-sm-10">' . Form::xlarge_text('email',Input::old('email')) . '</div>');

        echo Form::control_group(Form::label('first_name', 'First Name', array('class'=>'col-sm-2')),
            '<div class="col-sm-10">' . Form::xlarge_text('first_name',Input::old('first_name')) . '</div>');

        echo Form::control_group(Form::label('last_name', 'Last Name', array('class'=>'col-sm-2')),
            '<div class="col-sm-10">' . Form::xlarge_text('last_name',Input::old('last_name')) . '</div>');

        echo Form::control_group(Form::label('password', 'Password', array('class'=>'col-sm-2')),
            '<div class="col-sm-10">' . Form::xlarge_password('password') . '</div>');

        echo Form::control_group(Form::label('password_confirmation', 'Confirm Password', array('class'=>'col-sm-2')),
            '<div class="col-sm-10">' . Form::xlarge_password('password_confirmation') . '</div>');

        echo Form::control_group(Form::label('admin', 'Admin?', array('class'=>'col-sm-2')),
            '<div class="col-sm-10">' . Form::labelled_checkbox('admin', 'Do you want to be an admin', 'Yes') . '</div>');

        echo '<div class="col-sm-10 col-sm-offset-2">' . Button::primary_submit('Register') . '</div>';

        echo Form::close();
    ?>
@endsection