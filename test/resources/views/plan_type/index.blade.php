@extends('layouts.admin_layout')
@section('title')Manage Plan Types @endsection
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
                    <li class="breadcrumb-item active">Manage Plan Types
                    </li>
                  </ol>
                </div>
              </div>
              <div class="col-2 text-right">
                <a href="{{route('plan.types.create')}}" class="btn btn-primary"><i class="bx bx-plus"></i> Add Type</a>
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
                                <h4 class="card-title">Plan Types</h4>
                            </div>
                            <div class="card-content">
                                <div class="card-body card-dashboard">
                                    <div class="table-responsive">
                                        <table class="table plan-type-details">
                                            <thead>
                                                <tr>
                                                    <th>Plan type</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if (!empty($TypeData))
                                                    @foreach ($TypeData as $data)
                                                        <tr>
                                                            <td>{{$data->plan_type}}</td>
                                                            <td>
                                                                @if ($data->status == 1)
                                                                    <span class="badge badge-success">Active</span>
                                                                @else
                                                                    <span class="badge badge-danger">Paused</span>
                                                                @endif
                                                            </td>
                                                            <td>
                                                                <a href="{{ route('plan.types.edit', $data->id) }}" class="btn btn-icon btn-info" data-toggle="tooltip" title="Edit Plan type"><i class="bx bxs-edit-alt"></i></a>
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
        });
    </script>
@endsection