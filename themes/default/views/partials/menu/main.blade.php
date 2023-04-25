@foreach($menu->items as $item)
@if($item->parent_id === null)
<li class="nav-item @if($item->children->count() > 0) dropdown @endif">
    @if($item->name == 'Admin')
    @role('admin')
    <a class="nav-link @if($item->children->count() > 0) dropdown-toggle @endif" href="@if($item->is_internal == 1){{ route($item->url) }}@else{{ $item->url }}@endif" id="{{ $item->name }}" @if($item->children->count() > 0) role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" @endif>{{ $item->name }}</a>
    @endrole
    @else
    <a class="nav-link @if($item->children->count() > 0) dropdown-toggle @endif" href="@if($item->is_internal == 1){{ route($item->url) }}@else{{ $item->url }}@endif" id="{{ $item->name }}" @if($item->children->count() > 0) role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" @endif @if($item->name == 'Logout') onclick="event.preventDefault(); document.getElementById('logout-form').submit();" @else @endif>@if($item->name == 'Account Menu'){{ Auth::user()->name }} <img src="{{ avatar_image_url(Auth::user(), 20) }}" class="rounded-circle"> @elseif($item->name == 'Cart'){{$item->name }}@if(Cart::isNotEmpty())<span class="badge badge-pill badge-secondary">{{ Cart::itemCount() }}</span> @endif @else{{ $item->name }}@endif</a>
    @endif
    @if($item->name == 'Logout')
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
    @endif    
    @if($item->children->count() > 0)
    <ul class="dropdown-menu" aria-labelledby="{{ $item->name }}">
        @foreach($item->children as $childItem)
        @if($item->name == 'Admin')
        @role('admin')
        <li><a class="dropdown-item" href="@if($childItem->is_internal == 1){{ route($childItem->url) }}@else{{ $childItem->url }}@endif">{{ $childItem->name }}</a></li>
        @endrole
        @else
        <li><a class="dropdown-item" href="@if($childItem->is_internal == 1){{ route($childItem->url) }}@else{{ $childItem->url }}@endif" @if($childItem->name == 'Logout') onclick="event.preventDefault(); document.getElementById('logout-form').submit();" @else @endif>@if($childItem->name == 'Account Menu'){{ Auth::user()->name }} <img src="{{ avatar_image_url(Auth::user(), 20) }}" class="rounded-circle"> @elseif($childItem->name == 'Cart'){{$childItem->name }}@if(Cart::isNotEmpty())<span class="badge badge-pill badge-secondary">{{ Cart::itemCount() }}</span> @endif @else{{ $childItem->name }}@endif</a></li>
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