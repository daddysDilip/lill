<html>
    <head>
        <title>Lill.pw - Forgot Password</title>
        @include('partials.client.ui.head_scripts')
    </head>
    <body>
        <div class="wrapper d-flex align-items-center justify-content-center h-100">
            <div class="col-lg-4">
                <div class="login-sec d-flex flex-column align-items-center">
                    @include('tools.flash-message')
                    <img src="{{asset('client/images/logo.png')}}" />
                    <p class="pt-3 pb-3">Forgot your password?</p>
                    <form class="w-100" action="{{route('send.reset.password.link')}}" id="ForgotPassword" method="POST">
                        @csrf
                        <div class="form-group mb-4">
                            <input class="form-control" type="email" name="email" id="email" placeholder="Your email" />
                        </div>
                        <div class="form-group">
                            <button class="btn btn-theme btn-block">Reset password</button>
                        </div>
                    </form>
                    <p class="pt-3">Need help? Please <a class="theme-color" href="#">contact support</a></p>
                    <p class="pt-4">Found your password? <a class="theme-color" href="{{route('user.signin')}}">Login</a></p>
                </div>
            </div>
        </div>
    </body>
    @include('partials.client.ui.footer_scripts')
    <script>
        var is_home = true;
        $('#ForgotPassword').validate({
            rules:{
                email:{
                    required:true,
                    ValidEmail:true
                }
            },
            messages:{
                email:{
                    required:"Please enter your valid email address."
                }
            }
        });
    </script>
</html>