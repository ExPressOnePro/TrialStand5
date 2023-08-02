@extends('Mobile.layouts.app')
@section('title') Meeper | Мой аккаунт @endsection
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
    <div class="separator-breadcrumb border-top"></div>
    <div class="row">
        <!-- Основная информация пользователя-->
        <div class="col-md-12 mb-4 mt-4 text-center">
            <div class="card card-profile-1 mb-4">
                <div class="card-body text-center">
            <div class="avatar box-shadow-2 mb-3"><img src="../../dist-assets/images/faces/16.jpg" alt=""></div>
            <h5 class="m-0">{{ $user->first_name }} {{ $user->last_name }}</h5>
            <p class="mt-0">{{ $user->Congregation->name }}</p>
            <p class="mt-0">{{ $user->brief_information }}</p>
            <div class="row g-0 mb-2">
                <div class="col text-right text-18">
                    <button class="btn btn-dark" type="button" data-toggle="modal" data-target="#redaction_account">
                        Редактировать профиль
                    </button>
                </div>
                <div class="modal fade mt-5" id="redaction_account" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true" style="display: none;">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">Редактирование</h5>
                                <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                            </div>
                            <div class="modal-body text-left">
                                <form method="post" id="profileBriefSave" action="{{ route('profileBriefSave',$user->id) }}">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-12 form-group mb-3">
                                            <label class="heading" for="brief_information">Краткая информация</label><br>
                                            <input class="form-control" type="text" name="brief_information" id="brief_information" value="{{ $user->brief_information }}">
                                        </div>
                                    </div>
                                </form>
                                <h4 class="text-left text-16">Информация</h4>
                                <div class="card mb-4">

                                    <a class="list-group-item list-group-item-action " href="{{ route('profileEdit', [ 'id' => $user->id]) }}">Личные данные</a>
                                    <a class="list-group-item list-group-item-action" href="{{ route('profileSecurity', [ 'id' => $user->id]) }}">Безопасность</a>
                                    <a class="list-group-item list-group-item-action" href="#">Профиль</a>
                                    <a class="list-group-item list-group-item-action" href="{{ route('profileContacts', [ 'id' => $user->id]) }}">Контакты</a>
                                </div>


                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-secondary text-left" type="button" data-dismiss="modal">Закрыть</button>
                                <a type="button" href="{{ route('profileEditSave', $user->id) }}"
                                   onclick="event.preventDefault();
                                   document.getElementById('profileBriefSave').submit();">
                                    Сохранить настройки
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="separator-breadcrumb border-top"></div>

            <ul class="nav nav-pills text-center" id="myPillTab" role="tablist">
                <li class="nav-item ">
                    <a class="nav-link active show" id="home-icon-pill" data-toggle="pill" href="#reportsPIll" role="tab" aria-controls="homePIll" aria-selected="true">
                        <i class="fa-solid fa-file-invoice"></i>
                        Отчеты
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="profile-icon-pill" data-toggle="pill" href="#profilePIll" role="tab" aria-controls="profilePIll" aria-selected="false">
                        <i class="nav-icon i-Home1 mr-1"></i>
                        Задания
                    </a>
                </li>
            </ul>
            <div class="tab-content" id="myPillTabContent">
                <div class="tab-pane fade active show" id="reportsPIll" role="tabpanel" aria-labelledby="home-icon-pill">
                    <div class="card">
                        <div class="card-body">
                            <div class="col-md-12 text-center mb-2">
                                <button class="btn btn-lg btn-outline-primary btn-rounded btn-block" type="button" data-toggle="modal" data-target="#personalReportModal">Новый отчет</button>
                            </div>
                            <div class="col-md-12 text-center mb-2">
                                <button class="btn btn-lg btn-outline-secondary btn-rounded btn-block collapsed" type="button" data-toggle="collapse" href="#collapse-link-collapsed" aria-expanded="false">Мои отчеты</button>
                                <div class="collapse" id="collapse-link-collapsed">
                                    <ul class="list-group list-group-flush">
                                        <div class="card-body p-0">
                                            <div class="card-title border-bottom d-flex align-items-center m-0 p-3">
                                            </div>
                                            @if(is_null($personalReports))
                                                <h4 class="heading">В этом году вы еще не записывали отчет</h4>
                                            @else
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
                                            @endif
                                        </div>
                                        {{--@foreach ($personalReports as $personalReport)
                                            <li class="list-group-item">
                                                    <div class="d-flex justify-content-between mt-3">
                                                        <h7 class="heading  text-left">{{ $personalReport }}
                                                        </h7>
                                                        <h7 class="heading text-right">

                                                        </h7>
                                                    </div>
                                            </li>
                                        @endforeach--}}
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="tab-pane fade" id="profilePIll" role="tabpanel" aria-labelledby="profile-icon-pill">

                </div>
                <div class="tab-pane fade" id="contactPIll" role="tabpanel" aria-labelledby="contact-icon-pill"></div>
            </div>
            {{--<div class="row g-0 mb-2">
                <div class="col-6 text-left text-18">Логин:</div>
                <div class="col text-right heading text-16">{{ $user->login }}</div>
            </div>
            <div class="row g-0 mb-2">
                <div class="col-6 text-left text-18">Почта:</div>
                <div class="col text-right heading text-15">{{ $user->email }}</div>
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
            <p> Дополнительная информация будет добавляться в зависимости от потребностей </p>--}}
            {{--<button class="btn btn-lg btn-outline-primary btn-rounded btn-block" type="button" data-toggle="modal" data-target="#personalReportModal">Новый отчет</button>

        </div>

        <div class="col-md-4  text-center">
            <button class="btn btn-lg btn-outline-secondary btn-rounded btn-block collapsed" type="button" data-toggle="collapse" href="#collapse-link-collapsed" aria-expanded="false">Мои отчеты</button>
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
                    --}}{{--@foreach ($personalReports as $personalReport)
                        <li class="list-group-item">
                                <div class="d-flex justify-content-between mt-3">
                                    <h7 class="heading  text-left">{{ $personalReport }}
                                    </h7>
                                    <h7 class="heading text-right">

                                    </h7>
                                </div>
                        </li>
                    @endforeach--}}{{--
                </ul>
            </div>
        </div>--}}


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

@endsection
