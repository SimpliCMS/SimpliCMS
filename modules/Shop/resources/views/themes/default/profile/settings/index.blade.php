@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
    </div>
    <div class="row justify-content-center">
        <div class="col-md-7 col-lg-6">
            @include('profile::partials.settings-nav', ['navItems' => ''])
            <div class="card shadow rounded">
                <div class="p-4 p-md-5">
                    <h3 class="text-center mt-4 mb-4">{{ __('Shop Profile') }}</h3>
                    <div class="card-body">
                        <form method="POST" action="{{ route('profile.settings.shop.update', ['user' => $user, 'profile' => $profile]) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
 
                            <div class="d-grid gap-2 mx-auto">
                                <button type="submit" class="btn btn-primary">{{ __('Update') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
    <script>
        window.onload = function () {
            var element = document.getElementById("shop");
            element.classList.add("active");
        };
    </script>

    @endpush
    @endsection