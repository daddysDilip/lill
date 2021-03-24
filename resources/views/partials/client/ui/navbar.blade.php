<div class="menu-overlay"></div>
<div class="border-bottom bg-white pt-1 pb-1 pt-lg-2 pb-lg-2">
    <div class="container clearfix">
        <div class="row align-items-center no-gutter justify-content-between">
            <div class="col-lg-2 col-5 d-flex align-items-center">
                <div role="button" class="mobile-menu-trigger js-menu-trigger hidden-lg visible-sm visible-xs">
                    <span></span>
                </div>
                @if(Auth::guard('user')->user() != null)
                    <a href="{{url('/user-dashboard')}}" class="brand-logo">
                @else     
                    <a href="{{url('/')}}" class="brand-logo">
                @endif
                    <img src="{{!empty(get_setting_option('site_logo')->value) ? asset('client/images/'.get_setting_option('site_logo')->value) : ''}}" />
                </a>
            </div>
            <div class="col-lg-7 col-0 header-middle main-nav menu-close">
                <ul class="nav-list d-xl-flex align-items-center">
                    <li class="nav-list__item">
                        <a href="{{route('about')}}">About lill</a>
                    </li>
                    {{-- <li class="nav-list__item">
                        <a href="#">Features</a>
                    </li> --}}
                    {{-- {{Route::currentRouteName()}} --}}
                    <li class="nav-list__item"><a href="{{route('pricing')}}" class="{{Route::currentRouteName() == "pricing" ? "active":""}}">Pricing</a></li>
                    <li class="nav-list__item">
                        <a href="#" class="{{Route::currentRouteName() == "faq" || Route::currentRouteName() == "privacy.and.policy" || Route::currentRouteName() == "terms.and.conditions" ? "active":""}}">Resources</a>
                        <span class="sub-child"><i class="plus-child"></i></span>
                        <div class="dropdown_menu p-xl-3">
                            <ul class="nav-list-sub-inner">
                                <li class="border-bottom">
                                    <a class="media d-flex align-items-center {{Route::currentRouteName() == "faq" ? "active":""}}" href="{{route('faq')}}">
                                        <div class="media-body">
                                            <h5 class="mt-0 mb-1">FAQs</h5>
                                            FAQs and help articles
                                        </div>
                                    </a>
                                </li>
                                <li class="border-bottom">
                                    <a class="media d-flex align-items-center" href="{{route('privacy.and.policy')}}">
                                        <div class="media-body">
                                            <h5 class="mt-0 mb-1">Privacy policy</h5>
                                            User data privacy policy
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a class="media d-flex align-items-center" href="{{route('terms.and.conditions')}}">
                                        <div class="media-body">
                                            <h5 class="mt-0 mb-1">Term & Conditions</h5>
                                            Facility terms and conditions
                                        </div>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                </ul>
                <!-- / .main-nav -->
            </div>
            <div class="col-lg-3 col-7 text-right">
                <ul class="header-right-block d-flex align-items-center justify-content-between">
                    <li>
                        <button class="btn btn-theme" data-toggle="modal" data-target="#GetCallModal">Get a Quote</button>
                    </li>
                    @if(Auth::guard('user')->user() != null)
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
                    @else
                        <li>
                            <a href="{{url('signin')}}">Login</a>
                        </li>
                        <li>
                            <a href="{{url('signup')}}">Sign up</a>
                        </li>

                    
                    @endif
                </ul>
            </div>
        </div>
    </div>
</div>