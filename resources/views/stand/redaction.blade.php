@extends('layouts.app')
@section('title') Meeper | Редактирование @endsection
@section('content')

    <div class="main-content pt-4">
        <div class="row">
            <div class="col-lg-10 col-md-10 col-xl-10 mb-4 mt-4 offset-md-1">
                <div class="card mb-4">
                    <div class="card-header">
                        <h4 class="font-weight-bold">Запись <span class="text-mute text-12">{{ $stpubl->id }}</span> для стенда {{ $stand->name }}</h4>
                        <p class="text-20 text-success font-weight-bold line-height-1 mb-5">Дата записи: </strong>{{ $stpubl->date }}</p>
                        <small class="text-muted"></small>
                    </div>
                </div>
                {{--<div class="card-header d-flex align-items-center">
                    <h3 class="w-50 float-left card-title m-0">New Users</h3>
                    <div class="dropdown dropleft text-right w-50 float-right">
                        <button class="btn bg-gray-100" id="dropdownMenuButton_table1" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="nav-icon i-Gear-2"></i>
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton_table1">
                            <a class="dropdown-item" href="#">Add new user</a>
                            <a class="dropdown-item" href="#">View All users</a>
                            <a class="dropdown-item" href="#">Something else here</a>
                        </div>
                    </div>
                </div>--}}
                <div class="row">
                    {{-- Первый возвещатель --}}
                    <div class="col-md-6 mb-3 mb-sm-0">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="heading">Первый возвещатель</h5>
                                @if (is_null($stpubl->user_1))
                                    <a href="{{ route('PageUpdateRecordStandFirst',['id' => $stpubl->id]) }}">
                                        <button class="btn btn-primary m-1" type="button" >
                                            Записаться
                                        </button>
                                    </a>
                                @else
                                    <div class="row mb-3 mb-sm-0">
                                        <div class="col-md-12">
                                            <form id="changeForm" method="post" action="{{ route('recordRedactionChange1', ['id' => $stpubl->id, 'stand' => $stand->id]) }}">
                                                @csrf
                                                <select class="form-control form-control-rounded heading mb-4" name="1_user_id" id="1_user_id">
                                                    @foreach ($user as $us)
                                                        @if ($stpubl->user_1 == $us->id)
                                                            <option value="{{ $us->id }}" selected>{{ $us->name }}</option>
                                                        @else
                                                            <option value="{{ $us->id }}">{{ $us->name }}</option>
                                                        @endif

                                                    @endforeach
                                                </select>
                                            </form>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="row">
                                                <div class="col text-left mb-3 mb-sm-0">
                                                    <a href="{{ route('recordRedactionDelete1',['id' => $stpubl->id, 'stand' => $stand->id]) }}">
                                                        <button class="btn btn-danger m-1" type="button" >
                                                            Выписать(ся)
                                                        </button>
                                                    </a>
                                                </div>
                                                <div class="col text-right mb-3 mb-sm-0">
                                                    <a href="{{ route('recordRedactionChange1',['id' => $stpubl->id, 'stand' => $stand->id]) }}"      onclick="event.preventDefault();
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
                                @if (is_null($stpubl->user_2))
                                    <a href="{{ route('PageUpdateRecordStandSecond',['id' => $stpubl->id]) }}">
                                        <button class="btn btn-primary m-1" type="button" >
                                            Записаться
                                        </button>
                                    </a>
                                @else
                                    <div class="row mb-3 mb-sm-0">
                                        <div class="col-md-12">
                                            <form id="changeForm2" method="post" action="{{ route('recordRedactionChange2',['id' => $stpubl->id, 'stand' => $stand->id]) }}">
                                                @csrf
                                                <select class="form-control form-control-rounded heading mb-4" name="2_user_id" id="2_user_id">
                                                    @foreach ($user as $us)
                                                        @if ($stpubl->user_2 == $us->id)
                                                            <option value="{{ $us->id }}" selected>{{ $us->name }}</option>
                                                        @else
                                                            <option value="{{ $us->id }}">{{ $us->name }}</option>
                                                        @endif

                                                    @endforeach
                                                </select>
                                            </form>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="row">
                                                <div class="col text-left mb-3 mb-sm-0">
                                                    <a href="{{ route('recordRedactionDelete2',['id' => $stpubl->id, 'stand' => $stand->id]) }}">
                                                        <button class="btn btn-danger m-1" type="button" >
                                                            Выписать(ся)
                                                        </button>
                                                    </a>
                                                </div>
                                                <div class="col text-right mb-3 mb-sm-0">
                                                    <a href="{{ route('recordRedactionChange2',['id' => $stpubl->id, 'stand' => $stand->id]) }}" onclick="event.preventDefault();
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
