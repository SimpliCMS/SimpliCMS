@extends('layouts.master')

@section('content')
<section class="login-reg-section">
    <div class="container">
        <div class="row justify-content-center">
        </div>
        <div class="row justify-content-center">
            <div class="col-md-7 col-lg-5">
                <div class="login-reg-wrap p-4 p-md-5">
                    <div class="card border border-0">
                        <div class="icon d-flex align-items-center justify-content-center">
                            <i class="fa-solid fa-key" aria-hidden="true"></i>
                        </div>
                        <h3 class="text-center mb-4">{{ __('Reset Password') }}</h3>
                        <div class="card-body">
                            <form method="POST" action="{{ route('password.update') }}">
                                @csrf
                                <input type="hidden" name="token" value="{{ $token }}" class="needs-validation" novalidate>
                                <div class="form-floating mb-3 row">
                                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $email ?? old('email') }}" placeholder="name@example.com" required>
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
                                    <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password" required>
                                    <label for="password-confirm">{{ __('Confirm Password') }}</label>
                                </div>
                                <div class="d-grid gap-2 mx-auto">
                                    <button type="submit" class="btn btn-primary btn-large">
                                        {{ __('Reset Password') }}
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
