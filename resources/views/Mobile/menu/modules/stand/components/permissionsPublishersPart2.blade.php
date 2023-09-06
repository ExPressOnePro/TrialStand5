{{--<div class="card">--}}
{{--    <!-- Header -->--}}
{{--    <div class="card-header">--}}
{{--        <div class="row justify-content-between align-items-center flex-grow-1">--}}
{{--            <div class="col-12 col-md">--}}
{{--                <div class="d-flex justify-content-between align-items-center">--}}
{{--                    <h5 class="card-header-title">Разрешения пользователей</h5>--}}
{{--                </div>--}}
{{--            </div>--}}

{{--            <div class="col-auto">--}}
{{--                <!-- Filter -->--}}
{{--                <form>--}}
{{--                    <!-- Search -->--}}
{{--                    <div class="input-group input-group-merge input-group-flush">--}}
{{--                        <div class="input-group-prepend input-group-text">--}}
{{--                            <i class="bi-search"></i>--}}
{{--                        </div>--}}
{{--                        <input id="datatableWithSearchInput" type="search" class="form-control" placeholder="Search users" aria-label="Search users">--}}
{{--                    </div>--}}
{{--                    <!-- End Search -->--}}
{{--                </form>--}}
{{--                <!-- End Filter -->--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--    <!-- End Header -->--}}

{{--    <!-- Table -->--}}
{{--    <div class="card-body">--}}
{{--        <p>Установив эти разрешения пользователи смогут делать следующее <span class="fw-semibold"></span></p>--}}
{{--    </div>--}}
{{--    <div class="table-responsive datatable-custom">--}}
{{--        <table class="js-datatable table table-borderless table-thead-bordered table-nowrap table-align-middle card-table"--}}
{{--               data-hs-datatables-options='{--}}
{{--                   "order": [],--}}
{{--                   "search": "#datatableWithSearchInput",--}}
{{--                   "isResponsive": false,--}}
{{--                   "isShowPaging": false,--}}
{{--                   "pagination": "datatableWithSearchPagination123"--}}
{{--                 }'>--}}
{{--            <thead class="thead-light">--}}
{{--            <tr>--}}
{{--                <th>Name</th>--}}
{{--                <th>per1</th>--}}
{{--                <th>per2</th>--}}
{{--                <th>per3</th>--}}
{{--            </tr>--}}
{{--            </thead>--}}

{{--            <tbody>--}}
{{--            @foreach($usersCongregation as $user)--}}
{{--            <tr class="mb-1">--}}
{{--                <td>--}}
{{--                    <ul class="list-group">--}}
{{--                        <li class="list-group-item d-flex align-items-center" href="">--}}
{{--                            {{ $user->first_name }} {{ $user->last_name }}--}}
{{--                            <span class="badge bg-primary rounded-pill ms-auto">14</span>--}}
{{--                        </li>--}}
{{--                    </ul>--}}
{{--                </td>--}}
{{--            </tr>--}}
{{--            @endforeach--}}
{{--            </tbody>--}}
{{--        </table>--}}
{{--    </div>--}}


{{--    <!-- Footer -->--}}
{{--    <div class="card-footer">--}}
{{--        <!-- Pagination -->--}}
{{--        <div class="d-flex justify-content-center justify-content-sm-end">--}}
{{--            <nav id="datatableWithSearchPagination123" aria-label="Activity pagination"></nav>--}}
{{--        </div>--}}
{{--        <!-- End Pagination -->--}}
{{--    </div>--}}
{{--    <!-- End Footer -->--}}
{{--</div>--}}


<div class="card-header">
    <h4 class="card-title">Разрешения пользователей</h4>
</div>
<div class="card-body">
    <p>Установив эти разрешения пользователи смогут делать следующее <span class="fw-semibold"></span></p>
    <div class="row col-auto">
        <form method="POST" action="{{ route('updatePerm') }}">
            @csrf
            <table class="table-responsive">
                <thead>
                <tr>
                    <th>Возвещатель</th>
                    @foreach($permissionsPublishers as $permission)
                        @if($permission->name == 'stand.make_entry')
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
                @foreach($usersCongregation as $user)
                    <tr>
                        <td>{{ $user->first_name }} {{ $user->last_name }}</td>
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
            <div class="row col">
                <button class="btn btn-outline-primary" type="submit">Изменить</button>
            </div>
        </form>
    </div>
</div>


