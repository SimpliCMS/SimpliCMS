<!-- menus/index.blade.php -->

@extends('appshell::layouts.private')
@section('title')
{{ __('Menus') }}
@stop
@section('content')
<div class="container-fluid">
    <div class="card card-accent-secondary">
        <div class="card-header">
            Menus

            <div class="card-actionbar">
                <div class="btn-group">
                    <a href="{{ route('menus.create') }}" class="btn btn-sm btn-outline-success">
                        <i class="zmdi zmdi-plus " ></i>
                        Create Menu
                    </a>
                </div>
            </div>

        </div>
        <div class="card-body">
            <hr>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Slug</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($menus as $menu)
                    <tr>
                        <td><a href="{{ route('menus.show', $menu->id) }}">{{ $menu->name }}</a></td>
                        <td>{{ $menu->slug }}</td>
                        <td>
                            <a href="{{ route('menus.edit', $menu->id) }}" class="btn btn-info">Edit</a>
                            <form action="{{ route('menus.destroy', $menu->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this menu?')">Delete</button>
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
