@extends('layouts.app')

@section('basicMenu')
    @include('header.menu.basicMenu')
@endsection

@section('menuItems')
    @include('header.menu.adminMenuItems')
@endsection

@section('content')
    <main class="container mx-auto align-content-center">
        <h3 class="text-center">Тест 2</h3>
    </main>
@endsection
