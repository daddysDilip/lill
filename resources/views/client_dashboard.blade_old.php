@extends('layouts.client_dashboard_layout')
@section('title')
    Dashboard
@endsection
@section('css')
<style>
.modal-btn-close {
    font-size: 21px !important;
    line-height: 1 !important;
    filter: alpha(opacity=20) !important;
    background: transparent !important;
    padding: 0px !important;
    margin: 0px !important;
}
.modal-header .row img {
    width: 35px;
    height: 35px;
    float: left;
}

.modal-header .row .modal-title {
    position: relative;
    left: 10px;
    font-size: 20px;
}

.nav-icon {
    width: 32px;
    height: auto;
}
</style>
@show
@include('tools.spinner')
@section('content')
    
    @if (!empty(check_user_verified(Auth::guard('user')->user()->id)) && check_user_verified(Auth::guard('user')->user()->id)->status == 0)
        <div class="alert alert-info text-center" role="alert">
            Your account has not been verified. Please check your email to verify by clicking on verify link.
        </div>
    @endif
    <div class="dashboard-sec">
        <div class="top-area pt-5 pb-5">
            <div class="container">
                <form action="{{route('get.link.details')}}" method="POST" id="LinkFilterForm">
                    @csrf
                    <div class="search position-relative mb-4">
                        <div class="row extra-small-gutter align-items-center">
                            <div class="col-lg-10">
                                <div class="position-relative">
                                    <input class="form-control" type="text" name="search_link" id="search_link" placeholder="Seach anything here..." />
                                    <button type="button" class="btn search-btn btn-link text-white position-absolute border-left h-100 rounded-0">
                                        SEARCH
                                    </button>
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <a href="{{route('create.link')}}" class="btn btn-theme btn-block text-white text-uppercase p-2">Create</a>
                            </div>
                        </div>
                    </div>
                    <div class="row align-items-center justify-content-center mt-5">
                        <div class="col-lg-3">
                            <div class="d-flex align-items-center justify-content-center">
                                <label class="col-form-label">Copy Clipboard</label>
                                <label class="switch ml-3">
                                    <input type="checkbox">
                                    <span class="slider round"></span>
                                </label>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="bg-white">
                                <button class="btn btn-theme p-2 btn-block"><i class="sprite lock-icon"></i>&nbsp; Purchase Premium</button>
                            </div> 
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="middle-area">
            <div class="row no-gutter links-section">
                
            </div>        
        </div>
    </div>
    
    <div class="modal" id="share-link" tabindex="-1" role="dialog">

    </div>
    
@endsection

@section('js')
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script> 
    <script>
        $(document).ready(function() {

                       

            $('#LinkFilterForm').validate({
                rules:{
                    search_link:"required"
                },
                submitHandler: function (form) {
                    get_link_details($('#search_link').val(),"","");
                }
            });

            $(document).ajaxSend(function() {
                $("#overlay").fadeIn(300);　
            });

            $('.setting-icon').on('click', function (e) {
            $('.filter-options').toggleClass("active");
                e.preventDefault();
            });


            var link_code = $(".nav-pills .nav-link.active").attr("data-link_code");
            get_link_details("all","","");

            $( ".nav-link" ).on( "click", function() {
                //$('.nav-pills a[href="' + $(this).attr('href') + '"]').trigger('click');
                var link_code = $(this).attr('data-link_code');
                get_link_details(link_code,"","");
            });
            
            var html = '<ul class="ui-menu ui-widget ui-widget-content ui-autocomplete ui-front" id="ui-custom-id" style=" width: 992px; top: 155.6px; left: 163.6px;"><li class="ui-menu-item"><div id="ui-id-2" tabindex="-1" class="ui-menu-item-wrapper">https://lill.pw/h9p</div></li></ul>';

            $("#search_link").autocomplete({
                source: function(request, response) {
                    $.ajax({
                        url: "{{ route('search.link') }}",
                        data: {
                            'search_link': request.term,
                            '_token': "{{csrf_token()}}"
                        },
                        type: "POST",
                        success: function(result) {
                            var res = jQuery.parseJSON(result);
                            if(res != "") {
                                response(jQuery.parseJSON(result));
                            } else {
                                response([{ label: 'No results found. Do you want to create link?', value: -1}]);
                            }
                        },
                        error:function() {
                            setTimeout(function(){
                                $("#overlay").fadeOut(300);
                            },500);
                        }
                    }).done(function() {
                        setTimeout(function(){
                            $("#overlay").fadeOut(300);
                        },500);
                    });
                },
                select: function(event, ui) {
                    $('#search_link').val(ui.item.label); // display the selected text
                    $('#search_link_id').val(ui.item.value); // save selected id to input
                    if(ui.item.value == -1) {
                        location.href = "{{route('create.link')}}";
                    } else {
                        get_link_details(ui.item.value,"","");
                    }
                    return false;
                },
                minLength: "5"
            });
        });

        function get_link_details(link_code,sort_by,sort_date) {       
            $.ajax({
                type:"POST",
                url:"{{route('get.link.details')}}",
                data:{
                    link_code:link_code,
                    '_token':"{{csrf_token()}}"
                },
                success:function(res) {
                    if(res.status == "200") {
                        $('.links-section').html(res.data);
                    } else if(res.status == "204") {
                        $('.links-section').html(res.data);
                    }
                }
            }).done(function() {
                setTimeout(function(){
                    $("#overlay").fadeOut(300);
                },500);
            });
        }
    </script>   
@endsection
