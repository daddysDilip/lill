@extends('layouts.client_layout')

@section('content')
    <div class="url-sec pt-5 pb-5">
        <div class="pb-5 d-none d-md-block"></div>
            <div class="col-lg-6 text-center offset-lg-3">
                <h1 class="heading-s1">
                    Easiest way to create
                    meaningful shorten URL
                </h1>
                <p class="pt-4 pb-5">Target real life people in real places, in real time</p>
                <button class="btn btn-theme hvr-radial-out">Get Started for Free</button>
                <p class="mt-4 mb-3"><a href="#">Get a Quote</a></p>
            </div>
        </div>
        <div class="bottom-curve-shape"></div>
        <div class="shorten-sec">
            <div class="container">
                <div class="bg-white box-shadow pt-3 pl-3 pr-3 pb-4 pt-lg-5 pl-lg-5 pr-lg-5">
                    <div class="row no-gutter">
                        <div class="col-lg-10 col-md-8">
                            <input class="form-control p-4" type="text" placeholder="Enter your link here..." />
                        </div>
                        <div class="col-lg-2 col-md-4">
                            <button type="submit" class="btn btn-theme btn-block">Shorten</button>
                        </div>
                    </div>
                    <p class="text-center pt-4">By clicking SHORTEN, you are agreeing to shortly’s <a
                            class="theme-color" href="#">Terms of Service</a> and <a class="theme-color"
                            href="#">Privacy Policy.</a></p>
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
                            <h2 class="heading-s2 mt-4">Tracking</h2>
                            <p>
                                Create real-time tracking
                                that reaches your audience
                            </p>
                        </div>
                    </div>
                    <div class="col-lg-4 text-center mb-5">
                        <div class="bg-white p-4 rounded box-shadow">
                            <span class="rounded-circle d-flex align-items-center justify-content-center"><img
                                    src="{{asset('client/images/home/optimize-icon.png')}}" /></span>
                            <h2 class="heading-s2 mt-4">Optimize</h2>
                            <p>
                                Create real-time tracking
                                that reaches your audience
                            </p>
                        </div>
                    </div>
                    <div class="col-lg-4 text-center mb-5">
                        <div class="bg-white p-4 rounded box-shadow">
                            <span class="rounded-circle d-flex align-items-center justify-content-center"><img
                                    src="{{asset('client/images/home/scale-icon.png')}}" /></span>
                            <h2 class="heading-s2 mt-4">Scale</h2>
                            <p>
                                Create real-time tracking
                                that reaches your audience
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
                            Link Your First
                            Website
                        </h3>
                        <p>
                            A controlled, scripted shorten url up to 25 char long
                            that is non-intrusive, entertaining and memorable. Your
                            url will be ammounced by expert bot systems before
                            take-off and landing to the destination website.
                        </p>
                        <ul class="mt-4">
                            <li class="d-flex align-items-center"><img class="pr-3" src="{{asset('client/images/home/chart.png')}}" /> Track
                                real-time metrics and how they stack up.</li>
                            <li class="d-flex align-items-center"><img class="pr-3" src="{{asset('client/images/home/data-time.png')}}" />
                                See real-time data and how it’s used.</li>
                        </ul>
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <button class="btn btn-theme p-1 pl-4 pr-4">Track Data</button>
                            </div>
                            <div class="col-auto">
                                <a href="#" class="theme-color">Get a Quote</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-1"></div>
                    <div class="col-lg-6 mb-3">
                        <div class="tracking-form bg-white box-shadow p-5">
                            <form action="">
                                <div class="form-group mb-4">
                                    <label class="mb-2"><b>Enter your website</b></label>
                                    <input type="text" class="form-control" placeholder="Website name" />
                                </div>
                                <div class="form-group mb-4">
                                    <label class="mb-2"><b>Select URL type</b></label>
                                    <div class="custom-control position-relative">
                                        <select class="form-control">
                                            <option>Select here</option>
                                            <option>Lorem Ipsum</option>
                                            <option>Lorem Ipsum</option>
                                        </select>
                                    </div>
                                </div>
                                <button class="btn btn-theme btn-block">START HERE</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tracking-sec second pt-2 pb-2 pt-lg-5 pb-lg-5">
            <div class="container pt-5 pb-5">
                <div class="row align-items-center">
                    <div class="col-lg-6 mb-3">
                        <div class="tracking-form bg-white box-shadow p-5">
                            <form action="">
                                <div class="form-group mb-4">
                                    <label class="mb-2"><b>Enter your website</b></label>
                                    <input type="text" class="form-control" placeholder="Website name" />
                                </div>
                                <div class="form-group mb-4">
                                    <label class="mb-2"><b>Select URL type</b></label>
                                    <div class="custom-control position-relative">
                                        <select class="form-control">
                                            <option>Select here</option>
                                            <option>Lorem Ipsum</option>
                                            <option>Lorem Ipsum</option>
                                        </select>
                                    </div>
                                </div>
                                <button class="btn btn-theme btn-block">START HERE</button>
                            </form>
                        </div>
                    </div>
                    <div class="col-lg-1"></div>
                    <div class="col-lg-5 mb-3">
                        <h3 class="heading-s1 mb-3">
                            Link Your First
                            Website
                        </h3>
                        <p>
                            A controlled, scripted shorten url up to 25 char long
                            that is non-intrusive, entertaining and memorable. Your
                            url will be ammounced by expert bot systems before
                            take-off and landing to the destination website.
                        </p>
                        <ul class="mt-4">
                            <li class="d-flex align-items-center"><img class="pr-3" src="{{asset('client/images/home/chart.png')}}" /> Track
                                real-time metrics and how they stack up.</li>
                            <li class="d-flex align-items-center"><img class="pr-3" src="{{asset('client/images/home/data-time.png')}}" />
                                See real-time data and how it’s used.</li>
                        </ul>
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <button class="btn btn-theme p-1 pl-4 pr-4">Track Data</button>
                            </div>
                            <div class="col-auto">
                                <a href="#" class="theme-color">Get a Quote</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tracking-sec third pt-5 pb-lg-5">
            <div class="container pt-lg-2 pb-lg-2 pt-lg-5 pb-lg-5">
                <div class="row align-items-center">
                    <div class="col-lg-5 mb-3">
                        <h3 class="heading-s1 mb-3">
                            Link Your First
                            Website
                        </h3>
                        <p>
                            A controlled, scripted shorten url up to 25 char long
                            that is non-intrusive, entertaining and memorable. Your
                            url will be ammounced by expert bot systems before
                            take-off and landing to the destination website.
                        </p>
                        <ul class="mt-4">
                            <li class="d-flex align-items-center"><img class="pr-3" src="{{asset('client/images/home/chart.png')}}" /> Track
                                real-time metrics and how they stack up.</li>
                            <li class="d-flex align-items-center"><img class="pr-3" src="{{asset('client/images/home/data-time.png')}}" />
                                See real-time data and how it’s used.</li>
                        </ul>
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <button class="btn btn-theme p-1 pl-4 pr-4">Create Account</button>
                            </div>
                            <div class="col-auto">
                                <a href="#" class="theme-color">Add Website</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-1"></div>
                    <div class="col-lg-6 mb-3 text-center">
                        <a href="#">
                            <img src="{{asset('client/images/home/pramote.png')}}" />
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection