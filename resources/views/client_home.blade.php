@extends('layouts.client_dashboard_layout')
@section('title')
Links Detail
@endsection
@section('css')
@show
@include('tools.spinner')
@section('content')
@if (!empty(check_user_verified(Auth::guard('user')->user()->id)) && check_user_verified(Auth::guard('user')->user()->id)->status == 0)
<div class="alert alert-info text-center" role="alert">
   Your account has not been verified. Please check your email to verify by clicking on verify link.
</div>
@endif
<div class="dashboard-sec">
   <div class="pt-5 pb-5">
      <div class="container">
         @csrf
         <div class="box-bg">
            <div class="row">
               <div class="col-md-6 col-lg-6 col-12 mb-3">
                  <div class="client-home-card ">
                     <div class="title">
                        <h4>Latest Hit Section</h4>
                     </div>
                     <div class="list">
                     <table class="table table-responsive">
   <thead>
      <tr>
         <th scope="col">Count</th>
         <th scope="col">Link</th>
      </tr>
   </thead>
   <tbody>
      {{-- {{pr($LatestHitLinks)}} --}}
      @foreach ($LatestHitLinks as $hits)
      <tr>
         <td><span>{{$hits->click_count}}</span> </td>
         <td><a>{{$hits->generated_link}}</a></td>
      </tr>
      @endforeach
   </tbody>
</table>

                        <!-- 
                        {{-- {{pr($LatestHitLinks)}} --}}
                        @foreach ($LatestHitLinks as $hits)
                        <span>{{$hits->click_count}}</span> 
                        <a>{{$hits->generated_link}}</a> <br>
                        @endforeach -->
                     </div>
                  </div>
               </div>
               <div class="col-md-6 col-lg-6 col-12 mb-3">
                  <div class="client-home-card">
                     <div class="title">
                        <h4>Trading Links</h4>
                     </div>
                     <div class="list">

                     <table class="table table-responsive">
   <thead>
      <tr>
         <th scope="col">Count</th>
         <th scope="col">Link</th>
      </tr>
   </thead>
   <tbody>
   {{-- {{pr($trendingLinks)}} --}}
    @foreach ($trendingLinks as $trend)
      <tr>
         <td><span>{{$trend->click_count}}</span> </td>
         <td><a>{{$trend->generated_link}}</a></td>
      </tr>
      @endforeach
   </tbody>
</table>

                        <!-- {{-- {{pr($trendingLinks)}} --}}
                        @foreach ($trendingLinks as $trend)
                        <span>{{$trend->click_count}}</span> 
                        <a>{{$trend->generated_link}}</a><br>
                        @endforeach -->
                     </div>
                  </div>
               </div>
        
               <div class="col-md-6 col-lg-6 col-12 mb-3">
                  <div class="client-home-card ">
                     <div class="title">
                        <h4> Max Click From Location</h4>
                     </div>
                     <div class="list-2">
                     <span>{{$maxClickLocation->countryName}}</span>
            {{-- <span>{{$maxClickLocation->countryCode}}</span>
            <span>{{$maxClickLocation->click_count}}</span> --}}
                     </div>
                  </div>
               </div>
               <div class="col-md-6 col-lg-6 col-12 mb-3">
                  <div class="client-home-card">
                     <div class="title">
                        <h4> Total Links Count</h4>
                     </div>
                     <div class="list-2">
                     <span>{{$TotalLinks}}</span>
                     </div>
                  </div>
               </div>
            </div>

         </div>
      </div>
   </div>
 
</div>
<div class="modal" id="share-link" tabindex="-1" role="dialog">
</div>
@endsection
@section('js')
@endsection