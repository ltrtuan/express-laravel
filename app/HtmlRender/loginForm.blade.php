@php
    $session = new Session;
@endphp
{{ AppHelper::showAlertFlashMessage($session, array('alert-success','alert-danger')) }}
    
{!! Form::open(array('route' => 'action_login_path')) !!}
	<div class="form-group">
	{!! Form::label('username','Username or Email:') !!}
	{!! Form::text('username', null, ['class' => 'form-control']) !!}
  	{!! $errors->first('username','<span class="error-input">:message</span>')  !!}
	</div>
	<div class="form-group">
	{!! Form::label('password','Password:') !!}
	{!! Form::password('password', ['class' => 'form-control']) !!}
  	{!! $errors->first('password','<span class="error-input">:message</span>')  !!}
	</div>
	<div class="form-check">    	
		{!! Form::checkbox('remember', '1') !!}
		{{ trans('users.remember_me') }}
	</div>
  <div class="form-group">      
    <a href="{{ route('forgot_pass_path') }}">{{ trans('users.forgot_pass_text') }}</a>
  </div>
	<div class="form-group">
	{!! Form::submit(trans('general.login_button'), ['class' => 'btn btn-primary']) !!}    		
	</div>
{!! Form::close() !!}    