@extends('Mobile.layouts.front.home')
@section('title') Meeper @endsection
@section('content')

    {{--    <div class="content container-fluid">--}}
    {{--        <div class="row justify-content-lg-center">--}}
    {{--            <div class="col-lg-9">--}}
    {{--                <div class="d-grid gap-3 gap-lg-5">--}}
    {{--                    <div class="card">--}}
    {{--                        <div class="card-header card-header-content-between">--}}
    {{--                            <h4 class="card-header-title">23 Августа</h4>--}}
    {{--                            <h4 class="card-header-title">Среда 19:00</h4>--}}
    {{--                        </div>--}}
    {{--                    </div>--}}
    {{--                        <div class="card card-body">--}}
    {{--                            <ul class="list-unstyled list-py-1 mb-0">--}}
    {{--                                <li class="d-flex align-items-center fs-6">--}}
    {{--                                    <span class="me-3">Распорядитель улица</span>--}}
    {{--                                    <dd class="ms-3 mb-0">{{ $responsible_users['entry_manager']->last_name }} {{ $responsible_users['entry_manager']->first_name }}</dd>--}}
    {{--                                </li>--}}
    {{--                                <li class="d-flex align-items-center fs-6">--}}
    {{--                                    <span class="me-3">Распорядитель улица</span>--}}
    {{--                                    <dd class="ms-3 mb-0">{{ $responsible_users['lobby_manager']->last_name }} {{ $responsible_users['lobby_manager']->first_name }}</dd>--}}
    {{--                                </li>--}}
    {{--                                <li class="d-flex align-items-center fs-6">--}}
    {{--                                    <span class="me-3">Распорядитель улица</span>--}}
    {{--                                    <dd class="ms-3 mb-0">{{ $responsible_users['hall_manager']->last_name }} {{ $responsible_users['hall_manager']->first_name }}</dd>--}}
    {{--                                </li>--}}
    {{--                                <li class="d-flex align-items-center fs-6">--}}
    {{--                                    <span class="me-3 ">Распорядитель улица</span>--}}
    {{--                                    <dd class="ms-3 mb-0">{{ $responsible_users['scene_manager']->last_name }} {{ $responsible_users['scene_manager']->first_name }}</dd>--}}
    {{--                                </li>--}}
    {{--                            </ul>--}}

    {{--                            <hr>--}}

    {{--                            <ul class="list-unstyled list-py-1 mb-0">--}}
    {{--                                <li class="d-flex align-items-center fs-6">--}}
    {{--                                    <span class="me-3">Распорядитель улица</span>--}}
    {{--                                    <dd class="ms-3 mb-0">{{ $responsible_users['entry_manager']->last_name }} {{ $responsible_users['entry_manager']->first_name }}</dd>--}}
    {{--                                </li>--}}
    {{--                                <li class="d-flex align-items-center fs-6">--}}
    {{--                                    <span class="me-3">Распорядитель улица</span>--}}
    {{--                                    <dd class="ms-3 mb-0">{{ $array['lobby_manager'] }}</dd>--}}
    {{--                                </li>--}}
    {{--                                <li class="d-flex align-items-center fs-6">--}}
    {{--                                    <span class="me-3">Распорядитель улица</span>--}}
    {{--                                    <dd class="ms-3 mb-0 badge bg-primary">{{ $array['hall_manager'] }}</dd>--}}
    {{--                                </li>--}}
    {{--                                <li class="d-flex align-items-center fs-6">--}}
    {{--                                    <span class="me-3 ">Распорядитель улица</span>--}}

    {{--                                    <dd class="ms-3 mb-0">{{ $array['scene_manager'] }}</dd>--}}
    {{--                                </li>--}}
    {{--                            </ul>--}}
    {{--                        </div>--}}



    {{--                        <hr class="my-3">--}}

    {{--                        <!-- Body -->--}}
    {{--                        <div class="card-body">--}}
    {{--                            <div class="row align-items-center flex-grow-1 mb-2">--}}
    {{--                                <div class="col">--}}
    {{--                                    <h4 class="card-header-title">Storage usage</h4>--}}
    {{--                                </div>--}}
    {{--                                <!-- End Col -->--}}

    {{--                                <div class="col-auto">--}}
    {{--                                    <span class="text-dark fw-semibold">4.27 GB</span> used of 6 GB--}}
    {{--                                </div>--}}
    {{--                                <!-- End Col -->--}}
    {{--                            </div>--}}
    {{--                            <!-- End Row -->--}}

    {{--                            <!-- Progress -->--}}
    {{--                            <div class="progress rounded-pill mb-3">--}}
    {{--                                <div class="progress-bar" role="progressbar" style="width: 33%;" aria-valuenow="33" aria-valuemin="0" aria-valuemax="100"></div>--}}
    {{--                                <div class="progress-bar" role="progressbar" style="width: 25%; opacity: .6" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>--}}
    {{--                            </div>--}}
    {{--                            <!-- End Progress -->--}}

    {{--                            <!-- Legend Indicators -->--}}
    {{--                            <ul class="list-inline list-px-2">--}}
    {{--                                <li class="list-inline-item">--}}
    {{--                                    <span class="legend-indicator bg-primary"></span> Personal usage space--}}
    {{--                                </li>--}}
    {{--                                <li class="list-inline-item">--}}
    {{--                                    <span class="legend-indicator bg-primary opacity"></span> Shared space--}}
    {{--                                </li>--}}
    {{--                                <li class="list-inline-item">--}}
    {{--                                    <span class="legend-indicator"></span> Unused space--}}
    {{--                                </li>--}}
    {{--                            </ul>--}}
    {{--                            <!-- End Legend Indicators -->--}}
    {{--                        </div>--}}
    {{--                        <!-- End Body -->--}}
    {{--                    </div>--}}
    {{--                    <!-- End Card -->--}}

    {{--                    <!-- Card -->--}}
    {{--                    <div class="card">--}}
    {{--                        <!-- Header -->--}}
    {{--                        <div class="card-header border-bottom">--}}
    {{--                            <h4 class="card-header-title">My address</h4>--}}
    {{--                        </div>--}}
    {{--                        <!-- End Header -->--}}

    {{--                        <!-- Body -->--}}
    {{--                        <div class="card-body">--}}
    {{--                            <div class="row">--}}
    {{--                                <div class="col-sm-6 mb-5 mb-sm-7">--}}
    {{--                                    <!-- Radio Check -->--}}
    {{--                                    <div class="form-check form-check-inline w-100 h-100">--}}
    {{--                                        <input type="radio" id="billingRadio1" name="billingRadio" class="form-check-input" checked="">--}}
    {{--                                        <label class="form-check-label" for="billingRadio1">--}}
    {{--                                            <span class="h5 d-block">Billing address #1</span>--}}

    {{--                                            <span class="d-block mb-2">--}}
    {{--                          45 Roker Terrace<br>--}}
    {{--                          Latheronwheel<br>--}}
    {{--                          KW5 8NW, London<br>--}}
    {{--                          UK <img class="avatar avatar-xss avatar-circle me-1" src="./assets/vendor/flag-icon-css/flags/1x1/gb.svg" alt="Great Britain Flag">--}}
    {{--                        </span>--}}

    {{--                                            <a class="btn btn-white btn-sm" href="./account-settings.html#accountType">--}}
    {{--                                                <i class="bi-pencil-fill me-1"></i> Edit address--}}
    {{--                                            </a>--}}
    {{--                                        </label>--}}
    {{--                                    </div>--}}
    {{--                                    <!-- End Radio Check -->--}}
    {{--                                </div>--}}
    {{--                                <!-- End Col -->--}}

    {{--                                <div class="col-sm-6 mb-5 mb-sm-7">--}}
    {{--                                    <!-- Radio Check -->--}}
    {{--                                    <div class="form-check form-check-inline w-100 h-100">--}}
    {{--                                        <input type="radio" id="billingRadio2" name="billingRadio" class="form-check-input">--}}
    {{--                                        <label class="form-check-label" for="billingRadio2">--}}
    {{--                                            <span class="h5 d-block">Billing address #2</span>--}}

    {{--                                            <span class="d-block mb-2">--}}
    {{--                          27 Thornton St<br>--}}
    {{--                          Hundleby<br>--}}
    {{--                          PE23 0ZJ, Manchester<br>--}}
    {{--                          UK <img class="avatar avatar-xss avatar-circle me-1" src="./assets/vendor/flag-icon-css/flags/1x1/gb.svg" alt="Great Britain Flag">--}}
    {{--                        </span>--}}

    {{--                                            <a class="btn btn-white btn-sm" href="./account-settings.html#accountType">--}}
    {{--                                                <i class="bi-pencil-fill me-1"></i> Edit address--}}
    {{--                                            </a>--}}
    {{--                                        </label>--}}
    {{--                                    </div>--}}
    {{--                                    <!-- End Radio Check -->--}}
    {{--                                </div>--}}
    {{--                                <!-- End Col -->--}}

    {{--                                <div class="col-sm-6 mb-5 mb-sm-7">--}}
    {{--                                    <!-- Card -->--}}
    {{--                                    <a class="card card-dashed card-centered" href="javascript:;" data-bs-toggle="modal" data-bs-target="#accountAddAddressModal">--}}
    {{--                                        <div class="card-body card-dashed-body py-8">--}}
    {{--                                            <img class="avatar avatar-lg avatar-4x3 mb-2" src="./assets/svg/illustrations/oc-address.svg" alt="Image Description" data-hs-theme-appearance="default">--}}
    {{--                                            <img class="avatar avatar-lg avatar-4x3 mb-2" src="./assets/svg/illustrations-light/oc-address.svg" alt="Image Description" data-hs-theme-appearance="dark">--}}
    {{--                                            <span><i class="bi-plus"></i> Add a new address</span>--}}
    {{--                                        </div>--}}
    {{--                                    </a>--}}
    {{--                                    <!-- End Card -->--}}
    {{--                                </div>--}}
    {{--                                <!-- End Col -->--}}
    {{--                            </div>--}}
    {{--                            <!-- End Row -->--}}

    {{--                            <div class="mb-4">--}}
    {{--                                <h4>Tax location</h4>--}}
    {{--                                <p class="mb-0">UK - 20.00% SST</p>--}}
    {{--                                <a class="link" href="#">More info</a>--}}
    {{--                            </div>--}}

    {{--                            <p class="mb-0">Your text location determines the taxes that are applied to your bill.</p>--}}
    {{--                            <a class="link" href="#">How do I correct my tax location?</a>--}}
    {{--                        </div>--}}
    {{--                        <!-- End Body -->--}}
    {{--                    </div>--}}
    {{--                    <!-- End Card -->--}}

    {{--                    <!-- Card -->--}}
    {{--                    <div class="card">--}}
    {{--                        <div class="card-header border-bottom">--}}
    {{--                            <h4 class="card-header-title">Payment method</h4>--}}
    {{--                        </div>--}}

    {{--                        <!-- Body -->--}}
    {{--                        <div class="card-body">--}}
    {{--                            <div class="mb-4">--}}
    {{--                                <p>Cards will be charged either at the end of the month or whenever your balance exceeds the usage threshold. All major credit / debit cards accepted.</p>--}}
    {{--                            </div>--}}

    {{--                            <!-- List Group -->--}}
    {{--                            <ul class="list-group mb-5">--}}
    {{--                                <!-- Item -->--}}
    {{--                                <li class="list-group-item">--}}
    {{--                                    <div class="mb-2">--}}
    {{--                                        <h5>Maria Williams <span class="badge bg-primary ms-1">Primary</span></h5>--}}
    {{--                                    </div>--}}

    {{--                                    <!-- Media -->--}}
    {{--                                    <div class="d-flex">--}}
    {{--                                        <div class="flex-shrink-0">--}}
    {{--                                            <img class="avatar avatar-sm" src="./assets/svg/brands/mastercard.svg" alt="Image Description">--}}
    {{--                                        </div>--}}

    {{--                                        <div class="flex-grow-1 ms-3">--}}
    {{--                                            <div class="row">--}}
    {{--                                                <div class="col-sm mb-3 mb-sm-0">--}}
    {{--                                                    <span class="d-block text-dark">MasterCard •••• 4242</span>--}}
    {{--                                                    <small class="d-block text-muted">Checking - Expires 12/22</small>--}}
    {{--                                                </div>--}}
    {{--                                                <!-- End Col -->--}}

    {{--                                                <div class="col-sm-auto">--}}
    {{--                                                    <div class="d-flex gap-3">--}}
    {{--                                                        <a class="btn btn-white btn-sm" href="javascript:;" data-bs-toggle="modal" data-bs-target="#accountEditCardModal">--}}
    {{--                                                            <i class="bi-pencil-fill me-1"></i> Edit--}}
    {{--                                                        </a>--}}
    {{--                                                        <button type="button" class="btn btn-white btn-sm">--}}
    {{--                                                            <i class="bi-trash me-1"></i> Delete--}}
    {{--                                                        </button>--}}
    {{--                                                    </div>--}}
    {{--                                                </div>--}}
    {{--                                                <!-- End Col -->--}}
    {{--                                            </div>--}}
    {{--                                            <!-- End Row -->--}}
    {{--                                        </div>--}}
    {{--                                    </div>--}}
    {{--                                    <!-- End Media -->--}}
    {{--                                </li>--}}
    {{--                                <!-- End Item -->--}}

    {{--                                <!-- Item -->--}}
    {{--                                <li class="list-group-item">--}}
    {{--                                    <div class="mb-2">--}}
    {{--                                        <h5>Maria Williams <span class="text-danger small ms-1">Expired</span></h5>--}}
    {{--                                    </div>--}}

    {{--                                    <!-- Media -->--}}
    {{--                                    <div class="d-flex">--}}
    {{--                                        <div class="flex-shrink-0">--}}
    {{--                                            <img class="avatar avatar-sm" src="./assets/svg/brands/visa.svg" alt="Image Description">--}}
    {{--                                        </div>--}}

    {{--                                        <div class="flex-grow-1 ms-3">--}}
    {{--                                            <div class="row">--}}
    {{--                                                <div class="col-sm mb-3 mb-sm-0">--}}
    {{--                                                    <span class="d-block text-dark">Visa •••• 9016</span>--}}
    {{--                                                    <small class="d-block text-muted">Debit - Expires 04/20</small>--}}
    {{--                                                </div>--}}
    {{--                                                <!-- End Col -->--}}

    {{--                                                <div class="col-sm-auto">--}}
    {{--                                                    <div class="d-flex gap-3">--}}
    {{--                                                        <a class="btn btn-white btn-sm" href="javascript:;" data-bs-toggle="modal" data-bs-target="#accountEditCardModal">--}}
    {{--                                                            <i class="bi-pencil-fill me-1"></i> Edit--}}
    {{--                                                        </a>--}}
    {{--                                                        <button type="button" class="btn btn-white btn-sm">--}}
    {{--                                                            <i class="bi-trash me-1"></i> Delete--}}
    {{--                                                        </button>--}}
    {{--                                                    </div>--}}
    {{--                                                </div>--}}
    {{--                                                <!-- End Col -->--}}
    {{--                                            </div>--}}
    {{--                                            <!-- End Row -->--}}
    {{--                                        </div>--}}
    {{--                                    </div>--}}
    {{--                                    <!-- End Media -->--}}
    {{--                                </li>--}}
    {{--                                <!-- End Item -->--}}
    {{--                            </ul>--}}
    {{--                            <!-- End List Group -->--}}

    {{--                            <div class="row">--}}
    {{--                                <div class="col-lg-6">--}}
    {{--                                    <!-- Card -->--}}
    {{--                                    <a class="card card-dashed card-centered" href="javascript:;" data-bs-toggle="modal" data-bs-target="#accountAddCardModal">--}}
    {{--                                        <div class="card-body card-dashed-body py-8">--}}
    {{--                                            <img class="avatar avatar-lg avatar-4x3 mb-2" src="./assets/svg/illustrations/oc-add-card.svg" alt="Image Description" data-hs-theme-appearance="default">--}}
    {{--                                            <img class="avatar avatar-lg avatar-4x3 mb-2" src="./assets/svg/illustrations-light/oc-add-card.svg" alt="Image Description" data-hs-theme-appearance="dark">--}}
    {{--                                            <span><i class="bi-plus"></i> Add a new card</span>--}}
    {{--                                        </div>--}}
    {{--                                    </a>--}}
    {{--                                    <!-- End Card -->--}}
    {{--                                </div>--}}
    {{--                                <!-- End Col -->--}}
    {{--                            </div>--}}
    {{--                            <!-- End Row -->--}}
    {{--                        </div>--}}
    {{--                        <!-- End Body -->--}}
    {{--                    </div>--}}
    {{--                    <!-- End Card -->--}}

    {{--                    <!-- Card -->--}}
    {{--                    <div class="card">--}}
    {{--                        <!-- Header -->--}}
    {{--                        <div class="card-header">--}}
    {{--                            <h4 class="card-header-title">Order history</h4>--}}
    {{--                        </div>--}}
    {{--                        <!-- End Header -->--}}

    {{--                        <!-- Table -->--}}
    {{--                        <div class="table-responsive position-relative">--}}
    {{--                            <table class="table table-borderless table-thead-bordered table-nowrap table-align-middle card-table">--}}
    {{--                                <thead class="thead-light">--}}
    {{--                                <tr>--}}
    {{--                                    <th>Reference</th>--}}
    {{--                                    <th>Status</th>--}}
    {{--                                    <th>Amount</th>--}}
    {{--                                    <th>Updated</th>--}}
    {{--                                    <th>Invoice</th>--}}
    {{--                                    <th></th>--}}
    {{--                                </tr>--}}
    {{--                                </thead>--}}

    {{--                                <tbody>--}}
    {{--                                <tr>--}}
    {{--                                    <td><a href="#">#3682303</a></td>--}}
    {{--                                    <td><span class="badge bg-soft-warning text-warning">Pending</span></td>--}}
    {{--                                    <td>$264</td>--}}
    {{--                                    <td>22/04/2020</td>--}}
    {{--                                    <td><a class="btn btn-white btn-sm" href="#"><i class="bi-file-earmark-arrow-down-fill me-1"></i> PDF</a></td>--}}
    {{--                                    <td>--}}
    {{--                                        <a class="btn btn-white btn-sm" href="javascript:;" data-bs-toggle="modal" data-bs-target="#accountInvoiceReceiptModal"><i class="bi-eye-fill me-1"></i> Quick view</a>--}}
    {{--                                    </td>--}}
    {{--                                </tr>--}}

    {{--                                <tr>--}}
    {{--                                    <td><a href="#">#2333234</a></td>--}}
    {{--                                    <td><span class="badge bg-soft-success text-success">Successful</span></td>--}}
    {{--                                    <td>$264</td>--}}
    {{--                                    <td>22/04/2019</td>--}}
    {{--                                    <td><a class="btn btn-white btn-sm" href="#"><i class="bi-file-earmark-arrow-down-fill me-1"></i> PDF</a></td>--}}
    {{--                                    <td><a class="btn btn-white btn-sm" href="javascript:;" data-bs-toggle="modal" data-bs-target="#accountInvoiceReceiptModal"><i class="bi-eye-fill me-1"></i> Quick view</a></td>--}}
    {{--                                </tr>--}}

    {{--                                <tr>--}}
    {{--                                    <td><a href="#">#9834283</a></td>--}}
    {{--                                    <td><span class="badge bg-soft-success text-success">Successful</span></td>--}}
    {{--                                    <td>$264</td>--}}
    {{--                                    <td>22/04/2018</td>--}}
    {{--                                    <td><a class="btn btn-white btn-sm" href="#"><i class="bi-file-earmark-arrow-down-fill me-1"></i> PDF</a></td>--}}
    {{--                                    <td><a class="btn btn-white btn-sm" href="javascript:;" data-bs-toggle="modal" data-bs-target="#accountInvoiceReceiptModal"><i class="bi-eye-fill me-1"></i> Quick view</a></td>--}}
    {{--                                </tr>--}}
    {{--                                </tbody>--}}
    {{--                            </table>--}}
    {{--                        </div>--}}
    {{--                        <!-- End Table -->--}}
    {{--                    </div>--}}
    {{--                    <!-- End Card -->--}}
    {{--                </div>--}}
    {{--            </div>--}}
    {{--            <!-- End Col -->--}}
    {{--        </div>--}}

@endsection
