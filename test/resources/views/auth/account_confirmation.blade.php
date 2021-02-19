@include('partials.client.ui.head_scripts')
 <div class="wrapper d-flex align-items-center justify-content-center h-100">
    <div class="col-lg-4">
        <div class="email-verification-sec d-flex flex-column align-items-center">
            <img src="{{asset('client/images/email/vector3.png')}}" />
            <p class="pt-3 text-center">
                Thanks for confirming your email!
            </p>
            <a href="{{url('/')}}" class="btn btn-theme pt-2 pb-2 mt-3">Enter your dashboard</a>
        </div>
    </div>
</div>
@include('partials.client.ui.footer_scripts')