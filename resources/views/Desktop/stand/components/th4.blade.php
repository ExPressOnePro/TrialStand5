<th class="value4">
    @if(empty($standPublisher) || is_null($standPublisher->user) && is_null($standPublisher->user2)){{--если не создана запись--}}
    @else
        @if(auth()->user()->can('Stand-Entry in table'))
            <div class="align-items-center">
                <button class="btn btn-primary m-1" type="button" data-toggle="modal" data-target="#redaction{{$standPublisher->id }}" data-id="new">
                    Изменить
                </button>
            </div>
            <div class="modal fade" id="redaction{{$standPublisher->id }}" tabindex="-1" role="dialog" aria-labelledby="record1" style="display: none;" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="record1">Запись для стенда {{ $stand->name }} № {{$standPublisher->id }}</h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>

                        <div class="modal-body">
                            <div class="card  mb-3">
                                <div class="card-body">
                                    <h5 class="heading">Первый возвещатель</h5>
                                    @if(is_null($standPublisher->user_1))
                                        <h6 class="heading">Нет записи чтобы изменить</h6>
                                    @else
                                        <div class="row mb-3 mb-sm-0">
                                            <div class="col-md-12">
                                                <form id="changeForm{{$standPublisher->id }}" method="post" action="{{ route('recordRedactionChange1', ['id' => $standPublisher->id, 'stand' => $stand->id]) }}">
                                                    @csrf
                                                    <select class="form-control form-control-rounded heading mb-4" name="1_user_id" id="1_user_id">
                                                        @foreach ($users as $user)
                                                            @if ($standPublisher->user_1 == $user->id)
                                                                <option value="{{ $user->id }}" selected>{{ $user->first_name }} {{ $user->last_name }}</option>
                                                            @else
                                                                <option value="{{ $user->id }}">{{ $user->first_name }} {{ $user->last_name }}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </form>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <div class="col text-left mb-3 mb-sm-0">
                                                        <a href="{{ route('recordRedactionDelete1',['id' => $standPublisher->id, 'stand' => $stand->id]) }}">
                                                            <button class="btn btn-danger m-1" type="button" >
                                                                Выписать(ся)
                                                            </button>
                                                        </a>
                                                    </div>
                                                    <div class="col text-right mb-3 mb-sm-0">
                                                        <a href="{{ route('recordRedactionChange1',['id' => $standPublisher->id, 'stand' => $stand->id]) }}"      onclick="event.preventDefault();
                                                                                                    document.getElementById('changeForm{{$standPublisher->id }}').submit();">
                                                            <button class="btn btn-success m-1" type="button" >
                                                                Изменить запись
                                                            </button>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="card  mb-3">
                                <div class="card-body">
                                    <h5 class="heading">Второй возвещатель</h5>
                                    @if (is_null($standPublisher->user_2))
                                        <h6 class="heading">Нет записи чтобы изменить</h6>
                                    @else
                                        <div class="row mb-3 mb-sm-0">
                                            <div class="col-md-12">
                                                <form id="changeForm2{{$standPublisher->id }}" method="post" action="{{ route('recordRedactionChange2',['id' => $standPublisher->id, 'stand' => $stand->id]) }}">
                                                    @csrf
                                                    <select class="form-control form-control-rounded heading mb-4" name="2_user_id" id="2_user_id">
                                                        @foreach ($users as $user)
                                                            @if ($standPublisher->user_2 == $user->id)
                                                                <option value="{{ $user->id }}" selected>{{ $user->first_name }} {{ $user->last_name }}</option>
                                                            @else
                                                                <option value="{{ $user->id }}">{{ $user->first_name }} {{ $user->last_name }}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </form>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <div class="col text-left mb-3 mb-sm-0">
                                                        <a href="{{ route('recordRedactionDelete2',['id' => $standPublisher->id, 'stand' => $stand->id]) }}">
                                                            <button class="btn btn-danger m-1" type="button" >
                                                                Выписать(ся)
                                                            </button>
                                                        </a>
                                                    </div>
                                                    <div class="col text-right mb-3 mb-sm-0">
                                                        <a href="{{ route('recordRedactionChange2',['id' => $standPublisher->id, 'stand' => $stand->id]) }}" onclick="event.preventDefault();
                                                                                                    document.getElementById('changeForm2{{$standPublisher->id }}').submit();">
                                                            <button class="btn btn-success m-1" type="button" >
                                                                Изменить запись
                                                            </button>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary" type="submit" data-dismiss="modal">Закрыть</button>
                        </div>
                    </div>
                </div>
            </div>
        @else
        @endif
    @endif
</th>
