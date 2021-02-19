@extends('layouts.admin_layout')

@section('content')
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            {{Auth::guard('admin')->user()->firstname}} {{Auth::guard('admin')->user()->lastname}}
        </div>
    </div>    
@endsection
