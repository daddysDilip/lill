<div class="border-bottom pt-1 pb-1">
    <div class="container clearfix">
        <div class="row align-items-center justify-content-between no-gutter">
            <div class="col-lg-2 col-6">
                <div role="button" class="mobile-menu-trigger js-menu-trigger hidden-lg visible-sm visible-xs">
                    <span></span>
                </div>
                <a href="{{route('user.dashboard')}}" class="brand-logo">
                    <img src="{{asset('client/images/logo.png')}}">
                </a>
            </div>
            <div class="col-lg-8 col-6 header-middle main-nav menu-close">
                    <ul class="nav-list d-xl-flex align-items-center">
                        <li class="nav-list__item dropdown">
                            <button class="btn btn-link dropdown-toggle" type="button" id="linksMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Links
                            </button>
                            <div class="dropdown-menu" aria-labelledby="linksMenuButton">
                                <a class="dropdown-item" href="{{ route('create.link') }}">Create Link</a>
                                <a class="dropdown-item" href="{{ route('user.links.groups') }}">Link Groups</a>
                                <a class="dropdown-item" href="{{ route('user.bulk.links') }}">Create Bulk Links</a>
                            </div>
                        </li>
                        <li class="nav-list__item">
                            <a href="#">Workspaces</a>
                        </li>
                        <li class="nav-list__item">
                            <a href="#">Pricing</a>
                        </li>
                    </ul>
                <!-- / .main-nav -->
            </div>
            <div class="col-lg-2 col-6 text-right">
                <ul class="header-right-block d-flex align-items-center justify-content-between">
                    <li>
                        <div class="dropdown">
                            <button class="btn btn-link theme-color dropdown-toggle d-flex align-items-center" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="sprite ball-icon"></i>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item media" href="#">
                                    <img src="{{asset('client/images/notification.png')}}" class="mr-3" />
                                    <div class="media-body">
                                        <h5 class="mt-0 mb-1">List-based media object</h5>
                                        Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                                    </div>
                                </a>
                                <a class="dropdown-item media" href="#">
                                    <img src="{{asset('client/images/notification.png')}}" class="mr-3" />
                                    <div class="media-body">
                                        <h5 class="mt-0 mb-1">List-based media object</h5>
                                        Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                                    </div>
                                </a>
                                <a class="dropdown-item media" href="#">
                                    <img src="{{asset('client/images/notification.png')}}" class="mr-3" />
                                    <div class="media-body">
                                        <h5 class="mt-0 mb-1">List-based media object</h5>
                                        Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                                    </div>
                                </a>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="dropdown">
                            <button class="btn btn-link dropdown-toggle d-flex align-items-center" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img src="{{asset('client/images/user-avatar.png')}}" width="25px" />
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
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