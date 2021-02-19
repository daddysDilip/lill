@extends('layouts.admin_layout')
@section('title')Manage Site Settings @endsection
@section('content')

<!-- BEGIN: Content-->
    <div class="app-content content">
      <div class="content-overlay"></div>
      <div class="content-wrapper">
        <div class="content-header row">
          <div class="content-header-left col-12 mb-2 mt-1">
            <div class="row breadcrumbs-top">
              <div class="col-10">
                <h5 class="content-header-title float-left pr-1 mb-0">Settings</h5>
                <div class="breadcrumb-wrapper col-12">
                  <ol class="breadcrumb p-0 mb-0">
                    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active">Change Site Settings
                    </li>
                  </ol>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="content-body">
            <!-- Basic Vertical form layout section start -->
            @include('tools.flash-message')
            <section id="basic-vertical-layouts">
                <div class="row match-height">
                    <div class="col-md-12 col-12">
                        <div class="card">
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="row">
                                      <div class="col-lg-6 col-md-6">
                                      <table class="table table-bordered table-responsive">
                                        <thead>
                                          <tr>
                                            <th>Name</th>
                                            <th>Description</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                          @if (!empty($Settings))
                                              @foreach ($Settings as $setting)
                                                  <tr>
                                                      @if ($setting->key != "cmd_password")
                                                          <td>{{$setting->key}}</td>
                                                          <td>
                                                            @if ($setting->key == "site_logo")
                                                                <img src="{{!empty($setting->value) ? asset('client/images/'.$setting->value) : ''}}" alt="Site Logo" width="80px;">
                                                            @else
                                                                {{$setting->value}}
                                                            @endif
                                                          </td>
                                                          <td>
                                                            @if ($setting->status == 1)
                                                                <span class="text-success">Active</span>
                                                            @else
                                                                <span class="text-danger">Paused</span>
                                                            @endif
                                                          </td>
                                                          <td>
                                                              @if ($setting->status == 1)
                                                                  <button type="button" class="btn btn-sm btn-danger btn-change-site-status" data-toggle="tooltip" title="Pause Setting" data-setting_id="{{$setting->id}}" data-setting_status="{{$setting->status == 1 ? 0 : 1}}"><i class="bx bx-power-off"></i></button>
                                                              @else
                                                                  <button type="button" class="btn btn-sm btn-success btn-change-site-status" data-toggle="tooltip" title="Pause Setting" data-setting_id="{{$setting->id}}" data-setting_status="{{$setting->status == 1 ? 0 : 1}}"><i class="bx bx-redo"></i></button>
                                                              @endif
                                                          </td>
                                                      @endif
                                                  </tr>
                                              @endforeach
                                          @endif
                                        </tbody>
                                      </table>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                      <form action="{{route('settings.update')}}" enctype="multipart/form-data" method="POST" id="Settings">
                                          @csrf
                                          <div class="form-group row">
                                            <div class="col-lg-6 col-md-6">
                                              <label for="">Site Logo</label>
                                              <input type="file" name="site_logo" id="site_logo">
                                              <input type="hidden" name="site_logo_path" value="{{!empty(get_setting_option('site_logo')->value) ? asset('client/images/'.get_setting_option('site_logo')->value) : ''}}" />
                                            </div>
                                            <div class="col-lg-6 col-md-6">
                                              <img src="{{!empty(get_setting_option('site_logo')->value) ? asset('client/images/'.get_setting_option('site_logo')->value) : ''}}" width="100px;" id="site_logo_preview" />
                                            </div>
                                          </div>
                                          <div class="form-group row">
                                              <div class="col-lg-6 col-md-6">
                                                <label for="first-name-vertical">Company Name</label>
                                                <input type="text" id="company_name" value="{{get_setting_option('company_name')->value ?? ''}}" class="form-control" name="company_name" placeholder="Enter company name">
                                              </div>
                                              <div class="col-lg-6 col-md-6">
                                                <label for="first-name-vertical">Address</label>
                                                <input type="text" id="address" value="{{get_setting_option('address')->value ?? ''}}" class="form-control" name="address" placeholder="Enter contact no">
                                              </div>
                                          </div>
                                          <div class="form-group row">
                                              <div class="col-lg-6 col-md-6">
                                                <label for="first-name-vertical">Email</label>
                                                <input type="text" id="email" value="{{get_setting_option('email')->value ?? ''}}" class="form-control" name="email" placeholder="Enter company email">
                                              </div>
                                              <div class="col-lg-6 col-md-6">
                                                <label for="first-name-vertical">Contact No</label>
                                                <input type="text" id="contact_number" value="{{get_setting_option('contact_number')->value ?? ''}}" class="form-control" name="contact_number" placeholder="Enter contact no">
                                              </div>
                                          </div>
                                          <div class="form-group row">
                                              <div class="col-lg-6 col-md-6">
                                                <label for="first-name-vertical">Facebook Link</label>
                                                <input type="text" id="facebook_link" value="{{get_setting_option('facebook_link')->value ?? ''}}" class="form-control" name="facebook_link" placeholder="Enter facebook link">
                                              </div>
                                              <div class="col-lg-6 col-md-6">
                                                <label for="first-name-vertical">Twitter Link</label>
                                                <input type="text" id="twitter_link" value="{{get_setting_option('twitter_link')->value ?? ''}}" class="form-control" name="twitter_link" placeholder="Enter twitter link">
                                              </div>
                                          </div>
                                          <div class="form-group row">
                                              <div class="col-lg-6 col-md-6">
                                                <label for="first-name-vertical">Instagram Link</label>
                                                <input type="text" id="instagram_link" value="{{get_setting_option('instagram_link')->value ?? ''}}" class="form-control" name="instagram_link" placeholder="Enter instagram link">
                                              </div>
                                              <div class="col-lg-6 col-md-6">
                                                <label for="first-name-vertical">Pinterest Link</label>
                                                <input type="text" id="pinterest_link" value="{{get_setting_option('pinterest_link')->value ?? ''}}" class="form-control" name="pinterest_link" placeholder="Enter pinterest link">
                                              </div>
                                          </div>
                                          <div class="form-group row">
                                              <div class="col-lg-6 col-md-6">
                                                <label for="first-name-vertical">Total Emails Allowed</label>
                                                <input type="text" id="total_emails_allowed" value="{{get_setting_option('total_emails_allowed')->value ?? ''}}" class="form-control" name="total_emails_allowed" placeholder="Enter total emails limit">
                                              </div>
                                              <div class="col-lg-6 col-md-6">
                                                <label for="first-name-vertical">Guest User Link Limit</label>
                                                <input type="text" id="guest_user_link_limit" value="{{get_setting_option('guest_user_link_limit')->value ?? ''}}" class="form-control" name="guest_user_link_limit" placeholder="Enter guest user link create limit">
                                              </div>
                                          </div>
                                          <div class="form-group row">
                                            <div class="col-lg-12">
                                              <button type="submit" class="btn btn-primary mr-1 mb-1">Submit</button>
                                              <button type="reset" class="btn btn-light-secondary mr-1 mb-1">Reset</button>
                                            </div>
                                          </div>
                                      </form>
                                    </div>
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
          function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                
                reader.onload = function(e) {
                $('#site_logo_preview').attr('src', e.target.result);
                }
                
                reader.readAsDataURL(input.files[0]); // convert to base64 string
            }
        }

        $("#site_logo").change(function() {
            readURL(this);
        });
          $('.btn-change-site-status').on('click', function() {
            var id = $(this).attr('data-setting_id');
            var status = $(this).attr('data-setting_status');

            if(id != "" && status != "") {
              Swal.fire({ 
                    title: "Are you sure?", 
                    text: "You want to change setting status?", 
                    type: "warning", 
                    showCancelButton: !0, 
                    confirmButtonColor: "#3085d6", 
                    cancelButtonColor: "#d33", 
                    confirmButtonText: "Confirm", 
                    confirmButtonClass: "btn btn-primary", 
                    cancelButtonClass: "btn btn-danger ml-1", 
                    buttonsStyling: !1 
                }).then(function (confirm) { 
                    if(confirm.value == true) {
                      $.ajax({
                        url:"{{url('change-setting-status')}}?id=" + id + "&status=" + status,
                        type:"GET",
                        success:function(data) {
                          if(data.status == "success") {
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
                          } else if(data.status == "fail") {
                            Swal.fire({ 
                                type: "error", 
                                title: "Failed!", 
                                text: data.msg, 
                                confirmButtonClass: "btn btn-danger" 
                            })
                          }
                        },
                        error:function(data) {
                          setTimeout(function() {
                            $('#overlay').fadeOut();
                          }, 500);
                        }
                      }).done(function() {
                        setTimeout(function() {
                          $('#overlay').fadeOut();
                        }, 500);
                      })
                    }
                });
            }

          });
        })
    </script>
@endsection