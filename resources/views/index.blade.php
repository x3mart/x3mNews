@extends('layouts.main')

@section('menuItems')
   @each('header.menu.menuItems', $categories, 'item')
@endsection

@section('content')
    <div class="mx-auto mt-5 col-lg-4 jumbotron text-center">
        <h1 class="text-primary">x3mNews</h1>
        <p>Все о чем вы не знали<br> и <br>знать не хотели!!</p>
        <p><a class="btn btn-primary btn-lg" href="{{route('news.categories')}}" role="button">категории</a></p>
    </div>
@endsection

