<div class="modal fade" tabindex="-1" id="GetCallModal" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Get A Quote</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{route('send.quotation')}}" method="POST" id="GetQuoteForm">
            @csrf
            <div class="form-group row">
                <div class="col-lg-12">
                    <input type="text" name="fullname" class="form-control" id="fullname" placeholder="Your name*" />
                </div>
            </div>
            <div class="form-group small-gutter row">
                <div class="col-lg-6">
                    <input type="email" name="email" class="form-control" id="email" placeholder="Your email*" />
                </div>
                <div class="col-lg-6">
                    <input type="text" name="phone_number" class="form-control" id="phone_number" placeholder="Your Phone Number*" />
                </div>
            </div>
            <div class="form-group small-gutter row">
              <div class="col-lg-12">
                <textarea id="message" name="message" class="form-control" placeholder="Message"></textarea>
              </div>
            </div>
            <div class="form-group small-gutter row">
                <div class="col-lg-6">
                    <button type="submit" class="btn btn-theme btn-block p-2">Submit</button>
                </div>
                <div class="col-lg-6">
                    <button type="button" class="btn btn-reset bg-dark text-white btn-block" data-dismiss="modal">Close</button>
                </div>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>
