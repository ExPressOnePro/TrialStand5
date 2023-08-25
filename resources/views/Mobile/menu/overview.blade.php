@extends('Mobile.layouts.front.menu')
@section('title') Meeper | Меню @endsection
@section('content')
    @include('Mobile.includes.headers.header-home')
    @include('Mobile.includes.alerts.alerts')


    <div class="content container-fluid">
        <div class="page-header page-header-reset">
            <div class="row align-items-center">
                <div class="col-sm">
                    <h2 class="page-header-title"></h2>
                </div>
            </div>
        </div>
        <div class="row">
            @can('module.stand')
                <div class="col-6 col-sm-4 col-sm-3 mb-5">
                    <a class="card card-hover-shadow card-bordered h-100 text-center" href="{{ route('stand.hub') }}">
                        <div class="card-body">
                            <img class="card-img" src="{{ asset('front/img/stand_2.svg') }}">
                        </div>


                        <div class="card-footer">
                            <h3 class="card-title text-inherit">Стенд</h3>
                            <p class="card-text text-inherit fs-6">Cлужениe со стендом</p>
                        </div>
                    </a>
                </div>
            @endcan
            @can('module.schedule')
                <div class="col-6 col-sm-4 col-sm-3 mb-5">
                    <a class="card card-hover-shadow card-bordered h-100 text-center" href="">
                        <div class="card-body">
                            <img class="card-img" src="{{ asset('front/img/stand_2.svg') }}" alt="Image Description" data-hs-theme-appearance="default" style="max-width: 15rem;">
                            <img class="card-img" src="{{ asset('front/img/stand_2.svg') }}" alt="Image Description" data-hs-theme-appearance="dark" style="max-width: 15rem;">
                        </div>
                        <div class="card-footer">
                            <h3 class="card-title text-inherit">Графики</h3>
                            <p class="card-text text-inherit fs-6">Расписания встреч собрания</p>
                        </div>
                    </a>
                </div>
            @endcan
{{--            <div class="col-6 col-sm-4 col-sm-3 mb-5">--}}
{{--                <a class="card card-hover-shadow card-bordered h-100 text-center" href="">--}}
{{--                    <div class="card-body">--}}
{{--                        <img class="card-img" src="{{ asset('front/img/stand_2.svg') }}" alt="Image Description" data-hs-theme-appearance="default" style="max-width: 15rem;">--}}
{{--                        <img class="card-img" src="{{ asset('front/img/stand_2.svg') }}" alt="Image Description" data-hs-theme-appearance="dark" style="max-width: 15rem;">--}}
{{--                    </div>--}}
{{--                    <div class="card-footer">--}}
{{--                        <h3 class="card-title text-inherit">Расписания</h3>--}}
{{--                        <p class="card-text text-inherit fs-6">Расписание ответственных</p>--}}
{{--                    </div>--}}
{{--                </a>--}}
{{--            </div>--}}
                {{--            <div class="col-6 col-sm-4 col-sm-3 mb-5">--}}
{{--                <a class="card card-hover-shadow card-bordered h-100 text-center" href="">--}}
{{--                    <div class="card-body">--}}
{{--                        <img class="card-img" src="{{ asset('front/img/stand_2.svg') }}" alt="Image Description" data-hs-theme-appearance="default" style="max-width: 15rem;">--}}
{{--                        <img class="card-img" src="{{ asset('front/img/stand_2.svg') }}" alt="Image Description" data-hs-theme-appearance="dark" style="max-width: 15rem;">--}}
{{--                    </div>--}}
{{--                    <div class="card-footer">--}}
{{--                        <h3 class="card-title text-inherit">Отчеты</h3>--}}
{{--                        <p class="card-text text-inherit fs-6">Мои ежемесячные отчеты</p>--}}
{{--                    </div>--}}
{{--                </a>--}}
{{--            </div>--}}
        </div>
    </div>

@endsection
