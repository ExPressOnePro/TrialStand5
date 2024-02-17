<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12">
        @can('schedule.template')
            @empty($responsibles)
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                Добавьте названия для ответственных на встречах <a class="alert-link h5" data-bs-toggle="modal" data-bs-target="#timeDay">добавить</a>.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @else
            @endempty
            <div class="modal fade" id="timeDay" tabindex="-1" aria-labelledby="exampleModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="timeDayLabel">Названия преимуществ</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body row">
                            <p>Для вашего удобства заполните названия тех, кто каждую встречу имеет обязанности, чтобы в дальнейшем не вводить их.</p>
                            <div class="card">
                                <div class="card-body">
                                    <form action="{{route('meetingSchedules.save_responsibles_for_template', $congregation->id)}}" method="post">
                                        @csrf
                                        <div id="responsibles-container">
                                            @if (!is_null($responsibles))
                                                @foreach($responsibles as $key => $responsible)
                                                    <div class="row mb-2 d-flex justify-content-between align-items-end border p-1" data-key="{{ $key }}">

                                                        <div class="col-md-6">
                                                            <div class="form">
                                                                <label for="name_{{ $key }}">Название:</label>
                                                                <input type="text" name="responsibles[{{ $key }}][name]" id="name_{{ $key }}" class="form-control" value="{{ $responsible['name'] }}" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 mt-3">
                                                            <button type="button" class="col btn btn-outline-danger" onclick="removeResponsible({{ $key }})">Удалить</button>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @endif
                                        </div>
                                        <div class="row">
                                            <div class="col-6">
                                                <button type="button" class="col btn btn-success" onclick="addResponsible()">Добавить</button>
                                            </div>
                                            <div class="col-6">
                                                <button type="submit" class="col btn btn-primary">Сохранить</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <script>
                                let nextKey = {{ is_array($responsibles) ? count($responsibles) : 0 }};

                                function addResponsible() {
                                    nextKey++;
                                    const container = document.getElementById('responsibles-container');
                                    const newRow = document.createElement('div');
                                    newRow.className = 'row mb-2 align-items-end border p-1';
                                    newRow.setAttribute('data-key', nextKey);
                                    newRow.innerHTML = `
            <div class="col-md-6">
                <div class="form">
                    <label for="name_${nextKey}">Название:</label>
                    <input type="text" name="responsibles[${nextKey}][name]" id="name_${nextKey}" class="form-control" required>
                </div>
            </div>
            <div class="col-md-6 mt-3">
                <button type="button" class="col btn btn-outline-danger" onclick="removeResponsible(${nextKey})">Удалить</button>
            </div>
        `;
                                    container.appendChild(newRow);
                                }

                                function removeResponsible(key) {
                                    const container = document.getElementById('responsibles-container');
                                    const rowToRemove = document.querySelector(`[data-key="${key}"]`);
                                    container.removeChild(rowToRemove);
                                }
                            </script>
                            <script>
                                $(document).ready(function() {
                                    @if(isset($key))
                                    $('#responsibles_value_{{ $key }}').select2({
                                        placeholder: 'Введите имя пользователя',
                                        allowClear: true,
                                        tags: true,
                                    });
                                    @endif
                                });
                            </script>
                        </div>
                    </div>
                </div>
            </div>

            <div class="px-4 py-3 rounded-2 bg-body-secondary text-end mb-3">
                <p class="lead mb-4">Шаблоны для расписания встреч собрания</p>
                <div class="row row-cols-md-3 row-cols-sm-2 g-1 text-start">
                    @foreach($meeting_schedule_templates as $meeting_schedule_template)
                        <div class="col-md-4">
                            <a class="card text-decoration-none d-flex h-100 meeting-schedule-template no-select" data-bs-toggle="modal" data-bs-target="#msModal-{{ $meeting_schedule_template->id }}">
                                <div class="card-body">
                                    <h6 class="card-title">{{ $meeting_schedule_template->template_name }}</h6>
                                </div>
                            </a>
                        </div>
                        <div class="modal fade" id="msModal-{{ $meeting_schedule_template->id }}" tabindex="-1" aria-labelledby="msModal-{{ $meeting_schedule_template->id }}" aria-hidden="true" style="display: none;">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">{{ $meeting_schedule_template->template_name }}</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form method="post" id="createWeek-{{ $meeting_schedule_template->id }}" action="{{ route('meetingSchedules.create', $congregation->id) }}">
                                            @csrf
                                            <div class="mb-3">
                                                <label for="weekPicker" class="form-label">Выберите неделю:</label>
                                                <input type="week" id="weekPicker" class="form-control" name="weekPicker" required>
                                                <input type="hidden" id="ms_template_id" class="form-control" name="ms_template_id" value="{{ $meeting_schedule_template->id }}" required>
                                            </div>

                                            <div class="row mt-5">
                                                <button type="submit" class="btn btn-primary" >Создать</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <button class="btn btn-outline-primary h5 mt-3" data-bs-toggle="modal" data-bs-target="#timeDay">изменить названия ответственных для всех шаблонов</button>
            </div>
        @endcan
        <div class="mb-3">
            <div class="row align-items-center mb-5">
                <div class="col">
                    <h3 class="mb-0">Расписания встреч собрания</h3>
                </div>
                <!-- End Col -->
                @can('schedule.redaction')
                    <div class="col-auto">
                        <!-- Nav -->
                        <ul class="nav nav-pills" id="profileTeamsTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link active" id="grid-tab" data-bs-toggle="tab" href="#grid" role="tab" aria-controls="grid" aria-selected="false" title="Column view" tabindex="-1">
                                    <i class="bi-grid"></i>
                                </a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="list-tab" data-bs-toggle="pill" href="#list" role="tab" aria-controls="list" aria-selected="true" title="List view">
                                    <i class="bi-view-list"></i>
                                </a>
                            </li>
                        </ul>

                    </div>
                @endcan
            </div>
            @if(!empty($weeklySchedule))
                <div class="tab-content" id="profileTeamsTabContent">
                    <div class="tab-pane fade active show" id="grid" role="tabpanel" aria-labelledby="grid-tab">
                        <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-3 mb-5">
                            @foreach($weeklySchedule as $week => $weekData)
                                <div class="col mb-3 mb-lg-5">
                                    <div class="card rounded-4 h-100">
                                        <div class="card-header rounded-top-4"
                                             @if($weekData['this_week'] === true) style="background-color: rgba(197,197,197,0.65)" @endif>
                                            <div class="row d-flex align-items-center">
                                                <div class="col-9 lh-1">
                                                    <h4>{{ $weekData['week_start'] }} - {{ $weekData['week_end'] }}
                                                    </h4>
                                                    @can('schedule.redaction')
                                                        <small class="text-{{ $weekData['published'] ? 'success' : 'secondary' }}">
                                                            <i class="fa-solid fa-circle{{ $weekData['published'] ? '' : '-dot' }}"></i>
                                                            {{ $weekData['published'] ? 'Опубликовано' : 'Не опубликовано' }}
                                                        </small>
                                                    @endcan
                                                </div>
                                                @can('schedule.redaction')
                                                    <div class="col-3 text-end">
                                                        <div class="dropdown">
                                                            <button type="button" class="btn btn-ghost-secondary btn-icon btn-sm rounded-circle" id="teamsDropdown1" data-bs-toggle="dropdown" aria-expanded="false">
                                                                <i class="bi-three-dots-vertical"></i>
                                                            </button>
                                                            <div class="dropdown-menu dropdown-menu-sm dropdown-menu-end" aria-labelledby="teamsDropdown1">
                                                                <form method="post" action="{{ route('meetingSchedules.publish', $weekData['id']) }}">
                                                                    @csrf
                                                                    <button type="submit" class="dropdown-item">
                                                                        {{ $weekData['published'] ? 'Снять с публикации' : 'Опубликовать' }}
                                                                    </button>
                                                                </form>
                                                                <div class="dropdown-divider"></div>
                                                                <form method="post" action="{{ route('meetingSchedules.delete', $weekData['id']) }}">
                                                                    @csrf
                                                                    <button type="submit" class="dropdown-item text-danger">
                                                                        {{ $weekData['deleted'] ? 'Показать' : 'Скрыть' }}
                                                                    </button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endcan
                                            </div>
                                        </div>
                                        <a class="card rounded-0 rounded-bottom-4 meeting-schedule-template pb-0 text-decoration-none" href="{{ route('meetingSchedules.schedule', $weekData['id']) }}">
                                            <div class="d-flex border-hover border-bottom gap-3 p-2 align-items-center justify-content-between py-3">
                                                <img class="bd-placeholder-img  ms-3" height="50" src="{{ asset('images/workbook.svg') }}">
                                                <div class="col">
                                                    <h4 class="text-muted">Жизнь и служение</h4>
                                                    <h6 class="mb-0 text-muted">{{$weekData['weekday']}}</h6>
                                                </div>
                                            </div>
                                            <div class="d-flex border-hover gap-3 p-2 align-items-center justify-content-between py-3">
                                                <img class="bd-placeholder-img ms-3" height="50" src="{{ asset('images/watchtower.svg') }}">
                                                <div class="col">
                                                    <h4 class="text-muted">Сторожевая башня</h4>
                                                    <h6 class="mb-0 text-muted">{{$weekData['weekend']}}</h6>
                                                    <p></p>
                                                </div>
                                            </div>
                                            @can('schedule.redaction')
                                                <div class="card-footer pt-0">
                                                    <div class="d-flex justify-content-between">
                                                        <small class="text-body-secondary">Тип недели</small>
                                                        @if($weekData['template_name'] == 'Посещение районного старейшины')
                                                            <small class="text-danger fw-bold">{{$weekData['template_name']}}</small>
                                                        @else
                                                            <small class="text-body-secondary">{{$weekData['template_name']}}</small>
                                                        @endif
                                                    </div>
                                                    <div class="d-flex justify-content-between">
                                                        <small class="text-body-secondary">Последнее обновление </small>
                                                        <small class="text-body-secondary">{{$weekData['updated']}}</small>
                                                    </div>
                                                </div>
                                            @endcan
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="tab-pane fade" id="list" role="tabpanel" aria-labelledby="list-tab">
                        <div class="card mb-5">
                            <div class="card-header">
                                <div class="row justify-content-between align-items-center flex-grow-1 mb-3">
                                    <!-- End Header -->
                                    <div class="col-md">
                                        <form>
                                            <!-- Search -->
                                            <div class="input-group input-group-merge ">
                                                <div class="input-group-prepend input-group-text">
                                                    <i class="bi-search"></i>
                                                </div>
                                                <input id="datatableWithSearchInput" type="search" class="form-control" placeholder="Поиск" aria-label="Search users">
                                            </div>
                                            <!-- End Search -->
                                        </form>
                                    </div>

                                </div>
                            </div>

                            <div class="table-responsive datatable-custompy-3">
                                <table id="schedules" class="table table-thead-bordered card-table">
                                    <thead class="thead-light">
                                    <tr>
                                        <th>Неделя</th>
                                        <th>Время встреч</th>
                                        <th>Тип недели</th>
                                        <th>Последнее обновление</th>
                                        <th>Опции</th>
                                    </tr>
                                    </thead>
                                    <tbody class="align-items-center text-center">
                                    @foreach($weeklySchedule as $week => $weekData)
                                        <tr>
                                            <td>
                                                <h6>{{ $weekData['week_start'] }} - {{ $weekData['week_end'] }}</h6>
                                            </td>
                                            <td>
                                                <a class="meeting-schedule-template text-decoration-none" href="{{ route('meetingSchedules.schedule', $weekData['id']) }}">
                                                    <div class="d-flex align-items-center justify-content-between border-bottom">
                                                        <div class="col">
                                                            <h6 class="mb-0 text-muted">Жизнь и служение</h6>
                                                        </div>
                                                        <div class="col">
                                                            <span class="mb-0 text-muted">{{ $weekData['weekday'] }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="d-flex align-items-center justify-content-between">
                                                        <div class="col">
                                                            <h6 class="mb-0 text-muted">Сторожевая башня</h6>
                                                        </div>
                                                        <div class="col">
                                                            <span class="mb-0 text-muted">{{ $weekData['weekend'] }}</span>
                                                        </div>
                                                    </div>
                                                </a>
                                            </td>
                                            <td>
                                                @if($weekData['template_name'] == 'Посещение районного старейшины')
                                                    <span class="text-danger fw-bold">{{ $weekData['template_name'] }}</span>
                                                @else
                                                    <span>{{ $weekData['template_name'] }}</span>
                                                @endif
                                            </td>
                                            <td>{{ $weekData['updated'] }}</td>
                                            <td>
                                                <div class="dropdown">
                                                    <button type="button" class="btn btn-ghost-secondary btn-icon btn-sm rounded-circle" id="teamsDropdown{{ $week }}" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="bi-three-dots-vertical"></i>
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-sm dropdown-menu-end" aria-labelledby="teamsDropdown{{ $week }}">
                                                        <a class="dropdown-item" href="#">Опубликовать</a>
                                                        <a class="dropdown-item" href="#">Редактировать</a>
                                                        <div class="dropdown-divider"></div>
                                                        <a class="dropdown-item text-danger" href="#">Удалить</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="py-3 shadow-sm text-center">
                    <h4 class="fw-bold text-body-emphasis">Расписаний нет</h4>
                    <p class="lead mb-4">Чтобы начать, выберите новое расписание или один из шаблонов выше</p>
                </div>
            @endif
        </div>
    </div>
</div>

<script>

    $(document).ready(function() {
        $('#schedules').DataTable( {
            dom: 'Blt',
            // buttons: [
            //     'copy', 'csv', 'excel', 'pdf', 'print'
            // ],
            paging: false, // Disable paging
            searching: true
        } );
        // Ваш поиск DataTables
        $('#datatableWithSearchInput').on('keyup', function () {
            $('#schedules').DataTable().search($(this).val()).draw();
        });
    } );

</script>
<script>
    function createWeek(templateId) {
        const formElement = document.getElementById(`createWeek-${templateId}`);
        var formData = new FormData(formElement);

        formData.append('_token', '{{ csrf_token() }}');
        formData.append('ms_template_id', templateId);

        $.ajax({
            url: '{{ route('meetingSchedules.create', $congregation->id) }}',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                if (response.error) {
                    console.log('Server error:', response.error);
                } else {
                    console.log('Success:', true);

                }
            },
            error: function(xhr) {
                var errors = xhr.responseJSON.errors;

                $(".form-error").remove();

                for(error in errors) {
                    var input = $('input[name=' + error + ']');
                    input.parent('.form-control').after('<span class="form-error text-danger">' + errors[error][0] + '</span>');
                }
            }
        });
    }
</script>
