@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
    </div>
    <div class="row justify-content-center">
        <div class="col-md-7 col-lg-6">
            @include('profile::partials.settings-nav')
            <div class="card shadow rounded">
                <div class="p-4 p-md-5">

                    <div class="card-body">
                        <form method="POST" action="{{ route('profile.update.avatar', ['user' => $user, 'profile' => $profile]) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')



                            <button type="submit" class="btn btn-primary">{{ __('Update') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection
    <script>
        window.onload = function () {
            var element = document.getElementById("info");
            element.classList.add("active");
        };
    </script>
