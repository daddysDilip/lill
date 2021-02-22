@extends('layouts.admin_layout')
@section('title')Manage FAQ @endsection
@section('content')

<!-- BEGIN: Content-->
    <div class="app-content content">
      <div class="content-overlay"></div>
      <div class="content-wrapper">
        <div class="content-header row">
          <div class="content-header-left col-12 mb-2 mt-1">
            <div class="row breadcrumbs-top">
              <div class="col-10">
                <h5 class="content-header-title float-left pr-1 mb-0">FAQ</h5>
                <div class="breadcrumb-wrapper col-12">
                  <ol class="breadcrumb p-0 mb-0">
                    <li class="breadcrumb-item"><a href="{{url('admin-dashboard')}}"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active">Manage FAQ
                    </li>
                  </ol>
                </div>
              </div>
              <div class="col-2 text-right">
                    @if (get_user_permission("create_role","view"))
                        <a href="{{route('faq.create')}}" class="btn btn-primary"><i class="bx bx-plus"></i> Add FAQ</a>
                    @endif
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
                                <h4 class="card-title">Site FAQ</h4>
                            </div>
                            <div class="card-content">
                                <div class="card-body card-dashboard">
                                    <div class="table-responsive">
                                        <table class="table faq-detals">
                                            <thead>
                                                <tr>
                                                    <th>Question</th>
                                                    <th>Answer</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if (!empty($FAQ))
                                                    @foreach ($FAQ as $data)
                                                        <tr>
                                                            <td>{{$data->question}}</td>
                                                            <td width="55%">{{$data->answer}}</td>
                                                            <td>
                                                                @if ($data->status == 1)
                                                                    <span class="badge badge-success">Active</span>
                                                                @else
                                                                    <span class="badge badge-danger">Paused</span>
                                                                @endif
                                                            </td>
                                                            <td>
                                                                @if ($data->status == 1)
                                                                    @if (get_user_permission("deactivate_faq","view"))
                                                                        <button type="button" data-faq_id="{{$data->id}}" data-status="{{$data->status == 1 ? 0 : 1}}" data-toggle="tooltip" title="De-activate FAQ" class="btn btn-icon btn-danger btn-change-status"><i class="bx bx-power-off"></i></button>
                                                                    @endif
                                                                @else
                                                                    @if (get_user_permission("activate_faq","view"))
                                                                        <button type="button" data-faq_id="{{$data->id}}" data-status="{{$data->status == 1 ? 0 : 1}}" data-toggle="tooltip" title="Activate FAQ" class="btn btn-icon btn-success btn-change-status"><i class="bx bx-sync"></i></button>
                                                                    @endif
                                                                @endif
                                                                @if (get_user_permission("edit_faq","view"))
                                                                    <a href="{{ route('faq.edit', $data->id) }}" class="btn btn-icon btn-info" data-toggle="tooltip" title="Edit FAQ"><i class="bx bxs-edit-alt"></i></a>
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

        </div>
      </div>
    </div>
<!-- END: Content-->
   
@endsection

@section('js')
    <script>
        $(document).ready(function() {
            $('.faq-detals').DataTable({
                "ordering": false
            });

            $('.btn-change-status').click(function() {
                var id = $(this).attr("data-faq_id");
                var status = $(this).attr("data-status");
                Swal.fire({ 
                    title: "Are you sure?", 
                    text: "You want to change faq status?", 
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
                            type: "GET",
                            url:"{{route('change.faq.status')}}",
                            data:{
                                id:id,
                                status:status,
                                '_token':'{{csrf_field()}}'
                            },
                            success: function(data) {
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
                                        showCancelButton: 1,
                                    })
                                }
                            }
                        });    
                    }
                }) 
            });
        });
    </script>
@endsection