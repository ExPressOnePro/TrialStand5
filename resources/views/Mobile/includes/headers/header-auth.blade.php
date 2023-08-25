<header class="position-lg-sticky top-0 start-0 end-0 mt-3 mx-3">
    <div class="d-flex d-lg-none justify-content-between">
        <!-- Language -->
        <div class="dropdown dropup">
            <button type="button" class="btn btn-ghost-secondary btn-icon rounded-circle" id="selectLanguageDropdown"
                    data-bs-toggle="dropdown" aria-expanded="false" data-bs-dropdown-animation>
                <i class="fa-solid fa-language"></i>
            </button>

            <div class="dropdown-menu navbar-dropdown-menu-borderless" aria-labelledby="selectLanguageDropdown">
                <span class="dropdown-header">Выберите язык</span>
                @foreach (Config::get('languages') as $lang => $language)
                    @if ($lang != App::getLocale())
                        @if($language == 'English')
                            <a class="dropdown-item" href="{{ route('lang.switch', $lang) }}">
                                <img class="avatar avatar-xss avatar-circle me-2" src="{{asset('front/vendor/flag-icon-css/flags/1x1/us.svg')}}" alt="Flag">
                                <span class="text-truncate" title="English">English</span>
                            </a>
                        @elseif ($language == 'Română')
                            <a class="dropdown-item" href="{{ route('lang.switch', $lang) }}">
                                <img class="avatar avatar-xss avatar-circle me-2" src="{{asset('front/vendor/flag-icon-css/flags/1x1/ro.svg')}}" alt="Flag">
                                <span class="text-truncate" title="English">Română</span>
                            </a>
                        @elseif ($language == 'Русский')
                            <a class="dropdown-item" href="{{ route('lang.switch', $lang) }}">
                                <img class="avatar avatar-xss avatar-circle me-2" src="{{asset('front/vendor/flag-icon-css/flags/1x1/ru.svg')}}" alt="Flag">
                                <span class="text-truncate" title="English">Русский</span>
                            </a>
                        @endif
                    @endif
                @endforeach
            </div>
        </div>
        <!-- End Language -->
                <h1>
                    <a type="button" class="btn btn-ghost-secondary btn-icon rounded-circle" href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                                   document.getElementById('logout-form').submit();">
                        <i class="fa-solid fa-arrow-right-from-bracket text-danger"></i>
                    </a>
                </h1>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
    </div>
</header>
