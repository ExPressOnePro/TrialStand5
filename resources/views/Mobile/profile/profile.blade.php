@extends('Mobile.layouts.front.profile')
@section('title') Meeper | Мой аккаунт @endsection
@section('content')

    @include('Mobile.includes.headers.header-profile')
    @include('Mobile.includes.alerts.alerts')

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
                        <!-- Custom File Cover -->
                        <div class="profile-cover-content profile-cover-uploader p-3">
                            <label class="profile-cover-uploader-label btn btn-sm btn-white" for="profileCoverUploader">
                                <i class="bi-camera-fill"></i>
                                <span class="d-none d-sm-inline-block ms-1">Upload header</span>
                            </label>
                        </div>
                        <!-- End Custom File Cover -->
                    </div>
                </div>
                <!-- End Profile Cover -->

                <!-- Profile Header -->
                <div class="text-center mb-5">

                    <label class="avatar avatar-xxl avatar-circle avatar-uploader profile-cover-avatar" for="editAvatarUploaderModal">
                        <img id="editAvatarImgModal" class="avatar-img" src="./assets/img/160x160/img6.jpg" alt="Image Description">

                        <span class="avatar-uploader-trigger">
                    <i class="bi-pencil-fill avatar-uploader-icon shadow-sm"></i>
                  </span>
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
                <!-- End Profile Header -->


                <div class="row">
                    <div class="col-lg-4">
                        <!-- Card -->
                        <div class="card mb-3 mb-lg-5">
                            <!-- Header -->
                            <div class="card-header card-header-content-between">
                                <h4 class="card-header-title">Профиль</h4>
                            </div>
                            <!-- End Header -->

                            <!-- Body -->
                            @php
                                $info = json_decode($user->info, true); // Разбираем строку JSON в ассоциативный массив
                            @endphp
                            <div class="card-body">
                                <ul class="list-unstyled list-py-2 text-dark mb-0">
                                    <li class="pb-0"><span class="card-subtitle">Информация</span></li>
                                    <li><i class="fa-solid fa-code"></i>
                                        <span id="api-token">
                                        {{$user->apiTokens->last()->token}}
                                        </span>
                                        <button class="btn btn-warning btn-sm copy-btn" onclick="copyToClipboard()"><i class="fa-solid fa-copy"></i></button>
                                    </li>
                                    <li><i class="bi-person dropdown-item-icon"></i> {{ $user->first_name }} {{ $user->last_name }}</li>
                                    <li><i class="bi-briefcase dropdown-item-icon"></i> {{ $user->congregation->name }}</li>
                                    <li>
                                        <i class="bi-briefcase dropdown-item-icon"></i>
                                        @if(!$user->usersGroups)
                                            <span>Не в группе</span>
                                        @else
                                            @foreach($user->usersGroups as $usersGroups)
                                                <span>{{$usersGroups->group->name}}</span>
                                            @endforeach
                                        @endif
                                    </li>

                                    <li class="pt-4 pb-0"><span class="card-subtitle">Контакты</span></li>
                                    <li><i class="bi-at dropdown-item-icon"></i> {{ $user->email }}</li>
                                    <li><i class="bi-phone dropdown-item-icon"></i> {{ $info['mobile_phone'] }}</li>


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
    <div class="modal fade mt-5" id="redaction_account" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true" style="display: none;">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">Редактирование</h5>
                                <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                            </div>
                            <div class="modal-body text-left">
                                <form method="post" id="profileBriefSave" action="{{ route('profileBriefSave',$user->id) }}">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-12 form-group mb-3">
                                            <label class="heading" for="brief_information">Краткая информация</label><br>
                                            <input class="form-control" type="text" name="brief_information" id="brief_information" value="{{ $user->brief_information }}">
                                        </div>
                                    </div>
                                </form>
                                <h4 class="text-left text-16">Информация</h4>
                                <div class="card mb-4">
                                    <a class="list-group-item list-group-item-action " href="{{ route('profileEdit', [ 'id' => $user->id]) }}">Личные данные</a>
                                    <a class="list-group-item list-group-item-action" href="{{ route('profileSecurity', [ 'id' => $user->id]) }}">Безопасность</a>
                                    <a class="list-group-item list-group-item-action" href="#">Профиль</a>
                                    <a class="list-group-item list-group-item-action" href="{{ route('profileContacts', [ 'id' => $user->id]) }}">Контакты</a>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-secondary text-left" type="button" data-dismiss="modal">Закрыть</button>
                                <a type="button" href="{{ route('profileEditSave', $user->id) }}"
                                   onclick="event.preventDefault();
                                   document.getElementById('profileBriefSave').submit();">
                                    Сохранить настройки
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
{{--    <div class="modal fade" id="personalReportModal" tabindex="-1" role="dialog" aria-labelledby="personalReportModal-2" style="display: none;" aria-hidden="true">--}}
{{--                <div class="modal-dialog" role="document">--}}
{{--                    <div class="modal-content">--}}
{{--                        <div class="modal-header">--}}
{{--                            <h5 class="modal-title" id="personalReportModal-2">Ежемесячный отчет</h5>--}}
{{--                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">--}}
{{--                                <span aria-hidden="true">×</span>--}}
{{--                            </button>--}}
{{--                        </div>--}}

{{--                        <div class="modal-body">--}}
{{--                            <form id="personalReport" method="POST" action="{{ route('personalReport') }}">--}}
{{--                                @csrf--}}
{{--                                <div class="d-flex flex-column">--}}
{{--                                    <!-- Month -->--}}
{{--                                    <div class="form-group mb-3">--}}
{{--                                        <h4 class="heading" >Месяц</h4>--}}
{{--                                        <select class="form-control form-control-rounded" name="month">--}}
{{--                                            <option value="1">{{ __('text.January') }}</option>--}}
{{--                                            <option value="2">{{ __('text.February') }}</option>--}}
{{--                                            <option value="3">{{ __('text.March') }}</option>--}}
{{--                                            <option value="4">{{ __('text.April') }}</option>--}}
{{--                                            <option value="5">{{ __('text.May') }}</option>--}}
{{--                                            <option value="6">{{ __('text.June') }}</option>--}}
{{--                                            <option value="7">{{ __('text.July') }}</option>--}}
{{--                                            <option value="8">{{ __('text.August') }}</option>--}}
{{--                                            <option value="9">{{ __('text.September') }}</option>--}}
{{--                                            <option value="10">{{ __('text.October') }}</option>--}}
{{--                                            <option value="11">{{ __('text.November') }}</option>--}}
{{--                                            <option value="12">{{ __('text.December') }}</option>--}}
{{--                                        </select>--}}
{{--                                    </div>--}}
{{--                                    <!-- Hours -->--}}
{{--                                    <div class="form-group mb-3">--}}
{{--                                        <h4 class="heading" >Часы</h4>--}}
{{--                                        <input class="form-control form-control-rounded @error('hours') is-invalid @enderror" name="hours" id="hours" type="text" value="0">--}}
{{--                                        @error('hours')--}}
{{--                                        <div class="alert alert-card alert-danger">Часы не заполнены</div>--}}
{{--                                        @enderror--}}
{{--                                    </div>--}}
{{--                                    <!-- Publications -->--}}
{{--                                    <div class="form-group mb-3">--}}
{{--                                        <h5 class="heading" >Публикации (печатные/электронные)</h5>--}}
{{--                                        <input class="form-control form-control-rounded @error('publications') is-invalid @enderror" name="publications" id="publications" type="text" value="0">--}}
{{--                                        @error('publications')--}}
{{--                                        <div class="alert alert-card alert-danger">Публикации не заполнены</div>--}}
{{--                                        @enderror--}}
{{--                                    </div>--}}
{{--                                    <!-- Videos -->--}}
{{--                                    <div class="form-group mb-3">--}}
{{--                                        <h4 class="heading" >Видеоролики</h4>--}}
{{--                                        <input class="form-control form-control-rounded @error('videos') is-invalid @enderror" name="videos" id="videos" type="text" value="0">--}}
{{--                                        @error('videos')--}}
{{--                                        <div class="alert alert-card alert-danger">Видеоролики не заполнены</div>--}}
{{--                                        @enderror--}}
{{--                                    </div>--}}
{{--                                    <!-- return visits -->--}}
{{--                                    <div class="form-group mb-3">--}}
{{--                                        <h4 class="heading">Повторные посещения</h4>--}}
{{--                                        <input class="form-control form-control-rounded @error('return_visits') is-invalid @enderror" name="return_visits" id="return_visits" type="text" value="0">--}}
{{--                                        @error('return_visits')--}}
{{--                                        <div class="alert alert-card alert-danger">Видео не заполнены</div>--}}
{{--                                        @enderror--}}
{{--                                    </div>--}}
{{--                                    <!-- bible studies -->--}}
{{--                                    <div class="form-group mb-3">--}}
{{--                                        <h4 class="heading">Изучения Библии</h4>--}}
{{--                                        <input class="form-control form-control-rounded @error('bible_studies') is-invalid @enderror" name="bible_studies" id="bible_studies" type="text" value="0">--}}
{{--                                        @error('bible_studies')--}}
{{--                                        <div class="alert alert-card alert-danger">Изучения Библии не заполнены</div>--}}
{{--                                        @enderror--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </form>--}}
{{--                        </div>--}}
{{--                        <div class="modal-footer">--}}
{{--                            <button class="btn btn-secondary" type="submit" data-dismiss="modal">Закрыть</button>--}}
{{--                            <a class="btn btn-success" type="button" href="{{ route('personalReport') }}"--}}
{{--                               onclick="event.preventDefault();--}}
{{--                                    document.getElementById('personalReport').submit();">--}}
{{--                                Отправить--}}
{{--                            </a>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
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
