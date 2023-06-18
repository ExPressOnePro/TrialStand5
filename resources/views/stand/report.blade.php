@extends('layouts.app')
@section('title') Meeper | Отчет стенда @endsection
@section('content')

    <div class="main-content pt-4">
        <div class="separator-breadcrumb border-top"></div>
        <div class="row">
            <div class="col-lg-8 col-md-8 col-xl-8  mb-4 mt-4 offset-md-1">
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="card-body">
                            <div class="card-title heading mb-3">Отчет
                                <span class="text-mute text-right text-16">{{ $StandPublishers->id }}</span>
                            </div>
                            <span class="text-left font-weight-bold text-16">{{ $StandTemplate->Stand->name }}</span><br>
                            <span class="text-left text-16">{{ $StandTemplate->Stand->location }}</span>
                            <div class="separator-breadcrumb border-top"></div>
                            <div class="d-flex justify-content-between mt-3">
                                <div class="flex-grow-1 text-center">
                                    <h5 class="heading">{{ $StandPublishers->date }}</h5>
                                </div>
                                <div class="flex-grow-1 text-center">
                                    <h5 class="heading">{{ $StandTemplate->time }}</h5>
                                </div>
                            </div>
                            <div class="separator-breadcrumb border-top"></div>
                            {{--@foreach($StandReports as $StRep )--}}


                                @if(is_null($StandReports) || $StandReports->StandPublishers_id != $StandPublishers->id)
                                    <!-- Форма создания если отчет новый -->
                                    <form method="POST" action="{{ route('standReportSend', ['id' => $StandPublishers->id] ) }}">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-6 form-group mb-3">
                                                <h6 class="heading" >Публикации (печатные/электронные)</h6>
                                                <input class="form-control form-control-rounded @error('publications') is-invalid @enderror" name="publications" id="publications" type="text" placeholder="количество">
                                                @error('publications')
                                                <div class="alert alert-card alert-danger">Публикации не заполнены</div>
                                                @enderror
                                            </div>
                                            <div class="col-md-6 form-group mb-3">
                                                <h6 class="heading" >Видеоролики</h6>
                                                <input class="form-control form-control-rounded @error('videos') is-invalid @enderror" name="videos" id="videos" type="text" placeholder="количество">
                                                @error('videos')
                                                <div class="alert alert-card alert-danger">Видеоролики не заполнены</div>
                                                @enderror
                                            </div>
                                            <div class="col-md-6 form-group mb-3">
                                                <h6 class="heading">Повторные посещения</h6>
                                                <input class="form-control form-control-rounded @error('return_visits') is-invalid @enderror" name="return_visits" id="return_visits" type="text" placeholder="количество">
                                                @error('return_visits')
                                                <div class="alert alert-card alert-danger">Видео не заполнены</div>
                                                @enderror
                                            </div>
                                            <div class="col-md-6 form-group mb-3">
                                                <h6 class="heading">Изучения Библии</h6>
                                                <input class="form-control form-control-rounded @error('bible_studies') is-invalid @enderror" name="bible_studies" id="bible_studies" type="text" placeholder="количество">
                                                @error('bible_studies')
                                                <div class="alert alert-card alert-danger">Изучения Библии не заполнены</div>
                                                @enderror
                                            </div>
                                            <div class="col-md-12">
                                                <button class="btn btn-success m-1">Подтвердить запись</button>
                                            </div>
                                        </div>
                                    </form>

                                {{--@elseif ($StandPublishers->id != $StRep->StandPublishers_id)
                                    <form method="POST" action="{{ route('standReportSend', ['id' => $StandPublishers->id] ) }}">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-6 form-group mb-3">
                                                <h6 class="heading" >Публикации (печатные/электронные)</h6>
                                                <input class="form-control form-control-rounded @error('publications') is-invalid @enderror" name="publications" id="publications" type="text" placeholder="количество">
                                                @error('publications')
                                                <div class="alert alert-card alert-danger">Публикации не заполнены</div>
                                                @enderror
                                            </div>
                                            <div class="col-md-6 form-group mb-3">
                                                <h6 class="heading" >Видеоролики</h6>
                                                <input class="form-control form-control-rounded @error('videos') is-invalid @enderror" name="videos" id="videos" type="text" placeholder="количество">
                                                @error('videos')
                                                <div class="alert alert-card alert-danger">Видеоролики не заполнены</div>
                                                @enderror
                                            </div>
                                            <div class="col-md-6 form-group mb-3">
                                                <h6 class="heading">Повторные посещения</h6>
                                                <input class="form-control form-control-rounded @error('return_visits') is-invalid @enderror" name="return_visits" id="return_visits" type="text" placeholder="количество">
                                                @error('return_visits')
                                                <div class="alert alert-card alert-danger">Видео не заполнены</div>
                                                @enderror
                                            </div>
                                            <div class="col-md-6 form-group mb-3">
                                                <h6 class="heading">Изучения Библии</h6>
                                                <input class="form-control form-control-rounded @error('bible_studies') is-invalid @enderror" name="bible_studies" id="bible_studies" type="text" placeholder="количество">
                                                @error('bible_studies')
                                                <div class="alert alert-card alert-danger">Изучения Библии не заполнены</div>
                                                @enderror
                                            </div>
                                            <div class="col-md-12">
                                                <button class="btn btn-success m-1">Подтвердить запись</button>
                                            </div>
                                        </div>
                                    </form>--}}
                                @else

                                    <!--  если отчет уже есть но пользователь не того id -->
                                    <form>
                                        <div class="alert alert-warning text-15" role="alert">Отчет уже был отправлен, для измения обратитесь к
                                            <strong class="text-capitalize">{{ $StandReports->User->name }}</strong>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 form-group mb-3">
                                                <h6 class="heading" >Публикации (печатные/электронные)</h6>
                                                <input class="form-control form-control-rounded" name="publications" id="publications" type="text" placeholder="количество" value="{{ $StandReports->publications }}" readonly>
                                            </div>
                                            <div class="col-md-6 form-group mb-3">
                                                <h6 class="heading" >Видеоролики</h6>
                                                <input class="form-control form-control-rounded" name="videos" id="videos" type="text" placeholder="количество" value="{{ $StandReports->videos }}" readonly>
                                            </div>
                                            <div class="col-md-6 form-group mb-3">
                                                <h6 class="heading">Повторные посещения</h6>
                                                <input class="form-control form-control-rounded" name="return_visits" id="return_visits" type="text" placeholder="количество" value="{{ $StandReports->return_visits }}" readonly>
                                            </div>
                                            <div class="col-md-6 form-group mb-3">
                                                <h6 class="heading">Изучения Библии</h6>
                                                <input class="form-control form-control-rounded" name="bible_studies" id="bible_studies" type="text" placeholder="количество" value="{{ $StandReports   ->bible_studies }}" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-12 text-right">
                                            <a class="btn btn-lg btn-success m-1" href="{{ URL::previous() }}">Вернуться назад</a>
                                        </div>
                                    </form>
                                @endif
                            {{--@endforeach--}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
