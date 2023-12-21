<div class="row justify-content-between align-items-center flex-grow-1 mb-3">
    <div class="col">
        <!-- Filter -->
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
        <!-- End Filter -->
    </div>
</div>

<!-- Table -->
<div class="card-body table-responsive datatable-custom mb-5">
    <table class="js-datatable table table-nowrap table-align-middle"
           data-hs-datatables-options='{
                   "order": [],
               "paging": false,
                   "search": "#datatableWithSearchInput",
                   "info": {
                     "totalQty": "#datatableEntriesInfoTotalQty"
                   },
                   "isResponsive": false,
                   "isShowPaging": false,
                   "dom": "lrtip",
                   "order": []
                 }'>
        <thead class="bg-light text-center">
        <tr class="">
            <th>Имя фамилия</th>
        </tr>
        </thead>

        <tbody>
        @foreach($users as $user)
            <tr>
                <td>
                    <div class="d-flex">
                        <div class="d-flex flex-grow-1">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h5 class="mb-1">{{ $user->last_name }} {{ $user->first_name }}</h5>
                                    @if (isset($user->info) && $decodedInfo = json_decode($user->info, true))
                                        @if (isset($decodedInfo['mobile_phone']) && !empty($decodedInfo['mobile_phone']))
                                            <div class="h3"><span class="badge bg-secondary">{{ $decodedInfo['mobile_phone'] }}</span></div>
                                        @endif
                                    @endif
                                </div>
                                <!-- End Col -->

                                <div class="col-auto">
                                    @if (isset($user->info) && $decodedInfo = json_decode($user->info, true))
                                        @if (isset($decodedInfo['mobile_phone']) && !empty($decodedInfo['mobile_phone']))
                                            <button class="btn btn-outline-primary" onclick="callNumber('{{$decodedInfo['mobile_phone']}}')">
                                                <i class="fa-solid fa-phone"></i>
                                            </button>
                                        @endif
                                    @endif
                                        <a class="btn btn-white ms-2" onclick="openModal('{{$user->id}}')" data-bs-toggle="modal" data-bs-target="#editUserModal{{$user->id}}">
                                            <i class="fa-solid fa-gear"></i>
                                        </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

<div class="modal fade mb-5" id="editUserModal{{$user->id}}" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editUserModalLabel">Изменения пользователя</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- Body -->
            <div class="modal-body">
                <!-- Tab Content -->
                <div class="tab-content" id="editUserModalTabContent">
                    <div class="tab-pane fade active show" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        <form action="{{ route('update.profile.congr', $user->id) }}" method="post">
                            @csrf
                            <!-- Form -->
                            <div class="row mb-4">
                                <label for="editFirstNameModalLabel" class="col-sm-3 col-form-label form-label">Полное имя <i class="tio-help-outlined text-body ms-1" data-bs-toggle="tooltip" data-bs-placement="top" aria-label="Displayed on public forums, such as Front." data-bs-original-title="Displayed on public forums, such as Front."></i></label>

                                <div class="col-sm-9">
                                    <div class="input-group input-group-sm-vertical">

                                        <input type="text" class="form-control" name="editLastNameModal" id="editLastNameModalLabel" placeholder="Your last name" aria-label="Your last name" value="{{$user->last_name}}">
                                        <input type="text" class="form-control" name="editFirstNameModal" id="editFirstNameModalLabel" placeholder="Your first name" aria-label="Your first name" value="{{$user->first_name}}">

                                    </div>
                                </div>
                            </div>
                            <!-- End Form -->

                            <div class="d-flex justify-content-end">
                                <div class="d-flex gap-3">
                                    <button type="button" class="btn btn-white" data-bs-dismiss="modal" aria-label="Close">Отменить</button>
                                    <button type="submit" class="btn btn-primary">Сохранить</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- End Tab Content -->
            </div>
            <!-- End Body -->
        </div>
    </div>
</div>

<script>
    function openModal(userId) {
        // Получаем ссылку на модальное окно по его идентификатору
        var modalId = 'editUserModal' + userId;
        var myModal = new bootstrap.Modal(document.getElementById(modalId));
        // Открываем модальное окно
        myModal.show();
    }
</script>
