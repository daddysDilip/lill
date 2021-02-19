
<div class="modal-dialog" role="document">
  <div class="modal-content">
    <div class="modal-header">    
      <div class="row d-flex justify-content-start p-2">
          <img src="{{get_favicon($Link->website_url)}}" width="30px" alt="Website Icon" />
          <h5 class="modal-title mt-1 ml-1" style="font-size: 16px !important;">{{$Link->generated_link ?? ''}}</h5>
      </div>
      <button type="button" class="btn btn-sm close modal-btn-close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="modal-body">
      <div class="row mb-3">
          <div class="col-sm-12">
              <p>{{$Link->link_title ?? ''}}</p>
          </div>
      </div>
      <div class="row mt-3">
          <div class="col-sm-12">
              <p>{{$Link->website_url ?? ''}}</p>
          </div>
      </div>
      <div class="row">
          <div class="col-sm-12 mt-3">
              <ul class="nav justify-content-center">
                  <li class="nav-item pr-2">
                    <button type="button" data-js="facebook-share" onclick="shareFBLink('{{$Link->generated_link}}');" class="btn-social btn-share-fb" id="btn-share-fb">
                      <img src="{{asset('client/images/fb-icon.png')}}" class="nav-icon" alt="Share Link On Facebook" />
                    </button>
                  </li>
                  <li class="nav-item pr-2">
                      <button type="button" onclick="shareTwitterLink('{{$Link->generated_link}}','{{$Link->website_url}}');"  data-js="twitter-share" class="btn-social btn-share-twitter" id="btn-share-twitter">
                        <img src="{{asset('client/images/twitter-icon.png')}}" class="nav-icon" alt="Share Link On Twitter" />
                      </button>
                  </li>
                  <li class="nav-item pr-2">
                      <button type="button" class="btn-social btn-share-linkedin" onclick="shareLinkedinLink('{{$Link->generated_link}}','{{$Link->link_title}}','{{$Link->website_url}}');">
                        <img src="{{asset('client/images/linkedin-icon.png')}}" class="nav-icon" alt="Share Link On Linked In" />
                      </button>
                  </li>
                  <li class="nav-item pr-2">
                      <button type="button" class="btn-social btn-share-mail" onclick="shareMailLink('{{$Link->generated_link}}','{{$Link->link_title}}');">
                        <img src="{{asset('client/images/mail-icon.png')}}" class="nav-icon" alt="Share Link Via Mail" />
                      </button>
                  </li>
              </ul>
          </div>
          <div class="col-sm-12 mt-3">
            <div class="d-flex align-items-center justify-content-center flex-column">
              <img src="{{$Link->qr_code}}" style="width: 100px;" alt="Qr Code">
              <a href="{{route('download.qr.code',$Link->id)}}" class="btn btn-sm btn-secondary" data-toggle="tooltip" title="Download QR Code"><i class="fa fa-download"></i></a>
            </div>
          </div>
      </div>
    </div>
  </div>
</div>