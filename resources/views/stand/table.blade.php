@extends('layouts.app')
@section('title')Stand | таблица@endsection
@section('content')
    @if(session('success'))
        <div class="alert alert-card alert-success" role="alert"><strong class="text-capitalize">Успешно</strong>
            <button class="close" type="button" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
            {{ session('success') }}
        </div>
        <div class="swal2-modal swal2-hide" style="display: none; width: 500px; padding: 20px; background: rgb(255, 255, 255);" tabindex="-1"><ul class="swal2-progresssteps" style="display: none;"></ul><div class="swal2-icon swal2-error" style="display: none;"><span class="x-mark"><span class="line left"></span><span class="line right"></span></span></div><div class="swal2-icon swal2-question" style="display: none;">?</div><div class="swal2-icon swal2-warning" style="display: none;">!</div><div class="swal2-icon swal2-info" style="display: none;">i</div><div class="swal2-icon swal2-success" style="display: none;"><span class="line tip"></span> <span class="line long"></span><div class="placeholder"></div> <div class="fix"></div></div><img class="swal2-image" style="display: none;"><h2>Auto close alert!</h2><div class="swal2-content" style="display: block;">I will close in <strong>2</strong> seconds.</div><input style="display: none;" class="swal2-input"><input type="file" style="display: none;" class="swal2-file"><div class="swal2-range" style="display: none;"><output></output><input type="range"></div><select style="display: none;" class="swal2-select"></select><div class="swal2-radio" style="display: none;"></div><label for="swal2-checkbox" class="swal2-checkbox" style="display: none;"><input type="checkbox"></label><textarea style="display: none;" class="swal2-textarea"></textarea><div class="swal2-validationerror" style="display: none;"></div><hr class="swal2-spacer" style="display: block;"><button type="button" class="swal2-confirm swal2-styled" style="background-color: rgb(48, 133, 214); border-left-color: rgb(48, 133, 214); border-right-color: rgb(48, 133, 214);">OK</button><button type="button" class="swal2-cancel swal2-styled" style="display: none; background-color: rgb(170, 170, 170);">Cancel</button><span class="swal2-close" style="display: none;">×</span></div>
    @endif

    <div class="main-content pt-4">
    <div class="breadcrumb">
        <h1 class="mr-2">Стенд</h1>
        <ul>
            <li><a href="">страница</a></li>
            <li></li>
        </ul>
    </div>
        <a href="{{ route('test') }}">
            <button class="btn btn-success m-1" type="button">
                тест</button>
        </a>
        <a href="{{ route('ExampleNext') }}">
            <button class="btn btn-danger m-1" type="button">
                Кнопка создания таблицы на следующую неделю</button>
        </a>

        <a href="{{ route('ExampleCurrent') }}">
            <button class="btn btn-success m-1" type="button">
                Кнопка создания таблицы на текущую неделю</button>
        </a>

    <div class="separator-breadcrumb border-top"></div>
        <div class="row">
            <div class="col-lg-8 col-md-8 col-xl-8  mb-4 mt-4 offset-md-1">
                <div class="col ul-widget__head ">
                    <div class="ul-widget__head-toolbar">
                        <ul class="nav nav-tabs nav-tabs-line nav-tabs-bold ul-widget-nav-tabs-line" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active show" data-toggle="tab" href="#__g-widget4-tab1-content" role="tab" aria-selected="true">Текущая неделя</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#__g-widget4-tab2-content" role="tab" aria-selected="false">Следующая неделя</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="ul-widget__body">
                    <div class="tab-content">
                        <div class="tab-pane active show" id="__g-widget4-tab1-content">
                            <div class="ul-widget1">
                                @foreach ($active_day as $actday)
                                    <div class='card o-hidden col-md-12 mb-4'>
                                        <div class="d-flex align-items-center mb-4 mt-4"><i class="i-ID-Card text-30 mr-2"></i>
                                            <h5 class="text-18 font-weight-600 card-title m-0">
                                                {{  $dayperweek = \App\Enums\WeekDaysEnum::getWeekDay($actday->day) }}
                                                {{  $gwe = \App\Enums\WeekDaysEnum::getWeekDayDate($actday->day) }}
                                            </h5>
                                            <h5 class="text-18 font-weight-700 card-title m-8">
                                                <span class="text-black text-22">{{ $actday->stand }} </span>
                                            </h5>
                                        </div>
                                        <div class='card-body pa-0'>
                                            <div class='table-wrap'>
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
                                                                    <tr class="elem">
                                                                        @if(
                                                                        $gwe === date('d.m.Y', strtotime($standPublishers->date))
                                                                        && $template->status === '1'
                                                                        && $template->type === 'current'
                                                                        )
                                                                            <th class="value1">
                                                                                <div class="mt-2">
                                                                                    <span class="text">{{ $tepm = $template->time }}</span>
                                                                                </div>
                                                                            </th>
                                                                            <th class="value2">
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
                                                                            <th class="value3">
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
                                                                            <th class="value4">
                                                                                @if(
                                                                                    ($standPublishers->user === null)
                                                                                    && $standPublishers->user2 === null
                                                                                )

                                                                                @else
                                                                                    <a href="{{ route('recordRedactionPage',
                                                                                    ['id' => $standPublishers->id]
                                                                                    ) }}">
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
                        <div class="tab-pane" id="__g-widget4-tab2-content">
                            <div class="ul-widget1">
                                @foreach ($active_day as $actday)
                                    <div class='card o-hidden col-md-12 mb-4'>
                                        <div class="d-flex align-items-center mb-4 mt-4"><i class="i-ID-Card text-30 mr-2"></i>
                                            <h5 class="text-18 font-weight-600 card-title m-0">
                                                {{  $dayperweek = \App\Enums\WeekDaysEnum::getWeekDay($actday->day) }}
                                                {{  $gwe = \App\Enums\WeekDaysEnum::getNextWeekDayDate($actday->day) }}
                                            </h5>
                                            <h5 class="text-18 font-weight-700 card-title m-8">
                                                <span class="text-black text-22">{{ $actday->stand }} </span>
                                            </h5>
                                        </div>
                                        <div class='card-body pa-0'>
                                            <div class='table-wrap'>
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
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
