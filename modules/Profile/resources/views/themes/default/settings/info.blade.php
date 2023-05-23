@extends('layouts.master')

@section('content')
@push('style')
<link rel="stylesheet" href="https://npmcdn.com/flatpickr/dist/themes/confetti.css">
@endpush
<div class="container">
    <div class="row justify-content-center">
    </div>
    <div class="row justify-content-center">
        <div class="col-md-7 col-lg-6">
            @include('profile::partials.settings-nav', ['navItems' => ''])
            <div class="card shadow rounded">
                <div class="p-4 p-md-5">
                    <h3 class="text-center mt-4 mb-4">{{ __('Basic Info') }}</h3>
                    <div class="card-body">
                        <form method="POST" action="{{ route('profile.update', ['user' => $user, 'profile' => $profile]) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-floating mb-3 row">
                                <input type="text" class="flatpickr flatpickr-input active" name="birthdate" id="birthdate" value="{{ $profile->person->birthdate }}" placeholder="Date of Birth">
                                <label for="birthdate">{{ __('Date of Birth') }}</label>
                            </div>
                            <div class="form-floating mb-3 row">
                                <select class="form-select" name="gender" id="gender" aria-label="Floating label select example">
                                    <option value=" ">Gender</option>
                                    <option value="m" {{ ( $profile->person->gender_value == 'Male') ? 'selected' : '' }}>Male</option>
                                    <option value="f" {{ ( $profile->person->gender_value == 'Female') ? 'selected' : '' }}>Female</option>
                                </select>
                                <label for="gender">Gender</label>
                            </div>
                            <div class="form-floating mb-3 row">
                                <textarea class="form-control" name="bio" value="{{ $profile->person->bio }}" placeholder="Profile Bio" id="bio" style="height: 100px">{{ $profile->person->bio }}</textarea>
                                <label for="bio">Bio</label>
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
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
config = {
    altInput: true,
    altFormat: "F j, Y",
    dateFormat: "Y-m-d",
}
flatpickr("input[type=text]", config);
    </script>
    <script>
        window.onload = function () {
            var element = document.getElementById("info");
            element.classList.add("active");
        };
    </script>
    @endpush
    @endsection