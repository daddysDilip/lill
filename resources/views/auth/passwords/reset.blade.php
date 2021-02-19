<html>
    <head>
        <title>Lill.pw - Reset Password</title>
        @include('partials.client.ui.head_scripts')
    </head>
    <body>
        <div class="wrapper d-flex align-items-center justify-content-center h-100">
            <div class="col-lg-4">
                <div class="login-sec d-flex flex-column align-items-center">
                    @include('tools.flash-message')
                    <img src="{{asset('client/images/logo.png')}}" />
                    <p class="pt-3 pb-3">Reset your password?</p>
                    <form class="w-100" action="{{route('user.reset.password')}}" id="ResetPassword" method="POST">
                        <input type="hidden" name="email" value="{{$email ?? ''}}">
                        <input type="hidden" name="link_token" value="{{$link_token ?? ''}}">
                        @csrf
                        <div class="form-group mb-4">
                            <input class="form-control" type="password" name="password" id="password" placeholder="Your New Password" />
                        </div>
                        <div class="form-group mb-4">
                            <input class="form-control" type="password" name="confirm_password" id="confirm_password" placeholder="Your Confirm Password" />
                        </div>
                        <div class="form-group">
                            <button class="btn btn-theme btn-block" type="submit">Reset password</button>
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
        $('#ResetPassword').validate({
            rules:{
                password:{
                    required:true,
                    minlength:6,
                    maxlength:20
                },
                confirm_password:{
                    required:true,
                    minlength:6,
                    maxlength:20,
                    equalTo:"#password"
                },
            },
            messages:{
                password:{
                    required:"Please enter your new password."
                },
                confirm_password:{
                    required:"Please enter your new password."
                },
            }
        });
    </script>
</html>