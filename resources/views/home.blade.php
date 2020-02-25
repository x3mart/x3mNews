@extends('layouts.app')

{{--@dd($news)--}}

@section('basicMenu')
    @include('header.menu.basicMenu')
@endsection

@section('content')
   <h1 class="my-lg-2 text-center text-primary font-weight-bolder">x3mNews</h1>
   <h3 class="text-center text-muted">О самом важном, главном и не очень</h3>
   <h2 class="text-center">Главные новости</h2>
   <main class="container row mx-auto mt-lg-5 mt-md-3 justify-content-around">
       @foreach($news as $item)
           <div class="card mb-5" style="width: 18rem;">
               <img src="{{ $item->news_image ?? asset('imgs/1.svg') }}" class="card-img-top" alt="...">
               <div class="card-body">
                   <a href="{{ route('news.oneCategoryNews', $item->category_alias) }}"
                      class="text-primary">{{ $item->category_name }}</a>
                   <h5 class="card-title">{{ $item->news_title }}</h5>
                   <p class="card-text">{{ $item->news_short }}</p>
                   <a href="{{ route('news.oneNews', ['cat_alias'=>$item->category_alias, 'id'=>$item->news_id]) }}"
                      class="btn btn-primary">Подробнее -></a>
               </div>
           </div>
       @endforeach
   </main>
@endsection
