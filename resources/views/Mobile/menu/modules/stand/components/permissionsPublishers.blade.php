<div class="card-header">
    <h4 class="card-title">Разрешения пользователей</h4>
</div>
<div class="card-body">
    <p>Установив эти разрешения пользователи смогут делать следующее <span class="fw-semibold"></span></p>
    <div class="row col-auto">
        @foreach($permissionsPublishers as $permissionPublisher)
            <form method="post" action="">
                @csrf
                <div class="d-flex justify-content-between">
                    <a class="text-decoration-none">
                        <div class="ms-1">
                            @if($permissionPublisher->name == 'stand.make_entry')
                                <span class="d-block h2 text-inherit mb-0">Могут записываться</span>
                            @elseif($permissionPublisher->name == 'stand.delete_entry')
                                <span class="d-block h2 text-inherit mb-0">Могут выписываться</span>
                            @elseif($permissionPublisher->name == 'stand.change_entry')
                                <span class="d-block h2 text-inherit mb-0">Могут изменять записанного</span>
                            @endif
                        </div>
                    </a>
                    <label class="form-check form-switch m-1">
                        <input type="checkbox" class="form-check-input" name="permissions[]" value="{{ $permissionPublisher->id }}">
                        <label class="form-check-label"></label>
                    </label>
                </div>
            </form>
        @endforeach
    </div>
</div>


