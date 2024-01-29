@extends('BootstrapApp.layouts.bootstrapApp')
@section('title') Meeper | Собрание @endsection
@section('content')

    <style>
        .permission:hover {
            border-color: #8a2be2;
            transition: border-color 0.01s ease;
        }
    </style>
    <div class="content container-fluid">
        <div class="row">
            @foreach($data['permissions'] as $permission)
                <div class="col-md-6 ">
                    <div class="row permission g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                        <div class="col p-4 d-flex flex-column position-static">
                            <strong class="d-inline-block mb-2 text-primary-emphasis">
                                @if($permission['has_permission'])

                                @endif

                            </strong>

                            <h3 class="mb-0">
                                @switch($permission['name'])
                                    @case('module.stand')
                                        Стенд
                                        @break
                                    @case('module.contacts')
                                        Контакты
                                        @break
                                    @case('module.report')
                                        Отчеты
                                        @break
                                    @case('module.schedule')
                                        Расписание встреч
                                        @break
                                    @default
                                @endswitch
                            </h3>

                            <div class="mb-1 text-body-secondary">
                            @if($permission['has_permission'])
                                <strong class="text-success"><i class="fa-solid fa-circle"></i> Подключен в работе</strong>
                            @else
                                <strong class="text-secondary"><i class="fa-solid fa-circle-dot"></i> Не подключен</strong>
                            @endif
                            </div>
                            <p class="card-text mb-auto my-5">
                                @switch($permission['name'])
                                    @case('module.stand')
                                        Инструмент для регулирования записей для стендов
                                        @break
                                    @case('module.contacts')
                                        Инструмент для связи между возвещателями
                                        @break
                                    @case('module.report')
                                        Отчеты
                                        @break
                                    @case('module.schedule')
                                        Инструмент для создания и регулирования графиков встреч собрания
                                        @break
                                    @default
                                @endswitch
                            </p>
                            <a href="#" class="icon-link gap-1 icon-link-hover stretched-link">
                            </a>
                        </div>
                        <div class="col-auto d-none d-lg-block">
                        <img href="{{asset('/images')}}">
                        </div>
                    </div>
                </div>
{{--                <div class="col mb-3 mb-lg-5">--}}
{{--                    <!-- Card -->--}}
{{--                    <div class="card gradient-radial-sm-primary h-100">--}}
{{--                        <!-- Body -->--}}
{{--                        <div class="card-body pb-0">--}}
{{--                            <div class="row align-items-center mb-2">--}}
{{--                                <div class="col-9">--}}
{{--                                    <h4 class="mb-1">--}}
{{--                                        <a>--}}
{{--                                            @if($permission->name == 'module.stand')--}}
{{--                                                Стенд--}}
{{--                                            @elseif($permission->name == 'module.contacts')--}}
{{--                                                Контакты--}}
{{--                                            @elseif($permission->name == 'module.report')--}}
{{--                                                Отчеты--}}
{{--                                            @elseif($permission->name == 'module.schedule')--}}
{{--                                                Графики--}}
{{--                                            @endif--}}
{{--                                        </a>--}}
{{--                                    </h4>--}}
{{--                                </div>--}}
{{--                                <!-- End Col -->--}}

{{--                                <div class="col-3 text-end">--}}
{{--                                    <!-- Dropdown -->--}}
{{--                                    <div class="dropdowm">--}}
{{--                                        <button type="button" class="btn btn-ghost-secondary btn-icon btn-sm rounded-circle" id="teamsDropdown1" data-bs-toggle="dropdown" aria-expanded="false">--}}
{{--                                            <i class="bi-three-dots-vertical"></i>--}}
{{--                                        </button>--}}

{{--                                        <div class="dropdown-menu dropdown-menu-sm dropdown-menu-end" aria-labelledby="teamsDropdown1">--}}
{{--                                            --}}{{--                                                    <div class="dropdown-divider"></div>--}}
{{--                                            @if ($permission->has_permission)--}}
{{--                                                <form method="post" action="{{ route('module.disconnect', ['congregation' => $congregation->id, 'permission' => $permission->id]) }}">--}}
{{--                                                    @csrf--}}
{{--                                                    <input type="hidden" name="permission_id" value="{{ $permission->id }}">--}}
{{--                                                    <input type="hidden" name="congregation_id" value="{{ $congregation->id }}">--}}
{{--                                                    <button class="dropdown-item text-danger btn btn-primary btn-sm">Отключить модуль</button>--}}
{{--                                                </form>--}}
{{--                                            @else--}}
{{--                                                <form method="post" action="{{ route('module.connect', ['congregation' => $congregation->id, 'permission' => $permission->id]) }}">--}}
{{--                                                    @csrf--}}
{{--                                                    <input type="hidden" name="permission_id" value="{{ $permission->id }}">--}}
{{--                                                    <input type="hidden" name="congregation_id" value="{{ $congregation->id }}">--}}
{{--                                                    <button class="dropdown-item text-primary btn btn-outline-primary btn-sm">Добавить модуль</button>--}}
{{--                                                </form>--}}
{{--                                            @endif--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <!-- End Dropdown -->--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            @if($permission->name == 'module.stand')--}}
{{--                                <p>Инструмент для регулирования записей для стендов</p>--}}
{{--                            @elseif($permission->name == 'module.contacts')--}}
{{--                                <p>Инструмент для связи между возвещателями</p>--}}
{{--                            @elseif($permission->name == 'module.reports')--}}
{{--                                <p>Инструмент для ведения ежемесячных отчетов возвещателей собрания</p>--}}
{{--                            @elseif($permission->name == 'module.schedule')--}}
{{--                                <p>Инструмент для создания и регулирования графиков встреч собрания</p>--}}
{{--                            @endif--}}
{{--                        </div>--}}
{{--                        <div class="card-footer border-0 pt-0">--}}
{{--                            <div class="list-group list-group-flush list-group-no-gutters">--}}
{{--                                <div class="list-group-item">--}}
{{--                                    <div class="row align-items-center">--}}
{{--                                        <div class="col">--}}
{{--                                            <span class="card-subtitle">Статус модуля</span>--}}
{{--                                        </div>--}}
{{--                                        <div class="col-auto">--}}
{{--                                            @if(DB::table('congregations_permissions')--}}
{{--->where('congregation_id', '=', $congregation->id)--}}
{{--->where('permission_id', '=', $permission->id)--}}
{{--->count() > 0)--}}
{{--                                                <a class="badge bg-success p-2">Активен</a>--}}
{{--                                            @else--}}
{{--                                                <a class="badge bg-soft-danger p-2">Отключен</a>--}}
{{--                                            @endif--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
            @endforeach
        </div>
    </div>


@endsection
