@extends('Mobile.layouts.front.app')
@section('title') Meeper | Меню @endsection
@section('content')

    @include('Mobile.includes.alerts.alerts')


    <div class="content container-fluid">
        <div class="row row-cols-1">
            @can('module.stand')
                <div class="col mb-3 mb-lg-5">
                    <div class="list-group d-flex align-items-center">
                        <a class="list-group-item list-group-item-action border border-success" href="{{ route('stand.hub') }}">
                        <div class="d-flex align-items-center m-2">
                            <div class="avatar">
                                <img class="card-img" src="{{ asset('front/img/ss.svg') }}">
                            </div>
                            <div class="ms-3">
                                <span class="d-block h1 text-inherit mb-0">Стенд</span>
                                <span class="d-block h3 text-inherit text-body mb-0">Служение со стендом</span>
                            </div>
                        </div>
                    </a>
                    </div>
                </div>
            @endcan
                @can('module.contacts')
                    <div class="col mb-3 mb-lg-5">
                        <div class="list-group d-flex align-items-center">
                            <a class="list-group-item list-group-item-action border border-success" href="{{ route('contacts.hub', ['congregation_id' => Auth()->user()->congregation_id]) }}">
                                <div class="d-flex align-items-center m-2">
                                    <div class="avatar">
                                        <img class="card-img" src="{{ asset('front/img/contacts.svg') }}">
                                    </div>
                                    <div class="ms-3">
                                        <span class="d-block h1 text-inherit mb-0">Контакты</span>
                                        <span class="d-block h4 text-inherit text-body mb-0">Контактная книга собрания</span>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                @endcan
                @can('congregation.open_congregation')
                    <div class="col mb-3 mb-lg-5">
                        <div class="list-group d-flex align-items-center">
                            <a class="list-group-item list-group-item-action border border-2 border-warning" href="{{ route('congregationView', ['id' =>auth()->user()->congregation_id ]) }}">
                                <div class="d-flex align-items-center m-2">
                                    <div class="avatar">
                                        <img class="card-img" src="{{ asset('front/img/meeting.svg') }}">
                                    </div>
                                    <div class="ms-3">
                                        <span class="d-block h1 text-inherit mb-0">Собрание</span>
                                        <span class="d-block h4 text-inherit text-body mb-0">Управляйте собранием</span>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                @endcan

        </div>
    </div>

@endsection
