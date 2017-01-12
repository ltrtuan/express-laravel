@extends('master')
@section('content')
    <h2>Profile User</h2>
    @if(Session::has('alert-success'))
    	<p class="alert alert-success">{{ Session::get('alert-success') }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
    @endif
    @if(Session::has('alert-danger'))
        <p class="alert alert-danger">{{ Session::get('alert-danger') }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
    @endif
    {!! Form::model($user, ['route' => 'update_user_path','method' => 'PATCH']) !!}   
        <div class="form-group">
            {!! Form::label('name','Username:') !!}
            {!! Form::text('name', null, ['class' => 'form-control']) !!}
            {!! $errors->first('name','<span class="error-input">:message</span>')  !!}
        </div> 	
    	<div class="form-group">
            {!! Form::label('email','Email:') !!}
            {!! Form::text('email', null, ['class' => 'form-control']) !!}
            {!! $errors->first('email','<span class="error-input">:message</span>')  !!}
        </div>
    	<div class="form-group">
            {!! Form::label('password_input','Password:') !!}
            {!! Form::password('password_input', ['class' => 'form-control']) !!}
            {!! $errors->first('password_input','<span class="error-input">:message</span>')  !!}
        </div>
        <div class="form-group">
            {!! Form::label('password_input_confirmation','Password confirm:') !!}
            {!! Form::password('password_input_confirmation', ['class' => 'form-control']) !!}
            {!! $errors->first('password_input_confirmation','<span class="error-input">:message</span>')  !!}
        </div>
      
    	<div class="form-group">
    		{!! Form::submit('Update Profile', ['class' => 'btn btn-primary']) !!}
    	</div>
    {!! Form::close() !!}
@endsection