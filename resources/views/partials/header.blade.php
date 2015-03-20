<header class="main-header">
        <a href="{{Url()}}" class="logo"><b>PIASS</b>Student</a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <!-- Messages: style can be found in dropdown.less-->
              
              <!-- Notifications: style can be found in dropdown.less -->
              
              <!-- Tasks: style can be found in dropdown.less -->
              
              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <img src="{{Url()}}/assets/dist/img/avatar.png" class="user-image" alt="User Image"/>
                  <span class="hidden-xs"> {{ Sentry::getUser()->first_name }}  {{ Sentry::getUser()->last_name }} </span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                    <img src="{{Url()}}/assets/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image" />
                    <p>
                       {{ Sentry::getUser()->first_name }}  {{ Sentry::getUser()->last_name }} 
                    </p>
                  </li>
                  <!-- Menu Body -->
                  
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <div class="pull-left">
                      <a href="{{ route('sentinel.profile.show') }}" class="btn btn-default btn-flat">Profile</a>
                    
                    </div>
                    <div class="pull-right">
                      <a class="btn btn-default btn-flat" href="{{ route('sentinel.logout') }}">Sign out</a>
                    </div>
                  </li>
                </ul>
              </li>
            </ul>
          </div>
        </nav>
      </header>