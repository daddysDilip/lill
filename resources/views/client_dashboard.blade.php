@extends('layouts.client_dashboard_layout')
@section('title')
Links Detail
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
         <div class="row d-flex align-items-center justify-content-center justify-content-sm-start">
         <div class="col-md-12 col-lg-12 col-12">
               <form action="{{route('get.link.details')}}" method="POST" id="LinkFilterForm">
                  @csrf
                  <label class="mb-2" for="">Search link:</label>

                  <div class="search position-relative ">
                     <div class="row extra-small-gutter align-items-center">
                        <div class="col-lg-12 ">

                           <div class="position-relative">
                
                              <input class="form-control" type="text" name="search_link" id="search_link" placeholder="Seach anything here..." />
                              <button type="submit" class="btn btn-theme search-btn text-white position-absolute border-left h-100 rounded-0 pl-3 pr-3">
                              SEARCH
                              </button>
                           </div>
                        </div>
                     </div>
                  </div>
                  {{-- 
                  <div class="col-lg-2">
                     <a href="{{route('create.link')}}" class="btn btn-theme btn-block text-white text-uppercase p-2">Create</a>
                  </div>
                  --}}
                  <div class="row align-items-center  mt-3">
                     <div class="col-lg-3 mb-3">
                     </div>
                     {{-- 
                     <div class="col-lg-3 mb-3">
                        <div class="bg-white">
                           <button class="btn btn-theme p-2 btn-block"><i class="sprite lock-icon"></i>&nbsp; Purchase Premium</button>
                        </div>
                     </div>
                     --}}
                  </div>
               </form>
            </div>

            <div class="col-md-10 col-lg-10 col-12">
               <form method="POST" id="filterForm" class="mt-3">
                   <div class="fillter-area">

                  <div class="form-row d-flex justify-content-center align-items-center ">
                     <div class="form-group col-md-3">
                        <label class="mb-2" for="">Date:</label>
                        <input type="text" class="form-control fillters" name="daterange" id="selectDate" value="{{@$daterange}}"/>
                     </div>
                     <div class="form-group col-md-3">
                        <label class="mb-2" for="">Conutry:</label>
                        <select name="country" id="country" class="form-control fillters">
                           <option value="">Select Content</option>
                           @foreach ($LinkCountrys as $country)
                           <option value="{{$country->countryCode}}">{{$country->countryName}}</option>
                           @endforeach
                        </select>
                     </div>
                     <div class="form-group col-md-4">
                        <label class="mb-2" for="">Click Range:</label>
                        <div class="d-flex">
                            <input type="number" class="form-control fillters mr-2" name="min" id="minClick" placeholder="Min" />
                            <input type="number" class="form-control fillters" name="max" id="maxClick" placeholder="Max" />
                        </div>  
                    </div>
                    
                     <div class="form-group col-md-2 mt-3">
                        <input type="submit" class="btn  btn-block btn-theme p-1" value="Apply filters">
                     </div>
                  </div>
</div>
               </form>
            </div>
            <div class="col-md-2 col-lg-2 col-12 ">
                <div class="form-group ">
                <label class="mb-2" for="">Sort By:</label>

            <select name="linkFilter" id="linkFilter"  class="form-control sorting">
            <option value="" >Select Filter</option>
              <option value="highToLow">Clicks high to low</option>
              <option value="lowToHigh">Clicks low to high</option>
              <option value="oldToNew">Old to new</option>
              <option value="newToOld">New to old</option>
            </select>
             
            </div>
         </div>
      </div>
         <!-- <select name="linkFilter" id="linkFilter">
            <option value="" >Select Filter</option>
              <option value="highToLow">Clicks high to low</option>
              <option value="lowToHigh">Clicks low to high</option>
              <option value="oldToNew">Old to new</option>
              <option value="newToOld">New to old</option>
            </select> -->
      </div>
   </div>
   <div class="middle-area">
      <div class="row no-gutter links-section">
         <div class="links-list-block col-lg-5">
         </div>
         <div class="links-details col-lg-7">
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
<script src="https://code.highcharts.com/maps/highmaps.js"></script>
<script src="https://code.highcharts.com/maps/modules/data.js"></script>
<script src="https://code.highcharts.com/maps/modules/exporting.js"></script>
<script src="https://code.highcharts.com/maps/modules/offline-exporting.js"></script>
<script src="https://code.highcharts.com/mapdata/custom/world.js"></script>
<script>
   var selectedDate = null;
   var country = null;
   var minClick = null;
   var maxClick = null;
   var myShortingAttribute = null;
   $(function() {
       $('input[name="daterange"]').daterangepicker({
         opens: 'left',
         locale: {
            format: 'DD-MM-YYYY'
        }
       }, function(start, end, label) {
         console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
         selectedDate = start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD');
       });
     });
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
                           $('.links-details').html("");
                           $('.links-list-block').html(res.data);
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
   
               $.ajax({
                   url:"{{route('get.link.map')}}",
                   type:"POST",
                   data:{
                       link_id:link_id,
                       '_token':"{{csrf_token()}}"
                   },
                   success:function(data1) {
                       console.log('-------------1111------------>',data1);   
                       // Initiate the chart
                       Highcharts.mapChart('container', {
                           chart: {
                               map: 'custom/world'
                           },
   
                           title: {
                               text: 'Zoom in on country by double click'
                           },
   
                           mapNavigation: {
                               enabled: true,
                               enableDoubleClickZoomTo: true
                           },
   
                           colorAxis: {
                               min: 1,
                               max: 1000,
                               type: 'logarithmic'
                           },
   
                           series: [{
                               data: data1,
                               joinBy: ['iso-a3', 'code3'],
                               name: 'Population density',
                               states: {
                                   hover: {
                                       color: '#a4edba'
                                   }
                               },
                               tooltip: {
                                   valueSuffix: 'Clicks'
                               }
                           }]
                       });
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
                   $('.links-details').html("");
                   $('.links-list-block').html(res.data);
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
                   $('.links-details').html("");
                   $('.links-list-block').html(res.data);
               }
           }
       }).done(function() {
           setTimeout(function(){
               $("#overlay").fadeOut(300);
           },500);
       });
   }
   
   $('#filterForm').submit(function(e){
       // Stop the form submitting
       e.preventDefault();
       console.log('------date------>', selectedDate);
       country = $('#country').find(":selected").val();
       console.log('-----country------->', country);
       minClick = $('#minClick').val();
       console.log('-----minClick------->', minClick);
       maxClick = $('#maxClick').val();
       console.log('-----maxClick------->', maxClick);
       apply_filters();
   });
   
   $('#linkFilter').on('change', function() {
       myShortingAttribute = this.value;
       apply_filters();
   });
   
   
   function apply_filters()
   {
       if(selectedDate != null || country != null || minClick != null || maxClick != null || myShortingAttribute != null )
       {
           $.ajax({
               type:"POST",
               url:"{{route('get.filterd.links')}}",
               data:{
                   selectedDate:selectedDate,
                   country:country,
                   minClick:minClick,
                   maxClick:maxClick,
                   myShortingAttribute:myShortingAttribute,
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
                       $('.links-details').html("");
                       $('.links-list-block').html(res.data);
                   }
               }
           }).done(function() {
               setTimeout(function(){
                   $("#overlay").fadeOut(300);
               },500);
           });
       }
   }
</script>   
@endsection