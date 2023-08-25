@extends('Mobile.layouts.front.users')
@section('title')
    Meeper | Карточка
@endsection
@section('content')

    <div class="content container-fluid">
        <div class="row justify-content-lg-center">
            <div class="col-lg-10">
                <!-- Profile Cover -->
                <div class="profile-cover">
                    <div class="profile-cover-img-wrapper">
                        @foreach($user->usersroles as $userRole)
                            @if($userRole->role->name === 'Developer')
                                <img class="profile-cover-img" src="{{ asset('front/img/1920x400/img3.jpg')}}"
                                     alt="Image Description">
                            @else
                                <img class="profile-cover-img" src="{{ asset('front/img/1920x400/img1.jpg')}}"
                                     alt="Image Description">
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
                                <i class="bi-patch-check-fill fs-2 text-primary" data-bs-toggle="tooltip"
                                   data-bs-placement="top" title="Top endorsed"></i>
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
                                    <button type="button" class="btn btn-white btn-icon btn-sm" id="profileDropdown"
                                            data-bs-toggle="dropdown" aria-expanded="false">
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

                            </div>
                        </li>
                    </ul>
                </div>


                <!-- Tab Content -->
                <div class="tab-content">

                    <div class="tab-pane fade show active" id="nav-one-eg1" role="tabpanel"
                         aria-labelledby="nav-one-eg1-tab">
                        <div class="row">
                            @include('Mobile.menu.modules.users.components.information')
                            @role('Developer')
                            @include('Mobile.menu.modules.users.components.activity')
                            @endrole
                        </div>
                    </div>

                    <div class="tab-pane fade" id="nav-two-eg1" role="tabpanel" aria-labelledby="nav-two-eg1-tab">
                        @include('Mobile.menu.modules.users.components.user-permissions')
                    </div>

                    <div class="tab-pane fade" id="nav-three-eg1" role="tabpanel" aria-labelledby="nav-three-eg1-tab">
                        <p>Third tab content...</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal change group-->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
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
                                        <option
                                            value="{{ $group->id }}" {{ $group->id == $activeGroup ? 'selected' : '' }}>
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
    {{--    <div class="main-content pt-4">--}}
    {{--        <div class="row">--}}

    {{--            <!-- Основная информация пользователя-->--}}
    {{--            <div class="col-md-4">--}}
    {{--                <div class="card card-profile-1 mb-4">--}}
    {{--                    <div class="card-body text-center">--}}
    {{--                        <div class="avatar box-shadow-2 mb-3"><img src="../../dist-assets/images/faces/16.jpg" alt=""></div>--}}
    {{--                        <h5 class="m-0">{{ $user->name }}</h5>--}}
    {{--                        <p class="mt-0">{{ $user->Congregation->name }}</p>--}}
    {{--                        <div class="row g-0 mb-2">--}}
    {{--                            <div class="col text-left text-18">Логин:</div>--}}
    {{--                            <div class="col text-left heading text-16">{{ $user->login }}</div>--}}
    {{--                        </div>--}}
    {{--                        <div class="row g-0 mb-2">--}}
    {{--                            <div class="col text-left text-18">Почта:</div>--}}
    {{--                            <div class="col text-left heading text-16">{{ $user->email }}</div>--}}
    {{--                        </div>--}}

    {{--                        --}}{{--<div class="card-socials-simple mt-4">--}}
    {{--                            <a href=""><i class="i-Linkedin-2"></i></a>--}}
    {{--                            <a href=""><i class="i-Facebook-2"></i></a>--}}
    {{--                            <a href=""><i class="i-Twitter"></i></a>--}}
    {{--                        </div>--}}
    {{--                    </div>--}}
    {{--                </div>--}}
    {{--                --}}{{--<div class="card mb-4">--}}
    {{--                    <div class="card-header">Будущие разработки</div>--}}
    {{--                    <div class="card-body">--}}
    {{--                        <h5 class="card-title">Card title text</h5>--}}
    {{--                        <p class="card-text">With supporting text below as a natural lead-in to additional content.</p><a class="btn btn-primary btn-rounded" href="#">Go somewhere</a>--}}
    {{--                    </div>--}}
    {{--                </div>--}}
    {{--            </div>--}}

    {{--           <!-- права пользователя-->--}}
    {{--            @include('Mobile.users.components.user-permissions')--}}

    {{--            <div class="col-md-4">--}}
    {{--                <div class="card card-icon mb-4">--}}
    {{--                    <div class="card-body text-center">--}}
    {{--                        <div class="text-center ">--}}
    {{--                            <h5 class="card-title heading mb-4">Права пользователя</h5>--}}
    {{--                            <div class="separator border-top mb-2"></div>--}}
    {{--                        </div>--}}
    {{--                        @foreach($permissions as $permission)--}}
    {{--                            <div class="row">--}}
    {{--                                <div class="col mb-3">--}}
    {{--                                    <h4 class="heading text-left">{{$permission->name}}</h4>--}}
    {{--                                </div>--}}
    {{--                                @if(DB::table('users_permissions')--}}
    {{--                                ->where('user_id', '=', $user->id)--}}
    {{--                                ->where('permission_id', '=', $permission->id)--}}
    {{--                                ->count() > 0)--}}
    {{--                                    <div class="col mb-3">--}}
    {{--                                        <span class="text-success heading text-left">--}}
    {{--                                            <i class="fa-solid fa-circle-check"></i> Доступная роль</span>--}}
    {{--                                        <form method="post" action="{{ route('permissionDelete', $user->id) }}">--}}
    {{--                                            @csrf--}}
    {{--                                            <input type="hidden" name="delete_permission_id" value="{{ $permission->id }}">--}}
    {{--                                            <button class="btn btn-danger btn-sm">Запретить</button>--}}
    {{--                                        </form>--}}
    {{--                                    </div>--}}
    {{--                                @else--}}
    {{--                                    <form method="post" action="{{ route('permissionAllow', $user->id) }}">--}}
    {{--                                        @csrf--}}
    {{--                                        <div class="col-md-6 mb-3">--}}
    {{--                                            <input type="hidden" name="allow_permission_id" value="{{ $permission->id }}">--}}
    {{--                                            <button class="btn btn-primary">Разрешить</button>--}}
    {{--                                        </div>--}}
    {{--                                    </form>--}}
    {{--                                @endif--}}
    {{--                            </div>--}}
    {{--                        @endforeach--}}
    {{--                    </div>--}}
    {{--                </div>--}}
    {{--            </div>--}}


    {{--            <!-- Роль пользователя-->--}}
    {{--            @role('Developer')--}}
    {{--            <div class="col-md-4">--}}
    {{--                <div class="card card-icon mb-4">--}}
    {{--                    <div class="card-body text-center">--}}
    {{--                        <div class="text-center ">--}}
    {{--                            <h5 class="card-title heading mb-4">Роль пользователя</h5>--}}
    {{--                            <div class="separator border-top mb-2"></div>--}}
    {{--                        </div>--}}
    {{--                        @foreach($roles as $role)--}}
    {{--                            <div class="row">--}}
    {{--                                <div class="col mb-3">--}}
    {{--                                    <h4 class="heading text-left">{{$role->name}}</h4>--}}
    {{--                                </div>--}}
    {{--                                @if(DB::table('users_roles')--}}
    {{--                                ->where('user_id', '=', $user->id)--}}
    {{--                                ->where('role_id', '=', $role->id)--}}
    {{--                                ->count() > 0)--}}
    {{--                                    <div class="col mb-3">--}}
    {{--                                        <span class="text-success heading text-left">--}}
    {{--                                            <i class="fa-solid fa-circle-check"></i> Доступная роль</span>--}}
    {{--                                        <form method="post" action="{{ route('roleDelete', $user->id) }}">--}}
    {{--                                            @csrf--}}
    {{--                                            <input type="hidden" name="delete_role_id" value="{{ $role->id }}">--}}
    {{--                                            <button class="btn btn-danger btn-sm">Запретить</button>--}}
    {{--                                        </form>--}}
    {{--                                    </div>--}}
    {{--                                @else--}}
    {{--                                    <form method="post" action="{{ route('roleAllow', $user->id) }}">--}}
    {{--                                        @csrf--}}
    {{--                                        <div class="col-md-6 mb-3">--}}
    {{--                                            <input type="hidden" name="allow_role_id" value="{{ $role->id }}">--}}
    {{--                                            <button class="btn btn-primary btn-sm">Разрешить</button>--}}
    {{--                                        </div>--}}
    {{--                                    </form>--}}
    {{--                                @endif--}}
    {{--                            </div>--}}
    {{--                        @endforeach--}}
    {{--                    </div>--}}
    {{--                </div>--}}
    {{--            </div>--}}
    {{--            @endrole--}}

    {{--        </div>--}}
    {{--    </div>--}}
@endsection
