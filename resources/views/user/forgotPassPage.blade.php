@extends('master')
@section('content')
    <h2>Forgot Password</h2>
    @php
        $session = new Session;
    @endphp
    {{ AppHelper::showAlertFlashMessage($session, array('alert-success','alert-danger')) }}
    
    @if (session('status'))
        <p class="alert alert-success">
            {{ session('status') }}
        </p>
    @endif
    {!! Form::open(['route' => ['forgot_pass_path'], 'class' => 'form-inline']) !!}
        <div class="form-group">
            {!! Form::label('email','Your registerd email:') !!}
            {!! Form::email('email',old('email'), ['class' => 'form-control']) !!}
            {!! $errors->first('email','<span class="error-input">:message</span>')  !!}
        </div>
        {!! Form::submit('Send Password Reset Link', ['class' => 'btn btn-primary']) !!}
    {!! Form::close() !!}
   
    <div class="form-group">
        <a href="{{ route('login_path') }}">{{ trans('users.back_to_login') }}</a>
    </div>
@endsection
