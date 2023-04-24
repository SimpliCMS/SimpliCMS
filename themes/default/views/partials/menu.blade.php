@foreach($menu->items as $item)
@if($item->parent_id === null)
<li class="nav-item dropdown">
    @if($item->children->count() > 0)
    @if($item->is_internal == 1)
    <a class="nav-link dropdown-toggle" href="{{ route($item->url) }}" id="{{ $item->name }}" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ $item->name }}</a>
    @else 
    <a class="nav-link dropdown-toggle" href="{{ $item->url }}" id="{{ $item->name }}" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ $item->name }}</a>
    @endif
    @else
    @if($item->is_internal == 1)
    <a class="nav-link" href="{{ route($item->url) }}">{{ $item->name }}</a>
    @else
    <a class="nav-link" href="{{ $item->url }}">{{ $item->name }}</a>
    @endif
    @endif
    @if($item->children->count() > 0)
    <ul class="dropdown-menu" aria-labelledby="{{ $item->name }}">

        @foreach($item->children as $childItem)
        @if($childItem->is_internal == 1) 
        <li><a class="dropdown-item" href="{{ route($childItem->url) }}">{{ $childItem->name }}</a></li>
        @else
        <li><a class="dropdown-item" href="{{ $childItem->url }}">{{ $childItem->name }}</a></li>
        @endif
        @endforeach

    </ul>
    @endif

</li>
@endif
@endforeach
