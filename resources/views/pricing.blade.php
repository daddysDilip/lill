@extends('layouts.client_layout')
@section('title')
    Pricing
@endsection
@section('content')
<div class="pricing-sec pt-5 pb-5">
    <div class="container text-center mb-5">
        <h1 class="heading-s1 mb-3">Get the most from your links</h1>
        {{-- <p class="d-flex align-items-center justify-content-center">
            Pay monthly Pay
            <label class="switch ml-2 mr-2">
                <input type="checkbox">
                <span class="slider round"></span>
            </label> annually (save 45%)
        </p> --}}
        {{-- {{$Plans}} --}}
    </div>
    <div class="container-fluid">
        <div id="monthly">
            <table class="table pricing-table table-responsive-md">
                <thead>
                    <tr>
                        <th class="first" scope="col"></th>
                        @foreach ($Plans as $key => $val)
                            <th scope="col" class="text-center p-4 align-middle">{{$val['name']}} {{$val['isFree'] == 1 ? '(Free)':''}} <span class="d-block pt-3">${{$val['isFree'] == 1 ? '0':$val['monthly_price']}} Monthly | ${{$val['isFree'] == 1 ? '0':$val['annual_price']}} Anualy</span> 
                                @if($val['isFree'] == 1)
                                    <a href="{{url('signup','standard')}}" class="btn p-1 btn-block btn-theme mt-4">Sign Up</a>
                                @elseif ($val['status'] == 0)
                                    <button class="btn p-1 btn-block btn-theme mt-4">Coming Soon</button>
                                @else 
                                    <a href="{{url('pricing-detail',$val['id'])}}" class="btn p-1 btn-block btn-theme mt-4">View Detail</a>
                                @endif
                            </th>   
                        @endforeach
                        {{-- <th scope="col" class="text-center p-4 align-middle">Premium <span class="d-block pt-3">-</span><button class="btn p-1 btn-block btn-theme mt-4">Coming Soon</button></th>
                        <th scope="col" class="text-center p-4 align-middle">Enterprise <span class="d-block pt-3">-</span><button class="btn p-1 btn-block btn-theme mt-4">Coming Soon</button></th>
                        <th scope="col" class="text-center p-4 align-middle">Pro <span class="d-block pt-3">-</span><button class="btn p-1 btn-block btn-theme mt-4">Coming Soon</button></th>
                        <th scope="col" class="text-center p-4 align-middle">starter <span class="d-block pt-3">-</span><button class="btn p-1 btn-block btn-theme mt-4">Coming Soon</button></th> --}}

                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="d-flex align-items-center" scope="row">
                            Link Creation
                            <i type="button" class="sprite tooltips tooltip-icon ml-1" data-toggle="tooltip" data-placement="right" title="Any link shortened by you through your lill account"></i>
                        </td>
                        @foreach ($Plans as $key => $val)
                            <td class="text-center">{{$val['total_links']}}</td>
                        @endforeach
                        {{-- <td class="text-center">2500</td>
                        <td class="text-center">Unlimited</td>
                        <td class="text-center">500</td>
                        <td class="text-center">Unlimited</td> --}}
                    </tr>
                    <tr>
                        <td class="d-flex align-items-center" scope="row">
                            Link Clicks
                            <i type="button" class="sprite tooltips tooltip-icon ml-1" data-toggle="tooltip" data-placement="right" title="Number of clicks allowed on the links you create"></i>
                        </td>
                        @foreach ($Plans as $key => $val)
                            <td class="text-center">{{$val['total_link_click'] == "" ? 'Unlimited':$val['total_link_click']}}</td>
                        @endforeach
                        {{-- <td class="text-center">Unlimited</td>
                        <td class="text-center"><i class="sprite right-icon"></i></td>
                        <td class="text-center"><i class="sprite right-icon"></i></td>
                        <td class="text-center"><i class="sprite right-icon"></i></td> --}}
                    </tr>
                    <tr>
                        <td class="d-flex align-items-center" scope="row">
                            Link Track
                            <i type="button" class="sprite tooltips tooltip-icon ml-1" data-toggle="tooltip" data-placement="right" title="Can track Links"></i>
                        </td>
                        @foreach ($Plans as $key => $val)
                            <td class="text-center">
                            @if($val['link_track'] == 1)
                                <i class='sprite right-icon'></i>
                            @else
                                -
                            @endif
                            </td>
                        @endforeach
                    </tr>
                    <tr>
                        <td class="d-flex align-items-center" scope="row">
                            Link Filtering
                            <i type="button" class="sprite tooltips tooltip-icon ml-1" data-toggle="tooltip" data-placement="right" title="Focus on the links you want to see based on date, tags, and type"></i>
                        </td>
                        @foreach ($Plans as $key => $val)
                            <td class="text-center">
                            @if($val['link_filtering'] == 1)
                                <i class='sprite right-icon'></i>
                            @else
                                -
                            @endif
                            </td>
                        @endforeach
                        
                    </tr>
                    <tr>
                        <td class="d-flex align-items-center" scope="row">
                            QR Code
                            <i type="button" class="sprite tooltips tooltip-icon ml-1" data-toggle="tooltip" data-placement="right" title="Automatically generate a downloadable QR Code for any lill link"></i>
                        </td>
                        @foreach ($Plans as $key => $val)
                            <td class="text-center">
                            @if($val['is_qrcode'] == 1)
                                <i class='sprite right-icon'></i>
                            @else
                                -
                            @endif
                            </td>
                        @endforeach
                        {{-- <td class="text-center"><i class="sprite right-icon"></i></td>
                        <td class="text-center"><i class="sprite right-icon"></i></td>
                        <td class="text-center"><i class="sprite right-icon"></i></td>
                        <td class="text-center"><i class="sprite right-icon"></i></td>
                        <td class="text-center"><i class="sprite right-icon"></i></td> --}}
                    </tr>
                    <tr>
                        <td class="d-flex align-items-center" scope="row">
                            Link Expiration
                            <i type="button" class="sprite tooltips tooltip-icon ml-1" data-toggle="tooltip" data-placement="right" title="Link can be expire"></i>
                        </td>
                        @foreach ($Plans as $key => $val)
                            <td class="text-center">-</td>
                        @endforeach
                        {{-- <td class="text-center"><i class="sprite right-icon"></i></td>
                        <td class="text-center"><i class="sprite right-icon"></i></td>
                        <td class="text-center"><i class="sprite right-icon"></i></td>
                        <td class="text-center"><i class="sprite right-icon"></i></td>
                        <td class="text-center"><i class="sprite right-icon"></i></td> --}}
                    </tr>
                    <tr>
                        <td class="d-flex align-items-center" scope="row">
                            Branded Link
                            <i type="button" class="sprite tooltips tooltip-icon ml-1" data-toggle="tooltip" data-placement="right" title="Links are created with a custom domain. Instead of lill.pw/12345, yourbra.nd/12345"></i>
                        </td>
                        @foreach ($Plans as $key => $val)
                            <td class="text-center">{{$val['total_branded_links']}}
                            
                            </td>
                        @endforeach
                        {{-- <td class="text-center">1</td>
                        <td class="text-center">2000</td>
                        <td class="text-center">Unlimited</td>
                        <td class="text-center">500</td>
                        <td class="text-center">Unlimited</td> --}}
                    </tr>
                    <tr>
                        <td class="d-flex align-items-center" scope="row">
                            Auto-Branded links
                            <i type="button" class="sprite tooltips tooltip-icon ml-1" data-toggle="tooltip" data-placement="right" title="Links created by others on lill’s website are branded with your custom domain"></i>
                        </td>
                        @foreach ($Plans as $key => $val)
                            <td class="text-center">-</td>
                        @endforeach
                        {{-- <td class="text-center">-</td>
                        <td class="text-center">-</td>
                        <td class="text-center">+5</td>
                        <td class="text-center">-</td>
                        <td class="text-center">+1</td> --}}
                    </tr>
                    <tr>
                        <td class="d-flex align-items-center" scope="row">
                            Custom Back-half 
                            <i type="button" class="sprite tooltips tooltip-icon ml-1" data-toggle="tooltip" data-placement="right" title="Insert your own words at the end of a link. Eg: change lill.pw/472da4 to lill.pw/mypage"></i>
                        </td>
                        @foreach ($Plans as $key => $val)
                            <td class="text-center">
                            @if($val['custom_back_half'] == 1)
                                <i class='sprite right-icon'></i>
                            @else
                                -
                            @endif
                            </td>
                        @endforeach
                        {{-- <td class="text-center">25</td>
                        <td class="text-center">1000</td>
                        <td class="text-center">2000</td>
                        <td class="text-center">25</td>
                        <td class="text-center">1000</td> --}}
                    </tr>
                    <tr>
                        <td class="d-flex align-items-center" scope="row">
                            Link creation with slugs options
                            <i type="button" class="sprite tooltips tooltip-icon ml-1" data-toggle="tooltip" data-placement="right" title="Lill will give you a facility to add number if slugs"></i>
                        </td>
                        @foreach ($Plans as $key => $val)
                            <td class="text-center">0</td>
                            </td>
                        @endforeach
                        {{-- <td class="text-center">2</td>
                        <td class="text-center">5</td>
                        <td class="text-center">6</td>
                        <td class="text-center">3</td>
                        <td class="text-center">6</td> --}}
                    </tr>
                    <tr>
                        <td class="d-flex align-items-center" scope="row">
                            Custom Domain
                            <i type="button" class="sprite tooltips tooltip-icon ml-1" data-toggle="tooltip" data-placement="right" title="Only lill gives you a dedicated custom domain as part of a complete link management solution for your brand"></i>
                        </td>
                        @foreach ($Plans as $key => $val)
                            <td class="text-center">{{$val['total_custom_domains']}}</td>
                        @endforeach
                        {{-- <td class="text-center">1</td>
                        <td class="text-center">5</td>
                        <td class="text-center">25</td>
                        <td class="text-center">2</td>
                        <td class="text-center">10</td> --}}
                    </tr>
                    <tr>
                        <td class="d-flex align-items-center" scope="row">
                            Custom SSL Certificate
                            <i type="button" class="sprite tooltips tooltip-icon ml-1" data-toggle="tooltip" data-placement="right" title="Use your own SSL certificate to create secure HTTPS links"></i>
                        </td>
                        @foreach ($Plans as $key => $val)
                            <td class="text-center">-</td>
                        @endforeach
                        {{-- <td class="text-center">-</td>
                        <td class="text-center">-</td>
                        <td class="text-center">Available on Client-end</td>
                        <td class="text-center">-</td>
                        <td class="text-center">-</td> --}}
                    </tr>
                    <tr>
                        <td class="d-flex align-items-center" scope="row">
                            Campaigns
                            <i type="button" class="sprite tooltips tooltip-icon ml-1" data-toggle="tooltip" data-placement="right" title="Group and manage links in bulk"></i>
                        </td>
                        @foreach ($Plans as $key => $val)
                            <td class="text-center"><i class="sprite right-icon"></td>
                        @endforeach
                        {{-- <td class="text-center">1</td>
                        <td class="text-center">5</td>
                        <td class="text-center">Unlimited</td>
                        <td class="text-center">10</td>
                        <td class="text-center">15</td> --}}
                    </tr>
                    <tr>
                        <td class="d-flex align-items-center" scope="row">
                           Parameter forwarding
                            <i type="button" class="sprite tooltips tooltip-icon ml-1" data-toggle="tooltip" data-placement="right" title=" Keep your link parameters intact when you shorten links containing URL codes"></i>
                        </td>
                        @foreach ($Plans as $key => $val)
                            <td class="text-center">-</td>
                        @endforeach
                        {{-- <td class="text-center">-</td>
                        <td class="text-center">-</td>
                        <td class="text-center">Available for Purchase</td>
                        <td class="text-center">-</td>
                        <td class="text-center">Available for Purchase</td> --}}
                    </tr>
                    
                    <tr>
                        <td class="d-flex align-items-center" scope="row">
                           User Seat
                            <i type="button" class="sprite tooltips tooltip-icon ml-1" data-toggle="tooltip" data-placement="right" title="Number of users who can use login"></i>
                        </td>
                        @foreach ($Plans as $key => $val)
                            <td class="text-center">{{$val['total_users']}}</td>
                        @endforeach
                        {{-- <td class="text-center">1</td>
                        <td class="text-center">1</td>
                        <td class="text-center">Unlimited</td>
                        <td class="text-center">1</td>
                        <td class="text-center">Unlimited</td> --}}


                    </tr>
                    <tr>
                        <td class="d-flex align-items-center" scope="row">
                           Report
                            <i type="button" class="sprite tooltips tooltip-icon ml-1" data-toggle="tooltip" data-placement="right" title="Custom report builder"></i>
                        </td>
                        @foreach ($Plans as $key => $val)
                            <td class="text-center">
                            @if($val['link_analytics'] == 1)
                                <i class='sprite right-icon'></i>
                            @else
                                -
                            @endif
                            </td>
                        @endforeach
                        {{-- <td class="text-center"><i class="sprite right-icon"></td>
                        <td class="text-center"><i class="sprite right-icon"></td>
                        <td class="text-center"><i class="sprite right-icon"></td>
                        <td class="text-center"><i class="sprite right-icon"></td>
                        <td class="text-center"><i class="sprite right-icon"></td> --}}
                    </tr>
                    <tr>
                        <td class="d-flex align-items-center" scope="row">
                          Link Analytics
                            <i type="button" class="sprite tooltips tooltip-icon ml-1" data-toggle="tooltip" data-placement="right" title="Visualize popular click metrics from your audience like top countries, devices, languages, frequent times and more"></i>
                        </td>
                        @foreach ($Plans as $key => $val)
                            <td class="text-center">
                            @if($val['link_analytics'] == 1)
                                <i class='sprite right-icon'></i>
                            @else
                                -
                            @endif
                            </td>
                        @endforeach
                        {{-- <td class="text-center"><i class="sprite right-icon"></td>
                        <td class="text-center"><i class="sprite right-icon"></td>
                        <td class="text-center"><i class="sprite right-icon"></td>
                        <td class="text-center"><i class="sprite right-icon"></td>
                        <td class="text-center"><i class="sprite right-icon"></td> --}}
                    </tr>
                     <tr>
                        <td class="d-flex align-items-center" scope="row">
                          Link History 
                            <i type="button" class="sprite tooltips tooltip-icon ml-1" data-toggle="tooltip" data-placement="right" title="View the performance of your links over time"></i>
                        </td>
                        @foreach ($Plans as $key => $val)
                            <td class="text-center">
                            @if($val['link_history'] == 1)
                                <i class='sprite right-icon'></i>
                            @else
                                -
                            @endif
                            </td>
                        @endforeach
                        {{-- <td class="text-center"><i class="sprite right-icon"></td>
                        <td class="text-center"><i class="sprite right-icon"></td>
                        <td class="text-center"><i class="sprite right-icon"></td>
                        <td class="text-center"><i class="sprite right-icon"></td>
                        <td class="text-center"><i class="sprite right-icon"></td> --}}
                    </tr>
                    <tr>
                        <td class="d-flex align-items-center" scope="row">
                          Support
                            <i type="button" class="sprite tooltips tooltip-icon ml-1" data-toggle="tooltip" data-placement="right" title="Connect with our dedicated support team for assistance"></i>
                        </td>
                        @foreach ($Plans as $key => $val)
                            <td class="text-center"><i class="sprite right-icon"></td>
                        @endforeach
                        {{-- <td class="text-center"><i class="sprite right-icon"></td>
                        <td class="text-center"><i class="sprite right-icon"></td>
                        <td class="text-center"><i class="sprite right-icon"></td>
                        <td class="text-center"><i class="sprite right-icon"></td>
                        <td class="text-center"><i class="sprite right-icon"></td> --}}
                    </tr>
                    <tr>
                        <td class="d-flex align-items-center" scope="row">
                          Social Media Sharing
                            <i type="button" class="sprite tooltips tooltip-icon ml-1" data-toggle="tooltip" data-placement="right" title="Post link on social media (Facebook, LinkedIn, Twitter, Whats app)"></i>
                        </td>
                        @foreach ($Plans as $key => $val)
                            <td class="text-center">
                            @if($val['social_media_shering'] == 1)
                                <i class='sprite right-icon'></i>
                            @else
                                -
                            @endif
                            </td>
                        @endforeach
                        {{-- <td class="text-center"><i class="sprite right-icon"></td>
                        <td class="text-center"><i class="sprite right-icon"></td>
                        <td class="text-center"><i class="sprite right-icon"></td>
                        <td class="text-center"><i class="sprite right-icon"></td>
                        <td class="text-center"><i class="sprite right-icon"></td> --}}
                    </tr>
                    
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
@section('js')
    <script>
        var is_home = true;
    </script>
@endsection