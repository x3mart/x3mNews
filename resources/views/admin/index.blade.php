@extends('layouts.app')

@section('basicMenu')
    @include('header.menu.basicMenu')
@endsection

@section('menuItems')
    @include('header.menu.adminMenuItems')
@endsection

@section('content')
    <<h1 class="my-lg-2 text-center text-primary font-weight-bolder">x3mNews</h1>
    <h3 class="text-center text-muted">Привет Админ</h3>
    @if (session('success') || session('error'))
        <div class="alert {{ session('success') ? 'alert-success' : 'alert-danger' }} alert-dismissible fade show text-center" role="alert">
            <strong>{{ session('success') ?? session('error')}}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <main class="container row mx-auto mt-lg-5 mt-md-3 justify-content-around">
        @foreach($news as $item)
            <div class="card my-3 w-100">
                <div class="card-body px-5 py-1 row align-items-center">
                    <img class="mr-3" style="height: 80px" src="{{ $item->news_image ?? asset('imgs/1.svg') }}" alt="">
                    <div class="h5 mr-auto">{{ $item->news_title }}</div>
                    <a href="{{ route('admin.deleteNews', $item) }}">
                        <button type="button" class="btn btn-danger mx-3 h-25 align-middle">Удалить</button>
                    </a>
                    <a href="{{ route('admin.updateNews', $item) }}">
                        <button type="button" class="btn btn-warning h-25">Редактировать</button>
                    </a>
                </div>
            </div>
        @endforeach
    </main>
    <div class="container mx-auto my-lg-3">
        {{ $news->links() }}
    </div>
@endsection


