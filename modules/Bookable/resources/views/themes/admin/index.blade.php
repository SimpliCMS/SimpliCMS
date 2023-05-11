
@extends('appshell::layouts.private')
@section('title')
{{ __('Bookable Services') }}
@stop
@section('content')
<div class="container-fluid">
    <div class="card card-accent-secondary">
        <div class="card-header">
            Services

            <div class="card-actionbar">
                <div class="btn-group">
                    <a href="{{ route('bookables.admin.create') }}" class="btn btn-sm btn-outline-success">
                        <i class="zmdi zmdi-plus " ></i>
                        Create Service
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
                    @foreach($bookables as $bookable)
                    <tr>
                        <td><a href="{{ route('bookables.admin.edit', $bookable->id) }}">{{ $bookable->title }}</a></td>
                        <td>{{ $bookable->slug }}</td>
                        <td>
                            <a href="{{ route('bookables.admin.edit', $bookable->id) }}" class="btn btn-info">Edit</a>
                            <form action="{{ route('bookables.admin.destroy', $bookable->id) }}" method="POST" style="display:inline;">
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