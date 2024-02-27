

<div class="tab-content" id="nav-tabContent">
    <div class="tab-pane fade active show" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
        <div class="container">
{{--            @include('BootstrapApp.Modules.home.includes.FAQ')--}}
            @include('BootstrapApp.Modules.home.includes.module_ms')
            <div class="row mb-5 py-3">
                @include('BootstrapApp.Modules.home.includes.myRecordsOnStand')
                <div class="col-md-6" id="dynamic-content-MyConResp"></div>
                <script>
                    $(document).ready(function () {
                        // Загрузка страницы "dynamic.page" при помощи AJAX при загрузке документа
                        loadDynamicContent('dynamic.page');
                    });

                    function loadDynamicContent(routeName) {
                        $('#preloader').show();
                        $.ajax({
                            url: "{{ route('checkUserValues', $user_congregation_id) }}",
                            type: "GET",
                            success: function (data) {
                                $('#preloader').hide();
                                $('#dynamic-content-MyConResp').html(data);
                            },
                            error: function (error) {
                                $('#preloader').hide();
                                console.error(error);
                            }
                        });
                    }
                </script>

                {{--                @include('BootstrapApp.Modules.home.includes.MyCongregationResponsibilities')--}}
            </div>
            @include('BootstrapApp.Modules.home.includes.modal_all_records_with_stand')
        </div>
    </div>
    <div class="tab-pane fade " id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
        <div class="container">
            <div class="row py-3 row-cols-1 row-cols-lg-3">
                @can('module.stand')
                    <div class="col mb-3 mb-lg-5">
                        <a class="card border-left-empty rounded-3 text-decoration-none shadow p-4" href="{{route('stand.hub2')}}">
                            <div class="d-flex justify-content-left">
                                <!-- time -->
                                <div class="align-items-center me-3">
                                    <img src="{{ asset('front/img/ss.svg') }}" height="90" width="75" alt="Stand Icon">
                                </div>
                                <!-- publishers -->
                                <div class="col-9 align-items-center m-auto">
                                    <h2 class="fw-bold mb-0 fs-2 text-body-emphasis">Стенд</h2>
                                    <p class="m-auto">Служение со стендом</p>
                                </div>
                            </div>
                        </a>
                    </div>
                @endcan
                @can('module.contacts')
                    <div class="col mb-3 mb-lg-5">
                        <a class="card border-left-empty rounded-3 text-decoration-none shadow mb-2 p-4" href="{{route('contacts.hub2')}}">
                            <div class="d-flex justify-content-left">
                                <!-- time -->
                                <div class="align-items-center me-3">
                                    <img src="{{ asset('front/img/contacts.svg') }}"  height="90" width="75" alt="Contact Icon">
                                </div>
                                <!-- publishers -->
                                <div class="col-9 align-items-center m-auto">
                                    <h3 class="fw-bold mb-0 fs-2 text-body-emphasis">{{ __('text.Контакты') }}</h3>
                                    <p class="m-auto">{{ __('text.Контактная книга собрания') }}</p>
                                </div>
                            </div>
                        </a>
                    </div>
                @endcan
                @can('module.schedule')
                    <div class="col mb-3 mb-lg-5">
                        <a class="card border-left-empty rounded-3 text-decoration-none shadow mb-2 p-4" href="{{ route('meetingSchedules.overview', ['id' =>auth()->user()->congregation_id ]) }}">
                            <div class="d-flex align-items-center">
                                <div class="align-items-center me-3">
                                    <img src="{{ asset('images/svg/schedule.svg') }}"  height="90" width="75" alt="Contact Icon">
                                </div>
                                <div class="col-9 align-items-center m-auto">
                                    <h3 class="fw-bold mb-0 fs-2 text-body-emphasis">Расписания
                                        @if($viewed === false)
                                            <span class="badge bg-success">Новое</span>
                                        @else
                                        @endif
                                    </h3>
                                    <p class="m-auto">Просмотрите расписания будущих встреч собрания</p>
                                </div>
                            </div>
                        </a>
                    </div>
                @endcan
                @can('congregation.open_congregation')
                    <div class="col mb-3 mb-lg-5">
                        <a class="card border-left-empty rounded-3 text-decoration-none shadow mb-2 p-4" href="{{ route('congregationView', ['id' =>auth()->user()->congregation_id ]) }}">
                            <div class="d-flex align-items-center">
                                <div class="align-items-center me-3">
                                    <img src="{{ asset('front/img/meeting.svg') }}"  height="90" width="75" alt="Contact Icon">
                                </div>
                                <div class="col-9 align-items-center m-auto">
                                    <h3 class="fw-bold mb-0 fs-2 text-body-emphasis">{{ __('text.Собрание') }}</h3>
                                    <p class="m-auto">{{ __('text.Управляйте собранием') }}</p>
                                </div>
                            </div>
                        </a>
                    </div>
                @endcan
            </div>
        </div>
    </div>
    <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
        <p>This is some placeholder content the <strong>Contact tab's</strong> associated content. Clicking another tab will toggle the visibility of this one for the next. The tab JavaScript swaps classes to control the content visibility and styling. You can use it with tabs, pills, and any other <code>.nav</code>-powered navigation.</p>
    </div>
</div>

<script>
    $(document).ready(function () {
        // Загрузка страницы "dynamic.page" при помощи AJAX при загрузке документа
        loadDynamicContent('dynamic.page');
    });

    function loadDynamicContent(routeName) {
        $('#preloader').show();
        $.ajax({
            url: "{{ route('checkUserValues', $user_congregation_id) }}",
            type: "GET",
            success: function (data) {
                $('#preloader').hide();
                $('#dynamic-content-MyConResp').html(data);
            },
            error: function (error) {
                $('#preloader').hide();
                console.error(error);
            }
        });
    }
</script>f


