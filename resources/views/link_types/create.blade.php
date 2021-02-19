@extends('layouts.admin_layout')
@section('title')Add Link Type @endsection
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
                    <li class="breadcrumb-item active">{{!empty($LinkType) ? "Update" : "Create"}} Link Type
                    </li>
                  </ol>
                </div>
              </div>
              <div class="col-2 text-right">
                <a href="{{route('manage.link.types')}}" class="btn btn-black"><i class="bx bx-left-arrow-alt"></i> Back</a>
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
                                    @if (!empty($LinkType))
                                        <form class="form form-vertical" action="{{ route('modules.update', $Module->id) }}" method="POST" id="ModuleForm">
                                    @else
                                        <form class="form form-vertical" action="{{route('modules.store')}}" method="POST" id="ModuleForm">
                                    @endif
                                        @csrf
                                        <div class="form-body">
                                            <div class="row">
                                                <div class="col-md-4 col-12">
                                                    <div class="form-group">
                                                        <label for="first-name-vertical">Module name</label>
                                                        <input type="text" id="module" value="{{$Module->name ?? ''}}" class="form-control" name="module" placeholder="Enter module name">
                                                        @error('module')
                                                            <div class="alert alert-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <div class="checkbox">
                                                            <input type="checkbox" name="status" {{ isset($Module) ? (($Module->status == 1) ? 'checked' : '') : '' }} value="1" class="checkbox-input" id="checkbox3">
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
            $('#ModuleForm').validate({
                rules:{
                    module:"required"
                },
                messages:{
                    module:"Please enter module name."
                }
            });
        })
    </script>
@endsection