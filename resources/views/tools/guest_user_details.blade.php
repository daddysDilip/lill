<div class="modal fade" id="GuestUserDataModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content p-1">
      <div class="modal-header">
        <h3 class="modal-title guest-user-form-title">Unlock Your Generated Link</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{route('store.guest.user.data')}}" method="POST" class="GuestUserDataForm" id="GuestUserDataForm">
            @csrf
            <input type="hidden" name="guest_website_url" id="guest_website_url" value="" />
            <input type="hidden" name="guest_link_type" id="guest_link_type" value="" />
          <div class="form-group row">
            <div class="col-lg-6 col-md-6">
                <label for="first-name" class="col-form-label">Firstname<span class="text-danger">*</span></label>
                <input type="text" class="form-control" placeholder="Enter your firstname" id="guest_firstname" name="guest_firstname" />
            </div>
            <div class="col-lg-6 col-md-6">
                <label for="last-name" class="col-form-label">Lastname<span class="text-danger">*</span></label>
                <input type="text" class="form-control" placeholder="Enter your lastname" id="guest_lastname" name="guest_lastname" />
            </div>
          </div>
          <div class="form-group">
            <label for="email" class="col-form-label">Email<span class="text-danger">*</span></label>
            <input type="email" class="form-control" id="guest_email" placeholder="Enter your email" name="guest_email" />
          </div>
          <div class="form-group">
            <label for="phone-number" class="col-form-label">Phone Number<span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="guest_phone_number" placeholder="Enter your phone number" name="guest_phone_number" />
          </div>
          <div class="form-group row pt-3">
            <div class="col-lg-6 col-md-6">
                <button type="submit" class="btn btn-primary btn-block">Submit</button>
            </div>
            <div class="col-lg-6 col-md-6">
                <button type="button" class="btn btn-secondary btn-block" data-dismiss="modal">Close</button>
            </div>
          </div>
        </form>
        <div id="guest-user-link-block" style="display: none;">
            <div class="input-group mb-3">
                <input type="text" class="form-control" name="generated_link" id="generated_link" type="text" />
                <div class="input-group-append">
                    <button class="btn btn-primary btn-copy" data-clipboard-action="copy" data-clipboard-target="#generated_link" type="button">Copy</button>
                </div>
            </div>
            <div class="row no-gutter mt-3">
                <div class="col-lg-12 d-flex justify-content-center align-items-center mb-2"><h2>Share Your Link On:</h2></div>
                <div class="col-lg-12 share-link-block">
                    {{-- <ul class="nav">
                        <li class="nav-item pr-2">
                            <button type="button" data-js="facebook-share" class="btn-social btn-share-fb" id="btn-guest-share-fb">
                                <img src="{{asset('client/images/fb-icon.png')}}" class="nav-icon" alt="Share Link On Facebook" />
                            </button>
                        </li>
                        <li class="nav-item pr-2">
                            <button type="button" data-js="twitter-share" class="btn-social btn-share-twitter" id="btn-guest-share-twitter">
                                <img src="{{asset('client/images/twitter-icon.png')}}" class="nav-icon" alt="Share Link On Twitter" />
                            </button>
                        </li>
                        <li class="nav-item pr-2">
                            <button type="button" class="btn-social btn-share-linkedin" id="btn-guest-share-linkedin">
                                <img src="{{asset('client/images/linkedin-icon.png')}}" class="nav-icon" alt="Share Link On Linked In" />
                            </button>
                        </li>
                    </ul> --}}
                </div>
            </div>
        </div>
      </div>
    </div>
  </div>
</div>