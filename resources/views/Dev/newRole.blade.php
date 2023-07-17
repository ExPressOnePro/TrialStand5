@extends('layouts.app')
@section('title') Meeper | Новая роль @endsection
@section('content')

    <div class="main-content pt-4">
        <div class="separator-breadcrumb border-top"></div>
        <div class="row">
            <div class="card mb-4">
                <div class="card-body">
                    <div class="card-title mb-3">Новая роль</div>
                    <form method="POST" action="{{ route('createNewRole') }}">
                        @csrf
                        <div class="row">
                            <div class="col-md-12 form-group mb-3">
                                <label for="name">Роль</label>
                                <input class="form-control form-control-rounded @error('name') is-invalid @enderror" id="name" type="text" name="name" placeholder="Введите название Роли">
                            </div>
                            <div class="col-md-6">
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                @enderror
                            </div>
                            <div class="col-md-12 form-group mb-3">
                                <label for="location">Сокращение</label>
                                <input class="form-control form-control-rounded  @error('slug') is-invalid @enderror" name="slug" id="slug" type="text" placeholder="Введите сокращение роли">
                            </div>
                            <div class="col-md-6">
                                @error('slug')
                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                @enderror
                            </div>
                            <div class="col-md-12">
                                <button class="btn btn-primary">Создать</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        @foreach ($templates as $template)
            <div class='d-flex align-items-center justify-content-between mt-40 mb-20'>
                <h4>
                     fix date week
                    {{ \App\Enums\WeekDaysEnum::getWeekDay($template->day) }}
                    {{ \App\Enums\WeekDaysEnum::getWeekDayDate($template->day) }}
                    <span> "{{ $template->stand->name }}" </span>
                </h4>
            </div>

            <div class='card'>
                <div class='card-body pa-0'>
                    <div class='table-wrap'>
                        <div class='table-responsive'>
                            <table class='table table-sm table-hover mb-0'>
                                <thead>
                                <tr>
                                    <th class='not-sortable'>Время</th>
                                    <th class='not-sortable'>Возвещатель</th>
                                    <th class='not-sortable'>Возвещатель</th>
                                    <th class='not-sortable'>Отчет</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($template->times_range as $time_range)
                                    @if (!empty($template->standPublishers->toArray()))
                                        <tr>
                                            <th>{{ $time_range }}</th>
                                            @foreach($template->standPublishers as $standPublishers)
                                                @if(
                                                    isset($standPublishers->user)
                                                    && $time_range === $standPublishers->time
                                                )
                                                    <th class="text-center">{{$standPublishers->user->name}}</th>
                                                    <th class="text-center">{{$standPublishers->user2->name}}</th>
                                                    <th>-</th>
                                                    <th>
                                                        <a href="">
                                                            <button class="btn btn-outline-warning m-1" type="button">
                                                                Редактировать</button>
                                                        </a></th>
                                                @else
                                                    <th>
                                                        <a href="{{ route('recToStand', $time_range) }}">
                                                            <button class="btn btn-success m-1" type="button">
                                                                Записаться</button>
                                                        </a>
                                                    </th>
                                                    <th>
                                                        <a href="">
                                                            <button class="btn btn-success m-1" type="button">
                                                                Записаться</button>
                                                        </a>
                                                    </th>
                                                    <th>-</th>
                                                    <th>-</th>
                                                @endif
                                            @endforeach
                                        </tr>
                                    @else
                                        <tr>
                                            <th>{{ $time_range }}</th>
                                            <th>-</th>
                                            <th>-</th>
                                            <th>-</th>
                                            <th>-</th>
                                        </tr>
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


@endsection
