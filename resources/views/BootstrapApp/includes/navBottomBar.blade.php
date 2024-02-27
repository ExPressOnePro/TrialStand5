 <div class="d-md-none fixed-bottom">
        <ul class="nav nav-control nav-pills nav-fill small bg-secondary shadow-sm" id="nav-tab" role="tablist" style="
            --bs-nav-link-color: var(--bs-black);
            --bs-nav-pills-link-active-color: var(--bs-white);
            --bs-nav-pills-link-active-bg: var(--bs-secondary);">
            <li class="nav-item" role="presentation">
                @if(!Request::is('home'))
                    <a href="{{ route('home') }}" onclick="loadHomeContent('main')" class="nav-link">
                        @else
                            <button class="nav-link" onclick="loadHomeContent('main')" id="mainButton">
                                @endif
                                <i class="fa fa-home fs-2"></i><br><strong class="mb-1">Главная</strong>
                            @if(!Request::is('home'))
                    </a>
                    @else
                        </button>
                @endif
            </li>
            <li class="nav-item" role="presentation">
                @if(!Request::is('home'))
                    <a href="{{ route('home') }}"  onclick="loadHomeContent('menu')" class="nav-link">
                        @else
                            <button class="nav-link"  onclick="loadHomeContent('menu')"  id="menuButton">
                                @endif
                                <i class="fa fa-bars fs-2"></i><br><strong class="mb-1">Меню</strong>
                            @if(!Request::is('home'))
                    </a>
                    @else
                        </button>
                @endif
            </li>
            @role('Developer')
            <li class="nav-item" role="presentation">
                @if(!Request::is('home'))
                    <a href="{{ route('developer.hub') }}"  class="nav-link">
                        @else
                            <button class="nav-link"   >
                                @endif
                                <i class="fa-solid fa-globe fs-2"></i><br><strong class="mb-1">Админ</strong>
                            @if(!Request::is('home'))
                    </a>
                    @else
                        </button>
                @endif
            </li>
            @endrole
        </ul>
    </div>
    <script>
        function loadHomeContent(content) {
            localStorage.setItem('homeContent', content);
            $('#preloader').show();
            var url = '{{ route('home-content', '') }}/' + content;
            window.history.pushState({ path: window.location.href }, '', `?content=${content}`);
            $.ajax({
                url: url,
                type: 'GET',
                success: function(response) {
                    $('#preloader').hide();
                    $('#dynamic-content').html(response.content);
                    if (content === 'main') {
                        $('#mainButton').addClass('text-white');
                    } else {
                        $('#mainButton').removeClass('text-white');
                    }
                    if (content === 'menu') {
                        $('#menuButton').addClass('text-white');
                    } else {
                        $('#menuButton').removeClass('text-white');
                    }
                },
                error: function(error) {
                    $('#preloader').hide();
                    console.error(error);
                    setTimeout(loadData, 5000);
                }
            });
        }
    </script>
