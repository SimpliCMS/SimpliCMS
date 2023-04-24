@foreach(Menu::get($menuName)->items as $item)
<li @lm_attrs($item) @if($item->hasChildren()) class="nav-item dropdown" @endif @lm_endattrs>
    @if($item->link) <a @lm_attrs($item->link) @if($item->hasChildren()) class="nav-link dropdown-toggle" role="button" @data_toggle_attribute="dropdown" aria-haspopup="true" aria-expanded="false" @else class="nav-link" @endif @lm_endattrs href="{!! $item->url() !!}">
        {!! $item->title !!}
        @if($item->hasChildren()) <b class="caret"></b> @endif
    </a>
    @else
    <span class="navbar-text">{!! $item->title !!}</span>
    @endif
    @if($item->hasChildren())
    <ul class="dropdown-menu">
        @include('partials.bootstrap-menu', ['items' => $item->children()])

    </ul>
    @endif
</li>
@endforeach
