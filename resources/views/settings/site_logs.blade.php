@extends('layouts.admin_layout')
@section('title')Manage Site Logs @endsection
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
                    <li class="breadcrumb-item active">Manage Site Logs
                    </li>
                  </ol>
                </div>
              </div>
              <div class="col-2 text-right">
                    <button type="button" class="btn btn-warning btn-icon btn-flush-log"><i class="bx bx-data"></i> Flush Log</button>
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
                                <h4 class="card-title">Site Log Details</h4>
                            </div>
                            <div class="card-content">
                                <div class="card-body card-dashboard">
                                    <div class="table-responsive">
                                        <table class="table log-details">
                                            <thead>
                                                <tr>
                                                    <th>User</th>
                                                    <th>Module</th>
                                                    <th>Log Type</th>
                                                    <th>Log Date</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if (!empty($LogData))
                                                    @foreach ($LogData as $data)
                                                        <tr>
                                                            <td>{{$data->firstname." ".$data->lastname}}</td>
                                                            <td>{{$data->module_name}}</td>
                                                            <td>{{$data->log_type}}</td>
                                                            <td>{{date('d M Y',strtotime($data->created_at))}}</td>
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
            $('.log-details').DataTable({
                "ordering": false
            });
            $('.btn-flush-log').click(function() {
                Swal.fire({ 
                    title: "Are you sure?", 
                    text: "You want to flush logs.", 
                    type: "warning", 
                    showCancelButton: !0, 
                    confirmButtonColor: "#3085d6", 
                    cancelButtonColor: "#d33", 
                    confirmButtonText: "Confirm", 
                    confirmButtonClass: "btn btn-primary", 
                    cancelButtonClass: "btn btn-danger ml-1", 
                    buttonsStyling: !1 
                }).then(function (confirm) { 
                    if(confirm) {
                        $.ajax({
                            type: "GET",
                            url: "{{url('flush-log-data')}}",
                            success: function(res) {
                                if(res == "success") {
                                    Swal.fire({ 
                                        type: "success", 
                                        title: "Done!", 
                                        text: "Logs flushed.", 
                                        confirmButtonClass: "btn btn-success" 
                                    }).then(function(confirm) {
                                        if(confirm) {
                                            location.reload();
                                        }  
                                    }); 
                                } else if(res == "fail") {
                                    Swal.fire({ 
                                        type: "error", 
                                        title: "Sorry!", 
                                        text: "Failed to flush logs.", 
                                        showCancelButton: 1,
                                    });
                                }
                            }
                        });  
                    }
                }) 
            });
        });
    </script>
@endsection