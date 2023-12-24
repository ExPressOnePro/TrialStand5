@extends('BootstrapApp.layouts.bootstrapApp')
{{--@extends('Mobile.layouts.front.app')--}}
@section('title') Meeper | Собрание @endsection
@section('content')

    <div class="content container-fluid">

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

            <!-- Table -->
            <div class="table-responsive datatable-custom mb-5">
                <table id="example" class=" table-borderless table-thead-bordered table-nowrap table-align-middle card-table">

                    <thead class="thead-light">
                    <tr>
                        <th>Фамилия Имя</th>
                        <th class="d-none d-sm-table-cell">Почта</th>
                        <th class="d-none d-sm-table-cell">Номер телефона</th>
                        <th class="d-none d-sm-table-cell">Адрес</th>
                        <th>Настройки</th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($users as $user)
                        @php
                            $user_id = $user->id
                        @endphp
                        <tr>
                            <td>
                                {{--                        <a class="d-flex align-items-center" href="{{route('userCard', $user->id)}}">--}}
                                <div class="ms-3">
                                    <span class="d-block h5 text-inherit mb-0">{{$user->last_name}} {{ $user->first_name}}</span>
                                </div>
                                {{--                        </a>--}}
                            </td>
                            <td class="d-none d-sm-table-cell">
                                <span class="d-block h5 mb-0">{{ $user->email}}</span>

                            </td>
                            <td class="d-none d-sm-table-cell">
                                @if (isset($user->info) && $decodedInfo = json_decode($user->info, true))
                                    @if (isset($decodedInfo['mobile_phone']) && !empty($decodedInfo['mobile_phone']))
                                        <span class="d-block h5 mb-0">{{ $decodedInfo['mobile_phone'] }}</span>
                                    @else
                                        <span class="d-block h5 mb-0">-</span>
                                    @endif
                                @endif
                            </td>
                            <td class="d-none d-sm-table-cell">
                                @if (isset($user->info) && $decodedInfo = json_decode($user->info, true))
                                    @if (isset($decodedInfo['address']) && !empty($decodedInfo['address']))
                                        <span class="d-block h5 mb-0">{{ $decodedInfo['address'] }}</span>
                                    @else
                                        <span class="d-block h5 mb-0">-</span>
                                    @endif
                                @endif
                            </td>
                            <td>
                                <div class="d-flex flex-grow-1">
                                    <div class="col-auto">
                                        @if (isset($user->info) && $decodedInfo = json_decode($user->info, true))
                                            @if (isset($decodedInfo['mobile_phone']) && !empty($decodedInfo['mobile_phone']))
                                                <button class="btn btn-outline-primary" onclick="callNumber('{{$decodedInfo['mobile_phone']}}')">
                                                    <i class="fa-solid fa-phone"></i>
                                                </button>
                                            @endif
                                        @endif
                                        {{--                                            <a class="btn btn-white ms-2" data-bs-toggle="modal" data-bs-target="#editUserModal{{$user->id}}">--}}
                                        {{--                                            <i class="fa-solid fa-gear"></i>--}}
                                        {{--                                        </a>--}}
                                        <button class="btn btn-white ms-2" onclick="openModal('{{$user->id}}', '{{$user->last_name}}', '{{$user->first_name}}')">
                                            <i class="fa-solid fa-gear"></i>
                                        </button>
                                    </div>
                                </div>
                            </td>
                        </tr>

                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Модальное окно -->
        <div class="modal fade mb-5" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <!-- Заголовок модального окна -->
                    <div class="modal-header">
                        <h5 class="modal-title" id="editUserModalLabel">Изменения пользователя</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <!-- Тело модального окна -->
                    <div class="modal-body">
                        <!-- Тут ваш контент для модального окна -->
                        <form id="editUserForm">
                            <!-- Форма для редактирования пользователя -->
                            <input type="hidden" class="form-control" id="userIdInput" name="userIdInput">
                            <div class="mb-4">
                                <label for="editLastNameModal" class="form-label">Фамилия</label>
                                <input type="text" class="form-control" id="editLastNameModal" name="editLastNameModal">
                            </div>
                            <div class="mb-4">
                                <label for="editFirstNameModal" class="form-label">Имя</label>
                                <input type="text" class="form-control" id="editFirstNameModal" name="editFirstNameModal">
                            </div>
                            <!-- Другие поля для редактирования -->

                            <!-- Кнопки "Отменить" и "Сохранить" -->
                            <div class="d-flex justify-content-end">
                                <div class="d-flex gap-3">
                                    <button type="button" class="btn btn-white" data-bs-dismiss="modal" aria-label="Close">Отменить</button>
                                    <button type="button" class="btn btn-primary" onclick="saveChanges()">Сохранить</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>


        {{--            @include('BootstrapApp.Modules.congregations.components.DesktopUsersList')--}}

    </div>
    <script>
        function openModal(userId, lastName, firstName) {
            var modal = new bootstrap.Modal(document.getElementById('editUserModal'));

            // Подставляем данные в форму модального окна
            document.getElementById('editLastNameModal').value = lastName;
            document.getElementById('editFirstNameModal').value = firstName;
            document.getElementById('userIdInput').value = userId;

            // Открываем модальное окно
            modal.show();
        }

        function saveChanges() {
            // Собираем данные из формы
            var formData = new FormData(document.getElementById('editUserForm'));

            // Добавляем CSRF-токен к данным
            formData.append('_token', '{{ csrf_token() }}');

            // AJAX-запрос на обновление профиля
            $.ajax({
                type: 'POST',
                url: '{{ route('update.profile.congr', $user_id) }}',
                data: formData,
                processData: false,
                contentType: false,
                success: function (data) {
                    console.log('Профиль успешно обновлен', document.getElementById('userIdInput').value)
                    location.reload();
                },
                error: function (xhr, status, error) {
                    // Обработка ошибки
                    console.error('Ошибка при обновлении профиля:', error);
                }
            });

            // Закрытие модального окна
            var modal = new bootstrap.Modal(document.getElementById('editUserModal'));
            modal.hide();
        }
    </script>
    <script>

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

    </script>


    <script>

        function callNumber(phoneNumber) {
            window.location.href = 'tel:' + phoneNumber;
        }
    </script>


@endsection
