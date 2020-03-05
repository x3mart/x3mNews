@extends('layouts.app')

@section('basicMenu')
    @include('header.menu.basicMenu')
@endsection

@section('menuItems')
    @include('header.menu.adminMenuItems')
@endsection

@section('content')
<main class="container mx-auto">
    <h3 class="text-center">{{ isset($news->id) ? 'Редактировать новость' : 'Добавить свежую новость' }}</h3>
    <img class="w-25 d-block my-3 mx-auto" src="{{ isset($news->news_image) ? $news->news_image : asset('imgs/1.svg') }}" alt="">
    @if (session('success') || session('error'))
    <div class="alert {{ session('success') ? 'alert-success' : 'alert-danger' }} alert-dismissible fade show" role="alert">
        <strong>{{ session('success') ?? session('error')}}</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif
    <form enctype="multipart/form-data" action="{{ isset($news->id) ? route( 'admin.saveNews', $news) : route('admin.addNews') }}" method="post">
        @csrf
        <div class="form-group">
            <div class="form-group">
                <label for="news_title">Название новости</label>
                @if ($errors->has('news_title'))
                    <div class="alert alert-warning" role="alert">
                        @foreach ($errors->get('news_title') as $err)
                            {{ $err.' '}}
                        @endforeach
                    </div>
                @endif
                <input type="text" class="form-control {{ $errors->get('news_title') ? 'alert-danger' : '' }}"
                       id="news_title" name="news_title"
                       value="@if(isset($news) && !$errors->get('news_title')){{ $news->news_title }}@elseif(old('news_title')){{ old('news_title') }}@endif"
                       placeholder="Придумай крутое название для своей новости">
            </div>
            <label for="category">Категории новостей</label>
            @if ($errors->has('news_category'))
                <div class="alert alert-warning" role="alert">
                    @foreach ($errors->get('news_category') as $err)
                        {{ $err.' '}}
                    @endforeach
                </div>
            @endif
            <select  class="form-control {{ $errors->has('news_category') ? 'alert-danger' : '' }}"
                     id="category" name="news_category">
                <option disabled  selected>Выбери категорию новостей</option>
                @forelse($categories as $category)
                <option
                    @if ($category->id == old('news_category')) selected @endif
                    @if (isset($news) && !$errors->has('news_category'))
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
            @if ($errors->has('news_short'))
                <div class="alert alert-warning" role="alert">
                    @foreach ($errors->get('news_short') as $err)
                        {{ $err.' '}}
                    @endforeach
                </div>
            @endif
            <textarea class="form-control {{ $errors->has('news_short') ? 'alert-danger' : '' }}"
                      id="short" name="news_short" rows="3"
                      placeholder="Манящее, краткое описание вашей новости.">{{ (isset($news) && !$errors->has('news_short')) ? $news->news_short : old('news_short') }}
            </textarea>
        </div>
        <div class="form-group">
            <label for="inform">Полный текст новости</label>
            @if ($errors->has('news_inform'))
                <div class="alert alert-warning" role="alert">
                    @foreach ($errors->get('news_inform') as $err)
                        {{ $err.' '}}
                    @endforeach
                </div>
            @endif
            <textarea class="form-control {{ $errors->has('news_inform') ? 'alert-danger' : '' }}"
                      id="inform" name="news_inform" rows="5" placeholder="Подробный текст">{{ (isset($news) && !$errors->has('news_inform')) ? $news->news_inform : old('news_inform') }}
            </textarea>
        </div>
        @if ($errors->has('news_image'))
                <div class="alert alert-warning" role="alert">
                    @foreach ($errors->get('news_image') as $err)
                        {{ $err.' '}}
                    @endforeach
                </div>
            @endif
        <div class="form-group {{ $errors->has('news_image') ? 'alert-danger' : '' }} ">
            <input type="file" class="" id="image" name="news_image">
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" value="1" id="private" name="news_private"
            @if(isset($news->news_private) && $news->news_private == 1 &&!old('category_private')) checked @endif
            @if(old('news_private') == 1)checked @endif>
            <label class="form-check-label" for="private">
                Только для зарегистрированных
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" value="1" id="important" name="news_important"
            @if(isset($news->news_important) && $news->news_important == 1 &&!old('category_important')) checked @endif
            @if(old('news_important') == 1)checked @endif>
            <label class="form-check-label" for="important">
                Главная новость
            </label>
        </div>
        <div class="form-group mt-3">
            <div class="col-sm-10">
                <button type="submit" id="save" class="btn btn-primary">@if(isset($news->id))Сохранить @else Создать @endif</button>
            </div>
        </div>
    </form>
</main>
@endsection
