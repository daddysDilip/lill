<div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h1 class="heading-s2">Group Links</h1>
            <button type="button" class="btn btn-sm close modal-btn-close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <ul class="list-group">
                @if (!empty($GroupLinks) && count($GroupLinks) > 0)
                    @foreach ($GroupLinks as $links)
                        <li class="list-group-item pt-4 pb-4" id="Link-Row-{{$links->link_map_id}}">
                            <div class="col-lg-12">
                                <div class="row">
                                    <div class="col-lg-8">
                                        <a href="{{$links->generated_link}}" target="_blank" id="copy-link-{{$links->link_id}}">{{$links->generated_link}}</a>
                                        <p class="mt-2">{{$links->link_title}}</p>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="bottom-area p-3 d-flex align-items-center justify-content-between">
                                            <a href="{{$links->generated_link}}" target="_blank"><i class="sprite earth-icon"></i></a>
                                            <a class="btn-copy-group-link" data-clipboard-action="copy" data-clipboard-target="#copy-link-{{$links->link_id}}"><i class="sprite copy-icon"></i></a>
                                            <a href="{{route('view.share.link', $links->link_id)}}" class="share-link"><i class="sprite share-icon"></i></a>
                                            <a href="{{route('edit.link',$links->link_id)}}"><i class="sprite edit-icon"></i></a>
                                            <a href="#" class="delete-group-link" data-link_map_id="{{$links->link_map_id}}"><i class="sprite delete-icon"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                    @endforeach
                @endif
            </ul>
        </div>
    </div>
  </div>