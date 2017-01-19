@extends('master')
@section('content')   
    <h2>Reset Password</h2>
    @php
        $session = new Session;
    @endphp
    {{ AppHelper::showAlertFlashMessage($session, array('alert-success','alert-danger')) }}
    

    {!! Form::open(['route' => ['reset_pass_path']]) !!}

        <div class="form-group">
            {!! Form::label('email','Email:') !!}
            {!! Form::text('email', null, ['class' => 'form-control']) !!}
            {!! $errors->first('email','<span class="error-input">:message</span>')  !!}
        </div>
        <div class="form-group">
            {!! Form::label('password','Password:') !!}
            {!! Form::password('password', ['class' => 'form-control']) !!}
            {!! $errors->first('password','<span class="error-input">:message</span>')  !!}
        </div>
        <div class="form-group">
            {!! Form::label('password_confirmation','Password confirm:') !!}
            {!! Form::password('password_confirmation', ['class' => 'form-control']) !!}
            {!! $errors->first('password_confirmation','<span class="error-input">:message</span>')  !!}
        </div>
      
        <div class="form-group">
            {!! Form::submit('Reset Password', ['class' => 'btn btn-primary']) !!}
        </div>
        {{ Form::hidden('token', $token) }}
    {!! Form::close() !!}
@endsection