@include('partials.client.ui.head_scripts')
<div class="wrapper d-flex align-items-center justify-content-center h-100">
    <div class="col-lg-4">
        <div class="login-sec d-flex flex-column align-items-center">
            <a href="index.html"><img src="{{asset('client/images/logo.svg')}}" /></a>
            <p class="pt-3 pb-3">Login to your dashboard</p>
            <button class="btn btn-black d-flex align-items-center justify-content-center btn-block"><img class="pr-3" width="40" src="{{asset('client/images/gp-icon.svg')}}" /> Login with Google</button>
            <div class="or position-relative text-center w-100 mt-3 mb-3"><span class="bg-white pl-3 pr-3">or</span></div>
            <form class="w-100" action="{{route('user.login')}}" id="LoginForm">
                <div class="form-group mb-4">
                    <input class="form-control" type="text" name="email" placeholder="Your email" />
                </div>
                <div class="form-group position-relative mb-4">
                    <input class="form-control" type="password" placeholder="Your password" name="password" />
                    <a class="position-absolute forgot-link theme-color" href="forgot.html">Forgot?</a>
                </div>
                <div class="form-group">
                    <button class="btn btn-theme btn-block">Login</button>
                </div> 
            </form>
            <p class="pt-5">Don’t have a shortly account yet? <a class="theme-color" href="signup.html">Get started</a></p>
        </div>
    </div>
</div>
@include('partials.client.ui.footer_scripts')
<script>
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