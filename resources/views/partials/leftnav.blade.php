<section class="sidebar">

          <!-- /.search form -->
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
            <li class="{{(Request::is('dashboard*') ? 'active' : '')}} treeview">
              <a href="{{Url()}}/dashboard">
                <i class="fa fa-dashboard"></i> <span>Dashboard</span>
              </a>
            </li>


            <li class="{{(Request::is('students*') ? 'active' : '')}} treeview">
              <a href="/students">
                <i class="fa fa-graduation-cap"></i> <span>Students</span>
              </a>
            </li>        
            <li class="{{(Request::is('marks*') ? 'active' : '')}} treeview">
              <a href="{{ route('marks.index') }}">
                <i class="fa fa-th"></i>
                <span>Marks</span>
              </a>             
            </li>
            <li class="{{(Request::is('faculities*') ? 'active' : '')}} treeview">
              <a href="#">
                <i class="fa fa-university"></i> <span>Faculities</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                
                @foreach($faculities as $faculity)
                <li>
                  <a href="#"><i class="fa fa-caret-right"></i> {!! $faculity->name !!} 
                     {!! ( $faculity->departments)?' <i class="fa fa-angle-left pull-right"></i>':'' !!}

                      <small class="label pull-right bg-green">new</small>
                  </a>
                  

                  @if($departments = $faculity->departments)
                  <!-- Departments -->
                  <ul class="treeview-menu">

                    @foreach($departments as $department)
                    <li>
                      <a href="#"><i class="fa fa-caret-right"></i> {!! $department->name !!}
                        {!! ($department->levels)?' <i class="fa fa-angle-left pull-right"></i>':'' !!}
                      </a>

                     @if($counts = $department->levels) <!-- Department Levels --> 
                       <ul class="treeview-menu">

                         @for($level = 1; $level <= $counts; $level++)
                 
                        <li><a href="{!! route('departments.levels',[$department->id,$level]) !!}"><i class="fa fa-caret-right"></i> Level {!! $level !!}</a></li>
                        
                         @endfor
                      
                      </ul>
                    
                      @endif
                    </li>

                   @endforeach
                  
                  </ul> <!--  End of Departments -->
                 
                 @endif

                </li>
               @endforeach
               
              </ul>
            </li> 

            <li class="{{(Request::is('reports*') ? 'active' : '')}} treeview">
              <a href="/reports">
                <i class="fa fa-bar-chart"></i> 
                <span>Reports</span> 
              </a>
            </li>   
           
            @if (Sentry::check() && Sentry::getUser()->hasAccess('admin'))
            <li {{ (Request::is('users*') ? 'class="active treeview"' : ' treeview') }}>
              <a href="{{ route('sentinel.users.index') }}"> <i class="fa fa-user"></i>Users</a>
            </li>
            <li {{ (Request::is('groups*') ? 'class="active treeview"' : ' treeview') }}>
              <a href="{{ route('sentinel.groups.index') }}"> <i class="fa fa-users"></i>User  Groups</a>
            </li>
           @endif 
            <li class="{{(Request::is('settings*') ? 'active' : '')}} treeview">
              <a href="#">
                <i class="fa fa-cogs"></i> <span>Settings</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu" style="display: block;">
              <li class="{{(Request::is('settings*') ? 'active' : '')}} treeview">
              <a href="{{Url()}}/settings">
                <i class="fa fa-exchange"></i>
                <span>General</span>
              </a>
              
            </li>
                <li class="{{(Request::is('settings.faculities*') ? 'active' : '')}} ">
                  <a href="{!! route('settings.faculities.index') !!}"><i class="fa fa-caret-right"></i> Faculities</a>
                </li>
                <li class="{{(Request::is('settings.departments*') ? 'active' : '')}} ">
                  <a href="{!! route('settings.departments.index') !!}"><i class="fa fa-caret-right"></i> Departments </a>
                </li>
              </ul>
            </li>    
            
            <li class="header">LABELS</li>
            <li><a href="#"><i class="fa fa-circle-o text-danger"></i> Important</a></li>
            <li><a href="#"><i class="fa fa-circle-o text-warning"></i> Warning</a></li>
            <li><a href="#"><i class="fa fa-circle-o text-info"></i> Information</a></li>
          </ul>
        </section>