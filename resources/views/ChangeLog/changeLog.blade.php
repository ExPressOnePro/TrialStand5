@extends('Mobile.layouts.front.app')
@section('title') ChangeLog @endsection
@section('content')

    <div class="navbar-sidebar-aside-content content-space-1 content-space-md-2 px-lg-5 px-xl-10">
        <!-- Page Header -->
        <div class="docs-page-header">
            <div class="row col-6 mx-auto d-flex justify-content-center align-items-center">
                <div class="col-sm">
                    <h1 class="docs-page-header-title">Журнал изменений</h1>
                    <p class="docs-page-header-text">Посмотрите, что нового добавлено, изменено, исправлено, улучшено или обновлено в последних версиях Meeper.</p>
                </div>
            </div>
        </div>
        <div class="row col-6 mx-auto d-flex justify-content-center">
            @include('ChangeLog.versions.version205')
            @include('ChangeLog.versions.version204')
            @include('ChangeLog.versions.version203')
            @include('ChangeLog.versions.version202')
            @include('ChangeLog.versions.version201')
            @include('ChangeLog.versions.version200')
        </div>
    </div>

@endsection
