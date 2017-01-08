@extends('master')
@section('content')
    <h2>Forgot Password</h2>
    @if(Session::has('alert-success'))
        <p class="alert alert-success">{{ Session::get('alert-success') }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
    @endif
    @if(Session::has('alert-danger'))
        <p class="alert alert-danger">{{ Session::get('alert-danger') }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
    @endif
    @if (session('status'))
        <p class="alert alert-success">
            {{ session('status') }}
        </p>
    @endif
    {!! Form::open(['route' => ['forgot_pass_path'], 'class' => 'form-inline']) !!}
        <div class="form-group">
            {!! Form::label('email','Your registerd email:') !!}
            {!! Form::email('email',old('email'), ['class' => 'form-control']) !!}            
        </div>
        {!! Form::submit('Send Password Reset Link', ['class' => 'btn btn-primary']) !!}
    {!! Form::close() !!}
    {!! $errors->first('email','<div>:message</div>')  !!}
@endsection
