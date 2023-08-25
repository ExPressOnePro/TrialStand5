@extends('Desktop.layouts.front.app')
@section('title')
    Meeper | Собрание
@endsection
@section('content')

    <script src="{{asset('front/vendor/appear/dist/appear.min.js')}}"></script>
    <script src="{{asset('front//vendor/circles.js/circles.js')}}"></script>
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header">
            <div class="d-flex mb-3">
                <!-- Avatar -->
                <div class="flex-shrink-0">
                    <div class="avatar avatar-lg avatar-4x3">
                        <img class="avatar-img" src="{{asset('front/svg/brands/guideline-icon.svg')}}"
                             alt="Image Description">
                    </div>
                </div>
                <!-- End Avatar -->

                <div class="flex-grow-1 ms-4">
                    <div class="row">
                        <div class="col-lg mb-3 mb-lg-0">
                            <h1 class="page-header-title">{{ $congregation->name }}</h1>
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <span>Client:</span>
                                    <a href="#"></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="js-nav-scroller hs-nav-scroller-horizontal">
          <span class="hs-nav-scroller-arrow-prev" style="display: none;">
            <a class="hs-nav-scroller-arrow-link" href="javascript:;">
              <i class="bi-chevron-left"></i>
            </a>
          </span>

                <span class="hs-nav-scroller-arrow-next" style="display: none;">
            <a class="hs-nav-scroller-arrow-link" href="javascript:;">
              <i class="bi-chevron-right"></i>
            </a>
          </span>

                <ul class="nav nav-tabs page-header-tabs" id="projectsTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active"
                           id="nav-one-eg1-tab" href="#nav-one-eg1" data-bs-toggle="pill"
                           data-bs-target="#nav-one-eg1" role="tab" aria-controls="nav-one-eg1"
                           aria-selected="true">Обзор</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link"
                           id="nav-4-eg1-tab" href="#nav-4-eg1" data-bs-toggle="pill"
                           data-bs-target="#nav-4-eg1" role="tab" aria-controls="nav-4-eg1"
                           aria-selected="false" tabindex="-1">Запросы
                            <span
                                class="badge bg-soft-danger text-danger rounded-circle ms-1">{{$congregationRequestsCount}}</span></a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link"
                           id="nav-two-eg1-tab" href="#nav-two-eg1" data-bs-toggle="pill"
                           data-bs-target="#nav-two-eg1" role="tab" aria-controls="nav-two-eg1"
                           aria-selected="false" tabindex="-1">Возвещатели</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link"
                           id="nav-three-eg1-tab" href="#nav-three-eg1" data-bs-toggle="pill"
                           data-bs-target="#nav-three-eg1" role="tab" aria-controls="nav-three-eg1"
                           aria-selected="false" tabindex="-1">Отчеты</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link"
                           id="nav-5-eg1-tab" href="#nav-5-eg1" data-bs-toggle="pill"
                           data-bs-target="#nav-5-eg1" role="tab" aria-controls="nav-5-eg1"
                           aria-selected="false" tabindex="-1">Модули</a>
                    </li>
                </ul>
            </div>
            <!-- End Nav -->
        </div>
        <!-- End Page Header -->

        <div class="tab-content">
            <div class="tab-pane fade show active" id="nav-one-eg1" role="tabpanel" aria-labelledby="nav-one-eg1-tab">
                @include('Mobile.menu.modules.congregation.components.overview')
            </div>
            <div class="tab-pane fade" id="nav-two-eg1" role="tabpanel" aria-labelledby="nav-two-eg1-tab">
                @include('Mobile.menu.modules.congregation.components.publishers')
            </div>
            <div class="tab-pane fade" id="nav-three-eg1" role="tabpanel" aria-labelledby="nav-three-eg1-tab">
                @include('Mobile.menu.modules.congregation.components.reports')
            </div>
            <div class="tab-pane fade" id="nav-4-eg1" role="tabpanel" aria-labelledby="nav-4-eg1-tab">
                @include('Mobile.menu.modules.congregation.components.requests')
            </div>
            <div class="tab-pane fade" id="nav-5-eg1" role="tabpanel" aria-labelledby="nav-5-eg1-tab">
                @include('Mobile.menu.modules.congregation.components.modules')
            </div>
        </div>

        <div class="footer">
            <div class="row justify-content-between align-items-center">
                <div class="col">
                    <p class="fs-6 mb-0">&copy; Meeper. <span class="d-none d-sm-inline-block">2023</span></p>
                </div>
                <div class="col-auto">
                    <div class="d-flex justify-content-end">
                        <!-- List Separator -->
                        <ul class="list-inline list-separator">
                            <li class="list-inline-item">
                                <a class="list-separator-link" href="#">FAQ</a>
                            </li>

                            <li class="list-inline-item">
                                <a class="list-separator-link" href="#">License</a>
                            </li>

                            <li class="list-inline-item">
                                <!-- Keyboard Shortcuts Toggle -->
                                <button class="btn btn-ghost-secondary btn btn-icon btn-ghost-secondary rounded-circle"
                                        type="button" data-bs-toggle="offcanvas"
                                        data-bs-target="#offcanvasKeyboardShortcuts"
                                        aria-controls="offcanvasKeyboardShortcuts">
                                    <i class="bi-command"></i>
                                </button>
                                <!-- End Keyboard Shortcuts Toggle -->
                            </li>
                        </ul>
                        <!-- End List Separator -->
                    </div>
                </div>
            </div>
        </div>


        <!--    <div class="main-content pt-4">
        <div class="row">
            &lt;!&ndash; Группы собрания&ndash;&gt;
            <div class="col-md-4">
                <div class="card mb-4">
                    <div class="card-title border-bottom d-flex align-items-center m-0 p-3">
                        <span class="flex-grow-1">Группы собрания</span>
                        <span class="flex-grow-1"></span>
                    </div>
                    <div class="card-body">
                        @foreach($groups as $group)
            <div class="d-flex align-items-center mt-2">
                <div class="flex-grow-1">
                    <h4 class="m-0">{{$group->name}}</h4>
                                        <p class="m-0 text-small text-muted">Ответственный: {{$group->responsibleUserId->first_name }} {{$group->responsibleUserId->last_name }}</p>
                                </div>

                                <div>
                                    <a href="{{ route('groupView', ['congregation_id' => $congregation->id, 'group_id' => $group->id]) }}">
                                        <button class="btn btn-outline-primary">Просмотреть детальнее</button>
                                    </a>
                                </div>
                            </div>

        @endforeach
        </div>
    </div>
</div>
</div>-->


        <script>
            (function () {
                // INITIALIZATION OF CIRCLES
                // =======================================================
                setTimeout(() => {
                    document.querySelectorAll('.js-circle').forEach(item => {
                        HSCore.components.HSCircles.init(item)
                    })
                })
            })();
        </script>

@endsection
