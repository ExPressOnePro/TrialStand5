@extends('Mobile.layouts.front.profile')
@section('title') Meeper | Мой аккаунт @endsection
@section('content')
    @include('Mobile.includes.headers.header-profile-reports')
    @include('Mobile.includes.alerts.alerts')

    @php
        $currentYear = now()->year;
        $previousYear = $currentYear - 1;
        $nextYear = $currentYear + 1;

        $currentMonth = now()->month;
                                        $previousMonth = $currentMonth - 1;
                                        if ($previousMonth == 0) {
                                            $previousMonth = 12;
                                        }
    @endphp

    @can('module.reports')
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Новый отчет</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="NewStand" method="POST" action="{{ route('personalReport') }}">
                            @csrf
                            <div class="row d-flex justify-content-between align-items-center">
                                <div class="col d-flex justify-content-start mb-1 mt-1">
                                    <select class="form-control" id="year" name="year">
                                        <option value="{{ $previousYear }}">{{ $previousYear }}</option>
                                        <option value="{{ $currentYear }}" selected>{{ $currentYear }}</option>
                                        <option value="{{ $nextYear }}">{{ $nextYear }}</option>
                                    </select>
                                </div>
                                <div class="col-auto d-flex justify-content-end mb-1 mt-1">
                                    <select class="form-control" id="month" name="month">
                                        <option value="1" {{ $previousMonth == 1 ? 'selected' : '' }}>Январь</option>
                                        <option value="2" {{ $previousMonth == 2 ? 'selected' : '' }}>Февраль</option>
                                        <option value="3" {{ $previousMonth == 3 ? 'selected' : '' }}>Март</option>
                                        <option value="4" {{ $previousMonth == 4 ? 'selected' : '' }}>Апрель</option>
                                        <option value="5" {{ $previousMonth == 5 ? 'selected' : '' }}>Май</option>
                                        <option value="6" {{ $previousMonth == 6 ? 'selected' : '' }}>Июнь</option>
                                        <option value="7" {{ $previousMonth == 7 ? 'selected' : '' }}>Июль</option>
                                        <option value="8" {{ $previousMonth == 8 ? 'selected' : '' }}>Август</option>
                                        <option value="9" {{ $previousMonth == 9 ? 'selected' : '' }}>Сентябрь</option>
                                        <option value="10" {{ $previousMonth == 10 ? 'selected' : '' }}>Октябрь</option>
                                        <option value="11" {{ $previousMonth == 11 ? 'selected' : '' }}>Ноябрь</option>
                                        <option value="12" {{ $previousMonth == 12 ? 'selected' : '' }}>Декабрь</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 form-group mt-7 mb-3">
                                    <input class="form-control form-control" name="hours" id="hours" type="number" step="1" pattern="\d+" placeholder="Введите количество часов" required>
                                </div>
                                <div class="col-md-12 form-group mb-3">
                                    <input class="form-control form-control" name="publications" id="publications" type="number" step="1" pattern="\d+" placeholder="Публикации (печатные/электронные)" required>
                                </div>
                                <div class="col-md-12 form-group mb-3">
                                    <input class="form-control form-control" name="videos" id="videos" type="number" step="1" pattern="\d+" placeholder="Видеоролики" required>
                                </div>
                                <div class="col-md-12 form-group mb-3">
                                    <input class="form-control form-control" name="return_visits" id="return_visits" type="number" step="1" pattern="\d+" placeholder="Повторные посещения" required>
                                </div>
                                <div class="col-md-12 form-group mb-3">
                                    <input class="form-control form-control" name="bible_studies" id="bible_studies" type="number" step="1" pattern="\d+" placeholder="Изучения Библии" required>
                                </div>

                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">закрыть</button>
                        <a class="btn btn-success" type="button" href="{{ route('personalReport') }}"
                           onclick="event.preventDefault();
                                    document.getElementById('NewStand').submit();">
                            Создать
                        </a>

                    </div>
                </div>
            </div>
        </div>
    @endcan

    <div class="content container-fluid">
        @can('module.reports')
            <div class="row mb-4">
                <div class="col-12">
                    <div class="d-grid gap-2">
                        <button type="button" class="btn btn-primary btn-lg" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            Новый отчет
                        </button>
                    </div>
                </div>
            </div>
        @endcan
        <div class="row justify-content-lg-center">
            <div class="col-lg-9">
                <div class="d-grid gap-3 gap-lg-5">
                    <div class="card">
                        <div class="card-header">
                            <li class="d-flex justify-content-end align-items-center fs-6">
                                <select class="form-control" id="yearSelect">
                                    <option>Выберите Год</option>
                                    @foreach ($years as $year)
                                        <option value="{{ $year }}">{{ $year }}</option>
                                    @endforeach
                                </select>
                            </li>
                        </div>
                        <div class="card-body" id="monthsContainer">
                            <ul class="list-group">
                                <div class="col-sm-auto align-self-sm-end">
                                    <div class="row d-flex justify-content-between align-items-center border-bottom">
                                        <div class="col d-flex justify-content-start mb-1 mt-1">
                                            <h5 class="text-inherit mb-0 me-3">${title}</h5>
                                        </div>
                                        <div class="col-auto d-flex justify-content-end mb-1 mt-1">
                                            <dd class="text-body mb-0">
                                                ${value}
                                            </dd>
                                        </div>
                                    </div>
                                </div>
                                <!-- Здесь будут отображаться месяцы и данные -->
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('yearSelect').addEventListener('change', function() {
            var selectedYear = this.value;
            var reportDataCollection = @json($reportData);

            var monthsContainer = document.getElementById('monthsContainer');
            monthsContainer.innerHTML = '';

            function createDataItem(title, value) {
                return `
                <div class="col-sm-auto align-self-sm-end">
                    <div class="row d-flex justify-content-between align-items-center border-bottom">
                        <div class="col d-flex justify-content-start mb-1 mt-1">
                            <h5 class="text-inherit mb-0 me-3">${title}</h5>
                        </div>
                        <div class="col-auto d-flex justify-content-end mb-1 mt-1">
                            <dd class="text-body mb-0">
                                ${value}
                            </dd>
                        </div>
                    </div>
                </div>
            `;
            }

            reportDataCollection.forEach(function(reportData) {
                if (reportData.year === selectedYear) {
                    var selectedMonths = reportData.month.split(',');

                    var months = [
                        "Январь", "Февраль", "Март", "Апрель",
                        "Май", "Июнь", "Июль", "Август",
                        "Сентябрь", "Октябрь", "Ноябрь", "Декабрь"
                    ];

                    selectedMonths.forEach(function(month) {
                        var monthIndex = parseInt(month) - 1;

                        var listItem = document.createElement('li');
                        listItem.className = 'list-group-item';
                        listItem.innerHTML = `
                        <a class="list-group-item-action border-primary" href="">
                            <div class="row">
                                <div class="col-sm m b-2 mb-sm-0">
                                    <h2 class="fw-normal mb-1">${months[monthIndex]}</h2>
                                </div>
                                ${createDataItem('Часы', reportData.hours)}
                                ${createDataItem('Публикации', reportData.publications)}
                                ${createDataItem('Видео', reportData.videos)}
                                ${createDataItem('Повторные посещения', reportData.return_visits)}
                                ${createDataItem('Изучения', reportData.bible_studies)}
                            </div>
                        </a>
                    `;

                        monthsContainer.appendChild(listItem);
                    });
                }
            });
        });
    </script>

