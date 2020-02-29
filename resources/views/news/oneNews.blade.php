@extends('layouts.app')

@section('basicMenu')
    @include('header.menu.basicMenu')
@endsection

@section('menuItems')
    @each('header.menu.menuItems', $categories, 'item')
@endsection

@section('content')
    <main class="container mx-auto">
        <a href="{{ route('news.oneCategoryNews', $news->category->category_alias) }}" class="text-decoration-none text-muted">
            <h1 class="text-center">{{ $news->category->category_name }}</h1>
        </a>
        <div class="text-center">
            <img style="max-width: 70%" src="{{ $news->news_image ?? asset('imgs/1.svg') }}" class="rounded" alt="...">
        </div>
        <h3 class="text-center mt-lg-3">{{ $news->news_title }}</h3>
        <p class="text-muted">
            {{ $news->news_inform }}
        </p>
    </main>
@endsection

