@extends('layouts.admin_layout')
@section('title')Manage Plan Features @endsection
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
                    <li class="breadcrumb-item active">Manage Plan Features
                    </li>
                  </ol>
                </div>
              </div>
              <div class="col-2 text-right">
                    @if (get_user_permission("create_plan_feature","view"))
                        <a href="{{route('plan.feature.create')}}" class="btn btn-primary"><i class="bx bx-plus"></i> Add Feature</a>
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
                                <h4 class="card-title">Plan Features</h4>
                            </div>
                            <div class="card-content">
                                <div class="card-body card-dashboard">
                                    <div class="table-responsive">
                                        <table class="table plan-feature-details">
                                            <thead>
                                                <tr>
                                                    <th>Title</th>
                                                    <th>Short Description</th>
                                                    <th>Feature Type</th>
                                                    <th>Feature Text</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if (!empty($FeatureData))
                                                    @foreach ($FeatureData as $data)
                                                        <tr>
                                                            <td>{{$data->title}}</td>
                                                            <td>{{$data->short_description}}</td>
                                                            <td>{{$data->feature_type}}</td>
                                                            <td>{{$data->feature_text}}</td>
                                                            <td>
                                                                @if ($data->status == 1)
                                                                    <span class="badge badge-success">Active</span>
                                                                @else
                                                                    <span class="badge badge-danger">Paused</span>
                                                                @endif
                                                            </td>
                                                            <td>
                                                                
                                                                @if ($data->status == 1)
                                                                    @if (get_user_permission("deactivate_plan_feature","view"))
                                                                        <button type="button" data-feature_id="{{$data->id}}" data-status="{{$data->status}}" data-toggle="tooltip" title="De-activate Feature" class="btn btn-icon btn-danger btn-change-status"><i class="bx bx-power-off"></i></button>
                                                                    @endif
                                                                @else
                                                                    @if (get_user_permission("activate_plan_feature","view"))
                                                                        <button type="button" data-feature_id="{{$data->id}}" data-status="{{$data->status}}" data-toggle="tooltip" title="Activate Feature" class="btn btn-icon btn-success btn-change-status"><i class="bx bx-sync"></i></button>
                                                                    @endif
                                                                @endif

                                                                @if (get_user_permission("edit_plan_feature","view"))
                                                                    <a href="{{ route('plan.feature.edit', $data->id) }}" class="btn btn-icon btn-info" data-toggle="tooltip" title="Edit Plan Feature"><i class="bx bxs-edit-alt"></i></a>
                                                                @endif

                                                                @if (get_user_permission("delete_plan_feature","view"))
                                                                    <form action="{{ route('plan.feature.delete', $data->id)}}" method="post">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <button class="btn btn-icon btn-danger mt-1" type="submit" data-toggle="tooltip" title="Delete Feature"><i class="bx bx-trash"></i></button>
                                                                    </form>
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
            $('.plan-feature-details').DataTable({
                "ordering": false
            });
        });
    </script>
@endsection