@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}" class="needs-validation" novalidate>
                        @csrf

                        <div class="form-floating mb-3 row">
                            <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" placeholder="First and Last name" required autofocus>
                            <label for="name">{{ __('Name') }}</label>
                            @if ($errors->has('name'))
                            <div class="invalid-feedback">
                                {{ $errors->first('name') }}
                            </div>
                            @endif
                        </div>

                        <div class="form-floating mb-3 row">
                            <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="name@example.com" required>
                            <label for="email">{{ __('E-Mail Address') }}</label>
                            @if ($errors->has('email'))
                            <div class="invalid-feedback">
                                {{ $errors->first('email') }}
                            </div>
                            @endif

                        </div>

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

                        <div class="input-group row mb-0">
                            <button type="submit" class="btn btn-primary btn-large">
                                {{ __('Register') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
