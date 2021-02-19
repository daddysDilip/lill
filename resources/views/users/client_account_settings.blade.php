@extends('layouts.client_dashboard_layout')
@section('title')
    Account Settings
@endsection
@section('css')
    <link href="{{asset('client/css/jquery-ui.css')}}" rel="stylesheet">  
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"> 
@endsection
@section('content')
    <div class="create-link-sec pt-4 pb-4">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 d-flex align-items-stretch">
                <div class="bg-light w-100 h-100">
                    <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                    <a class="nav-link p-3 {{!empty($tab) && $tab == 'account-details' ? 'active' : ''}}" id="v-pill-account-details-tab" href="{{route('user.account.settings','account-details')}}" role="tab" aria-controls="v-pill-account-details" aria-selected="true">Account Details</a>
                    {{-- <a class="nav-link p-3 {{!empty($tab) && $tab == 'email-settings' ? 'active' : ''}}" id="v-pills-email-tab" href="{{route('user.account.settings','email-settings')}}" role="tab" aria-controls="v-pills-email" aria-selected="false">Email Settings</a> --}}
                    <a class="nav-link p-3 {{!empty($tab) && $tab == 'change-password' ? 'active' : ''}}" id="v-pills-change-password-tab" href="{{route('user.account.settings','change-password')}}" role="tab" aria-controls="v-pills-change-password" aria-selected="false">Change Password</a>
                    <a class="nav-link p-3 {{!empty($tab) && $tab == 'hidden-links' ? 'active' : ''}}" id="v-pills-links-tab" href="{{route('user.account.settings','hidden-links')}}" role="tab" aria-controls="v-pills-links" aria-selected="false">Hidden Links</a>
                    <a class="nav-link p-3 {{!empty($tab) && $tab == 'favorite-links' ? 'active' : ''}}" id="v-pills-favorite-tab" href="{{route('user.account.settings','favorite-links')}}" role="tab" aria-controls="v-pills-favorite" aria-selected="false">Favourite Links</a>
                    </div>
                    </div>
                </div>
                <div class="col-lg-9 d-flex align-items-stretch">
                    <div class="tab-content w-100" id="v-pills-tabContent">
                        <div class="tab-pane fade show {{!empty($tab) && $tab == 'account-details' ? 'active' : ''}}" id="v-pill-account-details" role="tabpanel" aria-labelledby="v-pill-account-details-tab">
                            <div class="link-details p-2 p-lg-3">
                                <h1 class="account-title">Account Details</h1>
                                <div class="border-bottom pb-3">
                                <div class="row mt-4">
                                    <div class="col-lg-6 mb-3">
                                        <div class="sub-title p-4 w-100 h-100 text-center">FREE ACCOUNT</div>
                                    </div>
                                    <div class="col-lg-6 mb-3">
                                        <h1>You have all of these features.</h1>
                                        <ul class="">
                                            <li class="mb-2 mt-2">1,000 Links</li>
                                            <li class="">1 User</li>
                                        </ul>
                                    </div>                                    
                                </div>
                                </div>
                                <div class="row mt-4">
                                <div class="col-lg-6 border-right mb-3">
                                <h1 class="mb-3">ACCOUNT NAME</h1>
                                <form action="{{route('change.account.name')}}" class="w-100" id="ChangeAccountName" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <label class="mb-2">Firstname</label>
                                        <input type="text" readonly name="firstname" id="firstname" value="{{Auth::guard('user')->user()->firstname}}" class="form-control" />
                                    </div>
                                    <div class="form-group">
                                        <label class="mb-2">Lastname</label>
                                        <input type="text" readonly name="lastname" id="lastname" value="{{Auth::guard('user')->user()->lastname}}" class="form-control" />
                                    </div>
                                    <button type="button" class="btn btn-secondary btn-edit-name text-right">Edit</button>
                                    <div class="form-group button-block" style="display: none;">
                                        <button type="submit" class="btn primary-btn">Change</button>
                                        <button type="button" class="btn btn-secondary btn-cancel" style="font-size:14px;padding:10px 30px;">Cancel</button>
                                    </div>
                                    </form>
                                </div>
                                <div class="col-lg-6 mb-3">
                                    <h1 class="mb-3">MONTHLY USAGE</h1>
                                    <div class="form-group">
                                    <label class="mb-2">Total Links</label>
                                    <div id="total-links-progress" class="text-center w-100 p-3 h-100" data-total_links="{{$TotalLinks ?? ''}}"><span>{{$TotalLinks ?? ''}} / 1000</span></div>
                                    </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- <div class="tab-pane fade show {{!empty($tab) && $tab == 'email-settings' ? 'active' : ''}}" id="v-pills-email" role="tabpanel" aria-labelledby="v-pills-email-tab">
                            <div class="link-details p-2 p-lg-3">
                                <div style="position: relative;">
                                    <h1 style="position: absolute; left: 0; top: 0" class="account-title">Email</h1>
                                    <div style="position: absolute; right: 0; top: 0; text-align: right">
                                        <button type="button" data-toggle="modal" data-target="#addEmailModal" class="btn btn-primary">Add Email</button>
                                    </div>
                                </div>
                                
                                <div class="container mt-5">
                                    
                                </div>  
                            </div>
                        </div> --}}
                        <div class="tab-pane fade show {{!empty($tab) && $tab == 'change-password' ? 'active' : ''}}" id="v-pills-change-password" role="tabpanel" aria-labelledby="v-pills-change-password-tab">
                            <div class="link-details p-2 p-lg-3">
                                <h1 class="account-title">Change Password</h1>
                                <div class="row">
                                <div class="mt-4 col-lg-6">
                                    @include('tools.flash-message')
                                    <form action="{{route('change.user.password')}}" id="ChangePassword" method="post">
                                        @csrf
                                        <div class="form-group">
                                            <label for="old_password" class="col-form-label">Old Password <span class="text-danger"></span></label>
                                            <input type="password" name="old_password" id="old_password" placeholder="Enter your old password" class="form-control" />
                                        </div>
                                        <div class="form-group">
                                            <label for="new_password" class="col-form-label">New Password <span class="text-danger"></span></label>
                                            <input type="password" name="new_password" id="new_password" placeholder="Enter your new password" class="form-control" />
                                        </div>
                                        <div class="form-group">
                                            <label for="confirm_password" class="col-form-label">Confirm Password <span class="text-danger"></span></label>
                                            <input type="password" name="confirm_password" id="confirm_password" placeholder="Enter your confirm password" class="form-control" />
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn primary-btn">Submit</button>
                                            <!--<button type="reset" class="btn btn-secondary">Reset</button>-->
                                        </div>
                                    </form>
                                </div>
                                </div>  
                            </div>
                        </div>
                        <div class="tab-pane fade show {{!empty($tab) && $tab == 'hidden-links' ? 'active' : ''}}" id="v-pills-links" role="tabpanel" aria-labelledby="v-pills-links-tab">
                            <div class="link-details p-2 p-lg-3">
                                <h1 class="account-title">Hidden Links</h1>
                                <div class="row mt-5">
                                    <table class="table ml-3">
                                        <thead>
                                            <tr>
                                                <th>Website URL</th>
                                                <th>Short URL</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if (!empty($HiddenLinks) && count($HiddenLinks) > 0)
                                                @foreach ($HiddenLinks as $link)
                                                    <tr>
                                                        <td>{{$link->website_url}}</td>
                                                        <td>{{$link->generated_link}}</td>
                                                        <td>
                                                            <button type="button" data-link_id="{{$link->id}}" class="btn btn-sm btn-info btn-unhide-link" data-toggle="tooltip" title="Unhide Link to show on dashboard"><i class="fa fa-eye-slash"></i></button>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @else
                                                <tr>
                                                    <td colspan="3">No hidden links.</td>
                                                </tr>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade show {{!empty($tab) && $tab == 'favorite-links' ? 'active' : ''}}" id="v-pills-favorite" role="tabpanel" aria-labelledby="v-pills-favorite-tab">
                            <div class="link-details p-2 p-lg-3">
                                <h1 class="account-title">Favourite Links</h1>
                                <div class="row mt-5">
                                    <table class="table ml-3">
                                        <thead>
                                            <tr>
                                                <th>Website URL</th>
                                                <th>Short URL</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if (!empty($FavoriteLinks) && count($FavoriteLinks) > 0)
                                                @foreach ($FavoriteLinks as $link)
                                                    <tr>
                                                        <td>{{$link->website_url}}</td>
                                                        <td>{{$link->generated_link}}</td>
                                                        <td>
                                                            <button type="button" data-favorite_id="{{$link->favorite_id}}" data-link_id="{{$link->link_id}}" class="btn btn-sm btn-danger btn-remove-favorite" data-toggle="tooltip" title="Remove Link from Favorites"><i class="fa fa-trash"></i></button>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @else
                                                <tr>
                                                    <td colspan="3">No favourite links.</td>
                                                </tr>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('partials.client.ui.add_email')
