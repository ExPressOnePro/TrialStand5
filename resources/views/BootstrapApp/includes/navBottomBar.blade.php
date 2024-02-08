@if(!Str::contains(url()->current(), '/home'))
    <div class="d-md-none fixed-bottom">
        <ul class="nav nav-control nav-pills nav-fill small bg-secondary shadow-sm" id="pillNav2" role="tablist" style="
            --bs-nav-link-color: var(--bs-black);
            --bs-nav-pills-link-active-color: var(--bs-white);
            --bs-nav-pills-link-active-bg: var(--bs-secondary);">
            <li class="nav-item" role="presentation">
                <a class="nav-link text-decoration-none {{ request()->is('home*') ? ' active' : '' }}" href="{{ route('home') }}">
                    <p class="h3"><i class="fa fa-home"></i></p>
                </a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link text-decoration-none" id="nav-profile-tab" href="{{ route('home') }}">
                    <p class="h3"><i class="fa-solid fa-bars"></i></p>
                </a>
            </li>
            @role('Developer')
            <li class="nav-item" role="presentation">
                <a class="nav-link text-decoration-none" href="{{ route('developer.hub') }}">
                    <p class="h3"><i class="fa-solid fa-globe"></i></p>
                </a>
            </li>
            @endrole
        </ul>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const tabs = document.querySelectorAll('.nav-link');

            tabs.forEach(tab => {
                tab.addEventListener('shown.bs.tab', function (event) {
                    const activeTabId = event.target.getAttribute('aria-controls');
                    history.pushState({}, '', window.location.pathname + '?tab=' + activeTabId);
                });
            });

            // При загрузке страницы проверяем, есть ли параметр tab в URL и активируем соответствующий таб
            const urlParams = new URLSearchParams(window.location.search);
            const activeTabId = urlParams.get('tab');
            if (activeTabId) {
                const activeTab = document.getElementById(activeTabId);
                if (activeTab) {
                    const tabLink = activeTab.querySelector('.nav-link');
                    if (tabLink) {
                        tabLink.click();
                    }
                }
            }
        });
    </script>
@else
    <div class="d-md-none fixed-bottom">
        <ul class="nav nav-control nav-pills nav-fill small bg-secondary shadow-sm" id="nav-tab" role="tablist" style="
            --bs-nav-link-color: var(--bs-black);
            --bs-nav-pills-link-active-color: var(--bs-white);
            --bs-nav-pills-link-active-bg: var(--bs-secondary);">
            <li class="nav-item" role="presentation">
                <a class="nav-link text-decoration-none {{ request()->is('home*') ? ' active' : '' }}" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">
                    <p class="h3"><i class="fa fa-home"></i></p>
                </a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link text-decoration-none"  id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false" tabindex="-1">
                    <p class="h3"><i class="fa-solid fa-bars"></i></p>
                </a>
            </li>
            @role('Developer')
            <li class="nav-item" role="presentation">
                <a class="nav-link text-decoration-none" href="{{ route('developer.hub') }}">
                    <p class="h3"><i class="fa-solid fa-globe"></i></p>
                </a>
            </li>
            @endrole
        </ul>
    </div>
@endif
