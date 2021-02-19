@extends('layouts.admin_layout')
@section('title')Manage Users @endsection
@section('content')

<!-- BEGIN: Content-->
    <div class="app-content content">
      <div class="content-overlay"></div>
      <div class="content-wrapper">
        <div class="content-header row">
          <div class="content-header-left col-12 mb-2 mt-1">
            <div class="row breadcrumbs-top">
              <div class="col-10">
                <h5 class="content-header-title float-left pr-1 mb-0">Users</h5>
                <div class="breadcrumb-wrapper col-12">
                  <ol class="breadcrumb p-0 mb-0">
                    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active">{{!empty($User) ? "Update" : "Create"}} User
                    </li>
                  </ol>
                </div>
              </div>
              <div class="col-2 text-right">
                <a href="{{route('users')}}" class="btn btn-black"><i class="bx bx-left-arrow-alt"></i> Back</a>
              </div>
            </div>
          </div>
        </div>
        <div class="content-body">
            <!-- Basic Vertical form layout section start -->
            <section id="basic-vertical-layouts">
                <div class="row match-height">
                    <div class="col-md-12 col-12">
                        <div class="card">
                            <div class="card-content">
                                <div class="card-body">
                                    @if (!empty($User))
                                        <form class="form form-vertical" action="{{ route('users.update', $User->id) }}" method="POST" id="UserForm">
                                    @else
                                        <form class="form form-vertical" action="{{route('users.store')}}" method="POST" id="UserForm">
                                    @endif
                                        @csrf
                                        <div class="form-body">
                                            <div class="row">
                                                <div class="col-md-4 col-12">
                                                    <div class="form-group">
                                                        <label for="first-name-vertical">Role</label>
                                                        <select name="role" id="role" class="form-control">
                                                            @if (!empty($Role))
                                                                @foreach ($Role as $role)
                                                                    <option value="{{$role->id}}" {{ isset($User) ? (($User->roleid == $role->id) ? 'selected' : '') : '' }}>{{$role->name}}</option>
                                                                @endforeach
                                                            @endif
                                                        </select>
                                                        @error('role')
                                                            <div class="alert alert-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-4 col-12">
                                                    <div class="form-group">
                                                        <label for="first-name-vertical">Firstname *</label>
                                                        <input type="text" id="firstname" value="{{$User->firstname ?? ''}}" class="form-control" name="firstname" placeholder="Enter firstname">
                                                        @error('firstname')
                                                            <div class="alert alert-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-4 col-12">
                                                    <div class="form-group">
                                                        <label for="first-name-vertical">Lastname *</label>
                                                        <input type="text" id="lastname" value="{{$User->lastname ?? ''}}" class="form-control" name="lastname" placeholder="Enter lastname">
                                                        @error('lastname')
                                                            <div class="alert alert-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-4 col-12">
                                                    <div class="form-group">
                                                        <label for="first-name-vertical">Country *</label>
                                                        <select name="country" id="country" class="form-control">
                                                            <option value="">---Choose Country---</option>
                                                            @if (!empty($Country))
                                                                @foreach ($Country as $country)
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
                                                        <label for="first-name-vertical">State *</label>
                                                        <select name="state" id="state" class="form-control">
                                                            <option value="">---Choose State---</option>
                                                            @if (!empty($User) && !empty($State))
                                                                @foreach ($State as $state)
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
                                                        <label for="first-name-vertical">City *</label>
                                                        <select name="city" id="city" class="form-control">
                                                            <option value="">---Choose City---</option>
                                                            @if (!empty($User) && !empty($City))
                                                                @foreach ($City as $city)
                                                                    <option value="{{$city->id}}" {{ isset($User) ? (($User->city == $city->id) ? 'selected' : '') : '' }}>{{$city->name}}</option>
                                                                @endforeach
                                                            @endif
                                                        </select>
                                                        @error('city')
                                                            <div class="alert alert-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-4 col-12">
                                                    <div class="form-group">
                                                        <label for="first-name-vertical">Email *</label>
                                                        <input type="email" id="email" value="{{$User->email ?? ''}}" class="form-control" name="email" placeholder="Enter email">
                                                        @error('email')
                                                            <div class="alert alert-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-4 col-12">
                                                    <div class="form-group">
                                                        <label for="first-name-vertical">Contact No *</label>
                                                        <input type="text" id="contactno" value="{{ isset($User) ? $User->contactno : '' }}" class="form-control" name="contactno" placeholder="Enter contactno">
                                                        @error('contactno')
                                                            <div class="alert alert-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            <div class="col-md-4 col-12" style="display:{{!empty($User) ? 'none' : ''}}">
                                                    <div class="form-group">
                                                        <label for="first-name-vertical">Password *</label>
                                                        <input type="text" id="password" value="" class="form-control" name="password" placeholder="Enter password">
                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    <div class="form-group">
                                                        <div class="checkbox">
                                                            <input type="checkbox" name="status" {{ isset($User) ? (($User->status == 1) ? 'checked' : '') : '' }} value="1" class="checkbox-input" id="checkbox3">
                                                            <label for="checkbox3">Active</label>
                                                        </div>
                                                        @error('status')
                                                            <div class="alert alert-danger  ">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-12 d-flex justify-content-end">
                                                    <button type="submit" class="btn btn-primary mr-1 mb-1">Submit</button>
                                                    <button type="reset" class="btn btn-light-secondary mr-1 mb-1">Reset</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- // Basic Vertical form layout section end -->
        </div>
      </div>
    </div>
