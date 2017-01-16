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
        <header>
          <div class="container">
            <div id="logo">
                <a href="{{ url('/') }}">expresscorporatehousing.com</a>
            </div>
          </div>
        </header>
      
        @include('partials/nav')
        
        <div id="main-content">
            <div class="container">