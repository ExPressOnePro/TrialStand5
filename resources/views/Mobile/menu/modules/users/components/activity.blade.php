<div class="col-lg-8">
    <div class="d-grid gap-3 gap-lg-5">
        <!-- Card -->
        <div class="card">
            <!-- Header -->
            <div class="card-header card-header-content-between">
                <h4 class="card-header-title">Активность пользователя</h4>
            </div>
            <!-- End Header -->

            <!-- Body -->
            <div class="card-body card-body-height" style="height: 30rem;">
                <!-- Step -->
                <ul class="step step-icon-xs mb-0">

{{--                    @foreach($user->audits as $audit)--}}
{{--                        <p>ID аудита: {{ $audit->orderBy("id", "desc")->first()->id }}</p>--}}
{{--                        <p>Отредактировано: {{ $audit->created_at }}</p>--}}
{{--                        <p>Изменения:</p>--}}
{{--                        <ul>--}}
{{--                            @foreach($audit->old_values as $attribute => $value)--}}
{{--                                <li>{{ $attribute }}: {{ $value }} &rarr; <br>{{ $audit->new_values[$attribute] }}</li>--}}
{{--                            @endforeach--}}
{{--                        </ul>--}}
{{--                    @endforeach--}}

                    <!-- Step Item -->

                    @foreach($user->audits() as $audit)
                        <li>
                            <h5>{{ $audit->user->name }}</h5>
                            <p>{{ $audit->created_at }}</p>
                            <p>{{ $audit->field }}</p>
                            <p>{{ $audit->old_values[$audit->field] }}</p>
                            <p>{{ $audit->new_values[$audit->field] }}</p>
                        </li>
                    @endforeach
                        @foreach($user->audits()->orderBy('id', 'desc')->limit(10)->get() as $audit)
                        <li class="step-item">
                            <div class="step-content-wrapper">
                                <span class="step-icon step-icon-pseudo step-icon-soft-dark"></span>

                                <div class="step-content">
                                    <h5 class="step-title">
                                        <a class="text-dark" href="#">Когда: {{ $audit->created_at }}</a>
                                        <span class="badge bg-soft-primary text-primary rounded-pill">
                                            {{ $audit->id }}
                                        </span>
                                    </h5>
                                    <ul>
                                        @foreach($audit->old_values as $attribute => $value)
                                            <li>{{ $attribute }}: {{ $value }} &rarr; <br>{{ $audit->new_values[$attribute] }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </li>
                        @endforeach
                    <!-- End Step Item -->

                    <!-- Step Item -->
                    <li id="collapseActivitySection" class="step-item collapse">
                        <div class="step-content-wrapper">
                            <span class="step-icon step-icon-pseudo step-icon-soft-dark"></span>

                            <div class="step-content">
                                <h5 class="step-title">
                                    <a class="text-dark" href="#">Project status updated</a>
                                </h5>

                                <p class="fs-5 mb-1">Updated <a class="text-uppercase" href="#"><i class="bi-journal-bookmark-fill"></i> Fr-3</a> as <span class="badge bg-soft-secondary text-secondary rounded-pill"><span class="legend-indicator bg-secondary"></span>"To do"</span></p>

                                <span class="text-muted small text-uppercase">Feb 10</span>
                            </div>
                        </div>
                    </li>
                    <!-- End Step Item -->
                </ul>
                <!-- End Step -->
            </div>
            <!-- End Body -->

            <!-- Footer -->
            <div class="card-footer">
                <a class="link link-collapse" data-bs-toggle="collapse" href="#collapseActivitySection" role="button" aria-expanded="false" aria-controls="collapseActivitySection">
                    <span class="link-collapse-default">View more</span>
                    <span class="link-collapse-active">View less</span>
                </a>
            </div>
            <!-- End Footer -->
        </div>
        <!-- End Card -->

        <div class="row">
            <div class="col-sm-6 mb-3 mb-sm-0">
                <!-- Card -->
                <div class="card h-100">
                    <!-- Header -->
                    <div class="card-header">
                        <h4 class="card-header-title">Connections</h4>
                    </div>
                    <!-- End Header -->

                    <!-- Body -->
                    <div class="card-body">
                        <ul class="list-unstyled list-py-3 mb-0">
                            <!-- Item -->
                            <li>
                                <div class="d-flex align-items-center">
                                    <a class="d-flex align-items-center me-2" href="#">
                                        <div class="flex-shrink-0">
                                            <div class="avatar avatar-sm avatar-soft-primary avatar-circle">
                                                <span class="avatar-initials">R</span>
                                                <span class="avatar-status avatar-sm-status avatar-status-warning"></span>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <h5 class="text-hover-primary mb-0">Rachel Doe</h5>
                                            <span class="fs-6 text-body">25 connections</span>
                                        </div>
                                    </a>
                                    <div class="ms-auto">
                                        <!-- Form Check -->
                                        <div class="form-check form-check-switch">
                                            <input class="form-check-input" type="checkbox" value="" id="connectionsCheckbox1" checked>
                                            <label class="form-check-label btn-icon btn-xs rounded-circle" for="connectionsCheckbox1">
                                    <span class="form-check-default">
                                      <i class="bi-person-plus-fill"></i>
                                    </span>
                                                <span class="form-check-active">
                                      <i class="bi-check-lg"></i>
                                    </span>
                                            </label>
                                        </div>
                                        <!-- End Form Check -->
                                    </div>
                                </div>
                            </li>
                            <!-- End Item -->

                            <!-- Item -->
                            <li>
                                <div class="d-flex align-items-center">
                                    <a class="d-flex align-items-center me-2" href="#">
                                        <div class="flex-shrink-0">
                                            <div class="avatar avatar-sm avatar-circle">
                                                <img class="avatar-img" src="./assets/img/160x160/img8.jpg" alt="Image Description">
                                                <span class="avatar-status avatar-sm-status avatar-status-success"></span>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <h5 class="text-hover-primary mb-0">Isabella Finley</h5>
                                            <span class="fs-6 text-body">79 connections</span>
                                        </div>
                                    </a>
                                    <div class="ms-auto">
                                        <!-- Form Check -->
                                        <div class="form-check form-check-switch">
                                            <input class="form-check-input" type="checkbox" value="" id="connectionsCheckbox2">
                                            <label class="form-check-label btn-icon btn-xs rounded-circle" for="connectionsCheckbox2">
                                    <span class="form-check-default">
                                      <i class="bi-person-plus-fill"></i>
                                    </span>
                                                <span class="form-check-active">
                                      <i class="bi-check-lg"></i>
                                    </span>
                                            </label>
                                        </div>
                                        <!-- End Form Check -->
                                    </div>
                                </div>
                            </li>
                            <!-- End Item -->

                            <!-- Item -->
                            <li>
                                <div class="d-flex align-items-center">
                                    <a class="d-flex align-items-center me-2" href="#">
                                        <div class="flex-shrink-0">
                                            <div class="avatar avatar-sm avatar-circle">
                                                <img class="avatar-img" src="./assets/img/160x160/img3.jpg" alt="Image Description">
                                                <span class="avatar-status avatar-sm-status avatar-status-warning"></span>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <h5 class="text-hover-primary mb-0">David Harrison</h5>
                                            <span class="fs-6 text-body">0 connections</span>
                                        </div>
                                    </a>
                                    <div class="ms-auto">
                                        <!-- Form Check -->
                                        <div class="form-check form-check-switch">
                                            <input class="form-check-input" type="checkbox" value="" id="connectionsCheckbox3" checked>
                                            <label class="form-check-label btn-icon btn-xs rounded-circle" for="connectionsCheckbox3">
                                    <span class="form-check-default">
                                      <i class="bi-person-plus-fill"></i>
                                    </span>
                                                <span class="form-check-active">
                                      <i class="bi-check-lg"></i>
                                    </span>
                                            </label>
                                        </div>
                                        <!-- End Form Check -->
                                    </div>
                                </div>
                            </li>
                            <!-- End Item -->

                            <!-- Item -->
                            <li>
                                <div class="d-flex align-items-center">
                                    <a class="d-flex align-items-center me-2" href="#">
                                        <div class="flex-shrink-0">
                                            <div class="avatar avatar-sm avatar-circle">
                                                <img class="avatar-img" src="./assets/img/160x160/img6.jpg" alt="Image Description">
                                                <span class="avatar-status avatar-sm-status avatar-status-danger"></span>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <h5 class="text-hover-primary mb-0">Costa Quinn</h5>
                                            <span class="fs-6 text-body">9 connections</span>
                                        </div>
                                    </a>
                                    <div class="ms-auto">
                                        <!-- Form Check -->
                                        <div class="form-check form-check-switch">
                                            <input class="form-check-input" type="checkbox" value="" id="connectionsCheckbox4">
                                            <label class="form-check-label btn-icon btn-xs rounded-circle" for="connectionsCheckbox4">
                                    <span class="form-check-default">
                                      <i class="bi-person-plus-fill"></i>
                                    </span>
                                                <span class="form-check-active">
                                      <i class="bi-check-lg"></i>
                                    </span>
                                            </label>
                                        </div>
                                        <!-- End Form Check -->
                                    </div>
                                </div>
                            </li>
                            <!-- End Item -->
                        </ul>
                    </div>
                    <!-- End Body -->

                    <!-- Footer -->
                    <a class="card-footer text-center" href="user-profile-connections.html">
                        View all connections <i class="bi-chevron-right"></i>
                    </a>
                    <!-- End Footer -->
                </div>
                <!-- End Card -->
            </div>

            <div class="col-sm-6">
                <!-- Card -->
                <div class="card h-100">
                    <!-- Header -->
                    <div class="card-header">
                        <h4 class="card-header-title">Teams</h4>
                    </div>
                    <!-- End Header -->

                    <!-- Body -->
                    <div class="card-body">
                        <ul class="nav nav-pills card-nav card-nav-vertical nav-pills">
                            <!-- Item -->
                            <li>
                                <a class="nav-link" href="#">
                                    <div class="d-flex">
                                        <div class="flex-shrink-0">
                                            <i class="bi-people-fill nav-icon text-dark"></i>
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <span class="d-block text-dark">#digitalmarketing</span>
                                            <small class="d-block text-muted">8 members</small>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <!-- End Item -->

                            <!-- Item -->
                            <li>
                                <a class="nav-link" href="#">
                                    <div class="d-flex">
                                        <div class="flex-shrink-0">
                                            <i class="bi-people-fill nav-icon text-dark"></i>
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <span class="d-block text-dark">#ethereum</span>
                                            <small class="d-block text-muted">14 members</small>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <!-- End Item -->

                            <!-- Item -->
                            <li>
                                <a class="nav-link" href="#">
                                    <div class="d-flex">
                                        <div class="flex-shrink-0">
                                            <i class="bi-people-fill nav-icon text-dark"></i>
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <span class="d-block text-dark">#conference</span>
                                            <small class="d-block text-muted">3 members</small>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <!-- End Item -->

                            <!-- Item -->
                            <li>
                                <a class="nav-link" href="#">
                                    <div class="d-flex">
                                        <div class="flex-shrink-0">
                                            <i class="bi-people-fill nav-icon text-dark"></i>
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <span class="d-block text-dark">#supportteam</span>
                                            <small class="d-block text-muted">3 members</small>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <!-- End Item -->

                            <!-- Item -->
                            <li>
                                <a class="nav-link" href="#">
                                    <div class="d-flex">
                                        <div class="flex-shrink-0">
                                            <i class="bi-people-fill nav-icon text-dark"></i>
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <span class="d-block text-dark">#invoices</span>
                                            <small class="d-block text-muted">3 members</small>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <!-- End Item -->
                        </ul>
                    </div>
                    <!-- End Body -->

                    <!-- Footer -->
                    <a class="card-footer text-center" href="user-profile-teams.html">
                        View all teams <i class="bi-chevron-right"></i>
                    </a>
                    <!-- End Footer -->
                </div>
                <!-- End Card -->
            </div>
        </div>
        <!-- End Row -->

        <!-- Card -->
        <div class="card">
            <!-- Header -->
            <div class="card-header card-header-content-between">
                <h4 class="card-header-title">Projects</h4>

                <!-- Dropdown -->
                <div class="dropdowm">
                    <button type="button" class="btn btn-ghost-secondary btn-icon btn-sm rounded-circle" id="projectReportDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi-three-dots-vertical"></i>
                    </button>

                    <div class="dropdown-menu dropdown-menu-end mt-1" aria-labelledby="projectReportDropdown">
                        <span class="dropdown-header">Settings</span>

                        <a class="dropdown-item" href="#">
                            <i class="bi-share-fill dropdown-item-icon"></i> Share connections
                        </a>
                        <a class="dropdown-item" href="#">
                            <i class="bi-info-circle dropdown-item-icon"></i> Suggest edits
                        </a>

                        <div class="dropdown-divider"></div>

                        <span class="dropdown-header">Feedback</span>

                        <a class="dropdown-item" href="#">
                            <i class="bi-chat-left-dots dropdown-item-icon"></i> Report
                        </a>
                    </div>
                </div>
                <!-- End Dropdown -->
            </div>
            <!-- End Header -->

            <!-- Table -->
            <div class="table-responsive">
                <table class="table table-borderless table-thead-bordered table-nowrap table-align-middle card-table">
                    <thead class="thead-light">
                    <tr>
                        <th>Project</th>
                        <th style="width: 40%;">Progress</th>
                        <th class="table-text-end">Hours spent</th>
                    </tr>
                    </thead>

                    <tbody>
                    <tr>
                        <td>
                            <div class="d-flex">
                              <span class="avatar avatar-xs avatar-soft-dark avatar-circle">
                                <span class="avatar-initials">U</span>
                              </span>
                                <div class="ms-3">
                                    <h5 class="mb-0">UI/UX</h5>
                                    <small>Updated 2 hours ago</small>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="d-flex align-items-center">
                                <span class="me-3">0%</span>
                                <div class="progress table-progress">
                                    <div class="progress-bar" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </td>
                        <td class="table-text-end">4:25</td>
                    </tr>

                    <tr>
                        <td>
                            <div class="d-flex">
                                <img class="avatar avatar-xs" src="./assets/svg/brands/spec-icon.svg" alt="Image Description">
                                <div class="ms-3">
                                    <h5 class="mb-0">Get a complete audit store</h5>
                                    <small>Updated 1 day ago</small>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="d-flex align-items-center">
                                <span class="me-3">45%</span>
                                <div class="progress table-progress">
                                    <div class="progress-bar" role="progressbar" style="width: 45%" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </td>
                        <td class="table-text-end">18:42</td>
                    </tr>

                    <tr>
                        <td>
                            <div class="d-flex">
                                <img class="avatar avatar-xs" src="./assets/svg/brands/capsule-icon.svg" alt="Image Description">
                                <div class="ms-3">
                                    <h5 class="mb-0">Build stronger customer relationships</h5>
                                    <small>Updated 2 days ago</small>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="d-flex align-items-center">
                                <span class="me-3">59%</span>
                                <div class="progress table-progress">
                                    <div class="progress-bar" role="progressbar" style="width: 59%" aria-valuenow="59" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </td>
                        <td class="table-text-end">9:01</td>
                    </tr>

                    <tr>
                        <td>
                            <div class="d-flex">
                                <img class="avatar avatar-xs" src="./assets/svg/brands/mailchimp-icon.svg" alt="Image Description">
                                <div class="ms-3">
                                    <h5 class="mb-0">Update subscription method</h5>
                                    <small>Updated 2 days ago</small>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="d-flex align-items-center">
                                <span class="me-3">57%</span>
                                <div class="progress table-progress">
                                    <div class="progress-bar bg-success" role="progressbar" style="width: 57%" aria-valuenow="57" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </td>
                        <td class="table-text-end">0:37</td>
                    </tr>

                    <tr>
                        <td>
                            <div class="d-flex">
                                <img class="avatar avatar-xs" src="./assets/svg/brands/figma-icon.svg" alt="Image Description">
                                <div class="ms-3">
                                    <h5 class="mb-0">Create a new theme</h5>
                                    <small>Updated 1 week ago</small>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="d-flex align-items-center">
                                <span class="me-3">100%</span>
                                <div class="progress table-progress">
                                    <div class="progress-bar bg-success" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </td>
                        <td class="table-text-end">24:12</td>
                    </tr>

                    <tr>
                        <td>
                            <div class="d-flex">
                              <span class="avatar avatar-xs avatar-soft-info avatar-circle">
                                <span class="avatar-initials">I</span>
                              </span>
                                <div class="ms-3">
                                    <h5 class="mb-0">Improve social banners</h5>
                                    <small>Updated 1 week ago</small>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="d-flex align-items-center">
                                <span class="me-3">0%</span>
                                <div class="progress table-progress">
                                    <div class="progress-bar" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </td>
                        <td class="table-text-end">8:08</td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <!-- End Table -->

            <!-- Footer -->
            <a class="card-footer text-center" href="./projects.html">
                View all projects <i class="bi-chevron-right"></i>
            </a>
            <!-- End Footer -->
        </div>
        <!-- End Card -->
    </div>

    <!-- Sticky Block End Point -->
    <div id="stickyBlockEndPoint"></div>
</div>
