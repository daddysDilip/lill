@extends('layouts.client_dashboard_layout')
@section('title')
    Bulk
@endsection
@section('content')
    <div class="create-link-sec pt-4 pb-4">
        <div class="container">
            <div class="row">
                <div class="col-3">
                    <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                        <a class="nav-link p-3 {{!empty($tab) && $tab == "export_links" ? 'active' : ''}}" id="v-pills-export-tab" href="{{route('user.bulk.links')}}">Export Links</a>
                        <a class="nav-link p-3 {{!empty($tab) && $tab == "import_links" ? 'active' : ''}}" id="v-pills-import-tab" href="{{route('user.bulk.import.links')}}">Import Bulk Links</a>
                    </div>
                </div>
                <div class="col-9">
                    <div class="tab-content" id="v-pills-tabContent">
                        @include('tools.flash-message')
                        <div class="tab-pane fade {{!empty($tab) && $tab == "export_links" ? 'show active' : ''}}" id="v-pills-export" role="tabpanel" aria-labelledby="v-pills-export-tab">
                            <form action="{{route('export.links')}}" method="POST" id="ExportLinks">
                                @csrf
                                <div class="form-group row">
                                    <div class="col-lg-12 text-right">
                                        <button type="submit" class="btn btn-sm btn-primary">Export</button>
                                    </div>
                                </div>
                                <ul class="list-group pre-scrollable mt-2">
                                    @if (!empty($UserLinks))
                                        @foreach ($UserLinks as $link)
                                            <li class="list-group-item">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <input id="{{$link->id}}" type="checkbox" name="user_links[]" value="{{$link->id}}" />
                                                        <label for="{{$link->id}}">
                                                            <a href="#">{{remove_http($link->generated_link)}}</a>
                                                        <p class="mt-2">{{$link->link_title}}</p>
                                                        </label>
                                                    </div>
                                                </div>
                                            </li>  
                                        @endforeach
                                    @else
                                        <li class="list-group-item">
                                            <div class="row">
                                                <div class="col-12">
                                                    No links found.
                                                </div>
                                            </div>
                                        </li>  
                                    @endif
                                </ul>
                            </form>
                        </div>
                        <div class="tab-pane fade {{!empty($tab) && $tab == "import_links" ? 'show active' : ''}}" id="v-pills-import" role="tabpanel" aria-labelledby="v-pills-import-tab">
                            <form action="{{route('bulk.links.import')}}" method="POST" id="ImportLinksForm" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group row">
                                    <div class="col-lg-12 text-right">
                                        <a href="{{route('download.sample.file')}}" class="btn btn-secondary">Download Sample File</a>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-6">
                                        <input type="file" name="import_links" id="import_links"  class="form-control" />
                                    </div>
                                    <div class="col-lg-6">
                                        <button type="submit" class="btn btn-primary btn-block btn-import-links">Import Links</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $('#ExportLinks').validate({
            rules:{
                'user_links[]':{
                    required:true
                }
            }
        });

        $('#ImportLinksForm').validate({
            rules:{
                'import_links':{
                    required:true
                }
            },
            messages:{
                import_links:{
                    required:"Please select file to import."
                }
            }
        });

        $('#import_links').change(function() {
            var file = $('input[type="file"]').val();
            var exts = ['xls','xlsx'];
            // first check if file field has any value
            if ( file ) {
                // split file name at dot
                var get_ext = file.split('.');
                // reverse name to check extension
                get_ext = get_ext.reverse();
                // check file type is valid as given in 'exts' array
                if ( $.inArray ( get_ext[0].toLowerCase(), exts ) > -1 ){
                    $('.btn-import-links').prop('disabled',false);
                } else {
                    Swal.fire({ 
                        type: "error", 
                        title: "Invalid file extension.", 
                        text: "Only files with .xls, .xlxs extension are supported.", 
                        showCancelButton: 0,
                    })
                    $('.btn-import-links').prop('disabled',true);
                }
            }
        });
    </script>
@endsection
