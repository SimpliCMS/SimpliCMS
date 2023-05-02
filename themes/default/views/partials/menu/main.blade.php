@foreach($menuItems->sortBy('order') as $item)
@if($item->parent_id === null)
<li class="nav-item @if($item->children->count() > 0) dropdown @endif">
    @if($item->name == 'Admin')
    @role('admin')
    <a class="nav-link @if($item->children->count() > 0) dropdown-toggle @endif" href="@if($item->is_internal == 1){{ route($item->url) }}@else{{ $item->url }}@endif" id="{{ $item->name }}" @if($item->children->count() > 0) role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" @endif>{{ $item->name }}</a>
    @endrole
    @else
    <a class="nav-link @if($item->children->count() > 0) dropdown-toggle @endif" href="@if($item->is_internal == 1){{ route($item->url) }}@else{{ $item->url }}@endif" id="{{ $item->name }}" @if($item->children->count() > 0) role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" @endif @if($item->name == 'Logout') onclick="event.preventDefault(); document.getElementById('logout-form').submit();" @else @endif>@if($item->name == 'Account Menu'){{ head(explode(' ', trim(Auth::user()->name))) }} <img src="{{ Auth::user()->profile->getProfileAvatar() }}" class="rounded-circle"  style="width: 20px;"> @else @action('menu.nameBefore', $item){{ $item->name }}@action('menu.nameAfter', $item)@endif</a>
    @endif
    @if($item->name == 'Logout')
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
    @endif    
    @if($item->children->count() > 0)
    <ul class="dropdown-menu" aria-labelledby="{{ $item->name }}">
        @foreach($item->children->sortBy('order') as $childItem)
        @if($item->name == 'Admin')
        @role('admin')
        <li><a class="dropdown-item" href="@if($childItem->is_internal == 1){{ route($childItem->url) }}@else{{ $childItem->url }}@endif">{{ $childItem->name }}</a></li>
        @endrole
        @else
        <li><a class="dropdown-item" href="@if($childItem->is_internal == 1){{ route($childItem->url) }}@else{{ $childItem->url }}@endif" @if($childItem->name == 'Logout') onclick="event.preventDefault(); document.getElementById('logout-form').submit();" @else @endif>@if($childItem->name == 'Account Menu'){{ head(explode(' ', trim(Auth::user()->name))) }} <img src="{{ Auth::user()->profile->getProfileAvatar() }}" class="rounded-circle"  style="width: 20px;"> @else @action('submenu.nameBefore', $childItem){{ $childItem->name }}@action('submenu.nameAfter', $childItem)@endif</a></li>
        @endif
        @if($childItem->name == 'Logout')
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
        @endif
        @endforeach
    </ul>
    @endif
</li>
@endif
@endforeach