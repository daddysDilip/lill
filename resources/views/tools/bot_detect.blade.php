@include('partials.client.ui.head_scripts')
<div class="container">
    <div class="d-flex align-items-center justify-content-center h-100">
        <div class="row">
            <div class="col-lg-12 d-flex align-items-center justify-content-center flex-column">
                <img src="{{asset('client/images/bot.gif')}}" alt="Bot Detected" width="250px" />
                <h1 class="font-weight-bold mt-2" style="font-size: 30px;">Bot Detected</h1>
            </div>
        </div>
    </div>
</div>
@include('partials.client.ui.footer_scripts')
