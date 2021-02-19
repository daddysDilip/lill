@if (!empty($notification))
    @if ($notification_type == "new-link")
        @foreach ($notification as $notif)
            <a class="dropdown-item media" href="#">
                <div class="media-body">
                    <h5 class="mt-0 mb-1">{{$notif->data['title']}}</h5>
                    {{$notif->data['generated_link']}}
                    <br/>
                    {{$notif->created_at->diffForHumans()}}
                </div>
            </a>
        @endforeach
    @endif

@else

<a class="dropdown-item media" href="#">
    <div class="media-body">
        <h5 class="mt-0 mb-1 text-center">Nothing to show here.</h5>
    </div>
</a>

@endif