<!-- END: Content-->

@endsection

@section('js')
    <script>
        $(document).ready(function() {
            $('#contactno').keypress(function(key) {
                if (key.charCode < 48 || key.charCode > 57) return false;
            });
            $('#UserForm').validate({
                rules:{
                    role:{
                        required:true
                    },
                    firstname:"required",
                    lastname:"required",
                    email:{
                        required:true,
                        Validemail:true,
                        // remote: {
                        //     type: 'post',
                        //     url: "{{ URL('check-email-exist') }}",
                        //     async: false,
                        //     async: false,
                        //     data: {
                        //         username: function() {
                        //             return $("input[name='email']").val();
                        //         },
                        //         "_token": "{{ csrf_token() }}"
                        //     },
                        //     async: false
                        // }
                    },
                    country:"required",
                    state:"required",
                    city:"required",
                    contactno:{
                        required:true,
                        minlength: 10,
                        digits: true,
                    },
                    password:{
                        required:true,
                        minlength:6,
                        maxlength:20,
                    }
                },
                messages:{
                    role:{
                        required:"Please select a role.",
                    },
                }
            });

            $('#country').change(function() {
                var countryID = $(this).val();
                if (countryID) {
                    $.ajax({
                        type: "POST",
                        url: "{{route('get.state.list')}}",
                        data:{
                            countryID:countryID,
                            '_token':"{{csrf_token()}}"
                        },
                        success: function(res) {
                            if (res) {
                                $("#state").empty();
                                $("#state").append('<option value="">---Choose State---</option>');
                                $.each(res, function(key, value) {
                                    $("#state").append('<option value="' + key + '">' + value + '</option>');
                                });
                                $("#city").empty();
                                $("#city").append('<option value="">---Choose City---</option>');
                            } else {
                                $("#state").empty();
                                $("#state").append('<option value="">---Choose State---</option>');
                                $("#city").empty();
                                $("#city").append('<option value="">---Choose City---</option>');
                            }
                        }
                    });
                } else {
                    $("#state").empty();
                    $("#state").append('<option value="">---Choose State---</option>');
                    $("#city").empty();
                    $("#city").append('<option value="">---Choose City---</option>');
                }
            });
            
            
            $('#state').on('change', function() {
                var stateID = $(this).val();
                if (stateID) {
                    $.ajax({
                        type: "POST",
                        url: "{{route('get.city.list')}}",
                        data:{
                            stateID:stateID,
                            '_token':"{{csrf_token()}}"
                        },
                        success: function(res) {
                            if (res) {
                                $("#city").empty();
                                $("#city").append('<option value="">---Choose City---</option>');
                                $.each(res, function(key, value) {
                                    $("#city").append('<option value="' + key + '">' + value + '</option>');
                                });
                            } else {
                                $("#city").empty();
                                $("#city").append('<option value="">---Choose City---</option>');
                            }
                        }
                    });
                } else {
                    $("#city").empty();
                    $("#city").append('<option value="">---Choose City---</option>');
                }

            });
        })
    </script>
@endsection