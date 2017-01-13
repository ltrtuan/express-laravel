@extends('master')
@section('content')
    <h2>List Users</h2>
    @if(Session::has('alert-success'))
    	<p class="alert alert-success">{{ Session::get('alert-success') }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
    @endif
    @if(Session::has('alert-danger'))
        <p class="alert alert-danger">{{ Session::get('alert-danger') }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
    @endif
    <form class="form-inline float-xs-right" id="form-search-list">
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
          <td>{!! Form::checkbox('id_user', $user->id) !!}</td>
        </tr>
        @endforeach
      </tbody>
    </table>
    {{ $users->links() }}
@endsection