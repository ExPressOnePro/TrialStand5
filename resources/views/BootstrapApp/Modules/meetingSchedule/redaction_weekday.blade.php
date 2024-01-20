@extends('BootstrapApp.layouts.bootstrapApp')
@section('title') Meeper @endsection
@section('content')
    <div class="content container-fluid">
        <div class="container">
            <div class="row">
                <div class="col-12 mb-3">
                    @include('BootstrapApp.Modules.meetingSchedule.redaction_partials.responsibles')
                </div>
                <div class="col-12 mb-3">
                    @include('BootstrapApp.Modules.meetingSchedule.redaction_partials.songs')
                </div>
                <div class="col-12 mb-3">
                    @include('BootstrapApp.Modules.meetingSchedule.redaction_partials.treasures')
                </div>
                <div class="col-12 mb-3">
                    @include('BootstrapApp.Modules.meetingSchedule.redaction_partials.field_ministry')
                </div>
                <div class="col-12 mb-3">
                    @include('BootstrapApp.Modules.meetingSchedule.redaction_partials.living')
                </div>
            </div>
        </div>
    </div>
@endsection
