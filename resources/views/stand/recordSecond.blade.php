@extends('layouts.app')
@section('title') Meeper | Запись@endsection
@section('content')

    <div class="main-content pt-4">
        <div class="breadcrumb">
            <h1 class="mr-2"></h1>
            <ul>
                <li><a href="">страница</a></li>
                <li></li>
            </ul>
        </div>
        <div class="separator-breadcrumb border-top"></div>
        <div class="row">
            <div class="col-lg-8 col-md-8 col-xl-8  mb-4 mt-4 offset-md-1">
                <div class="card mb-4">
                    <div class="card-body">
                        <form method="post" action="{{ route('UpdateRecordStandSecond', $stpubl->id) }}">
                            @csrf
                            <div class="row">
                                <div class="col-md-11 mb-3 mb-sm-0">
                                    <h4 class="font-weight-bold">Информация о записи для стенда {{ $standname }}</h4>
                                </div>
                                <div class="col-md-1 mb-3 mb-sm-0">
                                    <span class="text-mute text-12">{{ $stpubl->id }}</span>
                                </div>
                            </div>
                            <p class="text-20 text-success font-weight-bold line-height-1 mb-5">Дата записи: </strong>{{ $stpubl->date }}</p><small class="text-muted"></small>
                            <div class="row mb-5">
                                <div class="col-md-6 mb-3 mb-sm-0">
                                    <h5 class="font-weight-bold">Второй возвещатель</h5>
                                    <select class="form-control form-control-rounded" name="usernameID" id="usernameID">
                                        @foreach ($user as $us)
                                            @if (auth()->user()->id == $us->id)
                                                <option value="{{ $us->id }}" selected>{{ $us->name }}</option>
                                            @else
                                                <option value="{{ $us->id }}">{{ $us->name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <button class="btn btn-success m-1">Подтвердить запись</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
