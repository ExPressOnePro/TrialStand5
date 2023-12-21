@extends('Mobile.layouts.front.profile')
@section('title') Meeper @endsection
@section('content')

    <div class="content container-fluid mt-8">

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


                    <div class="col-md-auto">
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
                    <tr role="row">
                        <th>Возвещатель</th>
                        @foreach($permissionsPublishers as $permission)
                            @if($permission->name == 'module.stand')
                                <th>Просмотреть</th>
                            @elseif($permission->name == 'stand.make_entry')
                                <th>Записаться</th>
                            @elseif($permission->name == 'stand.delete_entry')
                                <th>Выписаться</th>
                            @elseif($permission->name == 'stand.change_entry')
                                <th>Изменить запись</th>
                            @endif
                        @endforeach
                    </tr>
                    </thead>

                    <tbody>
                    <form method="POST" action="{{ route('updatePerm') }}">
                        @csrf
                    @foreach($usersCongregation as $user)
                        <tr class="border-bottom">
                            <td>{{ $user->last_name }} {{ $user->first_name }}</td>
                            @foreach($permissionsPublishers as $permission)
                                <td>
                                    <label class="form-check form-switch m-1">
                                        <input type="hidden" name="permissions[{{ $user->id }}][{{ $permission->id }}]" value="0">
                                        <input type="checkbox" class="form-check-input" name="permissions[{{ $user->id }}][{{ $permission->id }}]" value="1" {{ $user->hasPermission($permission->name) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="formSwitch{{ $permission->id }}"></label>
                                    </label>
                                </td>
                            @endforeach
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>
@endsection
