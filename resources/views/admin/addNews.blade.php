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

    <form action="{{ route('admin.addNews') }}" method="post">
        @csrf
        <div class="form-group">
            <div class="form-group">
                <label for="title">Название новости</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}" placeholder="Придумай крутое название для своей новости">
            </div>
            <label for="category">Категории новостей</label>
            <select  class="form-control" id="category" name="category">
                <option disabled  selected>Выбери категорию новостей</option>
                @forelse($categories as $category)
                <option @if ($category['cat_id'] == old('category')) selected @endif value="{{ $category['cat_id'] }}">{{ $category['cat_name'] }}</option>
                    @empty
                    <option disabled>Нет категорий</option>
                @endforelse
            </select>
        </div>
        <div class="form-group">
            <label for="short">Описание новости</label>
            <textarea class="form-control" id="short" name="short" rows="3" placeholder="Манящее краткое описание вашей новости. Что бы хотелось ее прочесть!!!">
                {{ old('short') }}
            </textarea>
        </div>
        <div class="form-group">
            <label for="inform">Полный текст новости</label>
            <textarea class="form-control" id="inform" name="inform" rows="10" placeholder="Подробный текст">
                {{ old('inform') }}
            </textarea>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" value="true" id="private" name="private">
            <label class="form-check-label" for="private">
                Только для зарегистрированных
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
