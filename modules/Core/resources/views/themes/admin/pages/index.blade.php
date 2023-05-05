<!-- menus/index.blade.php -->

@extends('appshell::layouts.private')
@section('title')
{{ __('Pages') }}
@stop
@section('content')
<div class="container-fluid">
    <div class="card card-accent-secondary">
        <div class="card-header">
            Menus

            <div class="card-actionbar">
                <div class="btn-group">
                    <a href="{{ route('pages.admin.create') }}" class="btn btn-sm btn-outline-success">
                        <i class="zmdi zmdi-plus " ></i>
                        Create Page
                    </a>
                </div>
            </div>

        </div>
        <div class="card-body">
            <hr>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Slug</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pages as $page)
                    <tr>
                        <td><a href="{{ route('pages.admin.edit', $page->id) }}">{{ $page->title }}</a></td>
                        <td>{{ $page->slug }}</td>
                        <td>
                            <a href="{{ route('pages.admin.edit', $page->id) }}" class="btn btn-info">Edit</a>
                            <form action="{{ route('pages.admin.destroy', $page->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this page?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
