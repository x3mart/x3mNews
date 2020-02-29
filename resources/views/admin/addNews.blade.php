@extends('layouts.app')

@section('basicMenu')
    @include('header.menu.basicMenu')
@endsection

@section('menuItems')
    @include('header.menu.adminMenuItems')
@endsection

@section('content')
<main class="container mx-auto">
    <h3 class="text-center">@if(isset($news->id)) Редактировать новость @else Добавить свежую новость @endif</h3>
    <img class="w-25 d-block my-3 mx-auto" src="@if(isset($news->news_image)) {{ $news->news_image }} @else {{ asset('imgs/1.svg') }} @endif" alt="">
    @if (session('success') || session('error'))
    <div class="alert {{ session('success') ? 'alert-success' : 'alert-danger' }} alert-dismissible fade show" role="alert">
        <strong>{{ session('success') ?? session('error')}}</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif
    <form enctype="multipart/form-data" action="@if (isset($news->id)) {{  route( 'admin.saveNews', $news) }} @else {{ route('admin.addNews') }}@endif" method="post">
        @csrf
        <div class="form-group">
            <div class="form-group">
                <label for="title">Название новости</label>
                <input type="text" class="form-control {{ (is_null(old('news_title')) && session('error')) ? 'alert-danger' : '' }}"
                       id="title" name="news_title" value="{{ $news->news_title ?? old('news_title') }}" placeholder="Придумай крутое название для своей новости">
            </div>
            <label for="category">Категории новостей</label>
            <select  class="form-control {{ (is_null(old('news_category')) && session('error')) ? 'alert-danger' : '' }}"
                     id="category" name="news_category">
                <option disabled  selected>Выбери категорию новостей</option>
                @dump(old('news_category'))
                @forelse($categories as $category)
                <option
                    @if ($category->id == old('news_category')) selected @endif
                    @if (isset($news))
                        @if ($news->news_category == $category->id) selected @endif
                    @endif
                value="{{ $category->id }}">
                    {{ $category->category_name }}
                </option>
                    @empty
                    <option disabled>Нет категорий</option>
                @endforelse
            </select>
        </div>
        <div class="form-group">
            <label for="short">Описание новости</label>
            <textarea class="form-control {{ (is_null(old('news_short')) && session('error')) ? 'alert-danger' : '' }}"
                      id="short" name="news_short" rows="3"
                      placeholder="Манящее, краткое описание вашей новости.">{{ $news->news_short ?? old('news_short') }}
            </textarea>
        </div>
        <div class="form-group">
            <label for="inform">Полный текст новости</label>
            <textarea class="form-control {{ (is_null(old('news_inform')) && session('error')) ? 'alert-danger' : '' }}"
                      id="inform" name="news_inform" rows="10" placeholder="Подробный текст"> {{ $news->news_inform ?? old('news_inform') }}
            </textarea>
        </div>
        <div class="form-group">
            <input type="file" class="" id="image" name="news_image">
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" value="1" id="private" name="news_private"
                   @if (old('news_private') == 1) checked @endif
                   @if(isset($news))
                        @if($news->news_private == 1) checked @endif
                   @endif>
            <label class="form-check-label" for="private">
                Только для зарегистрированных
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" value="1" id="important" name="news_important"
                   @if (old('news_important') == 1) checked @endif
                   @if(isset($news))
                       @if($news->news_important == 1) checked @endif
                   @endif>
            <label class="form-check-label" for="important">
                Главная новость
            </label>
        </div>
        <div class="form-group mt-3">
            <div class="col-sm-10">
                <button type="submit" class="btn btn-primary">@if(isset($news->id))Сохранить @else Создать @endif</button>
            </div>
        </div>
    </form>
</main>
@endsection
