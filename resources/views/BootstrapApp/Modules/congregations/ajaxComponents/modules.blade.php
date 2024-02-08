<style>
    .gradient {
        background: linear-gradient(45deg, #a8edea, #fed6e3);
        background-size: 400%;
        animation: gradient 10s ease infinite;
        transform: translate3d(0, 0, 0);
        /*background-size: 400%; // Можно менять и подбирать интенсивность*/
    }

    @keyframes  gradient {
        0% {
            background-position: 80% 0%;
        }
        50% {
            background-position: 20% 100%;
        }
        100% {
            background-position: 80% 0%;
        }
    }
</style>
<div class="content container-fluid">

    <div class="row mb-5">
        @foreach($data['permissions'] as $permission)
        <div class="col-md-6 mb-3">
            <div class="h-100 p-4 border shadow-sm rounded-4 position-relative
            @if($permission['has_permission'])
                   gradient
            @else

            @endif">
                <h2 class="pt-3">
                    <strong>
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
                    </strong>
                </h2>

                <p>
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



                <div class="d-flex justify-content-between">
                    <button class="btn btn-outline-primary col m-1" type="button">Обзор</button>
                    @if($permission['has_permission'] == true)
                        <form id="disconnectForm{{$permission['id']}}" method="post" action="{{ route('module.disconnect', ['congregation' => $data['congregation']['id'], 'permission' => $permission['id']]) }}">
                            @csrf
                            <input type="hidden" name="permission_id" value="{{ $permission['id'] }}">
                            <input type="hidden" name="congregation_id" value="{{ $data['congregation']['id'] }}">
                        </form>
                        <button class="btn btn-outline-danger col m-1" type="button" onclick="submitForm('disconnectForm{{$permission['id']}}')">Отключить</button>
                    @else
                        <form id="connectForm{{$permission['id']}}" method="post" action="{{ route('module.connect', ['congregation' => $data['congregation']['id'], 'permission' => $permission['id']]) }}">
                            @csrf
                            <input type="hidden" name="permission_id" value="{{ $permission['id'] }}">
                            <input type="hidden" name="congregation_id" value="{{ $data['congregation']['id'] }}">
                        </form>
                        <button class="btn btn-outline-success col m-1" type="button" onclick="submitForm('connectForm{{$permission['id']}}')">Подключить</button>
                    @endif
                    <script>
                        function submitForm(formId) {
                            document.getElementById(formId).submit();
                        }
                    </script>
                </div>
                @if($permission['has_permission'])
                    <h3><span class="badge bg-success rounded-4 position-absolute top-0 end-0">Подключен</span></h3>
                @else
                    <h3><span class="badge bg-secondary rounded-4 position-absolute top-0 end-0">Не подключен</span></h3>
                @endif

            </div>
        </div>
        @endforeach
    </div>
</div>

