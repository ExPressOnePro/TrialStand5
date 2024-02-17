{{--<div class="card mb-5">--}}
{{--    <a class="btn btn-primary" href="{{ route('congregation.createU', $congregation->id) }}">--}}
{{--        Создать нового пользователя--}}
{{--    </a>--}}
{{--</div>--}}

<style>
    #example tbody tr:hover {
        background-color: #f5f5f5; /* Цвет выделения при наведении */
    }
</style>

<div class="row mb-5">
    <div class="col-lg-4 col-md-6">
        <div class="list-group">
            <a href="{{ route('congregation.createU', $congregation->id) }}" class="list-group-item list-group-item-action">
                <i class="fa fa-plus-circle text-success"></i>
                Создать нового пользователя
            </a>
            <button class="list-group-item list-group-item-action" onclick="inviteNewUser('{{$congregation->id}}')">
                <i class="fa fa-envelope-open text-success"></i>
                Добавить нового пользователя по коду
            </button>
        </div>
    </div>
</div>

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
        <table id="example" class=" table-borderless table-thead-bordered nowrap table-align-middle card-table">

            <thead class="thead-light">
            <tr>
                <th>Фамилия Имя</th>
                <th class="d-none d-sm-table-cell">Логин</th>
                <th class="d-none d-sm-table-cell">Почта</th>
                <th class="d-none d-sm-table-cell">Номер телефона</th>
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
                        <div class="ms-3">
                            <span class="d-block h5 text-inherit mb-0">{{$user->last_name}} {{ $user->first_name}}</span>
                        </div>
                        {{--                        </a>--}}
                    </td>
                    <td class="d-none d-sm-table-cell">
                        <div>
                            <span class="d-block h5 mb-0">{{$user->login}}</span>
                        </div>
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

                    <td>
                        <div class="d-flex flex-grow-1">
                            <div class="col-auto">
                                <button class="btn btn-secondary ms-2" onclick="openModal('{{$user->id}}', '{{$user->last_name}}', '{{$user->first_name}}', '{{$decodedInfo['mobile_phone'] ?? ''}}')">
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


