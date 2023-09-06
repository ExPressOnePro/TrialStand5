@extends('Mobile.layouts.front.app')
@section('title')
    Meeper | Мой аккаунт
@endsection
@section('content')
{{--    @include('Mobile.includes.headers.header-stand')--}}
    @include('Mobile.includes.alerts.alerts')

    <div class="content container-fluid mt-8">

        <div class="row">

            <div class="col-lg-9">
                <div class="d-grid gap-3 gap-lg-5">

                    <div id="content" class="card">
                        @include('Mobile.menu.modules.stand.components.permissionsPublishersPart2')
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
