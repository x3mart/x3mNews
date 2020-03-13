<ul class="navbar-nav mr-auto">
    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('home')?'active':'' }}" href="{{ route('home') }}">
            Главная
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('news.*')?'active':'' }}" href="{{ route('news.categories') }}">
            Новости
        </a>
    </li>
    @if (isset(Auth::user()->is_admin) && Auth::user()->is_admin == true)
    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('admin.*')?'active':'' }}" href="{{ route('admin.admin') }}">
            Admin
        </a>
    </li>
    @endif
</ul>