<div class="modal fade  mb-5" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen modal-lg">
        <div class="modal-content">


            <div class="modal-header">
                <h5 class="modal-title" id="editUserModalLabel">Изменения пользователя</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- Тело модального окна -->
            <div class="modal-body">

                <div class="card-body">
                    <!-- Form -->
                    <div class="row mb-4">
                        <div class="col-sm-9">
                            <div class="d-flex align-items-center">

                                <h1 class="avatar display-1"><i class="fas fa-user"></i></h1>
                                <div class="ms-3">
                                    <h5 class="mb-2"><strong></strong></h5>
                                    <h5 class="mb-2"><strong></strong></h5>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="bd-example m-0 border-0">
                        <nav>
                            <div class="nav nav-tabs mb-3" id="nav-tab" role="tablist">
                                <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Основные</button>
                                <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false" tabindex="-1">Пароль и вход</button>
                                <button class="nav-link text-danger" id="nav-delete-tab" data-bs-toggle="tab" data-bs-target="#nav-delete" type="button" role="tab" aria-controls="nav-delete" aria-selected="false" tabindex="-1">Удаление</button>
                            </div>
                        </nav>
                        <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane fade active show" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                                <form id="editUserForm">
                                    <input type="hidden" class="form-control" id="userIdInput" name="userIdInput">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="mb-4">
                                                <label for="editLastNameModal" class="form-label">Фамилия</label>
                                                <input type="text" class="form-control" id="editLastNameModal" name="editLastNameModal">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-4">
                                                <label for="editFirstNameModal" class="form-label">Имя</label>
                                                <input type="text" class="form-control" id="editFirstNameModal" name="editFirstNameModal">
                                            </div>
                                        </div>
                                        <div class="form-outline">
                                            <label class="form-label" for="typePhone">Номер телефона</label>
                                            <input type="tel" id="typePhone" class="form-control" name="typePhone">
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-end mt-5">
                                        <div class="d-flex gap-3">
                                            <button type="button" class="btn btn-white" data-bs-dismiss="modal" aria-label="Close">Отменить</button>
                                            <button type="button" class="btn btn-primary" onclick="saveChanges()">Сохранить</button>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">

                                <div id="permissionsList" class="row row-cols-1"></div>

                                <div class="row row-cols-1">
                                    <form method="post" action="{{ route('users.updateGeneratePassword') }}">
                                        @csrf
                                        <label for="code">Сгенерированный пароль:</label>
                                        <div class="row mb-4">
                                            <div class="input-group input-group-merge mb-4">
                                                <input id="pinputfield" class="form-control form-control-rounded" name="pinputfield" minlength="6" required>
                                            </div>
                                            <button type="button" class="btn btn-outline-success" onclick="updatePasswordUser()">Обновить пароль</button>
                                        </div>
                                    </form>
                                </div>

                            </div>

                            <div class="tab-pane fade mb-5" id="nav-delete" role="tabpanel" aria-labelledby="nav-delete">
                                <form id="deleteUserForm mb-5">
                                    <input type="hidden" class="form-control" id="userIdInputDelete" name="userIdInputDelete">
                                    <div class="alert alert-danger" role="alert">
                                        <h4 class="alert-heading">ПРЕДУПРЕЖДЕНИЕ: УДАЛЕНИЕ ПОЛЬЗОВАТЕЛЯ</h4>
                                        <p>Вы собираетесь удалить пользователя из системы. Пожалуйста, ознакомьтесь с следующей информацией перед продолжением:</p>
                                        <ul>
                                            <li><strong>ПОТЕРЯ ДОСТУПА:</strong> Удаление пользователя приведет к потере его доступа ко всем системным ресурсам и данным. Пользователь больше не сможет входить в систему или использовать свои учетные данные.</li>
                                            <li><strong>УДАЛЕНИЕ ДАННЫХ:</strong> Все данные, принадлежащие данному пользователю, будут удалены. Это включает в себя файлы, папки, настройки и другие личные данные.</li>
                                            <li><strong>НЕОБРАТИМОСТЬ:</strong> Действие удаления пользователя необратимо. После подтверждения, восстановление учетной записи и данных будет невозможно без предварительного резервного копирования.</li>
                                            <li><strong>ПРЕДВАРИТЕЛЬНЫЙ АНАЛИЗ:</strong> Убедитесь, что вы правильно выбрали пользователя для удаления. Предварительно оцените его роль, права доступа и любые связанные аспекты.</li>
                                        </ul>
                                        <hr>
                                        <p class="mb-0">Пожалуйста, подтвердите свое намерение удалить пользователя, введя его имя и фамилию</p>
                                        <div class="row align-items-center">
                                            <input type="text" class="form-control mb-2" id="nameInput" placeholder="фамилия, имя">
                                            <button type="button" class="btn btn-danger" onclick="deleteUser()">Подтвердить удаление</button>
                                        </div>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    {{--            @include('BootstrapApp.Modules.congregations.components.DesktopUsersList')--}}

