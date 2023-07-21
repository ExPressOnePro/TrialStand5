@extends('layouts.app')
@section('title') Meeper | Мой аккаунт @endsection
@section('content')

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
        <div class="row">
            <!-- Основная информация пользователя-->
            <div class="col-md-4">
                <div class="card card-profile-1 mb-4">
                    <div class="card-body text-center">
                        <div class="avatar box-shadow-2 mb-3"><img src="../../dist-assets/images/faces/16.jpg" alt=""></div>
                        <h5 class="m-0">{{ $user->name }}</h5>
                        <p class="mt-0">{{ $user->Congregation->name }}</p>
                        <div class="row g-0 mb-2">
                            <div class="col text-left text-18">Логин:</div>
                            <div class="col text-left heading text-16">{{ $user->login }}</div>
                        </div>
                        <div class="row g-0 mb-2">
                            <div class="col text-left text-18">Почта:</div>
                            <div class="col text-left heading text-16">{{ $user->email }}</div>
                        </div>
                        <p> Дополнительная информация будет добавляться в зависимости от потребностей </p>
                        <button class="btn btn-outline-primary btn-rounded">Дополнительно</button>
                        {{--<div class="card-socials-simple mt-4">
                            <a href=""><i class="i-Linkedin-2"></i></a>
                            <a href=""><i class="i-Facebook-2"></i></a>
                            <a href=""><i class="i-Twitter"></i></a>
                        </div>--}}
                    </div>
                </div>
                {{--<div class="card mb-4">
                    <div class="card-header">Будущие разработки</div>
                    <div class="card-body">
                        <h5 class="card-title">Card title text</h5>
                        <p class="card-text">With supporting text below as a natural lead-in to additional content.</p><a class="btn btn-primary btn-rounded" href="#">Go somewhere</a>
                    </div>
                </div>--}}
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
                        <p class="mb-3 text-muted">Чтобы просмотреть записи - нажмите нопку</p>
                        <a class="btn btn-primary collapsed" data-toggle="collapse" href="#collapse-link-collapsed" aria-expanded="false">
                            Детальнее
                        </a>
                    </div>

                    <div class="collapse" id="collapse-link-collapsed">
                        <ul class="list-group list-group-flush">
                            <div class="card-body p-0">
                                <div class="card-title border-bottom d-flex align-items-center m-0 p-3"><span>User activity</span><span class="flex-grow-1"></span><span class="badge badge-pill badge-warning">Updated daily</span></div>
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



            <div class="modal fade" id="personalReportModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle-2" style="display: none;" aria-hidden="true">
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
                                {{--<button class="btn btn-success">Отправить</button>--}}
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary" type="submit" data-dismiss="modal">Закрыть</button>
                            <a class="btn btn-success" type="button" href="{{ route('personalReport') }}"
                               onclick="event.preventDefault();
                                    document.getElementById('report').submit();">
                                Отправить
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
