@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @include('user::partials.account-nav')
            <div class="card">
                <div class="card-header">{{ __('Account Security') }}</div>

                <div class="card-body">
                    <form action="{{ route('user.update', ['id'=> $user->id]) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-floating mb-3 row">
                            <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="Password" required>
                            <label for="password">{{ __('Password') }}</label>
                            @if ($errors->has('password'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                            @endif
                        </div>

                        <div class="form-floating mb-3 row">
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password" required>
                            <label for="password-confirm">{{ __('Confirm Password') }}</label>
                        </div>

                        <div class="input-group row mb-0">
                            <button type="submit" class="btn btn-primary btn-lg">
                                {{ __('Update') }}
                            </button>
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