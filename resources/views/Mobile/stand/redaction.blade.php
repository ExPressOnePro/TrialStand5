@extends('layouts.app')
@section('title') Meeper | Редактирование @endsection
@section('content')

    <div class="main-content pt-4">
        <div class="row">
            <div class="col-lg-10 col-md-10 col-xl-10 mb-4 mt-4 offset-md-1">
                <div class="card mb-4">
                    <div class="card-header">
                        <h4 class="font-weight-bold">Запись <span class="text-mute text-12">{{ $standPublisher->id }}</span> для стенда {{ $stand->name }}</h4>
                        <p class="text-20 text-success font-weight-bold line-height-1 mb-5">
                            Дата записи: </strong>{{ $standPublisher->date }}
                            Время записи: </strong>{{ $standPublisher->time }}
                        </p>

                        <small class="text-muted"></small>
                    </div>
                </div>
                <div class="row">
                    @foreach ($users as $user)
                        @if ($standPublisher->user_1 == $user->id)
                            <option value="{{ $user->id }}" selected>{{ $user->name }}</option>
                        @else
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                        @endif
                    @endforeach
                    {{-- Первый возвещатель --}}
                    <div class="col-md-6 mb-3 mb-sm-0">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="heading">Первый возвещатель</h5>
                                @if (is_null($standPublisher->user_1))
                                    <h6 class="heading">Нет записи чтобы изменить</h6>
                                @else
                                    <div class="row mb-3 mb-sm-0">
                                        <div class="col-md-12">
                                            <form id="changeForm" method="post" action="{{ route('recordRedactionChange1', ['id' => $standPublisher->id, 'stand' => $stand->id]) }}">
                                                @csrf
                                                <select class="form-control form-control heading mb-4" name="1_user_id" id="1_user_id">
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
                                                        document.getElementById('changeForm').submit();">
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

                    {{-- Второй возвещатель --}}
                    <div class="col-md-6 mb-3 mb-sm-0">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="heading">Второй возвещатель</h5>
                                @if (is_null($standPublisher->user_2))
                                    <h6 class="heading">Нет записи чтобы изменить</h6>
                                @else
                                    <div class="row mb-3 mb-sm-0">
                                        <div class="col-md-12">
                                            <form id="changeForm2" method="post" action="{{ route('recordRedactionChange2',['id' => $standPublisher->id, 'stand' => $stand->id]) }}">
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
                                   document.getElementById('changeForm2').submit();">
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
                </div>
            </div>
        </div>
    </div>
@endsection
