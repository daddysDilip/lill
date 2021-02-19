@extends('layouts.admin_layout')
@section('title')
    My Account
@endsection
@section('content')
    <!-- BEGIN: Content-->
    <div class="app-content content">
      <div class="content-overlay"></div>
        <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-12 mb-2 mt-1">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h5 class="content-header-title float-left pr-1 mb-0">Account Settings</h5>
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb p-0 mb-0">
                                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}"><i class="bx bx-home-alt"></i></a>
                                </li>
                                <li class="breadcrumb-item"><a href="#">User</a>
                                </li>
                                <li class="breadcrumb-item active"> Account Settings
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body"><!-- account setting page start -->
            <section id="page-account-settings">
                <div class="row">
                    <div class="col-12">
                        <div class="row">
                            <!-- left menu section -->
                            <div class="col-md-3 mb-2 mb-md-0 pills-stacked">
                                <ul class="nav nav-pills flex-column">
                                    <li class="nav-item">
                                        <a class="nav-link d-flex align-items-center {{$subMenu == "general" ? "active" : ""}}" id="account-pill-general" data-toggle="pill"
                                            href="#account-vertical-general" aria-expanded="true">
                                            <i class="bx bx-cog"></i>
                                            <span>General</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link d-flex align-items-center {{$subMenu == "change_password" ? "active" : ""}}" id="account-pill-password" data-toggle="pill"
                                            href="#account-vertical-password" aria-expanded="false">
                                            <i class="bx bx-lock"></i>
                                            <span>Change Password</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <!-- right content section -->
                            <div class="col-md-9">
                                <div class="card">
                                    <?php $User = Auth::guard('admin')->user(); ?>
                                    <div class="card-content">
                                        <div class="card-body">
                                            <div class="tab-content">
                                                @include('tools.flash-message')
                                                
                                                <div role="tabpanel" class="tab-pane show {{$subMenu == "general" ? "active" : ""}}" id="account-vertical-general"
                                                    aria-labelledby="account-pill-general" aria-expanded="true">
                                                    <form id="EditProfile" action="{{ route('user.update.profile', $User->id) }}" enctype="multipart/form-data" method="POST">
                                                    @csrf
                                                        <div class="media">
                                                            <a href="javascript: void(0);">
                                                                <img src="{{(!empty($User->user_profile) ? asset('uploads/user_profile/'.$User->user_profile) : asset('admin/images/portrait/small/avatar-admin.png'))}}"
                                                                    class="rounded mr-75" alt="profile image" height="64" width="64">
                                                            </a>
                                                            <div class="media-body mt-25">
                                                                <div class="col-12 px-0 d-flex flex-sm-row flex-column justify-content-start">
                                                                    <label for="select-files" class="btn btn-sm btn-light-primary ml-50 mb-50 mb-sm-0">
                                                                        <span>Upload new photo</span>
                                                                        <input id="select-files" name="user_profile" type="file">
                                                                    </label>
                                                                    <button class="btn btn-sm btn-light-secondary ml-50">Reset</button>
                                                                </div>
                                                                <p class="text-muted ml-1 mt-50">
                                                                    <small>Allowed JPG, GIF or PNG. Max size of 800kB</small>
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <hr>
                                                        <div class="row">
                                                            <div class="col-md-6 col-12">
                                                                <div class="form-group">
                                                                    <div class="controls">
                                                                        <label>Firstname</label>
                                                                        <input type="text" value="{{$User->firstname ?? ''}}" name="firstname" class="form-control" placeholder="Enter firstname"
                                                                            required
                                                                            data-validation-required-message="This firstname field is required">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6 col-12">
                                                                <div class="form-group">
                                                                    <div class="controls">
                                                                        <label>Lastname</label>
                                                                        <input type="text" value="{{$User->lastname ?? ''}}" name="lastname" class="form-control" placeholder="Enter lastname"
                                                                            required
                                                                            data-validation-required-message="This lastname field is required">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6 col-12">
                                                                <div class="form-group">
                                                                    <div class="controls">
                                                                        <label>E-mail</label>
                                                                        <input type="email" value="{{$User->email ?? ''}}" name="email" class="form-control" placeholder="Email"
                                                                            required
                                                                            data-validation-required-message="This email field is required">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6 col-12">
                                                                <div class="form-group">
                                                                    <div class="controls">
                                                                        <label>Contact No</label>
                                                                        <input type="text" value="{{$User->contactno ?? ''}}" name="contactno" class="form-control" placeholder="Enter contactno"
                                                                            required
                                                                            data-validation-required-message="This contact-no field is required">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4 col-12">
                                                                <div class="form-group">
                                                                    <label for="first-name-vertical">Country</label>
                                                                    <select name="country" id="country" class="form-control">
                                                                        <option value="">---Choose Country---</option>
                                                                        @if (!empty(get_country()))
                                                                            @foreach (get_country() as $country)
                                                                                <option value="{{$country->id}}" {{ isset($User) ? (($User->country == $country->id) ? 'selected' : '') : '' }}>{{$country->name}}</option>
                                                                            @endforeach
                                                                        @endif
                                                                    </select>
                                                                    @error('country')
                                                                        <div class="alert alert-danger">{{ $message }}</div>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4 col-12">
                                                                <div class="form-group">
                                                                    <label for="first-name-vertical">State</label>
                                                                    <select name="state" id="state" class="form-control">
                                                                        <option value="">---Choose State---</option>
                                                                        @if (!empty($User) && !empty(get_state()))
                                                                            @foreach (get_state() as $state)
                                                                                <option value="{{$state->id}}" {{ isset($User) ? (($User->state == $state->id) ? 'selected' : '') : '' }}>{{$state->name}}</option>
                                                                            @endforeach
                                                                        @endif
                                                                    </select>
                                                                    @error('state')
                                                                        <div class="alert alert-danger">{{ $message }}</div>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4 col-12">
                                                                <div class="form-group">
                                                                    <label for="first-name-vertical">City</label>
                                                                    <select name="city" id="city" class="form-control">
                                                                        <option value="">---Choose City---</option>
                                                                        @if (!empty($User) && !empty(get_city()))
                                                                            @foreach (get_city() as $city)
                                                                                <option value="{{$city->id}}" {{ isset($User) ? (($User->city == $city->id) ? 'selected' : '') : '' }}>{{$city->name}}</option>
                                                                            @endforeach
                                                                        @endif
                                                                    </select>
                                                                    @error('city')
                                                                        <div class="alert alert-danger">{{ $message }}</div>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="col-12 d-flex flex-sm-row flex-column justify-content-end">
                                                                <button type="submit" class="btn btn-primary glow mr-sm-1 mb-1">Save
                                                                    changes</button>
                                                                <button type="reset" class="btn btn-light mb-1">Cancel</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                                <div class="tab-pane show {{$subMenu == "change_password" ? "active" : ""}}" id="account-vertical-password" role="tabpanel"
                                                    aria-labelledby="account-pill-password" aria-expanded="false">
                                                    <form action="{{route('user.change.password')}}" method="POST" id="ChangePassword">
                                                    @csrf
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <div class="form-group">
                                                                    <div class="controls">
                                                                        <label>Old Password</label>
                                                                        <input type="password" name="old_password" id="old_password" class="form-control" required
                                                                            placeholder="Old Password"
                                                                            data-validation-required-message="This old password field is required">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <div class="form-group">
                                                                    <div class="controls">
                                                                        <label>New Password</label>
                                                                        <input type="password" id="new_password" name="new_password" class="form-control"
                                                                            placeholder="New Password"
                                                                            minlength="6" >
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <div class="form-group">
                                                                    <div class="controls">
                                                                        <label>Retype new Password</label>
                                                                        <input type="password"
                                                                            class="form-control"
                                                                            placeholder="Confirm Password"
                                                                            minlength="6" name="confirm_password" id="confirm_password" />
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-12 d-flex flex-sm-row flex-column justify-content-end">
                                                                <button type="submit" class="btn btn-primary glow mr-sm-1 mb-1">Save
                                                                    changes</button>
                                                                <button type="reset" class="btn btn-light mb-1">Cancel</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- account setting page ends -->
        </div>
      </div>
    </div>
    <!-- END: Content-->
