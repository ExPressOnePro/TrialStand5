@extends('BootstrapApp.layouts.bootstrapApp')
@section('title')
    Meeper
@endsection
@section('content')
    <div class="container">
        <div class="row align-items-md-stretch">
            @include('BootstrapApp.Modules.home.includes.FAQ')
            @include('BootstrapApp.Modules.home.includes.myRecordsOnStand')
        </div>
        @include('BootstrapApp.Modules.home.includes.modal_all_records_with_stand')
    </div>
@endsection
