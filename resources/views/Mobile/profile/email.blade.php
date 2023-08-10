@extends('layouts.edit')
@section('title') Meeper | Личные Данные @endsection
@section('content')
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
            <div class="d-flex justify-content-between ">
                <div class="text-left">
                    <a class="btn btn-outline text-dark btn-rounded text-25" href="{{ URL::previous() }}">
                        <i class="fa-solid fa-arrow-left"></i>
                    </a>
                </div>
                <div>
                    <h2 class="heading text-20">
                        Личные данные
                    </h2>
                </div>
                <div class="text-right">
                    <a class="btn btn-outline text-right text-success btn-rounded text-25" type="button" id="edit" href="{{ route('profileEditSave', $user->id) }}"
                       onclick="event.preventDefault();
                                   document.getElementById('profileEdit').submit();">
                        <i class="fa-solid fa-check"></i>
                    </a>
                </div>
            </div>
        </header>
        <div class="row">
            <!-- Основная информация пользователя-->
            <div class="col-md-12 text-left">
                <div class="card card-profile-1 mb-4">
                    <div class="card-body text-left">
                        <div class="avatar box-shadow-2 mb-3"><img src="../../dist-assets/images/faces/16.jpg" alt=""></div>
                        <h5 class="m-0">{{ $user->first_name }} {{ $user->last_name }}</h5>
                        <p class="mt-0">ID:{{ $user->id }}</p>
                        <p class="mt-0">{{ $user->Congregation->name }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <form method="post" id="profileEdit" action="{{ route('profileEditSave',$user->id) }}">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 form-group mb-3">
                                    <label for="first_name">Имя</label>
                                    <input class="form-control" id="first_name" name="first_name" type="text" placeholder="Ваше имя" value="{{ $user->first_name }}">
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
                        </form>
                    </div>
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

@endsection
