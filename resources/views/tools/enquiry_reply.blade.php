<div class="modal fade" tabindex="-1" id="EnquiryReplyModal" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Send Reply To Enquiry</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{route('reply.customer.enquiry')}}" method="POST" id="EnquiryReplyForm">
            <input type="hidden" name="email" class="form-control" id="email" value="" />
            <input type="hidden" name="enquiry_id" class="form-control" id="enquiry_id" value="" />
            @csrf
            <div class="form-group small-gutter row">
              <div class="col-lg-12">
                <textarea id="message" name="message" class="form-control" placeholder="Message"></textarea>
              </div>
            </div>
            <div class="form-group small-gutter row">
                <div class="col-lg-6">
                    <button type="submit" class="btn btn-primary btn-block">Submit</button>
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
