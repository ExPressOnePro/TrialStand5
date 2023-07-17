@extends('layouts.edit')
@section('title') Meeper | Личные Данные @endsection
@section('content')

    @inject('mobile_detect', 'Mobile_Detect')
    @if ($mobile_detect->isMobile())

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
        <header class="text-center position m-2 ">
            <div class="row text-center">
                <div class="col-2 text-left">
                    <a class="btn btn-outline text-dark btn-rounded text-25" href="{{ URL::previous() }}">
                        <i class="fa-solid fa-arrow-left"></i>
                    </a>
                </div>
                <div class="col-8 text-center mt-2">
                    <h2 class="heading text-20 text-center">
                        Безопасность и вход
                    </h2>
                </div>
                <div class="col-2 text-center">
                </div>
            </div>
        </header>
        <div class="row">
            <!-- Основная информация пользователя-->
            <div class="col-md-12 text-left mb-2">
                <div class="card">
                    <div class="card-body text-left">
                        <p class="heading mt-0"><strong class="text-20">Данные аккаунта</strong><br> видны только вам</p>
                    </div>
                </div>
            </div>
            <div class="col-md-12 mb-2">
                <div class="card">
                    <div class="card-body">
                        <a class="text-default" href="">
                            <button class="btn btn-block btn-secondary rounded text-left">
                                <h5 class="heading mb-0">
                                    Основная почта<br>
                                </h5>
                                <span class="text-muted">{{ $user->email }}</span>
                            </button>
                        </a>
                    </div>
                        {{--<form method="post" id="profileEdit" action="{{ route('profileEditSave',$user->id) }}">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 form-group mb-3">
                                    <label for="first_name">Основная почта</label>
                                    <input class="form-control" id="first_name" name="first_name" type="text" placeholder="Ваша почта" value="{{ $user->first_name }}">
                                </div>
                                <div class="col-md-12 card-header">
                                    <a class="text-default"  href="">
                                        <button class="btn btn-block btn-secondary">
                                            <h6 class="heading text-left mb-0">
                                                Основная почта<br>
                                                <span class="text-muted">{{ $user->email }}</span>
                                            </h6>
                                        </button>
                                    </a>
                                </div>
                                <div class="col-md-6 form-group mb-3">
                                    <label for="last_name">Фамилия</label>
                                    <input class="form-control" id="last_name" name="last_name" type="text" placeholder="Ваша фамилия" value="{{ $user->last_name }}">
                                </div>
                                <div class="col-md-6 form-group mb-3">
                                    <label for="gender">Пол</label>
                                    <select class="form-control" id="gender" name="gender">
                                        <option value="1">Мужской</option>
                                        <option value="2">Женский</option>
                                    </select>
                                </div>
                                <div class="col-md-6 form-group mb-3">
                                    <label for="birthday">Дата рождения</label>
                                    <input class="form-control" type="date" id="birthday" name="birthday" placeholder="Выберите дату" value="{{ $user->birthday }}">
                                </div>
                                <div class="col-md-6 form-group mb-3">
                                    <label for="login">Login</label>
                                    <input class="form-control" id="login" name="login" placeholder="Никнейм" value="{{ $user->login }}">
                                </div>
                            </div>
                        </form>--}}
                </div>
            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <a class="text-default"  href="">
                            <button class="btn btn-block btn-secondary rounded">
                                <h6 class="heading text-left mb-0">
                                    Пароль<br>
                                    <span class="text-muted">{{ $user->password }}</span>
                                </h6>
                            </button>
                        </a>
                    </div>
                    {{--<form method="post" id="profileEdit" action="{{ route('profileEditSave',$user->id) }}">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 form-group mb-3">
                                <label for="first_name">Основная почта</label>
                                <input class="form-control" id="first_name" name="first_name" type="text" placeholder="Ваша почта" value="{{ $user->first_name }}">
                            </div>
                            <div class="col-md-12 card-header">
                                <a class="text-default"  href="">
                                    <button class="btn btn-block btn-secondary">
                                        <h6 class="heading text-left mb-0">
                                            Основная почта<br>
                                            <span class="text-muted">{{ $user->email }}</span>
                                        </h6>
                                    </button>
                                </a>
                            </div>
                            <div class="col-md-6 form-group mb-3">
                                <label for="last_name">Фамилия</label>
                                <input class="form-control" id="last_name" name="last_name" type="text" placeholder="Ваша фамилия" value="{{ $user->last_name }}">
                            </div>
                            <div class="col-md-6 form-group mb-3">
                                <label for="gender">Пол</label>
                                <select class="form-control" id="gender" name="gender">
                                    <option value="1">Мужской</option>
                                    <option value="2">Женский</option>
                                </select>
                            </div>
                            <div class="col-md-6 form-group mb-3">
                                <label for="birthday">Дата рождения</label>
                                <input class="form-control" type="date" id="birthday" name="birthday" placeholder="Выберите дату" value="{{ $user->birthday }}">
                            </div>
                            <div class="col-md-6 form-group mb-3">
                                <label for="login">Login</label>
                                <input class="form-control" id="login" name="login" placeholder="Никнейм" value="{{ $user->login }}">
                            </div>
                        </div>
                    </form>--}}
                </div>
            </div>



            @elseif ($mobile_detect->isTablet())
                <div class="main-content pt-4">
                    @role('Developer')
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
                    @endrole
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
                    <div class="separator-breadcrumb border-top"></div>
                    <div class="row">
                        <!-- Основная информация пользователя-->
                        <div class="col-md-4">
                            <div class="card card-profile-1 mb-4">
                                <div class="card-body text-center">
                                    <div class="avatar box-shadow-2 mb-3"><img src="../../dist-assets/images/faces/16.jpg" alt=""></div>
                                    <h5 class="m-0">{{ $user->first_name }} {{ $user->last_name }}</h5>
                                    <p class="mt-0">{{ $user->Congregation->name }}</p>
                                    <div class="row g-0 mb-2">
                                        <div class="col text-right text-18">
                                            <button class="btn btn-outline-dark">Редактировать профиль</button>
                                        </div>
                                    </div>
                                    <div class="separator-breadcrumb border-top"></div>
                                    <div class="row g-0 mb-2">
                                        <div class="col-6 text-left text-18">Логин:</div>
                                        <div class="col text-right heading text-16">{{ $user->login }}</div>
                                    </div>
                                    <div class="row g-0 mb-2">
                                        <div class="col-6 text-left text-18">Почта:</div>
                                        <div class="col text-right heading text-16">{{ $user->email }}</div>
                                    </div>
                                    <div class="row g-0 mb-2">
                                        <div class="col-6 text-left text-18">Моб. телефон:</div>
                                        <div class="col text-right heading text-16">{{ $user->mobile_phone }}
                                            <button class="btn btn-outline-success btn-icon" onclick="callNumber({{ $user->mobile_phone }})">
                                                                        <span class="ul-btn__icon">
                                                                            <i class="fa-solid fa-phone"></i>
                                                                        </span>
                                            </button>
                                        </div>

                                    </div>
                                    <div class="row g-0 mb-2">
                                        <div class="col-6 text-left text-18">Доп. телефон:</div>
                                        <div class="col text-right heading text-16">{{ $user->additional_phone }}
                                            <button class="btn btn-outline-success btn-icon" onclick="callNumber({{ $user->additional_phone }})">
                                                                        <span class="ul-btn__icon">
                                                                            <i class="fa-solid fa-phone"></i>
                                                                        </span>
                                            </button>
                                        </div>
                                    </div>

                                    <p> Дополнительная информация будет добавляться в зависимости от потребностей </p>
                                    <button class="btn btn-outline-primary btn-rounded">Дополнительно</button>
                                    <div class="card-socials-simple mt-4">
                                        <a href=""><i class="i-Linkedin-2"></i></a>
                                        <a href=""><i class="i-Facebook-2"></i></a>
                                        <a href=""><i class="i-Twitter"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="card mb-4">
                                <div class="card-header">Будущие разработки</div>
                                <div class="card-body">
                                    <h5 class="card-title">Card title text</h5>
                                    <p class="card-text">With supporting text below as a natural lead-in to additional content.</p><a class="btn btn-primary btn-rounded" href="#">Go somewhere</a>
                                </div>
                            </div>
                        </div>
                        <!-- Доступные вам сервисы-->
                        <div class="col-md-4">
                            <div class="card card-icon mb-4">
                                <div class="card-header">
                                    <i class="fa-solid fa-passport float-left text-40 text-primary"></i>
                                    <h3 class="float-center text-center">Доступно</h3>
                                </div>
                                <div class="card-body text-center">
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item">
                                            <div class="d-flex justify-content-between mt-3">
                                                <h7 class="heading  text-left">
                                                    Сдать новый отчет
                                                </h7>
                                                <h7 class="heading text-right">
                                                    <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#personalReportModal">
                                                        Новый отчет
                                                    </button>
                                                </h7>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="card card-body ml-0">
                                <div class="text-center">
                                    <h5 class="card-title heading text-center">Ежемесячные отчеты</h5>
                                    <p class="mb-3 text-muted">Чтобы просмотреть свои отчеты - нажмите нопку</p>
                                    <a class="btn btn-primary collapsed" data-toggle="collapse" href="#collapse-link-collapsed" aria-expanded="false">
                                        Детальнее
                                    </a>
                                </div>

                                <div class="collapse" id="collapse-link-collapsed">
                                    <ul class="list-group list-group-flush">
                                        <div class="card-body p-0">
                                            <div class="card-title border-bottom d-flex align-items-center m-0 p-3">
                                            </div>
                                            @foreach ($personalReports as $personalReport)
                                                <div class="d-flex border-bottom justify-content-between p-3">
                                                    <div class="flex-grow-1">
                                                        <div class="d-flex justify-content-between">
                                                            <span class="text-small text-muted">Месяц</span>

                                                            <h5 class="m-0">{{ \Carbon\Carbon::createFromDate(null, $personalReport->month, null)->format('F') }}</h5>
                                                        </div>
                                                        <div class="d-flex justify-content-between">
                                                            <span class="text-small text-muted">Часы</span>
                                                            <h5 class="m-0">{{ $personalReport->hours }}</h5>
                                                        </div>
                                                        <div class="d-flex justify-content-between">
                                                            <span class="text-small text-muted">Публикации</span>
                                                            <h5 class="m-0">{{ $personalReport->publications }}</h5>
                                                        </div>
                                                        <div class="d-flex justify-content-between">
                                                            <span class="text-small text-muted">Видео</span>
                                                            <h5 class="m-0">{{ $personalReport->videos }}</h5>
                                                        </div>
                                                        <div class="d-flex justify-content-between">
                                                            <span class="text-small text-muted">Повторные</span>
                                                            <h5 class="m-0">{{ $personalReport->return_visits }}</h5>
                                                        </div>
                                                        <div class="d-flex justify-content-between">
                                                            <span class="text-small text-muted">Изучения</span>
                                                            <h5 class="m-0">{{ $personalReport->bible_studies }}</h5>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                        @foreach ($personalReports as $personalReport)
                                            <li class="list-group-item">
                                                <div class="d-flex justify-content-between mt-3">
                                                    <h7 class="heading  text-left">{{ $personalReport }}
                                                    </h7>
                                                    <h7 class="heading text-right">

                                                    </h7>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>


                        <div class="modal fade" id="personalReportModal" tabindex="-1" role="dialog" aria-labelledby="personalReportModal-2" style="display: none;" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="personalReportModal-2">Ежемесячный отчет</h5>
                                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>

                                    <div class="modal-body">
                                        <form id="personalReport" method="POST" action="{{ route('personalReport') }}">
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
                                                    <input class="form-control form-control-rounded @error('hours') is-invalid @enderror" name="hours" id="hours" type="text" value="0">
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
                                        <button class="btn btn-secondary" type="submit" data-dismiss="modal">Закрыть</button>
                                        <a class="btn btn-success" type="button" href="{{ route('personalReport') }}"
                                           onclick="event.preventDefault();
                                    document.getElementById('personalReport').submit();">
                                            Отправить
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
    @endif

@endsection
