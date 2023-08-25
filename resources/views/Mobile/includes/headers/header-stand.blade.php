<header class="navbar-fixed navbar-height navbar-bordered bg-white navbar-shadow">
    <div class="container">
        <div class="navbar-nav-wrap mt-2">
            @if(Request::is('stand'))
                <div class="navbar">
                    <h1>Стенды</h1>
                </div>
                <div class="navbar ms-auto"></div>
            @else
                <div class="navbar">
                    <a class="text-center text-dark h1" href="{{ URL::previous() }}">
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



