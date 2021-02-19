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
                                    <button type="submit" class="btn btn-theme search-btn text-white position-absolute border-left h-100 rounded-0 pl-3 pr-3">
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
                        <div class="col-lg-3 mb-3">
                            <div class="d-flex align-items-center justify-content-center">
                                <label class="col-form-label">Copy Clipboard</label>
                                <label class="switch ml-3">
                                    <input type="checkbox">
                                    <span class="slider round"></span>
                                </label>
                            </div>
                        </div>
                        <div class="col-lg-3 mb-3">
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
                <div class="links-list-block col-lg-4">

                </div>
                <div class="links-details col-lg-8">

                </div>
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

            // $('.notification-dropdown-button').click(function() {
            //     $.ajax({
            //         url:"{{route('read.all.notification')}}",
            //         type:"GET",
            //         data:{
            //             '_token':"{{csrf_token()}}"
            //         }
            //     }).done(function() {
            //         $('#overlay').fadeOut(300);
            //     });
            // });

            $('#LinkFilterForm').validate({
                rules:{
                    search_link:"required"
                },
                submitHandler: function (form) {
                    $.ajax({
                        type:"POST",
                        url:"{{route('get.links')}}",
                        data:{
                            search_link:$('#search_link').val(),
                            '_token':"{{csrf_token()}}"
                        },
                        success:function(res) {
                            if(res.status == "200") {
                                $('.links-list-block').html(res.data);
                                var link_id = $(".nav-pills .nav-link.active").attr("data-link_id");
                                console.log('link_id-------------->',link_id);

                                if(link_id > 0) {
                                    getSingleLink(link_id);
                                }
                            } else if(res.status == "204") {
                                $('.links-section').html("");
                                $('.links-section').html(res.data);
                            }
                        }
                    }).done(function() {
                        setTimeout(function(){
                            $("#overlay").fadeOut(300);
                        },500);
                    });
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

        function getMonthlyReport(link_id) {
            $.ajax({
                url:"{{route('get.link.monthly.report')}}",
                type:"POST",
                data:{
                    link_id:link_id,
                    '_token':"{{csrf_token()}}"
                },
                success:function(data) {
                    var Years = new Array();
                    var Months = new Array();
                    var Labels = new Array();
                    var Clicks = new Array();
                    data.monthly_report.forEach(function(data){
                        Months.push(data.month);
                        //Labels.push(data.stockName);
                        Clicks.push(data.total_clicks);
                    });
                    var ctx = document.getElementById("canvas").getContext('2d');
                    var myChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                            labels:Months,
                            datasets: [{
                                label: 'Total Clicks',
                                data: Clicks,
                                borderWidth: 1,
                                borderColor:[
                                    'red',    
                                    'rgba(0,0,230,0.5)',   
                                    'green', 
                                    'black',
                                    'purple',
                                    'yellow',
                                    'pink',
                                    'orange',
                                    'grey',
                                    'brown',
                                    'cyan',
                                    'violet'
                                ],
                                backgroundColor:[
                                    'rgba(250,0,0,0.2)',    
                                    'rgba(0,0,230,0.5)',   //rgba(0,0,230,0.5)
                                    'rgba(0,117,0.5)', 
                                    'rgba(0,0,0)',
                                    'purple',
                                    'yellow',
                                    'pink',
                                    'orange',
                                    'grey',
                                    'brown',
                                    'cyan',
                                    'violet'
                                ]
                            }],
                    },
                    options: {
                        responsive:true,
                        maintainAspectRation:false,
                        scales: {
                                yAxes: [{
                                    display:true,
                                    ticks: {
                                        beginAtZero:true,
                                        steps:1,
                                        stepValue:1,
                                        stepSize:1
                                    }
                                }]
                        }
                    }
                    });
                    
                    $('#map1').vectorMap({
                        map: 'world_mill_en',
                        panOnDrag: true,
                        focusOn: {
                            x: 0.5,
                            y: 0.5,
                            scale: 1,
                            animate: true
                        },
                        series: {
                            regions: [{
                                scale: ['#E1E1E1', '#51A3ED'],
                                normalizeFunction: 'polynomial',
                                values: {
                                    "AF": 16.63,
                                    "AL": 11.58,
                                    "DZ": 158.97,
                                    "AO": 85.81,
                                    "AG": 1.1,
                                    "AR": 351.02,
                                    "AM": 8.83,
                                    "AU": 1219.72,
                                    "AT": 366.26,
                                    "AZ": 52.17,
                                    "BS": 7.54,
                                    "BH": 21.73,
                                    "BD": 105.4,
                                    "BB": 3.96,
                                    "BY": 52.89,
                                    "BE": 461.33,
                                    "BZ": 1.43,
                                    "BJ": 6.49,
                                    "BT": 1.4,
                                    "BO": 19.18,
                                    "BA": 16.2,
                                    "BW": 12.5,
                                    "BR": 2023.53,
                                    "BN": 11.96,
                                    "BG": 44.84,
                                    "BF": 8.67,
                                    "BI": 1.47,
                                    "KH": 11.36,
                                    "CM": 21.88,
                                    "CA": 1563.66,
                                    "CV": 1.57,
                                    "CF": 2.11,
                                    "TD": 7.59,
                                    "CL": 199.18,
                                    "CN": 5745.13,
                                    "CO": 283.11,
                                    "KM": 0.56,
                                    "CD": 12.6,
                                    "CG": 11.88,
                                    "CR": 35.02,
                                    "CI": 22.38,
                                    "HR": 59.92,
                                    "CY": 22.75,
                                    "CZ": 195.23,
                                    "DK": 304.56,
                                    "DJ": 1.14,
                                    "DM": 0.38,
                                    "DO": 50.87,
                                    "EC": 61.49,
                                    "EG": 216.83,
                                    "SV": 21.8,
                                    "GQ": 14.55,
                                    "ER": 2.25,
                                    "EE": 19.22,
                                    "ET": 30.94,
                                    "FJ": 3.15,
                                    "FI": 231.98,
                                    "FR": 2555.44,
                                    "GA": 12.56,
                                    "GM": 1.04,
                                    "GE": 11.23,
                                    "DE": 3305.9,
                                    "GH": 18.06,
                                    "GR": 305.01,
                                    "GD": 0.65,
                                    "GT": 40.77,
                                    "GN": 4.34,
                                    "GW": 0.83,
                                    "GY": 2.2,
                                    "HT": 6.5,
                                    "HN": 15.34,
                                    "HK": 226.49,
                                    "HU": 132.28,
                                    "IS": 12.77,
                                    "IN": 15000.02,
                                    "ID": 695.06,
                                    "IR": 337.9,
                                    "IQ": 84.14,
                                    "IE": 204.14,
                                    "IL": 201.25,
                                    "IT": 2036.69,
                                    "JM": 13.74,
                                    "JP": 5390.9,
                                    "JO": 27.13,
                                    "KZ": 129.76,
                                    "KE": 32.42,
                                    "KI": 0.15,
                                    "KR": 986.26,
                                    "KW": 117.32,
                                    "KG": 4.44,
                                    "LA": 6.34,
                                    "LV": 23.39,
                                    "LB": 39.15,
                                    "LS": 1.8,
                                    "LR": 0.98,
                                    "LY": 77.91,
                                    "LT": 35.73,
                                    "LU": 52.43,
                                    "MK": 9.58,
                                    "MG": 8.33,
                                    "MW": 5.04,
                                    "MY": 218.95,
                                    "MV": 1.43,
                                    "ML": 9.08,
                                    "MT": 7.8,
                                    "MR": 3.49,
                                    "MU": 9.43,
                                    "MX": 1004.04,
                                    "MD": 5.36,
                                    "MN": 5.81,
                                    "ME": 3.88,
                                    "MA": 91.7,
                                    "MZ": 10.21,
                                    "MM": 35.65,
                                    "NA": 11.45,
                                    "NP": 15.11,
                                    "NL": 770.31,
                                    "NZ": 138,
                                    "NI": 6.38,
                                    "NE": 5.6,
                                    "NG": 206.66,
                                    "NO": 413.51,
                                    "OM": 53.78,
                                    "PK": 174.79,
                                    "PA": 27.2,
                                    "PG": 8.81,
                                    "PY": 17.17,
                                    "PE": 153.55,
                                    "PH": 189.06,
                                    "PL": 438.88,
                                    "PT": 223.7,
                                    "QA": 126.52,
                                    "RO": 158.39,
                                    "RU": 1476.91,
                                    "RW": 5.69,
                                    "WS": 0.55,
                                    "ST": 0.19,
                                    "SA": 434.44,
                                    "SN": 12.66,
                                    "RS": 38.92,
                                    "SC": 0.92,
                                    "SL": 1.9,
                                    "SG": 217.38,
                                    "SK": 86.26,
                                    "SI": 46.44,
                                    "SB": 0.67,
                                    "ZA": 354.41,
                                    "ES": 1374.78,
                                    "LK": 48.24,
                                    "KN": 0.56,
                                    "LC": 1,
                                    "VC": 0.58,
                                    "SD": 65.93,
                                    "SR": 3.3,
                                    "SZ": 3.17,
                                    "SE": 444.59,
                                    "CH": 522.44,
                                    "SY": 59.63,
                                    "TW": 426.98,
                                    "TJ": 5.58,
                                    "TZ": 22.43,
                                    "TH": 312.61,
                                    "TL": 0.62,
                                    "TG": 3.07,
                                    "TO": 0.3,
                                    "TT": 21.2,
                                    "TN": 43.86,
                                    "TR": 729.05,
                                    "TM": 0,
                                    "UG": 17.12,
                                    "UA": 136.56,
                                    "AE": 239.65,
                                    "GB": 2258.57,
                                    "US": 14624.18,
                                    "UY": 40.71,
                                    "UZ": 37.72,
                                    "VU": 0.72,
                                    "VE": 285.21,
                                    "VN": 101.99,
                                    "YE": 30.02,
                                    "ZM": 15.69,
                                    "ZW": 5.57
                                }
                            }]
                        },
                        onRegionTipShow: function(e, el, code) {
                            el.html(el.html()+' (Total Clicks : )');
                        }
                    });
                }
            }).done(function() {
                setTimeout(function() {
                    $('#overlay').fadeOut(300);
                },500);
            });
        }

        function getSingleLink(link_id) {
            $.ajax({
                type:"POST",
                url:"{{route('get.link.details')}}",
                data:{
                    link_id:link_id,
                    '_token':"{{csrf_token()}}"
                },
                success:function(res) {
                    if(res.status == "200") {
                        getMonthlyReport(link_id);
                        $('.links-details').html(res.data);
                    } else if(res.status == "204") {
                        $('.links-section').html("");
                        $('.links-section').html(res.data);
                    }
                }
            }).done(function() {
                setTimeout(function(){
                    $("#overlay").fadeOut(300);
                },500);
            });
        }

        function get_link_details(link_code,sort_by,sort_date) { 
            
            $.ajax({
                type:"POST",
                url:"{{route('get.links')}}",
                data:{
                    link_code:link_code,
                    '_token':"{{csrf_token()}}"
                },
                success:function(res) {
                    if(res.status == "200") {
                        $('.links-list-block').html(res.data);
                        var link_id = $(".nav-pills .nav-link.active").attr("data-link_id");
                        if(link_id > 0) {
                            getSingleLink(link_id);
                        }
                    } else if(res.status == "204") {
                        $('.links-section').html("");
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
