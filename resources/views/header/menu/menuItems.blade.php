
            <li class="nav-item">
                <a class="nav-link {{ request()->is('*/'.$item->category_alias.'*')?'font-weight-bolder':'' }}"
                   href="{{ route('news.oneCategoryNews', $item->category_alias) }}">
                    {{ $item->category_name }}
                </a>
            </li>


