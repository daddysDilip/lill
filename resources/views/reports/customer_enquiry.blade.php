@extends('layouts.admin_layout')
@section('title')Customer Enquiry @endsection
@section('content')

<!-- BEGIN: Content-->
    <div class="app-content content">
      <div class="content-overlay"></div>
      <div class="content-wrapper">
        <div class="content-header row">
          <div class="content-header-left col-12 mb-2 mt-1">
            <div class="row breadcrumbs-top">
              <div class="col-10">
                <h5 class="content-header-title float-left pr-1 mb-0">Reports</h5>
                <div class="breadcrumb-wrapper col-12">
                  <ol class="breadcrumb p-0 mb-0">
                    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active">Customer Enquiries
                    </li>
                  </ol>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="content-body">
            @include('tools.flash-message')
            <section id="basic-datatable">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Enquiry Details</h4>
                            </div>
                            <div class="card-content">
                                <div class="card-body card-dashboard">
                                    <div class="table-responsive">
                                        <table class="table user-details">
                                            <thead>
                                                <tr>
                                                    <th>Fullname</th>
                                                    <th>Email</th>
                                                    <th>Contact No</th>
                                                    <th>Message</th>
                                                    <th>Replied By</th>
                                                    <th>Replied Message</th>
                                                    <th>Enquiry Date</th>
                                                    <th>Replied Date</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if (!empty($UserEnquiry))
                                                    @foreach ($UserEnquiry as $data)
                                                        <tr>
                                                            <td>{{$data->fullname ?? ""}}</td>
                                                            <td>{{$data->email ?? ""}}</td>
                                                            <td>{{$data->phone_number ?? ""}}</td>
                                                            <td>{{$data->message ?? ""}}</td>
                                                            <td>{{$data->firstname." ".$data->lastname}}</td>
                                                            <td>{{$data->reply_message}}</td>
                                                            <td>{{date('d M Y',strtotime($data->created_at))}}</td>
                                                            <td>{{!empty($data->replied_date) ? date('d M Y',strtotime($data->replied_date)) : ""}}</td>
                                                            <td>
                                                                @if ($data->isReplied == 1)
                                                                    <button type="button" data-enquiry_id="{{$data->id ?? ''}}" data-customer_email="{{$data->email ?? ''}}" class="btn btn-sm btn-info btn-reply-enquiry"><i class="bx bx-reply"></i> Reply Again</button>
                                                                @else
                                                                    <button type="button" data-enquiry_id="{{$data->id ?? ''}}" data-customer_email="{{$data->email ?? ''}}" class="btn btn-sm btn-info btn-reply-enquiry"><i class="bx bx-reply"></i> Reply</button>
                                                                @endif
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
                    </div>
                </div>
            </section>
            <!--/ Zero configuration table -->
            @include('tools.enquiry_reply')
        </div>
      </div>
    </div>
<!-- END: Content-->

@endsection

@section('js')
    <script>
        $(document).ready(function() {
            $('.user-details').DataTable({
                "ordering": false
            });

            $('.btn-reply-enquiry').click(function() {
                var email = $(this).attr("data-customer_email");
                var enquiry_id = $(this).attr("data-enquiry_id");
                if(email != "") {
                    $('#EnquiryReplyForm,#email').val(email);
                    $('#EnquiryReplyForm,#enquiry_id').val(enquiry_id);
                    Swal.fire({ 
                        title: "Are you sure?", 
                        text: "You want to reply to this enquiry.", 
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
                             $('#EnquiryReplyModal').modal('show');
                        }
                    })
                } 
            });
        });

        $('#EnquiryReplyForm').validate({
            rules:{
                message:{
                    required:true
                }
            }
        })
    </script>
@endsection