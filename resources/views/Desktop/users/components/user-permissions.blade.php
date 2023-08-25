<div class="row align-items-center mb-5">
    <div class="col">
        <h3 class="mb-0">7 connections</h3>
    </div>
    <!-- End Col -->

    <div class="col-auto">
        <!-- Nav -->
        <ul class="nav nav-segment" id="connectionsTab" role="tablist">
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="grid-tab" data-bs-toggle="tab" href="#grid" role="tab" aria-controls="grid" aria-selected="false" title="Column view" tabindex="-1">
                    <i class="bi-grid"></i>
                </a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link active" id="list-tab" data-bs-toggle="tab" href="#list" role="tab" aria-controls="list" aria-selected="true" title="List view">
                    <i class="bi-list"></i>
                </a>
            </li>
        </ul>
        <!-- End Nav -->
    </div>
    <!-- End Col -->
</div>
<div class="tab-content" id="connectionsTabContent">
    <div class="tab-pane fade" id="grid" role="tabpanel" aria-labelledby="grid-tab">
        <!-- Connections -->
        <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-3">
            @foreach($permissions as $permission)
                <div class="col mb-3 mb-lg-5">
                    <!-- Card -->
                    <div class="card h-100">
                        <!-- Body -->
                        <div class="card-body pb-0">
                            <div class="row align-items-center mb-2">
                                <div class="col-9">
                                    <h4 class="mb-1">
                                        <a>{{$permission->name}}</a>
                                    </h4>
                                </div>
                                <!-- End Col -->

                                <div class="col-3 text-end">
                                    <!-- Dropdown -->
                                    <div class="dropdowm">
                                        <button type="button" class="btn btn-ghost-secondary btn-icon btn-sm rounded-circle" id="teamsDropdown1" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="bi-three-dots-vertical"></i>
                                        </button>

                                        <div class="dropdown-menu dropdown-menu-sm dropdown-menu-end" aria-labelledby="teamsDropdown1">
                                            <a class="dropdown-item" href="#">Rename team</a>
                                            <a class="dropdown-item" href="#">Add to favorites</a>
                                            <a class="dropdown-item" href="#">Archive team</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item text-danger" href="#">Delete</a>
                                        </div>
                                    </div>
                                    <!-- End Dropdown -->
                                </div>
                                <!-- End Col -->
                            </div>
                            <!-- End Row -->

                            <p>Our group promotes and sells products and services by leveraging online marketing tactics</p>
                        </div>
                        <!-- End Body -->

                        <!-- Footer -->
                        <div class="card-footer border-0 pt-0">
                            <div class="list-group list-group-flush list-group-no-gutters">
                                <!-- List Item -->
                                <div class="list-group-item">
                                    <div class="row align-items-center">
                                        <div class="col">
                                            <span class="card-subtitle">Industry:</span>
                                        </div>
                                        <!-- End Col -->

                                        <div class="col-auto">
                                            <a class="badge bg-soft-primary text-primary p-2" href="#">Marketing team</a>
                                        </div>
                                        <!-- End Col -->
                                    </div>
                                </div>
                                <!-- End List Item -->

                            </div>
                        </div>
                        <!-- End Footer -->
                    </div>
                    <!-- End Card -->
                </div>
            @endforeach
        </div>
        <!-- End Connections -->
    </div>

    <div class="tab-pane fade active show" id="list" role="tabpanel" aria-labelledby="list-tab">
        <div class="row row-cols-1">
            @foreach($permissions as $permission)
                <div class="col mb-3">
                    <!-- Card -->
                    <div class="card card-body">
                        <div class="d-flex align-items-md-center">
                            <div class="flex-shrink-0">
                                <!-- Avatar -->
                                <div class="avatar avatar-lg avatar-soft-primary avatar-circle">
                                    <span class="avatar-initials">P</span>
                                </div>
                                <!-- End Avatar -->
                            </div>

                            <div class="flex-grow-1 ms-3">
                                <div class="row align-items-md-center">
                                    <div class="col-9 col-md-4 col-lg-3 mb-2 mb-md-0">
                                        <h4 class="mb-1">
                                            <a class="text-dark">{{$permission->name}}</a>
                                        </h4>

                                        <span class="d-block">
                              <i class="bi-building me-1"></i>
                              <span>Design</span>
                            </span>
                                    </div>
                                    <!-- End Col -->

                                    <div class="col-3 col-md-auto order-md-last text-end ms-n3">
                                        <!-- Dropdown -->
                                        <div class="dropdown">
                                            <button type="button" class="btn btn-ghost-secondary btn-icon btn-sm rounded-circle" id="connectionsListDropdown1" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="bi-three-dots-vertical"></i>
                                            </button>

                                            <div class="dropdown-menu dropdown-menu-sm dropdown-menu-end" aria-labelledby="connectionsListDropdown1">
                                                <a class="dropdown-item" href="#">Rename project </a>
                                                <a class="dropdown-item" href="#">Add to favorites</a>
                                                <a class="dropdown-item" href="#">Archive project</a>
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item text-danger" href="#">Delete</a>
                                            </div>
                                        </div>
                                        <!-- End Dropdown -->
                                    </div>
                                    <!-- End Col -->

                                    <div class="col-sm mb-2">
                                    </div>
                                    <!-- End Col -->

                                    <div class="col-sm-auto">
                                        <!-- Form Check -->
                                        @if(DB::table('users_permissions')
->where('user_id', '=', $user->id)
->where('permission_id', '=', $permission->id)
->count() > 0)
                                            <div class="col mb-3">
                                        <span class="text-success heading text-left">
                                            <i class="fa-solid fa-circle-check"></i> Доступная роль</span>
                                                <form method="post" action="{{ route('permissionDelete', $user->id) }}">
                                                    @csrf
                                                    <input type="hidden" name="delete_permission_id" value="{{ $permission->id }}">
                                                    <button class="btn btn-danger btn-sm">Запретить</button>
                                                </form>
                                            </div>
                                        @else
                                            <form method="post" action="{{ route('permissionAllow', $user->id) }}">
                                                @csrf
                                                <div class="col-md-6 mb-3">
                                                    <input type="hidden" name="allow_permission_id" value="{{ $permission->id }}">
                                                    <button class="btn btn-primary">Разрешить</button>
                                                </div>
                                            </form>

                                        @endif
                                        <!-- End Form Check -->
                                    </div>
                                    <!-- End Col -->
                                </div>
                                <!-- End Row -->
                            </div>
                        </div>
                    </div>
                    <!-- End Card -->
                </div>
            @endforeach
        </div>
    </div>
</div>
