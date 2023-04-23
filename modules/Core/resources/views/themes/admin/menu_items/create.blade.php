<!-- menu_items/create.blade.php -->

@extends('appshell::layouts.private')
@section('title')
{{ __('Create item') }}
@stop
@section('content')
<div class="container-fluid">
    <div class="card card-accent-secondary">
        <div class="card-header">
        </div>

        <div class="card-body">
            <form action="{{ route('menus.menu_items.store', $menu->id) }}" method="POST">
                @csrf
                <input type="hidden" name="menu_id" value="{{ $menu->id }}"> <!-- Add this line to pass the $menu->id to the form -->
                <div class="form-group">
                    <label for="menu_id">Menu Connection</label>
                    <select name="menu_id" id="menu_id" class="form-control" required>
                        @foreach($menuAll as $menuConnection)
                        <option value="{{ $menuConnection->id }}" {{ $menu->menu_id == $menuConnection->id ? 'selected' : '' }}>{{ $menuConnection->name }}</option>
                        @endforeach

                    </select>
                </div>    
                <div class="form-group">
                    <label for="parent_id">Parent Menu</label>
                    <select name="parent_id" id="parent_id" class="form-control">
                        <option value="">None</option> <!-- Add an option for None or empty selection -->
                        @foreach($menuItems as $menuItem)
                        <option value="{{ $menuItem->id }}" {{ old('parent_id') == $menuItem->id ? 'selected' : '' }}>
                            {{ $menuItem->name }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="label">Name</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
                </div>
                <div class="form-group">
                    <label for="url">URL</label>
                    <input type="text" name="url" id="url" class="form-control" value="{{ old('url') }}" required>
                </div>
                <div class="form-check">
                    <input type="checkbox" name="is_internal" id="is_internal" class="form-check-input" value="1" checked>
                    <label for="is_internal" class="form-check-label">Is Internal?</label>
                </div>
                <button type="submit" class="btn btn-primary">Create</button>
            </form>
        </div>
    </div>
</div>
@endsection
