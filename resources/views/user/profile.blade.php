@extends('layouts.app')

@section('basicMenu')
    @include('header.menu.basicMenu')
@endsection


@section('content')
<div class="container">
    <h1 class="text-center">Изменение данных пользователя</h1>
    @if (session('success'))
            <div class="text-center alert {{ session('success') ? 'alert-success' : '' }} alert-dismissible fade show" role="alert">
                <strong>{{ session('success') }}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
    <div class="row justify-content-center my-3">
        <div class="col-md-5" card>
        <form method="post" action="{{ route('user.updateProfile') }}">
                @csrf
                <div class="form-group">
                    <label for="name">Имя пользователя</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror " id="name" value="{{ old('name') ?? Auth::user()->name }}" aria-describedby="nameHelp" name="name">
                    <small id="nameHelp" class="form-text text-muted">Имя должно быть уникальным</small>
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="email">Email address</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') ?? Auth::user()->email }}" id="email" aria-describedby="emailHelp" name="email">
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <small id="emailHelp" class="form-text text-muted">Мы о нем никому не раскажем.</small>
                </div>
                <div class="form-group">
                    <label for="curent_password">Текущий Пароль</label>
                    <input type="password" class="form-control @error('curent_password') is-invalid @enderror" id="curent_password" name="curent_password">
                    @error('curent_password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="password">Новый Пароль</label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password">
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="password_confirm">Новый Пароль еще разок</label>
                    <input type="password" class="form-control @error('password_confirm') is-invalid @enderror" id="password_confirm" name="password_confirm">
                    @error('password_confirm')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>

@endsection
