@extends('layouts.client_dashboard_layout')
@section('title') Group Links @endsection
@section('content')
    @include('tools.spinner')
    @if (!empty($LinkGroups) && count($LinkGroups) > 0)
    <div class="container">
        <div class="row mt-5">
            @foreach ($LinkGroups as $group)
                <div class="col-lg-3">
                    <div class="card">
                        <img src="{{!empty($group->group_icon) ? asset('uploads/group_icon/'.$group->group_icon) : ''}}" class="card-img-top p-3">
                        <div class="card-body" style="border-top: 1px solid #acacac30;">
                            <h5 class="card-title text-center">{{$group->group_name}}</h5>
                            <a href="{{route('view.group.links',$group->id)}}" class="btn btn-primary btn-block btn-view-group-links">View Links</a>
                            <div class="row mt-3">
                                <div class="col-sm-12 d-flex justify-content-center align-items-center">
                                    <button type="button" data-toggle="tooltip" title="Delete Group" class="btn btn-danger btn-sm btn-delete-group" data-group_id="{{$group->id}}"><i class="fa fa-trash"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="row">
            <div class="col-lg-12 d-flex align-items-center justify-content-center flex-column">
                <a href="{{route('create.link.group')}}" class="btn btn-theme btn-circle btn-xl"><i class="fa fa-plus"></i></a>
                <h1 class="font-weight-bold mt-2 heading-s2">Add link group.</h1>
            </div>
        </div>
    </div>
    @else
    <div class="container mt-4 pb-4 d-flex align-items-center justify-content-center h-100 empty-link-block">
        <div class="row">
            <div class="col-lg-12 d-flex align-items-center justify-content-center flex-column">
                <a href="{{route('create.link.group')}}" class="btn btn-theme btn-circle btn-xl"><i class="fa fa-plus"></i></a>
                <h1 class="font-weight-bold mt-2 heading-s2">No link groups found.</h1>
            </div>
        </div>
    </div>
    @endif

    <div class="modal fade" tabindex="-1" id="GroupLinksModal" role="dialog">
  
    </div>

    <div class="modal" id="share-link" tabindex="-1" role="dialog">

    </div>
    
@endsection

@section('js')
    @include('partials.client.ui.dashboard_ajax_scripts')
@endsection