<div id="addEmailModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
            <div class="row d-flex justify-content-start p-2">
                <h4 class="modal-title">Add Email</h4>
            </div>
            <button type="button" class="btn btn-sm close modal-btn-close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-sm-12">
            <form action="{{url('check-new-email-exist')}}" method="POST" id="AddEmailForm">
                @csrf
                <div class="form-group row">
                    <div class="col-lg-12">
                        <input type="email" name="new_email" id="new_email" placeholder="Enter email" class="form-control" />
                    </div>
                </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Submit</button>
            <button type="reset" class="btn btn-secondary" data-dismiss="modal">Reset</button>
        </div>
            </form>
      </div>
    </div>

  </div>
</div>