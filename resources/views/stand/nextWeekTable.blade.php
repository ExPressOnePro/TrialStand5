@extends('layouts.app')
@section('title') Meeper | Таблица @endsection
@section('content')
    @inject('mobile_detect', 'Mobile_Detect')
    @if ($mobile_detect->isMobile())
        <div class="main-content pt-4">
            {{--@role('Developer')
            <div>
                <a href="{{ route('ExampleNext') }}">
                    <button class="btn btn-light m-1" type="button">
                        Кнопка создания таблицы на следующую неделю</button>
                </a>

                <a href="{{ route('ExampleCurrent') }}">
                    <button class="btn btn-light m-1" type="button">
                        Кнопка создания таблицы на текущую неделю</button>
                </a>
            </div>
            @endrole--}}
            <h1 class="headint text-center font-weight-bold">{{ $StandID->name }}</h1>

            @if (session('error'))
                <div class="alert alert-card alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            <div class="row mt-3">
                <div class="col text-left ml-0">
                    <a href="{{ route('currentWeekTable', $StandID->id) }}">
                        <button class="btn btn-outline-info btn-block text-center">Текущая неделя</button>
                    </a>
                </div>
                <div class="col text-right ml-0">
                    <a href="{{ route('nextWeekTable', $StandID->id) }}">
                        <button class="btn btn-info btn-block text-center">Следующая неделя</button>
                    </a>
                </div>
            </div>

            <div class="separator-breadcrumb border-top"></div>

            <div class="row">
                @foreach ($active_day as $actday)
                    <div class="col-md-12 mb-4">
                        <div class="card text-left">
                            <div class="card-body">
                                <div class=" d-flex align-items-center mb-4 mt-4">
                                    <h4 class="card-title mb-3"><i class="fa-regular fa-clipboard text-30 mr-2"></i></h4>
                                    <h5 class="text-18 font-weight-600 card-title m-0">
                                        {{  $dayperweek = \App\Enums\WeekDaysEnum::getWeekDay($actday->day) }}
                                        {{  $gwe = \App\Enums\WeekDaysEnum::getNextWeekDayDate($actday->day) }}
                                    </h5>
                                    <h5 class="text-18 font-weight-700 card-title m-8">
                                        <span class="text-black text-22">{{ $actday->stand }} </span>
                                    </h5>
                                </div>
                                <div class='table-responsive'>
                                    <table class='table table-sm table-hover mb-0'>
                                        <thead>
                                        <tr>
                                            <th class='not-sortable'>Время</th>
                                            <th class='not-sortable'>Возвещатель</th>
                                            <th class='not-sortable'>Возвещатель</th>
                                            <th class='not-sortable'>Редактирование</th>
                                            <th class='not-sortable'>Отчет</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($templates as $template)
                                            @if (

                                                    !empty($template->standPublishers)
                                                    && $template->day === $actday->day
                                                )
                                                @foreach($template->standPublishers as $standPublishers)
                                                    <tr data-id="{{$standPublishers->id}}">

                                                        @if(
                                                         $gwe === date('d.m.Y', strtotime($standPublishers->date))
                                                        && $template->status === '1'
                                                        )
                                                            <th>
                                                                <div class="mt-2">
                                                                    {{ $tempTime = $template->time }}
                                                                </div>
                                                            </th>
                                                            <th>
                                                                @if(
                                                                    is_null($standPublishers->user)
                                                                )
                                                                    <a href="{{ route('PageUpdateRecordStandFirst',
                                                                                    ['id' => $standPublishers->id]
                                                                                    ) }}">
                                                                        <button class="btn btn-success m-1" type="button" >
                                                                            Записаться
                                                                        </button>
                                                                    </a>

                                                                @else
                                                                    <div class="mt-2 ">{{$standPublishers->user->name}}</div>
                                                                @endif
                                                            </th>
                                                            <th>
                                                                @if(
                                                                    is_null($standPublishers->user_2)
                                                                )
                                                                    <a href="{{ route('PageUpdateRecordStandSecond',
                                                                                    ['id' => $standPublishers->id]
                                                                                    ) }}">
                                                                        <button class="btn btn-success m-1" type="button" >
                                                                            Записаться
                                                                        </button>
                                                                    </a>
                                                                @else
                                                                    <div class="mt-2">{{$standPublishers->user2->name}}</div>
                                                                @endif
                                                            </th>
                                                            <th>
                                                                @if(
                                                                    ($standPublishers->user === null)
                                                                    && $standPublishers->user2 === null
                                                                )

                                                                @else
                                                                    <a href="{{ route('recordRedactionPage', ['id' => $standPublishers->id]) }}">
                                                                        <button class="btn btn-outline-primary m-1" type="button">
                                                                            Изменить</button>
                                                                    </a>
                                                                @endif
                                                            </th>
                                                        @endif
                                                    </tr>
                                                @endforeach
                                            @endif
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @elseif ($mobile_detect->isTablet())
        <div class="main-content pt-4">
            {{--@role('Developer')
            <div>
                <a href="{{ route('ExampleNext') }}">
                    <button class="btn btn-light m-1" type="button">
                        Кнопка создания таблицы на следующую неделю</button>
                </a>

                <a href="{{ route('ExampleCurrent') }}">
                    <button class="btn btn-light m-1" type="button">
                        Кнопка создания таблицы на текущую неделю</button>
                </a>
            </div>
            @endrole--}}
            <h1 class="headint text-center font-weight-bold">{{ $StandID->name }}</h1>

            <div class="row mt-3">
                <div class="col text-left ml-0">
                    <a href="{{ route('currentWeekTable', $StandID->id) }}">
                        <button class="btn btn-outline-info btn-block text-center">Текущая неделя</button>
                    </a>
                </div>
                <div class="col text-right ml-0">
                    <a href="{{ route('nextWeekTable', $StandID->id) }}">
                        <button class="btn btn-info btn-block text-center">Следующая неделя</button>
                    </a>
                </div>
            </div>

            <div class="separator-breadcrumb border-top"></div>

            <div class="row">
                @foreach ($active_day as $actday)
                    <div class="col-md-12 mb-4">
                        <div class="card text-left">
                            <div class="card-body">
                                <div class=" d-flex align-items-center mb-4 mt-4">
                                    <h4 class="card-title mb-3"><i class="fa-regular fa-clipboard text-30 mr-2"></i></h4>
                                    <h5 class="text-18 font-weight-600 card-title m-0">
                                        {{  $dayperweek = \App\Enums\WeekDaysEnum::getWeekDay($actday->day) }}
                                        {{  $gwe = \App\Enums\WeekDaysEnum::getNextWeekDayDate($actday->day) }}
                                    </h5>
                                    <h5 class="text-18 font-weight-700 card-title m-8">
                                        <span class="text-black text-22">{{ $actday->stand }} </span>
                                    </h5>
                                </div>
                                <div class='table-responsive'>
                                    <table class='table table-sm table-hover mb-0'>
                                        <thead>
                                        <tr>
                                            <th class='not-sortable'>Время</th>
                                            <th class='not-sortable'>Возвещатель</th>
                                            <th class='not-sortable'>Возвещатель</th>
                                            <th class='not-sortable'>Редактирование</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($templates as $template)
                                            @if (

                                                    !empty($template->standPublishers)
                                                    && $template->day === $actday->day
                                                )
                                                @foreach($template->standPublishers as $standPublishers)
                                                    <tr data-id="{{$standPublishers->id}}">

                                                        @if(
                                                         $gwe === date('d.m.Y', strtotime($standPublishers->date))
                                                        && $template->status === '1'
                                                        )
                                                            <th>
                                                                <div class="mt-2">
                                                                    {{ $tempTime = $template->time }}
                                                                </div>
                                                            </th>
                                                            <th>
                                                                @if(
                                                                    is_null($standPublishers->user)
                                                                )
                                                                    <a href="{{ route('PageUpdateRecordStandFirst',
                                                                                    ['id' => $standPublishers->id]
                                                                                    ) }}">
                                                                        <button class="btn btn-success m-1" type="button" >
                                                                            Записаться
                                                                        </button>
                                                                    </a>

                                                                @else
                                                                    <div class="mt-2 ">{{$standPublishers->user->name}}</div>
                                                                @endif
                                                            </th>
                                                            <th>
                                                                @if(
                                                                    is_null($standPublishers->user_2)
                                                                )
                                                                    <a href="{{ route('PageUpdateRecordStandSecond',
                                                                                    ['id' => $standPublishers->id]
                                                                                    ) }}">
                                                                        <button class="btn btn-success m-1" type="button" >
                                                                            Записаться
                                                                        </button>
                                                                    </a>
                                                                @else
                                                                    <div class="mt-2">{{$standPublishers->user2->name}}</div>
                                                                @endif
                                                            </th>
                                                            <th>
                                                                @if(
                                                                    ($standPublishers->user === null)
                                                                    && $standPublishers->user2 === null
                                                                )

                                                                @else
                                                                    <a href="{{ route('recordRedactionPage', ['id' => $standPublishers->id]) }}">
                                                                        <button class="btn btn-outline-primary m-1" type="button">
                                                                            Изменить</button>
                                                                    </a>
                                                                @endif
                                                            </th>
                                                        @endif
                                                    </tr>
                                                @endforeach
                                            @endif
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @else
        <div class="main-content pt-4">
            {{--@role('Developer')
            <div>
                <a href="{{ route('ExampleNext') }}">
                    <button class="btn btn-light m-1" type="button">
                        Кнопка создания таблицы на следующую неделю</button>
                </a>

                <a href="{{ route('ExampleCurrent') }}">
                    <button class="btn btn-light m-1" type="button">
                        Кнопка создания таблицы на текущую неделю</button>
                </a>
            </div>
            @endrole--}}
            <h1 class="headint text-center font-weight-bold">{{ $StandID->name }}</h1>

            @if (session('error'))
                <div class="alert alert-card alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            <div class="row mt-3">
                <div class="col text-left ml-0">
                    <a href="{{ route('currentWeekTable', $StandID->id) }}">
                        <button class="btn btn-outline-info btn-block text-center">Текущая неделя</button>
                    </a>
                </div>
                <div class="col text-right ml-0">
                    <a href="{{ route('nextWeekTable', $StandID->id) }}">
                        <button class="btn btn-info btn-block text-center">Следующая неделя</button>
                    </a>
                </div>
            </div>

            <div class="separator-breadcrumb border-top"></div>

            <div class="row">
                @foreach ($active_day as $actday)
                    <div class="col-md-12 mb-4">
                        <div class="card text-left">
                            <div class="card-header d-flex align-items-center" style="background: #ebdd9b">
                                <h4 class="card-title mb-3"><i class="fa-regular fa-clipboard text-30 mr-2"></i></h4>
                                <h5 class="text-18 font-weight-600 card-title m-0">
                                    {{  $dayperweek = \App\Enums\WeekDaysEnum::getWeekDay($actday->day) }}
                                    {{  $gwe = \App\Enums\WeekDaysEnum::getNextWeekDayDate($actday->day) }}
                                </h5>
                                <h5 class="text-18 font-weight-700 card-title m-8">
                                    <span class="text-black text-22">{{ $actday->stand }} </span>
                                </h5>
                            </div>
                            <div class="card-body">
                                <div class='table-responsive'>
                                    <table class='table table-sm table-hover mb-0'>
                                        <thead>
                                        <tr>
                                            <th class='not-sortable'>Время</th>
                                            <th class='not-sortable'>Возвещатель</th>
                                            <th class='not-sortable'>Возвещатель</th>
                                            <th class='not-sortable'>Редактирование</th>
                                            <th class='not-sortable'>Отчет</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($templates as $template)
                                            @if (
                                                    !empty($template->standPublishers)
                                                    && $template->day === $actday->day
                                                )
                                                @foreach($template->standPublishers as $standPublishers)
                                                    <tr data-id="{{$standPublishers->id}}">

                                                        @if(
                                                         $gwe === date('d.m.Y', strtotime($standPublishers->date))
                                                        && $template->status === '1'
                                                        )
                                                            <th>
                                                                <div class="mt-2">
                                                                    {{ $tempTime = $template->time }}
                                                                </div>
                                                            </th>
                                                            <th>
                                                                @if(
                                                                    is_null($standPublishers->user)
                                                                )
                                                                    <a href="{{ route('PageUpdateRecordStandFirst',
                                                                                    ['id' => $standPublishers->id]
                                                                                    ) }}">
                                                                        <button class="btn btn-success m-1" type="button" >
                                                                            Записаться
                                                                        </button>
                                                                    </a>

                                                                @else
                                                                    <div class="mt-2 ">{{$standPublishers->user->name}}</div>
                                                                @endif
                                                            </th>
                                                            <th>
                                                                @if(
                                                                    is_null($standPublishers->user_2)
                                                                )
                                                                    <a href="{{ route('PageUpdateRecordStandSecond',
                                                                                    ['id' => $standPublishers->id]
                                                                                    ) }}">
                                                                        <button class="btn btn-success m-1" type="button" >
                                                                            Записаться
                                                                        </button>
                                                                    </a>
                                                                @else
                                                                    <div class="mt-2">{{$standPublishers->user2->name}}</div>
                                                                @endif
                                                            </th>
                                                            <th>
                                                                @if(
                                                                    ($standPublishers->user === null)
                                                                    && $standPublishers->user2 === null
                                                                )

                                                                @else
                                                                    <a href="{{ route('recordRedactionPage', ['id' => $standPublishers->id]) }}">
                                                                        <button class="btn btn-outline-primary m-1" type="button">
                                                                            Изменить</button>
                                                                    </a>
                                                                @endif
                                                            </th>
                                                            <th class="value5">
                                                                @if(
                                                                    ($standPublishers->user === null)
                                                                    && $standPublishers->user2 === null
                                                                )

                                                                @else
                                                                    <a href="{{ route('standReportPage',
                                                                                    ['id' => $standPublishers->id]
                                                                                    ) }}">
                                                                        <button class="btn btn-dark m-1" type="button">
                                                                            Отчет</button>
                                                                    </a>
                                                                @endif
                                                            </th>
                                                        @endif
                                                    </tr>
                                                @endforeach
                                            @endif
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

@endsection
