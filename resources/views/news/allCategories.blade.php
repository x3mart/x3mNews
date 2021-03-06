@extends('layouts.app')

@section('basicMenu')
    @include('header.menu.basicMenu')
@endsection

@section('menuItems')
    @each('header.menu.menuItems', $categories, 'item')
@endsection

@section('content')
    <h1 class="text-center mt-lg-3">Разделы новостей</h1>
    <main class="container row mx-auto mt-lg-5 mt-md-3 justify-content-around">
        @foreach($categories as $category)
            <div class="card mb-5" style="width: 18rem;">
                <img src="{{ $category->category_image ?? asset('imgs/1.svg') }}" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">{{ $category->category_name }}</h5>
                    <p class="card-text">{{ $category->category_description }}</p>
                    <a href="{{ route('news.oneCategoryNews', $category->category_alias) }}" class="btn btn-primary">
                        В раздел ->
                    </a>
                </div>
            </div>
        @endforeach
    </main>
@endsection
