
<li class="nav-item">
    <a class="nav-link {{ request()->routeIs('admin.addNews')? 'font-weight-bolder' : '' }}" href="{{route('admin.addNews')}}">
        Добавить новость
    </a>
</li>
<li class="nav-item">
    <a class="nav-link {{ request()->routeIs('admin.allCategories')? 'font-weight-bolder' : '' }}" href="{{route('admin.allCategories')}}">
        Редактировать разделы
    </a>
</li>
<li class="nav-item">
    <a class="nav-link {{ request()->routeIs('admin.updateUsers')? 'font-weight-bolder' : '' }}" href="{{route('admin.updateUsers')}}">
        Редактировать Админов
    </a>
</li>
<li class="nav-item">
    <a class="nav-link {{ request()->routeIs('admin.test2')? 'font-weight-bolder' : '' }}" href="{{route('admin.test2')}}">
        Test2
    </a>
</li>
