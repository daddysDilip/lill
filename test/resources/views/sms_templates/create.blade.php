@extends('layouts.admin_layout')
@section('title')Add SMS Template @endsection
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
                    <li class="breadcrumb-item active">{{!empty($Template) ? "Update" : "Create"}} SMS Template
                    </li>
                  </ol>
                </div>
              </div>
              <div class="col-2 text-right">
                <a href="{{route('sms.templates')}}" class="btn btn-black"><i class="bx bx-left-arrow-alt"></i> Back</a>
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
                                    @if (!empty($Template))
                                        <form class="form form-vertical" action="{{ route('sms.templates.update', $Template->id) }}" method="POST" id="SMSTemplate">
                                    @else
                                        <form class="form form-vertical" action="{{route('sms.templates.store')}}" method="POST" id="SMSTemplate">
                                    @endif
                                        @csrf
                                        <div class="form-body">
                                            <div class="row">
                                                <div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="first-name-vertical">Title</label>
                                                        <input type="text" id="title" value="{{$Template->title ?? ''}}" class="form-control" name="title" placeholder="Enter sms title">
                                                        @error('title')
                                                            <div class="alert alert-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="first-name-vertical">Label</label>
                                                        <input type="text" id="label" value="{{$Template->label ?? ''}}" class="form-control" name="label" placeholder="Enter sms label">
                                                        @error('label')
                                                            <div class="alert alert-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-8 col-12">
                                                    <div class="form-group">
                                                        <label for="first-name-vertical">Content</label>
                                                        <textarea name="content" id="content" class="form-control">{{$Template->content ?? ''}}</textarea>
                                                        @error('content')
                                                            <div class="alert alert-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    <div class="form-group">
                                                        <div class="checkbox">
                                                            <input type="checkbox" name="status" {{ isset($Template) ? (($Template->status == 1) ? 'checked' : '') : '' }} value="1" class="checkbox-input" id="checkbox3">
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
    <script src="{{asset('ckeditor/ckeditor.js')}}"></script>
    <script>
        $(document).ready(function() {
            CKEDITOR.replace( 'content' );
            $('#SMSTemplate').validate({
                ignore: [],
                debug: false,
                rules:{
                    title:"required",
                    label:"required",
                    content:{
                        required: function() 
                        {
                         CKEDITOR.instances.content.updateElement();
                        },

                         minlength:10
                    }
                }
            });
        })
    </script>
@endsection