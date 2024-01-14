@extends('BootstrapApp.layouts.bootstrapApp')
@section('title')
    Meeper
@endsection
@section('content')


    <div class="container rounded-2 border align-items-center py-2 mb-2">
        <a class="h2 fw-bold text-decoration-none" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
            Как установить приложение на рабочий стол?
        </a>
        <div class="collapse" id="collapseExample">
            <div class="card card-body">
                <div class="col">
                    <div class="row row-cols-1 row-cols-sm-2 g-4">
                        <div class="feature col d-flex flex-column gap-2">
                            <div class="feature col d-flex align-items-center justify-content-between">
                                <div class="feature-icon-small d-inline-flex align-items-center justify-content-center fs-4 ms-3 rounded-3">
                                    <i class="bi bi-apple fa-2x"></i>
                                </div>
                                <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#installAppApple">
                                    Посмотреть
                                </button>
                            </div>
                        </div>
                        <div class="feature col d-flex flex-column gap-2">
                            <div class="feature col d-flex align-items-center justify-content-between">
                                <div class="feature-icon-small d-inline-flex align-items-center justify-content-center fs-4 ms-3 rounded-3">
                                    <i class="bi bi-android2 fa-2x"></i>
                                </div>
                                <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#installAppAndroid">
                                    Посмотреть
                                </button>
                            </div>
                        </div>
{{--                        <div class="feature col d-flex flex-column gap-2">--}}
{{--                            <div class="feature col d-flex align-items-center justify-content-between">--}}
{{--                                <div class="feature-icon-small d-inline-flex align-items-center justify-content-center fs-4 ms-3 rounded-3">--}}
{{--                                    <i class="bi bi-windows fa-2x"></i>--}}
{{--                                </div>--}}
{{--                                <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#installAppWindows">--}}
{{--                                    Посмотреть--}}
{{--                                </button>--}}
{{--                            </div>--}}
{{--                        </div>--}}
                    </div>
                </div>
            </div>
        </div>
    </div>


{{--    <div class="container rounded-2 border align-items-center py-2">--}}
{{--        <a class="h2 fw-bold text-decoration-none" data-bs-toggle="modal" data-bs-target="#navigation">--}}
{{--            Навигация в приложении--}}
{{--        </a>--}}
{{--    </div>--}}

    <div class="modal fade" id="installAppApple" tabindex="-1" aria-labelledby="installAppLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-fullscreen-sm-down">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-4" id="installAppLabel">Инструкция по установке для <i class="bi bi-apple fa-2x"></i></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <div class="row flex-lg-row-reverse align-items-center g-5 py-5">
                        <div class="col-12">
                            <h1 class="display-6 fw-bold lh-1 mb-3">Добавление веб-страниц в закладки в Safari на iPhone</h1>
                            <p>В приложении Safari <i class="fa fa-safari"></i> можно добавлять значки веб-сайтов на экран «Домой», чтобы быстро находить их позже.</p>
                            <hr class="divider">
                            <h1 class="display-6 fw-bold lh-1 mb-3">Добавление значка веб-сайта на экран «Домой»</h1>
                            <p>Вы можете добавить значок веб-сайта на экран «Домой» на iPhone для быстрого доступа.</p>
                            <ol>
                                <li><strong>При просмотре веб-сайта коснитесь кнопки «Поделиться»
                                        <img src="{{ asset('bootstrapApp/share_apple.png') }}" alt="Apple Icon" height="20" width="16"> в строке меню.
                                    </strong>
                                </li>
                                <li><strong>Прокрутите вниз список параметров, затем коснитесь «На экран "Домой"».</strong></li>
                            </ol>
                            <p>Если параметр «На экран "Домой"» не отображается, его можно добавить. Прокрутите вниз списка, коснитесь «Редактировать действия», затем коснитесь «На экран "Домой"» .</p>
                            <p>Значок появится только на том устройстве, на котором он добавлен</p>
                            <img src="{{asset('bootstrapApp/add_home_apple.png')}}"  height="499" width="281">
                        </div>
                    </div>
                </div>
                <div class="modal-footer ">
                    <button type="button" class="btn btn-secondary col-12" data-bs-dismiss="modal">Закрыть</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="installAppAndroid" tabindex="-1" aria-labelledby="installAppAndroidLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-fullscreen-sm-down">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-4" id="installAppLabel">Инструкция по установке для <i class="bi bi-android2 fa-2x"></i></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <div class="row flex-lg-row-reverse align-items-center g-5 py-5">
                        <div class="col-12">
                            <h1 class="display-6 fw-bold lh-1 mb-3">Как установить Приложение</h1>
                            <ol>
                                <li>Откройте браузер Chrome <i class="fa fa-chrome"></i> на устройстве Android.</li>
                                <li>Перейдите на сайт <strong><a href="http://meeper.info">meeper.info</a></strong></li>
                                <li>Нажмите <strong>Установить</strong>.</li>
                            </ol>
                            <hr class="divider">
                            <h1 class="display-6 fw-bold lh-1 mb-3">Если нет кнопки установить</h1>
                            <p>Вы можете добавить значок веб-сайта на экран «Домой» вручную</p>
                            <ol>
                                <li><strong>При просмотре веб-сайта коснитесь кнопки в правом верхнем углу
                                        <i class="fa-solid fa-ellipsis-vertical text-primary"></i>
                                    </strong>
                                </li>
                                <li><strong>Прокрутите вниз список параметров, затем коснитесь «На экран "Домой"».</strong></li>
                            </ol>
                            <p>Если параметр «На экран "Домой"» не отображается, его можно добавить. Прокрутите вниз списка, коснитесь «Редактировать действия», затем коснитесь «На экран "Домой"» .</p>
                            <p>Значок появится только на том устройстве, на котором он добавлен</p>
                            <img src="{{asset('bootstrapApp/add_home_android.jpg')}}"  height="580" width="281">
                        </div>
                    </div>
                </div>
                <div class="modal-footer ">
                    <button type="button" class="btn btn-secondary col-12" data-bs-dismiss="modal">Закрыть</button>
                </div>
            </div>
        </div>
    </div>
{{--    <div class="modal fade" id="navigation" tabindex="-1" aria-labelledby="installAppLabel"--}}
{{--         aria-hidden="true">--}}
{{--        <div class="modal-dialog modal-fullscreen-sm-down">--}}
{{--            <div class="modal-content">--}}
{{--                <div class="modal-header">--}}
{{--                    <h1 class="modal-title fs-4" id="installAppLabel">Навигация в приложении</h1>--}}
{{--                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>--}}
{{--                </div>--}}
{{--                <div class="modal-body">--}}

{{--                    <div class="row flex-lg-row-reverse align-items-center g-5 py-5">--}}
{{--                        <div class="col-12">--}}
{{--                            <h1 class="display-6 fw-bold lh-1 mb-3">Добавление веб-страниц в закладки в Safari на iPhone</h1>--}}
{{--                            <p>В приложении Safari <i class="fa fa-safari"></i> можно добавлять значки веб-сайтов на экран «Домой», чтобы быстро находить их позже.</p>--}}
{{--                            <hr class="divider">--}}
{{--                            <h1 class="display-6 fw-bold lh-1 mb-3">Добавление значка веб-сайта на экран «Домой»</h1>--}}
{{--                            <p>Вы можете добавить значок веб-сайта на экран «Домой» на iPhone для быстрого доступа.</p>--}}
{{--                            <ol>--}}
{{--                                <li><strong>При просмотре веб-сайта коснитесь кнопки «Поделиться»--}}
{{--                                        <img src="{{ asset('bootstrapApp/share_apple.png') }}" alt="Apple Icon" height="20" width="16"> в строке меню.--}}
{{--                                    </strong>--}}
{{--                                </li>--}}
{{--                                <li><strong>Прокрутите вниз список параметров, затем коснитесь «На экран "Домой"».</strong></li>--}}
{{--                            </ol>--}}
{{--                            <p>Если параметр «На экран "Домой"» не отображается, его можно добавить. Прокрутите вниз списка, коснитесь «Редактировать действия», затем коснитесь «На экран "Домой"» .</p>--}}
{{--                            <p>Значок появится только на том устройстве, на котором он добавлен</p>--}}
{{--                            <img src="{{asset('bootstrapApp/add_home_apple.png')}}"  height="499" width="281">--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="modal-footer ">--}}
{{--                    <button type="button" class="btn btn-secondary col-12" data-bs-dismiss="modal">Закрыть</button>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}

    <script>
        var myModal = new bootstrap.Modal(document.getElementById('installAppApple'));
        document.querySelector('.btn-primary').addEventListener('click', function () {
            myModal.show();
        });
    </script>
@endsection
