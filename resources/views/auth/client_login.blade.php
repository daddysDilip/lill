<html>
    <head>
        <title>Lill.pw - Signin</title>
        @include('partials.client.ui.head_scripts')
    </head>
    <body>
        <div class="wrapper d-flex align-items-center justify-content-center h-100">
            <div class="col-lg-4">
                <div class="login-sec d-flex flex-column align-items-center">
                    
                    @include('tools.flash-message')
                    <a href="{{url('/')}}"><img src="{{asset('client/images/logo.png')}}" /></a>
                    <p class="pt-3 pb-3">Login to your dashboard</p>
                    <a href="{{route('user.google.signup')}}" class="btn btn-black d-flex align-items-center justify-content-center btn-block"><img class="pr-3" width="40" src="{{asset('client/images/gp-icon.svg')}}" /> Login with Google</a>
                    <div class="or position-relative text-center w-100 mt-3 mb-3"><span class="bg-white pl-3 pr-3">or</span></div>
                    <form class="w-100" action="{{route('user.login')}}" method="post" id="LoginForm">
                        {{ csrf_field() }}
                        <div class="form-group mb-4">
                            <input class="form-control" type="text" name="email" placeholder="Your email" />
                        </div>
                        <div class="form-group position-relative mb-4">
                            <input class="form-control" type="password" placeholder="Your password" name="password" />
                            <a class="position-absolute forgot-link theme-color" href="{{route('forgot.password')}}">Forgot?</a>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-theme btn-block">Login</button>
                        </div> 
                    </form>
                    <p class="pt-3">Don’t have a Lill account yet? <a class="theme-color" href="{{url('signup')}}">Get started</a></p>
                </div>
            </div>
        </div>
        @include('partials.client.ui.footer_scripts')
        <script>
            var is_home = true;
         $('#LoginForm').validate({
             rules:{
                email:{
                    required:true,
                    ValidEmail:true
                },
                password:{
                    required:true
                }
             }
         })   
        </script>
    </body>
</html>
