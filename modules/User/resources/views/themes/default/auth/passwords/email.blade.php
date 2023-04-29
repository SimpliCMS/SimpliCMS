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
                            @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                            @endif
                            <form method="POST" action="{{ route('password.email') }}" class="needs-validation" novalidate>
                                @csrf
                                <div class="form-floating mb-3 row">
                                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="name@example.com" required>
                                    <label for="email">{{ __('E-Mail Address') }}</label>
                                    @if ($errors->has('email'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('email') }}
                                    </div>
                                    @endif
                                </div>
                                <div class="d-grid gap-2 mx-auto">
                                    <button type="submit" class="btn btn-primary btn-large">
                                        {{ __('Send Password Reset Link') }}
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
