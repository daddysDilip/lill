<!-- Top Menu Start -->
<nav class="header-navbar navbar-expand-lg navbar navbar-with-menu navbar-fixed bg-primary navbar-brand-center">
    <div class="navbar-header d-xl-block d-none">
        <ul class="nav navbar-nav flex-row">
            <li class="nav-item">
                <a class="navbar-brand" href="{{url('admin-dashboard')}}">
                    <div class="brand-logo"><img class="logo" src="{{asset('client/images/logo.png')}}"></div>
                </a>
            </li>
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
                
                <li class="dropdown dropdown-user nav-item"><a class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown">
                    <div class="user-nav d-lg-flex d-none"><span class="user-name">{{Auth::guard('admin')->user()->first_name." ".Auth::guard('admin')->user()->first_name}}</span><span class="user-status">{{!Auth::guard('admin')->user()->id ? "Available" : ""}}</span></div><span><img class="round" src="{{(!empty($User->user_profile) ? asset('uploads/user_profile/'.$User->user_profile) : asset('admin/images/portrait/small/avatar-admin.png'))}}" alt="avatar" height="40" width="40"></span></a>
                    <div class="dropdown-menu dropdown-menu-right pb-0">
                        <a class="dropdown-item " style="display:{{!get_user_permission("edit_profile","view") ? "none" : ""}}" href="{{route('user.edit.profile')}}"><i class="bx bx-user mr-50"></i> Edit Profile</a>
                        <div class="dropdown-divider mb-0"></div>
                        <a class="dropdown-item" href="{{route('admin.logout')}}"><i class="bx bx-power-off mr-50"></i> Logout</a>
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
            <li class="dropdown nav-item {{$activeMenu == "dashboard" ? "active" : ""}}" style="display:{{!get_user_permission("dashboard","view") ? "none" : ""}}" data-menu="dropdown"><a class="nav-link" href="{{url('admin-dashboard')}}"><i class="bx bx-dashboard"></i><span data-i18n="Dashboard">Dashboard</span></a></li>
            <li class="dropdown nav-item {{$activeMenu == "users" ? "active" : ""}}" data-menu="dropdown"><a class="dropdown-toggle nav-link" href="#" data-toggle="dropdown"><i class="bx bxs-group"></i><span data-i18n="Users">Users</span></a>
                <ul class="dropdown-menu">
                    <li data-menu="" style="display:{{!get_user_permission("manage_users","view") ? "none" : ""}}"><a class="dropdown-item align-items-center {{$subMenu == "manage_users" ? "active" : ""}}" href="{{route('users')}}" data-toggle="dropdown"><i class="bx bx-right-arrow-alt"></i>Manage Users</a></li>
                    
                </ul>
            </li>
            <li class="dropdown nav-item {{$activeMenu == "plans" ? "active" : ""}}" data-menu="dropdown"><a class="dropdown-toggle nav-link" href="#" data-toggle="dropdown"><i class="bx bxs-notepad"></i><span data-i18n="Plans">Plans</span></a>
                <ul class="dropdown-menu">
                    <li data-menu="" style="display:{{!get_user_permission("manage_plans","view") ? "none" : ""}}"><a class="dropdown-item align-items-center {{$subMenu == "manage_plans" ? "active" : ""}}" href="{{route('plans')}}" data-toggle="dropdown"><i class="bx bx-right-arrow-alt"></i>Plans</a></li>
                    <li data-menu="" style="display:{{!get_user_permission("manage_plan_type","view") ? "none" : ""}}"><a class="dropdown-item align-items-center {{$subMenu == "manage_plan_types" ? "active" : ""}}" href="{{route('plans.types')}}" data-toggle="dropdown"><i class="bx bx-right-arrow-alt"></i>Plan Types</a></li>
                    <li data-menu="" style="display:{{!get_user_permission("manage_plan_features","view") ? "none" : ""}}"><a class="dropdown-item align-items-center {{$subMenu == "manage_plan_features" ? "active" : ""}}" href="{{route('plan.feature')}}" data-toggle="dropdown"><i class="bx bx-right-arrow-alt"></i>Plan Features</a></li>
                </ul>
            </li>
            <li class="dropdown nav-item {{$activeMenu == "customers" ? "active" : ""}}" data-menu="dropdown"><a class="dropdown-toggle nav-link" href="#" data-toggle="dropdown"><i class="bx bxs-notepad"></i><span data-i18n="Plans">Reports</span></a>
                <ul class="dropdown-menu">
                    <li data-menu="" style="display:{{!get_user_permission("manage_customers","view") ? "none" : ""}}"><a class="dropdown-item align-items-center {{$subMenu == "manage_customers" ? "active" : ""}}" href="{{route('customers')}}" data-toggle="dropdown"><i class="bx bx-right-arrow-alt"></i>Customers</a></li>
                    <li data-menu="" style="display:{{!get_user_permission("manage_customer_enquiry","view") ? "none" : ""}}"><a class="dropdown-item align-items-center {{$subMenu == "manage_customer_enquiry" ? "active" : ""}}" href="{{route('manage.customer.enquiry')}}" data-toggle="dropdown"><i class="bx bx-right-arrow-alt"></i>Customer Enquiry</a></li>
                </ul>
            </li>
            <li class="dropdown nav-item {{$activeMenu == "settings" ? "active" : ""}}" data-menu="dropdown"><a class="dropdown-toggle nav-link" href="#" data-toggle="dropdown"><i class="bx bxs-cog"></i><span data-i18n="Settings">Settings</span></a>
                <ul class="dropdown-menu">
                    <li data-menu="" style="display:{{!get_user_permission("manage_email_template","view") ? "none" : ""}}"><a class="dropdown-item align-items-center {{$subMenu == "manage_sms_templates" ? "active" : ""}}" href="{{route('sms.templates')}}" data-toggle="dropdown"><i class="bx bx-right-arrow-alt"></i>SMS Templates</a></li>
                    <li data-menu="" style="display:{{!get_user_permission("manage_sms_template","view") ? "none" : ""}}"><a class="dropdown-item align-items-center {{$subMenu == "manage_email_templates" ? "active" : ""}}" href="{{route('email.templates')}}" data-toggle="dropdown"><i class="bx bx-right-arrow-alt"></i>Email Templates</a></li>
                    <li data-menu="" style="display:{{!get_user_permission("manage_site_settings","view") ? "none" : ""}}"><a class="dropdown-item align-items-center {{$subMenu == "manage_site_settings" ? "active" : ""}}" href="{{route('settings')}}" data-toggle="dropdown"><i class="bx bx-right-arrow-alt"></i>Site Settings</a></li>
                    <li data-menu="" style="display:{{!get_user_permission("manage_site_logs","view") ? "none" : ""}}"><a class="dropdown-item align-items-center {{$subMenu == "site_logs" ? "active" : ""}}" href="{{route('logs')}}" data-toggle="dropdown"><i class="bx bx-right-arrow-alt"></i>Site Logs</a></li>
                    <li data-menu="" style="display:{{!get_user_permission("manage_site_logs","view") ? "none" : ""}}"><a class="dropdown-item align-items-center {{$subMenu == "manage_faq" ? "active" : ""}}" href="{{route('manage.faq')}}" data-toggle="dropdown"><i class="bx bx-right-arrow-alt"></i>Site FAQ</a></li>
                    <li data-menu="" style="display:{{!get_user_permission("manage_roles","view") ? "none" : ""}}"><a class="dropdown-item align-items-center {{$subMenu == "manage_roles" ? "active" : ""}}" href="{{route('roles')}}" data-toggle="dropdown"><i class="bx bx-right-arrow-alt"></i>User Roles</a></li>
                    <li data-menu="" style="display:{{!get_user_permission("manage_modules","view") ? "none" : ""}}"><a class="dropdown-item align-items-center {{$subMenu == "manage_modules" ? "active" : ""}}" href="{{route('modules')}}" data-toggle="dropdown"><i class="bx bx-right-arrow-alt"></i>User Modules</a></li>
                    <li data-menu="" style="display:{{!get_user_permission("manage_permissions","view") ? "none" : ""}}"><a class="dropdown-item align-items-center" href="{{route('permissions')}}" data-toggle="dropdown"><i class="bx bx-right-arrow-alt"></i>User Permission</a></li>
                    {{-- <li data-menu="" style="display:{{!get_user_permission("manage_link_types","view") ? "none" : ""}}"><a class="dropdown-item align-items-center {{$subMenu == "manage_link_types" ? "active" : ""}}" href="{{route('manage.link.types')}}" data-toggle="dropdown"><i class="bx bx-right-arrow-alt"></i>Link Types</a></li> --}}
                </ul>
            </li>
        </ul>
    </div>
    <!-- /horizontal menu content-->
</div>
<!-- Navbar End -->