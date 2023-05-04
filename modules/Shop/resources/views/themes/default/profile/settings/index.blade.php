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
                        <form class="row g-3" method="POST" action="{{ route('profile.settings.shop.update', ['user' => $user, 'profile' => $profile]) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <h5>{{ __('Billing Address') }}</h5>
                            <div class="form-floating col-12">
                                <input type="text" class="form-control" id="inputAddress" placeholder="1234 Main St">
                                <label for="inputAddress" class="form-label">Address</label>
                            </div>
                            <div class="form-floating col-12">
                                <input type="text" class="form-control" id="inputAddress2" placeholder="Apartment, studio, or floor">
                                <label for="inputAddress2" class="form-label">Address 2</label>
                            </div>
                            <div class="form-floating col-md-6">
                                <input type="text" class="form-control" id="inputCity"  placeholder="City">
                                <label for="inputCity" class="form-label">City</label>
                            </div>
                            <div class="form-floating col-md-4">
                                <select id="inputState" class="form-select">
                                    <option selected>Choose...</option>
                                    <option>...</option>
                                </select>
                                <label for="inputState" class="form-label">State</label>
                            </div>
                            <div class="form-floating col-md-2">
                                <input type="text" class="form-control" id="inputZip"  placeholder="Zip">
                                <label for="inputZip" class="form-label">Zip</label>
                            </div>

                            <h5>{{ __('Shipping Address') }}</h5>
                            <div class="form-floating col-12">
                                <input type="text" class="form-control" id="inputAddress" placeholder="1234 Main St">
                                <label for="inputAddress" class="form-label">Address</label>
                            </div>
                            <div class="form-floating col-12">
                                <input type="text" class="form-control" id="inputAddress2" placeholder="Apartment, studio, or floor">
                                <label for="inputAddress2" class="form-label">Address 2</label>
                            </div>
                            <div class="form-floating col-md-6">
                                <input type="text" class="form-control" id="inputCity"  placeholder="City">
                                <label for="inputCity" class="form-label">City</label>
                            </div>
                            <div class="form-floating col-md-4">
                                <select id="inputState" class="form-select">
                                    <option selected>Choose...</option>
                                    <option>...</option>
                                </select>
                                <label for="inputState" class="form-label">State</label>
                            </div>
                            <div class="form-floating col-md-2">
                                <input type="text" class="form-control" id="inputZip"  placeholder="Zip">
                                <label for="inputZip" class="form-label">Zip</label>
                            </div>

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