@extends('Mobile.layouts.front.app')
@section('title') Meeper | Контакты @endsection
@section('content')

    <div class="content container-fluid">
            <!-- Header -->

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

            <!-- End Header -->

            <!-- Table -->
            <div class="card-body table-responsive datatable-custom">
                <table class="js-datatable table table-nowrap table-align-middle"
                       data-hs-datatables-options='{
                   "order": [],
                   "search": "#datatableWithSearchInput",
                   "info": {
                     "totalQty": "#datatableEntriesInfoTotalQty"
                   },
                   "entries": "#datatableEntries",
                   "isResponsive": false,
                   "isShowPaging": false,
                   "pagination": "datatableEntriesPagination"
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
                                <div class="flex-grow-1">
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
            <!-- End Table -->

        <!-- Footer -->
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
        <!-- End Footer -->
    </div>

    <script>
        function callNumber(phoneNumber) {
            window.location.href = 'tel:' + phoneNumber;
        }
    </script>

@endsection
