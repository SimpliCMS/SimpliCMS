<!-- menu_items/edit.blade.php -->

@extends('appshell::layouts.private')
@section('title')
{{ __('Edit Menu Item') }}
@stop
@section('content')
<div class="container-fluid">
    <div class="card card-accent-secondary">
        <div class="card-header">
            {{ $menuSubItem->name }}
        </div>

        <div class="card-body">
            <form action="{{ route('menus.menu_items.update', ['menu'=> $menu->id, 'menuItem'=> $menuSubItem->id]) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="menu_id">Menu Connection</label>
                    <select name="menu_id" id="menu_id" class="form-control" required>
                        @foreach($menus as $menu)
                        <option value="{{ $menu->id }}" {{ $menuSubItem->menu_id == $menu->id ? 'selected' : '' }}>{{ $menu->name }}</option>
                        @endforeach

                    </select>
                </div>
                <div class="form-group">
                    <label for="parent_id">Parent Menu Item</label>
                    <select name="parent_id" id="parent_id" class="form-control">
                        <option value="">None</option> <!-- Add this option for None selection -->
                        @foreach($menuItems as $item)
                        @if ($item->id == $menuSubItem->id || $item->menu_id !== $menuSubItem->menu_id)
                        @else
                        <option value="{{ $item->id }}" {{ $menuSubItem->parent_id == $item->id ? 'selected' : '' }}>
                            {{ $item->name }}
                        </option>
                        @endif
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="label">Name</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $menuSubItem->name) }}" required>
                </div>
                <div class="form-group">
                    <label for="url">URL</label>
                    <div class="form-check">
                        <input type="radio" name="is_internal" id="url_internal" class="form-check-input" value="1" {{ $menuSubItem->is_internal ? 'checked' : '' }}>
                        <label for="url_internal" class="form-check-label">Internal Route</label>
                    </div>
                    <div class="form-check">
                        <input type="radio" name="is_internal" id="url_custom" class="form-check-input" value="0" {{ !$menuSubItem->is_internal ? 'checked' : '' }}>
                        <label for="url_custom" class="form-check-label">Custom URL</label>
                    </div>
                    <input type="text" name="url" id="url" class="form-control" value="{{ old('url', $menuSubItem->url) }}" required>
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
</div>
@endsection
