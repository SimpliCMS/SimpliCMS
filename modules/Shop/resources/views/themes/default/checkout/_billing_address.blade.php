<h3>Billing Address</h3>
<hr>

<div class="form-floating mb-3 row">
    {{ Form::text('billpayer[address][address]', null, [
                'class' => 'form-control' . ($errors->has('billpayer.address.address') ? ' is-invalid' : ''),
                        'placeholder' => __('Address')
            ])
    }}
    <label for="billpayer[address][address]">{{ __('Address') }}</label>
    @if ($errors->has('billpayer.address.address'))
    <div class="invalid-feedback">{{ $errors->first('billpayer.address.address') }}</div>
    @endif
</div>

<div class="form-floating mb-3 row">
    {{ Form::text('billpayer[address][city]', null, [
                'class' => 'form-control' . ($errors->has('billpayer.address.city') ? ' is-invalid' : ''),
                        'placeholder' => __('City')
            ])
    }}
    <label for="billpayer[address][city]">{{ __('City') }}</label>
    @if ($errors->has('billpayer.address.city'))
    <div class="invalid-feedback">{{ $errors->first('billpayer.address.city') }}</div>
    @endif
</div>

<div class="form-floating mb-3 row">
    {{ Form::select('billpayer[address][country_id]', $countries->pluck('name', 'id'),
                setting('appshell.default.country'), [
                'class' => 'form-control' . ($errors->has('billpayer.address.country_id') ? ' is-invalid' : ''),
                        'placeholder' => __('Country')
            ])
    }}
    <label for="billpayer[address][country_id]">{{ __('Country') }}</label>
    @if ($errors->has('billpayer.address.country_id'))
    <div class="invalid-feedback">{{ $errors->first('billpayer.address.country_id') }}</div>
    @endif
</div>

<div class="form-floating mb-3 row">
    {{ Form::text('billpayer[address][postalcode]', null, [
                'class' => 'form-control' . ($errors->has('billpayer.address.postalcode') ? ' is-invalid' : ''),
                        'placeholder' => __('Zip Code')
            ])
    }}
    <label for="billpayer[address][postalcode]">{{ __('Zip code') }}</label>
    @if ($errors->has('billpayer.address.postalcode'))
    <div class="invalid-feedback">{{ $errors->first('billpayer.address.postalcode') }}</div>
    @endif
</div>
