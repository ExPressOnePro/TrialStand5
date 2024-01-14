<div class="card">
    <div class="card-header">
        <div class="row justify-content-between align-items-center flex-grow-1">

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


            <div class="col-auto">
                <!-- Dropdown -->
                <div class="dropdown me-2">
                    <button type="button" class="btn btn-white btn-sm dropdown-toggle" id="usersExportDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi-download me-2"></i> Export
                    </button>
                    <div class="dropdown-menu dropdown-menu-sm-end" aria-labelledby="usersExportDropdown">
                        <span class="dropdown-header">Options</span>
                        <a id="export-copy" class="dropdown-item" href="javascript:;">
                            <img src="{{ asset('front/svg/illustrations/copy-icon.svg') }}" width="32px" height="32px">
                            Copy
                        </a>
                        <a id="export-print" class="dropdown-item" href="javascript:;">
                            <img class="avatar avatar-xss avatar-4x3 me-2" src="{{ asset('front/svg/illustrations/print-icon.svg') }}" width="32px" height="32px">
                            Print
                        </a>
                        <div class="dropdown-divider"></div>
                        <span class="dropdown-header">Download options</span>
                        <a id="export-excel" class="dropdown-item" href="javascript:;">
                            <img class="avatar avatar-xss avatar-4x3 me-2" src="{{ asset('front/svg/brands/excel-icon.svg') }}" width="32px" height="32px">
                            Excel
                        </a>
                        <a id="export-csv" class="dropdown-item" href="javascript:;">
                            <img class="avatar avatar-xss avatar-4x3 me-2" src="{{ asset('front/svg/components/placeholder-csv-format.svg') }}" width="32px" height="32px">
                            .CSV
                        </a>
                        <a id="export-pdf" class="dropdown-item" href="javascript:;">
                            <img class="avatar avatar-xss avatar-4x3 me-2" src="{{ asset('front/svg/brands/pdf-icon.svg') }}" width="32px" height="32px">
                            PDF
                        </a>
                    </div>
                </div>
                <!-- End Dropdown -->
            </div>
        </div>
    </div>

    <!-- Table -->
    <div class="table-responsive datatable-custom">
        <table id="example"  class=" js-datatable table table-borderless table-thead-bordered table-nowrap table-align-middle"
               data-hs-datatables-options='{
               "order": [],
               "paging": false,
                   "search": "#datatableWithSearchInput",
                   "info": {
                     "totalQty": "#datatableEntriesInfoTotalQty"
                   },
                   "entries": "#datatableEntries",
                   "isResponsive": false,
                   "isShowPaging": false,
                   "pagination": "datatableEntriesPagination",
                   "dom": "lrtip",
                    "buttons": [
                      {
                        "extend": "copy",
                        "className": "d-none"
                      },
                      {
                        "extend": "excel",
                        "className": "d-none"
                      },
                      {
                        "extend": "csv",
                        "className": "d-none"
                      },
                      {
                        "extend": "pdf",
                        "className": "d-none"
                      },
                      {
                        "extend": "print",
                        "className": "d-none"
                      }
                   ],
                   "order": []

                 }'>
            <thead class="thead-light">
            <tr>
                <th>Фамилия Имя</th>
                <th>Логин</th>
                <th class="d-sm-table-cell">Почта</th>
                <th class="d-sm-table-cell">Номер телефона</th>
                <th class="d-sm-table-cell">Адрес</th>
                <th>Настройки</th>
            </tr>
            </thead>

            <tbody>
            @foreach($users as $user)
                <tr>
                    <td>
{{--                        <a class="d-flex align-items-center" href="{{route('userCard', $user->id)}}">--}}
                            <div>
                                <span class="d-block h5 text-inherit mb-0">{{$user->last_name}} {{ $user->first_name}}</span>
                            </div>
{{--                        </a>--}}
                    </td>
                    <td>
                        <div>
                            <span class="d-block h5 text-inherit mb-0">{{$user->login}}</span>
                        </div>
                    </td>
                    <td class="d-sm-table-cell">
                        <span class="d-block h5 mb-0">{{ $user->email}}</span>
                    </td>
                    <td class="d-sm-table-cell">
                        @if (isset($user->info) && $decodedInfo = json_decode($user->info, true))
                            @if (isset($decodedInfo['mobile_phone']) && !empty($decodedInfo['mobile_phone']))
                                <span class="d-block h5 mb-0">{{ $decodedInfo['mobile_phone'] }}</span>
                            @else
                                <span class="d-block h5 mb-0">-</span>
                            @endif
                        @endif
                    </td>
                    <td class="d-sm-table-cell">
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
                                <a class="btn btn-secondary  ms-2" onclick="openModal('{{$user->id}}')" data-bs-toggle="modal" data-bs-target="#editUserModal{{$user->id}}">
                                    <i class="fa-solid fa-gear">open modal</i>
                                </a>
                            </div>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
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
