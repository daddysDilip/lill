<div class="border-bottom pt-1 pb-1">
   <div class="container clearfix">
      <div class="row align-items-center justify-content-between no-gutter">
         <div class="col-lg-2 col-6">
            <div role="button" class="mobile-menu-trigger js-menu-trigger hidden-lg visible-sm visible-xs">
               <span></span>
            </div>
            <a href="{{route('user.dashboard')}}" class="brand-logo">
            <img src="{{asset('client/images/logo.png')}}" class="brand-logo-mobile">
            </a>
         </div>
         <div class="col-lg-6 col-6 header-middle main-nav menu-close">
            <ul class="nav-list d-xl-flex align-items-center">
               <li class="nav-list__item dropdown">
                  <a class="btn btn-link {{Route::currentRouteName() == "create.link" || Route::currentRouteName() == "user.links.groups" || Route::currentRouteName() == "user.bulk.links" ? "active":""}}" id="linksMenuButton">
                  Links
                  </a>
                  <div class="dropdown_menu p-0">
                     <ul class="nav-list-sub-inner">
                        <li class="border-bottom">
                           <a class="media d-flex align-items-center" href="{{ route('create.link') }}">
                              <img src="http://lill.pw/client/images/navigation/nav-icon1.svg" width="15">
                              <div class="media-body ml-3">
                                 <h5 class="mt-0 mb-1">Create Link</h5>
                                 An Introduction to Lill features
                              </div>
                           </a>
                        </li>
                        <li class="border-bottom">
                           <a class="media d-flex align-items-center" href="{{ route('user.links.groups') }}">
                              <img src="http://lill.pw/client/images/navigation/nav-icon2.svg" width="20">
                              <div class="media-body ml-3">
                                 <h5 class="mt-0 mb-1">Link Groups</h5>
                                 Manage group of links
                              </div>
                           </a>
                        </li>
                        <li>
                           <a class="media d-flex align-items-center" href="{{ route('user.bulk.links') }}">
                              <img src="http://lill.pw/client/images/navigation/nav-icon2.svg" width="20">
                              <div class="media-body ml-3">
                                 <h5 class="mt-0 mb-1">Bulk Links</h5>
                                 Import / Export Bulk Links
                              </div>
                           </a>
                        </li>
                     </ul>
                  </div>
               </li>
              {{--  <li class="nav-list__item">
                  <a href="{{ route('chart.report') }}">Chart View</a>
               </li>
               <li class="nav-list__item">
                  <a href="{{ route('link.report') }}">Links Detail</a>
               </li> --}}

               <li class="nav-list__item dropdown">
                  <a class="btn btn-link {{Route::currentRouteName() == "link.report" || Route::currentRouteName() == "user.account.settings" || Route::currentRouteName() == "user.account.settings" || Route::currentRouteName() == "chart.report" ? "active":""}}">
                  Reports
                  </a>
                  <div class="dropdown_menu p-0">
                     <ul class="nav-list-sub-inner">
                        <li class="border-bottom">
                           <a class="media d-flex align-items-center" href="{{ route('link.report') }}">
                              <img src="{{asset('client/images/navigation/nav-icon4.svg')}}" width="15">
                              <div class="media-body ml-3">
                                 <h5 class="mt-0 mb-1">Links List</h5>
                                 An Introduction to Lill features
                              </div>
                           </a>
                        </li>
                        <li class="border-bottom">
                           <a class="media d-flex align-items-center" href="{{route('user.account.settings','favorite-links')}}">
                              <img src="{{asset('client/images/navigation/nav-icon5.svg')}}" width="20">
                              <div class="media-body ml-3">
                                 <h5 class="mt-0 mb-1">Favourite links</h5>
                                 Connect Lill with tools you love
                              </div>
                           </a>
                        </li>
                        <li class="border-bottom">
                           <a class="media d-flex align-items-center" href="{{route('user.account.settings','hidden-links')}}">
                              <img src="{{asset('client/images/navigation/nav-icon5.svg')}}" width="20">
                              <div class="media-body ml-3">
                                 <h5 class="mt-0 mb-1">Hidden links</h5>
                                 Connect Lill with tools you love
                              </div>
                           </a>
                        </li>
                        <li>
                           <a class="media d-flex align-items-center" href="{{ route('chart.report') }}">
                              <img src="{{asset('client/images/navigation/nav-icon6.svg')}}" width="20">
                              <div class="media-body ml-3">
                                 <h5 class="mt-0 mb-1">Links details</h5>
                                 Details with charts
                              </div>
                           </a>
                        </li>
                     </ul>
                  </div>
               </li>
               <li class="d-lg-none d-md-none nav-list__item">
               <a href="{{ route('create.link') }}">Create Link</a>
               </li >
               <li class="d-lg-none d-md-none nav-list__item">
               <a href="{{ route('pricing') }}">Upgrade Plan</a>
               </li>
            </ul>
            <!-- / .main-nav -->
         </div>
         <div class="col-lg-4 col-6 text-right">
            <ul class="header-right-block d-flex align-items-center  justify-content-end">
               <li class="d-none d-md-block d-lg-block">
                  <a href="{{ route('create.link') }}"><button class="btn btn-theme mr-2" >Create Link</button></a>
               <li class="d-none d-md-block d-lg-block">
                  <a href="{{ route('pricing') }}"><button class="btn btn-theme">Upgrade Plan</button></a>
               </li>
   
               <li>
                  <div class="dropdown">
                      <button class="btn btn-link dropdown-toggle d-flex align-items-center" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          <img src="{{asset('client/images/user-avatar.png')}}" width="25px" />
                      </button>
                      <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                          <a class="dropdown-item" href="{{ route('user.account.settings','account-details') }}">Account Settings</a>
                          <a class="dropdown-item" href="{{ route('user.logout') }}">Logout</a>
                      </div>
                  </div>
                  </li>
            </ul>
         </div>
      </div>
   </div>
</div>