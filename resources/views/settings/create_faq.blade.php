@extends('layouts.admin_layout')
@section('title') {{!empty($FAQ) ? "Add" : "Update"}} FAQ @endsection
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
                    <li class="breadcrumb-item active">{{!empty($FAQ) ? "Update" : "Create"}} FAQ
                    </li>
                  </ol>
                </div>
              </div>
              <div class="col-2 text-right">
                <a href="{{route('manage.faq')}}" class="btn btn-black"><i class="bx bx-left-arrow-alt"></i> Back</a>
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
                                    @if (!empty($FAQ))
                                        <form class="form form-vertical" action="{{ route('faq.update', $FAQ->id) }}" method="POST" id="FAQForm">
                                    @else
                                        <form class="form form-vertical" action="{{route('faq.insert')}}" method="POST" id="FAQForm">
                                    @endif
                                        @csrf
                                        <div class="form-group row">
                                            <div class="col-lg-12">
                                                <label class="control-label">Question</label>
                                                <input type="text" name="question" id="question" class="form-control" value="{{$FAQ->question ?? ''}}" placeholder="Enter FAQ Question">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-lg-12">
                                                <label class="control-label">Answer</label>
                                                <textarea name="answer" id="answer" class="form-control" placeholder="Enter FAQ Question">{{$FAQ->answer ?? ''}}</textarea>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-lg-12">
                                                <input type="checkbox" name="status" id="status" value="1" {{!empty($FAQ) && $FAQ->status == 1 ? "checked" : ""}}  /> Active
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-lg-12 col-md-6 text-right">
                                                <button type="submit" class="btn btn-primary">Submit</button>
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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
            $('#FAQForm').validate({
                rules:{
                    question:{
                        required:true
                    },
                    answer:{
                        required:true
                    }
                },
                messages:{
                    question:{
                        required:"Please enter faq question.",
                    },
                    answer:{
                        required:"Please enter faq answer"
                    }
                }
            });
        })
    </script>
@endsection