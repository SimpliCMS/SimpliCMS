<div class="form-group">
    <div class="input-group">
        <span class="input-group-prepend">
            <span class="input-group-text">
                {!! icon('product') !!}
            </span>
        </span>
        {{ Form::text('name', null, [
                'class' => 'form-control form-control-lg' . ($errors->has('name') ? ' is-invalid' : ''),
                'placeholder' => __('Service name')
            ])
        }}
        @if ($errors->has('name'))
        <div class="invalid-feedback">{{ $errors->first('name') }}</div>
        @endif
    </div>
</div>
<div class="form-row">
    <div class="form-group col-14 col-md-8 col-xl-6">
        <label class="form-control-label">{{ __('Price') }}</label>
        <div class="input-group">
            {{ Form::text('price', null, [
                    'class' => 'form-control' . ($errors->has('price') ? ' is-invalid' : ''),
                    'placeholder' => __('Price')
                ])
            }}
            <span class="input-group-append">
                <span class="input-group-text">
                    {{ config('vanilo.foundation.currency.code') }}
                </span>
            </span>
        </div>
        @if ($errors->has('price'))
            <input type="hidden" class="form-control is-invalid">
            <div class="invalid-feedback">{{ $errors->first('price') }}</div>
        @endif
    </div>

    <div class="form-group col-14 col-md-8 col-xl-6">
        <label class="form-control-label">{{ __('Original Price') }}</label>
        <div class="input-group">
            {{ Form::text('original_price', null, [
                    'class' => 'form-control' . ($errors->has('original_price') ? ' is-invalid' : ''),
                    'placeholder' => __('optional')
                ])
            }}
            <span class="input-group-append">
                <span class="input-group-text">
                    {{ config('vanilo.foundation.currency.code') }}
                </span>
            </span>
        </div>
        @if ($errors->has('original_price'))
            <input type="hidden" class="form-control is-invalid">
            <div class="invalid-feedback">{{ $errors->first('original_price') }}</div>
        @endif
    </div>
</div>
<hr>
<div class="form-group row">
    <label class="col-md-2">{{ __('State') }}</label>
    <div class="col-md-10">
        <?php /* $errors->has('state') ? ' is-invalid' : ''; */ ?>

        @foreach($states as $key => $value)
        <label class="radio-inline" for="state_{{ $key }}">
            {{ Form::radio('state', $key, $bookable->state === $key, ['id' => "state_$key"]) }}
            {{ $value }}
            &nbsp;
        </label>
        @endforeach


    </div>
</div>
@if ($errors->has('state'))
<div class="alert alert-danger">{{ $errors->first('state') }}</div>
@endif
<hr>
<div class="form-group">
    <label>{{ __('Description') }}</label>

    <textarea class="form-control" id="description" name="description" rows="10">{{ $bookable->description }}</textarea>

    @if ($errors->has('description'))
    <div class="invalid-feedback">{{ $errors->first('description') }}</div>
    @endif
</div>
<hr>
<div class="form-group">
    <?php $seoHasErrors = any_key_exists($errors->toArray(), ['ext_title', 'meta_description', 'meta_keywords']) ?>
    <h5><a data-toggle="collapse" href="#bookable-form-seo" class="collapse-toggler-heading"
           @if ($seoHasErrors)
           aria-expanded="true"
           @endif
           >{!! icon('>') !!} {{ __('SEO') }}</a></h5>

    <div id="bookable-form-seo" class="collapse{{ $seoHasErrors ? ' show' : '' }}">
        <div class="callout">

            @include('bookable-admin::partials.form._form_seo')

        </div>
    </div>
</div>

<div class="form-group">
    <?php $extraHasErrors = any_key_exists($errors->toArray(), ['slug', 'excerpt']) ?>
    <h5><a data-toggle="collapse" href="#bookable-form-extra" class="collapse-toggler-heading"
           @if ($extraHasErrors)
           aria-expanded="true"
           @endif
           >{!! icon('>') !!} {{ __('Extra Settings') }}</a></h5>

    <div id="bookable-form-extra" class="collapse{{ $extraHasErrors ? ' show' : '' }}">
        <div class="callout">

            @include('bookable-admin::partials.form._form_extra')

        </div>
    </div>
</div>