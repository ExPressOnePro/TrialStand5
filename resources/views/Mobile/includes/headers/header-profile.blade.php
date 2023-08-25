<header class="navbar-fixed navbar-height navbar-bordered bg-white navbar-shadow">
    <div class="container">
        <div class="navbar-nav-wrap mt-2">
            <div class="navbar">
                <h1>Профиль</h1>
            </div>
            <div class="navbar ms-auto">
                <h1>
                <a href="{{ route('logout') }}"
                   onclick="event.preventDefault();
                                   document.getElementById('logout-form').submit();">
                    <i class="fa-solid fa-arrow-right-from-bracket text-danger"></i>
                </a>
                </h1>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        </div>
    </div>
</header>
