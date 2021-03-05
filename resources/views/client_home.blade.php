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
        <div class="top-area pt-5 pb-5">
            <div class="container">
                
                    @csrf
                    <div class="search position-relative mb-4">
                        <div class="row extra-small-gutter align-items-center">
                            Latest Hit Section
                            <div class="col-lg-6">
                                {{-- {{pr($LatestHitLinks)}} --}}
                                @foreach ($LatestHitLinks as $hits)
                                    <span>{{$hits->click_count}}</span> <span>{{$hits->generated_link}}</span> <br>
                                @endforeach
                            </div>
                            
                        </div>
                    </div>
                    <div class="row align-items-center  mt-5">
                        Trading Links
                            <div class="col-lg-6">
                                {{-- {{pr($trendingLinks)}} --}}
                                 @foreach ($trendingLinks as $trend)
                                    <span>{{$trend->click_count}}</span> <span>{{$trend->generated_link}}</span><br>
                                @endforeach
                            </div>
                        
                    </div>
                
              
            </div>
        </div>
        <div class="middle-area">
            <div class="row no-gutter links-section">
                <div class="links-list-block col-lg-4">
                    <b>Max Click From Location</b>
                    <span>{{$maxClickLocation->countryName}}</span>
                    {{-- <span>{{$maxClickLocation->countryCode}}</span>
                    <span>{{$maxClickLocation->click_count}}</span> --}}

                </div>
                <div class="links-details col-lg-8">
                    Total Links Count
                    <span>{{$TotalLinks}}</span>
                </div>
            </div>        
        </div>
    </div>
    
    <div class="modal" id="share-link" tabindex="-1" role="dialog">

    </div>
    
@endsection

@section('js')
    
@endsection
