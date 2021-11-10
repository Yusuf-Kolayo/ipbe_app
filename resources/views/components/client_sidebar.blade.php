<!-- sidebar  -->
<div id="side_nav" class="nk-sidebar nk-sidebar-fixed is-dark" data-content="sidebarMenu">
  <div class="nk-sidebar-element nk-sidebar-head">
      <div class="nk-sidebar-brand">
        <a href="html/index.html" class="logo-link nk-sidebar-logo">
          <img class="logo-light logo-img" src="{{asset('global_assets/images/dap_logo_reversed.png') }}" srcset="{{asset('global_assets/images/dap_logo_reversed.png')}} 2x" alt="logo">
          <img class="logo-dark logo-img" src="{{asset('global_assets/images/logo_light.png')}}" srcset="{{asset('global_assets/images/logo_light.png')}} 2x" alt="logo-dark">
        </a>
      </div>
      <div class="nk-menu-trigger mr-n2">
          <a href="#" class="nk-nav-toggle nk-quick-nav-icon d-xl-none" data-target="sidebarMenu"><em class="icon ni ni-arrow-left"></em></a>
      </div>
  </div><!-- .nk-sidebar-element -->
  <div class="nk-sidebar-element">
      <div class="nk-sidebar-content">
          <div class="nk-sidebar-menu" data-simplebar>
              <ul class="nk-menu">
                  <li class="nk-menu-item">
                      <a href="{{route('dashboard')}}" class="nk-menu-link">
                          <span class="nk-menu-icon"><em class="icon ni ni-growth"></em></span>
                          <span class="nk-menu-text"> Dashboard</span>
                      </a>
                  </li><!-- .nk-menu-item -->
                 


                  <li class="nk-menu-item">
                      <a href="{{ route('client.index') }}" class="nk-menu-link">
                          <span class="nk-menu-icon"><em class="icon ni ni-users"></em></span>
                          <span class="nk-menu-text"> Account Officer</span>
                      </a>
                  </li><!-- .nk-menu-item -->

              

                    <li class="nk-menu-item has-sub">
                      <a href="#" class="nk-menu-link nk-menu-toggle">
                          <span class="nk-menu-icon"> <em class="icon ni ni-cart"></em> </span>
                          <span class="nk-menu-text">Catalog</span>
                      </a>
                      <ul class="nk-menu-sub"> 
                          @foreach ($main_categories as $main_category)
                          <li class="nk-menu-item">
                              <a href="#" class="nk-menu-link nk-menu-toggle"><span class="nk-menu-text"> {{$main_category->cat_name}}</span></a>
                              <ul class="nk-menu-sub">
                                  @foreach ($main_category->children as $item)
                                  <li class="nk-menu-item">
                                      <a href="{{route('product.sub',['sub_category_id'=>$item->id])}}" class="nk-menu-link"><span class="nk-menu-text">{{$item->cat_name}}</span></a>
                                  </li> 
                                  @endforeach
                              </ul>
                          </li> 
                          @endforeach
                      </ul><!-- .nk-menu-sub -->
                  </li><!-- .nk-menu-item -->
                    <li class="nk-menu-item has-sub">
                        <a href="#" class="nk-menu-link nk-menu-toggle ">
                        <span class="nk-menu-icon"><i class="fas fa-cloud pr-2"></i></span>
                        <span class="nk-menu-text"> Target Saving</span>
                        </a> 
                    
                        <ul class="nk-menu-sub"> 
                        <li class="nk-menu-item">
                            <a href="{{ route('target_saving')}}" class="nk-menu-link">
                            <span class="nk-menu-text">Targets </span>
                            </a>
                        </li>
                        <li class="nk-menu-item">
                            <a href="{{ route('target_transaction')}}" class="nk-menu-link">
                            <span class="nk-menu-text">Quick Top-up</span>
                            </a>
                        </li>
                        <li class="nk-menu-item">
                            <a href="{{ route('target_request')}}" class="nk-menu-link">
                            <span class="nk-menu-text">Request Target</span>
                            </a>
                        </li>
            
                        
                        </ul>  
                    </li>
                
              </ul><!-- .nk-menu -->
          </div><!-- .nk-sidebar-menu -->
      </div><!-- .nk-sidebar-content -->
  </div><!-- .nk-sidebar-element -->
</div>