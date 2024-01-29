@extends('BootstrapApp.layouts.bootstrapApp')
@section('title') Meeper @endsection
@section('content')
    <div class="content container-fluid">
        <div class="container">
            <ul class="nav nav-pills row mb-3 row-cols-3" id="pills-tab" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link col border" href="{{route('meetingSchedules.schedule', $ms->id)}}">
                        <i class="bi bi-arrow-return-left"></i>
                        Вернуться
                    </a>
                </li>
                <li class="nav-item" role="presentation" >
                    <button class="nav-link col border active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">
                        <img class="bd-placeholder-img" height="30" src="{{ asset('images/workbook.svg') }}">
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link col border" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">
                        <img class="bd-placeholder-img" height="30" src="{{ asset('images/watchtower.svg') }}"><br>
                    </button>
                </li>
            </ul>
            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab" tabindex="0">
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
                <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab" tabindex="0">
                    <div class="row">
                        <div class="col-12 mb-3">
                            @include('BootstrapApp.Modules.meetingSchedule.redaction_partials.responsibles_weekend')
                        </div>
                        <div class="col-12 mb-3">
                            @include('BootstrapApp.Modules.meetingSchedule.redaction_partials.songs_weekend')
                        </div>
                        <div class="col-12 mb-3">
                            @include('BootstrapApp.Modules.meetingSchedule.redaction_partials.public_speech')
                        </div>
                        <div class="col-12 mb-3">
                            @include('BootstrapApp.Modules.meetingSchedule.redaction_partials.watchtower')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            // Check if a tab is stored in localStorage
            var selectedTab = localStorage.getItem('selectedTab');

            // If a tab is stored, switch to that tab
            if (selectedTab) {
                $(`#${selectedTab}`).tab('show');
            }

            // Store the selected tab in localStorage when a tab is clicked
            $('.nav-link').on('click', function () {
                var tabId = $(this).attr('id');
                localStorage.setItem('selectedTab', tabId);
            });
        });
    </script>
@endsection
