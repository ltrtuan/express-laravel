<nav class="main-nav">
    <div class="container">
        <nav class="navbar navbar-toggleable-md navbar-light bg-faded">
          <div class="clearfix" id="navbarText">
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
               
              @endif

              @if(!is_null($current_user))
                @if($current_user->role_id != '4')
                <li class="nav-item">
                  <a class="nav-link" href="{{ route('list_users_path') }}">List Users</a>
                </li>
                @endif
              @endif

              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="supportedContentDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">User</a>
                <div class="dropdown-menu" aria-labelledby="supportedContentDropdown">
                  <a class="dropdown-item" href="{{ route('profile_path') }}">Profile</a>
                  <a class="dropdown-item" href="{{ route('logout_path') }}">Logout</a>                      
                </div>
              </li>
              
            </ul>

            @if(!is_null($current_user))
            <span class="navbar-text float-lg-right">
              Hello: <a href="{{ route('profile_path') }}">{!! $current_user->name !!}</a> - <a href="{{ route('logout_path') }}">Logout</a>
            </span>
            @endif
          </div>
        </nav>
    </div>
</nav>
