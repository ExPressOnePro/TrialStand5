<style>
    .scrolling-container {
        max-width: 400px;
        overflow: hidden;
        position: relative;
    }

    .scrolling-text {
        white-space: nowrap;
        animation: scrollText 5s linear; /* Removed "infinite" */
    }

    @keyframes scrollText {
        0% {
            transform: translateX(0);
        }
        100% {
            transform: translateX(-30%);
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
    // Get the element with the class "scrolling-text"
    const scrollingText = document.querySelector(".scrolling-text");

    // Function to handle animation
    function startAnimation() {
        scrollingText.style.animation = "scrollText 5s linear infinite"; // Infinite animation
    }

    // Stop the animation initially
    scrollingText.style.animation = "none";

    // Start the animation after a short delay
    setTimeout(startAnimation, 0); // Delay in milliseconds

    // Function to pause the animation for 3 seconds when it reaches the end
    function pauseAnimation() {
        scrollingText.style.animation = "none";
        setTimeout(startAnimation, 3000); // Pause for 3 seconds
    }

    // Add an event listener to detect when the animation iteration ends
    scrollingText.addEventListener("animationiteration", pauseAnimation);
</script>
