<div class="footer-wrapper">
    <div class="col-xl-6 col-lg-8 offset-xl-3 offset-lg-2">
        <div class="footer-top bg-white p-3 p-lg-5 box-shadow rounded text-center text-lg-left">
            <div class="row align-items-center">
                <div class="col-lg-7">
                    <b class="d-block mb-2">Enter Website URL</b>
                    <p>Get Started With URL Optimization</p>
                </div>
                <div class="col-lg-5 mt-2 mt-lg-0">
                    <a href="{{url('signup')}}" class="btn btn-theme btn-block p-2">ADD DOMAIN</a>
                </div>
            </div>
        </div>
    </div>
    <div class="footer_botom position-relative">
        <div class="container">
            <div class="row">
                <div class="col-xl-9 col-sm-9 col-12">
                    <div class="row">
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="footer-title">
                                Overview
                            </div>
                            <div class="footer-links">
                                <ul>
                                    <li><a href="#">Activity</a></li>
                                    <li><a href="{{route('faq')}}">FAQ</a></li>
                                    <li><a href="{{url('signin')}}">My Acount</a></li>
                                    <li><a href="{{route('about')}}">About Us</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="footer-title">
                                Contact Us
                            </div>
                            <div class="footer-links">
                                <ul>
                                    <?php if(!empty(get_setting_option('email')->value)) { ?><li><a href="{{get_setting_option('email')->value}}">E: info@lill.pw</a></li><?php } ?>
                                    <?php if(!empty(get_setting_option('contact_number')->value)) { ?><li><a href="{{get_setting_option('contact_number')->value}}">P: 1855 448 7363</a></li><?php } ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-3 col-12 text-center text-sm-left">
                    <img src="{{asset('client/images/lill-logo-white.png')}}" />
                </div>
            </div>

        </div>
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-8 col-12 text-center text-lg-left copyright pt-4">
                    Copyright@ {{date('Y')}} | LILL.PW
                </div>
                <div class="col-lg-4 col-12 text-center text-md-right pt-4">
                    <ul class="social-follow margin-2-top d-flex justify-content-center justify-content-lg-end">
                        <?php if(!empty(get_setting_option('facebook_link')->value)) { ?><li><a target="_blank" title="Facebook" href="{{get_setting_option('facebook_link')->value}}"><i class="sprite fb-follow"></i></a></li><?php } ?>
                        <?php if(!empty(get_setting_option('twitter_link')->value)) { ?><li><a target="_blank" title="Twitter" href="{{get_setting_option('twitter_link')->value}}"><i class="sprite tw-follow"></i></a></li><?php } ?>
                    </ul>
                </div>

            </div>
        </div>
    </div>
</div>

<div style="display: none;" id="back-top" class="goTop">
    <a href="javascript:void(0);">
        <i class="sprite back-to-top"></i>
    </a>
</div>