
        <div class="card">

            <div class="card-header">
                <h4 class="card-title">Разрешения пользователей</h4>
            </div>
            <div class="card-body">
                <p>Установив эти разрешения пользователи смогут делать следующее <span class="fw-semibold"></span></p>
                <div class="row col-auto">
                    <form method="POST" action="{{ route('updatePerm') }}">
                        @csrf
                        <div class="table-responsive">
                            <table>
                            <thead>
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
                            @foreach($usersCongregation as $user)
                                <tr class="border-bottom">
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
        </div>




