@include('partials.client.ui.head_scripts')
<div class="wrapper">
    <div class="container-fluid p-4">
        <div class="row justify-content-between align-items-center">
            <div class="col-auto">
                <img src="{{asset('client/images/logo.svg')}}" />
            </div>
            <div class="col-auto">
                <img src="{{asset('client/images/user.png')}}" />
            </div>
        </div>
    </div>
    <div class="basic-info-sec">
        <div class="container">
            <div class="col-lg-8">
                <p>Tell us a little bit about yourself...</p>
                <small class="d-block pt-3 pb-3">* mandatory fields</small>
                <h3 class="mb-4">You are using shortly for*</h3>
                @if ($account_type->account_type == "business")
                    <form id="BusinessAccountForm" method="post" action="{{ route('confirm.user.account', $account_type->id) }}">
                        <input type="hidden" name="account_type" value="{{$account_type->account_type ?? ''}}">
                        <input type="hidden" name="verify_token" value="{{$token ?? ''}}">
                        @csrf
                        <div class="row">
                            <div class="col-lg-6 mb-3">
                                <label class="col-form-label">First name *</label>
                                <input class="form-control" type="text" name="firstname" placeholder="First name" />
                                @error('firstname')
                                    <div class="alert alert-danger">
                                        {{$message}}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-lg-6 mb-3">
                                <label class="col-form-label">Last name *</label>
                                <input class="form-control" type="text" name="lastname" placeholder="Last name" />
                                @error('lastname')
                                    <div class="alert alert-danger">
                                        {{$message}}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-lg-6 mb-3">
                                <label class="col-form-label">Contact Number *</label>
                                <input type="text" class="form-control" name="contactno" placeholder="Your Number" />
                                @error('contactno')
                                    <div class="alert alert-danger">
                                        {{$message}}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-lg-6 mb-3">
                                <label class="col-form-label">Job Title *</label>
                                <input type="text" class="form-control" name="job_title" placeholder="Job Title" />
                                @error('job_title')
                                    <div class="alert alert-danger">
                                        {{$message}}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-lg-6 mb-4">
                                <label class="col-form-label">Company website *</label>
                                <input type="text" class="form-control" name="website" placeholder="www.company.com" />
                                @error('website')
                                    <div class="alert alert-danger">
                                        {{$message}}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-lg-6 mb-4">
                                <label class="col-form-label">Company size *</label>
                                <input type="text" class="form-control" name="company_size" placeholder="Company size" />
                                @error('company_size')
                                    <div class="alert alert-danger">
                                        {{$message}}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-lg-6 mb-3">
                                <a href="{{url('/')}}" class="btn next-btn btn-block p-2">Ask me next time</a>
                            </div>
                            <div class="col-lg-6 mb-3">
                                <button class="btn btn-theme btn-block p-2" type="submit">Done</button>
                            </div>
                        </div>
                    </form>
                @elseif($account_type->account_type == "personal")
                    <form id="BusinessAccountForm" method="post" action="{{ route('confirm.user.account', $account_type->id) }}">
                        <input type="hidden" name="account_type" value="{{$account_type->account_type ?? ''}}">
                        <input type="hidden" name="verify_token" value="{{$token ?? ''}}">
                        @csrf
                        <div class="row">
                            <div class="col-lg-6 mb-3">
                                <label class="col-form-label">First name *</label>
                                <input class="form-control" type="text" name="firstname" placeholder="First name" />
                            </div>
                            <div class="col-lg-6 mb-3">
                                <label class="col-form-label">Last name *</label>
                                <input class="form-control" type="text" name="lastname" placeholder="Last name" />
                            </div>
                            <div class="col-lg-6 mb-3">
                                <a href="{{url('/')}}" class="btn next-btn btn-block p-2">Enter your dashboard</a>
                            </div>
                            <div class="col-lg-6 mb-3">
                                <button class="btn btn-theme btn-block p-2" type="submit">Done</button>
                            </div>
                        </div>
                    </form>
                @else
                    <form id="SocialAccountForm" method="post" action="{{ route('confirm.user.account', $account_type->id) }}">
                        <input type="hidden" name="verify_token" value="{{$token ?? ''}}">
                        @csrf
                        <div class="form-group">
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
                        <div class="row">
                            <div class="col-lg-6 mb-3">
                                <label class="col-form-label">First name *</label>
                                <input class="form-control" type="text" name="firstname" placeholder="First name" />
                                @error('firstname')
                                    <div class="alert alert-danger">
                                        {{$message}}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-lg-6 mb-3">
                                <label class="col-form-label">Last name *</label>
                                <input class="form-control" type="text" name="lastname" placeholder="Last name" />
                                @error('lastname')
                                    <div class="alert alert-danger">
                                        {{$message}}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="business-block row">
                            <div class="col-lg-6 mb-3">
                                <label class="col-form-label">Contact Number *</label>
                                <input type="text" class="form-control" name="contactno" placeholder="Your Number" />
                                @error('contactno')
                                    <div class="alert alert-danger">
                                        {{$message}}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-lg-6 mb-3">
                                <label class="col-form-label">Job Title *</label>
                                <input type="text" class="form-control" name="job_title" placeholder="Job Title" />
                                @error('job_title')
                                    <div class="alert alert-danger">
                                        {{$message}}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-lg-6 mb-4">
                                <label class="col-form-label">Company website *</label>
                                <input type="text" class="form-control" name="website" placeholder="www.company.com" />
                                @error('website')
                                    <div class="alert alert-danger">
                                        {{$message}}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-lg-6 mb-4">
                                <label class="col-form-label">Company size *</label>
                                <input type="text" class="form-control" name="company_size" placeholder="Company size" />
                                @error('company_size')
                                    <div class="alert alert-danger">
                                        {{$message}}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 mb-3">
                                <a href="{{url('/')}}" class="btn next-btn btn-block p-2">Ask me next time</a>
                            </div>
                            <div class="col-lg-6 mb-3">
                                <button class="btn btn-theme btn-block p-2" type="submit">Done</button>
                            </div>
                        </div>
                    </form>
                @endif
            </div>
        </div>
    </div>
