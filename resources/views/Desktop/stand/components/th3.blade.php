<th class="value3">
    @empty($standPublisher){{--если не создана запись--}}
    @if(auth()->user()->can('Stand-Entry in table'))
        @empty($standPublisher->user)
            <button class="btn btn-success  " type="button" data-toggle="modal" data-target="#NewRecordStand2{{$time}}{{$gwe}}{{$day}}{{$StandTemplate->id}}" data-id="new">
                Записаться
            </button>
        @endempty
    @else
        <p class="text-danger heading">Нет записи</p>
    @endif
    @else
        @empty(($standPublisher->user2)){{--если создана но нет 2 пользователя запись--}}
        @if(auth()->user()->can('Stand-Entry in table'))
            @empty($standPublisher->user2)
                <button class="btn btn-success m-1" type="button" data-toggle="modal" data-target="#record2{{$standPublisher->id }}" data-id="new">
                    Записаться
                </button>

                <div class="modal fade" id="record2{{$standPublisher->id }}" tabindex="-1" role="dialog" aria-labelledby="record2" style="display: none;" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="record2">Запись для стенда {{ $stand->name }} № {{$standPublisher->id }}</h5>
                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>

                            <div class="modal-body">
                                <form id="recordStandSecond{{$standPublisher->id }}" method="post" action="{{ route('AddPublisherToStand2', $standPublisher->id) }}">
                                    @csrf
                                    <p class="text-20 text-success text-center font-weight-bold line-height-1 mb-5" id="id">
                                        Дата {{$standPublisher->date }} <br> Время {{$standPublisher->time }}
                                    </p>
                                    <small class="text-muted"></small>
                                    <div class="row mb-5">
                                        <div class="col-md-12 mb-3 mb-sm-0">
                                            <h5 class="font-weight-bold text-center">Второй возвещатель</h5>
                                            <select class="form-control form-control-rounded" name="user_2" id="user_2">
                                                @foreach ($users as $user)
                                                    @if (auth()->user()->id == $user->id)
                                                        <option value="{{ $user->id }}" selected>{{ $user->first_name }} {{ $user->last_name }}</option>
                                                    @else
                                                        <option value="{{ $user->id }}">{{ $user->first_name }} {{ $user->last_name }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-secondary" type="submit" data-dismiss="modal">Закрыть</button>
                                <a class="btn btn-success" type="button" href="{{ route('AddPublisherToStand2', $standPublisher->id) }}"
                                   onclick="event.preventDefault();
                                                                                   document.getElementById('recordStandSecond{{$standPublisher->id }}').submit();">
                                    Записать
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endempty
        @else
            <p class="text-danger heading">Нет записи</p>
        @endif
        @else{{--если создана есть 2 пользователь--}}
        @empty($standPublisher->user2->mobile_phone)

            {{$standPublisher->user2->first_name}} {{$standPublisher->user2->last_name}}

        @else

            <button class="btn btn-outline-secondary btn-icon" onclick="callNumber({{$standPublisher->user2->mobile_phone}})">
                                                                            <span class="ul-btn__icon">
                                                                                <i class="fa-solid fa-phone"></i>
                                                                            </span>
            </button>
            {{$standPublisher->user2->first_name}} {{$standPublisher->user2 ->last_name}}

        @endempty
        @endempty
    @endempty
</th>
