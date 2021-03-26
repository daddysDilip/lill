@if (!empty($LinksData))
<div class="links-block">
    <div class="pt-2 pb-2 pl-3 pr-3 border-bottom">
        <div class="row align-items-center justify-content-between">
            <div class="col-auto">
                <div class="top-block">
                    {{$TotalLinks ?? "0" }} Links
                </div>
            </div>
            <div class="col-auto position-relative">
                {{-- <div class="text-right">
                    <i class="sprite setting-icon"></i>
                </div>
                <div class="filter-options position-absolute bg-white box-shadow p-3">
                    <form id="FilterLinks" action="{{route('sort.link')}}" method="post">
                        @csrf
                        <div class="mb-1">
                            <label class="col-form-label">Sort by:</label>
                            <div class="custom-control position-relative bg-white">
                                <select class="form-control" name="sort_by" id="sort_by">  
                                    <option value="latest">Latest</option>
                                    <option value="asc">Slashtag A-Z</option>
                                    <option value="desc">Slashtag Z-A</option>
                                    <option value="favourite">Loved</option>
                                </select>
                            </div>
                        </div>
                        <div class="mb-3 position-relative">
                            <label class="col-form-label">Date:</label>
                            <input id="dt" class="form-control bg-white" type="text" name="sort_date" placeholder="Select Date" />
                            <div id="two"></div>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-theme btn-block pt-2 pb-2" type="submit">APPLY</button>
                        </div>
                    </form>
                </div> --}}
            </div>
        </div>
    </div>
    <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
        @foreach ($LinksData as $key => $links)
            <a class="nav-link pt-3 pb-3 pl-0 pr-0 {{$key == 0 ? 'active' : ''}}" onclick="getSingleLink('{{$links->id}}');" data-link_id="{{$links->id}}" data-link_code="{{$links->link_code}}" id="{{$links->link_code}}-tab" data-toggle="pill" href="#v-pills-{{$links->link_code}}" role="tab" aria-controls="v-pills-{{$links->link_code}}" aria-selected="true">
                <div class="row small-gutter m-auto justify-content-center">
                    <div class="col-10">
                        <input type="checkbox" name="short_urls[]" value="{{$links->id}}" />
                        <label for="link1" class="w-100">
                            <span class="media-body">
                                <strong class="d-block">{{remove_http($links->generated_link)}}</strong>
                                {{$links->link_title}}
                            </span>
                            <span class="d-flex justify-content-between mt-3">
                                <span class="theme-color" href="#">
                                    <?php $link_count = get_link_count($links->id); ?>
                                    {{$link_count > 1 ? $link_count." Clicks" : $link_count." Click"}}
                                </span>
                                <span class="theme-color">
                                    {{get_link_date($links->created_at)}}
                                </span>
                            </span>
                        </label>
                    </div>
                    <div class="col-2">
                        <img src="{{$links->qr_code}}" />
                    </div>
                </div>                        
            </a>
            <div class="bottom-area border-bottom p-3 d-flex align-items-center justify-content-between">
                <span class="add-favorite" id="favorite-{{$links->id}}" data-toggle="tooltip" title="Add To Favorites"><i onclick="addToFavorites('{{$links->id}}','{{$links->favorite_id}}');" class="sprite heart-icon {{(!empty($links->favorite_id) && ($links->link_id == $links->id) ? "active" : "")}}"></i></span>
                <a href="{{$links->generated_link}}" target="_blank" data-toggle="tooltip" title="Visit Website"><i class="sprite earth-icon"></i></a>
                <a id="copy-link-{{$links->id}}" data-toggle="tooltip" title="Copy Link" onclick="copyLink('{{$links->id}}');" data-clipboard-text="{{$links->generated_link}}"><i class="sprite copy-icon"></i></a>
                <a href="{{route('view.share.link', $links->id)}}" data-toggle="tooltip" title="Share Link" class="share-link"><i class="sprite share-icon"></i></a>
                <a href="{{route('edit.link',$links->id)}}" data-toggle="tooltip" title="Edit Link"><i class="sprite edit-icon"></i></a>
                <a href="#" class="delete-link" data-link_id="{{$links->id}}" data-toggle="tooltip" title="Delete Link"><i class="sprite delete-icon"></i></a>
                <a class="hide-link" data-toggle="tooltip" title="Hide From Dashboard"><i data-link_id="{{$links->id}}" class="sprite view-icon"></i></a>
            </div>
        @endforeach
    </div>
</div>
@endif