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
                <div class="col-9 text-left">
                    <a class="btn btn-outline text-dark btn-rounded text-25" href="{{ URL::previous() }}">
                        <i class="fa-solid fa-arrow-left"></i>
                    </a>
                    <span class="heading text-20 text-center ml-2">
                        Контакты
                    </span>
                </div>
                <div class="col-2 text-right">
                    <a class="btn btn-outline text-right text-success btn-rounded text-25" type="button" id="edit" href="{{ route('profileContactsSave', $user->id) }}"
                       onclick="event.preventDefault();
                                   document.getElementById('profileContactsSave').submit();">
                        <i class="fa-solid fa-check"></i>
                    </a>
                </div>

            </div>
        </header>
        <div class="row">
            <!-- Основная информация пользователя-->
            <div class="col-md-12 text-left mb-2">
                <div class="card">
                    <div class="card-body text-left">
                        <p class="heading mt-0"><strong class="text-20">Контактные данные</strong><br> увидят другие пользователи</p>
                    </div>
                </div>
            </div>
            <div class="col-md-12 mb-2">
                <div class="card">
                    <div class="card-body">
                    <form method="post" id="profileContactsSave" action="{{ route('profileContactsSave',$user->id) }}">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 form-group mb-3">
                                <label for="city">Город</label>
                                <input class="form-control" type="text" id="city" name="city" placeholder="Укажите город" value="{{ $user->city }}">
                            </div>
                            <div class="col-md-6 form-group mb-3">
                                <label for="mobile_phone">Номер телефона</label>
                                <input class="form-control" id="mobile_phone" name="mobile_phone" type="text" placeholder="Номер телефона" value="{{ $user->mobile_phone }}">
                            </div>
                            <div class="col-md-6 form-group mb-3">
                                <label for="additional_phone">Дополнительный телефон</label>
                                <input class="form-control" id="additional_phone" name="additional_phone" type="text" placeholder="Доп. телефон" value="{{ $user->addition_phone }}">
                            </div>
                            <div class="col-md-6 form-group mb-3">
                                <label for="login">Языки</label>
                                <input class="form-control" id="languages" name="languages" placeholder="Языки" value="{{ $user->languages }}">
                            </div>
                        </div>
                    </form>
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
                </div>
    @endif

@endsection
