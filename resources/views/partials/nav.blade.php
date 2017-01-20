<nav class="main-nav">  
  <nav class="admin-nav">
    <div class="clearfix" id="navbarText">
      <ul class="nav">
        <li class="active">
          <a class="nav-link" href="/">Dashboard <span class="sr-only">(current)</span></a>
        </li>
        @if(is_null($current_user))
        <li>
          <a class="nav-link" href="{{ route('login_path') }}">Login</a>
        </li>
        @elseif(!is_null($current_user))
        <li>
          <a class="nav-link" href="{{ route('profile_path') }}">User profile</a>
          <ul>
              @if($current_user->role_id == 1 || $current_user->role_id == 2)
                <li class="nav-item">
                  <a class="nav-link" href="{{ route('register_path') }}">Register New User</a>
                </li>
              @endif
              @if($current_user->role_id != '4')
                <li class="nav-item">
                  <a class="nav-link" href="{{ route('list_users_path') }}">List Users</a>
                </li>
              @endif
          </ul>
        </li>
        @endif

        @if(!is_null($current_user))
        <li>
          <a class="nav-link" href="{{ route('list_list_option_path') }}">Setting</a>
          <ul>
            <li>
              <a class="nav-link" href="{{ route('list_list_option_path') }}">List options</a>
            </li>
          </ul>
        </li>
        @endif
        
      </ul>

      
    </div>
  </nav>  
</nav>
