@extends('layouts.master')

@section('content')
@push('style')
<link rel="stylesheet" href="{{ url('modules/Profile/resources/assets/css/profile.css') }}">
@endpush
<div class="container profile-container">
    <div class="row">
        <div class="col-md-12">
            @include('profile::partials.show.cover')
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-md-3">
            @include('profile::partials.show.info')
        </div>
        <div class="col-md-9">

        </div>
    </div>
</div>
@include('profile::partials.show._cover-modal')
@endsection