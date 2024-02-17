<div class="row">
    <div class="card col-4">
        <div class="card-up aqua-gradient"></div>
        <div class="avatar mx-auto white mt-4">
            <i class="fa-regular fa-circle-user fa-5x"></i>
        </div>
        <div class="card-body text-center">
            <h4 class="card-title font-weight-bold">Martha Smith</h4>
            <button class="btn btn-outline-primary"> Написать</button>
            <button class="btn btn-outline-secondary"> Позвонить</button>
            <hr>
{{--            <p><i class="fas fa-quote-left"></i> Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eos,--}}
{{--                adipisci</p>--}}
        </div>
        <p class="h6">Логин: </p>
        <p class="h6">Email: </p>
        <p class="h6">Телефон: </p>
    </div>
</div>

<div class="row p-4 p-md-5 mb-4 rounded text-body-emphasis bg-body-secondary">
    <div class="col-md-6">
        <h1 class="">{{$congregation->name}}</h1>
        <h3 class="text-muted mb-0">Время встреч собрания:</h3>
        @if($congregation_info === null)
            <button class="btn btn-outline-primary col" data-bs-toggle="modal" data-bs-target="#timeDay">
                Изменить
            </button>
        @else
            <p class="h5">{{$congregation_info}}
                <button class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#timeDay">
                    <i class="fa fa-pencil"></i>
                </button>
            </p>
        @endif
        <div class="modal fade" id="timeDay" tabindex="-1" aria-labelledby="exampleModalLabel" style="display: none;" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="timeDayLabel">Изменение номера дня недели и времени</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body row">
                        <div class="col-md-12">
                            <h4>Будний день</h4>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="weekdaySelect">Выберите день недели:</label>
                            <select class="form-control" id="weekdaySelect">
                                <option value="1">Понедельник</option>
                                <option value="2">Вторник</option>
                                <option value="3">Среда</option>
                                <option value="4">Четверг</option>
                                <option value="5">Пятница</option>
                                <option value="6">Суббота</option>
                                <option value="7">Воскресенье</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="weekdayTimeInput">Время:</label>
                            <input type="time" class="form-control" id="weekdayTimeInput">
                        </div>
                        <div class="col-md-12">
                            <h4>Выходной день</h4>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="weekendSelect">Выберите день недели:</label>
                            <select class="form-control" id="weekendSelect">
                                <option value="1">Понедельник</option>
                                <option value="2">Вторник</option>
                                <option value="3">Среда</option>
                                <option value="4">Четверг</option>
                                <option value="5">Пятница</option>
                                <option value="6">Суббота</option>
                                <option value="7">Воскресенье</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="weekendTimeInput">Время:</label>
                            <input type="time" class="form-control" id="weekendTimeInput">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                        <button type="button" class="btn btn-primary" onclick="saveData()">Сохранить</button>
                    </div>
                </div>
            </div>
        </div>
        <script>
            function saveData() {
                var weekday = $('#weekdaySelect').val();
                var weekdayTime = $('#weekdayTimeInput').val();
                var weekend = $('#weekendSelect').val();
                var weekendTime = $('#weekendTimeInput').val();

                var data = {
                    weekdayTime: weekdayTime,
                    weekendTime: weekendTime,
                    weekday: weekday,
                    weekend: weekend
                };

                $.ajax({
                    url: '{{ route('congregation.saveDateTimeForMeetings', $congregation->id)}}',
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: data,
                    success: function(response) {
                        console.log('Данные успешно сохранены:', response);
                        $('#timeDay').modal('hide');
                        location.reload();
                    },
                    error: function(xhr) {
                        console.error('Ошибка при сохранении данных:', xhr.responseText);
                    }
                });
            }
        </script>
    </div>
    <div class="col-md-6">
        <h4>Дополнительно</h4>
        @foreach($metrics as $metric)
        <h5 class="text-muted mb-0"><strong class="mb-0"> {{ $metric['count'] }}</strong> {{ $metric['title'] }}</h5>
        @endforeach
    </div>
</div>

<style>
    .grlight {
        position: relative;
        overflow: hidden;
        cursor: pointer;
    }

    .grlight:after {
        content: "";
        display: block;
        position: absolute;
        background: rgba(0, 0, 0, 0.15);
        width: 100%;
        height: 100%;
        top: 0;
        left: 0;
        pointer-events: none;
        opacity: 0;
        transform: scale(0);
        transition: opacity 0.3s, transform 0.3s;
    }

    .grlight:hover:after {
        opacity: 1;
        transform: scale(5);
    }
