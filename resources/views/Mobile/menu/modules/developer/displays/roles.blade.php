@extends('Mobile.layouts.front.app')
@section('title') Meeper | Собрание @endsection
@section('content')

    <div class="content container-fluid">
            <!-- Page Header -->
            <div class="page-header d-print-none">
                <div class="row align-items-center">
                    <div class="col-sm mb-2 mb-sm-0">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb breadcrumb-no-gutter">
                                <li class="breadcrumb-item"><a class="breadcrumb-link" href="./ecommerce-orders.html">Orders</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Order details</li>
                            </ol>
                        </nav>

                        <div class="d-sm-flex align-items-sm-center">
                            <h1 class="page-header-title">Order #32543</h1>
                            <span class="badge bg-soft-success text-success ms-sm-3">
                <span class="legend-indicator bg-success"></span>Paid
              </span>
                            <span class="badge bg-soft-info text-info ms-2 ms-sm-3">
                <span class="legend-indicator bg-info"></span>Fulfilled
              </span>
                            <span class="ms-2 ms-sm-3">
                <i class="bi-calendar-week"></i> Aug 17, 2020, 5:48 (ET)
              </span>
                        </div>

                        <div class="mt-2">
                            <div class="d-flex gap-2">
                                <a class="text-body me-3" href="javascript:;" onclick="window.print(); return false;">
                                    <i class="bi-printer me-1"></i> Print order
                                </a>

                                <!-- Dropdown -->
                                <div class="dropdown">
                                    <a class="text-body" href="javascript:;" id="moreOptionsDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                        More options <i class="bi-chevron-down"></i>
                                    </a>

                                    <div class="dropdown-menu mt-1" aria-labelledby="moreOptionsDropdown">
                                        <a class="dropdown-item" href="#">
                                            <i class="bi-clipboard dropdown-item-icon"></i> Duplicate
                                        </a>
                                        <a class="dropdown-item" href="#">
                                            <i class="bi-x dropdown-item-icon"></i> Cancel order
                                        </a>
                                        <a class="dropdown-item" href="#">
                                            <i class="bi-archive dropdown-item-icon"></i> Archive
                                        </a>
                                        <a class="dropdown-item" href="#">
                                            <i class="bi-eye dropdown-item-icon"></i> View order status page
                                        </a>
                                        <a class="dropdown-item" href="#">
                                            <i class="bi-pencil dropdown-item-icon"></i> Edit order
                                        </a>
                                    </div>
                                </div>
                                <!-- End Dropdown -->
                            </div>
                        </div>
                    </div>
                    <!-- End Col -->

                    <div class="col-sm-auto">
                        <div class="d-flex gap-2">
                            <button type="button" class="btn btn-ghost-secondary btn-icon btn-sm rounded-circle" data-bs-toggle="tooltip" data-bs-placement="right" aria-label="Previous order" data-bs-original-title="Previous order">
                                <i class="bi-arrow-left"></i>
                            </button>
                            <button type="button" class="btn btn-ghost-secondary btn-icon btn-sm rounded-circle" data-bs-toggle="tooltip" data-bs-placement="right" aria-label="Next order" data-bs-original-title="Next order">
                                <i class="bi-arrow-right"></i>
                            </button>
                        </div>
                    </div>
                    <!-- End Col -->
                </div>
                <!-- End Row -->
            </div>
            <!-- End Page Header -->

            <div class="row">
                @foreach($roles as $role)
                <div class="col-md-4 mb-3 mb-lg-0">
                    <!-- Card -->
                    <div class="card mb-3 mb-lg-5">
                        <!-- Header -->
                        <div class="card-header card-header-content-between">
                            <h4 class="card-header-title">Роль - {{ $role->name }} <span class="badge bg-soft-dark text-dark rounded-circle ms-1">{{ $role->id }}</span></h4>
                            <a class="link" href="javascript:;">Edit</a>
                        </div>
                        <!-- End Header -->
                        <!-- Body -->
                        <div class="card-body">
                            <!-- Media -->
                            <div class="d-flex">
                                <form action="{{ route('developer.updatePermissionsForRole', $role->id)  }}" method="POST">
                                    @csrf
                                    @foreach($permissions as $permission)
                                        @php
                                            // Проверяем, существует ли запись в таблице RolesPermissions
                                            $hasPermission = $role->permissions->contains('id', $permission->id);
                                        @endphp

                                        <label>
                                            <div class="form-check form-switch mb-2">
                                                <input type="checkbox" name="permissions[]" class="form-check-input" id="formSwitch{{ $permission->id }}" value="{{ $permission->id }}" {{ $hasPermission ? 'checked' : '' }}>
                                                <label class="form-check-label" for="formSwitch{{ $permission->id }}">{{ $permission->name }}</label>
                                            </div>
                                        </label><br>
                                    @endforeach
                                    <div class="row col-12">
                                        <button class="btn btn-outline-success" type="submit">Сохранить</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- End Body -->
                    </div>
                </div>
                @endforeach
            </div>
            <!-- End Row -->
        </div>

    <div class="footer">
            <div class="row justify-content-between align-items-center">
                <div class="col">
                    <p class="fs-6 mb-0">© Front. <span class="d-none d-sm-inline-block">2022 Htmlstream.</span></p>
                </div>
                <!-- End Col -->

                <div class="col-auto">
                    <div class="d-flex justify-content-end">
                        <!-- List Separator -->
                        <ul class="list-inline list-separator">
                            <li class="list-inline-item">
                                <a class="list-separator-link" href="#">FAQ</a>
                            </li>

                            <li class="list-inline-item">
                                <a class="list-separator-link" href="#">License</a>
                            </li>

                            <li class="list-inline-item">
                                <!-- Keyboard Shortcuts Toggle -->
                                <button class="btn btn-ghost-secondary btn btn-icon btn-ghost-secondary rounded-circle" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasKeyboardShortcuts" aria-controls="offcanvasKeyboardShortcuts">
                                    <i class="bi-command"></i>
                                </button>
                                <!-- End Keyboard Shortcuts Toggle -->
                            </li>
                        </ul>
                        <!-- End List Separator -->
                    </div>
                </div>
                <!-- End Col -->
            </div>
            <!-- End Row -->
        </div>

@endsection
