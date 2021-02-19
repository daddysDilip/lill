@extends('layouts.client_dashboard_layout')
@section('title') Create Link @endsection
@section('content')
    @include('tools.spinner')
    <div class="create-link-sec pt-4 pb-4">
            <div class="container">
                {{-- <img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(200)->generate('My First QR code')) !!} "> --}}
                <div class="col-lg-10 offset-lg-1">
                    <div class="media mt-4 mb-4 meta-block">
                        <img class="mr-3 website-favicon" src="{{asset('client/images/computer.png')}}" style="width:50px;" />
                        <div class="media-body">
                            <h5 class="mt-0 mb-1 heading-s2 website-short-url">lill.pw/rrooiwo</h5>
                            <p class="website-title">
                                DaddysCode Hire mobile app developers at best cost for mobile app & game development in
                                Surat
                            </p>
                        </div>
                    </div>
                    <div class="">
                        <form id="ClientCreateLinkForm">
                            @csrf
                            <input type="hidden" name="link_title" id="link_title" />
                            <input type="hidden" name="link_code" id="link_code" />
                            <div class="row">
                                <div class="col-12 mb-3 form-group">
                                    <label class="col-form-label d-flex align-items-center">Destination URL <i
                                            type="button" class="sprite tooltips tooltip-icon ml-1"
                                            data-toggle="tooltip" data-placement="right"
                                            title="Destination URL is the long link you want to shorten"></i></label>
                                    <textarea name="website_url" id="website_url" class="form-control p-3" rows="1"
                                        placeholder="Type or paste a link (URL)"></textarea>
                                        <span class="url-msg error"></span>
                                </div>
                            </div>
                            <div class="row small-gutter">
                                {{-- <div class="col-lg-6 form-group">
                                    <label class="col-form-label">Domain</label>
                                    <input class="form-control" type="text" placeholder="Enter domain name" />
                                </div> --}}
                                <div class="col-lg-12 form-group">
                                    <label class="col-form-label">Slash tag</label>
                                    <input class="form-control" readonly type="text" id="slash_tag" name="slash_tag" placeholder="Slash tag (eg. card)" />
                                </div>
                            </div>
                            <div class="row small-gutter">
                                <div class="col-lg-12 form-group">
                                    <label class="col-form-label">Tags</label>
                                    <input type="text" id="link_tags" name="link_tags" class="form-control" data-role="tagsinput" />
                                </div>
                            </div>
                            <label class="col-form-label">Choose a slash tag style</label>
                            <ul class="d-lg-flex mt-3">
                                <li class="mr-4 mb-3">
                                    <div class="form-check">
                                        <input class="form-check-input mt-0" checked type="radio" value="1" name="link_type" id="r1" />
                                        <label class="form-check-label" for="r1">
                                            Shortest
                                        </label>
                                        <i type="button" class="sprite tooltips tooltip-icon ml-1" data-toggle="tooltip"
                                            data-placement="right" title="Tooltip on right"></i>
                                    </div>
                                </li>
                                <li class="mr-4 mb-3">
                                    <div class="form-check">
                                        <input class="form-check-input mt-0" type="radio" name="link_type" value="2" id="r2" />
                                        <label class="form-check-label" for="r2">
                                            Random
                                        </label>
                                        <i type="button" class="sprite tooltips tooltip-icon ml-1" data-toggle="tooltip"
                                            data-placement="right" title="Tooltip on right"></i>
                                    </div>
                                </li>
                                <li class="mr-4 mb-3">
                                    <div class="form-check">
                                        <input class="form-check-input mt-0" type="radio" value="3" name="link_type" id="r3" />
                                        <label class="form-check-label" for="r3">
                                            Suggested
                                        </label>
                                        <i type="button" class="sprite tooltips tooltip-icon ml-1" data-toggle="tooltip"
                                            data-placement="right" title="Tooltip on right"></i>
                                    </div>
                                </li>
                                <li class="mr-4 mb-3">
                                    <div class="form-check">
                                        <input class="form-check-input mt-0" type="radio" value="4" name="link_type" id="r4" />
                                        <label class="form-check-label" for="r4">
                                            Suggested with dash (SEO friendly)
                                        </label>
                                        <i type="button" class="sprite tooltips tooltip-icon ml-1" data-toggle="tooltip"
                                            data-placement="right" title="Tooltip on right"></i>
                                    </div>
                                </li>
                                <li class="mr-4 mb-3">
                                    <div class="form-check">
                                        <input class="form-check-input mt-0" type="radio" value="5" name="link_type" id="r5" />
                                        <label class="form-check-label" for="r5">
                                            Suggested camel case
                                        </label>
                                        <i type="button" class="sprite tooltips tooltip-icon ml-1" data-toggle="tooltip"
                                            data-placement="right" title="Tooltip on right"></i>
                                    </div>
                                </li>
                            </ul>
                            <div class="col-lg-6 mt-5 form-group offset-lg-3">
                                <button class="btn btn-theme btn-block p-2">Create Link</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
