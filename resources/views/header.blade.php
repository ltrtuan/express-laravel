<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Expresscorporatehousing.com</title>
       
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,400i,700,700i,800,800i&amp;subset=vietnamese" rel="stylesheet">
        {!! Html::style('css/bootstrap/bootstrap.min.css') !!}
        {!! Html::style('js/tether/css/tether.min.css') !!}
        {!! Html::style('css/app.css') !!}
        {!! Html::script('js/jquery.min.js') !!}
        {!! Html::script('js/tether/js/tether.min.js') !!}
        {!! Html::script('js/bootstrap.min.js') !!}
    </head>
    <body>
        <header>
          <div class="container">
            <h2>expresscorporatehousing.com</h2>
          </div>
        </header>

        <nav>
            <div class="container">
                <nav class="navbar navbar-light bg-faded">                
                  <ul class="nav navbar-nav">
                    <li class="nav-item active">
                      <a class="nav-link" href="/">Home <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="{{ route('login_path') }}">Login</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="{{ route('register_path') }}">Register</a>
                    </li>
                    <li class="nav-item dropdown">
                      <a class="nav-link dropdown-toggle" href="#" id="supportedContentDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">User</a>
                      <div class="dropdown-menu" aria-labelledby="supportedContentDropdown">
                        <a class="dropdown-item" href="{{ route('register_path') }}">Profile</a>
                        <a class="dropdown-item" href="{{ route('logout_path') }}">Logout</a>                      
                      </div>
                    </li>
                  </ul>
                  <form class="form-inline float-xs-right">
                    <input class="form-control" type="text" placeholder="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                  </form>
                </nav>
            </div>
        </nav>


        <div id="main-content">
            <div class="container">                
            
        
