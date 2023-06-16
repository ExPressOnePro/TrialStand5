@extends('layouts.app')
@section('title') Meeper | Отчет @endsection
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
                            <form method="POST" action="{{ route('standReportSend', $StandPublishers->id) }}">
                                @csrf
                                @if($StandReports->StandPublishers_id == $StandPublishers->id)
                                    уже отправили отчет
                                @else
                                <div class="row">
                                    <div class="col-md-6 form-group mb-3">
                                        <h6 class="heading" >Публикации (печатные/электронные)</h6>
                                        <input class="form-control form-control-rounded" name="publications" id="publications" type="text" placeholder="количество">
                                    </div>
                                    <div class="col-md-6 form-group mb-3">
                                        <h6 class="heading" >Видеоролики</h6>
                                        <input class="form-control form-control-rounded" name="videos" id="videos" type="text" placeholder="количество">
                                    </div>
                                    <div class="col-md-6 form-group mb-3">
                                        <h6 class="heading">Повторные посещения</h6>
                                        <input class="form-control form-control-rounded" name="return_visits" id="return_visits" type="text" placeholder="количество">
                                    </div>
                                    <div class="col-md-6 form-group mb-3">
                                        <h6 class="heading">Изучения Библии</h6>
                                        <input class="form-control form-control-rounded" name="bible_studies" id="bible_studies" type="text" placeholder="количество">
                                    </div>
                                    <div class="col-md-12">
                                        <button class="btn btn-success m-1">Подтвердить запись</button>
                                    </div>
                                </div>
                                    @endif
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
