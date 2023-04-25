@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @include('user::partials.account-nav')
            <div class="card">
                <div class="card-header">{{ __('Account Details') }}</div>

                <div class="card-body">
                    <form action="{{ route('user.update', ['id'=> $user->id]) }}" method="POST" class="needs-validation" novalidate>
                        @csrf
                        @method('PUT')
                        <div class="form-floating mb-3 row">
                            <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ $user->name }}" placeholder="Name" required autofocus>
                            <label for="name">{{ __('Name') }}</label>
                            @if ($errors->has('name'))
                            <div class="invalid-feedback">
                                {{ $errors->first('name') }}
                            </div>
                            @endif
                        </div>

                        <div class="form-floating mb-3 row">
                            <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $user->email }}" placeholder="name@example.com" required>
                            <label for="email">{{ __('E-Mail Address') }}</label>
                            @if ($errors->has('email'))
                            <div class="invalid-feedback">
                                {{ $errors->first('email') }}
                            </div>
                            @endif
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
        var element = document.getElementById("account");
        element.classList.add("active");
    };
</script>