<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        @foreach ($menus as $menu)
            @if (is_null($menu->parent_id))
                <li class="nav-item">
                    <a class="nav-link" @if($menus->where('parent_id', $menu->id)->isNotEmpty()) data-bs-toggle="collapse" href="#menu-{{ $menu->id }}" aria-expanded="false" aria-controls="menu-{{ $menu->id }}" @else href="{{ url($menu->url) }}" @endif>
                        @if ($menu->icon)
                            <i class="menu-icon {{ $menu->icon }}"></i>
                        @endif
                        <span class="menu-title">{{ $menu->name }}</span>
                        @if($menus->where('parent_id', $menu->id)->isNotEmpty())
                            <i class="menu-arrow"></i>
                        @endif
                    </a>
                    @if($menus->where('parent_id', $menu->id)->isNotEmpty())
                        <div class="collapse" id="menu-{{ $menu->id }}">
                            <ul class="nav flex-column sub-menu">
                                @foreach ($menus->where('parent_id', $menu->id) as $child)
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ url($child->url) }}">
                                            @if ($child->icon)
                                                <i class="menu-icon {{ $child->icon }}"></i>
                                            @endif
                                            {{ $child->name }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </li>
            @endif
        @endforeach
    </ul>
</nav>