@endsection

@section('js')
<script src="{{asset('client/js/jquery-ui.js')}}"></script>  
    <script>
        $.validator.addMethod('Validemail', function(value, element) {
            return this.optional(element) || value.match(/^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/);
        }, "Please enter a valid email address.");

        $('#AddEmailForm').validate({
            rules:{
                new_email: {
                    required:true,
                    Validemail:true
                }
            },
            messages:{
                new_email:{
                    required:"Please enter your valid email address"
                }
            },
            submitHandler:function(form) {
                if($('#AddEmailForm').valid()) {
                    checkEmail($('#new_email').val(), function(data) {
                        if(data == "available") {
                            $.ajax({
                                url:"{{route('add.new.client.email')}}",
                                type:"POST",
                                data:{
                                    email:$('#new_email').val(),
                                    '_token':"{{csrf_token()}}"
                                },
                                success:function(res) {
                                    console.log(res);
                                }
                            }).done(function() {
                                setTimeout(function() {
                                    $('#overlay').fadeOut(300);
                                },500);
                            });
                        }
                    });
                }
            }
        });

        function checkEmail(email, callback) {
            $.ajax({
                url:"{{url('check-new-email-exist')}}",
                type:"POST",
                data:{
                    email:email,
                    '_token':"{{csrf_token()}}"
                },
                success:function(data) {
                    if(data.status == "primary-email") {
                        Swal.fire({ 
                            type: "error", 
                            title: "Failed!", 
                            text: data.msg, 
                            showCancelButton: 1,
                        });
                    } else if(data.status == "exist") {
                        Swal.fire({ 
                            type: "error", 
                            title: "Failed!", 
                            text: data.msg, 
                            showCancelButton: 1,
                        });
                    } else {
                        callback("available");
                    }   
                }
            }).done(function() {
                setTimeout(function() {
                    $('#overlay').fadeOut(300);
                },500);
            });
        }

        $('#ChangePassword').validate({
            rules:{
                old_password:{
                    required:true,
                    minlength:8
                },
                new_password:{
                    required:true,
                    minlength:8
                },
                confirm_password:{
                    required:true,
                    minlength:8,
                    equalTo:"#new_password"
                },
            },
            messages:{
                old_password:{
                    required:"Please enter your current password."
                },
                new_password:{
                    required:"Please enter your new password."
                },
                confirm_password:{
                    required:"Please enter the password as above.",
                }
            }
        });

        var total_links = $('#total-links-progress').attr('data-total_links');
        $( "#total-links-progress" ).css('width','550px');
        $( "#total-links-progress" ).progressbar({  
            value: total_links,
        });  

    $('.btn-edit-name').click(function() {
        $('#firstname').prop('readonly',false);
        $('#lastname').prop('readonly',false);
        $('.button-block').show();
        $('.btn-edit-name').hide();
    });

    $('.btn-cancel').click(function() {
        $('#firstname').prop('readonly',true);
        $('#lastname').prop('readonly',true);
        $('.button-block').hide();
        $('.btn-edit-name').show();
    });

    $('.btn-unhide-link').click(function() {
        var link_id = $(this).attr('data-link_id');
        Swal.fire({
            title: 'Are you sure?',
            text: "You want to show this link on dashboard.",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, show it!'
            }).then((result) => {
                if (result.value == true) {
                    $.ajax({
                        url:"{{route('dashboard.link.change.status')}}",
                        type:"POST",
                        data:{
                            link_id:link_id,
                            '_token':"{{csrf_token()}}",
                            'action':'unhide'
                        },  
                        success:function(data) {
                            Swal.fire({ 
                                type: "success", 
                                title: "Done!", 
                                text: data.msg, 
                                confirmButtonClass: "btn btn-success" 
                            }).then(function(confirm) {
                                if(confirm.value == true) {
                                    location.reload();
                                }  
                            })
                        }
                    }).done(function() {
                        setTimeout(function(){
                            $("#overlay").fadeOut(300);
                        },500);
                    });
                }
            })
    });

    $('.btn-remove-favorite').click(function() {
        var link_id = $(this).attr('data-link_id');
        var favorite_id = $(this).attr('data-favorite_id');
        Swal.fire({
            title: 'Are you sure?',
            text: "You want to remove this link from favorites.",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.value == true) {
                    $.ajax({
                        url:"{{route('delete.favorite')}}",
                        type:"POST",
                        data:{
                            link_id:link_id,
                            favorite_id:favorite_id,
                            '_token':"{{csrf_token()}}"
                        },  
                        success:function(data) {
                            if(data.status == "fail") {
                                Swal.fire({ 
                                    type: "error", 
                                    title: "Error!", 
                                    text: data.msg, 
                                    confirmButtonClass: "btn btn-success" 
                                });
                            } else {
                                Swal.fire({ 
                                    type: "success", 
                                    title: "Done!", 
                                    text: "Link removed from favorites.", 
                                    confirmButtonClass: "btn btn-success" 
                                }).then(function(confirm) {
                                    if(confirm.value == true) {
                                        location.reload();
                                    }  
                                })
                            }
                        }
                    }).done(function() {
                        setTimeout(function(){
                            $("#overlay").fadeOut(300);
                        },500);
                    });
                }
            })
    });

    $('#ChangeAccountName').validate({
        rules:{
            firstname:"required",
            lastname:"required"
        },
        messages:{
            firstname:"Please enter your firstname.",
            lastname:"Please enter your lastname."
        },
        submitHandler:function(form) {
            $.ajax({
                url:"{{route('change.account.name')}}",
                type:"POST",
                data:$(form).serialize(),
                success:function(data) {
                    if(data.status == 200) {
                        Swal.fire({ 
                            type: "success", 
                            title: "Done!", 
                            text: data.msg, 
                            confirmButtonClass: "btn btn-success" 
                        }).then(function(confirm) {
                            if(confirm.value == true) {
                                $('#firstname').prop('readonly',true);
                                $('#lastname').prop('readonly',true);
                                $('.button-block').hide();
                                $('.btn-edit-name').show();
                            }  
                        })
                    } else if(data.status == 204) {
                         Swal.fire({ 
                            type: "error", 
                            title: "Failed!", 
                            text: data.msg, 
                            showCancelButton: 1,
                        }).then(function(confirm) {
                            if(confirm.value == true) {
                                $('#firstname').prop('readonly',true);
                                $('#lastname').prop('readonly',true);
                                $('.button-block').hide();
                                $('.btn-edit-name').show();
                            }
                        })
                    }
                }
            }).done(function() {
                setTimeout(function(){
                    $("#overlay").fadeOut(300);
                },500);
            });
        }
    });
    </script>
@endsection
