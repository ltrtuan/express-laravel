@if(Session::has('alert-success'))
	<p class="alert alert-success">{{ Session::get('alert-success') }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
@endif
@if(Session::has('alert-danger'))
    <p class="alert alert-danger">{{ Session::get('alert-danger') }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
@endif
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
		{!! Form::submit(trans('general.login_button'), ['class' => 'btn btn-primary']) !!}    		
	</div>
{!! Form::close() !!}    