@section('register-groupPage')
    <div class="container register__fon">
        <div class="register__group__title">
            <h1>Регистрация</h1>
        </div>
        <div class="form__register">
            <h2 class="tt">Информация</h2>
            <form action="{{ route('registerGroupCommand', ['id' => $game->id]) }}" method="POST">
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
                    <input type="email" name="email" id="email" value="{{ old('email', Auth::user()->email) }}"
                        placeholder="Введите ваш корпоративный Email" maxlength="70" required>
                    @error('email')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </label>
                <label for="nickname">
                    <p>Ваш игровой никнейм?</p>
                    <input type="text" name="nickname" id="nickname" placeholder="Введите ваш никнейм" maxlength="50"
                        required>
                    @error('nickname')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </label>
                <div class="block__fio">
                    <label for="name">
                        <p>Имя</p>
                        <input type="text" name="name" id="name" placeholder="Введите ваше имя"
                            value="{{ old('name', Auth::user()->name) }}" maxlength="70" required>
                        @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </label>
                    <label for="surname">
                        <p>Фамилия</p>
                        <input type="text" name="surname" id="surname" placeholder="Введите вашу фамилию"
                            value="{{ old('surname', Auth::user()->surname) }}" maxlength="70" required>
                        @error('surname')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </label>
                    <label for="patronymic">
                        <p>Отчество</p>
                        <input type="text" name="patronymic" id="patronymic" placeholder="Введите ваше отчество"
                            value="{{ old('patronymic', Auth::user()->patronymic) }}" maxlength="70" required>
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
                            value="{{ old('telegram', Auth::user()->telegram) }}" placeholder="Введите ваш @Telegram"
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
                <label for="city">
                    <p>Город проживания</p>
                    <input type="text" name="city" id="city" placeholder="Введите ваш город" maxlength="50"
                        required autocomplete="off">
                    <div id="city-list" class="city-list"></div>
                    @error('city')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </label>
                <label for="company">
                    <p>Компания</p>
                    <select name="company" id="company" required>
                        <option value="">Введите вашу компанию</option>
                        <option value="ПАО МТС">ПАО МТС</option>
                        <option value="МТС Диджитал">МТС Диджитал</option>
                        <option value="МГТС">МГТС</option>
                        <option value="РТК">РТК</option>
                        <option value="МТТ">МТТ</option>    
                        <option value="Стрим">Стрим</option>
                        <option value="Гольфстрим">Гольфстрим</option>
                        <option value="Зеленая точка">Зеленая точка</option>
                        <option value="МТС ИИ">МТС ИИ</option>
                        <option value="КИОН">КИОН</option>
                        <option value="Тревел">Тревел</option>
                        <option value="Броневик">Броневик</option>
                        <option value="МТС Энтертеймент">МТС Энтертеймент</option>
                        <option value="Умный дом">Умный дом</option>
                        <option value="Другое">Другое</option>
                    </select>
                    @error('company')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </label>
                <label for="team_name">
                    <p>Название твоей команды</p>
                    <input type="text" name="team_name" id="team_name" placeholder="Введите название команды"
                        maxlength="70" required>
                    @error('team_name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </label>
                <div class="register__participants">
                    <h2 class="tt">Данные участников</h2>
                    @for ($i = 1; $i <= 4; $i++)
                        <div class="participant">
                            <span>{{ $i }}</span>
                            <label for="fio__participant_{{ $i }}">
                                <p>ФИО</p>
                                <input type="text" name="participants[{{ $i }}][fio]"
                                    id="fio__participant_{{ $i }}" placeholder="Введите ФИО игрока"
                                    maxlength="100" required>
                                @error("participants.$i.fio")
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </label>
                            <label for="birth_date__participant_{{ $i }}">
                                <p>Дата рождения</p>
                                <input type="text" name="participants[{{ $i }}][birth_date]"
                                    id="birth_date__participant_{{ $i }}" placeholder="Введите дату рождения"
                                    class="date-mask" maxlength="10" required>
                                @error("participants.$i.birth_date")
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </label>
                            <label for="city__participant_{{ $i }}">
                                <p>Город проживания</p>
                                <input type="text" name="participants[{{ $i }}][city]"
                                    id="city__participant_{{ $i }}" placeholder="Введите город"
                                    maxlength="50" required autocomplete="off">
                                <div id="city-list-{{ $i }}" class="city-list"></div>
                                @error("participants.$i.city")
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </label>
                            <div class="block__fio">
                                <label for="email__participant_{{ $i }}">
                                    <p>Корпоративная почта</p>
                                    <input type="email" name="participants[{{ $i }}][email]"
                                        id="email__participant_{{ $i }}"
                                        placeholder="Введите корпоративную почту" maxlength="50" required>
                                    @error("participants.$i.email")
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </label>
                                <label for="telegram__participant_{{ $i }}">
                                    <p>Телеграм</p>
                                    <input type="text" name="participants[{{ $i }}][telegram]"
                                        id="telegram__participant_{{ $i }}"
                                        placeholder="Введите @Telegram игрока" maxlength="50" required>
                                    @error("participants.$i.telegram")
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </label>
                            </div>
                            <div class="block__fio">
                                <label for="discord__participant_{{ $i }}">
                                    <p>Дискорд</p>
                                    <input type="text" name="participants[{{ $i }}][discord]"
                                        id="discord__participant_{{ $i }}"
                                        placeholder="Введите @Discord игрока" maxlength="50" required>
                                    @error("participants.$i.discord")
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </label>
                                <label for="nickname__participant_{{ $i }}">
                                    <p>Игровой никнейм</p>
                                    <input type="text" name="participants[{{ $i }}][nickname]"
                                        id="nickname__participant_{{ $i }}"
                                        placeholder="Введите никнейм игрока" maxlength="50" required>
                                    @error("participants.$i.nickname")
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </label>
                                </label>
                            </div>
                        </div>
                    @endfor
                </div>
                <label for="rank">
                    <p>Какой средний текущий ранг или уровень участников вашей команды в {{ $game->title }}?</p>
                    <input type="text" name="rank" id="rank" placeholder="Введите информацию"
                        maxlength="150" required>
                    @error('rank')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </label>
                <label for="team_experience">
                    <p>Как долго ваша команда играет вместе?</p>
                    <input type="text" name="team_experience" id="team_experience" placeholder="Введите информацию"
                        maxlength="150" required>
                    @error('team_experience')
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
                    <textarea name="special_requirements" id="special_requirements"maxlength="300"
                        placeholder="Введите информацию о требованиях или пожеланиях"></textarea>
                    @error('special_requirements')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </label>
                <button type="submit">Отправить</button>
            </form>
        </div>
    </div>
    <script>
        const cities = {
            "Дальний Восток": ["Владивосток", "Хабаровск", "Южно-Сахалинск", "Якутск", "Благовещенск",
                "Петропавловск-Камчатский", "Магадан", "Айхал", "Алдан", "Амурск", "Анадырь", "Арсеньев", "Артем",
                "Белогорск", "Биробиджан", "Большой Камень"
            ],
            "Северо-Запад": ["Санкт-Петербург", "Калининград", "Мурманск", "Архангельск", "Великий Новгород", "Вологда",
                "Сыктывкар", "Псков", "Петрозаводск", "Балтийск", "Бокситогорск", "Боровичи", "Валдай",
                "Великие Луки", "Великий Устюг", "Вельск"
            ],
            "Поволжье": ["Пермь", "Уфа", "Оренбург", "Пенза", "Казань", "Ижевск", "Саратов", "Нижний Новгород",
                "Самара", "Киров", "Чебоксары", "Ульяновск", "Йошкар-Ола", "Саранск", "Агрыз", "Азнакаево"
            ],
            "Сибирь": ["Новосибирск", "Омск", "Красноярск", "Норильск", "Иркутск", "Кемерово", "Томск", "Чита",
                "Улан-Удэ", "Абакан", "Кызыл", "Барнаул", "Анжеро-Судженск", "Ачинск", "Белово"
            ],
            "Урал": ["Екатеринбург", "Челябинск", "Тюмень", "Курган", "Ханты-Мансийск", "Ноябрьск", "Алапаевск",
                "Артемовский", "Асбест", "Аша", "Белоярский", "Березовский", "Богданович", "Верхнеуральск"
            ],
            "Центр": ["Белгород", "Брянск", "Владимир", "Воронеж", "Иваново", "Калуга", "Кострома", "Курск", "Липецк",
                "Орёл", "Рязань", "Смоленск", "Тамбов", "Тверь", "Тула"
            ],
            "Юг": ["Ростов-на-Дону", "Краснодар", "Ставрополь", "Махачкала", "Владикавказ", "Волгоград", "Астрахань",
                "Нальчик", "Абинск", "Азов", "Аксай", "Александровское", "Анапа", "Адлер", "Апшеронск"
            ],
            "Москва и МО": ["Москва", "Андреевка", "Архангельское", "Балашиха", "Бронницы", "Бутово", "Быково",
                "Видное", "Власиха", "ВНИИССОК", "Волоколамск", "Воскресенск", "Голицыно", "Голубое", "Дедовск"
            ]
        };
        // Преобразуем все города в один массив для удобства поиска
        const allCities = Object.values(cities).flat();
        // Функция для отображения списка городов
        function showCityList(cityInput, cityList, filteredCities) {
            cityList.innerHTML = ''; // Очищаем предыдущие результаты
            if (filteredCities.length === 0) {
                cityList.style.display = 'none';
                return;
            }
            filteredCities.forEach(city => {
                const div = document.createElement('div');
                div.classList.add('city-list-item');
                div.textContent = city;
                div.addEventListener('click', () => {
                    cityInput.value = city; // При клике заполняем input выбранным городом
                    cityList.style.display = 'none'; // Скрываем список
                });
                cityList.appendChild(div);
            });
            cityList.style.display = 'block'; // Показываем список
        }
      // Обработчик ввода текста в input
        function setupCityAutocomplete(cityInputId, cityListId) {
            const cityInput = document.getElementById(cityInputId);
            const cityList = document.getElementById(cityListId);
            cityInput.addEventListener('input', function() {
                const query = this.value.toLowerCase();
                const filteredCities = allCities.filter(city => city.toLowerCase().includes(query));
                showCityList(cityInput, cityList, filteredCities);
            });
            // Скрываем список, если клик вне его
            document.addEventListener('click', function(e) {
                if (!cityInput.contains(e.target) && !cityList.contains(e.target)) {
                    cityList.style.display = 'none';
                }
            });
        }
        // Применяем автозаполнение к основному полю города
        setupCityAutocomplete('city', 'city-list');
        // Применяем автозаполнение к каждому полю участников
        document.addEventListener('DOMContentLoaded', function() {
            @for ($i = 1; $i <= 4; $i++)
                setupCityAutocomplete('city__participant_{{ $i }}', 'city-list-{{ $i }}');
            @endfor
        });
    </script>
    <script></script>
    <div class="block_abs__elements">
        <img src="../assets/img/elements/СyberSport3.png" alt="" class="cuber4">
        <img src="../assets/img/elements/CyberSport.png" alt="" class="cuber3">
    </div>
@endsection
