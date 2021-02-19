@extends('layouts.client_dashboard_layout')
@section('title') Create Link @endsection
@section('content')
    @include('tools.spinner')
    <div class="create-link-sec pt-5 pb-4">
        <div class="container">
            <div class="col-lg-10 offset-lg-1">
                <div class="row">
                    <div class="col-12 mb-3 form-group">
                        <form action="{{route('insert.link.group')}}" enctype="multipart/form-data" id="AddLinkGroupForm" method="POST">
                            @csrf
                            <div class="form-group">
                                <label>Group Icon</label>
                                <div class="col-lg-12 row p-0">
                                    <div class="col-lg-8">
                                        <input type="file" name="group_icon" id="group_icon" class="form-control mt-2 img_file" />
                                    </div>
                                    <div class="col-lg-4 text-right">
                                        <img src="{{asset('client/images/placeholder.png')}}" id="img_preview" class="group_icon_preview" alt="Group Icon Preview" />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Group Name <span class="text-danger">*</span></label>
                                <div class="col-lg-12 p-0">
                                    <input type="text" name="group_name" id="group_name" class="form-control mt-2" placeholder="Enter group name" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Choose Links <span class="text-danger">*</span></label>
                                <ul class="list-group pre-scrollable mt-2">
                                    @if (!empty($UserLinks))
                                        @foreach ($UserLinks as $link)
                                            <li class="list-group-item">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <input id="{{$link->id}}" type="checkbox" name="user_links[]" value="{{$link->id}}" />
                                                        <label for="{{$link->id}}">
                                                            <a href="#">{{$link->generated_link}}</a>
                                                        <p class="mt-2">{{$link->link_title}}</p>
                                                        </label>
                                                    </div>
                                                </div>
                                            </li>  
                                        @endforeach
                                    @else
                                        zsasd
                                    @endif
                                </ul>
                            </div>
                            <div class="form-group">
                                <div class="col-lg-12 p-0 text-right">
                                    <button type="submit" class="btn btn-primary btn-create-group">Create Group</button>
                                    <button type="reset" class="btn btn-secondary">Reset</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $('#group_icon').change(function() {
            var file = $('input[type="file"]').val();
            var exts = ['jpg','jpeg','png'];
            // first check if file field has any value
            if ( file ) {
                // split file name at dot
                var get_ext = file.split('.');
                // reverse name to check extension
                get_ext = get_ext.reverse();
                // check file type is valid as given in 'exts' array
                if ( $.inArray ( get_ext[0].toLowerCase(), exts ) > -1 ){
                    $('#btn-create-group').prop('disabled',false);
                } else {
                    Swal.fire({ 
                        type: "error", 
                        title: "Invalid file extension.", 
                        text: "Only files with .jpg, .jpeg or .png extension are supported.", 
                        showCancelButton: 0,
                    })
                    $('#btn-create-group').prop('disabled',true);
                }
            }
        });
    </script>
@endsection