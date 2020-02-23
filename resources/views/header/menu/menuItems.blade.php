
            <li class="nav-item">
                <a class="nav-link {{ request()->is('*/'.$item['cat_alias'].'*')?'font-weight-bolder':'' }}" href="{{route('news.oneCategoryNews', $item['cat_alias'])}}">
                    {{$item['cat_name']}}
                </a>
            </li>


