@extends('layouts.master')

@section('content')
<section class="login-reg-section">
    <div class="container">
        <div class="row justify-content-center">
        </div>
        <div class="row justify-content-center">
            <div class="col-md-7 col-lg-5">
                <div class="login-reg-wrap p-4 p-md-5">
                    <div class="icon d-flex align-items-center justify-content-center">
                        <i class="fa-solid fa-user" aria-hidden="true"></i>
                    </div>
                    <h3 class="text-center mb-4">{{ __('Sign In') }}</h3>
                    <form method="POST" action="{{ route('login') }}" class="login-form needs-validation" novalidate>
                        @csrf
                        <div class="form-floating mb-3">
                            <input id="username" type="text" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" name="username" value="{{ old('username') }}" placeholder="Email or Username" required>
                            <label for="username">{{ __('Email or Username') }}</label>
                            @if ($errors->has('username'))
                            <div class="invalid-feedback">
                                {{ $errors->first('username') }}
                            </div>
                            @endif
                        </div>
                        <div class="form-floating mb-3 d-flex">
                            <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="Password" required>
                            <label for="password">{{ __('Password') }}</label>
                            @if ($errors->has('password'))
                            <div class="invalid-feedback">
                                {{ $errors->first('password') }}
                            </div>
                            @endif
                        </div>
                        <div class="form-group">
                            <button type="submit" class="form-control btn btn-primary rounded submit px-3">Login</button>
                        </div>
                        <div class="form-group d-md-flex">
                            <div class="w-50">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                <label class="form-check-label" for="remember">
                                    {{ __('Remember Me') }}
                                </label>
                            </div>
                            <div class="w-50 text-md-right">
                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                            </div>
                        </div>
                        <div class="text-center">
                            <p>Not a member? <a href="{{ route('register') }}">{{ __('Register') }}</a></p>
                            <p>or sign up with:</p>
                            <button type="button" class="btn btn-link btn-floating mx-1">
                                <i class="fab fa-facebook-f"></i>
                            </button>

                            <button type="button" class="btn btn-link btn-floating mx-1">
                                <i class="fab fa-google"></i>
                            </button>

                            <button type="button" class="btn btn-link btn-floating mx-1">
                                <i class="fab fa-twitter"></i>
                            </button>

                            <button type="button" class="btn btn-link btn-floating mx-1">
                                <i class="fab fa-github"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
