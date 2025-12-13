<div>
    <ul class="dropdown-menu megamenu-content" role="menu">
        <li>
            <div class="row">
                @foreach ($menus as $menu)
                    <div class="col-menu col-md-3">
                        <h6 class="title"><a href="{{ $menu->url }}">{{ $menu->title }}</a></h6>

                        <div class="content">
                            <ul class="menu-col">
                                @foreach ($menu->childrenMenus->where('is_show', 1) as $child)
                                    <li><a href="{{ $child->url }}">{{ $child->title }}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endforeach
            </div>
        </li>
    </ul>
</div>
