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
                <h5 class="content-header-title float-left pr-1 mb-0">Plans</h5>
                <div class="breadcrumb-wrapper col-12">
                  <ol class="breadcrumb p-0 mb-0">
                    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active">{{!empty($Feature) ? "Update" : "Create"}} Plan Feature
                    </li>
                  </ol>
                </div>
              </div>
              <div class="col-2 text-right">
                <a href="{{route('plan.feature')}}" class="btn btn-black"><i class="bx bx-left-arrow-alt"></i> Back</a>
              </div>
            </div>
          </div>
        </div>
        <div class="content-body">
            <!-- Basic Vertical form layout section start -->
            @include('tools.flash-message')
            <section id="basic-vertical-layouts">
                <div class="row match-height">
                    <div class="col-md-12 col-12">
                        <div class="card">
                            <div class="card-content">
                                <div class="card-body">
                                    @if (!empty($Feature))
                                        <form class="form form-vertical" action="{{ route('plan.feature.update', $Feature->id) }}" method="POST" id="PlanFeature">
                                    @else
                                        <form class="form form-vertical" action="{{route('plan.feature.store')}}" method="POST" id="PlanFeature">
                                    @endif
                                        @csrf
                                        <div class="form-body">
                                            <div class="row">
                                                <div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="first-name-vertical">Plan Type</label>
                                                        <select name="plan_type" class="form-control" id="plan_type">
                                                            @if (!empty($PlanType))
                                                                @foreach ($PlanType as $type)
                                                                    <option value="{{$type->id}}" {{!empty($Feature->plan_type_id) && $Feature->plan_type_id == $type->id ? "selected" : "" }}>{{$type->plan_type}}</option>
                                                                @endforeach
                                                            @endif
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-12 d-flex justify-content-end">
                                                    @if (empty($Feature))
                                                        <div class="form-group">
                                                            <button type="button" class="btn btn-secondary btn-add-field mr-1 mb-1">Add</button>
                                                        </div>
                                                    @endif
                                                </div>
                                                @if (!empty($Feature))
                                                <div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="first-name-vertical">Feature Title</label>
                                                        <input type="text" id="title" class="form-control" name="title" value="{{$Feature->title ?? ''}}" placeholder="Enter feature title">
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="first-name-vertical">Feature Type</label>
                                                        <select name="feature_type" class="form-control feature_type" id="feature_type">
                                                            <option value="text" {{!empty($Feature->feature_type) && $Feature->feature_type == "text" ? "selected" : "" }}>Text</option>
                                                            <option value="check" {{!empty($Feature->feature_type) && $Feature->feature_type == "check" ? "selected" : "" }}>Check</option>
                                                            <option value="null" {{!empty($Feature->feature_type) && $Feature->feature_type == "null" ? "selected" : "" }}>Null</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="first-name-vertical">Feature Text</label>
                                                        <input type="text" id="feature_text" class="form-control" name="feature_text" value="{{$Feature->feature_text ?? ''}}" placeholder="Enter feature text">
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="first-name-vertical">Short Description</label>
                                                        <textarea name="description" id="description" placeholder="Enter short description" class="form-control">{{$Feature->short_description ?? ''}}</textarea>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <input type="checkbox" {{ isset($Feature) ? (($Feature->status == 1) ? 'checked' : '') : '' }} name="status" value="1" class="checkbox-input" id=""> Active
                                                    </div>
                                                </div>
                                                <div class="col-12 d-flex justify-content-end">
                                                    <button type="submit" class="btn btn-primary mr-1 mb-1">Submit</button>
                                                    <button type="reset" class="btn btn-light-secondary mr-1 mb-1">Reset</button>
                                                </div>
                                                @endif
                                                <div class="row col-lg-12 input_fields_wrap">
                                                    
                                                </div>
                                                <div class="col-12  text-right btn-submit-block" style="display:none;"><button type="submit" class="btn btn-primary mr-1 mb-1">Submit</button><button type="reset" class="btn btn-light-secondary mr-1 mb-1">Reset</button></div>
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
            var wrapper   		= $(".input_fields_wrap"); //Fields wrapper
            var add_button      = $(".btn-add-field"); //Add button ID
            
            var x = 1; //initlal text box count
            var fields = '';

            fields += '<div class="row col-lg-12 input_fields_wrap">';
                fields += '<div class="col-md-6 col-12"><div class="form-group"><label for="first-name-vertical">Feature Title</label><input type="text" id="title" class="form-control" name="title[]" placeholder="Enter feature title"></div></div>';
                fields += '<div class="col-md-6 col-12"><div class="form-group"><label for="first-name-vertical">Feature Type</label><select name="feature_type[]" class="form-control feature_type" id="feature_type"><option value="text">Text</option><option value="check">Check</option><option value="null">Null</option></select></div></div>';
                fields += '<div class="col-md-6 col-12"><div class="form-group"><label for="first-name-vertical">Feature Text</label><input type="text" id="feature_text" class="form-control" name="feature_text[]" placeholder="Enter feature text"></div></div>';
                fields += '<div class="col-md-6 col-12"><div class="form-group"><label for="first-name-vertical">Short Description</label><textarea name="description[]" id="description" placeholder="Enter short description" class="form-control"></textarea></div></div>';
                fields += '<a href="#" class="remove_field"><i class="bx bxs-minus-circle"></i></a><div class="col-6"><div class="form-group"><input type="checkbox" name="status[]" value="1" class="checkbox-input" id=""> Active</div>';
                fields += '';
            fields += '</div>';

            $(add_button).click(function(e){ //on add input button click
                e.preventDefault();
                x++; //text box increment
                $('.btn-submit-block').show();
                $(wrapper).append(fields); //add input box
            });
            
            $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
                $('.btn-submit-block').hide();
                e.preventDefault(); $(this).parent('div').remove(); x--;
            })

        });
    </script>
@endsection