@endsection

@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
<script type="text/javascript">
    $('.tooltips').tooltip();
    var clipboard = new ClipboardJS('.btn-copy');   
    clipboard.on('success', function(e) {
        $('.btn-copy').html('Copied!');
        $(".btn-copy").removeClass("btn-copy");
    });
    $(document).ajaxSend(function() {
        $("#overlay").fadeIn(300);　
    });
    $(document).ready(function() {
        var link_type = $('input:radio[name=link_type]:checked').val();
        $('#website_url').typeWatch({
            wait: 750,// 750ms
            highlight:true,
            captureLength: 5,
            callback: function(value) {
                $('.url-msg').html("");
                if($('#ClientCreateLinkForm').valid()) {
                    fetchMetaData(link_type);
                }
            }
        });

        $.validator.addMethod('validUrl', function (value) { 
            if(/^(?:(ftp|http|https)?:\/\/)?(?:[\w-]+\.)+([a-z]|[A-Z]|[0-9]){2,6}$/gi.test(value)) {
                return true;
            } 
            return false;
        }, 'Please enter valid URL which you want to shorten.');

        $('#ClientCreateLinkForm').validate({
            rules:{
                website_url: {
                    required:true
                },
                link_type:{
                    required:true
                },
                link_code:"required"
            },
            messages:{
                website_url:{
                    required:"Please enter valid URL.",
                },
                link_code:"Please enter slash tag."
            },
            submitHandler: function (form) {
                if($('#ClientCreateLinkForm').valid()) {
                    $.ajax({
                        url:"{{route('store.link')}}",
                        type:"post",
                        data:$('#ClientCreateLinkForm').serialize()+"&link_type="+$('input:radio[name=link_type]:checked').val(),
                        success:function(data) {
                            var res = JSON.parse(data);
                            if(res.status == "link-exist") {
                                Swal.fire({ 
                                    type: "error", 
                                    title: "Oops!", 
                                    text: res.msg, 
                                    showCancelButton: 1,
                                })
                            } else if(res.status == "success") {
                                Swal.fire({ 
                                    type: "success", 
                                    title: "Done!", 
                                    text: res.msg, 
                                    confirmButtonClass: "btn btn-success btn-copy"
                                }).then(function(confirm) {
                                    if(confirm) {
                                        location.reload();
                                    }  
                                })
                            } else if(res.status == "fail") {
                                Swal.fire({ 
                                    type: "error", 
                                    title: "Failed!", 
                                    text: res.msg, 
                                    showCancelButton: 1,
                                })
                            }
                        }
                    }).done(function() {
                        setTimeout(function(){
                            $("#overlay").fadeOut(300);
                        },500);
                    });
                }
            }
        });

        $('input:radio[name=link_type]').change(function(e) {
            link_type = e.target.value;
            if($('#website_url').val() == "") {
                $('.url-msg').html('Please enter valid URL which you want to shorten.');
            } else {
                link_type = e.target.value;
                fetchMetaData($.trim(link_type));
            }
        });

        function fetchMetaData(link_type) {
            console.log('link_type-------->', link_type);
            $.ajax({
                url:"{{route('fetch.website.schema')}}",
                type:"post",
                data:{website_url:$('#website_url').val(),link_type:link_type,'_token':"{{csrf_token()}}"},
                success:function(data) {
                    var res = JSON.parse(data);
                    var block = $('.meta-block');
                    if(res.status == 200) {
                        $("#link_code").prop('readonly', false);
                        if(res.favicon == null) {
                            $('.website-favicon').attr('src',"{{asset('client/images/computer.png')}}");
                        } else {
                            $('.website-favicon').attr('src', res.favicon);
                        }
                        $('.website-title').html(res.meta_title.title);
                        $('#link_title').val(res.meta_title.title);
                        $('#slash_tag').val(res.meta_title.link);
                        $('.website-short-url').html(res.meta_title.link);
                        $('#link_code').val(res.meta_title.code);
                    } else if(res.status == 404) {
                        Swal.fire({ 
                            type: "error", 
                            title: "Failed!", 
                            text: res.msg, 
                            showCancelButton: 1,
                        })
                    }
                },
                error:function(data) {
                    setTimeout(function(){
                        $("#overlay").fadeOut(100);
                    },500);
                }
            }).done(function() {
                setTimeout(function(){
                    $("#overlay").fadeOut(100);
                },500);
            }); 
        }
    });
</script>
@endsection