@endsection

@section('js')
    <script>
        $(document).ready(function() {
            $('#EditProfile').validate({
                rules:{
                    firstname:"required",
                    lastname:"required",
                    email:{
                        required:true,
                        Validemail:true
                    },
                    country:"required",
                    state:"required",
                    city:"required",
                    contactno:{
                        digits:true,
                        minlength:10,
                        required:true
                    }
                }
            });
        });

        $('#ChangePassword').validate({
            rules:{
                old_password:{
                    required:true
                },
                new_password:{
                    required:true,
                    maxlength:20
                },
                confirm_password:{
                    required:true,
                    maxlength:20,
                    equalTo:"#new_password"
                }
            },
            submitHandler: function(form) {
                $.ajax({
                    url:"{{url('check-user-password')}}",
                    type:"POST",
                    data:{old_pass:$('#old_password').val(),'_token':"{{csrf_token()}}"},
                    success:function(data) {
                        if(data == true) {
                            Swal.fire({ 
                                type: "success", 
                                title: "Done!", 
                                text: "Password matched.", 
                                confirmButtonClass: "btn btn-success" 
                            }).then(function(confirm) {
                                if(confirm) {
                                    form.submit();
                                }  
                            })
                        } else {
                            Swal.fire({ 
                                type: "error", 
                                title: "Sorry!", 
                                text: "Your old password does not match. Please try again.", 
                                showCancelButton: 0,
                            })
                        }
                    }
                });
            }
        });
    </script>
@endsection