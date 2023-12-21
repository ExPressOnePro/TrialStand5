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
                            <img class="avatar avatar-xss avatar-4x3 me-2" src="{{asset('front/svg/illustrations/copy-icon.svg')}}" alt="Image Description">
                            Copy
                        </a>
                        <a id="export-print" class="dropdown-item" href="javascript:;">
                            <img class="avatar avatar-xss avatar-4x3 me-2" src="{{asset('front/svg/illustrations/print-icon.svg')}}" alt="Image Description">
                            Print
                        </a>
                        <div class="dropdown-divider"></div>
                        <span class="dropdown-header">Download options</span>
                        <a id="export-excel" class="dropdown-item" href="javascript:;">
                            <img class="avatar avatar-xss avatar-4x3 me-2" src="{{asset('front/svg/brands/excel-icon.svg')}}" alt="Image Description">
                            Excel
                        </a>
                        <a id="export-csv" class="dropdown-item" href="javascript:;">
                            <img class="avatar avatar-xss avatar-4x3 me-2" src="{{asset('front/svg/components/placeholder-csv-format.svg')}}" alt="Image Description">
                            .CSV
                        </a>
                        <a id="export-pdf" class="dropdown-item" href="javascript:;">
                            <img class="avatar avatar-xss avatar-4x3 me-2" src="{{asset('front/svg/brands/pdf-icon.svg')}}" alt="Image Description">
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
        <table id="exportDatatable" class="js-datatable table table-borderless table-thead-bordered table-nowrap table-align-middle card-table"
               data-hs-datatables-options='{
               "order": [],
                   "search": "#datatableWithSearchInput",
                   "info": {
                     "totalQty": "#datatableEntriesInfoTotalQty"
                   },
                   "entries": "#datatableEntries",
                   "isResponsive": false,
                   "isShowPaging": false,
                   "pagination": "datatableEntriesPagination",
                    "dom": "Bfrtip",
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
                <th>Почта</th>
                <th>Номер телефона</th>
                <th>Адрес</th>
            </tr>
            </thead>

            <tbody>
            @foreach($users as $user)
                <tr>
                    <td>
                        <a class="d-flex align-items-center" href="{{route('userCard', $user->id)}}">
                            <div class="ms-3">
                                <span class="d-block h5 text-inherit mb-0">{{$user->last_name}} {{ $user->first_name}}</span>
                            </div>
                        </a>
                    </td>
                    <td>
                        <span class="d-block h5 mb-0">{{ $user->email}}</span>

                    </td>
                    <td>
                        @if (isset($user->info) && $decodedInfo = json_decode($user->info, true))
                            @if (isset($decodedInfo['mobile_phone']) && !empty($decodedInfo['mobile_phone']))
                                <span class="d-block h5 mb-0">{{ $decodedInfo['mobile_phone'] }}</span>
                            @endif
                        @endif
                    </td>
                    <td>
                        @if (isset($user->info) && $decodedInfo = json_decode($user->info, true))
                            @if (isset($decodedInfo['address']) && !empty($decodedInfo['address']))
                                <span class="d-block h5 mb-0">{{ $decodedInfo['address'] }}</span>
                            @endif
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <div class="card-footer mt-4">
        <!-- Pagination -->
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
                            <option value="4">4</option>
                            <option value="6">6</option>
                            <option value="8" selected>8</option>
                            <option value="20">20</option>
                        </select>
                    </div>
                    <!-- End Select -->

                    <span class="text-secondary me-2">из</span>

                    <!-- Pagination Quantity -->
                    <span id="datatableEntriesInfoTotalQty"></span>
                </div>
            </div>

            <div class="col-sm-auto">
                <div class="d-flex justify-content-center justify-content-sm-end">
                    <!-- Pagination -->
                    <nav id="datatableEntriesPagination" aria-label="Activity pagination"></nav>
                </div>
            </div>
        </div>
        <!-- End Pagination -->
    </div>
</div>

