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
                <div class="col-md-6">
                    <div class="row permission g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                        <div class="card-header p-2 rounded-top-4">
                            <div class="row d-flex align-items-center">
                                <div class="col-8 lh-1">
                                    <h4>
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
                                    </h4>
                                    @if($permission['has_permission'])
                                        <strong class="text-success"><i class="fa-solid fa-circle"></i> Подключен</strong>
                                    @else
                                        <strong class="text-secondary"><i class="fa-solid fa-circle-dot"></i> Не подключен</strong>
                                    @endif
                                </div>
                                <div class="col-4 text-end">
                                    @if($permission['has_permission'] == true)
                                        <form method="post" action="{{ route('module.disconnect', ['congregation' => $data['congregation']['id'], 'permission' => $permission['id']]) }}">
                                            @csrf
                                            <input type="hidden" name="permission_id" value="{{ $permission['id'] }}">
                                            <input type="hidden" name="congregation_id" value="{{ $data['congregation']['id'] }}">
                                            <button class="btn btn-outline-danger card-text mb-auto">Отключить</button>
                                        </form>
                                    @else
                                        <form method="post" action="{{ route('module.connect', ['congregation' => $data['congregation']['id'], 'permission' => $permission['id']]) }}">
                                            @csrf
                                            <input type="hidden" name="permission_id" value="{{ $permission['id'] }}">
                                            <input type="hidden" name="congregation_id" value="{{ $data['congregation']['id'] }}">
                                            <button class="btn btn-success card-text mb-auto">Подключить</button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <a class="col p-4 d-flex flex-column position-static text-decoration-none" href="
                        @switch($permission['name'])
                                    @case('module.stand')

                                        @break
                                    @case('module.contacts')
                                        Инструмент для связи между возвещателями
                                        @break
                                    @case('module.schedule')
                                        {{ route('presentation.meetingSchedules')}}
                                        @break
                                    @default
                                @endswitch">
                            <p class="card-text mb-auto ">
                                @switch($permission['name'])
                                    @case('module.stand')
                                        Инструмент для регулирования записей для стендов
                                        @break
                                    @case('module.contacts')
                                        Инструмент для связи между возвещателями
                                        @break
                                    @case('module.schedule')
                                        Инструмент для создания и регулирования графиков встреч собрания
                                        @break
                                    @default
                                @endswitch
                            </p>
                        </a>
                        <div class="col-auto d-none d-lg-block">
                            @switch($permission['name'])
                                @case('module.stand')
                                    <img src="{{ asset('images/stand.jpg')}}" width="100%" height="250">
                                    @break
                                @case('module.contacts')
                                    <img src="{{ asset('images/contacts_module.svg')}}" width="100%" height="250">
                                    @break

                                @case('module.schedule')
                                    <img src="{{ asset('images/present.png')}}" width="100%" height="250">
                                    @break
                                @default
                            @endswitch
                        </div>
                    </div>
                </div>

              @endforeach
        </div>

    </div>


@endsection
