@extends('master')
@section('content')
    <h2>List Users</h2>
    @if(Session::has('alert-success'))
    	<p class="alert alert-success">{{ Session::get('alert-success') }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
    @endif
    @if(Session::has('alert-danger'))
        <p class="alert alert-danger">{{ Session::get('alert-danger') }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
    @endif

    @if(count($users) > 0)
      <form class="form-inline float-xs-right" id="form-search-list" style="display:none">
        <input class="form-control" type="text" placeholder="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>
      <div class="clearfix"></div>
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
            <td>{!! $user->role_id !!}</td>
            <td>{!! $user->created_at !!}</td>
            <td>
              @if($current_user->id != $user->id)
              {!! Form::checkbox('id_user', $user->id) !!}
              @endif
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>

      @if($user->id != $current_user->id)
        <a role="button" class="btn btn-danger btn-sm float-lg-right" href="#" id="delete-user-btn">Delete</a>
      @endif

      {{ $users->links() }}
    @else
      <h1 class="text-center">There are no user</h1>
    @endif
@endsection