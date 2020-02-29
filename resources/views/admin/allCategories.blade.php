@extends('layouts.app')

@section('basicMenu')
    @include('header.menu.basicMenu')
@endsection

@section('menuItems')
    @include('header.menu.adminMenuItems')
@endsection

@section('content')
    <h1 class="text-center mt-lg-3">Разделы новостей</h1>
    @if (session('success') || session('error'))
        <div class="alert {{ session('success') ? 'alert-success' : 'alert-danger' }} alert-dismissible fade show text-center" role="alert">
            <strong>{{ session('success') ?? session('error')}}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <a href="{{ route('admin.addCategory') }}" class="btn btn-success w-50 mx-auto d-block mt-lg-5">
        Добавить категорию
    </a>
    <main class="container row mx-auto mt-lg-5 mt-md-3 justify-content-around">
        @foreach($categories as $category)
            <div class="card mb-5" style="width: 18rem;">
                <img src="{{ $category->category_image ?? asset('imgs/1.svg') }}" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">{{ $category->category_name }}</h5>
                    <p class="card-text">{{ $category->category_description }}</p>
                    <div>
                        <a href="{{ route('admin.deleteCategory', $category) }}" class="btn btn-danger mr-3">
                            Удалить
                        </a>
                        <a href="{{ route('admin.updateCategory', $category) }}" class="btn btn-warning">
                            Редактировать
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </main>
@endsection
