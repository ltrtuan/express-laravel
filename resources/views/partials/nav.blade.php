<nav class="main-nav">
    <div class="container">
        <nav class="navbar navbar-light bg-faded">                
          <ul class="nav navbar-nav">
            <li class="nav-item active">
              <a class="nav-link" href="/">Home <span class="sr-only">(current)</span></a>
            </li>
            @if(is_null($current_user))
            <li class="nav-item">
              <a class="nav-link" href="{{ route('login_path') }}">Login</a>
            </li>
            @else
            <li class="nav-item">
              <a class="nav-link" href="{{ route('register_path') }}">Register New User</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="supportedContentDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">User</a>
              <div class="dropdown-menu" aria-labelledby="supportedContentDropdown">
                <a class="dropdown-item" href="{{ route('profile_path') }}">Profile</a>
                <a class="dropdown-item" href="{{ route('logout_path') }}">Logout</a>                      
              </div>
            </li>
            @endif
          </ul>          
        </nav>
    </div>
</nav>