<header class="navbar-fixed navbar-height navbar-bordered bg-white navbar-shadow">
    <div class="container">
        <div class="navbar-nav-wrap mt-2">
            <div class="navbar">
                <a class="text-center text-dark h1" onclick="goBack()">
                    <div class="rounded">

                    </div>
                    <i class="fa-solid fa-arrow-left"></i>
                </a>
            </div>
            <div class="navbar ms-auto">
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
<script>
    function goBack() {
        window.history.back();
    }
</script>
