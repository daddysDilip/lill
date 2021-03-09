@extends('layouts.admin_layout')
@section('title')Add Plan @endsection
<div id="overlay" class="loader" style="display:none;">
    <div alt="Spinner" class="spinner"></div>
</div>
@section('css')
    <style>
       #overlay {
            background: #FFF;
            color: #666666;
            position: fixed;
            height: 100%;
            width: 100%;
            z-index: 5000;
            top: 0;
            left: 0;
            float: left;
            text-align: center;
            padding-top: 25%;
            opacity: .70;
        } 
        .spinner {
            margin: 0 auto;
            height: 100px;
            width: 100px;
            animation: rotate 0.8s infinite linear;
            border: 5px solid #0198E1;
            border-right-color: transparent;
            border-radius: 50%;
        } 
        @keyframes rotate {
        0% {
            transform: rotate(0deg);
        }
        100% {
            transform: rotate(360deg);
        }
}
    </style>
@endsection
@section('content')
<!-- BEGIN: Content-->
    <div class="app-content content">
      <div class="content-overlay"></div>
      <div class="content-wrapper">
        <div class="content-header row">
          <div class="content-header-left col-12 mb-2 mt-1">
            <div class="row breadcrumbs-top">
              <div class="col-10">
                <h5 class="content-header-title float-left pr-1 mb-0">Plans</h5>
                <div class="breadcrumb-wrapper col-12">
                  <ol class="breadcrumb p-0 mb-0">
                    <li class="breadcrumb-item"><a href="{{url('admin-dashboard')}}"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active">{{!empty($Plan) ? "Update" : "Create"}} Plan
                    </li>
                  </ol>
                </div>
              </div>
              <div class="col-2 text-right">
                <a href="{{route('plans')}}" class="btn btn-black"><i class="bx bx-left-arrow-alt"></i> Back</a>
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
                                    @if (!empty($Plan))
                                        <form class="form form-vertical" action="{{ route('plan.update', $Plan->id) }}" method="POST" id="PlanForm">
                                            <input type="hidden" name="plan_id" id="plan_id" value="{{$Plan->id ?? ''}}">
                                    @else
                                        <form class="form form-vertical" action="{{route('plan.store')}}" method="POST" id="PlanForm">
                                    @endif
                                        @csrf
                                        <div class="form-body">
                                            <div class="row">
                                                <div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="first-name-vertical">Plan Type</label>
                                                        <select name="plan_type" id="plan_type" class="form-control">
                                                            <option value="">---Select Plan Type---</option>
                                                            @if (!empty($PlanType))
                                                                @foreach ($PlanType as $type)
                                                                    <option value="{{$type->id}}" {{isset($Plan->plan_type_id) && $Plan->plan_type_id == $type->id ? "selected" : "" }}>{{$type->plan_type}}</option>
                                                                @endforeach
                                                            @endif
                                                        </select>
                                                        @error('plan_type')
                                                            <div class="alert alert-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="first-name-vertical">Plan Name</label>
                                                        <input type="text" name="plan_name" value="{{$Plan->name ?? ''}}" id="plan_name" placeholder="Enter plan name" class="form-control" >
                                                        @error('plan_name')
                                                            <div class="alert alert-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="first-name-vertical">Annual Price</label>
                                                        <input type="text" name="annual_price" value="{{$Plan->annual_price ?? ''}}" id="annual_price" placeholder="Enter annual price" class="form-control" >
                                                        @error('annual_price')
                                                            <div class="alert alert-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="first-name-vertical">Monthly Price</label>
                                                        <input type="text" name="monthly_price" value="{{$Plan->monthly_price ?? ''}}" id="monthly_price" placeholder="Enter monthly price" class="form-control" >
                                                        @error('monthly_price')
                                                            <div class="alert alert-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="first-name-vertical">Tax</label>
                                                        <select name="tax" id="tax" class="form-control">
                                                            <option value="">---Select tax---</option>
                                                            @if (!empty(get_tax()))
                                                                @foreach (get_tax() as $tax)
                                                                    <option value="{{$tax['tax']}}" {{isset($Plan->tax) && $Plan->tax == $tax['tax'] ? "selected" : ""}}>{{$tax['tax']}}</option>
                                                                @endforeach
                                                            @endif
                                                        </select>
                                                        @error('tax')
                                                            <div class="alert alert-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="first-name-vertical">Discount</label>
                                                        <input type="text" name="discount" value="{{$Plan->discount ?? ''}}" id="discount" placeholder="Enter discount" class="form-control" >
                                                        @error('discount')
                                                            <div class="alert alert-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="first-name-vertical">Total Links /Month<i data-toggle="tooltip" title="Total Basic Links Per month" class="bx bx-info-circle"></i></label>
                                                        <input type="text" name="total_links" value="{{$Plan->total_links ?? ''}}" id="total_links" placeholder="Enter total basic links" class="form-control" >
                                                        @error('total_links')
                                                            <div class="alert alert-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="first-name-vertical">Total Branded Links <i data-toggle="tooltip" title="Total Branded Links Per Package" class="bx bx-info-circle"></i></label>
                                                        <input type="text" name="total_branded_links" value="{{$Plan->total_branded_links ?? ''}}" id="total_branded_links" placeholder="Enter total branded links" class="form-control" >
                                                        @error('total_branded_links')
                                                            <div class="alert alert-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="first-name-vertical">Total Users <i data-toggle="tooltip" title="Total Users Allowed To Register Per Package" class="bx bx-info-circle"></i></label>
                                                        <input type="text" name="total_users" value="{{$Plan->total_users ?? ''}}" id="total_users" placeholder="Enter total user accounts" class="form-control" >
                                                        @error('total_users')
                                                            <div class="alert alert-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="first-name-vertical">Total Custom Domains <i data-toggle="tooltip" title="Total Custom Domains Per Package" class="bx bx-info-circle"></i></label>
                                                        <input type="text" name="total_custom_domains" value="{{$Plan->total_custom_domains ?? ''}}" id="total_custom_domains" placeholder="Enter total custom domaisn" class="form-control" >
                                                        @error('total_custom_domains')
                                                            <div class="alert alert-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="first-name-vertical">Total Link Click <i data-toggle="tooltip" title="Total number of clicks be allow on a link" class="bx bx-info-circle"></i></label>
                                                        <input type="text" name="total_link_click" value="{{$Plan->total_link_click ?? ''}}" id="total_link_click" placeholder="Leave empty if unlimited" class="form-control" >
                                                        @error('total_link_click')
                                                            <div class="alert alert-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-12">
                                                    {{-- for balance fields --}}
                                                </div>
                                                <div class="col-4">
                                                    <div class="form-group">
                                                        <div class="checkbox1">
                                                            <input type="checkbox" name="status" {{ isset($Plan->status) ? (($Plan->status == 1) ? 'checked' : '') : '' }} value="1" class="checkbox-input" id="checkbox1">
                                                            <label for="checkbox1">Active</label>
                                                        </div>
                                                        <div class="checkbox3">
                                                            <input type="checkbox" name="is_qrcode" {{ isset($Plan->is_qrcode) ? (($Plan->is_qrcode == 1) ? 'checked' : '') : '' }} value="1" class="checkbox-input" id="is_qrcode">
                                                            <label for="is_qrcode">QR Code available</label>
                                                        </div>
                                                        <div class="checkbox2">
                                                            <input type="checkbox" name="isFree" {{ isset($Plan->isFree) ? (($Plan->isFree == 1) ? 'checked' : '') : '' }} value="1" class="checkbox-input" id="isFree">
                                                            <label for="isFree">Is Free</label>
                                                        </div>
                                                        @error('status')
                                                            <div class="alert alert-danger  ">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    <div class="form-group">
                                                        <div class="link_track">
                                                            <input type="checkbox" name="link_track" {{ isset($Plan->link_track) ? (($Plan->link_track == 1) ? 'checked' : '') : '' }} value="1" class="checkbox-input" id="link_track">
                                                            <label for="link_track">link track</label>
                                                        </div>
                                                        <div class="link_filtering">
                                                            <input type="checkbox" name="link_filtering" {{ isset($Plan->link_filtering) ? (($Plan->link_filtering == 1) ? 'checked' : '') : '' }} value="1" class="checkbox-input" id="link_filtering">
                                                            <label for="link_filtering">link filtering</label>
                                                        </div>
                                                        <div class="custom_back_half">
                                                            <input type="checkbox" name="custom_back_half" {{ isset($Plan->custom_back_half) ? (($Plan->custom_back_half == 1) ? 'checked' : '') : '' }} value="1" class="checkbox-input" id="custom_back_half">
                                                            <label for="custom_back_half">custom back half</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    <div class="form-group">
                                                        <div class="link_analytics">
                                                            <input type="checkbox" name="link_analytics" {{ isset($Plan->link_analytics) ? (($Plan->link_analytics == 1) ? 'checked' : '') : '' }} value="1" class="checkbox-input" id="link_analytics">
                                                            <label for="link_analytics">link analytics</label>
                                                        </div>
                                                        <div class="link_history">
                                                            <input type="checkbox" name="link_history" {{ isset($Plan->link_history) ? (($Plan->link_history == 1) ? 'checked' : '') : '' }} value="1" class="checkbox-input" id="link_history">
                                                            <label for="link_history">link history</label>
                                                        </div>
                                                        <div class="social_media_shering">
                                                            <input type="checkbox" name="social_media_shering" {{ isset($Plan->social_media_shering) ? (($Plan->social_media_shering == 1) ? 'checked' : '') : '' }} value="1" class="checkbox-input" id="social_media_shering">
                                                            <label for="social_media_shering">social media shering</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12 d-flex justify-content-end">
                                                    <button type="submit" class="btn btn-primary mr-1 mb-1">Submit</button>
                                                    <button type="reset" class="btn btn-light-secondary mr-1 mb-1">Reset</button>
                                                </div>
                                            </div>
                                        </div>
                                </div>
                            </div>
                        </div>
                        {{-- <div class="card">
                            <div class="card-header">
                                <h4>Manage Plan Features</h4>
                            </div>
                            <div class="card-content">
                                <div class="card-body card-dashboard">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>Feature</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if (!empty($PlanFeature))
                                                    @foreach ($PlanFeature as $feature)
                                                        <tr>
                                                            <td>{{$feature->feature_title}}</td>
                                                            <td>
                                                                <button type="button" data-map_id="{{$feature->id}}" data-feature_id="{{$feature->feature_id}}" class="btn btn-icon btn-danger btn-remove-feature" data-toggle="tooltip" title="Remove Feature"><i class="bx bx-trash"></i></button>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <h4>Plan Features</h4>
                            </div>
                            <div class="card-content">
                                <div class="card-body card-dashboard">
                                    <div class="table-responsive">
                                        <table class="table plan-feature-details">
                                            <tbody>
                                                @if (!empty($AllFeatures))
                                                    @foreach ($AllFeatures as $feat)
                                                        <tr>
                                                            <td>
                                                                <input type="checkbox" name="feature_id[]" value="{{$feat->id}}" /> {{$feat->title}}
                                                            </td>
                                                        </tr>  
                                                    @endforeach
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card features-block" style="display:none;">
                            <div class="card-header">
                                <h4>Plan Features</h4>
                            </div>
                            <div class="card-content">
                                <div class="card-body card-dashboard">
                                    <div class="table-responsive">
                                        <table class="table plan-feature-details">
                                            <tbody>
                                                
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div> --}}
                    </div>
                    </form>
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
            var plan_id = $('#plan_id').val();
            // $('#plan_type').change(function(){
            //     $.ajax({
            //         type:"POST",
            //         dataType:'JSON',
            //         url:"{{url('fetch-plans-feature')}}",
            //         data:{plan_type:$(this).val(),plan_id:plan_id,'_token':"{{csrf_token()}}"},
            //         beforeSend: function(){
            //             // Show image container
            //             $(".loader").show();
            //         },
            //         success:function(data) {
            //             var res = '';
            //             var title_data = '';
            //             $(".features-block").show();
            //             if (data != "") {
            //                 setTimeout(function() {
            //                     $(".loader").hide();
            //                 },500);
            //                 $.each (data, function (key, value) {
                                
            //                     // res += '<tr><td><b>'+value.heading+'</b></td></tr>';
            //                     // title_data = value.feature_title.split(',');

            //                     // for(var i = 0; i < title_data.length; i++) {
            //                     //     res += '<tr>';
            //                     //     // Trim the excess whitespace.
            //                     //     title_data[i] = title_data[i].replace(/^\s*/, "").replace(/\s*$/, "");
            //                     //     // Add additional code here, such as:
            //                     //     res += '<td><input type="checkbox" name="feature_id[]" value="'+value.id+'" />'
            //                     //         + title_data[i] +
            //                     //     '</td></tr>';
            //                     // }
            //                     res += '<tr><td><input type="checkbox" name="feature_id[]" value="'+value.id+'" />'+value.title+'</tr>';
            //                 });
            //             } else {
            //                 setTimeout(function() {
            //                     $(".loader").hide();
            //                 },500);
            //                 res += '<tr><td><b>No plan features found.</b></td></tr>';
            //             }
            //             $(".plan-feature-details tbody").html(res);
            //         }
            //     })
            // });
            $('#PlanForm').validate({
                rules:{
                    plan_type:"required",
                    plan_name:"required",
                    annual_price:{
                        required:{
                            depends: function(element){
                                var flag = true;
                                if( $("#isFree").is(":checked")){
                                    flag = false;
                                }
                                return flag;
                            }
                        },
                        digits:true
                    },
                    monthly_price:{
                        required:{
                            depends: function(element){
                                var flag = true;
                                if( $("#isFree").is(":checked")){
                                    flag = false;
                                }
                                return flag;
                            }
                        },
                        digits:true
                    },
                    tax:{
                        digits:true
                    },
                    discount:{
                        digits:true
                    },
                    total_links:{
                        required:true,
                        digits:true
                    },
                    total_branded_links:{
                        required:true,
                        digits:true
                    },
                    total_users:{
                        required:true,
                        digits:true
                    },
                    total_custom_domains:{
                        required:true,
                        digits:true
                    }
                }
                // submitHandler: function(form) {
                //     // var items = [];
                //     // $("input[name='feature_id[]']:checked").each(function(){
                //     //     items.push($(this).val());
                //     // });
                //     $.ajax({
                //         type:"POST",
                //         url:$('#PlanForm').attr('action'),
                //         data:$('#PlanForm').serialize(),
                //         success:function(data) {
                //             if(data == "success") {
                //                 Swal.fire({ 
                //                     type: "success", 
                //                     title: "Done!", 
                //                     text: "Plan added successfully.", 
                //                     confirmButtonClass: "btn btn-success" 
                //                 }).then(function(confirm) {
                //                     location.reload(); 
                //                 })
                //             } else if(data == "fail") {
                //                 Swal.fire({ 
                //                     type: "error", 
                //                     title: "Sorry!", 
                //                     text: "Failed to add plan. Please try again.", 
                //                     showCancelButton: 0,
                //                 })
                //             }
                //         }
                //     });
                // }
            });
            // $('.btn-remove-feature').click(function() {
            //     var map_id = $(this).attr('data-map_id');
            //     var feature_id = $(this).attr('data-feature_id');

            //     Swal.fire({ 
            //         title: "Are you sure?", 
            //         text: "You want to delete this feature from the list?", 
            //         type: "warning", 
            //         showCancelButton: !0, 
            //         confirmButtonColor: "#3085d6", 
            //         cancelButtonColor: "#d33", 
            //         confirmButtonText: "Confirm", 
            //         confirmButtonClass: "btn btn-primary", 
            //         cancelButtonClass: "btn btn-danger ml-1", 
            //         buttonsStyling: !1 
            //     }).then(function (confirm) { 
            //         if(confirm) {
            //             $.ajax({
            //                 type: "GET",
            //                 url: "{{url('delete-map-feature')}}?map_id=" + map_id + "&feature_id=" + feature_id,
            //                 success: function(res) {
            //                     if(res == "success") {
            //                         Swal.fire({ 
            //                             type: "success", 
            //                             title: "Done!", 
            //                             text: "Plan feature deleted.", 
            //                             confirmButtonClass: "btn btn-success" 
            //                         }).then(function(confirm) {
            //                             if(confirm) {
            //                                 location.reload();
            //                             }  
            //                         }) 
            //                     } else if(res == "fail") {
            //                         Swal.fire({ 
            //                             type: "error", 
            //                             title: "Sorry!", 
            //                             text: "Failed to delete plan feature.", 
            //                             showCancelButton: 1,
            //                         })
            //                     }
            //                 }
            //             }); 
            //         }
            //     })
                
            // });
        })
    </script>
@endsection