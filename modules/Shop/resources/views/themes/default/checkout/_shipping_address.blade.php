<div id="shipping-address" x-show="!shipToBillingAddress">
    <h3>Shipping Address</h3>
    <hr>

    <div class="form-floating mb-3 row">
        {{ Form::text('shippingAddress[name]', null, [
                    'class' => 'form-control' . ($errors->has('shippingAddress.name') ? ' is-invalid' : ''),
                     'placeholder' => __('Name')
                ])
        }}
        <label for="shippingAddress[name]">{{ __('Name') }}</label>
        @if ($errors->has('shippingAddress.name'))
        <div class="invalid-feedback">{{ $errors->first('shippingAddress.name') }}</div>
        @endif
    </div>

    <div class="form-floating mb-3 row">
        {{ Form::text('shippingAddress[address]', null, [
                    'class' => 'form-control' . ($errors->has('shippingAddress.address') ? ' is-invalid' : ''),
                     'placeholder' => __('Address')
                ])
        }}
        <label for="shippingAddress[address]">{{ __('Address') }}</label>
        @if ($errors->has('shippingAddress.address'))
        <div class="invalid-feedback">{{ $errors->first('shippingAddress.address') }}</div>
        @endif
    </div>

    <div class="form-floating mb-3 row">
        {{ Form::text('shippingAddress[city]', null, [
                    'class' => 'form-control' . ($errors->has('shippingAddress.city') ? ' is-invalid' : ''),
                    'placeholder' => __('City')
                ])
        }}
        <label for="shippingAddress[city]">{{ __('City') }}</label>
        @if ($errors->has('shippingAddress.city'))
        <div class="invalid-feedback">{{ $errors->first('shippingAddress.city') }}</div>
        @endif
    </div>

    <div class="form-floating mb-3 row">
        {{ Form::select('shippingAddress[country_id]', $countries->pluck('name', 'id'),
                    setting('appshell.default.country'), [
                    'class' => 'form-control' . ($errors->has('shippingAddress.country_id') ? ' is-invalid' : ''),
                     'placeholder' => __('Country')
                ])
        }}
        <label for="shippingAddress[country_id]">{{ __('Country') }}</label>
        @if ($errors->has('shippingAddress.country_id'))
        <div class="invalid-feedback">{{ $errors->first('shippingAddress.country_id') }}</div>
        @endif
    </div>

    <div class="form-floating mb-3 row">
        {{ Form::text('shippingAddress[postalcode]', null, [
                    'class' => 'form-control' . ($errors->has('shippingAddress.postalcode') ? ' is-invalid' : ''),
                     'placeholder' => __('Zip Code')
                ])
        }}
        <label for="shippingAddress[postalcode]">{{ __('Zip code') }}</label>
        @if ($errors->has('shippingAddress.postalcode'))
        <div class="invalid-feedback">{{ $errors->first('shippingAddress.postalcode') }}</div>
        @endif
    </div>
</div>
