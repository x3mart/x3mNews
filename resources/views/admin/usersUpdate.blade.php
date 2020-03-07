@extends('layouts.app')

@section('basicMenu')
    @include('header.menu.basicMenu')
@endsection

@section('menuItems')
    @include('header.menu.adminMenuItems')
@endsection


@section('content')
    <<h1 class="my-lg-2 text-center text-primary font-weight-bolder">{{ Auth::user()->name }}</h1>
    <h3 class="text-center text-muted">Назначаем пользователей админами</h3>
    @if (session('success') || session('error'))
        <div class="alert {{ session('success') ? 'alert-success' : 'alert-danger' }} alert-dismissible fade show text-center" role="alert">
            <strong>{{ session('success') ?? session('error')}}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <main class="container row mx-auto mt-lg-5 mt-md-3">
        <form method="post" action="{{ route('admin.updateUsers') }}" class="w-100">
            @csrf
        @foreach($users as $item)
            <div class="card my-3 w-100">
                <div class="card-body px-5 py-1 row align-items-center">
                    <div class="h5 mr-auto">{{ $item->name }}</div>
                    <div class="h5 mr-auto">{{ $item->email }}</div>
                    <div class="form-group form-check row">
                    <input type="checkbox" {{ $item->is_admin ? 'checked' : '' }} class="form-check-input" id="is_admin" name="{{$item->id}}">
                    <label class="form-check-label" for="is_admin">Admin</label>
                  </div>
                </div>
            </div>
        @endforeach
        <button type="submit" class="btn btn-primary d-block mx-auto w-25">Обновить</button>
        </form>
    </main>
@endsection
