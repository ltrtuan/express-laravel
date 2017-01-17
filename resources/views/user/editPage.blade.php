@extends('master')
@section('content')
    <h2>Edit User</h2>   
    @if(Session::has('alert-success'))
        <p class="alert alert-success">{{ Session::get('alert-success') }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
    @endif
    @if(Session::has('alert-danger'))
        <p class="alert alert-danger">{{ Session::get('alert-danger') }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
    @endif
    {!! Form::model($user, ['route' => ['edit_user_path', $user->id], 'files' => true, 'method' => 'PATCH'] ) !!}
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
        
        @if($user->id != $currentUser->id)
        <div class="form-group">
            {!! Form::label('','Status:') !!}
            <label class="custom-control custom-checkbox">
                {!! Form::radio('status', '1', $user->getStatusCheckedAtrribute($user, 1), ['class' => 'custom-control-input']) !!}                
                <span class="custom-control-indicator"></span>
                <span class="custom-control-description">Active</span>
            </label>
            <label class="custom-control custom-checkbox">
                {!! Form::radio('status', '0', $user->getStatusCheckedAtrribute($user, 0), ['class' => 'custom-control-input']) !!}                
                <span class="custom-control-indicator"></span>
                <span class="custom-control-description">Deactive</span>
            </label>
        </div>
        @else
            {{ Form::hidden('status', $user->status) }}
        @endif

        {{ Form::hidden('role_id', $user->role_id) }}
        
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


        <div class="form-group clearfix">
            {!! Form::submit('Update', ['class' => 'btn btn-primary float-lg-left']) !!}
            <a role="button" class="btn btn-secondary float-lg-right" href="{{ route('list_users_path') }}">Back</a>
        </div>
        {{ Form::hidden('id', $user->id) }}
    {!! Form::close() !!}

    @if($user->id != $currentUser->id)
        {!! Form::open(['route' => ['delete_user_path',$user->id],'method' => 'DELETE']) !!}            
            {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm float-lg-right']) !!}
        {!! Form::close() !!}
    @endif

@endsection