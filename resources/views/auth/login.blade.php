@extends('auth.layouts.app')

@section('content')
    <div class="container register__fon">
        <div class="form__auth login">
            <h1 class="tt">Вход</h1>
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="name__user__mail__input">
                    <p>{{ __('Корпоративная почта') }}</p>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                        name="email" value="{{ old('email') }}" placeholder="Введите почту" required maxlength="70"
                        autocomplete="email">
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="password-container">
                    <p>{{ __('Пароль') }}</p>
                    <input id="password" type="password"
                        class="form-control @error('password') is-invalid @enderror" name="password" maxlength="50"
                        required placeholder="Введите пароль" autocomplete="new-password">
                    <span id="togglePassword" class="password-toggle">
                        <svg id="eye-open" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="feather feather-eye" viewBox="0 0 24 24">
                            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                            <circle cx="12" cy="12" r="3"></circle>
                        </svg>

                        <svg id="eye-closed" style="display:none;" xmlns="http://www.w3.org/2000/svg" width="24"
                            height="24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="feather feather-eye-off" viewBox="0 0 24 24">
                            <path d="M17.94 17.94a10.45 10.45 0 0 1-5.94 1.94c-7 0-11-8-11-8a19.86 19.86 0 0 1 2.66-3.42"></path>
                            <path d="M1 1l22 22"></path>
                            <path d="M9.88 9.88a3 3 0 1 0 4.24 4.24"></path>
                        </svg>
                    </span>
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="password__name button__container flex center">
                    <button type="submit" class="btn btn-primary">
                        {{ __('Войти') }}
                    </button>
                   
                    <a href="{{ route('register.request') }}">
                        {{ __('Зарегистрироваться') }}
                    </a>
                </div>
                <div class="password__name button__container flex center">
                    <a class="btn btn-link" href="{{ route('password.request') }}">
                        {{ __('Забыли пароль?') }}
                    </a>
                </div>
            </form>
        </div>
    </div>

    
@endsection
