@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
    </div>
    <div class="row justify-content-center">
        <div class="col-md-7 col-lg-6">

            <div class="card shadow rounded">
                <div class="p-4 p-md-5">
                    <h3 class="text-center mt-4 mb-4">{{ __('Profile Avatar') }}</h3>
                    <div class="card-body">
                        <div class="row justify-content-center">
                            <img src="{{ $profile->getProfileAvatar() }}" class="rounded-circle" style="width: 200px;">
                        </div>
                        <form method="POST" action="{{ route('profile.update', ['user' => $user, 'profile' => $profile]) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label for="avatar" class="form-label">{{ __('Update Avatar') }}</label>
                                <input type="file" class="form-control" id="avatar" name="avatar">
                            </div>

                            <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection
