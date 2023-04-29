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
                        <i class="fa-solid fa-user-plus" aria-hidden="true"></i>
                    </div>
                    <h3 class="text-center mb-4">{{ __('Register') }}</h3>
                    <form method="POST" action="{{ route('register') }}" class="needs-validation" novalidate>
                        @csrf
                        <div class="form-floating mb-3">
                            <input id="username" type="text" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" name="username" value="{{ old('username') }}" placeholder="Username" required>
                            <label for="username">{{ __('Username') }}</label>
                            @if ($errors->has('name'))
                            <div class="invalid-feedback">
                                {{ $errors->first('username') }}
                            </div>
                            @endif
                        </div>
                        <div class="form-floating mb-3">
                            <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" placeholder="First and Last name" required>
                            <label for="name">{{ __('Name') }}</label>
                            @if ($errors->has('name'))
                            <div class="invalid-feedback">
                                {{ $errors->first('name') }}
                            </div>
                            @endif
                        </div>
                        <div class="form-floating mb-3">
                            <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="name@example.com" required>
                            <label for="email">{{ __('E-Mail Address') }}</label>
                            @if ($errors->has('email'))
                            <div class="invalid-feedback">
                                {{ $errors->first('email') }}
                            </div>
                            @endif
                        </div>
                        <div class="form-floating mb-3">
                            <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="Password" required>
                            <label for="password">{{ __('Password') }}</label>
                            @if ($errors->has('password'))
                            <div class="invalid-feedback">
                                {{ $errors->first('password') }}
                            </div>
                            @endif
                        </div>
                        <div class="form-floating mb-3">
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password" required>
                            <label for="password-confirm">{{ __('Confirm Password') }}</label>
                        </div>                       
                        <div class="form-group">
                            <button type="submit" class="form-control btn btn-primary rounded submit px-3">{{ __('Register') }}</button>
                        </div>
                        <div class="form-group d-md-flex">
                            <div class="w-50">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                <label class="form-check-label" for="remember">
                                    {{ __('Remember Me') }}
                                </label>
                            </div>
                        </div>
                        <div class="text-center">
                            <p>Already a member? <a href="{{ route('login') }}">{{ __('Login') }}</a></p>
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