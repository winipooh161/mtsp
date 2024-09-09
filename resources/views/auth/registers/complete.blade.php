@extends('auth.layouts.app')
@section('content')
    <div class="container">
        <div class="form__auth register">
                  <h1 class="tt">Регистрация</h1>
                <form method="POST" action="{{ route('register.finalize') }}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}">
                    <input type="hidden" name="email" value="{{ $email }}">
                    <div class="block__reg__liders">
                        <div class="input__reg">
                            <div class="name__user__mail">
                                <div class="name__user__mail__input">
                                    <p>{{ __('Имя') }}</p>
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                        name="name" value="{{ old('name') }}" placeholder="Введите имя" maxlength="50"
                                        required autocomplete="name" autofocus>
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="name__user__mail__input">
                                    <p>{{ __('Фамилия') }}</p>
                                    <input id="surname" type="text"
                                        class="form-control @error('surname') is-invalid @enderror" name="surname"
                                        value="{{ old('surname') }}" placeholder="Введите фамилию" maxlength="50" required
                                        autocomplete="surname">
                                    @error('surname')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="name__user__mail__input">
                                    <p>{{ __('Отчество') }}</p>
                                    <input id="patronymic" type="text"
                                        class="form-control @error('patronymic') is-invalid @enderror" name="patronymic"
                                        value="{{ old('patronymic') }}" placeholder="Введите отчество " maxlength="50" required
                                        autocomplete="patronymic">
                                    @error('patronymic')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="avatar__image">
                            <p>{{ __('Фото профиля') }}</p>
                            <div class="avatar__register">
                                <input type="file" name="avatar" id="avatar"
                                    class="form-control custom-cursor-default-hover" style="display:none;" accept="image/*">
                                <label for="avatar" class="custom-file-upload avatar-preview" id="avatar-preview">
                                    <!-- Изначально пусто, фон будет задан через CSS -->
                                </label>
                            </div>
                            <p id="avatar-error" style=" ">{{ __('Пожалуйста, загрузите ваше реальное фото для аутентификации личности') }}</p>
                        </div>
                    </div>
                    <script>
                        document.getElementById('avatar').addEventListener('change', function(event) {
                            const file = event.target.files[0];
                            if (file) {
                                const reader = new FileReader();
                                reader.onload = function(e) {
                                    document.getElementById('avatar-preview').style.backgroundImage = 'url(' + e.target.result +
                                        ')';
                                }
                                reader.readAsDataURL(file);
                            }
                        });
                    </script>
                    <div class="password__name">
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
                      
                            <div class="wd100">
                                <p>{{ __('Telegram') }}</p>
                                <input id="telegram" type="text"
                                    class="form-control maskTg @error('telegram') is-invalid @enderror" name="telegram"
                                    value="{{ old('telegram') }}" placeholder="Введите @Telegram" maxlength="50" required
                                    autocomplete="telegram">
                                @error('telegram')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            
                        <!-- Поле для ввода пароля с глазом -->
                        <div class="password-container">
                            <p>{{ __('Пароль') }}</p>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                                name="password" maxlength="50" required placeholder="Введите пароль"
                                autocomplete="new-password">
                            <span id="togglePassword" class="password-toggle">
                                <svg id="eye-open" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="feather feather-eye" viewBox="0 0 24 24">
                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                    <circle cx="12" cy="12" r="3"></circle>
                                </svg>
                                <svg id="eye-closed" style="display:none;" xmlns="http://www.w3.org/2000/svg" width="24"
                                    height="24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="feather feather-eye-off" viewBox="0 0 24 24">
                                    <path
                                        d="M17.94 17.94a10.45 10.45 0 0 1-5.94 1.94c-7 0-11-8-11-8a19.86 19.86 0 0 1 2.66-3.42">
                                    </path>
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
                        <!-- Поле для подтверждения пароля с глазом -->
                        <div class="password-container">
                            <p>{{ __('Подтверждение пароля') }}</p>
                            <input id="password-confirm" type="password" placeholder="Повторите пароль" class="form-control"
                                name="password_confirmation" maxlength="50" required autocomplete="new-password">
                            <span id="togglePasswordConfirm" class="password-toggle">
                                <svg id="eye-open-confirm" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="feather feather-eye" viewBox="0 0 24 24">
                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                    <circle cx="12" cy="12" r="3"></circle>
                                </svg>
                                <svg id="eye-closed-confirm" style="display:none;" xmlns="http://www.w3.org/2000/svg"
                                    width="24" height="24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye-off"
                                    viewBox="0 0 24 24">
                                    <path
                                        d="M17.94 17.94a10.45 10.45 0 0 1-5.94 1.94c-7 0-11-8-11-8a19.86 19.86 0 0 1 2.66-3.42">
                                    </path>
                                    <path d="M1 1l22 22"></path>
                                    <path d="M9.88 9.88a3 3 0 1 0 4.24 4.24"></path>
                                </svg>
                            </span>
                        </div>
                    </div>
                   

                    <div class="password__name button__container flex center">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Зарегистрироваться') }}
                        </button>
                        <a href="{{ url('login') }}">
                            {{ __('Войти') }}
                        </a>
                    </div>
                </form>
      
        </div>
    </div>

@endsection
