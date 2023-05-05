<!-- menus/create.blade.php -->

@extends('appshell::layouts.private')
@section('title')
{{ __('Create Page') }}
@stop
@section('content')
<div class="container-fluid">
    <div class="card card-accent-secondary">
        <div class="card-header">
            Page Details
        </div>

        <div class="card-body">
            <form action="{{ route('pages.admin.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">Title</label>
                    <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}" required>
                </div>
                <div class="form-group">
                    <label for="slug">Slug</label>
                    <input type="text" name="slug" id="slug" class="form-control" value="{{ old('slug') }}" required>
                </div>

                <div class="form-group">
                    <label for="content">Page Content</label>
                    <textarea class="form-control" id="content" name="content" rows="10"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Create</button>
            </form>
        </div>
    </div>
</div>
@endsection
