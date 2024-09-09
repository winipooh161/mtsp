@extends('auth.layouts.app')

@section('content')
    <div class="container">
        <div class="form__auth email">
            <h1 class="tt">Создание аккаунта</h1>
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @else
                <p class="form__auth__title_P">Мы направим ссылку для создания аккаунта</p>
            @endif
        
            <form method="POST" action="{{ route('register.email') }}">
                @csrf
                <div class="form-group">
                    <label for="email">{{ __('Укажите почту для регистрации') }}</label>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                        name="email" placeholder="Введите почту" value="{{ old('email') }}" maxlength="70" required autofocus>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="password__name button__container flex center full__button">
                    <button type="submit" class="btn btn-primary">
                        {{ __('Продолжить') }}
                    </button>
                    <a href="{{ url('login') }}">
                        {{ __('Назад') }}
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection
