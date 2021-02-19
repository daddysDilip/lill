@extends('layouts.admin_layout')
@section('title')Manage Plans @endsection
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
                    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active">Manage Plans
                    </li>
                  </ol>
                </div>
              </div>
              <div class="col-2 text-right">
                    @if (get_user_permission("create_plan","view"))
                        <a href="{{route('plan.create')}}" class="btn btn-primary"><i class="bx bx-plus"></i> Add Plan</a>
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
                                <h4 class="card-title">Plans</h4>
                            </div>
                            <div class="card-content">
                                <div class="card-body card-dashboard">
                                    <div class="table-responsive">
                                        <table class="table plan-type-details">
                                            <thead>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Plan type</th>
                                                    <th>Is Free</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if (!empty($PlansData))
                                                    @foreach ($PlansData as $data)
                                                        <tr>
                                                            <td>{{$data->name}}</td>
                                                            <td>{{$data->plan_type}}</td>
                                                            <td>
                                                                @if ($data->isFree == 1)
                                                                    <span class="badge badge-primary">Yes</span>
                                                                @else
                                                                    <span class="badge badge-primary">No</span>
                                                                @endif
                                                            </td>
                                                            <td>
                                                                @if ($data->status == 1)
                                                                    <span class="badge badge-success">Active</span>
                                                                @else
                                                                    <span class="badge badge-danger">Paused</span>
                                                                @endif
                                                            </td>
                                                            <td>
                                                                @if ($data->status == 1)
                                                                    @if (get_user_permission("deactivate_plan","view"))
                                                                        <button type="button" data-planid="{{$data->id}}" data-status="{{$data->status}}" data-toggle="tooltip" title="De-activate Plan" class="btn btn-icon btn-danger btn-change-status"><i class="bx bx-power-off"></i></button>
                                                                    @endif
                                                                @else
                                                                    @if (get_user_permission("activate_plan","view"))
                                                                        <button type="button" data-planid="{{$data->id}}" data-status="{{$data->status}}" data-toggle="tooltip" title="Activate Plan" class="btn btn-icon btn-success btn-change-status"><i class="bx bx-sync"></i></button>
                                                                    @endif
                                                                @endif
                                                                @if (get_user_permission("edit_plan","view"))
                                                                    <a href="{{ route('plan.edit', $data->id) }}" class="btn btn-icon btn-info" data-toggle="tooltip" title="Edit Plan"><i class="bx bxs-edit-alt"></i></a>
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
            $('.plan-type-details').DataTable({
                "ordering": false
            });
            $('.btn-change-status').click(function() {
                var planid = $(this).attr("data-planid");
                var status = $(this).attr("data-status");
                Swal.fire({ 
                    title: "Are you sure?", 
                    text: "You want to change module status?", 
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
                            url: "{{url('change-plan-status')}}?planid=" + planid + "&status=" + status,
                            success: function(res) {
                                if(res == "success") {
                                    Swal.fire({ 
                                        type: "success", 
                                        title: "Done!", 
                                        text: "Plan status changed.", 
                                        confirmButtonClass: "btn btn-success" 
                                    }).then(function(confirm) {
                                        if(confirm) {
                                            location.reload();
                                        }  
                                    }) 
                                } else if(res == "fail") {
                                    Swal.fire({ 
                                        type: "error", 
                                        title: "Sorry!", 
                                        text: "Failed to change plan status.", 
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