<aside class="js-navbar-vertical-aside navbar navbar-vertical-aside navbar-vertical navbar-vertical-fixed navbar-expand-xl navbar-bordered bg-white  ">
    <div class="navbar-vertical-container">
        <div class="navbar-vertical-footer-offset">
            <!-- Logo -->
            <a class="navbar-brand" href="/" aria-label="Front">
                <img class="navbar-brand-logo" src="{{ asset('front/svg/logos/logo.svg')}}" alt="Logo" data-hs-theme-appearance="default">
                <img class="navbar-brand-logo" src="{{ asset('front/svg/logos-light/logo.svg')}}" alt="Logo" data-hs-theme-appearance="dark">
                <img class="navbar-brand-logo-mini" src="{{ asset('front/svg/logos/logo-short.svg')}}" alt="Logo" data-hs-theme-appearance="default">
                <img class="navbar-brand-logo-mini" src="{{ asset('front/svg/logos-light/logo-short.svg')}}" alt="Logo" data-hs-theme-appearance="dark">
            </a>

            <!-- Navbar Vertical Toggle -->
            <button type="button" class="js-navbar-vertical-aside-toggle-invoker navbar-aside-toggler">
                <i class="bi-arrow-bar-left navbar-toggler-short-align" data-bs-template='<div class="tooltip d-none d-md-block" role="tooltip"><div class="arrow"></div><div class="tooltip-inner"></div></div>' data-bs-toggle="tooltip" data-bs-placement="right" title="Collapse"></i>
                <i class="bi-arrow-bar-right navbar-toggler-full-align" data-bs-template='<div class="tooltip d-none d-md-block" role="tooltip"><div class="arrow"></div><div class="tooltip-inner"></div></div>' data-bs-toggle="tooltip" data-bs-placement="right" title="Expand"></i>
            </button>

            <!-- End Navbar Vertical Toggle -->

            <!-- Content -->
            <div class="navbar-vertical-content">
                <div id="navbarVerticalMenu" class="nav nav-pills nav-vertical card-navbar-nav">
                    <!-- Collapse -->
                    <div class="nav-item">
                        <a class="nav-link" href="/">
                            <i class="bi-house-door nav-icon"></i>
                            <span class="nav-link-title">Главная</span>
                        </a>
                    </div>
                    <!-- End Collapse -->

                    <span class="dropdown-header mt-4">Страницы</span>
                    <small class="bi-three-dots nav-subtitle-replacer"></small>

                    <!-- Collapse -->
                    <div class="navbar-nav nav-compact">

                    </div>
                    <div id="navbarVerticalMenuPagesMenu">
                        <!-- Collapse -->
                        <div class="nav-item">
                            <a class="nav-link dropdown-toggle" href="#navbarVerticalMenuPagesUsersMenu" role="button" data-bs-toggle="collapse" data-bs-target="#navbarVerticalMenuPagesUsersMenu" aria-expanded="false" aria-controls="navbarVerticalMenuPagesUsersMenu">
                                <i class="bi-people nav-icon"></i>
                                <span class="nav-link-title">Пользователи</span>
                            </a>

                            <div id="navbarVerticalMenuPagesUsersMenu" class="nav-collapse collapse " data-bs-parent="#navbarVerticalMenuPagesMenu">
                                @if(auth()->user()->hasRole('Developer'))
                                    @can('Users-Open all users')
                                <a class="nav-link " href="{{ route('users') }}">Все пользователи</a>

                                    @endcan
                                @else
                                    @can('Users-Open congregation users')

                                    @endcan
                                @endif
                            </div>
                        </div>
                        <!-- End Collapse -->


                        <!-- Collapse -->
                        <div class="nav-item">
                            <a class="nav-link dropdown-toggle" href="#navbarVerticalMenuPagesAccountMenu" role="button" data-bs-toggle="collapse" data-bs-target="#navbarVerticalMenuPagesAccountMenu" aria-expanded="false" aria-controls="navbarVerticalMenuPagesAccountMenu">
                                <i class="bi-person-badge nav-icon"></i>
                                <span class="nav-link-title">Собрания</span>
                            </a>

                            <div id="navbarVerticalMenuPagesAccountMenu" class="nav-collapse collapse " data-bs-parent="#navbarVerticalMenuPagesMenu">
                                @if(auth()->user()->hasRole('Developer'))
                                    @can('Congregations-Open all congregations')
                                            <a class="nav-link" href="{{ route('congregationSelect') }}">
                                                <i class="text-20 mr-2 text-muted"></i>
                                                <span class="item-name text-15 heading">Все собрания</span>
                                            </a>
                                    @endcan
                                @else
                                    @can('Congregations-Open congregation')
                                            <a class="nav-link" href="{{ route('congregationView', Auth::user()->congregation_id) }}">
                                                <i class="text-20 mr-2 text-muted"></i>
                                                <span class="item-name text-15 heading">Мое собрание</span>
                                            </a>
                                    @endcan
                                @endif
                            </div>
                        </div>
                        <!-- End Collapse -->

                        <!-- Collapse -->
                        <div class="nav-item">
                            <a class="nav-link dropdown-toggle" href="#navbarVerticalMenuPagesStandMenu" role="button" data-bs-toggle="collapse" data-bs-target="#navbarVerticalMenuPagesStandMenu" aria-expanded="false" aria-controls="navbarVerticalMenuPagesStandMenu">
                                <i class="bi-person-badge nav-icon"></i>
                                <span class="nav-link-title">Стенды</span>
                            </a>

                            <div id="navbarVerticalMenuPagesStandMenu" class="nav-collapse collapse " data-bs-parent="#navbarVerticalMenuPagesMenu">
                                @if(auth()->user()->hasRole('Developer'))
                                    @can('Congregations-Open all congregations')
                                        <a class="nav-link" href="{{ route('stand') }}">
                                            <i class="text-20 mr-2 text-muted"></i>
                                            <span class="item-name text-15 heading">Стенды</span>
                                        </a>
                                    @endcan
                                @else
                                    @can('Congregations-Open congregation')
                                        <a class="nav-link" href="{{ route('congregationView', Auth::user()->congregation_id) }}">
                                            <i class="text-20 mr-2 text-muted"></i>
                                            <span class="item-name text-15 heading">Мое собрание</span>
                                        </a>
                                    @endcan
                                @endif
                            </div>
                        </div>
                        <!-- End Collapse -->





                    <span class="dropdown-header mt-4">Documentation</span>
                    <small class="bi-three-dots nav-subtitle-replacer"></small>

                    <div class="nav-item">
                        <a class="nav-link " href="./documentation/index.html" data-placement="left">
                            <i class="bi-book nav-icon"></i>
                            <span class="nav-link-title">Documentation <span class="badge bg-primary rounded-pill ms-1">v2.1.1</span></span>
                        </a>
                    </div>

                    <div class="nav-item">
                        <a class="nav-link " href="./documentation/typography.html" data-placement="left">
                            <i class="bi-layers nav-icon"></i>
                            <span class="nav-link-title">Components</span>
                        </a>
                    </div>
                </div>

            </div>
            <!-- End Content -->

            <!-- Footer -->
            <div class="navbar-vertical-footer">
                <ul class="navbar-vertical-footer-list">
                    <li class="navbar-vertical-footer-list-item">
                        <!-- Style Switcher -->
                        <div class="dropdown dropup">
                            <button type="button" class="btn btn-ghost-secondary btn-icon rounded-circle" id="selectThemeDropdown" data-bs-toggle="dropdown" aria-expanded="false" data-bs-dropdown-animation>

                            </button>

                            <div class="dropdown-menu navbar-dropdown-menu navbar-dropdown-menu-borderless" aria-labelledby="selectThemeDropdown">
                                <a class="dropdown-item" href="#" data-icon="bi-moon-stars" data-value="auto">
                                    <i class="bi-moon-stars me-2"></i>
                                    <span class="text-truncate" title="Auto (system default)">Auto (system default)</span>
                                </a>
                                <a class="dropdown-item" href="#" data-icon="bi-brightness-high" data-value="default">
                                    <i class="bi-brightness-high me-2"></i>
                                    <span class="text-truncate" title="Default (light mode)">Default (light mode)</span>
                                </a>
                                <a class="dropdown-item active" href="#" data-icon="bi-moon" data-value="dark">
                                    <i class="bi-moon me-2"></i>
                                    <span class="text-truncate" title="Dark">Dark</span>
                                </a>
                            </div>
                        </div>

                        <!-- End Style Switcher -->
                    </li>

                    <li class="navbar-vertical-footer-list-item">
                        <!-- Other Links -->
                        <div class="dropdown dropup">
                            <button type="button" class="btn btn-ghost-secondary btn-icon rounded-circle" id="otherLinksDropdown" data-bs-toggle="dropdown" aria-expanded="false" data-bs-dropdown-animation>
                                <i class="bi-info-circle"></i>
                            </button>

                            <div class="dropdown-menu navbar-dropdown-menu-borderless" aria-labelledby="otherLinksDropdown">
                                <span class="dropdown-header">Help</span>
                                <a class="dropdown-item" href="#">
                                    <i class="bi-journals dropdown-item-icon"></i>
                                    <span class="text-truncate" title="Resources &amp; tutorials">Resources &amp; tutorials</span>
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="bi-command dropdown-item-icon"></i>
                                    <span class="text-truncate" title="Keyboard shortcuts">Keyboard shortcuts</span>
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="bi-alt dropdown-item-icon"></i>
                                    <span class="text-truncate" title="Connect other apps">Connect other apps</span>
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="bi-gift dropdown-item-icon"></i>
                                    <span class="text-truncate" title="What's new?">What's new?</span>
                                </a>
                                <div class="dropdown-divider"></div>
                                <span class="dropdown-header">Contacts</span>
                                <a class="dropdown-item" href="#">
                                    <i class="bi-chat-left-dots dropdown-item-icon"></i>
                                    <span class="text-truncate" title="Contact support">Contact support</span>
                                </a>
                            </div>
                        </div>
                        <!-- End Other Links -->
                    </li>

                    <li class="navbar-vertical-footer-list-item">
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
                    </li>
                </ul>
            </div>
            <!-- End Footer -->
        </div>
    </div>
</aside>
