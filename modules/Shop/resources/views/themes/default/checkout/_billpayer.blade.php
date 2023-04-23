<h3>Bill To</h3>
<hr>

<div class="row">

    <div class="col-md-6">
        <div class="form-group">
            {{ Form::text('billpayer[email]', Auth::user() ? Auth::user()->email : null, [
                    'class' => 'form-control' . ($errors->has('billpayer.email') ? ' is-invalid' : ''),
                    'placeholder' => 'E-mail'
                ])
            }}

            @if ($errors->has('billpayer.email'))
            <div class="invalid-feedback">{{ $errors->first('billpayer.email') }}</div>
            @endif
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            {{ Form::text('billpayer[phone]', null, [
                    'class' => 'form-control' . ($errors->has('billpayer.phone') ? ' is-invalid' : ''),
                    'placeholder' => 'Telefon'
                ])
            }}

            @if ($errors->has('billpayer.phone'))
            <div class="invalid-feedback">{{ $errors->first('billpayer.phone') }}</div>
            @endif
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            {{ Form::text('billpayer[firstname]', Auth::user() ? (explode(' ', Auth::user()->name)[0] ?? ''): null, [
                    'class' => 'form-control' . ($errors->has('billpayer.firstname') ? ' is-invalid' : ''),
                    'placeholder' => __('First name')
                ])
            }}

            @if ($errors->has('billpayer.firstname'))
            <div class="invalid-feedback">{{ $errors->first('billpayer.firstname') }}</div>
            @endif
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            {{ Form::text('billpayer[lastname]', Auth::user() ? (explode(' ', Auth::user()->name)[1] ?? ''): null, [
                    'class' => 'form-control' . ($errors->has('billpayer.lastname') ? ' is-invalid' : ''),
                    'placeholder' => __('Last name')
                ])
            }}

            @if ($errors->has('billpayer.lastname'))
            <div class="invalid-feedback">{{ $errors->first('billpayer.lastname') }}</div>
            @endif
        </div>
    </div>

</div>


<div class="form-group">
    <div class="form-check">
        <input class="form-check-input" id="chk_is_organization" type="checkbox"
               name="billpayer[is_organization]" value="1" x-model="isOrganization">
        <label class="form-check-label" for="chk_is_organization">{{ __('Bill to Company') }}</label>
    </div>
</div>

<div id="billpayer-organization" x-show="isOrganization">
    <div class="form-group">
        {{ Form::text('billpayer[company_name]', null, [
                'class' => 'form-control form-control-lg' . ($errors->has('billpayer.company_name') ? ' is-invalid' : ''),
                'placeholder' => __('Company name')
             ])
        }}
        @if ($errors->has('billpayer.company_name'))
        <div class="invalid-feedback">{{ $errors->first('billpayer.company_name') }}</div>
        @endif
    </div>

    <div class="form-group">
        {{ Form::text('billpayer[tax_nr]', null, [
                'class' => 'form-control' . ($errors->has('billpayer.tax_nr') ? ' is-invalid' : ''),
                'placeholder' => __('Tax no.')
            ])
        }}
        @if ($errors->has('billpayer.tax_nr'))
        <div class="invalid-feedback">{{ $errors->first('billpayer.tax_nr') }}</div>
        @endif
    </div>
</div>

@include('shop::checkout._billing_address', ['address' => $billpayer->getBillingAddress()])

