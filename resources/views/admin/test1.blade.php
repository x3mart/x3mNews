@extends('layouts.app')

@section('basicMenu')
    @include('header.menu.basicMenu')
@endsection

@section('menuItems')
    @include('header.menu.adminMenuItems')
@endsection

@section('content')
    <main class="container mx-auto align-content-center">
        <h3 class="text-center">Тест 1</h3>
        @foreach($test as $t)
            {{ $t->category->category_name }} {{ $t->news_views }}<br>
        @endforeach
    </main>
@endsection
