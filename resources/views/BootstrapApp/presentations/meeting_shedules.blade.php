@extends('BootstrapApp.layouts.bootstrapApp')
@section('title') Meeper @endsection
@section('content')


<div class="position-relative overflow-hidden p-3 p-md-5 m-md-3 text-center bg-body-tertiary">
    <div class="col-md-6 p-lg-5 mx-auto my-5">
        <h1 class="display-3 fw-bold">Расписания</h1>
        <h3 class="fw-normal text-muted mb-3"> встреч собрания</h3>
        <div class="d-flex gap-3 justify-content-center lead fw-normal">
            <a class="row col-8 btn btn-outline-primary" href="#">
                начать
            </a>
        </div>
    </div>
    <div class="product-device shadow-sm d-none d-md-block"></div>
    <div class="product-device product-device-2 shadow-sm d-none d-md-block"></div>
</div>

{{--<div class="container my-5">--}}
{{--    <div class="row p-4 pb-0 pe-lg-0 pt-lg-5 align-items-center rounded-3 border shadow-lg">--}}
{{--        <div class="col-lg-7 p-3 p-lg-5 pt-lg-3">--}}
{{--            <blockquote class="blockquote">--}}
{{--            <p class="">Добро пожаловать в Модуль "Расписания встреч",--}}
{{--                созданный с целью максимального упрощения процесса формирования встреч.--}}
{{--                Модуль "Расписания" предоставляет уникальные инструменты и функции,--}}
{{--                которые делают процесс создания и управления ваших расписаниий легким и эффективным.</p>--}}
{{--            </blockquote>--}}
{{--        </div>--}}
{{--        <div class="col-lg-4 offset-lg-1 p-0 overflow-hidden shadow-lg">--}}
{{--            <img class="rounded-lg-3" src="{{ asset('images/Screenshot_2.jpg') }}" alt="" width="720">--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}
<div class="container my-5">
    <div class="row p-4 pb-0 pe-lg-0 pt-lg-5 text-center rounded-3 border shadow-lg">
        <div class="col-lg-6 mx-auto">
            <blockquote class="blockquote">
                <p class="">Модуль "Расписания встреч",
                    создан с целью максимального упрощения процесса формирования встреч.
                    Предоставляет инструменты и функции,
                    которые делают процесс создания и управления ваших расписаниий легким и эффективным.</p>
            </blockquote>
        </div>
        <div class="overflow-hidden" style="max-height: 30vh;">
            <div class="container px-5">
                <img src="{{ asset('images/schedule.png') }}" class="img-fluid border rounded-3 shadow-lg mb-4"  width="700" height="500">
            </div>
        </div>
    </div>
</div>

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
        <h1 class="display-4 fw-bold lh-1 text-body-emphasis">Генерация страницы в <h1 class="text-danger display-4 fw-bold lh-1">.PDF</h1></h1>
        <p class="lead">Наш модуль позволяет вам легко создавать PDF-версии ваших расписаний встреч для удобного распространения среди участников. Это обеспечивает простоту и удобство доступа к информации о встречах в любое время.</p>
    </div>
    <div class="col-lg-6 p-0 overflow-hidden">
        <div class="container px-5 mb-5">
            <div class="shadow-sm mx-auto " style="width: 80%; border-radius: 21px 21px 21px 21px;">
                <img src="{{ asset('images/pdf.png') }}" class="d-block mx-lg-auto img-fluid rounded-4 rounded-bottom-4" width="100%" height="400">
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


@endsection
