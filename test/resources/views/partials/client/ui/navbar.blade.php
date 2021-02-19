<div class="menu-overlay"></div>
<div class="border-bottom bg-white pt-1 pb-1 pt-lg-2 pb-lg-2">
    <div class="container clearfix">
        <div class="row align-items-center no-gutter justify-content-between">
            <div class="col-lg-2 col-5 d-flex align-items-center">
                <div role="button" class="mobile-menu-trigger js-menu-trigger hidden-lg visible-sm visible-xs">
                    <span></span>
                </div>
                <a href="index.html" class="brand-logo">
                    <img src="{{asset('client/images/logo.svg')}}">
                </a>
            </div>
            <div class="col-lg-7 col-0 header-middle main-nav menu-close">
                    <ul class="nav-list d-xl-flex align-items-center">
                        <li class="nav-list__item">
                            <a href="#">why shortly?</a>
                            <span class="sub-child"><i class="plus-child"></i></span>
                            <div class="dropdown_menu p-xl-3">
                                <ul class="nav-list-sub-inner">
                                    <li class="border-bottom">
                                        <a class="media d-flex align-items-center" href="#">
                                            <img width="15" src="{{asset('client/images/navigation/nav-icon1.svg')}}" />
                                            <div class="media-body ml-3">
                                                <h5 class="mt-0 mb-1">Shitly 101</h5>
                                                An Introduction to Shitly features
                                            </div>
                                        </a>
                                    </li>
                                    <li class="border-bottom">
                                        <a class="media d-flex align-items-center" href="#">
                                            <img width="20" src="{{asset('client/images/navigation/nav-icon2.svg')}}" />
                                            <div class="media-body ml-3">
                                                <h5 class="mt-0 mb-1">Integrations & API</h5>
                                                Connect Shitly with tools you love
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="media d-flex align-items-center" href="#">
                                            <img width="20" src="{{asset('client/images/navigation/nav-icon3.svg')}}" />
                                            <div class="media-body ml-3">
                                                <h5 class="mt-0 mb-1">Enterprise Class</h5>
                                                Shitly scales to the size you need
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-list__item">
                            <a href="#">Solutions</a>
                        </li>
                        <li class="nav-list__item">
                            <a href="#">Features</a>
                        </li>
                        <li class="nav-list__item"><a href="pricing.html">Pricing</a></li>
                        <li class="nav-list__item">
                            <a href="#">Resources</a>
                            <span class="sub-child"><i class="plus-child"></i></span>
                            <div class="dropdown_menu p-xl-3">
                                <div class="row no-gutter">
                                    <div class="col-xl-6">
                                        <ul class="nav-list-sub-inner border-right">
                                            <li class="border-bottom">
                                                <a class="media d-flex align-items-center" href="#">
                                                    <div class="media-body">
                                                        <h5 class="mt-0 mb-1">Blog</h5>
                                                        Tips, best practices and more
                                                    </div>
                                                </a>
                                            </li>
                                            <li>
                                                <a class="media d-flex align-items-center" href="#">
                                                    <div class="media-body">
                                                        <h5 class="mt-0 mb-1">Developers</h5>
                                                        API Documentations and
                                                        Resources
                                                    </div>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="col-xl-6">
                                        <ul class="nav-list-sub-inner">
                                            <li class="border-bottom">
                                                <a class="media d-flex align-items-center" href="#">
                                                    <div class="media-body">
                                                        <h5 class="mt-0 mb-1">Resource Library</h5>
                                                        Ebooks and webinars
                                                    </div>
                                                </a>
                                            </li>
                                            <li>
                                                <a class="media d-flex align-items-center" href="#">
                                                    <div class="media-body">
                                                        <h5 class="mt-0 mb-1">Support</h5>
                                                        FAQs and help articles
                                                    </div>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                <!-- / .main-nav -->
            </div>
            <div class="col-lg-3 col-7 text-right">
                <ul class="header-right-block d-flex align-items-center justify-content-between">
                    <li>
                        <a href="{{route('user.signin')}}">Login</a>
                    </li>
                    <li>
                        <a href="{{url('register')}}">Sign up</a>
                    </li>
                    <li>
                        <button class="btn btn-theme">Get a Quote</button>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>