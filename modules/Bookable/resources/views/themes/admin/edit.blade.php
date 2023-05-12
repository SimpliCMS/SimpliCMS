@extends('appshell::layouts.private')

@section('title')
    {{ __('Editing') }} {{ $bookable->name }}
@stop

@section('content')
<div class="row">

    <div class="col-12 col-lg-8 col-xl-9">
        {!! Form::model($bookable, [
                'route'  => ['bookables.admin.update', $bookable],
                'method' => 'PUT'
            ])
        !!}
        <div class="card card-accent-secondary">
            <div class="card-header">
                {{ __('Service Data') }}
            </div>
            <div class="card-body">
                @include('bookable-admin::partials.form._form')
            </div>

            <div class="card-footer">
                <button class="btn btn-primary">{{ __('Save') }}</button>
                <a href="#" onclick="history.back();" class="btn btn-link text-muted">{{ __('Cancel') }}</a>
            </div>
        </div>
        {!! Form::close() !!}
    </div>

    <div class="col-12 col-lg-4 col-xl-3">
        @include('admin::partials.media._edit', ['model' => $bookable])
    </div>

</div>
@include('core-admin::partials.tinymce._editor', ['selector' => 'description','height' => '400'])
@stop