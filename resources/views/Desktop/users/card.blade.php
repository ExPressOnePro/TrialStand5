@extends('Desktop.layouts.front.app')
@section('title') Meeper | Карточка @endsection
@section('content')

    <script src="{{ asset('front/js/hs.theme-appearance.js') }}"></script>
    <script src="{{ asset('front/vendor/hs-navbar-vertical-aside/dist/hs-navbar-vertical-aside-mini-cache.js') }}"></script>

    <!-- Content -->
    <div class="content container-fluid">
        <div class="row justify-content-lg-center">
            <div class="col-lg-10">
                <!-- Profile Cover -->
                <div class="profile-cover">
                    <div class="profile-cover-img-wrapper">
                        @foreach($user->usersroles as $userRole)
                            @if($userRole->role->name === 'Developer')
                                <img class="profile-cover-img" src="{{ asset('front/img/1920x400/img3.jpg')}}" alt="Image Description">
                            @else
                                <img class="profile-cover-img" src="{{ asset('front/img/1920x400/img1.jpg')}}" alt="Image Description">
                            @endif
                        @endforeach
                    </div>
                </div>

                <!-- Profile Header -->
                <div class="text-center mb-5">
                    <!-- Avatar -->
                    <div class="avatar avatar-xxl avatar-circle profile-cover-avatar">
                        <img class="avatar-img" src="{{ asset('front/img/160x160/img1.jpg')}}" alt="Image Description">
{{--                        <span class="avatar-status avatar-status-success"></span>--}}
                    </div>
                    <!-- End Avatar -->

                    <h1 class="page-header-title">{{ $user->first_name }} {{ $user->last_name }}
                        @foreach($user->usersroles as $userRole)
                            @if($userRole->role->name === 'Developer')
                                <i class="bi-patch-check-fill fs-2 text-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Top endorsed"></i>
                            @else
                            @endif
                        @endforeach
                    </h1>

                    <!-- List -->
                    <ul class="list-inline list-px-2">
                        <li class="list-inline-item">
                            <i class="bi-building me-1"></i>
                            @foreach($user->usersroles as $userRole)
                                @if($userRole->role->name === 'Developer')
                                    <span class="badge bg-soft-danger text-danger">Разработчик</span>
                                @elseif($userRole->role->name === 'Overseer')
                                    <span class="badge bg-info">Старейшина</span>
                                @elseif($userRole->role->name === 'Publisher')
                                    <span class="badge bg-info">Возвещатель</span>
                                @endif
                            @endforeach
                        </li>

                        <li class="list-inline-item">
                            <i class="bi-geo-alt me-1"></i>
                            <a>{{ $user->city }}</a>

                        </li>

                        <li class="list-inline-item">
                            <i class="bi-calendar-week me-1"></i>
                            <span>Joined March 2017</span>
                        </li>
                    </ul>
                    <!-- End List -->
                </div>

                <!-- Nav -->
                <div class="js-nav-scroller hs-nav-scroller-horizontal mb-5">
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
                    <ul class="nav nav-tabs align-items-center">
                        <li class="nav-item">
                            <a class="nav-link active"
                               id="nav-one-eg1-tab" href="#nav-one-eg1" data-bs-toggle="pill"
                               data-bs-target="#nav-one-eg1" role="tab" aria-controls="nav-one-eg1"
                               aria-selected="true">Профиль</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link"
                               id="nav-two-eg1-tab" href="#nav-two-eg1" data-bs-toggle="pill"
                               data-bs-target="#nav-two-eg1" role="tab" aria-controls="nav-two-eg1"
                               aria-selected="false" tabindex="-1">Права</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link"
                               id="nav-three-eg1-tab" href="#nav-three-eg1" data-bs-toggle="pill"
                               data-bs-target="#nav-three-eg1" role="tab" aria-controls="nav-three-eg1"
                               aria-selected="false" tabindex="-1">Tab two</a>
                        </li>

                        <li class="nav-item ms-auto">
                            <div class="d-flex gap-2">
                                <!-- Form Check -->
                                <div class="form-check form-check-switch">
                                    <input class="form-check-input" type="checkbox" value="" id="connectCheckbox">
                                    <label class="form-check-label btn btn-sm" for="connectCheckbox">
                      <span class="form-check-default">
                        <i class="bi-person-plus-fill"></i> Connect
                      </span>
                                        <span class="form-check-active">
                        <i class="bi-check-lg me-2"></i> Connected
                      </span>
                                    </label>
                                </div>
                                <!-- End Form Check -->

                                <a class="btn btn-icon btn-sm btn-white" href="#">
                                    <i class="bi-list-ul me-1"></i>
                                </a>

                                <!-- Dropdown -->
                                <div class="dropdown nav-scroller-dropdown">
                                    <button type="button" class="btn btn-white btn-icon btn-sm" id="profileDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="bi-three-dots-vertical"></i>
                                    </button>

                                    <div class="dropdown-menu dropdown-menu-end mt-1" aria-labelledby="profileDropdown">
                                        <span class="dropdown-header">Settings</span>

                                        <a class="dropdown-item" href="#">
                                            <i class="bi-share-fill dropdown-item-icon"></i> Share profile
                                        </a>
                                        <a class="dropdown-item" href="#">
                                            <i class="bi-slash-circle dropdown-item-icon"></i> Block page and profile
                                        </a>
                                        <a class="dropdown-item" href="#">
                                            <i class="bi-info-circle dropdown-item-icon"></i> Suggest edits
                                        </a>

                                        <div class="dropdown-divider"></div>

                                        <span class="dropdown-header">Feedback</span>

                                        <a class="dropdown-item" href="#">
                                            <i class="bi-flag dropdown-item-icon"></i> Report
                                        </a>
                                    </div>
                                </div>
                                <!-- End Dropdown -->
                            </div>
                        </li>
                    </ul>
                </div>


                <!-- Tab Content -->
                <div class="tab-content">

                    <div class="tab-pane fade show active" id="nav-one-eg1" role="tabpanel" aria-labelledby="nav-one-eg1-tab">
                        <div class="row">
                            @include('Desktop.users.components.information')
                            @role('Developer')
                            @include('Desktop.users.components.activity')
                            @endrole
                        </div>
                    </div>

                    <div class="tab-pane fade" id="nav-two-eg1" role="tabpanel" aria-labelledby="nav-two-eg1-tab">
                        @include('Desktop.users.components.user-permissions')
                    </div>

                    <div class="tab-pane fade" id="nav-three-eg1" role="tabpanel" aria-labelledby="nav-three-eg1-tab">
                        <p>Third tab content...</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->

    <div class="footer">
        <div class="row justify-content-between align-items-center">
            <div class="col">
                <p class="fs-6 mb-0">&copy; Front. <span class="d-none d-sm-inline-block">2022 Htmlstream.</span></p>
            </div>
            <!-- End Col -->

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
                            <button class="btn btn-ghost-secondary btn btn-icon btn-ghost-secondary rounded-circle" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasKeyboardShortcuts" aria-controls="offcanvasKeyboardShortcuts">
                                <i class="bi-command"></i>
                            </button>
                            <!-- End Keyboard Shortcuts Toggle -->
                        </li>
                    </ul>
                    <!-- End List Separator -->
                </div>
            </div>
            <!-- End Col -->
        </div>
        <!-- End Row -->
    </div>



    <!-- Modal change group-->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Изменить группу</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Select -->
                    <form id="change-group" method="post" action="{{ route('user.changeGroup', ['id' => $user->id]) }}">
                        @csrf
                    <div class="tom-select-custom">
                        <select class="js-select form-select" name="group_id" autocomplete="off"
                                data-hs-tom-select-options='{
          "placeholder": "Select a person...",
          "hideSearch": true
        }'>
                            @empty($activeGroup)
                                @foreach($groups as $group)
                                <option value="{{ $group->id }}">
                                    <span>{{ $group->name }}</span>
                                </option>
                                @endforeach
                            @else
                                @foreach($groups as $group)
                                    <option value="{{ $group->id }}" {{ $group->id == $activeGroup ? 'selected' : '' }}>
                                        <span>{{ $group->name }}</span>
                                    </option>
                                @endforeach
                            @endempty
                        </select>
                    </div>
                    </form>
                    <!-- End Select -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-white" data-bs-dismiss="modal">Закрыть</button>
                    <a class="btn btn-primary" type="button" href="{{ route('user.changeGroup', ['id' => $user->id]) }}"
                       onclick="event.preventDefault();
                           document.getElementById('change-group').submit();">
                        Сохранить
                    </a>
                </div>
            </div>
        </div>
    </div>


@endsection