</div>
@include('partials.client.ui.footer_scripts')
<script>
$(document).ready(function() {
    
    $('input[type=radio][name=account_type]').change(function() {
        if($(this).val() == "personal") {
            $('.business-block').hide();
        } else {
            $('.business-block').show();
        }
    });

    $('#PersonalAccountForm').validate({
        rules:{
            firstname:"required",
            lastname:"required"
        }
    });

    $('#SocialAccountForm').validate({  
        rules:{
            account_type:{
                required:true
            },
            firstname:"required",
            lastname:"required",
            contactno:{
                required: {
                        depends: function(element) {
                            if ($("input[name='account_type']:checked").val() == "business"){
                                return true;
                            }
                            else {
                                return false;
                            }
                        }
                },
                digits:true,
                minlength:10,
                maxlength:10
            },
            job_title:{
                required: {
                        depends: function(element) {
                            if ($("input[name='account_type']:checked").val() == "business"){
                                return true;
                            }
                            else {
                                return false;
                            }
                        }
                },
            },
            website:{
                required: {
                        depends: function(element) {
                            if ($("input[name='account_type']:checked").val() == "business"){
                                return true;
                            }
                            else {
                                return false;
                            }
                        }
                },
                url: true
            },
            company_size:{
                required: {
                        depends: function(element) {
                            if ($("input[name='account_type']:checked").val() == "business"){
                                return true;
                            }
                            else {
                                return false;
                            }
                        }
                },
                digits:true
            }
        }
    });

    $('#BusinessAccountForm').validate({
        rules:{
            firstname:"required",
            lastname:"required",
            contactno:{
                required:true,
                digits:true,
                minlength:10,
                maxlength:10
            },
            job_title:"required",
            website:{
                required:true,
                url: true
            },
            company_size:{
                required:true,
                digits:true
            }
        }
    });
});
</script>