</style>

<div class="row mb-5">
    @can('congregation.open_meetings_users')
        <div class="col-lg-4 my-1">
            <a class="card grlight rounded-4 text-decoration-none" href="{{$route_publishers}}">
                <i class="fas fa-users fa-5x text-center p-3"></i>
                <div class="card-body text-center">
                    <h4 class="card-title">Возвещатели</h4>
                    <p class="card-text">Управляйте пользователями</p>
                </div>
            </a>
        </div>
    @endcan
    @can('congregation.add_module')
        <div class="col-lg-4 my-1">
            <a class="card grlight rounded-4 text-decoration-none" href="{{ route('congregation.modules', $congregation->id) }}">
                <i class="fa-solid fa-network-wired fa-5x text-center p-3"></i>
                <div class="card-body text-center">
                    <h4 class="card-title">Модули</h4>
                    <p class="card-text">Управляйте дополнениями собрания</p>
                </div>
            </a>
        </div>
    @endcan
    @can('module.stand')
        <div class="col-lg-4 my-1">
            <a class="card grlight rounded-4 text-decoration-none align-items-center" href="{{ route('congregation.stands', $congregation->id) }}">
                <img src="{{asset('images/svg/stand.svg')}}" class="p-3" width="115">
                <div class="card-body text-center">
                    <h4 class="card-title">Стенд</h4>
                    <p class="card-text">Управляйте стендами собрания</p>
                </div>
            </a>
        </div>
    @endcan
    @can('module.schedule')
        <div class="col-lg-4 my-1">
            <a class="card grlight rounded-4 text-decoration-none" href="{{ route('meetingSchedules.overview', $congregation->id) }}">
                <i class="fa-solid fa-clipboard-list fa-5x text-center p-3"></i>
                <div class="card-body text-center">
                    <h4 class="card-title">Расписания</h4>
                    <p class="card-text">Управляйте расписаниями встреч</p>
                </div>
            </a>
        </div>
    @endcan
    {{--    @can('congregation.change_settings')--}}
    {{--        <div class="col-lg-4 my-1">--}}
    {{--            <a class="card grlight rounded-4 text-decoration-none" href="#">--}}
    {{--                <i class="fa-solid fa-gears fa-5x text-center p-3"></i>--}}
    {{--                <div class="card-body text-center">--}}
    {{--                    <h4 class="card-title">Настройки</h4>--}}
    {{--                    <p class="card-text">Изменяйте настройки собрания</p>--}}
    {{--                </div>--}}
    {{--            </a>--}}
    {{--        </div>--}}
    {{--    @endcan--}}
{{--    @foreach($metrics as $metric)--}}
{{--        <div class="col-6 mb-3 mb-lg-3">--}}
{{--            <div class="card h-100 border-left-empty rounded-3 text-decoration-none shadow">--}}
{{--                <div class="card-body d-flex justify-content-between align-items-center">--}}
{{--                    <div class="flex-grow-1 my-3">--}}
{{--                        <a class="text-decoration-none" href="{{ $metric['route'] }}">--}}
{{--                            <h4 class="fw-bold mb-0 text-body-emphasis">{{ $metric['title'] }}</h4>--}}
{{--                            <p class="m-0">{{$metric['count']}}</p>--}}
{{--                        </a>--}}
{{--                    </div>--}}
{{--                    @can('stand.settings')--}}
{{--                        <div class="dropdown">--}}
{{--                            <button type="button" class="btn btn-ghost-secondary btn-icon btn-sm card-dropdown-btn rounded-circle" id="projectsListDropdown3" data-bs-toggle="dropdown" aria-expanded="false">--}}
{{--                                <i class="fa-solid fa-ellipsis-vertical"></i>--}}
{{--                            </button>--}}
{{--                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="projectsListDropdown3">--}}
{{--                                @can('stand.settings')--}}
{{--                                    <a class="dropdown-item" href="{{ route('stand.settings', $asfu->id) }}">{{ __('text.Настройки') }}</a>--}}
{{--                                @endcan--}}
{{--                                @can('stand.history')--}}
{{--                                    <a class="dropdown-item" href="{{ route('stand.history', $asfu->id) }}">{{ __('text.История') }}</a>--}}
{{--                                @endcan--}}
{{--                                <div class="dropdown-divider"></div>--}}
{{--                                 <a class="dropdown-item text-danger" href="#">Delete</a> --}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    @endcan--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    @endforeach--}}
</div>