</div>
<div class="modal fade  mb-5" id="inviteNewUser" tabindex="-1" aria-labelledby="inviteNewUserModalLabel" style="display: none;" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">


            <div class="modal-header">
                <h5 class="modal-title" id="editUserModalLabel">Добавление пользователя по коду</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- Тело модального окна -->
            <div class="modal-body">

                <div class="card-body p-4">
                    <div class="row">
                        <form id="inviteNewUserPerCode">
                            <label for="code">Введите код пользователя</label>
                            <div class="row mb-4">
                                <input id="code" class="form-control form-control-rounded mb-2" name="code" required>
                                <button type="button" class="btn btn-outline-success" onclick="inviteNewUserPerCode({{ $congregation->id }})">Присоединить пользователя</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    function inviteNewUser() {
        var modal = new bootstrap.Modal(document.getElementById('inviteNewUser'));
        modal.show();
    }
    function inviteNewUserPerCode(congregationId) {
        var formData = new FormData(document.getElementById('inviteNewUserPerCode'));
        formData.append('_token', '{{ csrf_token() }}');
        formData.append('congregationId', congregationId);

        $.ajax({
            type: 'POST',
            url: '{{ route('connect.user') }}',
            data: formData,
            processData: false,
            contentType: false,
            success: function (data) {
                console.log('Пользователь добавлен', document.getElementById('inviteNewUserPerCode').value)
                location.reload();
            },
            error: function (xhr) {
                var errors = xhr.responseJSON.errors;

                $(".form-error").remove();

                for (error in errors) {
                    // Найдите соответствующее поле ввода и добавьте сообщение об ошибке под ним
                    var input = $('input[name=' + error + ']');
                    var errorMessage = '<span id="' + error + '-error" class="alert bg-light form-error text-danger">' + errors[error][0] + '</span>';
                    input.after(errorMessage);
                }
            }
        });

        var modal = new bootstrap.Modal(document.getElementById('inviteNewUser'));
        modal.hide();
    }

    var deleteModalLastName;
    var deleteModalFirstName;

    function openModal(userId, lastName, firstName, phoneNumber) {
        var modal = new bootstrap.Modal(document.getElementById('editUserModal'));

        deleteModalLastName = lastName;
        deleteModalFirstName = firstName;

        document.getElementById('editLastNameModal').value = lastName;
        document.getElementById('editFirstNameModal').value = firstName;
        document.getElementById('userIdInput').value = userId;
        document.getElementById('userIdInputDelete').value = userId;
        document.querySelector('#editUserModal h5.mb-2:first-of-type strong').innerText = lastName;
        document.querySelector('#editUserModal h5.mb-2:last-of-type strong').innerText = firstName;
        document.getElementById('typePhone').value = phoneNumber || '';

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
    function deleteUser() {
        // Получаем значение введенного имени и фамилии
        var enteredName = $("#nameInput").val();

        // Проверяем совпадение имени и фамилии
        if (enteredName === (deleteModalLastName + " " + deleteModalFirstName)) {
            // Создаем объект FormData и добавляем данные формы
            var formData = new FormData();
            formData.append('_token', '{{ csrf_token() }}');
            formData.append('userIdInputDelete', document.getElementById('userIdInputDelete').value);


            $.ajax({
                type: 'POST',
                url: '{{ route('delete.profile.congr', $user_id) }}',
                data: formData,
                processData: false,
                contentType: false,
                success: function (data) {
                    console.log('Профиль успешно удален', document.getElementById('userIdInputDelete').value);
                    var modal = new bootstrap.Modal(document.getElementById('editUserModal'));
                    modal.hide();
                    location.reload();
                },
                error: function (xhr, status, error) {
                    // Обработка ошибки
                    console.error('Ошибка при удалении профиля:', error);
                }
            });
        } else {
            // Выводим сообщение об ошибке, если имя и фамилия не совпадают
            alert("Неверные данные пользователя. Пожалуйста, проверьте имя и фамилию.");
        }
    }


    function updatePasswordUser() {
        var userId = document.getElementById('userIdInput').value;
        var newPassword = document.getElementById('pinputfield').value;

        if (pinputfield.value.length < 6) {
            // Вывести ошибку, если пароль меньше 6 символов
            alert('Пароль должен содержать не менее 6 символов');
            return;
        }

        $.ajax({
            url: '{{ route('users.updateGeneratePassword') }}',
            type: 'POST',
            data: {
                userIdInput: userId,
                code: newPassword,
                _token: '{{ csrf_token() }}'
            },
            success: function (response) {
                console.log('yeap');
            },
            error: function (error) {
                console.error('nope');
            }
        });
    }
</script>


<script>

    $(document).ready(function() {
        $('#example').DataTable( {
            dom: 'Blt',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ],
            paging: false, // Disable paging
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
