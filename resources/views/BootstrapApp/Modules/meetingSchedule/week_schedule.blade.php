@extends('BootstrapApp.layouts.app')
@section('title') Meeper | расписание {{$ms->id}} @endsection
@section('content')
    <style>
        @media print {
            .nav-control {
                display: none;
            }
        }
    </style>
    @if(!empty($data))
        @can('schedule.redaction')
        <ul class="nav nav-control nav-pills mb-3" id="pills-tab" role="tablist">
        <li class="nav-item col mb-2 d-none d-md-block" role="presentation">
            <a class="btn btn-outline-primary col" href="{{route('meetingSchedules.overview', $ms->meetingScheduleTemplate->congregation_id)}}">
                <i class="fa-solid fa-arrow-left fs-3"></i>
                Вернуться
            </a>
        </li>
        <li class="nav-item col mb-2" role="presentation" >
            <button id="downloadButton" class="col btn btn-primary">
                <i class="fa-solid fa-file-pdf fs-3"></i> Скачать
            </button>
        </li>
        <li class="nav-item col mb-2" role="presentation" >
            <a class="col btn btn-secondary" href="{{route('meetingSchedules.redaction', $ms->id)}}">
                <i class="fa-solid fa-pencil fs-3"></i> Редактировать
            </a>
        </li>

        <li class="nav-item col mb-2" role="presentation">
            <form method="post" action="{{ route('meetingSchedules.publish', $ms->id) }}">
                @csrf
                @if(isset($datas['weekday']['responsible_users']) && count($datas['weekday']['responsible_users']) > 0 &&
                    isset($datas['weekday']['songs']['1']) && count($datas['weekday']['songs']['1']) > 0 &&
                    isset($datas['weekday']['treasures']) && count($datas['weekday']['treasures']) > 0 &&
                    isset($datas['weekday']['field_ministry']) && count($datas['weekday']['field_ministry']) > 0 &&
                    isset($datas['weekday']['songs']['2']) && count($datas['weekday']['songs']['2']) > 0 &&
                    isset($datas['weekday']['living']) && count($datas['weekday']['living']) > 0 &&
                    isset($datas['weekday']['songs']['3']) && count($datas['weekday']['songs']['3']) > 0 &&
                    isset($datas['weekend']['responsible_users']) && count($datas['weekend']['responsible_users']) > 0 &&
                    isset($datas['weekend']['songs']['1']) && count($datas['weekend']['songs']['1']) > 0 &&
                    isset($datas['weekend']['public_speech']) && count($datas['weekend']['public_speech']) > 0 &&
                    isset($datas['weekend']['songs']['2']) && count($datas['weekend']['songs']['2']) > 0 &&
                    isset($datas['weekend']['songs']['3']) && count($datas['weekend']['songs']['3']) > 0 &&
                    isset($datas['weekend']['watchtower']) && count($datas['weekend']['watchtower']) > 0)
                    <button type="submit" class="col btn btn-success">
                        <i class="fa-solid fa-bullhorn fs-3"></i> {{ $ms->published ? 'Снять с публикации' : 'Опубликовать' }}
                    </button>
                @else
                    <button type="button" class="col btn btn-success" onclick="publish()" data-bs-toggle="modal" data-bs-target="#publishModal">
                        <i class="fa-solid fa-bullhorn fs-3"></i> Опубликовать
                    </button>
                @endif
            </form>
        </li>

        <li class="nav-item col mb-2" role="presentation">
            <form method="post" action="{{ route('meetingSchedules.delete', $ms->id) }}">
                @csrf
                <button type="submit" class="col btn btn-danger">
                    <i class="fa-solid fa-trash-can fs-3"></i> {{ $ms->deleted ? 'Восстановить' : 'Удалить' }}
                </button>
            </form>
        </li>
    </ul>
        @endcan
        <div class="row">
            <div class="col-lg-8 col-md-12 col-sm-12 mb-5 mx-auto">
                @include('BootstrapApp.Modules.meetingSchedule.schedule_types.weekday')
                @include('BootstrapApp.Modules.meetingSchedule.schedule_types.weekend')
            </div>
            <div class="col-lg-4 col-md-12 col-sm-12 mb-5 mx-auto">
                <div class="card shadow-sm">
                    <svg class="bd-placeholder-img card-img-top" width="100%" height="225" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#55595c"></rect><text x="50%" y="50%" fill="#eceeef" dy=".3em">Thumbnail</text></svg>
                    <div class="card-body">
                        <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="btn-group">
                                <button type="button" class="btn btn-sm btn-outline-secondary">View</button>
                                <button type="button" class="btn btn-sm btn-outline-secondary">Edit</button>
                            </div>
                            <small class="text-body-secondary">9 mins</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <div class="modal fade" id="publishModal" tabindex="-1" aria-labelledby="publishModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="publishModalLabel">Подтверждение публикации</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p id="missingBlockInfo">Все необходимые блоки заполнены.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Отмена</button>
                    <form method="post" action="{{ route('meetingSchedules.publish', $ms->id) }}">
                        @csrf
                            <button type="submit" class="col btn btn-success">
                                <i class="fa-solid fa-bullhorn fs-3"></i> {{ $ms->published ? 'Снять с публикации' : 'Опубликовать' }}
                            </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function () {
            $('#downloadButton').on('click', function () {
                window.print();
            });
        });
    </script>
    <script>
        function publish() {
            var missingBlockInfo = document.getElementById('missingBlockInfo');
            var missingBlocks = [];

            // Проверка блока responsible_users
            if (!{{ isset($datas['weekday']['responsible_users']) && count($datas['weekday']['responsible_users']) > 0 ? 'true' : 'false' }}) {
                missingBlocks.push('<p class="text-danger">Ответственные</p>');
            }

            // Проверка блока songs 1
            if (!{{ isset($datas['weekday']['songs']['1']) && count($datas['weekday']['songs']['1']) > 0 ? 'true' : 'false' }}) {
                missingBlocks.push('<p class="text-danger">Песня 1</p>');
            }

            // Проверка блока treasures
            if (!{{ isset($datas['weekday']['treasures']) && count($datas['weekday']['treasures']) > 0 ? 'true' : 'false' }}) {
                missingBlocks.push('<p class="text-danger">Духовные жемчужины</p>');
            }

            // Проверка блока field_ministry
            if (!{{ isset($datas['weekday']['field_ministry']) && count($datas['weekday']['field_ministry']) > 0 ? 'true' : 'false' }}) {
                missingBlocks.push('<p class="text-danger">Оттачиваем навыки служения</p>');
            }

            // Проверка блока songs 2
            if (!{{ isset($datas['weekday']['songs']['2']) && count($datas['weekday']['songs']['2']) > 0 ? 'true' : 'false' }}) {
                missingBlocks.push('<p class="text-danger">Песня 2</p>');
            }

            // Проверка блока living
            if (!{{ isset($datas['weekday']['living']) && count($datas['weekday']['living']) > 0 ? 'true' : 'false' }}) {
                missingBlocks.push('<p class="text-danger">Жизнь и служение</p>');
            }

            // Проверка блока songs 3
            if (!{{ isset($datas['weekday']['songs']['3']) && count($datas['weekday']['songs']['3']) > 0 ? 'true' : 'false' }}) {
                missingBlocks.push('<p class="text-danger">Песня 3</p>');
            }



            // Проверка блоков для выходного дня (weekend)
            if (!{{ isset($datas['weekend']['responsible_users']) && count($datas['weekend']['responsible_users']) > 0 ? 'true' : 'false' }}){
                missingBlocks.push('<p class="text-danger">Ответственные (выходной)</p>');
            }

            if (!{{ isset($datas['weekend']['songs']['1']) && count($datas['weekday']['songs']['1']) > 0 ? 'true' : 'false' }}) {
                missingBlocks.push('<p class="text-danger">Песня 1 (выходной)</p>');
            }

            if (!{{ isset($datas['weekend']['public_speech']) && count($datas['weekend']['public_speech']) > 0 ? 'true' : 'false' }}) {
                missingBlocks.push('<p class="text-danger">Публичная речь</p>');
            }

            if (!{{ isset($datas['weekend']['songs']['2']) && count($datas['weekend']['songs']['2']) > 0 ? 'true' : 'false' }}) {
                missingBlocks.push('<p class="text-danger">Песня 2 (выходной)</p>');
            }

            if (!{{ isset($datas['weekend']['watchtower']) && count($datas['weekend']['watchtower']) > 0 ? 'true' : 'false' }}){
                missingBlocks.push('<p class="text-danger">Сторожевая башня</p>');
            }

            if (!{{ isset($datas['weekend']['songs']['3']) && count($datas['weekend']['songs']['3']) > 0 ? 'true' : 'false' }}) {
                missingBlocks.push('<p class="text-danger">Песня 3 (выходной)</p>');
            }

            if (missingBlocks.length > 0) {
                missingBlockInfo.innerHTML = 'Следующие блоки не заполнены: ' + missingBlocks.join('');
                $('#publishModal').modal('show'); // Отображаем модальное окно
            } else {
                // Если все блоки заполнены, отправляем форму
                document.getElementById('publishForm').submit();
            }
        }
    </script>


    @else
        нет данных
    @endif

@endsection
