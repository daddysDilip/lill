@extends('layouts.admin_layout')
@section('title')Manage Roles @endsection
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
                    <li class="breadcrumb-item"><a href="{{url('admin-dashboard')}}"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active">Manage User Permissions
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
                                <h4 class="card-title">User Permission</h4>
                            </div>
                            <div class="card-content">
                                <div class="card-body card-dashboard">
                                    <div class="form-body">
                                        <div class="row">
                                            <div class="col-md-4 col-12">
                                                <div class="form-group">
                                                    <label for="first-name-vertical">Role</label>
                                                    <select name="role" id="role" class="form-control">
                                                        <option value="">---Select Role---</option>
                                                        @if (!empty($Roles))
                                                            @foreach ($Roles as $role)
                                                                <option value="{{$role->id}}" {{ isset($current_role) && $current_role == $role->id ? "selected" : "" }}>{{$role->name}}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                    @error('role')
                                                        <div class="alert alert-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            @if (!empty($PermissionData))
                            <form id="permissionForm" method="post" action="{{route('save.all.permission')}}">
                            @csrf
                            <div class="text-right">
                                    <button type="submit" class="btn btn-danger">Save</button>
                                </div>
                                    <div class="table-responsive">
                                        <table class="table permission-details">
                                            <thead>
                                                <tr>
                                                    <th>Role</th>
                                                    <th>Module</th>
                                                    <th>Add</th>
                                                    <th>Update</th>
                                                    <th>Delete</th>
                                                    <th>View</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if (!empty($PermissionData))
                                                <?php $i=0; ?>
                                                    @foreach ($PermissionData as $perm)

                                                    <tr>
                                                        <input type="hidden" name="permission[{{$i}}][moduleId]" value="{{$perm->moduleId}}">
                                                        <input type="hidden" name="permission[{{$i}}][roleId]" value="{{$perm->roleId}}">
                                                        <td>{{$perm->roleName}}</td>
                                                        <td>{{$perm->moduleName}}</td>
                                                        <td>
                                                            <input type="checkbox" name="permission[{{$i}}][add]" {{$perm->moduleName}} {{$perm->add == 1 ? "checked" : ""}}  value="1"  />
                                                        </td>
                                                        <td>
                                                            <input type="checkbox" name="permission[{{$i}}][edit]" {{$perm->edit == 1 ? "checked" : ""}}  value="1"  />
                                                        </td>
                                                        <td>
                                                            <input type="checkbox" name="permission[{{$i}}][delete]" {{$perm->delete == 1 ? "checked" : ""}}  value="1"  />
                                                        </td>
                                                        <td>
                                                            <input type="checkbox" name="permission[{{$i}}][view]" {{$perm->view == 1 ? "checked" : ""}}  value="1"  />
                                                        </td>
                                                    </tr>
                                                    <?php $i++; ?>
                                                    @endforeach
                                                @endif
                                            </tbody>
                                        </table>
                                        <div class="card-footer"><div class="text-right">
                                            <button type="submit" class="btn btn-danger">Save</button>
                                        </div></div>
                                    </div>
                            </form>

                                @endif
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
            $('.permission-details').DataTable({
                "ordering": false,"responsive": true, "lengthChange": false, "autoWidth": false,
            });

            $('#role').change(function() {
                var roleId = $(this).val();
                if (roleId != "") {
                    location.href = "{{route('fetch.permission')}}?roleId=" + roleId;
                }
            });

        });

        function changePermission(roleId, moduleId, value, type) {
                if (roleId != "" && moduleId != "" && value != "" && type != "") {
                    $.ajax({
                        type: "GET",
                        url: "{{url('add-permission')}}?roleId=" + roleId + "&moduleId=" + moduleId + "&value=" + value + "&type=" + type,
                        success: function(res) {
                            if (res == "success") {
                                location.reload();
                            }
                            console.log(res);
                        }
                    });
                }
            }
    </script>
@endsection