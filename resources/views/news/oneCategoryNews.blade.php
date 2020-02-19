@extends('layouts.app')

@section('menuItems')
    @each('header.menu.menuItems', $categories, 'item')
@endsection

@section('main')
    <h1 class="mt-lg-5 mt-md-3 text-center">Новости раздела {{$category['cat_name']}}</h1>
    <main class="container row mx-auto mt-lg-5 mt-md-3 justify-content-around">
        @foreach($news as $oneNews)
            <div class="card mb-5" style="width: 18rem;">
                <img src="{{asset('imgs/1.svg')}}" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">{{$oneNews['title']}}</h5>
                    <p class="card-text">{{$oneNews['short']}}</p>
                    <a href="{{route('news.oneNews', ['cat_alias'=>$category['cat_alias'], 'id'=>$oneNews['id']])}}"
                       class="btn btn-primary">Подробнее -></a>
                </div>
            </div>
        @endforeach
    </main>
@endsection
