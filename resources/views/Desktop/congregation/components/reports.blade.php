<div class="card">
    <div class="card-header card-header-content-md-between">
        <div class="mb-2 mb-md-0">
            <form>
                <!-- Search -->
                <div class="input-group input-group-merge input-group-flush">
                    <div class="input-group-prepend input-group-text">
                        <i class="bi-search"></i>
                    </div>
                    <input id="datatableSearch" type="search" class="form-control" placeholder="Search users" aria-label="Search users">
                </div>
                <!-- End Search -->
            </form>
        </div>

        <div class="d-grid d-sm-flex justify-content-md-end align-items-sm-center gap-2">
            <!-- Datatable Info -->
            <div id="datatableCounterInfo" style="display: none;">
                <div class="d-flex align-items-center">
                <span class="fs-5 me-3">
                  <span id="datatableCounter">0</span>
                  Selected
                </span>
                    <a class="btn btn-outline-danger btn-sm" href="javascript:;">
                        <i class="bi-trash"></i> Delete
                    </a>
                </div>
            </div>
            <!-- End Datatable Info -->

            <!-- Dropdown -->
            <div class="dropdown">
                <button type="button" class="btn btn-white btn-sm w-100" id="usersFilterDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="bi-filter me-1"></i> Filter <span class="badge bg-soft-dark text-dark rounded-circle ms-1">2</span>
                </button>

                <div class="dropdown-menu dropdown-menu-sm-end dropdown-card card-dropdown-filter-centered" aria-labelledby="usersFilterDropdown" style="min-width: 22rem;">
                    <!-- Card -->
                    <div class="card">
                        <div class="card-header card-header-content-between">
                            <h5 class="card-header-title">Filter users</h5>

                            <!-- Toggle Button -->
                            <button type="button" class="btn btn-ghost-secondary btn-icon btn-sm ms-2">
                                <i class="bi-x-lg"></i>
                            </button>
                            <!-- End Toggle Button -->
                        </div>

                        <div class="card-body">
                            <form>
                                <div class="row">
                                    <div class="col-sm mb-4">
                                        <small class="text-cap text-body">Status</small>

                                        <!-- Select -->
                                        <div class="tom-select-custom">
                                            <select class="js-select js-datatable-filter form-select form-select-sm tomselected ts-hidden-accessible" data-target-column-index="4" data-hs-tom-select-options="{
                                      &quot;placeholder&quot;: &quot;Any status&quot;,
                                      &quot;searchInDropdown&quot;: false,
                                      &quot;hideSearch&quot;: true,
                                      &quot;dropdownWidth&quot;: &quot;10rem&quot;
                                    }" id="tomselect-2" tabindex="-1">
                                                <option value="">Any status</option>



                                                <option value="In progress" data-option-template="<span class=&quot;d-flex align-items-center&quot;><span class=&quot;legend-indicator bg-warning&quot;></span>In progress</span>">In progress</option><option value="Completed" data-option-template="<span class=&quot;d-flex align-items-center&quot;><span class=&quot;legend-indicator bg-success&quot;></span>Completed</span>">Completed</option><option value="To do" data-option-template="<span class=&quot;d-flex align-items-center&quot;><span class=&quot;legend-indicator bg-danger&quot;></span>To do</span>">To do</option></select><div class="ts-wrapper js-select js-datatable-filter form-select form-select-sm single plugin-change_listener plugin-hs_smart_position full has-items"><div class="ts-control"><span class="d-flex align-items-center item" data-value="To do" data-ts-item=""><span class="legend-indicator bg-danger"></span>To do</span><div class="ts-custom-placeholder">Any status</div></div><div class="tom-select-custom"><div class="ts-dropdown single plugin-change_listener plugin-hs_smart_position" style="display: none; visibility: visible; opacity: 1; width: 10rem;"><div role="listbox" tabindex="-1" class="ts-dropdown-content" id="tomselect-2-ts-dropdown"><span class="d-flex align-items-center option" data-selectable="" data-value="Completed" role="option" id="tomselect-2-opt-1"><span class="legend-indicator bg-success"></span>Completed</span><span class="d-flex align-items-center option" data-selectable="" data-value="In progress" role="option" id="tomselect-2-opt-2"><span class="legend-indicator bg-warning"></span>In progress</span><span class="d-flex align-items-center option active selected" data-selectable="" data-value="To do" role="option" id="tomselect-2-opt-3" aria-selected="true"><span class="legend-indicator bg-danger"></span>To do</span></div></div></div></div>
                                        </div>
                                        <!-- End Select -->
                                    </div>
                                    <div class="col-sm mb-4">
                                        <small class="text-cap text-body">Position</small>

                                        <!-- Select -->
                                        <div class="tom-select-custom">
                                            <select class="js-select js-datatable-filter form-select form-select-sm"
                                                    data-target-column-index="5" data-hs-tom-select-options='{
                                      "placeholder": "Any",
                                      "searchInDropdown": false,
                                      "hideSearch": true,
                                      "dropdownWidth": "10rem"
                                    }'>
                                                <option value="">Any</option>
                                                <option value="1">январь</option>
                                                <option value="2">aar</option>
                                                <option value="Designer">Designer</option>
                                                <option value="Developer">Developer</option>
                                                <option value="Director">Director</option>
                                            </select>
                                            <!-- End Select -->
                                        </div>
                                    </div>
                                    <!-- End Col -->
                                </div>
                                <!-- End Row -->

                                <div class="d-grid">
                                    <a class="btn btn-primary" href="javascript:;">Apply</a>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- End Card -->
                </div>
            </div>
            <!-- End Dropdown -->
        </div>
    </div>

    <table id="datatable" class="table table-lg table-borderless table-thead-bordered table-nowrap table-align-middle card-table" data-hs-datatables-options='{
                   "columnDefs": [{
                      "targets": [0, 2, 3, 5, 6, 7],
                      "orderable": false
                    }],
                   "order": [],
                   "info": {
                     "totalQty": "#datatableWithPaginationInfoTotalQty"
                   },
                   "search": "#datatableSearch",
                   "entries": "#datatableEntries",
                   "pageLength": 15,
                   "isResponsive": false,
                   "isShowPaging": false,
                   "pagination": "datatablePagination"
                 }'>
            <thead class="thead-light">
            <tr>
                <th>Имя фамилия</th>
                <th>Часы</th>
                <th>Публикации</th>
                <th>Повторы</th>
                <th>Изучения</th>
                <th>Месяц</th>
                <th>Год</th>
            </tr>
            </thead>

            <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{$user->first_name}} {{$user->last_name}}</td>
                        @if($user->personalReport->isEmpty())
                            <td>Нет отчета</td>
                            <td>Нет отчета</td>
                            <td>Нет отчета</td>
                            <td>Нет отчета</td>
                            <td>Нет отчета</td>
                            <td>Нет отчета</td>
                        @else
                            @foreach($user->personalReport as $userPersonalReport)
                                @foreach($userPersonalReport->user as $userPersonalReportUser)
                                    @if($user->id == $userPersonalReportUser->id)
                                        <td>{{$userPersonalReport->publications}}</td>
                                        <td>{{$userPersonalReport->videos}}</td>
                                        <td>{{$userPersonalReport->return_visits}}</td>
                                        <td>{{$userPersonalReport->bible_studies}}</td>
                                        <td>{{$userPersonalReport->month}}</td>
                                        <td>{{$userPersonalReport->year}}</td>
                                    @endif
                                @endforeach
                            @endforeach
                        @endif
                    </tr>
              @endforeach
            </tbody>
        </table>
    </div>

    <div class="card-footer">
        <div class="d-flex justify-content-center justify-content-sm-end">
            <nav id="datatablePagination" aria-label="Activity pagination"></nav>
        </div>
    </div>
</div>
