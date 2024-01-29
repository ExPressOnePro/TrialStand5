@extends('BootstrapApp.layouts.bootstrapApp')
@section('title') Meeper @endsection
@section('content')

    <style>
        .present-ms {
            user-select: none;
            background: linear-gradient(115deg, #3DA4F5, #5BC28C, #647BD9, #715fc2, #596AF1, #5fa8c2);
        }
    </style>
    <style>
        /* Добавляем стили для кнопок */
        .instuction {
            display: inline-block;
            padding: 8px 16px;
            font-size: 1rem;
            text-align: center;
            text-decoration: none;
            transition: background-color 0.3s ease, color 0.3s ease, border-color 0.3s ease;
            background-color: #ad4a4a; /* Цвет фона при наведении */
        }

        /* Стили для наведения на кнопку */
        .instuction:hover {
            background-color: #d20000; /* Цвет фона при наведении */
            color: #fff; /* Цвет текста при наведении */
        }
        .begin {
            display: inline-block;
            padding: 8px 16px;
            font-size: 1rem;
            text-align: center;
            text-decoration: none;
            transition: background-color 0.3s ease, color 0.3s ease, border-color 0.3s ease;
            background-color: #47abab; /* Цвет фона при наведении */
        }

        /* Стили для наведения на кнопку */
        .begin:hover {
            background-color: #00c2e3; /* Цвет фона при наведении */
            color: #fff; /* Цвет текста при наведении */
        }

    </style>


    <div class="row present-ms no-select p-4 pb-0 pe-lg-0 pt-lg-5 align-items-center rounded-5 my-5">
        <div class="col-lg-7 p-3 p-lg-5 pt-lg-3 text-white">
            <h1 class="display-4 fw-bold lh-1">Модуль Расписаний</h1>
            <p class="lead">создан для максимального упрощения процесса формирования встреч.
                Обеспечивает инструменты и функции для легкого и эффективного создания и управления расписаниями.</p>
            <div class="d-flex gap-3 justify-content-center lead fw-normal mb-5">
                <a class="btn instuction text-white" href="#">
                    Читать инструкцию
                </a>
                <a class="btn begin" href="#">
                    Начать
                </a>
            </div>
        </div>
        <div class="col-lg-4 offset-lg-1 p-4 overflow-hidden" >
            <img src="{{ asset('images/devices.png') }}" class=" rounded-4 mx-lg-auto img-fluid" width="350" height="200">
        </div>
    </div>



    <div class="d-none d-md-block">
        <div class="row p-4 pb-0 pe-lg-0 pt-lg-5 align-items-center rounded-3 border shadow-lg my-5">
            <div class="col-lg-7 p-3 p-lg-5 pt-lg-3">
                <h1 class="display-4 fw-bold lh-1 text-body-emphasis">Быстрое создание по шаблонам</h1>
                <p class="lead">Интерфейс позволяет вам создавать расписание встреч всего за несколько кликов. Мы предоставляем готовые шаблоны для различных видов встреч, что делает процесс еще более быстрым и удобным.</p>
            </div>
            <div class="col-lg-4 offset-lg-1 p-0 overflow-hidden" >
                <img src="{{ asset('images/png/ms_templates.png') }}" class="d-block rounded-4 mx-lg-auto img-fluid" width="500" height="300">
            </div>
        </div>


        <div class="row p-4 pt-lg-5 align-items-center rounded-3 border shadow-lg my-5">
            <div class="col-lg-6 p-3 p-lg-5 pt-lg-3">
                <h1 class="display-4 fw-bold lh-1 text-body-emphasis">Редактирование и обновление</h1>
                <p class="lead">Возможность мгновенного редактирования и обновления вашего расписания через веб-интерфейс.</p>
            </div>
            <div class="col-lg-6 p-0 overflow-hidden">
                <div class="container px-5">
                    <div class="shadow-sm mx-auto " style="width: 80%; height: 300px; border-radius: 21px 21px 21px 21px;">
                        <img src="{{ asset('images/redaction.jpg') }}" class="d-block mx-lg-auto img-fluid rounded-4 rounded-bottom-4" width="100%" height="400">
                    </div>
                </div>
            </div>
        </div>

        <div class="row p-4 pb-0 pe-lg-0 pt-lg-5 align-items-center rounded-3 border shadow-lg my-5">
            <div class="col-lg-6 p-3 p-lg-5 pt-lg-3">
                <h1 class="display-4 fw-bold lh-1 text-body-emphasis">Генерация страницы в <span class="h1 text-danger display-4 fw-bold lh-1">.PDF</span></h1>
                <p class="lead">Наш модуль позволяет вам легко создавать PDF-версии ваших расписаний встреч для удобного распространения среди участников. Это обеспечивает простоту и удобство доступа к информации о встречах в любое время.</p>
            </div>
            <div class="col-lg-6 p-0 overflow-hidden">
                <div class="container px-5 mb-5">
                    <div class="shadow-sm mx-auto " style="width: 80%; border-radius: 21px 21px 21px 21px;">
                        <img id="fullscreen-image" src="{{ asset('images/pdf.png') }}" class="d-block mx-lg-auto img-fluid rounded-4 rounded-bottom-4" width="100%" height="400">
                    </div>
                </div>
            </div>
        </div>


        <div class="row p-4 pb-0 pe-lg-0 pt-lg-5 align-items-center rounded-3 border shadow-lg my-5">
            <div class="col-lg-6 p-3 p-lg-5 pt-lg-3">
                <h1 class="display-4 fw-bold lh-1 text-body-emphasis">Журнал и история</h1>
                <p class="lead">Ведение истории изменений в расписаниях и их сохранения</p>
            </div>
            <div class="col-lg-6 p-0 overflow-hidden">
                <div class="container px-5 mb-5">
                    <div class="shadow-sm mx-auto " style="width: 80%; border-radius: 21px 21px 21px 21px;">
                        <img src="{{ asset('images/logs.png') }}" class="d-block mx-lg-auto img-fluid rounded-4 rounded-bottom-4" width="100%" height="400">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="d-sm-none">

        <div class="card rounded-4 mb-5">
            <div class="card-body">
                <h1 class="display-4 fw-bold lh-1 text-body-emphasis">Быстрое создание по шаблонам</h1>
                <p class="lead">Интерфейс позволяет вам создавать расписание встреч всего за несколько кликов. Мы предоставляем готовые шаблоны для различных видов встреч, что делает процесс еще более быстрым и удобным.</p>
            </div>
            <img src="{{ asset('images/png/ms_templates.png') }}" class="card-img-bottom rounded-bottom-4" alt="...">

        </div>

        <div class="card rounded-4 mb-5">
            <div class="card-body">
                <h1 class="display-4 fw-bold lh-1 text-body-emphasis">Редактирование и обновление</h1>
                <p class="lead">Возможность мгновенного редактирования и обновления вашего расписания через веб-интерфейс.</p>
            </div>
            <img src="{{ asset('images/redaction.jpg') }}" class="card-img-bottom rounded-bottom-4" alt="...">
        </div>

        <div class="card rounded-4 mb-5">
            <div class="card-body">
                <h1 class="display-4 fw-bold lh-1 text-body-emphasis">Генерация страницы в <span class="text-danger display-4 fw-bold lh-1">.PDF</span></h1>
                <p class="lead">Наш модуль позволяет вам легко создавать PDF-версии ваших расписаний встреч для удобного распространения среди участников. Это обеспечивает простоту и удобство доступа к информации о встречах в любое время.</p>
            </div>
            <img src="{{ asset('images/pdf.png') }}" class="card-img-top rounded-bottom-4" alt="...">
        </div>


        <div class="card rounded-4 mb-5">
            <div class="card-body">
                <h1 class="display-4 fw-bold lh-1 text-body-emphasis">Журнал и история</h1>
                <p class="lead">Ведение истории изменений в расписаниях и их сохранения</p>
            </div>
            <img src="{{ asset('images/logs.png') }}" class="card-img-top rounded-bottom-4" alt="...">
        </div>
    </div>
    <div class="row mb-5">
        <a class="h3 btn btn-outline-primary" href="#">Наверх</a>
    </div>
@endsection
