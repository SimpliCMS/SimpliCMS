@extends('layouts.master')

@section('breadcrumbs')
<li class="breadcrumb-item"><a href="{{ route('product.index') }}">All Products</a></li>
<li class="breadcrumb-item"><a href="{{ route('cart.show') }}">Cart</a></li>
<li class="breadcrumb-item">Checkout</li>

@stop

@section('content')
<style>
    .product-image {
        max-width: 100%;
        display: block;
        margin-bottom: 2em;
    }
</style>
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="card shadow">
                <h3 class="text-center mt-4 mb-4">{{ __('Check Out') }}</h3>

                <div class="card-body">
                    @unless ($checkout)
                    <div class="alert alert-warning">
                        <p>Hey, nothing to check out here!</p>
                    </div>
                    @endunless

                    @if ($checkout)
                    <form x-data="checkout" action="{{ route('checkout.submit') }}" method="post">
                        {{ csrf_field() }}

                        @include('shop::checkout._billpayer', ['billpayer' => $checkout->getBillPayer()])

                        <div class="mb-4">
                            <input type="hidden" name="ship_to_billing_address" value="0" />
                            <div class="form-check">
                                <input class="form-check-input" id="chk_ship_to_billing_address" type="checkbox" name="ship_to_billing_address" value="1" x-model="shipToBillingAddress">
                                <label class="form-check-label" for="chk_ship_to_billing_address">Ship to the same address</label>
                            </div>
                        </div>

                        @include('shop::checkout._shipping_address', ['address' => $checkout->getShippingAddress()])

                        @include('shop::checkout._payment')


                        <div class="form-floating mb-3 row">

                            {{ Form::textarea('notes', null, [
                                            'class' => 'form-control' . ($errors->has('notes') ? ' is-invalid' : ''),
                                            'rows' => 3,
                                            'placeholder' => __('Order Notes')
                                        ])
                            }}
                            <label for="notes">{{ __('Order Notes') }}</label>
                            @if ($errors->has('notes'))
                            <div class="invalid-feedback">{{ $errors->first('notes') }}</div>
                            @endif
                        </div>

                        <hr>

                        <div>
                            <button class="btn btn-lg btn-success">Submit Order</button>
                        </div>


                    </form>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow bg-white">
                <h3 class="text-center mt-4 mb-4">{{ __('Summary') }}</h3>
                <div class="card-body">
                    @include('shop::cart._summary')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('alpine')
@if ($checkout)
<script>
    document.addEventListener("alpine:init", () => {
    Alpine.data('checkout', () => ({
    isOrganization: {{ (old('billpayer.is_organization') ?: false) ? 'true' : 'false' }},
            shipToBillingAddress: {{ (old('ship_to_billing_address') ?? true) ? 'true' : 'false' }}
    }))
    });
</script>
@endif
@endpush
