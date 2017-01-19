@extends('master')
@section('content')
    <h2>Profile User</h2>
    @php
        $session = new Session;
    @endphp
    {{ AppHelper::showAlertFlashMessage($session, array('alert-success','alert-danger')) }}
    
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
            {!! Form::password('password', ['class' => 'form-control']) !!}
            {!! $errors->first('password','<span class="error-input">:message</span>')  !!}
        </div>
        <div class="form-group">
            {!! Form::label('password_input_confirmation','Password confirm:') !!}
            {!! Form::password('password_confirmation', ['class' => 'form-control']) !!}
            {!! $errors->first('password_confirmation','<span class="error-input">:message</span>')  !!}
        </div>

        @if($user->role_id == 2)
        <div class="form-group">
            {!! Form::label('fullname','Full name:') !!}
            {!! Form::text('extra_user_field[user_fullname]', UserMetaHelper::get($user->id,'user_fullname'), ['class' => 'form-control','id' => 'fullname']) !!}
            {!! $errors->first('extra_user_field.user_fullname','<span class="error-input">:message</span>')  !!}
        </div>

        <div class="form-group">
            {!! Form::label('address','Address:') !!}
            {!! Form::text('extra_user_field[user_address]', UserMetaHelper::get($user->id,'user_address'), ['class' => 'form-control','id' => 'address']) !!}
            {!! $errors->first('extra_user_field.user_address','<span class="error-input">:message</span>')  !!}
        </div>

        <div class="form-group">
            {!! Form::label('phone','Phone number:') !!}
            {!! Form::text('extra_user_field[user_phone]', UserMetaHelper::get($user->id,'user_phone'), ['class' => 'form-control','id' => 'phone']) !!}
            {!! $errors->first('extra_user_field.user_phone','<span class="error-input">:message</span>')  !!}
        </div>
        @endif
        
    	<div class="form-group">
    		{!! Form::submit('Update Profile', ['class' => 'btn btn-primary']) !!}
    	</div>
    {!! Form::close() !!}
@endsection