@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @include('user::partials.account-nav')
            <div class="card">
                <div class="card-header">{{ __('Account Security') }}</div>

                <div class="card-body">
                    <form action="{{ route('user.update', ['id'=> $user->id]) }}" method="POST" class="justify-content-center">
                        @csrf
                        @method('PUT')
                        <div class="row justify-content-center">
                            <div class="col-sm-10">
                                <div class="form-floating mb-3 row">
                                    <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="Password" required>
                                    <label for="password">{{ __('Password') }}</label>
                                    @if ($errors->has('password'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('password') }}
                                    </div>
                                    @endif
                                </div>
                                <div class="form-floating mb-3 row">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password" required>
                                    <label for="password-confirm">{{ __('Confirm Password') }}</label>
                                </div>
                                <div class="d-grid gap-2 mx-auto">
                                    <button type="submit" class="btn btn-primary btn-lg">
                                        {{ __('Update') }}
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
<script>
    window.onload = function () {
        var element = document.getElementById("security");
        element.classList.add("active");
    };
</script>