@extends('layouts.app')
@section('title') Meeper | Главная @endsection
@section('content')

    <div class="main-content pt-4">
        <!-- Manager section where allow or denied new user -->
        @role('Manager')
        @if($congregationRequestsCount > 0)
            <div class="alert alert-success" role="alert">
                <strong class="text-capitalize">Запрос! </strong>
                <strong class="text-20">{{$congregationRequestsCount}}</strong>
                пользователь(ей) хотят присоединиться к вашему собранию!
                <button class="close" type="button" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                <a class="btn btn-info text-right" href="{{ route('congregationView', $user_congregation_id) }}" >
                    Детальнее
                </a>
            </div>
        @else
        @endif
        @endrole
        <div class="separator-breadcrumb border-top"></div>
        <!-- CARD ICON-->

        <!-- Welcome-->
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="card mb-4">
                    <div class="card-body">
                        <h3 class="card-header-pills heading text-center text-primary">Добро пожаловать в Meeper</h3>
                        <p class="card-text heading text-center">На главной странице вы увидите основную информацию</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Stand section-->
        @if($standPublishersCount > 0)
            <div class="row">
                <div class="col-md-6 mb-3">
                    <div class="card card-body ml-0">
                        <div class="text-center">
                            <h5 class="card-title heading text-center">Вы записаны на стенд <strong class="text-capitalize">{{ $standPublishersCount }}</strong> раз</h5>
                            <p class="mb-3 text-muted">Чтобы просмотреть записи - нажмите нопку</p>
                            <a class="btn btn-primary collapsed" data-toggle="collapse" href="#collapse-link-collapsed" aria-expanded="false">
                                Детальнее
                            </a>
                        </div>

                        <div class="collapse" id="collapse-link-collapsed">
                            <ul class="list-group list-group-flush">
                                @foreach ($standPublishers as $publisher)
                                    <li class="list-group-item">
                                        @foreach ($publisher->standTemplates as $standTemplate)
                                            <div class="d-flex justify-content-between mt-3">
                                                <h7 class="heading  text-left">
                                                    {{ \App\Enums\WeekDaysEnum::getWeekDay($standTemplate->day) }}
                                                    <br>
                                                    {{ $standTemplate->Stand->location }}
                                                </h7>
                                                <h7 class="heading text-right">
                                                    {{ $publisher->date }}
                                                    <br>
                                                    Время: {{ $standTemplate->time }}
                                                </h7>
                                            </div>
                                        @endforeach
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                @else

                    <div class="col-md-6 mb-3">
                        <div class="card card-body ml-0">
                            <div class="text-center">
                                <h5 class="card-title heading text-center">Вы не записаны на стенд на этой и следующей неделе</h5>
                            </div>
                        </div>
                    </div>
            </div>
        @endif

</div>
@endsection
