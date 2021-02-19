<!-- Top Menu Start -->
<nav class="header-navbar navbar-expand-lg navbar navbar-with-menu navbar-fixed bg-primary navbar-brand-center">
    <div class="navbar-header d-xl-block d-none">
        <ul class="nav navbar-nav flex-row">
            <li class="nav-item"><a class="navbar-brand" href="index.html">
                <div class="brand-logo"><img class="logo" src="{{asset('admin/images/logo/logo-light.png')}}"></div>
                <h2 class="brand-text mb-0">Frest</h2></a></li>
        </ul>
    </div>
    <div class="navbar-wrapper">
        <div class="navbar-container content">
            <div class="navbar-collapse" id="navbar-mobile">
            <div class="mr-auto float-left bookmark-wrapper d-flex align-items-center">
                <ul class="nav navbar-nav">
                    <li class="nav-item mobile-menu mr-auto"><a class="nav-link nav-menu-main menu-toggle" href="#"><i class="bx bx-menu"></i></a></li>
                </ul>
            </div>
            <ul class="nav navbar-nav float-right d-flex align-items-center">
                <li class="nav-item d-none d-lg-block"><a class="nav-link nav-link-expand"><i class="ficon bx bx-fullscreen"></i></a></li>
                <li class="dropdown dropdown-notification nav-item"><a class="nav-link nav-link-label" href="#" data-toggle="dropdown"><i class="ficon bx bx-bell bx-tada bx-flip-horizontal"></i><span class="badge badge-pill badge-danger badge-up">5</span></a>
                    <ul class="dropdown-menu dropdown-menu-media dropdown-menu-right">
                        <li class="dropdown-menu-header">
                        <div class="dropdown-header px-1 py-75 d-flex justify-content-between"><span class="notification-title">7 new Notification</span><span class="text-bold-400 cursor-pointer">Mark all as read</span></div>
                        </li>
                        <li class="scrollable-container media-list"><a class="d-flex justify-content-between" href="javascript:void(0)">
                            <div class="media d-flex align-items-center">
                            <div class="media-left pr-0">
                                <div class="avatar mr-1 m-0"><img src="{{(!empty($User->user_profile) ? asset('uploads/user_profile/'.$User->user_profile) : asset('admin/images/portrait/small/avatar-admin.png'))}}" alt="avatar" height="39" width="39"></div>
                            </div>
                            <div class="media-body">
                                <h6 class="media-heading"><span class="text-bold-500">Congratulate Socrates Itumay</span> for work anniversaries</h6><small class="notification-text">Mar 15 12:32pm</small>
                            </div>
                            </div></a>
                        <div class="d-flex justify-content-between read-notification cursor-pointer">
                            <div class="media d-flex align-items-center">
                            <div class="media-left pr-0">
                                <div class="avatar mr-1 m-0"><img src="{{(!empty($User->user_profile) ? asset('uploads/user_profile/'.$User->user_profile) : asset('admin/images/portrait/small/avatar-admin.png'))}}" alt="avatar" height="39" width="39"></div>
                            </div>
                            <div class="media-body">
                                <h6 class="media-heading"><span class="text-bold-500">New Message</span> received</h6><small class="notification-text">You have 18 unread messages</small>
                            </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between cursor-pointer">
                            <div class="media d-flex align-items-center py-0">
                            <div class="media-left pr-0"><img class="mr-1" src="{{asset('admin/images/icon/sketch-mac-icon.png')}}" alt="avatar" height="39" width="39"></div>
                            <div class="media-body">
                                <h6 class="media-heading"><span class="text-bold-500">Updates Available</span></h6><small class="notification-text">Sketch 50.2 is currently newly added</small>
                            </div>
                            <div class="media-right pl-0">
                                <div class="row border-left text-center">
                                <div class="col-12 px-50 py-75 border-bottom">
                                    <h6 class="media-heading text-bold-500 mb-0">Update</h6>
                                </div>
                                <div class="col-12 px-50 py-75">
                                    <h6 class="media-heading mb-0">Close</h6>
                                </div>
                                </div>
                            </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between cursor-pointer">
                            <div class="media d-flex align-items-center">
                            <div class="media-left pr-0">
                                <div class="avatar bg-primary bg-lighten-5 mr-1 m-0 p-25"><span class="avatar-content text-primary font-medium-2">LD</span></div>
                            </div>
                            <div class="media-body">
                                <h6 class="media-heading"><span class="text-bold-500">New customer</span> is registered</h6><small class="notification-text">1 hrs ago</small>
                            </div>
                            </div>
                        </div>
                        <div class="cursor-pointer">
                            <div class="media d-flex align-items-center justify-content-between">
                            <div class="media-left pr-0">
                                <div class="media-body">
                                <h6 class="media-heading">New Offers</h6>
                                </div>
                            </div>
                            <div class="media-right">
                                <div class="custom-control custom-switch">
                                <input class="custom-control-input" type="checkbox" checked id="notificationSwtich">
                                <label class="custom-control-label" for="notificationSwtich"></label>
                                </div>
                            </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between cursor-pointer">
                            <div class="media d-flex align-items-center">
                            <div class="media-left pr-0">
                                <div class="avatar bg-danger bg-lighten-5 mr-1 m-0 p-25"><span class="avatar-content"><i class="bx bxs-heart text-danger"></i></span></div>
                            </div>
                            <div class="media-body">
                                <h6 class="media-heading"><span class="text-bold-500">Application</span> has been approved</h6><small class="notification-text">6 hrs ago</small>
                            </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between read-notification cursor-pointer">
                            <div class="media d-flex align-items-center">
                            <div class="media-left pr-0">
                                <div class="avatar mr-1 m-0"><img src="{{asset('admin/images/portrait/small/avatar-s-4.jpg')}}" alt="avatar" height="39" width="39"></div>
                            </div>
                            <div class="media-body">
                                <h6 class="media-heading"><span class="text-bold-500">New file</span> has been uploaded</h6><small class="notification-text">4 hrs ago</small>
                            </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between cursor-pointer">
                            <div class="media d-flex align-items-center">
                            <div class="media-left pr-0">
                                <div class="avatar bg-rgba-danger m-0 mr-1 p-25">
                                <div class="avatar-content"><i class="bx bx-detail text-danger"></i></div>
                                </div>
                            </div>
                            <div class="media-body">
                                <h6 class="media-heading"><span class="text-bold-500">Finance report</span> has been generated</h6><small class="notification-text">25 hrs ago</small>
                            </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between cursor-pointer">
                            <div class="media d-flex align-items-center border-0">
                            <div class="media-left pr-0">
                                <div class="avatar mr-1 m-0"><img src="{{asset('admin/images/portrait/small/avatar-s-16.jpg')}}" alt="avatar" height="39" width="39"></div>
                            </div>
                            <div class="media-body">
                                <h6 class="media-heading"><span class="text-bold-500">New customer</span> comment recieved</h6><small class="notification-text">2 days ago</small>
                            </div>
                            </div>
                        </div>
                        </li>
                        <li class="dropdown-menu-footer"><a class="dropdown-item p-50 text-primary justify-content-center" href="javascript:void(0)">Read all notifications</a></li>
                    </ul>
                </li>
                <li class="dropdown dropdown-user nav-item"><a class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown">
                    <div class="user-nav d-lg-flex d-none"><span class="user-name">{{Auth::user()->name}}</span><span class="user-status">{{!Auth::guest() ? "Available" : ""}}</span></div><span><img class="round" src="{{(!empty($User->user_profile) ? asset('uploads/user_profile/'.$User->user_profile) : asset('admin/images/portrait/small/avatar-admin.png'))}}" alt="avatar" height="40" width="40"></span></a>
                    <div class="dropdown-menu dropdown-menu-right pb-0">
                        <a class="dropdown-item " href="{{route('user.edit.profile')}}"><i class="bx bx-user mr-50"></i> Edit Profile</a>
                        <div class="dropdown-divider mb-0"></div>
                        <a class="dropdown-item" href="{{route('admin.logout')}}"><i class="bx bx-power-off mr-50"></i> Logout</a>
                        {{-- <a onclick="event.preventDefault();document.getElementById('logout-form').submit();" class="dropdown-item" href="{{route('admin.logout')}}"><i class="bx bx-power-off mr-50"></i> Logout</a>
                        <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form> --}}
                    </div>
                </li>
            </ul>
            </div>
        </div>
    </div>
