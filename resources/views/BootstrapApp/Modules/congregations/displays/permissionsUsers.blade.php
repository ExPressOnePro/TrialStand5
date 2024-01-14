@extends('BootstrapApp.layouts.bootstrapApp')
@section('title') Meeper @endsection
@section('content')

    <div class="content container-fluid m-8">

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

                </div>
            </div>

            <!-- Table -->
            <div class="table-responsive datatable-custom mb-5">
            <table id="example" class=" table-borderless table-thead-bordered nowrap table-align-middle card-table">

                <thead class="thead-light">
                    <tr>
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

    <script>

        $(document).ready(function() {
            $('#example').DataTable( {
                dom: 'Blt',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ],
                paging: false, // Disable paging
                searching: true
            } );
            // Ваш поиск DataTables
            $('#datatableWithSearchInput').on('keyup', function () {
                $('#example').DataTable().search($(this).val()).draw();
            });
        } );

    </script>
@endsection
