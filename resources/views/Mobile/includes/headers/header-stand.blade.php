<style>
    .scrolling-container {
        max-width: 300px; /* Фиксированная ширина контейнера */
        overflow: hidden; /* Скрыть содержимое, которое выходит за пределы контейнера */
        position: relative; /* Положение относительно для внутреннего контейнера */
    }

    .scrolling-text {
        white-space: nowrap; /* Предотвратите перенос текста на следующую строку */
        animation: scrollText 1s linear forwards; /* Анимация горизонтальной прокрутки текста */
    }

    @keyframes scrollText {
        0% {
            transform: translateX(0); /* Начните с начала */
        }
        100% {
            transform: translateX(-100%); /* Завершите на правой границе */
        }
    }
</style>


<header class="navbar-fixed navbar-height navbar-bordered bg-white navbar-shadow">
    <div class="container">
        <div class="navbar-nav-wrap mt-2">
            @if(Request::is('*stand'))
                <div class="navbar">
                    <a class="text-center text-dark h1" href="{{route('menu.overview')}}">
                        <div class="rounded">

                        </div>
                        <i class="fa-solid fa-arrow-left"></i>
                    </a>
                </div>
                <div class="navbar ms-auto">
                    <h1>
                        {{ __('text.Выбор стенда') }}
                    </h1>
                </div>
            @elseif(Request::is('*stand/settings*'))
                <div class="navbar">
                    <a class="text-center text-dark h1" onclick="goBack()">
                        <div class="rounded">

                        </div>
                        <i class="fa-solid fa-arrow-left"></i>
                    </a>
                </div>
                <div class="navbar ms-auto">
                    <h1>
                        {{ __('text.Настройки стенда') }}
                    </h1>
                </div>
            @elseif(Request::is('*stand/history*'))
                <div class="navbar">
                    <a class="text-center text-dark h1" onclick="goBack()">
                        <div class="rounded">

                        </div>
                        <i class="fa-solid fa-arrow-left"></i>
                    </a>
                </div>
                <div class="navbar ms-auto">
                    <h1>
                        {{ __('text.История стенда') }}
                    </h1>
                </div>
            @elseif(Request::is('*stand/record*'))
                <div class="navbar">
                    <a class="text-center text-dark h1" onclick="goBack()">
                        <div class="rounded">

                        </div>
                        <i class="fa-solid fa-arrow-left"></i>
                    </a>
                </div>
                <div class="navbar ms-auto">
                    <h1>
                        {{ __('text.Запись') }}
                    </h1>
                </div>
            @elseif(Request::is('*aio_current*', '*aio_next*'))
                <div class="navbar">
                    <a class="text-center text-dark h1" href="{{route('menu.overview')}}">
                        <div class="rounded">

                        </div>
                        <i class="fa-solid fa-arrow-left"></i>
                    </a>
                </div>
                <div class="navbar ms-auto">
                    <div class="col-sm text-end">
                        <div class="col-sm text-end">
                            <div class="scrolling-container">
                                <div class="scrolling-text">

                                    <span class="d-block h2 mb-0">
                                        {{ __('text.Записи') }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @elseif(Request::is('*stand/current*', '*stand/next*'))
                <div class="navbar">
                    <a class="text-center text-dark h1" href="{{route('stand.hub')}}">
                        <div class="rounded">

                        </div>
                        <i class="fa-solid fa-arrow-left"></i>
                    </a>
                </div>
                <div class="navbar ms-auto">
                    <div class="col-sm text-end">
                        <div class="col-sm text-end">
                            <div class="scrolling-container">
                                <div class="scrolling-text">
                                    <span class="d-block h2 mb-0">{{$stand->name}}</span>
                                    <span class="d-block">{{$stand->location}}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</header>
<script>
    function goBack() {
        window.history.back();
    }
</script>


<script>
    // Получите элемент с классом "scrolling-text"
    const scrollingText = document.querySelector(".scrolling-text");

    // Остановите анимацию
    scrollingText.style.animation = "none";

    // Запустите анимацию после некоторой задержки
    setTimeout(() => {
        scrollingText.style.animation = "scrollText 10s linear infinite";
    }, 5000); // Задержка в 5 секунд
</script>
