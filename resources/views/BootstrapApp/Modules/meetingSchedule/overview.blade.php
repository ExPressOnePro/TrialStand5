@extends('BootstrapApp.layouts.bootstrapApp')
@section('title') Meeper @endsection
@section('content')
    <style>
        .my-custom-class.shadow-sm:hover {
            background-color: #e6f7ff;
            transition: background-color 0.3s ease;
            transform: scale(1.05);
        }

        .my-custom-class.shadow-sm {
            transition: transform 0.3s ease;
        }
    </style>
    <style>
        .meeting-card {
            border: 1px solid #dee2e6;
            border-radius: 8px;
            overflow: hidden;
            transition: transform 0.3s ease, background-color 0.3s ease;
        }

        .meeting-card:hover {
            background-color: #e6f7ff;
            transform: scale(1.05);
        }

        .meeting-card-body {
            padding: 20px;
        }

        .meeting-day {
            font-size: 1.5rem;
            font-weight: bold;
            margin-bottom: 0.5rem;
        }

        .meeting-date {
            font-size: 1.2rem;
            color: #6c757d;
            margin-bottom: 1rem;
        }

        .meeting-type {
            font-size: 1.2rem;
            font-weight: bold;
        }
    </style>
    <div class="content container-fluid">
        <div class="row">
        <aside class="col-lg-2 d-none d-lg-block sticky-xl-top text-body-secondary align-self-start" style="top: 6rem;">
            <div class="list-group list-group-flush rounded-2">
                <a href="#" class="list-group-item list-group-item-action lh-sm mb-1 shadow-sm" aria-current="true">
                    <div class="d-flex w-100 align-items-center justify-content-between">
                        <strong class="mb-1">Обзор</strong>
                    </div>
                </a>
                <a href="{{ route('congregation.publishers', $congregation->id) }}" class="list-group-item list-group-item-action lh-sm mb-1 shadow-sm" aria-current="true">
                    <div class="d-flex w-100 align-items-center justify-content-between">
                        <strong class="mb-1">Возвещатели</strong>
                    </div>
                </a>
                <a href="{{ route('congregation.stands', $congregation->id) }}" class="list-group-item list-group-item-action lh-sm mb-1 shadow-sm" aria-current="true">
                    <div class="d-flex w-100 align-items-center justify-content-between">
                        <strong class="mb-1">Стенд (ы)</strong>
                    </div>
                </a>
                <a href="{{ route('meetingSchedules.overview', $congregation->id) }}" class="list-group-item list-group-item-action lh-sm mb-1 shadow-sm" aria-current="true">
                    <div class="d-flex w-100 align-items-center justify-content-between">
                        <strong class="mb-1">Расписание встреч</strong>
                    </div>
                </a>
                <a href="{{ route('congregation.modules', $congregation->id) }}" class="list-group-item list-group-item-action lh-sm mb-1 shadow-sm" aria-current="true">
                    <div class="d-flex w-100 align-items-center justify-content-between">
                        <strong class="mb-1">Модули</strong>
                    </div>
                </a>
                <a href="#" class="list-group-item list-group-item-action lh-sm mb-1 shadow-sm" aria-current="true">
                    <div class="d-flex w-100 align-items-center justify-content-between">
                        <strong class="mb-1">Настройки</strong>
                    </div>
                </a>
            </div>
        </aside>
        <div class="col-lg-10 col-md-12 col-sm-12">
            <div class="mb-3">
                <h3>Расписания встреч собрания</h3>
            </div>
            <div class="row mb-2">
{{--                <div class="col-md-4">--}}
{{--                    <div class="row my-custom-class g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">--}}
{{--                        <div class="col p-4 d-flex flex-column position-static">--}}
{{--                            <div class="d-flex justify-content-between">--}}
{{--                                <h3>{{ __('text.' . $weekday) }}</h3>--}}
{{--                                <h3>{{$dateForGivenWeekday}}</h3>--}}
{{--                            </div>--}}
{{--                            <div class="list-group-item">--}}
{{--                                <div class="row align-items-center border-bottom">--}}
{{--                                    <div class="col">--}}
{{--                                        <h5>Время встречи:</h5>--}}
{{--                                    </div>--}}
{{--                                    <div class="col-auto">--}}
{{--                                        <h5 class="bg-soft-primary p-2">{{$weekdayTime}}</h5>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="row align-items-center">--}}
{{--                                    <div class="col">--}}
{{--                                        <h5>Неделя</h5>--}}
{{--                                    </div>--}}
{{--                                    <div class="col-auto">--}}
{{--                                        <h5 class="bg-soft-primary p-2">--}}
{{--                                            {{ \Carbon\Carbon::parse($resp->start_of_week)->format('d') }} ---}}
{{--                                            {{ \Carbon\Carbon::parse($resp->end_of_week)->format('d.m.Y') }}</h5>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
                @foreach($resp as $rees)
                <div class="col-md-4">
                    <a class="card meeting-card shadow text-decoration-none" href="{{route('meetingSchedules.overview', $congregation->id)}}">
                        <div class="card-body meeting-card-body">
                            <div class="meeting-day">{{ __('text.' . $weekday) }}  {{$weekdayTime}}</div>
                            <div class="meeting-date">{{$formattedDate}}</div>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
        </div>
{{--        <div class="col-lg-10 col-md-12 col-sm-12 mx-auto">--}}
{{--            <div class="row card mb-4">--}}
{{--                <h3>22—28 ЯНВАРЯ</h3>--}}
{{--                <div class="col-md-12 d-none d-md-block">--}}
{{--                    <table class="table table-responsive-sm table-bordered table-sm table-warning lh-sm">--}}
{{--                        <tbody>--}}
{{--                        @foreach($array['responsible_users'] as $key => $value)--}}
{{--                            @if ($loop->odd)--}}
{{--                                <tr>--}}
{{--                                    @endif--}}

{{--                                    <td><span>{{ $value['name'] }}</span></td>--}}
{{--                                    <td><span>{{ $value['value'] }}</span></td>--}}

{{--                                    @if ($loop->even || $loop->last)--}}
{{--                                </tr>create--}}
{{--                            @endif--}}
{{--                        @endforeach--}}
{{--                        </tbody>--}}
{{--                    </table>--}}
{{--                </div>--}}
{{--                <div class="col-sm-12 d-sm-none">--}}
{{--                    <table class="table table-responsive-sm table-bordered table-sm table-warning lh-sm">--}}
{{--                        <tbody>--}}
{{--                        @foreach($array['responsible_users'] as $key => $value)--}}
{{--                            <tr>--}}
{{--                                <td><span>{{ $value['name'] }}</span></td>--}}
{{--                                <td><span>{{ $value['value'] }}</span></td>--}}
{{--                            </tr>--}}
{{--                        @endforeach--}}
{{--                        </tbody>--}}
{{--                    </table>--}}
{{--                </div>--}}

{{--                <div class="d-flex justify-content-between">--}}
{{--                    <div class="col">--}}
{{--                        <h6><i class="bi bi-music-note-beamed"></i> Песня 147 и молитва | Вступительные слова (1 мин.)</h6>--}}
{{--                    </div>--}}
{{--                    <div class="col-auto">Головенко Владислав</div>--}}
{{--                </div>--}}
{{--                <div>--}}
{{--                    <h4 class="pb-1 mb-1 d-flex align-items-center" style="color: #2A6B77">--}}
{{--                        <div class="icon-square d-flex align-items-center justify-content-center fs-4 flex-shrink-0 me-3 p-2 rounded-2" style="background-color: #2A6B77; width: 1.5em; height: 1.5em;">--}}
{{--                            <img class="rounded-2" src="{{ asset('front/img/gem.svg') }}" style="width: 1.5em; height: 1.5em;">--}}
{{--                        </div>--}}
{{--                        СОКРОВИЩА ИЗ СЛОВА БОГА--}}
{{--                    </h4>--}}
{{--                    @foreach($array['treasures'] as $key => $value)--}}
{{--                    <div class="d-flex justify-content-between align-items-center border-bottom">--}}
{{--                        <div class="col">--}}
{{--                            <h6 style="color: #2A6B77">--}}
{{--                                {{ $value['name'] }}--}}
{{--                            </h6>--}}
{{--                        </div>--}}
{{--                        <div class="col-auto">--}}
{{--                            <h6 class="text-muted">--}}
{{--                                {{ $value['value'] }}--}}
{{--                            </h6>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    @endforeach--}}
{{--                </div>--}}
{{--                <div>--}}
{{--                    <h4 class="pb-1 mb-1 d-flex align-items-center" style="color: #D68F00">--}}
{{--                        <div class="icon-square d-flex align-items-center justify-content-center fs-4 flex-shrink-0 me-3 p-2 rounded-2" style="background-color: #D68F00; width: 1.5em; height: 1.5em;">--}}
{{--                            <img class="rounded-2" src="{{ asset('front/img/wheat.svg') }}" style="width: 1.5em; height: 1.5em;">--}}
{{--                        </div>--}}
{{--                        ОТТАЧИВАЕМ НАВЫКИ СЛУЖЕНИЯ--}}
{{--                    </h4>--}}
{{--                    @foreach($array['field_ministry'] as $key => $value)--}}
{{--                        <div class="d-flex justify-content-between align-items-center border-bottom">--}}
{{--                            <div class="col">--}}
{{--                                <h6 style="color: #D68F00">--}}
{{--                                    {{ $value['name'] }}--}}
{{--                                </h6>--}}
{{--                            </div>--}}
{{--                            <div class="col-auto d-sm-none">--}}
{{--                                <h6 class="text-muted">{{ $value['value1'] }} @if(isset($value['value2'])) <br> {{ $value['value2'] }}@endif</h6>--}}
{{--                            </div>--}}
{{--                            <div class="col-auto d-none d-md-block">--}}
{{--                                <h6 class="text-muted">{{ $value['value1'] }} @if(isset($value['value2'])) | {{ $value['value2'] }}@endif</h6>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    @endforeach--}}
{{--                </div>--}}
{{--                <div class="d-flex justify-content-between">--}}
{{--                    <div class="col">--}}
{{--                        <h6><i class="bi bi-music-note-beamed"></i> Песня 147</h6>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div>--}}
{{--                    <h4 class="pb-1 mb-3 d-flex align-items-center" style="color: #BF2F13">--}}
{{--                        <div class="icon-square d-flex align-items-center justify-content-center fs-4 flex-shrink-0 me-3 p-2 rounded-2" style="background-color: #BF2F13; width: 1.5em; height: 1.5em;">--}}
{{--                                                        <i class="fa fa-wheat-awn" style="color: #ffffff"></i>--}}
{{--                            <img class="rounded-2" src="{{ asset('front/img/sheep.svg') }}" style="width: 1.5em; height: 1.5em;">--}}
{{--                        </div>--}}
{{--                        ХРИСТИАНСКАЯ ЖИЗНЬ--}}
{{--                    </h4>--}}
{{--                    @foreach($array['living'] as $key => $value)--}}
{{--                        <div class="d-flex justify-content-between align-items-center border-bottom">--}}
{{--                            <div class="col">--}}
{{--                                <h6 style="color: #BF2F13">--}}
{{--                                    {{ $value['name'] }}--}}
{{--                                </h6>--}}
{{--                            </div>--}}
{{--                            <div class="col-auto">--}}
{{--                                <h6 class="text-muted">{{ $value['value1'] }} @if(isset($value['value2'])) | {{ $value['value2'] }}@endif</h6>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    @endforeach--}}
{{--                </div>--}}
{{--                <div class="d-flex justify-content-between">--}}
{{--                    <div class="col">--}}
{{--                        <h6><i class="bi bi-music-note-beamed"></i> Песня 147 и молитва </h6>--}}
{{--                    </div>--}}
{{--                    <div class="col-auto">Головенко Владислав</div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="row card pb-4 ">--}}
{{--                <h3 class="pb-1">--}}
{{--                    22—28 ЯНВАРЯ--}}
{{--                </h3>--}}
{{--                <table class="table table-bordered table-sm table-warning lh-sm">--}}
{{--                    <tbody>--}}
{{--                    <tr>--}}
{{--                        <td>Распорядитель улица</td>--}}
{{--                        <td>Головенко Владислав</td>--}}
{{--                        <td>Аппаратура</td>--}}
{{--                        <td>Головенко Владислав</td>--}}
{{--                    </tr>--}}
{{--                    <tr>--}}
{{--                        <td>Распорядитель фое</td>--}}
{{--                        <td>Головенко Владислав</td>--}}
{{--                        <td>Zoom</td>--}}
{{--                        <td>Головенко Владислав</td>--}}
{{--                    </tr>--}}
{{--                    <tr>--}}
{{--                        <td>Распорядитель зал</td>--}}
{{--                        <td>Головенко Владислав</td>--}}
{{--                        <td>Микрофон 1</td>--}}
{{--                        <td>Головенко Владислав</td>--}}
{{--                    </tr>--}}
{{--                    <tr>--}}
{{--                        <td>Распорядитель сцена</td>--}}
{{--                        <td>Головенко Владислав</td>--}}
{{--                        <td>Микрофон 2</td>--}}
{{--                        <td>Головенко Владислав</td>--}}
{{--                    </tr>--}}
{{--                    </tbody>--}}
{{--                </table>--}}
{{--                <h4 class="pb-1 mb-3 border-bottom align-items-center border-bottom" style="color: #86BFCA">--}}
{{--                    Публичная Речь--}}
{{--                </h4>--}}
{{--                <h4 class="pb-1 mb-3 align-items-center border-bottom" style="color: #132464">--}}
{{--                    Статья для изучения 47 (15—21 января 2024)--}}
{{--                </h4>--}}
{{--                <span>8 Не давайте остыть своей любви к братьям и сёстрам</span>--}}
{{--            </div>--}}
{{--        </div>--}}
    </div>
@endsection
