@extends('Mobile.layouts.front.app')
@section('title') Meeper | Собрание @endsection
@section('content')

    <div class="content container-fluid">
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
                                                    @elseif($permission->name == 'module.contacts')
                                                        Контакты
                                                    @elseif($permission->name == 'module.report')
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
{{--                                                    <div class="dropdown-divider"></div>--}}
                                                    @if ($permission->has_permission)
                                                        <form method="post" action="{{ route('module.disconnect', ['congregation' => $congregation->id, 'permission' => $permission->id]) }}">
                                                            @csrf
                                                            <input type="hidden" name="permission_id" value="{{ $permission->id }}">
                                                            <input type="hidden" name="congregation_id" value="{{ $congregation->id }}">
                                                            <button class="dropdown-item text-danger btn btn-primary btn-sm">Отключить модуль</button>
                                                        </form>
                                                    @else
                                                        <form method="post" action="{{ route('module.connect', ['congregation' => $congregation->id, 'permission' => $permission->id]) }}">
                                                            @csrf
                                                            <input type="hidden" name="permission_id" value="{{ $permission->id }}">
                                                            <input type="hidden" name="congregation_id" value="{{ $congregation->id }}">
                                                            <button class="dropdown-item text-primary btn btn-outline-primary btn-sm">Добавить модуль</button>
                                                        </form>
                                                    @endif
                                                </div>
                                            </div>
                                            <!-- End Dropdown -->
                                        </div>
                                    </div>
                                    @if($permission->name == 'module.stand')
                                        <p>Инструмент для регулирования записей для стендов</p>
                                    @elseif($permission->name == 'module.contacts')
                                        <p>Инструмент для связи между возвещателями</p>
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


@endsection
