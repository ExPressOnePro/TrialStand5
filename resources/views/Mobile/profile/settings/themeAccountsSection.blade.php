<div class="card-header">
    <div class="d-flex justify-content-between">
        <div>
            <h4 class="card-title">Тема аккаунта</h4>
        </div>
        <div class="col-auto">
            <div class="form-check form-switch form-switch-dark">
                <input class="form-check-input me-0" type="checkbox" id="darkSwitch">
            </div>
        </div>
    </div>
</div>

<!-- Body -->
<div class="card-body">
    <form>
        <div class="list-group list-group-lg list-group-flush list-group-no-gutters">

            <ul class="navbar-vertical-footer-list">

                <li class="navbar-vertical-footer-list-item">
                    <!-- Style Switcher -->
                    <div class="dropdown dropup">
                        <button type="button" class="btn btn-ghost-secondary btn-icon rounded-circle"
                                id="selectThemeDropdown" data-bs-toggle="dropdown" aria-expanded="false" data-bs-dropdown-animation>
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
    </form>
</div>
<!-- End Body -->
