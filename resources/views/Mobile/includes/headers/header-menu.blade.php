<header class="navbar-fixed navbar-height navbar-bordered bg-white navbar-shadow"style="position: fixed;
    bottom: 0;
    left: 0;
    width: 100%;
    z-index: 1000; /* Установите значение z-index по вашему усмотрению */">
    <div class="container">
        <div class="navbar-nav-wrap mt-2">
            <div class="navbar">
                <h1>{{ __('text.Меню') }}</h1>
            </div>

            <div class="navbar ms-auto">
                <!-- Language Dropdown -->
                <div class="dropdown dropstart me-2">
                    <button type="button" class="btn btn-ghost-secondary btn-icon rounded-circle" id="selectLanguageDropdown"
                            data-bs-toggle="dropdown" aria-expanded="false" data-bs-dropdown-animation>
                        <i class="fa-solid fa-language"></i>
                    </button>

                    <div class="dropdown-menu navbar-dropdown-menu-borderless" aria-labelledby="selectLanguageDropdown">
                        <span class="dropdown-header">{{ __('text.Выберите язык') }}</span>
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

                <!-- Dark Mode Switch -->
                <div class="form-check form-switch form-switch-dark">
                    <input class="form-check-input me-0" type="checkbox" id="darkSwitch">
                </div>
            </div>

        </div>
    </div>
</header>


<script>
    // SWITHCER THEME APPEARANCE
    // =======================================================
    const $swithcer = document.querySelector('#darkSwitch')

    if (HSThemeAppearance.getOriginalAppearance() === 'dark') {
        $swithcer.checked = true
    }

    $swithcer.addEventListener('change', e => {
        HSThemeAppearance.setAppearance(e.target.checked ? 'dark' : 'default')
    })
</script>