{{--        <div class="row">--}}
{{--            <div class="col-md-6 mb-3 mb-lg-5">--}}
{{--                <div class="d-grid gap-2 gap-lg-4">--}}
{{--                    <h4 class="heading">В этом году вы еще не записывали отчет</h4>--}}
{{--                    <a class="card card-hover-shadow" data-bs-toggle="collapse" href="#collapseReport" role="button" aria-expanded="false" aria-controls="collapseReport">--}}
{{--                        <div class="card-body">--}}
{{--                            <div class="d-flex align-items-center">--}}
{{--                                <div class="flex-shrink-0">--}}
{{--                                </div>--}}

{{--                                <div class="flex-grow-1 ms-4">--}}
{{--                                    <h3 class="text-inherit mb-1">--}}
{{--                                        --}}{{--                                                {{ \Carbon\Carbon::createFromDate(null, $personalReport->month, null)->format('F') }}--}}
{{--                                    </h3>--}}
{{--                                    <span class="text-body"></span>--}}
{{--                                </div>--}}

{{--                                <div class="ms-2 text-end">--}}
{{--                                    <i class="bi-chevron-right text-body text-inherit"></i>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </a>--}}
{{--                    <div class="collapse" id="collapseReport">--}}
{{--                        <div class="card card-body">--}}
{{--                            <div class="d-flex justify-content-between">--}}
{{--                                <span class="text-small text-muted">Часы</span>--}}
{{--                                <h5 class="m-0"></h5>--}}
{{--                            </div>--}}
{{--                            <div class="d-flex justify-content-between">--}}
{{--                                <span class="text-small text-muted">Публикации</span>--}}
{{--                                <h5 class="m-0"></h5>--}}
{{--                            </div>--}}
{{--                            <div class="d-flex justify-content-between">--}}
{{--                                <span class="text-small text-muted">Видео</span>--}}
{{--                                <h5 class="m-0"></h5>--}}
{{--                            </div>--}}
{{--                            <div class="d-flex justify-content-between">--}}
{{--                                <span class="text-small text-muted">Повторные</span>--}}
{{--                                <h5 class="m-0"></h5>--}}
{{--                            </div>--}}
{{--                            <div class="d-flex justify-content-between">--}}
{{--                                <span class="text-small text-muted">Изучения</span>--}}
{{--                                <h5 class="m-0"></h5>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}

{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}

@endsection
