@section('games')
    <div class="container games__top">
        <div class="title">
            <h2 class="tt">Зарегистрироваться в диcциплине</h2>
        </div>
        <div class="games__body">
            @foreach ($games as $game)
                <div class="games__block" >
                    <div class="games__block__img">
                       <img src="./assets/img/gamesImg/{{ $game->fon }}" alt="">
                    </div>
                    <div class="games__block__title">
                        <h2 class="tt">{{ $game->title }}</h2>
                        <p>{{ $game->description }}</p>
                    </div>
                    <div class="games__block__button">
                        @if ($game->id == 5 || $game->id == 6)
                            <form action="{{ route('register.solo', ['id' => $game->id]) }}" method="GET">
                                <button type="submit" class="tt">Один игрок</button>
                            </form>
                        @else
                            <form action="{{ route('register.group', ['id' => $game->id]) }}" method="GET">
                                <button type="submit" class="tt">С командой</button>
                            </form>
                            <form action="{{ route('register.solo', ['id' => $game->id]) }}" method="GET">
                                <button type="submit" class="tt">Один игрок</button>
                            </form>
                        @endif
                    </div>

                </div>
            @endforeach
        </div>
    </div>
@endsection
