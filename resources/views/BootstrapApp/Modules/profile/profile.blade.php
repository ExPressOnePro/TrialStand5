@extends('Mobile.layouts.front.profile')
@section('title') Meeper | Мой аккаунт @endsection
@section('content')

    @include('Mobile.includes.headers.header-profile')
    @include('Mobile.includes.alerts.alerts')
    @php
        $info = json_decode($user->info, true); // Разбираем строку JSON в ассоциативный массив
    @endphp
    <div class="content container-fluid">
        <div class="row justify-content-lg-center mt-7">
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
                <!-- End Profile Cover -->

                <!-- Profile Header -->
                <div class="text-center mb-5">

                    <label class="avatar avatar-xxl avatar-circle avatar-uploader profile-cover-avatar" for="editAvatarUploaderModal">

                    </label>


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
                                    <span class="badge bg-soft-primary-light text-primary">Разработчик</span>
                                @elseif($userRole->role->name === 'Overseer')
                                    <span class="badge bg-info">Старейшина</span>
                                @elseif($userRole->role->name === 'Publisher')
                                    <span class="badge bg-secondary">Возвещатель</span>
                                @elseif($userRole->role->name === 'Ministerial servants')
                                    <span class="badge bg-soft-warning text-warning">Служебный помошник</span>
                                @elseif($userRole->role->name === 'Regular pioneer')
                                    <span class="badge bg-warning">Общий пионер</span>
                                @endif
                            @endforeach
                        </li>

                        <li class="list-inline-item">
                            <i class="bi-geo-alt me-1"></i>
                            @if (isset($info['city']))
                                <a>{{ $info['city'] }}</a>
                            @endif
                        </li>
                    </ul>
                    <!-- End List -->
                </div>
                <!-- End Profile Header -->


                <div class="row">
                    <div class="col-lg-4">
                        <!-- Card -->
                        <div class="card mb-3 mb-lg-5">
                            <!-- Header -->
                            <div class="card-header card-header-content-between">
                                <h4 class="card-header-title">Профиль</h4>
                                @role('Developer')
                                <a class="btn btn-outline-primary btn-sm mb-2" href="{{route('generateToken', Auth::id())}}">API Token</a>
                                @endrole
                            </div>
                            <!-- End Header -->

                            <!-- Body -->

                            <div class="card-body">
                                <ul class="list-unstyled list-py-2 text-dark mb-0">
                                    <li class="pb-0"><span class="card-subtitle">Информация</span></li>
                                    @role('Developer')
                                    @if ($user->apiTokens->isEmpty())
                                    @else
                                    <li>
                                        <!-- Input Group -->
                                        <div class="input-group input-group-merge">
                                            <input type="text" id="iconExample" class="form-control" value="{{$user->apiTokens->last()->token}}">
                                            <a class="js-clipboard input-group-append input-group-text" href="javascript:;"
                                               data-hs-clipboard-options='{
       "contentTarget": "#iconExample",
       "classChangeTarget": "#iconExampleLinkIcon",
       "defaultClass": "bi-clipboard",
       "successClass": "bi-check"
     }'>
                                                <i id="iconExampleLinkIcon" class="bi-clipboard"></i>
                                            </a>
                                        </div>
                                        <!-- End Input Group -->
                                    </li>
                                    @endif
                                    @endrole
                                    <li><i class="fa-solid fa-user dropdown-item-icon"></i> {{ $user->first_name }} {{ $user->last_name }}</li>
                                    <li><i class="fa-solid fa-handshake dropdown-item-icon"></i> {{ $user->congregation->name }}</li>
                                    <li>
                                        <i class="fa-solid fa-user-group dropdown-item-icon"></i>
                                        @if(empty($user->usersGroups))
                                            <span>Не в группе</span>
                                        @else
                                            @foreach($user->usersGroups as $usersGroups)
                                                <span>{{$usersGroups->group->name}}</span>
                                            @endforeach
                                        @endif
                                    </li>

                                    <li class="pt-4 pb-0"><span class="card-subtitle">Контакты</span></li>
                                    <li><i class="bi-at dropdown-item-icon"></i> {{ $user->email }}</li>
                                    @if (empty($info))
                                    @else
                                        <li><i class="bi-phone dropdown-item-icon"></i>
                                            @if (isset($info['mobile_phone']))
                                                {{ $info['mobile_phone'] }}
                                            @endif
                                        </li>
                                    @endif


                                </ul>
                            </div>
                            <!-- End Body -->
                        </div>
                        <!-- End Card -->
                    </div>
                    <!-- End Col -->


                </div>

            </div>
        </div>
    </div>


    <script>
        function copyToClipboard() {
            // Создаем временный элемент для копирования
            var tempInput = document.createElement("input");
            tempInput.value = document.getElementById("api-token").textContent;
            document.body.appendChild(tempInput);

            // Выделяем текст в элементе
            tempInput.select();

            // Копируем выделенный текст в буфер обмена
            document.execCommand("copy");

            // Удаляем временный элемент
            document.body.removeChild(tempInput);
        }
    </script>



@endsection
