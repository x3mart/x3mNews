@extends('layouts.app')

@section('basicMenu')
    @include('header.menu.basicMenu')
@endsection

@section('menuItems')
    @include('header.menu.adminMenuItems')
@endsection

@section('content')
<main class="container mx-auto">
    <h3 class="text-center">Добавить свежую новость</h3>
    @if (session('success') || session('error'))
    <div class="alert {{ session('success') ? 'alert-success' : 'alert-danger' }} alert-dismissible fade show" role="alert">
        <strong>{{ session('success') ?? session('error')}}</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif
    <form enctype="multipart/form-data" action="{{ route('admin.addNews') }}" method="post">
        @csrf
        <div class="form-group">
            <div class="form-group">
                <label for="title">Название новости</label>
                <input type="text" class="form-control {{ (is_null(old('title')) && session('error')) ? 'alert-danger' : '' }}"
                       id="title" name="title" value="{{ old('title') }}" placeholder="Придумай крутое название для своей новости">
            </div>
            <label for="category">Категории новостей</label>
            <select  class="form-control {{ (is_null(old('category')) && session('error')) ? 'alert-danger' : '' }}"
                     id="category" name="category">
                <option disabled  selected>Выбери категорию новостей</option>
                @forelse($categories as $category)
                <option @if ($category->category_id == old('category')) selected @endif value="{{ $category->category_id }}">
                    {{ $category->category_name }}
                </option>
                    @empty
                    <option disabled>Нет категорий</option>
                @endforelse
            </select>
        </div>
        <div class="form-group">
            <label for="short">Описание новости</label>
            <textarea class="form-control {{ (is_null(old('short')) && session('error')) ? 'alert-danger' : '' }}"
                      id="short" name="short" rows="3" placeholder="Манящее краткое описание вашей новости. Что бы
                      хотелось ее прочесть!!!"> {{ old('short') }}
            </textarea>
        </div>
        <div class="form-group">
            <label for="inform">Полный текст новости</label>
            <textarea class="form-control {{ (is_null(old('inform')) && session('error')) ? 'alert-danger' : '' }}"
                      id="inform" name="inform" rows="10" placeholder="Подробный текст"> {{ old('inform') }}
            </textarea>
        </div>
        <div class="form-group">
            <input type="file" class="{{session('error') ? 'alert-danger' : ''}}" id="image" name="image">
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" value="1" id="private" name="private"
                   @if (old('private') == 1) checked @endif>
            <label class="form-check-label" for="private">
                Только для зарегистрированных
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" value="1" id="important" name="important"
                   @if (old('important') == 1) checked @endif>
            <label class="form-check-label" for="important">
                Главная новость
            </label>
        </div>
        <div class="form-group mt-3">
            <div class="col-sm-10">
                <button type="submit" class="btn btn-primary">Создать</button>
            </div>
        </div>
    </form>
</main>
@endsection
