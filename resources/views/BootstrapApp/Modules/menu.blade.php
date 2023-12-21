@extends('BootstrapApp.layouts.bootstrapApp')
@section('title') Meeper | Меню @endsection
@section('content')

    @include('Mobile.includes.alerts.alerts')

    <div class="container px-4 py-5">
        {{--        <div class="row py-3 row-cols-1 row-cols-lg-3 ">--}}
        {{--            <div class="col d-flex align-items-start border rounded-3 shadow">--}}
        {{--                <div class="align-items-center me-3">--}}
        {{--                    <img src="{{ asset('front/img/ss.svg') }}" height="60" width="50" alt="Stand Icon">--}}
        {{--                </div>--}}
        {{--                <div class="align-items-center mb-0">--}}
        {{--                    <h3 class="fw-bold mb-0 fs-4 text-body-emphasis">Стенд</h3>--}}
        {{--                    <p class="m-auto">Служение со стендом</p>--}}
        {{--                </div>--}}
        {{--            </div>--}}
        {{--        </div>--}}
        {{--        <div class="col-sm-12 mt-1">--}}
        {{--            <a class="card border-left-empty rounded-3 text-decoration-none shadow">--}}
        {{--                <div class="d-flex justify-content-left">--}}
        {{--                    <!-- time -->--}}
        {{--                    <div class="col-3 text-center">--}}
        {{--                        <img src="{{ asset('front/img/ss.svg') }}" height="60" width="50" alt="Stand Icon">--}}
        {{--                    </div>--}}
        {{--                    <!-- publishers -->--}}
        {{--                    <div class="col-9 align-items-center m-auto">--}}
        {{--                        <h3 class="fw-bold mb-0 fs-4 text-body-emphasis">Стенд</h3>--}}
        {{--                        <p class="m-auto">Служение со стендом</p>--}}
        {{--                    </div>--}}


        {{--                </div>--}}
        {{--            </a>--}}
        {{--        </div>--}}
        <div class="row py-3 row-cols-1 row-cols-lg-3">
            @can('module.stand')
                <div class="col mb-3 mb-lg-5">
                    <a class="card border-left-empty rounded-3 text-decoration-none shadow p-4" href="{{route('stand.hub2')}}">
                        <div class="d-flex justify-content-left">
                            <!-- time -->
                            <div class="align-items-center me-3">
                                <img src="{{ asset('front/img/ss.svg') }}" height="90" width="75" alt="Stand Icon">
                            </div>
                            <!-- publishers -->
                            <div class="col-9 align-items-center m-auto">
                                <h2 class="fw-bold mb-0 fs-2 text-body-emphasis">Стенд</h2>
                                <p class="m-auto">Служение со стендом</p>
                            </div>
                        </div>
                    </a>
                </div>
            @endcan
            @can('module.contacts')
                <div class="col mb-3 mb-lg-5">
                    <a class="card border-left-empty rounded-3 text-decoration-none shadow mb-2 p-4" href="{{route('contacts.hub2')}}">
                        <div class="d-flex justify-content-left">
                            <!-- time -->
                            <div class="align-items-center me-3">
                                <img src="{{ asset('front/img/contacts.svg') }}"  height="90" width="75" alt="Contact Icon">
                            </div>
                            <!-- publishers -->
                            <div class="col-9 align-items-center m-auto">
                                <h3 class="fw-bold mb-0 fs-2 text-body-emphasis">{{ __('text.Контакты') }}</h3>
                                <p class="m-auto">{{ __('text.Контактная книга собрания') }}</p>
                            </div>
                        </div>
                    </a>
                </div>
            @endcan
            @can('congregation.open_congregation')
                <div class="col mb-3 mb-lg-5">
                        <a class="card border-left-empty rounded-3 text-decoration-none shadow mb-2 p-4" href="{{ route('congregationView', ['id' =>auth()->user()->congregation_id ]) }}">
                            <div class="d-flex align-items-center">
                                <div class="align-items-center me-3">
                                    <img src="{{ asset('front/img/meeting.svg') }}"  height="90" width="75" alt="Contact Icon">
                                </div>
                                <div class="col-9 align-items-center m-auto">
                                    <h3 class="fw-bold mb-0 fs-2 text-body-emphasis">{{ __('text.Собрание') }}</h3>
                                    <p class="m-auto">{{ __('text.Управляйте собранием') }}</p>
                                </div>
                            </div>
                        </a>
                </div>
            @endcan
        </div>
    </div>




@endsection
