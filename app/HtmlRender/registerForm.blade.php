    @if(Session::has('alert-success'))
    	<p class="alert alert-success">{{ Session::get('alert-success') }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
    @endif
    @if(Session::has('alert-danger'))
        <p class="alert alert-danger">{{ Session::get('alert-danger') }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
    @endif
   	{!! Form::open(['route' => ['create_user_path'],'files' => true]) !!}
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
            {!! Form::label('role_id','Role:') !!}            
            @if($currentUser->role_id == 1)
                {!! Form::select('role_id', ['2' => 'Manager', '1' => 'Super Admin'], '', ['class' => 'form-control']) !!}
            @else
                {!! Form::select('role_id', ['3' => 'Sub Manager', '4' => 'User'], '', ['class' => 'form-control']) !!}
            @endif

            {!! $errors->first('role_id','<span class="error-input">:message</span>')  !!}
        </div>
    
    	<div class="form-group">
    		{!! Form::submit('Register', ['class' => 'btn btn-primary']) !!}
    	</div>
    	{{ Form::hidden('parent', $currentUser->id) }}
        {{ Form::hidden('status', '1') }}
    {!! Form::close() !!}