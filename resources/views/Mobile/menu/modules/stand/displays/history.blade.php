@extends('Mobile.layouts.front.app')
@section('title') Meeper | Стенды @endsection
@section('content')

{{--    <div class="main-content pt-4">--}}
{{--        <div class="separator-breadcrumb border-top"></div>--}}
{{--        <div class="row">--}}
{{--            @empty($audits)--}}
{{--                <h2 class="heading">Значений нет</h2>--}}
{{--            @else--}}

{{--            <table class='table table-sm table-hover mb-0'>--}}
{{--                <thead>--}}
{{--                <tr>--}}
{{--                    <th>Кто</th>--}}
{{--                    <th>Инфо о записи</th>--}}
{{--                    <th>Старое значение</th>--}}
{{--                    <th>Новое значение</th>--}}
{{--                    <th >Время изменения</th>--}}
{{--                </tr>--}}
{{--                </thead>--}}
{{--                <tbody>--}}
{{--                @foreach($audits as $audites)--}}
{{--                    @foreach($audites as $audit)--}}
{{--                    <tr>--}}
{{--                        <th class="value1">--}}
{{--                            <div class="align-items-center">--}}
{{--                                <span class="text-center">--}}
{{--                                    {{ App\Models\User::find($audit->user_id)->first_name }}--}}
{{--                                    {{ App\Models\User::find($audit->user_id)->last_name }}--}}
{{--                                </span>--}}
{{--                            </div>--}}
{{--                        </th>--}}
{{--                        <th class="value4">--}}
{{--                            <div class="align-items-center">--}}
{{--                                @if(is_null(App\Models\StandPublishers::find($audit->auditable_id)))--}}
{{--                                    <span class="text-center">Дата: null</span><br>--}}
{{--                                    <span class="text-center">Время: null </span><br>--}}
{{--                                    <span class="text-center">День недели: null </span><br>--}}
{{--                                @else--}}
{{--                                <span class="text-center">Дата: {{App\Models\StandPublishers::find($audit->auditable_id)->date}} </span><br>--}}
{{--                                <span class="text-center">Время: {{App\Models\StandPublishers::find($audit->auditable_id)->time}} </span><br>--}}
{{--                                <span class="text-center">День недели: {{App\Models\StandPublishers::find($audit->auditable_id)->day}} </span><br>--}}
{{--                                @endif--}}
{{--                            </div>--}}
{{--                        </th>--}}
{{--                        <th class="value5">--}}
{{--                            <div class="align-items-center">--}}
{{--                                @foreach($audit->old_values as $key => $old_value)--}}
{{--                                    <span class="text-center">--}}
{{--                                        @if ($key == 'user_1')--}}
{{--                                            <span class="text-secondary">Первый Возвещатель</span><br>--}}
{{--                                        @elseif ($key == 'user_2')--}}
{{--                                            <span class="text-secondary">Второй Возвещатель</span><br>--}}
{{--                                        @endif--}}
{{--                                    <span class="text-center">--}}
{{--                                        @if (is_null($old_value))--}}
{{--                                            <span class="text-secondary">Пусто</span>--}}
{{--                                        @else--}}
{{--                                            @if(empty($old_value))--}}
{{--                                            @else--}}
{{--                                                {{ App\Models\User::find($old_value)->first_name }}--}}
{{--                                                {{ App\Models\User::find($old_value)->last_name }}--}}
{{--                                            @endempty--}}
{{--                                        @endif--}}
{{--                                    </span>--}}
{{--                                @endforeach--}}
{{--                            </div>--}}
{{--                        </th>--}}
{{--                        <th class="value6">--}}
{{--                            @if($audit->auditable_type == 'created')--}}
{{--                                @foreach($audit->new_values as $key => $new_value)--}}
{{--                                    @if ($key == 'user_1')--}}
{{--                                        @if (is_null($new_value))--}}
{{--                                            <span class="text-secondary">Первый Возвещатель</span><br>--}}
{{--                                            <span class="text-danger">вычеркнул</span><br>--}}
{{--                                        @else--}}
{{--                                            {{ App\Models\User::find($new_value)->first_name }}--}}
{{--                                            {{ App\Models\User::find($new_value)->last_name }}<br>--}}
{{--                                        @endif--}}
{{--                                    @elseif ($key == 'user_2')--}}
{{--                                        @if (is_null($new_value))--}}
{{--                                            <span class="text-secondary">Второй Возвещатель</span><br>--}}
{{--                                            <span class="text-danger">вычеркнул</span><br>--}}
{{--                                        @else--}}
{{--                                            {{ App\Models\User::find($new_value)->first_name }}--}}
{{--                                            {{ App\Models\User::find($new_value)->last_name }}<br>--}}
{{--                                        @endif--}}
{{--                                    @endif--}}
{{--                                @endforeach--}}
{{--                            @else ($audit->auditable_type == 'updated')--}}
{{--                                @foreach($audit->new_values as $key => $new_value)--}}
{{--                                    <span class="text-center">--}}
{{--                                        @if (is_null($key == 'user_1'))--}}
{{--                                        @elseif ($key == 'user_1')--}}
{{--                                            @if (is_null($new_value))--}}
{{--                                            @else--}}
{{--                                                <span class="text-secondary">Первый Возвещатель</span><br>--}}
{{--                                                {{ App\Models\User::find($new_value)->first_name }}--}}
{{--                                                {{ App\Models\User::find($new_value)->last_name }}<br>--}}
{{--                                            @endif--}}
{{--                                        @elseif (is_null($key == 'user_2'))--}}
{{--                                        @elseif ($key == 'user_2')--}}
{{--                                            @if (is_null($new_value))--}}
{{--                                            @else--}}
{{--                                                <span class="text-secondary">Второй Возвещатель</span><br>--}}
{{--                                                {{ App\Models\User::find($new_value)->first_name }}--}}
{{--                                                {{ App\Models\User::find($new_value)->last_name }}<br>--}}
{{--                                            @endif--}}
{{--                                        @endif--}}
{{--                                @endforeach--}}
{{--                            @endif--}}
{{--                        </th>--}}
{{--                        <th class="value7">--}}
{{--                            {{$audit->created_at}}--}}
{{--                        </th>--}}
{{--                    </tr>--}}
{{--                @endforeach--}}
{{--                @endforeach--}}
{{--                    @endempty--}}
{{--                </tbody>--}}
{{--            </table>--}}
{{--        </div>--}}

