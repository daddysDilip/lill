@extends('layouts.client_layout')
@section('title')
    The URL Shortener
@endsection
@section('content')
<div class="url-sec pt-5 pb-5">
        <div class="pb-5 d-none d-md-block"></div>
            <div class="col-lg-8 text-center offset-lg-2">
                <h1 class="heading-s1 d-flex flex-wrap justify-content-center">Easiest Way To
                    <div class="ml-2" id="rotate">
                        <div>Create</div>
                        <div>Manage</div>
                        <div>Promote</div>
                    </div>                   
                    <span class="d-block">Short Meaningful URLs</span>
                </h1>
            <p class="pt-4 pb-5">Your aggregator for link information and brand promotion</p>
            <a href="{{url('pricing')}}" class="btn btn-theme hvr-radial-out text-white">Get Started for Free</a>
            <p class="mt-4 mb-3"><a href="#" data-toggle="modal" data-target="#GetCallModal">Get a Quote</a></p>
            </div>
        </div>
        <div class="bottom-curve-shape"></div>
        <div class="shorten-sec">
            <div class="container">
                <div class="bg-white box-shadow pt-3 pl-3 pr-3 pb-4 pt-lg-5 pl-lg-5 pr-lg-5">
                    <form action="{{route('check.guest.user')}}" method="post" id="GuestUrlShortForm">
                        @csrf
                        <div class="row no-gutter">
                            <div class="col-lg-10 col-md-8">
                                <input class="form-control p-4 mb-2" name="client_website_url" id="client_website_url" type="text" placeholder="Enter your link here..." />
                                <span id="client-url-one-error-msg" class="text-danger mt-3"></span>
                            </div>
                            <div class="col-lg-2 col-md-4">
                                <button type="submit" class="btn btn-theme btn-block btn-shorten-url-one">SHORTEN</button>
                            </div>
                        </div>
                    </form>
                    <p class="text-center pt-4">By clicking SHORTEN, you are agreeing to lill's <a
                            class="theme-color" href="{{route('terms.and.conditions')}}"><u>Terms of Service</u></a> and <a class="theme-color"
                            href="{{route('privacy.and.policy')}}"><u>Privacy Policy.</u></a></p>
                </div>
            </div>
        </div>
        <div class="three-options-sec mt-5">
            <div class="container pt-5">
                <div class="row">
                    <div class="col-lg-4 text-center mb-5">
                        <div class="bg-white p-4 rounded box-shadow">
                            <span class="rounded-circle d-flex align-items-center justify-content-center"><img
                                    src="{{asset('client/images/home/tracking-icon.png')}}" /></span>
                            <h2 class="heading-s2 mt-4">Optimize</h2>
                            <p>
                                 Customized keyword-induced URL creation for SEO purposes 
                            </p>
                        </div>
                    </div>
                    <div class="col-lg-4 text-center mb-5">
                        <div class="bg-white p-4 rounded box-shadow">
                            <span class="rounded-circle d-flex align-items-center justify-content-center"><img
                                    src="{{asset('client/images/home/optimize-icon.png')}}" /></span>
                            <h2 class="heading-s2 mt-4">Analyze</h2>
                            <p>
                                Comprehensive valuable data to produce more targeted content 
                            </p>
                        </div>
                    </div>
                    <div class="col-lg-4 text-center mb-5">
                        <div class="bg-white p-4 rounded box-shadow">
                            <span class="rounded-circle d-flex align-items-center justify-content-center"><img
                                    src="{{asset('client/images/home/scale-icon.png')}}" /></span>
                            <h2 class="heading-s2 mt-4">Promote</h2>
                            <p>
                                Increased credibility and meaningful shares for brand promotion 
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tracking-sec pt-5 pb-5">
            <div class="container pb-5">
                <div class="row align-items-center">
                    <div class="col-lg-5 mb-3">
                        <h3 class="heading-s1 mb-3 ">
                             Why Lill? 
                        </h3>
                        <p>
                             A meaningful shortened vanity URL is perfect for SEO purposes and to lend credibility to your brand. The shortened URL through Lill can be used to measure real-time web traffic including social shares. 
                        </p>
                        <ul class="mt-4">
                            <li class="d-flex align-items-center"><img class="pr-3" src="{{asset('client/images/home/chart.png')}}" />Real-time metrics including social data</li>
                            <li class="d-flex align-items-center"><img class="pr-3" src="{{asset('client/images/home/data-time.png')}}" />Customized shortened URL to boost SEO</li>
                        </ul>
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <a href="{{route('about')}}" class="btn btn-theme p-1 pl-4 pr-4" style="color: #fff;">Read More</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-1"></div>
                    <div class="col-lg-6 mb-3">
                        <div class="tracking-form bg-white box-shadow p-5">
                            <form action="{{route('check.guest.user')}}" method="POST" id="GuestURLShortTypes">
                                @csrf
                                <div class="form-group mb-4">
                                    <label class="mb-2"><b>Enter your website</b></label>
                                    <input type="text" name="client_website_url_two" class="form-control mb-2" placeholder="Website name" id="client_website_url_two" />
                                    <span id="client-url-two-error-msg" class="text-danger"></span>
                                </div>
                                <div class="form-group mb-4">
                                    <label class="mb-2"><b>Select URL type</b></label>
                                    <div class="custom-control position-relative">
                                        <select class="form-control" name="link_type" id="link_type">
                                            @if (!empty($LinkType))
                                                @foreach ($LinkType as $type)
                                                    <option value="{{$type->id}}">{{$type->type}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="link-type-block mb-4" style="display: none;">
                                    <input type="text" name="generated_link_type" id="generated_link_type" class="form-control" />
                                </div>
                                <div class="link-type-block mb-4" style="display:none;">
                                    <button type="button" data-clipboard-action="copy" data-clipboard-target="#generated_link_type" class="btn btn-theme btn-block btn-copy">Copy</button>
                                </div>
                                <div class="row no-gutter mt-3 link-type-block" style="display:none;">
                                    <div class="col-lg-12">
                                        <ul class="nav">
                                            <li class="nav-item pr-2">
                                                <button type="button" data-js="facebook-share" class="btn-share-fb" id="btn-guest-link-type-share-fb">
                                                    <img src="{{asset('client/images/fb-icon.png')}}" class="nav-icon" alt="Share Link On Facebook" />
                                                </button>
                                            </li>
                                            <li class="nav-item pr-2">
                                                <button type="button" data-js="twitter-share" class="btn-share-twitter" id="btn-guest-link-type-share-twitter">
                                                    <img src="{{asset('client/images/twitter-icon.png')}}" class="nav-icon" alt="Share Link On Twitter" />
                                                </button>
                                            </li>
                                            <li class="nav-item pr-2">
                                                <button type="button" class="btn-share-linkedin" id="btn-guest-link-type-share-linkedin">
                                                    <img src="{{asset('client/images/linkedin-icon.png')}}" class="nav-icon" alt="Share Link On Linked In" />
                                                </button>
                                            </li>
                                            <li class="nav-item pr-2">
                                                <button type="button" class="btn-share-mail" id="btn-guest-link-type-share-mail">
                                                    <img src="{{asset('client/images/mail-icon.png')}}" class="nav-icon" alt="Share Link Via Mail" />
                                                </button>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-theme btn-block btn-shorten-url-two">GENERATE URL</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tracking-sec third pt-5 pb-lg-5">
            <div class="container pt-lg-2 pb-lg-2 pt-lg-5 pb-lg-5">
                <div class="row align-items-center">
                    <div class="col-lg-6 mb-3">
                        <h3 class="heading-s1 mb-3">
                             Select Vanity Domains for Brand Promotion 
                        </h3>
                        <p>
                             We offer custom domains that lend trust worthiness to the shortened links. Also, increase brand awareness by adding relevant words to the URL. A keyword-induced shortened URL boosts your chances of ranking higher in the search engine page results. 
                        </p>
                    </div>
                    <div class="col-lg-1"></div>
                    <div class="col-lg-5 mb-3 text-center">
                        <a href="{{route('pricing')}}">
                            <img src="{{asset('client/images/home/pramote.png')}}" />
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('tools.guest_user_details')
    @include('tools.spinner')
@endsection


@section('js')
    <script>
    var is_home = true;
    jQuery(document).ready(function($) {
        
    });

    </script>
@endsection
