{{--@extends('Mobile.layouts.front.app')--}}
@extends('BootstrapApp.layouts.bootstrapApp')
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
            </div>
            <!-- End Header -->

            <!-- Table -->
            <div class="table-responsive datatable-custom position-relative">
                <table id="example" class="display nowrap">
                    <thead class="thead-light">
                    <tr>
                        <th>ID</th>
                        <th>Когда изменено</th>
                        <th>Кем изменено</th>
                        <th>День</th>
                        <th>Время</th>
                        <th>Было</th>
                        <th>Стало</th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($audits as $audit)
                        @php
                            $standPublisher = \App\Models\StandPublishers::find($audit->auditable_id);
                        @endphp
                        <tr>
                            <td>
                               {{ $standPublisher->id }}
                            </td>
                            <td>
                                {{ $audit->created_at }}
                            </td>
                            <td>
                              {{ $audit->user->last_name }} {{ $audit->user->first_name }}
                            </td>
                            <td>
                                {{ $standPublisher->date }}
                            </td>
                            <td>
                                {{ $standPublisher->time }}
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
                                                @elseif(empty($value))
                                                    (empty($value))
                                                @else
                                                    {{ $value }}
                                                @endif
                                                <br>
                                            @endforeach
                                    @endif
                                @endforeach
                                @endif
                            </td>
                            <td>
                                @foreach($audit->new_values as $key => $new_values)
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
                                @endforeach
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
{{--<div class="content container-fluid">--}}
{{--    <div class="card">--}}
{{--        <!-- Header and Search Form -->--}}
{{--        <div class="card-header card-header-content-md-between">--}}
{{--            <div class="mb-2 mb-md-0">--}}
{{--                <form>--}}
{{--                    <!-- Search -->--}}
{{--                    <div class="input-group input-group-merge input-group-flush">--}}
{{--                        <div class="input-group-prepend input-group-text">--}}
{{--                            <i class="bi-search"></i>--}}
{{--                        </div>--}}
{{--                        <input id="datatableWithSearchInput" type="search" class="form-control" placeholder="Поиск" aria-label="Search users">--}}
{{--                    </div>--}}
{{--                    <!-- End Search -->--}}
{{--                </form>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <!-- End Header and Search Form -->--}}

{{--        <!-- Table -->--}}
{{--        <div class="table-responsive datatable-custom position-relative">--}}
{{--            <table id="example" class="display nowrap">--}}
{{--                <thead class="thead-light">--}}
{{--                <tr>--}}
{{--                    <th>ID</th>--}}
{{--                    <th>Дата изменения</th>--}}
{{--                    <th>Кто изменил</th>--}}
{{--                    <th>Какой день изменен</th>--}}
{{--                    <th>Какое время изменено</th>--}}
{{--                    <th>Старые значения</th>--}}
{{--                    <th>Новые Значения</th>--}}
{{--                    <!--                                             Add more table headers as needed -->--}}
{{--                </tr>--}}
{{--                </thead>--}}

{{--                <tbody>--}}
{{--                <!-- Table body will be populated dynamically with JavaScript -->--}}
{{--                </tbody>--}}
{{--            </table>--}}
{{--        </div>--}}
{{--        <!-- End Table -->--}}
{{--    </div>--}}
{{--</div>--}}


{{--<script>--}}
{{--    // Fetch data using AJAX--}}
{{--    $(document).ready(function () {--}}
{{--        $('#example').DataTable({--}}
{{--            "ajax": "{{ route('history.data', ['id' => $id]) }}",--}}
{{--            "columns": [--}}
{{--                {"data": "id"},--}}
{{--                {--}}
{{--                    "data": "created_at",--}}
{{--                    "render": function (data) {--}}
{{--                        // Parse the ISO date string and format it--}}
{{--                        var date = new Date(data);--}}
{{--                        return date.toLocaleString(); // Adjust the format as needed--}}
{{--                    }--}}
{{--                },--}}
{{--                {--}}
{{--                    "data": "user_id",--}}
{{--                    // "render": function (data) {--}}
{{--                    //     return getUserFirstName(data);--}}
{{--                    // }--}}
{{--                },--}}
{{--                {"data": "url"},--}}
{{--                {--}}
{{--                    "data": "created_at",--}}
{{--                    "render": function (data) {--}}
{{--                        var date = new Date(data);--}}
{{--                        return date.toLocaleString();--}}
{{--                    }--}}
{{--                },--}}
{{--                {--}}
{{--                    "data": "old_values.publishers",--}}
{{--                    "render": function (data) {--}}
{{--                        return data ? data : 'N/A';--}}
{{--                    }--}}
{{--                },--}}
{{--                {--}}
{{--                    "data": "new_values.publishers",--}}
{{--                    "render": function (data) {--}}
{{--                        return data ? data : 'N/A';--}}
{{--                    }--}}
{{--                }--}}
{{--                // Add more columns as needed--}}
{{--            ]--}}
{{--        });--}}
{{--        function getUserFirstName(userId) {--}}
{{--            // Perform AJAX request to fetch user details--}}
{{--            $.ajax({--}}
{{--                url: "{{ route('getUserName') }}", // Replace with your route for fetching user details--}}
{{--                type: 'GET',--}}
{{--                data: {user_id: userId},--}}
{{--                success: function (response) {--}}
{{--                    // Assuming the response contains user details including the first name--}}
{{--                    if (response && response.data && response.data.first_name) {--}}
{{--                        return response.data.first_name;--}}
{{--                    } else {--}}
{{--                        return 'N/A';--}}
{{--                    }--}}
{{--                },--}}
{{--                error: function () {--}}
{{--                    return 'N/A';--}}
{{--                }--}}
{{--            });--}}
{{--        }--}}
{{--    });--}}
{{--</script>--}}

<script>
    $(document).ready(function() {
        $(document).ready(function() {
            $('#example').DataTable( {
                dom: 'Bltip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ],
                searching: true
            } );
            // Ваш поиск DataTables
            $('#datatableWithSearchInput').on('keyup', function () {
                $('#example').DataTable().search($(this).val()).draw();
            });
        } );

    });
</script>
@endsection