{{--    </div>--}}


<div class="content container-fluid">
    <div class="card">
        <!-- Header -->
        <div class="card-header card-header-content-md-between">
            <div class="mb-2 mb-md-0">
                <form>
                    <!-- Search -->
                    <div class="input-group input-group-merge input-group-flush">
                        <div class="input-group-prepend input-group-text">
                            <i class="bi-search"></i>
                        </div>
                        <input id="datatableSearch" type="search" class="form-control" placeholder="Поиск" aria-label="Search users">
                    </div>
                    <!-- End Search -->
                </form>
            </div>

            <div class="d-grid d-sm-flex justify-content-md-end align-items-sm-center gap-2">
                <!-- Datatable Info -->
                <div id="datatableCounterInfo" style="display: none;">
                    <div class="d-flex align-items-center">
                <span class="fs-5 me-3">
                  <span id="datatableCounter">0</span>
                  Selected
                </span>
                        <a class="btn btn-outline-danger btn-sm" href="javascript:;">
                            <i class="bi-trash"></i> Delete
                        </a>
                    </div>
                </div>
                <!-- End Datatable Info -->


            </div>
        </div>
        <!-- End Header -->

        <!-- Table -->
        <div class="table-responsive datatable-custom position-relative">
            <table class="js-datatable table table-borderless table-bordered table-thead-bordered table-nowrap table-align-middle card-table"
                   data-hs-datatables-options='{
                   "order": [],
                   "search": "#datatableWithSearchInput",
                   "entries": "#datatableEntries",
                   "isResponsive": false,
                   "isShowPaging": false,
                   "pagination": "datatableWithSearchPagination"
                 }'>
                <thead class="thead-light">
                <tr>
                    <th>ID</th>
                    <th>Дата изменения</th>
                    <th>Кто изменил</th>
                    <th>Какой день изменен</th>
                    <th>Какое время изменено</th>
                    <th>Старые значения</th>
                    <th>Новые Значения</th>
                </tr>
                </thead>

                <tbody>
                @foreach($audits as $audit)
                    @php
                        $standPublisher = \App\Models\StandPublishers::find($audit->auditable_id);
                    @endphp
                    <tr>
                        <td class="table-column-ps-0">
                            <div class="ms-3">
                                <span class="d-block h5 text-inherit mb-0">{{ $standPublisher->id }}</span>
                            </div>
                        </td>
                        <td>
                            <span class="d-block h5 text-inherit mb-0">{{ $audit->created_at }}</span>
                        </td>
                        <td>
                            <span class="d-block h5 text-inherit mb-0">{{ $audit->user->last_name }} {{ $audit->user->first_name }}</span>
                        </td>
                        <td>
                            <span class="d-block h5 text-inherit mb-0">{{ $standPublisher->date }}</span>
                        </td>
                        <td>
                            <span class="d-block h5 text-inherit mb-0">{{ $standPublisher->time }}</span>
                        </td>
                        <td>
                            @foreach($audit->old_values as $key => $old_value)
                                @php
                                    $new_value = $audit->new_values[$key] ?? null;
                                @endphp
                                @if ($old_value !== $new_value)
                                    <span class="d-block h5 text-inherit mb-0">
                                        @php
                                            $old_value_pairs = explode(',', preg_replace('/[^\d:,\s]/', '', $old_value));
                                        @endphp

                                        @foreach ($old_value_pairs as $pair)
                                            @php
                                                [$field, $value] = explode(':', $pair);
                                            @endphp

                                            @if ($field == 1)
                                                1 возвещатель:
                                            @elseif ($field == 2)
                                                2 возвещатель:
                                            @elseif ($field == 3)
                                                3 возвещатель:
                                            @elseif ($field == 4)
                                                4 возвещатель:
                                            @endif
                                            @if ($value)
                                                @php
                                                    $user = \App\Models\User::find($value);
                                                @endphp
                                                @if ($user)
                                                    {{ $user->first_name }} {{ $user->last_name }} <!-- Здесь предполагается, что имя пользователя находится в поле name -->
                                                @else
                                                    -
                                                @endif
                                            @else
                                                {{ $value }}
                                            @endif
                                            <br>
                                        @endforeach
                                        </span>
                                @endif
                            @endforeach
                        </td>
                        <td>
                            @foreach($audit->old_values as $key => $old_value)
                                @php
                                    $new_value = $audit->new_values[$key] ?? null;
                                @endphp
                                @if ($old_value !== $new_value)
                                    <span class="d-block h5 text-inherit mb-0">
                                    @php
                                        $new_value_pairs = explode(',', preg_replace('/[^\d:,\s]/', '', $new_value));
                                    @endphp

                                    @foreach ($new_value_pairs as $pair)
                                        @php
                                            [$field, $value] = explode(':', $pair);
                                        @endphp
                                        @if ($field == 1)
                                            1 возвещатель:
                                        @elseif ($field == 2)
                                            2 возвещатель:
                                        @elseif ($field == 3)
                                            3 возвещатель:
                                        @elseif ($field == 4)
                                            4 возвещатель:
                                        @endif

                                        @if ($value)
                                            @php
                                                $user = \App\Models\User::find($value);
                                            @endphp
                                            @if ($user)
                                                {{ $user->first_name }} {{ $user->last_name }} <!-- Здесь предполагается, что имя пользователя находится в поле name -->
                                            @else
                                                -
                                            @endif
                                        @else
                                            {{ $value }}
                                        @endif
                                        <br>
                                    @endforeach
                                </span>
                                @endif
                            @endforeach
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <!-- End Table -->

        <!-- Footer -->
        <div class="card-footer">
            <div class="row justify-content-center justify-content-sm-between align-items-sm-center">
                <div class="col-sm mb-2 mb-sm-0">
                    <div class="d-flex justify-content-center justify-content-sm-start align-items-center">
                        <span class="me-2">Showing:</span>

                        <!-- Select -->
                        <div class="tom-select-custom">
                            <select id="datatableEntries" class="js-select form-select form-select-borderless w-auto" autocomplete="off" data-hs-tom-select-options='{
                            "searchInDropdown": false,
                            "hideSearch": true
                          }'>
                                <option value="10">10</option>
                                <option value="15" selected>15</option>
                                <option value="20">20</option>
                                <option value="50">50</option>
                            </select>
                        </div>
                        <!-- End Select -->

                        <span class="text-secondary me-2">of</span>

                        <!-- Pagination Quantity -->
                        <span id="datatableWithPaginationInfoTotalQty"></span>
                    </div>
                </div>
                <!-- End Col -->

                <div class="col-sm-auto">
                    <div class="d-flex justify-content-center justify-content-sm-end">
                        <!-- Pagination -->
                        <nav id="datatablePagination" aria-label="Activity pagination"></nav>
                    </div>
                </div>
                <!-- End Col -->
            </div>
            <!-- End Row -->
        </div>
        <!-- End Footer -->
    </div>
