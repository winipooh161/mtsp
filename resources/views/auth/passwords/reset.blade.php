@extends('auth.layouts.app')

@section('content')
<div class="container register__fon">
      
    <div class="form__auth email">
        <h1 class="tt">Восстановление <br> пароля</h1>
        @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
        @else
        <p class="form__auth__title_P">Напишите новый пароль и подтвердите его</p>
    @endif
       
    
            <form method="POST" action="{{ route('password.update') }}">
                @csrf

                <!-- Hidden inputs for the token and email -->
                <input type="hidden" name="token" value="{{ $token }}">
                <input type="hidden" name="email" value="{{ $email }}">

                <!-- New password field -->
                <div class="form-group">
                    <label for="password">{{ __('Новый пароль') }}</label>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                        name="password" required>

                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <!-- Confirm new password field -->
                <div class="form-group">
                    <label for="password-confirm">{{ __('Подтвердите пароль') }}</label>
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                </div>

                <!-- Submit button -->
                <div class="password__name button__container flex center">
                    <button type="submit" class="btn btn-primary">
                        {{ __('Сменить пароль') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
