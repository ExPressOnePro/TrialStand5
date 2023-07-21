@extends('layouts.app')
@section('title') Meeper | Стенды @endsection
@section('content')

    <div class="main-content pt-4">
            <div class="separator-breadcrumb border-top"></div>
            <div class="row">
                @role('User')
                @foreach($accessible_stands_for_the_user as $asfu)
                    <div class="col-md-3">
                        <div class="card card-body mb-4">
                            @role('Manager')
                            <div class="text-right">
                                <a href="{{ route('StandSettings', $asfu->id) }} ">
                                    <i class="fa-solid fa-gear header-icon text-25 m-1 text-primary" type="button" href="{{ route('StandSettings', $asfu->id) }} "></i>
                                </a>
                            </div>
                            @endrole
                            <div class="text-center">
                                <h1 class="heading">{{ $asfu->name }}</h1>
                                <p class="mb-3 text-muted">{{ __('text.place') }}<br>{{ $asfu->location }}"</p>
                                <a href="{{ route('currentWeekTable', $asfu->id) }}">
                                    <button class="btn btn-block btn-info text-20">{{ __('text.Open') }}</button>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
                @endrole
            </div>
    </div>

@endsection