</div>
{{--<div class="content container-fluid mt-8">--}}
{{--    <div class="row">--}}
{{--        @foreach($audits as $audit)--}}
{{--            @php--}}
{{--                $standPublisher = \App\Models\StandPublishers::find($audit->auditable_id);--}}
{{--            @endphp--}}
{{--            <div class="card-body card-body-height d-flex justify-content-center align-items-center" style="height: 30rem;">--}}
{{--                <ul class="step step-icon-xs mb-0">--}}
{{--                    <li class="step-item">--}}
{{--                        <div class="step-content-wrapper">--}}
{{--                            <span class="step-icon step-icon-pseudo step-icon-soft-dark"></span>--}}
{{--                            <div class="step-content">--}}
{{--                                <h5 class="step-title">--}}
{{--                                    <a class="text-dark" href="#">Детали--}}
{{--                                        <span class="text-primary small text-uppercase">{{ $standPublisher->id }}</span>--}}
{{--                                        @if( $audit->event === 'updated')--}}
{{--                                            <span class="badge bg-soft-success text-success rounded-pill">--}}
{{--                                            <span class="legend-indicator bg-success"></span>Изменено</span>--}}
{{--                                        @elseif($audit->event === 'created')--}}
{{--                                            <span class="badge bg-soft-primary text-primary rounded-pill">--}}
{{--                                            <span class="legend-indicator bg-primary"></span>Создано</span>--}}
{{--                                        @endif--}}
{{--                                    </a>--}}
{{--                                </h5>--}}
{{--                                <p class="mb-1">Дата изменения: <a class="text-uppercase"> {{ $audit->created_at }}</a></p>--}}
{{--                                <p class="mb-1">Кто изменил: <a class="text-dark"> {{ $audit->user->first_name }} {{ $audit->user->last_name }}</a></p>--}}
{{--                                @if ($standPublisher)--}}
{{--                                    <p class="mb-1">Какой день изменен: <a class="text-dark"> {{ $standPublisher->date }}</a></p>--}}
{{--                                    <p class="mb-1">Какое время изменено: <a class="text-dark">{{ $standPublisher->time }}</a></p>--}}
{{--                                @else--}}
{{--                                    <p>Stand Publisher not found</p>--}}
{{--                                @endif--}}
{{--                                @foreach($audit->old_values as $key => $old_value)--}}
{{--                                    @php--}}
{{--                                        $new_value = $audit->new_values[$key] ?? null;--}}
{{--                                    @endphp--}}
{{--                                    @if ($old_value !== $new_value)--}}
{{--                                        <ul class="list-group list-group-flush list-group-start-bordered">--}}
{{--                                            <!-- Item -->--}}
{{--                                            <li class="list-group-item">--}}
{{--                                                <a class="list-group-item-action border-warning">--}}
{{--                                                    <div class="row">--}}
{{--                                                        <div class="col-sm mb-2 mb-sm-0">--}}
{{--                                                            <h5 class="text-inherit mb-0">Старые значения:</h5>--}}
{{--                                                            <span class="text-body small mb-2">--}}
{{--                                                                    @php--}}
{{--                                                                        $old_value_pairs = explode(',', preg_replace('/[^\d:,\s]/', '', $old_value));--}}
{{--                                                                    @endphp--}}

