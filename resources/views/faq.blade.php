@extends('layouts.client_layout')
@section('title')
    FAQ's
@endsection
@section('content')
<div class="cms-content-sec pt-5 pb-5">
    <div class="container">   
        <div class="border bg-light">
            @if (!empty($FAQ))
            @foreach ($FAQ as $faq)
            <div class="p-4 border-bottom">
                <h5 class="mb-2">{{$faq->question}}</h5>
                <p>{{$faq->answer}}</p>
            </div>
            @endforeach
            @endif
        </div>
    </div>
</div> 
@endsection
@section('js')
    <script>
        var is_home = true;
    </script>
@endsection