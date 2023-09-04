@extends('Mobile.layouts.front.stand')
@section('title') Meeper | детали @endsection
@section('content')

    <div class="content container-fluid">
        <div class="alert alert-soft-dark mb-5 mb-lg-7" role="alert">
            <div class="d-flex align-items-center">
                <div class="flex-grow-1 ms-3">
                    <h3 class="alert-heading mb-1">Информация о записи</h3>
                    <p class="mb-0">Дата:  {{ $standPublisher->date }}</p>
                    <p class="mb-0">Время:  {{ date('H:i', strtotime($standPublisher->time . ':00')) }}</p>
                </div>
            </div>
        </div>

        @for($i = 1; $i <= $settings['publishers_at_stand']; $i++)
            @php
                $userKey = "user_$i";
                $isUserEmpty = empty($publishers[$userKey]);
                $currentUser = auth()->id();
                $isCurrentUser = ($currentUser == $publishers[$userKey] && !$publishers[$userKey]);
                $userLabel = $isUserEmpty ? 'Пусто' : 'Записан';
            @endphp

            <div class="card card-hover-shadow mt-4">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-2">
                        <div class="flex-grow-1">
                            <h3 class="text-inherit mb-1">{{ $i === 1 ? 'Первый' : ($i === 2 ? 'Второй' : ($i === 3 ? 'Третий' : 'Четвертый')) }} возвещатель
                                @if($isUserEmpty)
                                    <span class="badge bg-secondary">{{ $userLabel }}</span>
                                @else
                                    <span class="badge bg-info">{{ $userLabel }}</span>
                                @endif
                            </h3>

                            <form id="changeForm{{ $i }}" method="post" action="{{ route('AddPublisherToStand' . $i, ['id' => $standPublisher->id]) }}">
                                @csrf
                                <div class="tom-select-custom">
                                    <select class="js-select form-select" autocomplete="off" name="{{ $i }}_user_id" id="{{ $i }}_user_id">
                                        @php
                                            $currentUser = auth()->user();
                                        @endphp

                                        <option value="{{ $currentUser->id }}" {{ ($publishers[$userKey] == $currentUser->id || $isCurrentUser) ? 'selected' : '' }}>
                                            {{ $currentUser->last_name }} {{ $currentUser->first_name }}
                                        </option>

                                        @foreach ($users as $user)
                                            @if ($user->id != $currentUser->id)
                                                <option value="{{ $user->id }}" {{ ($publishers[$userKey] == $user->id) ? 'selected' : '' }}>
                                                    {{ $user->last_name }} {{ $user->first_name }}
                                                </option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </form>
                        </div>
                    </div>

                    @if($isUserEmpty)
                        <div class="col-12">
                            <div class="d-grid gap-2">
                                <a class="btn btn-success m-1" type="button" href="{{ route('recordRedactionChange' . $i, ['id' => $standPublisher->id, 'stand' => $stand->id]) }}"
                                   onclick="event.preventDefault();
                                        document.getElementById('changeForm{{ $i }}').submit();">
                                    Записать(ся)
                                </a>
                            </div>
                        </div>
                    @else
                        <div class="row">
                            <div class="col-6">
                                <div class="d-grid">
                                    <a class="btn btn-danger m-1" type="button" href="{{ route('recordRedactionDelete' . $i, ['id' => $standPublisher->id, 'stand' => $stand->id]) }}">
                                        Выписать(ся)
                                    </a>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="d-grid gap-2">
                                    <a class="btn btn-success m-1" type="button" href="{{ route('recordRedactionChange' . $i, ['id' => $standPublisher->id, 'stand' => $stand->id]) }}"
                                       onclick="event.preventDefault();
                                            document.getElementById('changeForm{{ $i }}').submit();">
                                        Изменить
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endif

                </div>
            </div>
        @endfor
    </div>
@endsection
