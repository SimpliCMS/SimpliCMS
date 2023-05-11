<!-- menus/edit.blade.php -->

@extends('appshell::layouts.private')
@section('title')
{{ __('Edit Page') }}
@stop
@section('content')
<div class="container-fluid">
    <div class="row g-3">
        <div class="col-md-9">
            <form action="{{ route('pages.admin.update', $page->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="card card-accent-success">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="content">Page Content</label>
                            <textarea class="form-control" id="content" name="content" rows="10">{{ $page->content }}</textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>

                    </div>
                </div>
        </div>
        <div class="col-md-3">
            <div class="card card-accent-success">
                <div class="card-body">
                    <div class="form-group">
                        <label for="title">Name</label>
                        <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $page->title) }}" required>
                    </div>
                    <div class="form-group">
                        <label for="slug">Slug</label>
                        <input type="text" name="slug" id="slug" class="form-control" value="{{ old('slug', $page->slug) }}" required>
                    </div>
                </div>
            </div>
        </div>
        </form>
    </div>
</div>
@include('core-admin::partials.tinymce._editor', ['selector' => 'content','height' => '600'])
@endsection