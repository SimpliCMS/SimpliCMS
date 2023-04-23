<!-- menus/create.blade.php -->

@extends('appshell::layouts.private')
@section('title')
{{ __('Create Menu') }}
@stop
@section('content')
<div class="container-fluid">
    <div class="card card-accent-secondary">
        <div class="card-header">
            Menu Details
        </div>

        <div class="card-body">
            <form action="{{ route('menus.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
                </div>
                <div class="form-group">
                    <label for="slug">Slug</label>
                    <input type="text" name="slug" id="slug" class="form-control" value="{{ old('slug') }}" required>
                </div>
                <button type="submit" class="btn btn-primary">Create</button>
            </form>
        </div>
    </div>
</div>
@endsection
