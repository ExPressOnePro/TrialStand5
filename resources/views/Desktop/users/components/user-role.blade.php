<div class="col-md-4">
    <div class="card card-icon mb-4">
        <div class="card-body text-center">
            <div class="text-center ">
                <h5 class="card-title heading mb-4">Роль пользователя</h5>
                <div class="separator border-top mb-2"></div>
            </div>
            @foreach($roles as $role)
                <div class="row">
                    <div class="col mb-3">
                        <h4 class="heading text-left">{{$role->name}}</h4>
                    </div>
                    @if(DB::table('users_roles')
                    ->where('user_id', '=', $user->id)
                    ->where('role_id', '=', $role->id)
                    ->count() > 0)
                        <div class="col mb-3">
                                        <span class="text-success heading text-left">
                                            <i class="fa-solid fa-circle-check"></i> Доступная роль</span>
                            <form method="post" action="{{ route('roleDelete', $user->id) }}">
                                @csrf
                                <input type="hidden" name="delete_role_id" value="{{ $role->id }}">
                                <button class="btn btn-danger btn-sm">Запретить</button>
                            </form>
                        </div>
                    @else
                        <form method="post" action="{{ route('roleAllow', $user->id) }}">
                            @csrf
                            <div class="col-md-6 mb-3">
                                <input type="hidden" name="allow_role_id" value="{{ $role->id }}">
                                <button class="btn btn-primary btn-sm">Разрешить</button>
                            </div>
                        </form>
                    @endif
                </div>
            @endforeach
        </div>
    </div>
</div>
