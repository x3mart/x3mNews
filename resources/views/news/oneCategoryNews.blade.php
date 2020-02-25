@extends('layouts.app')

@section('basicMenu')
    @include('header.menu.basicMenu')
@endsection

@section('menuItems')
    @each('header.menu.menuItems', $categories, 'item')
@endsection

@section('content')
    <h1 class="mt-lg-5 mt-md-3 text-center">Новости раздела {{ $news[0]->category_name }}</h1>
    <main class="container row mx-auto mt-lg-5 mt-md-3 justify-content-around">
        @foreach($news as $item)
            <div class="card mb-5" style="width: 18rem;">
                <img src="{{ $item->news_image ?? asset('imgs/1.svg') }}" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">{{ $item->news_title }}</h5>
                    <p class="card-text">{{$item->news_short }}</p>
                    <a href="{{ route('news.oneNews', ['cat_alias'=>$item->category_alias, 'id'=>$item->news_id]) }}"
                       class="btn btn-primary">Подробнее -></a>
                </div>
            </div>
        @endforeach
    </main>
@endsection
