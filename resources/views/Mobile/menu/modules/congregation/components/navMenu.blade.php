<div class="navbar-expand-lg navbar-vertical mb-3">
    <!-- Navbar Toggle -->
    <div class="d-grid">
        <button type="button" class="navbar-toggler btn btn-white rounded-3 border-primary mb-3" data-bs-toggle="collapse" data-bs-target="#navbarVerticalNavMenuCardPills" aria-label="Toggle navigation" aria-expanded="false" aria-controls="navbarVerticalNavMenuCardPills">
      <span class="d-flex justify-content-between align-items-center">
        <span class="text-dark">Меню</span>

        <span class="navbar-toggler-default">
          <i class="bi-list"></i>
        </span>

        <span class="navbar-toggler-toggled">
          <i class="bi-x"></i>
        </span>
      </span>
        </button>
    </div>
    <!-- End Navbar Toggle -->

    <!-- Navbar Collapse -->
    <div id="navbarVerticalNavMenuCardPills" class="collapse navbar-collapse rounded-3 collapse">
        <div id="navbarSettingsCardWithNav" class="card card-navbar-nav nav nav-pills nav-vertical">
            @if(Request::is('*congregation/requests/*'))
                <a class="nav-link active" href="{{route('congregation.requests', $congregation->id)}}">
                    <i class="bi-app-indicator nav-icon"></i> Хотят присоединиться
                    @if($congregationRequestsCount)
                        <span class="badge bg-soft-danger text-danger ms-2">{{$congregationRequestsCount}}</span>
                    @endif
                </a>
            @else
                <a class="nav-link" href="{{route('congregation.requests', $congregation->id)}}">
                    <i class="bi-app-indicator nav-icon"></i> Хотят присоединиться
                    @if($congregationRequestsCount)
                        <span class="badge bg-soft-danger text-danger ms-2">{{$congregationRequestsCount}}</span>
                    @endif
                </a>
            @endif

            <span class="dropdown-header">Основное</span>

            @if(Request::is('*congregation/overview/*'))
                <a class="nav-link active" href="{{route('congregationView', $congregation->id)}}">
                    <i class="bi-house nav-icon"></i> Обзор
                </a>
            @else
                <a class="nav-link" href="{{route('congregationView', $congregation->id)}}">
                    <i class="bi-house nav-icon"></i> Обзор
                </a>
            @endif
                @can('users.open_meetings_responsible_users')
                    @if(Request::is('*congregation/appointed/*'))
                        <a class="nav-link active" href="{{route('congregation.appointed', $congregation->id)}}">
                            <i class="bi bi-people nav-icon"></i> Назначения в собрании
                        </a>
                    @else
                        <a class="nav-link" href="{{route('congregation.appointed', $congregation->id)}}">
                            <i class="bi bi-people nav-icon"></i> Назначения в собрании
                        </a>
                    @endif
                @endcan
                @can('congregation.open_meetings_users')
                @if(Request::is('*congregation/publishers/*'))
                    <a class="nav-link active" href="{{route('congregation.publishers', $congregation->id)}}">
                        <i class="bi bi-people nav-icon"></i> Возвещатели
                    </a>
                @else
                    <a class="nav-link" href="{{route('congregation.publishers', $congregation->id)}}">
                        <i class="bi bi-people nav-icon"></i> Возвещатели
                    </a>
                @endif
                @endcan
            @can('module.stand')
                @if(Request::is('*congregation/stands/*'))
                    <a class="nav-link active" href="{{route('congregation.stands', $congregation->id)}}">
                        <i class="bi bi-easel nav-icon"></i> Стенд(ы)
                    </a>
                @else
                    <a class="nav-link" href="{{route('congregation.stands', $congregation->id)}}">
                        <i class="bi bi-easel nav-icon"></i> Стенд(ы)
                    </a>
                @endif
            @endcan

                <div class="dropdown-divider"></div>
                @can('congregation.change_settings')
                    <span class="dropdown-header">Настройки</span>
                    @can('congregation.add_module')
                        @if(Request::is('*congregation/modules/*'))
                            <a class="nav-link active" href="{{route('congregation.modules', $congregation->id)}}">
                                <i class="fa-brands fa-hubspot nav-icon"></i> Модули
                            </a>
                        @else
                            <a class="nav-link" href="{{route('congregation.modules', $congregation->id)}}">
                                <i class="fa-brands fa-hubspot nav-icon"></i> Модули
                            </a>
                        @endif

                    @endcan

                    @if(Request::is('*congregation/settings/*'))
                        <a class="nav-link active" href="{{route('congregation.settings', $congregation->id)}}">
                            <i class="bi-gear nav-icon"></i> Настройки
                        </a>
                    @else
                        <a class="nav-link" href="{{route('congregation.settings', $congregation->id)}}">
                            <i class="bi-gear nav-icon"></i> Настройки
                        </a>
                    @endif
                @endcan

        </div>
    </div>
    <!-- End Navbar Collapse -->
</div>

