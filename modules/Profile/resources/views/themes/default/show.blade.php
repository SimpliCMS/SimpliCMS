@extends('layouts.master')

@section('content')
@push('style')
<style>
    .profile-container {
        margin-top: -20px; /* Adjust this value as needed */
        padding-top: 0;
    }
    #cover-photo{
        width:100%;
        height:350px;
        background:url(https://i.imgur.com/pkhWxWu.jpeg);
        background-size:cover;
        background-position: center center;
        transition: all .08s linear;
        position: relative;
        margin-bottom: 20px;
    }
    #avatar {
        position: absolute;
        bottom: -35px; /* Adjust this value as needed */
        left: 20px; /* Adjust this value as needed */
        width: 150px; /* Adjust this value as needed */
        height: 150px; /* Adjust this value as needed */
        background-size: cover;
        border-radius: 50%;
    }
    .basic-info {
        position: absolute;
        bottom: 0;
        left: 175px;
        color: #fff;
        font-size: 18px;
    }
    .basic-info h4 {
        margin: 35px 0;
        font-weight: bold;
    }
    .basic-info p {
        margin: 0;
    }
</style>
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

@endsection