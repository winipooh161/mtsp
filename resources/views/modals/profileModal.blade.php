@section('profileModal')
    <div class="modal" id="profileModal" style="display: none;">
        <div class="modal__body">
            <div class="alert alert-danger" id="modal-errors" style="display: none;">
                <ul id="error-list"></ul>
            </div>
            <div class="abs__elements_profile">
                <img src="/assets/img/elements/СyberSport3.png" class="СyberSport3" alt="">
                <img src="/assets/img/elements/CyberSport.png" class="CyberSport" alt="">
            </div>
            <div class="modal__title">
                <h6 class="tt">РЕДАКТИРОВАТЬ ПРОФИЛЬ</h6> <span class="close-modal"><svg width="20" height="20"
                        viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M19.1814 3.00048C19.7139 2.46795 19.7139 1.60454 19.1814 1.07201C18.6488 0.539475 17.7854 0.539474 17.2529 1.07201L9.97405 8.35085L2.75756 1.13436C2.22503 0.601825 1.36162 0.601825 0.829088 1.13436C0.296555 1.66689 0.296554 2.5303 0.829087 3.06283L8.04558 10.2793L1.39244 16.9325C0.859906 17.465 0.859906 18.3284 1.39244 18.8609C1.92497 19.3935 2.78838 19.3935 3.32091 18.8609L9.97405 12.2078L16.6895 18.9233C17.2221 19.4558 18.0855 19.4558 18.618 18.9233C19.1505 18.3907 19.1505 17.5273 18.618 16.9948L11.9025 10.2793L19.1814 3.00048Z"
                            fill="#2F2F37" />
                    </svg>
                </span>
            </div>
            <div class="modal__form">
                <form method="POST" action="{{ route('profileedit') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="block__modal_profile">
                        <div class="block__modal_profile__avatar">
                            <p>{{ __('Фото профиля') }}</p>
                            <input type="file" name="avatar" id="avatar"
                                class="form-control custom-cursor-default-hover" style="display:none;" accept="image/*">
                            <label for="avatar" class="custom-file-upload avatar-preview" id="avatar-preview">
                                <img src="/avatars/{{ Auth::user()->avatar }}" alt="">
                                <span class="redAvatarIcon">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <rect width="24" height="24" rx="8" fill="white" fill-opacity="0.15"/>
                                        <path d="M14.0245 5.86884C14.6582 5.32066 14.975 5.04656 15.4835 5.00581C15.992 4.96505 16.2756 5.14015 16.8427 5.49034C17.1661 5.68999 17.4957 5.93218 17.7816 6.21803C18.0675 6.50388 18.3098 6.83338 18.5095 7.15661C18.8598 7.7236 19.035 8.00709 18.9942 8.5154C18.9534 9.02372 18.6792 9.34047 18.1309 9.97399C17.8514 10.2969 17.5317 10.6623 17.1882 11.0479L12.9502 6.81123C13.336 6.46782 13.7014 6.14829 14.0245 5.86884Z" fill="#BBC1C7"/>
                                        <path d="M11.7959 7.85808C11.318 8.3004 10.8416 8.75422 10.4028 9.19283C9.23411 10.3612 7.95746 11.7971 7.0778 12.8134C6.8408 13.0872 6.65501 13.3018 6.51715 13.4983C6.26442 13.8145 6.08547 14.4034 5.81072 15.3077L5.40027 16.6585C5.02743 17.8856 4.84101 18.4991 5.17103 18.829C5.50106 19.1589 6.11478 18.9726 7.34224 18.5999L8.69348 18.1895C9.65143 17.8986 10.2556 17.7152 10.5565 17.4377C10.7376 17.3048 10.9368 17.1326 11.1842 16.9185C12.2008 16.0391 13.6372 14.7629 14.8059 13.5945C15.2446 13.1559 15.6986 12.6796 16.141 12.2019L11.7959 7.85808Z" fill="#BBC1C7"/>
                                        </svg>
                                        
                                </span>
                            </label>
                        </div>
                        <div class="block__modal_profile__input">
                            <label for="name">
                                <p>{{ __('Имя') }}</p>
                                <input id="name" type="text"
                                       class="form-control @error('name') is-invalid @enderror"
                                       name="name" value="{{ old('name', Auth::user()->name) }}">
                                <span class="invalid-feedback" role="alert">
                                    @error('name')
                                        <strong>{{ $message }}</strong>
                                    @enderror
                                </span>
                            </label>
                            <!-- Surname input -->
                            <label for="surname">
                                <p>{{ __('Фамилия') }}</p>
                                <input id="surname" type="text"
                                    class="form-control @error('surname') is-invalid @enderror" name="surname"
                                    value="{{ old('surname', Auth::user()->surname) }}" >
                                @error('surname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </label>
                            <label for="patronymic">
                                <p>{{ __('Отчество') }}</p>
                                <input id="patronymic" type="text"
                                    class="form-control @error('patronymic') is-invalid @enderror" name="patronymic"
                                    value="{{ Auth::user()->patronymic }}" placeholder="Введите отчество " maxlength="50"
                                     autocomplete="patronymic">
                                @error('patronymic')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </label>
                            <label for="telegram">
                                <p>{{ __('Telegram') }}</p>
                                <input id="telegram" type="text"
                                    class="form-control maskTg @error('telegram') is-invalid @enderror" name="telegram"
                                    value="{{ Auth::user()->telegram }}"placeholder="@Ivanov" maxlength="50" 
                                    autocomplete="telegram">
                                @error('telegram')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </label>
                           
                        </div>
                       <div class="password-container">
                        <label for="email" class="wd100">
                            <p>{{ __('Корпоративная почта') }}</p>
                            <input id="email" type="email"
                                class="form-control @error('email') is-invalid @enderror" name="email"
                                value="{{ Auth::user()->email }}" placeholder="Введите почту"  maxlength="70"
                                autocomplete="email">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </label>
                    </div>
                        <div class="password-container">
                            <p>{{ __('Пароль') }}</p>
                            <input id="password" type="password"
                                class="form-control @error('password') is-invalid @enderror" name="password" maxlength="50"
                                 placeholder="Введите пароль" autocomplete="new-password">
                            <span id="togglePassword" class="password-toggle">
                                <svg id="eye-open" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="feather feather-eye" viewBox="0 0 24 24">
                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                    <circle cx="12" cy="12" r="3"></circle>
                                </svg>

                                <svg id="eye-closed" style="display:none;" xmlns="http://www.w3.org/2000/svg"
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
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        </div>

                        <!-- Поле для подтверждения пароля с глазом -->
                        <div class="password-container">
                            <p>{{ __('Подтверждение пароля') }}</p>
                            <input id="password-confirm" type="password" placeholder="Повторите пароль"
                                class="form-control" name="password_confirmation" maxlength="50" 
                                autocomplete="new-password">
                            <span id="togglePasswordConfirm" class="password-toggle">
                                <svg id="eye-open-confirm" xmlns="http://www.w3.org/2000/svg" width="24"
                                    height="24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye"
                                    viewBox="0 0 24 24">
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
                    <div class="modal__button">
                        <button type="submit">{{ __('Сохранить') }}</button>
                        <button type="button" class="close-modal">{{ __('Отмена') }}</button>
                    </div>
                    <div class="modal__button delakk">
                       <a   class="open-modal-btn close-modal" data-modal="profileDelete">{{ __('Удалить мой аккаунт') }}</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
