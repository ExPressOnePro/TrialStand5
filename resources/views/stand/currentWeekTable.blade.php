@extends('layouts.app')
@section('title') Meeper | Таблица @endsection
@section('content')
    @inject('mobile_detect', 'Mobile_Detect')
    @if ($mobile_detect->isMobile())
        {{--@can('Open stand')--}}
            <div class="main-content pt-4">
            @role('Developer')
            <div>
                <a href="{{ route('ExampleNext') }}">
                    <button class="btn btn-light m-1" type="button">
                        Создать таблицу на следующую неделю</button>
                </a>

                <a href="{{ route('ExampleCurrent') }}">
                    <button class="btn btn-light m-1" type="button">
                        Создать таблицу на текущую неделю</button>
                </a>
            </div>
            @endrole
            <h1 class="headint text-center font-weight-bold">{{ $StandID->name }}</h1>
                <h3 class="headint text-center font-weight-bold">{{ $StandID->location }}</h3>
            @if (session('error'))
                <div class="alert alert-card alert-danger">
                    {{ session('error') }}
                </div>
            @endif
                @if (session('success'))
                    <div class="alert alert-card alert-success">
                        {{ session('success') }}
                    </div>
                @endif

            <div class="row mt-3">
                <div class="col text-left ml-0">
                    <a href="{{ route('currentWeekTable', $StandID->id) }}">
                        <button class="btn btn-info btn-block text-center">Текущая неделя</button>
                    </a>
                </div>
                <div class="col text-right ml-0">
                    <a href="{{ route('nextWeekTable', $StandID->id) }}">
                        <button class="btn btn-outline-info btn-block text-center">Следующая неделя</button>
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
                                    {{  $gwe = \App\Enums\WeekDaysEnum::getWeekDayDate($actday->day) }}
                                </h5>
                                <h5 class="text-18 font-weight-700 card-title m-8">
                                    <span class="text-black text-22">{{ $actday->stand }} </span>
                                </h5>
                            </div>
                            <div class="card-body">
                                {{--<div class="card-header d-flex align-items-center mb-4 mt-4" style="background: #d8d8c1">
                                    <h4 class="card-title mb-3"><i class="fa-regular fa-clipboard text-30 mr-2"></i></h4>
                                    <h5 class="text-18 font-weight-600 card-title m-0">
                                        {{  $dayperweek = \App\Enums\WeekDaysEnum::getWeekDay($actday->day) }}
                                        {{  $gwe = \App\Enums\WeekDaysEnum::getWeekDayDate($actday->day) }}
                                    </h5>
                                    <h5 class="text-18 font-weight-700 card-title m-8">
                                        <span class="text-black text-22">{{ $actday->stand }} </span>
                                    </h5>
                                </div>--}}
                                <div class='table-responsive'>
                                        <table class='table table-sm table-hover mb-0'>
                                            <thead>
                                            <tr>
                                                <th class='not-sortable'>Время</th>
                                                <th class='not-sortable'>Возвещатель</th>
                                                <th class='not-sortable'>Возвещатель</th>
                                                <th class='not-sortable'>Изменения</th>
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
                                                                            <button class="btn btn-primary m-1" type="button">
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
        {{--@endcan--}}
    @elseif ($mobile_detect->isTablet())
        <div class="main-content pt-4">
            @role('Developer')
            <div>
                <a href="{{ route('ExampleNext') }}">
                    <button class="btn btn-light m-1" type="button">
                        Создать таблицу на следующую неделю</button>
                </a>

                <a href="{{ route('ExampleCurrent') }}">
                    <button class="btn btn-light m-1" type="button">
                        Создать таблицу на текущую неделю</button>
                </a>
            </div>
            @endrole
            <h1 class="headint text-center font-weight-bold">{{ $StandID->name }}</h1>

            @if (session('error'))
                <div class="alert alert-card alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            <div class="row mt-3">
                <div class="col text-left ml-0">
                    <a href="{{ route('currentWeekTable', $StandID->id) }}">
                        <button class="btn btn-info btn-block text-center">Текущая неделя</button>
                    </a>
                </div>
                <div class="col text-right ml-0">
                    <a href="{{ route('nextWeekTable', $StandID->id) }}">
                        <button class="btn btn-outline-info btn-block text-center">Следующая неделя</button>
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
                                        {{  $gwe = \App\Enums\WeekDaysEnum::getWeekDayDate($actday->day) }}
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
    @else
        <div class="main-content pt-4">
            @role('Developer')
            <div>
                <a href="{{ route('ExampleNext') }}">
                    <button class="btn btn-light m-1" type="button">
                        Создать таблицу на следующую неделю</button>
                </a>
                <a href="{{ route('ExampleCurrent') }}">
                    <button class="btn btn-light m-1" type="button">
                        Создать таблицу на текущую неделю</button>
                </a>
                <a href="{{ route('ExampleUpdateCurrentNext', $StandID->id) }}">
                    <button class="btn btn-light m-1" type="button">
                        Обновить Current-Next</button>
                </a>
            </div>
            @endrole
            <h1 class="headint text-center font-weight-bold">{{ $StandID->name }}</h1>

            @if (session('error'))
                <div class="alert alert-card alert-danger">
                    {{ session('error') }}
                </div>
            @endif
            <div class="row mt-3">
                <div class="col text-left ml-0">
                    <a href="{{ route('currentWeekTable', $StandID->id) }}">
                        <button class="btn btn-info btn-block text-center">Текущая неделя</button>
                    </a>
                </div>
                <div class="col text-right ml-0">
                    <a href="{{ route('nextWeekTable', $StandID->id) }}">
                        <button class="btn btn-outline-info btn-block text-center">Следующая неделя</button>
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
                                    {{  $gwe = \App\Enums\WeekDaysEnum::getWeekDayDate($actday->day) }}
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
                                            <th class='not-sortable'>Изменения</th>
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
                                                                        <button class="btn btn-primary m-1" type="button">
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

    <div class="modal fade" id="record1" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle-2" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle-2">Ежемесячный отчет</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>

                <div class="modal-body">
                    <form id="report" method="POST" action="{{ route('personalReport') }}">
                        @csrf
                        <div class="d-flex flex-column">

                            <!-- Month -->
                            <div class="form-group mb-3">
                                <h4 class="heading" >Месяц</h4>
                                <select class="form-control form-control-rounded" name="month">
                                    <option value="1">{{ __('text.January') }}</option>
                                    <option value="2">{{ __('text.February') }}</option>
                                    <option value="3">{{ __('text.March') }}</option>
                                    <option value="4">{{ __('text.April') }}</option>
                                    <option value="5">{{ __('text.May') }}</option>
                                    <option value="6">{{ __('text.June') }}</option>
                                    <option value="7">{{ __('text.July') }}</option>
                                    <option value="8">{{ __('text.August') }}</option>
                                    <option value="9">{{ __('text.September') }}</option>
                                    <option value="10">{{ __('text.October') }}</option>
                                    <option value="11">{{ __('text.November') }}</option>
                                    <option value="12">{{ __('text.December') }}</option>
                                </select>
                            </div>
                            <!-- Hours -->
                            <div class="form-group mb-3">
                                <h4 class="heading" >Часы</h4>
                                <input class="form-control form-control-rounded @error('hours') is-invalid @enderror" name="hours" id="publications" type="text" value="0">
                                @error('hours')
                                <div class="alert alert-card alert-danger">Часы не заполнены</div>
                                @enderror
                            </div>
                            <!-- Publications -->
                            <div class="form-group mb-3">
                                <h5 class="heading" >Публикации (печатные/электронные)</h5>
                                <input class="form-control form-control-rounded @error('publications') is-invalid @enderror" name="publications" id="publications" type="text" value="0">
                                @error('publications')
                                <div class="alert alert-card alert-danger">Публикации не заполнены</div>
                                @enderror
                            </div>
                            <!-- Videos -->
                            <div class="form-group mb-3">
                                <h4 class="heading" >Видеоролики</h4>
                                <input class="form-control form-control-rounded @error('videos') is-invalid @enderror" name="videos" id="videos" type="text" value="0">
                                @error('videos')
                                <div class="alert alert-card alert-danger">Видеоролики не заполнены</div>
                                @enderror
                            </div>
                            <!-- return visits -->
                            <div class="form-group mb-3">
                                <h4 class="heading">Повторные посещения</h4>
                                <input class="form-control form-control-rounded @error('return_visits') is-invalid @enderror" name="return_visits" id="return_visits" type="text" value="0">
                                @error('return_visits')
                                <div class="alert alert-card alert-danger">Видео не заполнены</div>
                                @enderror
                            </div>
                            <!-- bible studies -->
                            <div class="form-group mb-3">
                                <h4 class="heading">Изучения Библии</h4>
                                <input class="form-control form-control-rounded @error('bible_studies') is-invalid @enderror" name="bible_studies" id="bible_studies" type="text" value="0">
                                @error('bible_studies')
                                <div class="alert alert-card alert-danger">Изучения Библии не заполнены</div>
                                @enderror
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Закрыть</button>
                    <a href="{{ route('personalReport') }}"
                       onclick="event.preventDefault();
                                   document.getElementById('report').submit();">
                        <button class="btn btn-success" type="submit" >Отправить</button>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script src="../../dist-assets/js/plugins/toastr.min.js"></script>
    <script src="../../dist-assets/js/scripts/toastr.script.min.js"></script>

@endsection
