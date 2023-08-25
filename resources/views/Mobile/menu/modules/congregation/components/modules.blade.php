<div class="row align-items-center mb-5">
    <div class="col">
        <h3 class="mb-0"></h3>
    </div>
    <!-- End Col -->

    <div class="col-auto">
        <!-- Nav -->
        <ul class="nav nav-segment" id="connectionsTab" role="tablist">
            <li class="nav-item" role="presentation">
                <a class="nav-link active" id="grid-tab" data-bs-toggle="tab" href="#grid" role="tab" aria-controls="grid" aria-selected="false" title="Column view" tabindex="-1">
                    <i class="bi-grid"></i>
                </a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="list-tab" data-bs-toggle="tab" href="#list" role="tab" aria-controls="list" aria-selected="true" title="List view">
                    <i class="bi-list"></i>
                </a>
            </li>
        </ul>
        <!-- End Nav -->
    </div>
    <!-- End Col -->
</div>
<div class="tab-content" id="connectionsTabContent">
    <div class="tab-pane fade  active show" id="grid" role="tabpanel" aria-labelledby="grid-tab">
        <!-- Connections -->
        <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-3">
            @foreach($permissions as $permission)
                <div class="col mb-3 mb-lg-5">
                    <!-- Card -->
                    <div class="card gradient-radial-sm-primary h-100">
                        <!-- Body -->
                        <div class="card-body pb-0">
                            <div class="row align-items-center mb-2">
                                <div class="col-9">
                                    <h4 class="mb-1">
                                        <a>
                                            @if($permission->name == 'module.stand')
                                                Стенд
                                            @elseif($permission->name == 'module.reports')
                                                Отчеты
                                            @elseif($permission->name == 'module.schedule')
                                                Графики
                                            @endif
                                        </a>
                                    </h4>
                                </div>
                                <!-- End Col -->

                                <div class="col-3 text-end">
                                    <!-- Dropdown -->
                                    <div class="dropdowm">
                                        <button type="button" class="btn btn-ghost-secondary btn-icon btn-sm rounded-circle" id="teamsDropdown1" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="bi-three-dots-vertical"></i>
                                        </button>

                                        <div class="dropdown-menu dropdown-menu-sm dropdown-menu-end" aria-labelledby="teamsDropdown1">
                                            <a class="dropdown-item" href="#">Rename team</a>
                                            <a class="dropdown-item" href="#">Add to favorites</a>
                                            <a class="dropdown-item" href="#">Archive team</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item text-danger" href="#">Delete</a>
                                        </div>
                                    </div>
                                    <!-- End Dropdown -->
                                </div>
                            </div>
                            @if($permission->name == 'module.stand')
                                <p>Инструмент для регулирования записей для стендов</p>
                            @elseif($permission->name == 'module.reports')
                                <p>Инструмент для ведения ежемесячных отчетов возвещателей собрания</p>
                            @elseif($permission->name == 'module.schedule')
                                <p>Инструмент для создания и регулирования графиков встреч собрания</p>
                            @endif
                        </div>
                        <div class="card-footer border-0 pt-0">
                            <div class="list-group list-group-flush list-group-no-gutters">
                                <div class="list-group-item">
                                    <div class="row align-items-center">
                                        <div class="col">
                                            <span class="card-subtitle">Статус модуля</span>
                                        </div>
                                        <div class="col-auto">
                                            @if(DB::table('congregations_permissions')
->where('congregation_id', '=', $congregation->id)
->where('permission_id', '=', $permission->id)
->count() > 0)
                                                <a class="badge bg-success p-2">Активен</a>
                                            @else
                                                <a class="badge bg-soft-danger p-2">Отключен</a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <div class="tab-pane fade" id="list" role="tabpanel" aria-labelledby="list-tab">
        <div class="row row-cols-1">
            @foreach($permissions as $permission)
                <div class="col mb-3">
                    <!-- Card -->
                    <div class="card card-body">
                        <div class="d-flex align-items-md-center">
                            <div class="flex-grow-1">
                                <div class="row align-items-md-center">
                                    <div class="col-8">
                                        <h4 class="mb-1">
                                            <a class="text-dark">{{$permission->name}}</a>
                                        </h4>
                                    </div>

                                    <div class="col-4">
                                        <!-- Form Check -->
                                        @if(DB::table('congregations_permissions')
->where('congregation_id', '=', $congregation->id)
->where('permission_id', '=', $permission->id)
->count() > 0)
                                            <form method="post" action="">
                                                @csrf
                                                <input type="hidden" name="delete_permission_id" value="{{ $permission->id }}">
                                                <button class="btn btn-primary btn-sm">Разрешено</button>
                                            </form>
                                        @else
                                            <form method="post" action="">
                                                @csrf
                                                <input type="hidden" name="allow_permission_id" value="{{ $permission->id }}">
                                                <button class="btn btn-outline-primary btn-sm">Разрешить</button>
                                            </form>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
