<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" href="{!! asset('images/favicon.ico') !!}" type="image/x-icon">
        <title>Expresscorporatehousing.com</title>

        {!! Html::style('css/vendors.css') !!}     
        {!! Html::style('css/app.css') !!}

        {!! Html::script('js/vendors.js') !!}
        {!! Html::script('js/all.js') !!}
     
    </head>
    <body>
        <div id="body-inner" class="container-fluid">
            <header>
                <div class="row">
                    <div class="col-md-2">
                        <div id="logo">
                            <a href="{{ url('/') }}">expresscorporatehousing.com</a>
                        </div>
                    </div>

                    <div class="col-md-10">
                        @if(!is_null($current_user))
                            <span class="navbar-text float-lg-right">
                                Hello: <a href="{{ route('profile_path') }}">{!! $current_user->name !!}</a> - <a href="{{ route('logout_path') }}">Logout</a>
                            </span>
                        @endif
                    </div>
                </div>
               
               
            </header>
          
            <div class="row" id="main-row">
                
                <div class="col-md-2">
                    @include('partials/nav')
                </div>                

                <div class="col-md-10">            
                    <div id="main-content">