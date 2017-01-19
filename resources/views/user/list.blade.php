@extends('master')
@section('content')
    <h2>List Users</h2>
    @php
        $session = new Session;
    @endphp
    {{ AppHelper::showAlertFlashMessage($session, array('alert-success','alert-danger')) }}
   
    <p class="alert alert-success alert-for-ajax" style="display:none">{{ trans('users.delete_user_success') }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>

    <p class="alert alert-danger alert-for-ajax" style="display:none">{{ trans('users.delete_user_fail') }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
  
    
    @if(count($users) > 0)
      <form class="form-inline float-xs-right" id="form-search-list" style="display:none">
        <input class="form-control" type="text" placeholder="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>
      <div class="clearfix"></div>

      {!! Form::open(['data-remote', 'route' => ['delete_user_path_ajax'],'method' => 'POST']) !!}
        <table class="table table-striped">
          <thead>
            <tr>
              <th>#</th>
              <th>Username</th>
              <th>Email</th>
              <th>Role</th>
              <th>Created At</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            @php ($i = 0)
            @foreach($users as $user)
                @php ($i++)
            <tr>
              <th scope="row">{{ $i }}</th>
              <td><a href="{{ route('edit_user_path',$user->id )}}">{!! $user->name !!}</a></td>
              <td>{!! $user->email !!}</td>
              <td>{!! $user->getRoleNameAttribute($user->role_id) !!}</td>
              <td>{!! $user->created_at !!}</td>
              <td>
                @if($current_user->id != $user->id)
                <label class="custom-control custom-checkbox">
                  {!! Form::checkbox('id_user[]', $user->id, '', ['class' => 'custom-control-input check-delete-user']) !!}                
                  <span class="custom-control-indicator"></span>
                  <span class="custom-control-description" style="font-size:0px">a</span>
                </label>              
                @endif
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>

        @if($user->id != $current_user->id)
          <a role="button" class="btn btn-danger btn-sm float-lg-right" href="#" id="delete-user-btn">Delete</a>
        @endif
      {!! Form::close() !!}
      {{ $users->links() }}
    @else
      <h1 class="text-center">There are no user</h1>
    @endif
@endsection