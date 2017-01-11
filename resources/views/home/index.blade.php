@extends('master')
@section('content')

	@if(Session::has('alert-success'))
    	<p class="alert alert-success">{{ Session::get('alert-success') }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
    @endif		  

    <div class="panel panel-default">
        <h1>Home page</h1>
       
        @if($currentUser)
        	Hello {{ $currentUser->name }}<br/>
        @endif
        You are in {{ App::getLocale() }} language
    </div>
     
@endsection