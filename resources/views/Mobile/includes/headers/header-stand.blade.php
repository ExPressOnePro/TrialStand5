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
                    <div class="col-sm text-end">
                        <span class="d-block h2 mb-0">{{$stand->name}}</span>
                        <span class="d-block">{{$stand->location}}</span>
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



