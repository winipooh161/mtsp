@section('register-soloPage')
    <div class="container register__fon">
        <div class="register__group__title">
            <h1>Регистрация</h1>
            <h2 class="tt">Информация</h2>
        </div>
        <div class="form__register">
            <form action="{{ route('registerSoloCommand', ['id' => $game->id]) }}" method="POST">
                @csrf
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <label for="email">
                    <p>Корпоративная почта</p>
                    <input type="email" name="email" id="email" value="{{ old('email', Auth::user()->email ?? '') }}"
                        placeholder="Введите ваш корпоративный Email" maxlength="70" required>
                    @error('email')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </label>
                <div class="block__fio">
                    <label for="name">
                        <p>Имя</p>
                        <input type="text" name="name" id="name" placeholder="Введите ваше имя"
                            value="{{ old('name', Auth::user()->name ?? '') }}" maxlength="70" required>
                        @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </label>
                    <label for="surname">
                        <p>Фамилия</p>
                        <input type="text" name="surname" id="surname" placeholder="Введите вашу фамилию"
                            value="{{ old('surname', Auth::user()->surname ?? '') }}" maxlength="70" required>
                        @error('surname')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </label>
                    <label for="patronymic">
                        <p>Отчество</p>
                        <input type="text" name="patronymic" id="patronymic" placeholder="Введите ваше отчество"
                            value="{{ old('patronymic', Auth::user()->patronymic ?? '') }}" maxlength="70" required>
                        @error('patronymic')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </label>
                </div>
                <div class="block__combo">
                    <label for="discord">
                        <p>Discord</p>
                        <input type="text" name="discord" id="discord" placeholder="Введите ваш @Discord"
                            maxlength="70" required>
                        @error('discord')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </label>
                    <label for="telegram">
                        <p>Telegram</p>
                        <input type="text" name="telegram" id="telegram"
                            value="{{ old('telegram', Auth::user()->telegram ?? '') }}" placeholder="Введите ваш @Telegram"
                            maxlength="70" required>
                        @error('telegram')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </label>
                </div>
                <label for="birth_date">
                    <p>Дата рождения</p>
                    <input type="text" name="birth_date" id="birth_date" class="date-mask" placeholder="ДД/ММ/ГГГГ"
                        maxlength="10" required>
                    @error('birth_date')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </label>
                <div class="block__combo">
                    <label for="company">
                        <p>Компания</p>
                        <input type="text" name="company" id="company" placeholder="Введите вашу компанию"
                            maxlength="70" required>
                        @error('company')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </label>
                    <label for="city">
                        <p>Город проживания</p>
                        <input type="text" name="city" id="city" placeholder="Введите ваш город" maxlength="50"
                            required>
                        @error('city')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </label>
                </div>
                <label for="nickname">
                    <p>Ваш игровой никнейм?</p>
                    <input type="text" name="nickname" id="nickname" placeholder="Введите ваш никнейм" maxlength="50"
                        required>
                    @error('nickname')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </label>
                <label for="rank">
                    <p>Какой ваш текущий ранг или уровень игры в {{ $game->title }}</p>
                    <input type="text" name="rank" id="rank" placeholder="Введите информацию" maxlength="150"
                        required>
                    @error('rank')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </label>
                <label for="time_game">
                    <p>Как долго вы играете в {{ $game->title }}</p>
                    <input type="text" name="time_game" id="time_game" placeholder="Введите информацию" maxlength="150"
                        required>
                    @error('time_game')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </label>
                <label for="device">
                    <p>Какое устройство вы используете для игры (ПК, консоль)? </p>
                    <select name="device" id="device" required>
                        <option value="">Выберите из списка</option>
                        <option value="ПК">ПК</option>
                        <option value="Консоль">Консоль</option>
                    </select>
                    @error('device')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </label>
                <label for="match_times">
                    <p>Какое время для проведения матчей для вас самое удобное?</p>
                    <input type="text" name="match_times" id="match_times" placeholder="Введите время"
                        maxlength="150" required>
                    @error('match_times')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </label>
                <label for="internet_connection">
                    <p>Есть ли у вас стабильное интернет-соединение для участия в онлайн-турнире?</p>
                    <select name="internet_connection" id="internet_connection" required>
                        <option value="Да">Да</option>
                        <option value="Нет">Нет</option>
                    </select>
                    @error('internet_connection')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </label>
                <label for="special_requirements">
                    <p>Есть ли у вас какие-либо особые требования или пожелания для участия в турнире?</p>
                    <input type="text" name="special_requirements" id="special_requirements"
                        placeholder="Введите информацию о требованиях или пожеланиях" maxlength="150">
                    @error('special_requirements')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </label>
                <button type="submit">Отправить</button>
            </form>
        </div>
    </div>

    <div class="block_abs__elements">
        <img src="../assets/img/elements/СyberSport3.png" alt="" class="cuber4">
        <img src="../assets/img/elements/CyberSport.png" alt="" class="cuber3">

    </div>
@endsection
