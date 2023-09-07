@extends('Mobile.layouts.front.app')
@section('title')
    Meeper | Мой аккаунт
@endsection
@section('content')
{{--    @include('Mobile.includes.headers.header-stand')--}}
    @include('Mobile.includes.alerts.alerts')

    <div class="content container-fluid mt-8">

        <div class="row">
            @include('Mobile.menu.modules.stand.components.permissionsPublishersPart2')
        </div>
    </div>

@endsection
