


        <header class="mb-3 sticky-lg-top shadow-sm">
            <nav class="navbar navbar-expand-lg bg-body-tertiary border-bottom" aria-label="Light offcanvas navbar">
                <div class="container-fluid">
                    <a href="/home1" class="d-flex align-items-center link-body-emphasis text-decoration-none">
                        <img src="{{asset('/android-chrome-192x192.png')}}" width="40" height="40" class="me-2" viewBox="0 0 118 94" role="img">

                    </a>
                    <div class="d-flex flex-column flex-md-row align-items-center">
                        <!-- Заголовок для мобильных устройств -->
                        <div class="me-auto ms-auto d-lg-none">
                            <h2>Meeper</h2>
                        </div>

                        <!-- Меню для десктопов -->
                        <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0 d-none d-lg-flex">
                            @can('module.stand')
                            <li><a href="{{route('stand.hub2')}}" class="nav-link px-2"><h5>Стенд</h5></a></li>
                            @endcan
                            @can('module.contacts')
                                <li><a href="{{route('contacts.hub2')}}" class="nav-link px-2"><h5>Контакты</h5></a></li>
                                @endcan
                            @can('congregation.open_congregation')
                            <li><a href="{{route('congregationView', Auth()->user()->congregation_id)}}" class="nav-link px-2"><h5>Собрание</h5></a></li>
                            @endcan
                            @role('Developer')
                            <li><a href="{{route('developer.hub')}}" class="nav-link px-2"><h5>Developer</h5></a></li>
                            @endrole
                        </ul>
                    </div>

                    <div class="dropdown">
                        <button class="btn btn-outline-secondary dropdown-toggle" type="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa fa-user" aria-hidden="true"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
{{--                            <li><a class="dropdown-item" href="{{ route('profile') }}"><i class="fa fa-user"></i> Профиль</a></li>--}}
                            <li><a class="dropdown-item" href="{{ route('profile.settings') }}"><i class="fa fa-gear"></i> Настройки</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><button class="dropdown-item" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="fa-solid fa-arrow-right-from-bracket text-danger"></i> Выйти</button></li>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </ul>
                    </div>
                </div>
            </nav>
        </header>

