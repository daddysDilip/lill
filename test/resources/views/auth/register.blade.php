@include('partials.client.ui.head_scripts')
<div class="wrapper d-flex align-items-center justify-content-center h-100">
    <div class="col-lg-4">
        @include('tools.flash-message')
        <div class="login-sec d-flex flex-column align-items-center">
            <a href="{{url('/')}}"><img src="{{asset('client/images/logo.svg')}}" /></a>
            <p class="pt-3 pb-3">Create a new account</p>
            <a href="{{route('user.google.signup')}}" class="btn btn-black d-flex align-items-center justify-content-center btn-block"><img class="pr-3" width="40" src="{{asset('client/images/gp-icon.svg')}}" /> Login with Google</a>
            <div class="or position-relative text-center w-100 mt-3 mb-3"><span class="bg-white pl-3 pr-3">or</span></div>
            <form class="w-100" action="{{route('client.signup')}}" id="RegisterFormStep1" method="post">
                @csrf
                <div class="form-group mb-4 ">
                    <div class="form-check-inline">
                        <label class="form-check-label">
                            <input type="radio" class="form-check-input" name="account_type" value="business">Business
                        </label>
                    </div>
                    <div class="form-check-inline">
                        <label class="form-check-label">
                            <input type="radio" class="form-check-input" name="account_type" value="personal">Personal
                        </label>
                    </div>
                    @error('account_type')
                        <div class="alert alert-danger">
                            {{$message}}
                        </div>
                    @enderror
                </div>
                <div class="form-group mb-4">
                    <input class="form-control" type="text" placeholder="Your name or company name" name="company_name" />
                    @error('company_name')
                        <div class="alert alert-danger">
                            {{$message}}
                        </div>
                    @enderror
                </div>
                <div class="form-group position-relative mb-4">
                    <input class="form-control" type="text" placeholder="Your business email" name="email" />
                    @error('email')
                        <div class="alert alert-danger">
                            {{$message}}
                        </div>
                    @enderror
                </div>
                <div class="form-group position-relative mb-4">
                    <input class="form-control" type="password" placeholder="Your password" name="password" />
                    <small class="position-absolute forgot-link text-muted" href="#">8+ characters</small>
                    @error('password')
                        <div class="alert alert-danger">
                            {{$message}}
                        </div>
                    @enderror
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-theme btn-block">Create Account</button>
                </div>
            </form>
            <p class="pt-4 text-center">
                By creating an account you agree to
                our <a class="theme-color" href="#">terms</a> and <a class="theme-color" href="#">privacy policy</a>
            </p>
            <p class="pt-5 text-center">
                Already have an account? <a class="theme-color" href="{{route('user.signin')}}">Login</a>
            </p>
        </div>
    </div>
</div>
@include('partials.client.ui.footer_scripts')
<script>
$(document).ready(function() {
    $('#RegisterFormStep1').validate({
        rules:{
            account_type:{
                required:true
            },
            company_name:{
                required:true
            },
            email:{
                required:true,
                ValidEmail:true,
                remote: {
                    type: 'post',
                    url: "{{ URL('user/checkUserEmailExist') }}",
                    async: false,
                    async: false,
                    data: {
                        email: function() {
                            return $("input[name='email']").val();
                        },
                        "_token": "{{ csrf_token() }}"
                    },
                    async: false
                }
            },
            password: {
                required:true,
                minlength:8,
                maxlength:20
            }
        },
        messages:{
            email:{
                remote:"Email address already taken."
            }
        }
    });
});
</script>
