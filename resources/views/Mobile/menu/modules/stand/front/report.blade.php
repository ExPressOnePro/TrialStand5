@extends('Mobile.layouts.front.stand')
@section('title') Meeper | отчет @endsection
@section('content')

    <div class="content container-fluid">
            <div class="card card-hover-shadow mt-4">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-2">
                        <div class="flex-grow-1">
                            <form id="report" method="POST" action="{{ route('standReportSend', $standPublisher->id) }}">
                                @csrf
                                <h3 class="alert-heading mb-1">Информация об отчете</h3>
                                <p class="mb-0">Дата:  {{ $standPublisher->date }}</p>

                                <select class="js-select form-select mb-3" autocomplete="off" name="time" id="">
                                    @foreach($standPublisherTimes as $standPublisherTime)
                                        <option>Выберите время </option>
                                        <option value="{{$standPublisherTime->time}}" required>
                                            {{ date('H:i', strtotime($standPublisherTime->time . ':00')) }}
                                        </option>
                                    @endforeach
                                </select>
                                <input type="hidden" name="day" id="day" value="{{$standPublisher->day }}">
                                <input type="hidden" name="date" id="date" value="{{$standPublisher->date }}">
                                <input type="hidden" name="time" id="time" value="{{$standPublisher->time }}">
                                <div class="d-flex flex-column">
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
                                <div class="row">
                                    <div class="col-12">
                                        <button class="btn btn-primary" type="submit">Отправить отчет</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
    </div>
@endsection
