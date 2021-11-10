                <!-- main header  -->
                <div id="top_nav" class="nk-header nk-header-fixed is-light">
                    <div class="container-fluid">
                        <div class="nk-header-wrap">
                            <div class="nk-menu-trigger d-xl-none ml-n1">
                                <a href="#" class="nk-nav-toggle nk-quick-nav-icon" data-target="sidebarMenu"><em class="icon ni ni-menu"></em></a>
                            </div>
                            <div class="nk-header-brand d-xl-none" style="width: 64%;">
                                <a href="dashboard" class="logo-link">
                                    <img class="logo-light logo-img" src="{{asset('global_assets/images/dap_logo_reversed.png') }}"   alt="logo">
                                    <img class="logo-dark logo-img" src="{{asset('global_assets/images/logo_light.png') }}"   alt="logo-dark">
                                </a>
                            </div><!-- .nk-header-brand -->

                            

                         

                            <div class="nk-header-tools">
                                <ul class="nk-quick-nav">
                                    <li class="dropdown user-dropdown" id="">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                            <div class="user-toggle">
                                                <div class="user-avatar sm">
                                                    <em class="icon ni ni-user-alt"></em>
                                                </div>
                                                <div class="user-info d-none d-md-block">
                                                    <div class="user-status">
                                                        @if (auth()->user()->usr_type=='usr_admin')
                                                            Administrator
                                                        @elseif (auth()->user()->usr_type=='usr_agent')
                                                            Agent
                                                        @elseif (auth()->user()->usr_type=='usr_client')
                                                            Client
                                                        @endif
                                                    </div>
                                                    <div class="user-name dropdown-indicator">{{auth()->user()->username}}</div>
                                                </div>
                                            </div>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-md dropdown-menu-right dropdown-menu-s1">
                                            <div class="dropdown-inner user-card-wrap bg-lighter d-none d-md-block">
                                                <div class="user-card">
                                                    <div class="user-avatar sm">
                                                        <em class="icon ni ni-user-alt"></em>
                                                    </div>
                                                    <div class="user-info">
                                                        <span class="lead-text">{{auth()->user()->username}}</span>
                                                        <span class="sub-text">{{auth()->user()->email}}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="dropdown-inner">
                                                <ul class="link-list">
                                                    <li><a href="{{route('my_profile')}}"><em class="icon ni ni-user-alt"></em><span>View Profile</span></a></li>
                                                    <li><a href="html/user-profile-setting.html"><em class="icon ni ni-setting-alt"></em><span>Account Setting</span></a></li>
                                                    <li><a href="html/user-profile-activity.html"><em class="icon ni ni-activity-alt"></em><span>Login Activity</span></a></li>
                                                    <li><a id="theme_switch" class="dark-switch active" href="#"><em class="icon ni ni-moon"></em><span>Dark Mode</span></a></li>                                                </ul>
                                            </div>
                                            <div class="dropdown-inner">
                                                <ul class="link-list">
                                                    <li>  <a class="dropdown-item hover_bg_none" href="{{ route('logout') }}"  
                                                    onclick="event.preventDefault();  document.getElementById('logout-form').submit();">
                                                     <em class="icon ni ni-signout"></em><span>Sign out</span> 
                                                    </a></li>
                                
                                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                                        @csrf
                                                    </form>
                                                </ul>
                                            </div>
                                        </div>
                                    </li><!-- .dropdown -->

                                    <li class="dropdown user-dropdown" id="topnav_msg"></li><!-- .dropdown -->

                                    <li class="dropdown notification-dropdown mr-n1">
                                        <a href="#" class="dropdown-toggle nk-quick-nav-icon" data-toggle="dropdown">
                                            <div class="icon-status icon-status-info"><em class="icon ni ni-bell"></em></div>
                                          @if (count($new_notifications)>0)
                                            <span class="badge badge-danger navbar-badge">{{count($new_notifications)}}</span>
                                          @endif
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-xl dropdown-menu-right dropdown-menu-s1">
                                            <div class="dropdown-head">
                                                <span class="sub-title nk-dropdown-title"> {{count($new_notifications)}} new notifications </span>
                                                <a href="#">Mark All as Read</a>
                                            </div>
                                            <div class="dropdown-body">
                                                <div class="nk-notification">
                                                    @foreach ($new_notifications as $new_notification)
                                                    <div class="nk-notification-item dropdown-inner">
                                                        <a href="{{route('resolve_notification', ['id'=>$new_notification->id])}}">
                                                        <div class="nk-notification-icon">
                                                            <em class="icon icon-circle bg-warning-dim ni ni-curve-down-right"></em>
                                                            <i class="{{$notification_icon_array[$new_notification->type]}}"></i>
                                                        </div>
                                                        <div class="nk-notification-content">
                                                            <div class="nk-notification-text">{!!$new_notification->message!!}</div>
                                                            <div class="nk-notification-time"> {{$new_notification->created_at}}</div>
                                                        </div>
                                                        </a>
                                                    </div>
                                                    @endforeach
                                                </div><!-- .nk-notification -->
                                            </div><!-- .nk-dropdown-body -->
                                            <div class="dropdown-foot center">
                                                <a href="{{route('all_notifications')}}" class="hover_bg_none">View All</a>
                                            </div>
                                        </div>
                                    </li><!-- .dropdown -->










 
                                </ul><!-- .nk-quick-nav -->
                            </div><!-- .nk-header-tools -->
                        </div><!-- .nk-header-wrap -->
                    </div><!-- .container-fliud -->
                </div>