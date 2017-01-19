@extends('master')
@section('content')

	@php
        $session = new Session;
    @endphp
    {{ AppHelper::showAlertFlashMessage($session, array('alert-success','alert-danger')) }}

    <div class="panel panel-default">
        <h1>Home page</h1>
       
        @if($currentUser)
        	Hello {{ $currentUser->name }}<br/>
        @endif
        You are in {{ App::getLocale() }} language
    </div>
     
@endsection