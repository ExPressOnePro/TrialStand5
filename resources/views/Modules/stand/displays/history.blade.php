@extends('Mobile.layouts.front.app')
@section('title') Meeper @endsection
@section('content')

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
                            <input id="datatableWithSearchInput" type="search" class="form-control" placeholder="Поиск" aria-label="Search users">
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
                                @if (is_array($audit->old_values) && empty($audit->old_values))
                                    Нет данных
                                @else
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


                                                @if (is_array($audit->old_values) && empty($audit->old_values))
                                                    Нет данных
                                                @elseif ($field == 1)
                                                    1 возвещатель
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
                                                @elseif(empty($value))
                                                    (empty($value))
                                                @else
                                                    {{ $value }}
                                                @endif
                                                <br>
                                            @endforeach
                                        </span>
                                    @endif
                                @endforeach
                                @endif
                            </td>
                            <td>
                                @foreach($audit->new_values as $key => $new_values)
                                    <span class="d-block h5 text-inherit mb-0">
                                    @php
                                        preg_match('/\{.*\}/', $new_values, $matches);
                                        $userValues = isset($matches[0]) ? $matches[0] : null;
                                    @endphp

                                    @if (isset($userValues) && json_last_error() === JSON_ERROR_NONE)
                                        @php
                                            $decodedValues = json_decode($userValues, true);
                                        @endphp

                                        @foreach ($decodedValues as $userKey => $userId)
                                            @php
                                                $decodedValues = json_decode($userValues, true);
                                                $user = \App\Models\User::find($userId);
                                            @endphp
                                            @if (Str::startsWith($userKey, 'user_') && $userId !== "")
                                                Возвещатель {{ substr($userKey, 5) }}: {{ $user->find($userId)->first_name }} {{ $user->find($userId)->last_name }}
                                            @endif
                                                <br>
                                        @endforeach
                                    @endif
                                    </span>
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
                            <span class="me-2">Показать:</span>

                            <!-- Select -->
                            <div class="tom-select-custom">
                                <select id="datatableEntries" class="js-select form-select form-select-borderless w-auto" autocomplete="off"
                                        data-hs-tom-select-options='{
                            "searchInDropdown": false,
                            "hideSearch": true
                          }'>
                                    <option value="10" selected>10</option>
                                    <option value="20">20</option>
                                    <option value="50">50</option>
                                </select>
                            </div>
                            <!-- End Select -->

                            <span class="text-secondary me-2">из</span>

                            <!-- Pagination Quantity -->
                            <span id="datatableWithPaginationInfoTotalQty"></span>
                        </div>
                    </div>



                    <div class="col-sm-auto">
                        <div class="d-flex justify-content-center justify-content-sm-end">
                            <!-- Pagination -->
                            <nav id="datatableWithSearchPagination" aria-label="Activity pagination"></nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



@endsection
