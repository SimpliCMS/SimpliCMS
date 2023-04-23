<!-- menus/index.blade.php -->

@extends('appshell::layouts.private')
@section('title')
{{ __('Menu Details') }}
@stop

@section('breadcrumbs')
<a class="breadcrumb-item"
   href="https://dev.gypsyearthdesignandhealing.com/admin/product">Home
</a>
@stop
@section('content')
<div class="container-fluid">
    <div class="card card-accent-secondary">
        <div class="card-header">
            {{ $menu->name }}

            <div class="card-actionbar">
                <div class="btn-group">
                    <a href="{{ route('menus.menu_items.create', $menu->id) }}" class="btn btn-sm btn-outline-success">
                        <i class="zmdi zmdi-plus " ></i>
                        New Menu Item
                    </a>
                </div>
            </div>

        </div>
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Sub Items</th>
                        <th>Menu Connection</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($menu->menuItems as $menuItem)
                    <tr>
                        <td><a href="{{ route('menus.menu_items.edit', ['menu'=> $menu->id, 'menuItem'=> $menuItem->id]) }}">{{ $menuItem->name }}</a></td>
                        <td>{{ $menuItem->children->count() }}</td>
                        <td>{{ $menu->name }}</td>
                        <td>
                            <a href="{{ route('menus.menu_items.edit', ['menu'=> $menu->id, 'menuItem'=> $menuItem->id]) }}" class="btn btn-info">Edit</a>
                            <form action="{{ route('menus.menu_items.destroy', ['menu'=> $menu->id, 'menuItem'=> $menuItem->id]) }}" method="POST" style="display:inline;">
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