{{--                                                                @foreach ($old_value_pairs as $pair)--}}
{{--                                                                    @php--}}
{{--                                                                        [$field, $value] = explode(':', $pair);--}}
{{--                                                                    @endphp--}}

{{--                                                                    @if ($field == 1)--}}
{{--                                                                        1 возвещатель:--}}
{{--                                                                    @elseif ($field == 2)--}}
{{--                                                                        2 возвещатель:--}}
{{--                                                                    @elseif ($field == 3)--}}
{{--                                                                        3 возвещатель:--}}
{{--                                                                    @elseif ($field == 4)--}}
{{--                                                                        4 возвещатель:--}}
{{--                                                                    @endif--}}
{{--                                                                    @if ($value)--}}
{{--                                                                        @php--}}
{{--                                                                            $user = \App\Models\User::find($value);--}}
{{--                                                                        @endphp--}}
{{--                                                                        @if ($user)--}}
{{--                                                                            {{ $user->first_name }} {{ $user->last_name }} <!-- Здесь предполагается, что имя пользователя находится в поле name -->--}}
{{--                                                                        @else--}}
{{--                                                                            ---}}
{{--                                                                        @endif--}}
{{--                                                                    @else--}}
{{--                                                                        {{ $value }}--}}
{{--                                                                    @endif--}}
{{--                                                                    <br>--}}
{{--                                                                @endforeach--}}
{{--                                                                </span>--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}
{{--                                                </a>--}}
{{--                                            </li>--}}
{{--                                        </ul>--}}
{{--                                        <ul class="list-group list-group-flush list-group-start-bordered">--}}
{{--                                            <!-- Item -->--}}
{{--                                            <li class="list-group-item">--}}
{{--                                                <a class="list-group-item-action border-success">--}}
{{--                                                    <div class="row">--}}
{{--                                                        <div class="col-sm mb-2 mb-sm-0">--}}
{{--                                                            <h5 class="text-inherit mb-0">Новые Значения:</h5>--}}
{{--                                                            <span class="text-body small">--}}
{{--                                                                    @php--}}
{{--                                                                        $new_value_pairs = explode(',', preg_replace('/[^\d:,\s]/', '', $new_value));--}}
{{--                                                                    @endphp--}}

{{--                                                                @foreach ($new_value_pairs as $pair)--}}
{{--                                                                    @php--}}
{{--                                                                        [$field, $value] = explode(':', $pair);--}}
{{--                                                                    @endphp--}}
{{--                                                                    @if ($field == 1)--}}
{{--                                                                        1 возвещатель:--}}
{{--                                                                    @elseif ($field == 2)--}}
{{--                                                                        2 возвещатель:--}}
{{--                                                                    @elseif ($field == 3)--}}
{{--                                                                        3 возвещатель:--}}
{{--                                                                    @elseif ($field == 4)--}}
{{--                                                                        4 возвещатель:--}}
{{--                                                                    @endif--}}

{{--                                                                    @if ($value)--}}
{{--                                                                        @php--}}
{{--                                                                            $user = \App\Models\User::find($value);--}}
{{--                                                                        @endphp--}}
{{--                                                                        @if ($user)--}}
{{--                                                                            {{ $user->first_name }} {{ $user->last_name }} <!-- Здесь предполагается, что имя пользователя находится в поле name -->--}}
{{--                                                                        @else--}}
{{--                                                                            ---}}
{{--                                                                        @endif--}}
{{--                                                                    @else--}}
{{--                                                                        {{ $value }}--}}
{{--                                                                    @endif--}}
{{--                                                                    <br>--}}
{{--                                                                @endforeach--}}
{{--                                                                    </span>--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}
{{--                                                </a>--}}
{{--                                            </li>--}}
{{--                                        </ul>--}}
{{--                                    @endif--}}
{{--                                @endforeach--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </li>--}}
{{--                </ul>--}}
{{--            </div>--}}
{{--        @endforeach--}}
{{--    </div>--}}
{{--</div>--}}




@endsection
