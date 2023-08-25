@extends('Mobile.layouts.front.stand')
@section('title') Meeper | детали @endsection
@section('content')

    @php
        if ($standPublisher) {
            $publishers = json_decode($standPublisher->publishers, true);
        } else {
            $publishers = [];
        }
    @endphp
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

        {{-- Первый возвещатель --}}
        <div class="card card-hover-shadow mt-4">
            <div class="card-body">
                <div class="d-flex align-items-center mb-2">
                    <div class="flex-grow-1">
                        <h3 class="text-inherit mb-1">Первый возвещатель
                            @empty($publishers['user_1'])
                                <span class="badge bg-secondary">Пусто</span>
                            @else
                                <span class="badge bg-info">Записан</span>
                            @endempty
                        </h3>

                        <form id="changeForm" method="post" action="{{ route('AddPublisherToStand1', ['id' => $standPublisher->id]) }}">
                            @csrf
                            <div class="tom-select-custom">
                                <select class="js-select form-select" autocomplete="off" name="1_user_id" id="1_user_id">
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}"
                                            {{ ($publishers['user_1'] == $user->id
                                            || (auth()->id() == $user->id
                                            && $publishers['user_1'] == null)) ? 'selected' : '' }}>
                                            {{ $user->last_name }} {{ $user->first_name }}
                                        </option>
                                    @endforeach
                            </select>
                            </div>
                        </form>
                    </div>
                </div>
                @empty($publishers['user_1'])
                    <div class="col-12">
                        <div class="d-grid gap-2">
                            <a class="btn btn-success m-1" type="button" href="{{ route('recordRedactionChange1',['id' => $standPublisher->id, 'stand' => $stand->id]) }}"
                               onclick="event.preventDefault();
                                                        document.getElementById('changeForm').submit();">
                                Записать(ся)
                            </a>
                        </div>
                    </div>
                @else
                <div class="row">
                    <div class="col-6">
                        <div class="d-grid">
                            <a class="btn btn-danger m-1" type="button" href="{{ route('recordRedactionDelete1', ['id' => $standPublisher->id, 'stand' => $stand->id]) }}">
                                Выписать(ся)
                            </a>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="d-grid gap-2">
                            <a class="btn btn-success m-1" type="button" href="{{ route('recordRedactionChange1',['id' => $standPublisher->id, 'stand' => $stand->id]) }}"
                               onclick="event.preventDefault();
                                                        document.getElementById('changeForm').submit();">
                                Изменить
                            </a>
                        </div>
                    </div>
                </div>
                @endempty
            </div>
        </div>

        {{-- Второй возвещатель --}}
        <div class="card card-hover-shadow mt-4">
            <div class="card-body">
                <div class="d-flex align-items-center mb-2">
                    <div class="flex-grow-1">
                        <h3 class="text-inherit mb-1">Второй возвещатель
                            @empty($publishers['user_2'])
                                <span class="badge bg-secondary">Пусто</span>
                            @else
                                <span class="badge bg-info">Записан</span>
                            @endempty</h3>

                        <form id="changeForm2" method="post" action="{{ route('AddPublisherToStand2',['id' => $standPublisher->id]) }}">
                            @csrf
                            <div class="tom-select-custom">
                                <select class="js-select form-select" autocomplete="off" name="2_user_id" id="2_user_id">
                                    @foreach ($users as $user)
                                        @if($user->id != $publishers['user_2'])
                                            <option value="{{ $user->id }}"
                                                {{ ($publishers['user_2'] == $user->id
                                                || (auth()->id() == $user->id
                                                && $publishers['user_2'] == null)) ? 'selected' : '' }}>
                                                {{ $user->last_name }} {{ $user->first_name }}
                                            </option>
                                        @else
                                            <option value="{{ $user->id }}" selected>
                                                {{ $user->last_name }} {{ $user->first_name }}
                                            </option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </form>
                    </div>
                </div>
                @empty($publishers['user_2'])
                    <div class="row">
                        <div class="col-12">
                            <div class="d-grid">
                                <a class="btn btn-success m-1" type="button"  href="{{ route('recordRedactionChange2',['id' => $standPublisher->id, 'stand' => $stand->id]) }}" onclick="event.preventDefault();
                                   document.getElementById('changeForm2').submit();">
                                    Записать(ся)
                                </a>
                            </div>
                        </div>
                    </div>
                @else
                <div class="row">
                    <div class="col-6">
                        <div class="d-grid">
                            <a class="btn btn-danger m-1" type="button"  href="{{ route('recordRedactionDelete2',['id' => $standPublisher->id, 'stand' => $stand->id]) }}">
                                Выписать(ся)
                            </a>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="d-grid">
                            <a class="btn btn-success m-1" type="button"  href="{{ route('recordRedactionChange2',['id' => $standPublisher->id, 'stand' => $stand->id]) }}" onclick="event.preventDefault();
                                   document.getElementById('changeForm2').submit();">
                                Изменить
                            </a>
                        </div>
                    </div>
                </div>
                @endempty
            </div>
        </div>

@endsection
