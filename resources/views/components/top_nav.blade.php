  <!-- Top Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      
    </ul>
 
    
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        
      <!-- Messages Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#" style="padding: .2rem 1rem;">
            <div class="image" style="width:30px;">
                <img src=" {{ asset('images/avatar_dummy.png') }}" class="img-circle img-fluid" alt="User Image" style="border: 2px solid #2196f3; padding: 1px;"> 
            </div> 
        </a>
        <div class="dropdown-menu dropdown-menu-sm dropdown-menu-left">
              
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto d-block">
                        <!-- Authentication Links -->
                        @agent
                            <li class="nav-item mt-2">
                                <a class="dropdown-item" href="{{route('my_profile')}}"> My Profile  </a>
                            </li>
                        @endagent

                        @client
                        <li class="nav-item mt-2">
                            <a class="dropdown-item" href="{{route('my_profile')}}"> My Profile  </a>
                        </li>
                        @endclient

                        <li class="nav-item mt-2">  
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form> 
                        </li>
                       
                    </ul>
        </div>
      </li>
    
        <!-- Messages Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-comments"></i>
          <span class="badge badge-danger navbar-badge">3</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <a href="#" class="dropdown-item">   
            <!-- Message Start -->
            <div class="media">
              <img src=" {{ asset('css/dist/img/user1-128x128.jpg') }} " alt="User Avatar" class="img-size-50 mr-3 img-circle">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  Brad Diesel
                  <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">Call me whenever you can...</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src=" {{ asset('css/dist/img/user8-128x128.jpg') }}" alt="User Avatar" class="img-size-50 img-circle mr-3">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  John Pierce
                  <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">I got your message bro</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div> 
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src=" {{ asset('css/dist/img/user3-128x128.jpg') }}" alt="User Avatar" class="img-size-50 img-circle mr-3">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  Nora Silvester
                  <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">The subject goes here</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
        </div>
      </li>
      <!-- Notifications Dropdown Menu -->
  
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          @if (count($new_notifications)>0)
            <span class="badge badge-warning navbar-badge">{{count($new_notifications)}}</span>
          @endif
         
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header"> {{count($new_notifications)}} new notifications </span>
  
          <div class="dropdown-divider"></div>
          @foreach ($new_notifications as $new_notification)
          <a href="{{route('resolve_notification', ['id'=>$new_notification->id])}}" class="dropdown-item note_each">
             <i class="{{$notification_icon_array[$new_notification->type]}}"></i> {!!$new_notification->message!!}
            <span class="float-right text-muted text-sm"> {{$new_notification->created_at}} </span>
          </a> <div class="dropdown-divider"></div>
          @endforeach 
          <a href="{{route('all_notifications')}}" class="dropdown-item dropdown-footer">See All Notifications</a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
          <i class="fas fa-th-large"></i>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->