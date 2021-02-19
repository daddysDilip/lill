@if (!empty($Link))
    <div class="tab-content links-tab" id="v-pills-tabContent">
        <div class="tab-pane fade show active" data-link_id="{{$Link->id}}"  id="v-pills-{{$Link->link_code}}" role="tabpanel" aria-labelledby="v-pills-{{$Link->link_code}}-tab">
            <div class="link-details p-2 p-lg-3">
                CREATED {{get_link_full_date($Link->created_at)}}
                <br/><br/>
                <h2 class="heading-s2">{{$Link->generated_link}}</h2>
                <p class="mb-2">{{$Link->link_title}}</p>
                <a href="{{url('/'.$Link->link_code)}}" target="_blank">{{$Link->website_url ?? ''}}</a>
                <div class="row extra-small-gutter mt-4">
                    <div class="col-lg-6 mb-3">
                        @include('partials.dashboard.link_charts')
                    </div>
                    <div class="col-lg-6 mb-3">
                        <div class="box-shadow">
                            <div id="map1" style="width: 100%; height: 300px"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif

@include('partials.client.ui.dashboard_ajax_scripts')