</nav>
<!-- Top Menu End -->

<!-- Navbar Start -->
<div class="header-navbar navbar-expand-sm navbar navbar-horizontal navbar-fixed navbar-light navbar-without-dd-arrow" role="navigation" data-menu="menu-wrapper">
    <div class="navbar-header d-xl-none d-block">
        <ul class="nav navbar-nav flex-row">
            <li class="nav-item mr-auto"><a class="navbar-brand" href="index.html">
                <div class="brand-logo"><img class="logo" src="{{asset('admin/images/logo/logo.png')}}"/></div>
                <h2 class="brand-text mb-0">Frest</h2></a></li>
            <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse"><i class="bx bx-x d-block d-xl-none font-medium-4 primary toggle-icon"></i></a></li>
        </ul>
    </div>
    <div class="shadow-bottom"></div>
    <!-- Horizontal menu content-->
    <div class="navbar-container main-menu-content" data-menu="menu-container">
        <!-- include ../../../includes/mixins-->
        <?php $activeMenu = (!empty($activeMenu) ? $activeMenu : ""); ?>
        <?php $subMenu = (!empty($subMenu) ? $subMenu : ""); ?>
        <ul class="nav navbar-nav" id="main-menu-navigation" data-menu="menu-navigation" data-icon-style="filled">
            <li class="dropdown nav-item {{$activeMenu == "dashboard" ? "active" : ""}}" data-menu="dropdown"><a class="nav-link" href="{{route('admin.dashboard')}}"><i class="bx bx-dashboard"></i><span data-i18n="Dashboard">Dashboard</span></a></li>
            <li class="dropdown nav-item {{$activeMenu == "users" ? "active" : ""}}" data-menu="dropdown"><a class="dropdown-toggle nav-link" href="#" data-toggle="dropdown"><i class="bx bxs-group"></i><span data-i18n="Users">Users</span></a>
                <ul class="dropdown-menu">
                    <li data-menu=""><a class="dropdown-item align-items-center {{$subMenu == "manage_users" ? "active" : ""}}" href="{{route('users')}}" data-toggle="dropdown"><i class="bx bx-right-arrow-alt"></i>Manage Users</a></li>
                    <li data-menu=""><a class="dropdown-item align-items-center {{$subMenu == "manage_roles" ? "active" : ""}}" href="{{route('roles')}}" data-toggle="dropdown"><i class="bx bx-right-arrow-alt"></i>Roles</a></li>
                    <li data-menu=""><a class="dropdown-item align-items-center {{$subMenu == "manage_modules" ? "active" : ""}}" href="{{route('modules')}}" data-toggle="dropdown"><i class="bx bx-right-arrow-alt"></i>Modules</a></li>
                    <li data-menu=""><a class="dropdown-item align-items-center" href="{{route('permissions')}}" data-toggle="dropdown"><i class="bx bx-right-arrow-alt"></i>Permission</a></li>
                </ul>
            </li>
            <li class="dropdown nav-item {{$activeMenu == "plans" ? "active" : ""}}" data-menu="dropdown"><a class="dropdown-toggle nav-link" href="#" data-toggle="dropdown"><i class="bx bxs-notepad"></i><span data-i18n="Plans">Plans</span></a>
                <ul class="dropdown-menu">
                    <li data-menu=""><a class="dropdown-item align-items-center {{$subMenu == "manage_plans" ? "active" : ""}}" href="{{route('plans')}}" data-toggle="dropdown"><i class="bx bx-right-arrow-alt"></i>Plans</a></li>
                    <li data-menu=""><a class="dropdown-item align-items-center {{$subMenu == "manage_plan_types" ? "active" : ""}}" href="{{route('plans.types')}}" data-toggle="dropdown"><i class="bx bx-right-arrow-alt"></i>Plan Types</a></li>
                    <li data-menu=""><a class="dropdown-item align-items-center {{$subMenu == "manage_plan_features" ? "active" : ""}}" href="{{route('plan.feature')}}" data-toggle="dropdown"><i class="bx bx-right-arrow-alt"></i>Plan Features</a></li>
                </ul>
            </li>
            <li class="dropdown nav-item {{$activeMenu == "settings" ? "active" : ""}}" data-menu="dropdown"><a class="dropdown-toggle nav-link" href="#" data-toggle="dropdown"><i class="bx bxs-cog"></i><span data-i18n="Settings">Settings</span></a>
                <ul class="dropdown-menu">
                    <li data-menu=""><a class="dropdown-item align-items-center {{$subMenu == "manage_sms_templates" ? "active" : ""}}" href="{{route('sms.templates')}}" data-toggle="dropdown"><i class="bx bx-right-arrow-alt"></i>SMS Templates</a></li>
                    <li data-menu=""><a class="dropdown-item align-items-center {{$subMenu == "manage_email_templates" ? "active" : ""}}" href="{{route('email.templates')}}" data-toggle="dropdown"><i class="bx bx-right-arrow-alt"></i>Email Templates</a></li>
                    <li data-menu=""><a class="dropdown-item align-items-center {{$subMenu == "manage_site_settings" ? "active" : ""}}" href="{{route('settings')}}" data-toggle="dropdown"><i class="bx bx-right-arrow-alt"></i>Site Settings</a></li>
                    <li data-menu=""><a class="dropdown-item align-items-center {{$subMenu == "site_logs" ? "active" : ""}}" href="{{route('logs')}}" data-toggle="dropdown"><i class="bx bx-right-arrow-alt"></i>Site Logs</a></li>
                </ul>
            </li>
        </ul>
    </div>
    <!-- /horizontal menu content-->
</div>
<!-- Navbar End -->