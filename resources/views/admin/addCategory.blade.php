@extends('layouts.app')

@section('basicMenu')
    @include('header.menu.basicMenu')
@endsection

@section('menuItems')
    @include('header.menu.adminMenuItems')
@endsection

@section('content')
    <main class="container mx-auto">
        <h3 class="text-center">@if(isset($category->id)) Редактировать Категорию @else Добавить новую категонию @endif</h3>
        <img class="w-25 d-block my-3 mx-auto" src="@if(isset($category->category_image)) {{ $category->category_image }} @else {{ asset('imgs/1.svg') }} @endif" alt="">
        @if (session('success') || session('error'))
            <div class="alert {{ session('success') ? 'alert-success' : 'alert-danger' }} alert-dismissible fade show" role="alert">
                <strong>{{ session('success') ?? session('error')}}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        <form enctype="multipart/form-data" action="@if (isset($category->id)) {{  route( 'admin.saveCategory', $category) }}
        @else {{ route('admin.addCategory') }}@endif" method="post">
            @csrf
            <div class="form-group">
                <div class="form-group">
                    <label for="name">Название категории</label>
                    <input type="text" class="form-control {{ (is_null(old('category_name')) && session('error')) ? 'alert-danger' : '' }}"
                           id="name" name="category_name" value="{{ $category->category_name ?? old('category_name') }}" placeholder="Придумай название для категории новостей">
                </div>
                <div class="form-group">
                    <label for="alias">Псевдоним категории</label>
                    <input type="text" class="form-control {{ (is_null(old('category_alias')) && session('error')) ? 'alert-danger' : '' }}"
                           id="name" name="category_alias" value="{{ $category->category_alias ?? old('category_alias') }}" placeholder="Придумай название на латинице">
                </div>

            </div>
            <div class="form-group">
                <label for="short">Описание категории</label>
                <textarea class="form-control {{ (is_null(old('category_description')) && session('error')) ? 'alert-danger' : '' }}"
                          id="short" name="category_description" rows="3"
                          placeholder="Манящее, краткое описание вашей новости.">{{ $category->category_description ?? old('category_description') }}
                </textarea>
            </div>
            <div class="form-group">
                <input type="file" class="" id="image" name="category_image">
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="1" id="private" name="news_private"
                       @if (old('category_private') == 1) checked @endif
                       @if(isset($category))
                       @if($category->category_private == 1) checked @endif
                    @endif>
                <label class="form-check-label" for="private">
                    Только для зарегистрированных
                </label>
            </div>

            <div class="form-group mt-3">
                <div class="col-sm-10">
                    <button type="submit" class="btn btn-primary">@if(isset($category->id))Сохранить @else Создать @endif</button>
                </div>
            </div>
        </form>
    </main>
@endsection

