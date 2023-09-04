<header class="navbar-fixed navbar-height navbar-bordered bg-white navbar-shadow">
    <div class="container">
        <div class="navbar-nav-wrap mt-2">
            @if(Request::is('*stand'))
                <div class="navbar">
                    <a class="text-center text-dark h1" onclick="goBack()">
                        <div class="rounded">

                        </div>
                        <i class="fa-solid fa-arrow-left"></i>
                    </a>
                </div>
                <div class="navbar ms-auto">
                    <h1>
                        Выбор стенда
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
                        Настройки стенда
                    </h1>
                </div>
            @else
                <div class="navbar">
                    <a class="text-center text-dark h1" onclick="goBack()">
                        <div class="rounded">

                        </div>
                        <i class="fa-solid fa-arrow-left"></i>
                    </a>
                </div>
                <div class="navbar ms-auto">
                    <h1>
                        {{$stand->name}}
                    </h1>
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



