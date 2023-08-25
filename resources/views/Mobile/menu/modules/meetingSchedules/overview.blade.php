@extends('Mobile.layouts.front.home')
@section('title') Meeper @endsection
@section('content')

    <div class="content container-fluid">
        <div class="row justify-content-lg-center">
            <div class="col-lg-9">
                <div class="d-grid gap-3 gap-lg-5">
                    <div class="card card-body ">
                        <li class="d-flex justify-content-between align-items-center fs-6">
                            <h4 class="card-header-title">23 Августа</h4>
                            <h4 class="card-header-title">Среда 19:00</h4>
                        </li>
                    </div>
                    <div class="card card-body">
                            <ul class="list-group list-group-flush list-group-start-bordered">
                                <li class="list-group-item fs-6">
                                    <a class="list-group-item-action border-warning">
                                        <div class="row d-flex justify-content-between align-items-center border-bottom">
                                            <div class="col d-flex justify-content-start mb-1 mt-1">
                                                <h5 class="text-inherit mb-0 me-3">Распорядитель улицы</h5>
                                            </div>
                                            <div class="col-auto d-flex justify-content-end mb-1 mt-1">
                                                <dd class="text-body mb-0">
                                                    {{ $responsible_users['entry_manager']->last_name }} {{ $responsible_users['entry_manager']->first_name }}
                                                </dd>
                                            </div>
                                        </div>
                                        <div class="row d-flex justify-content-between align-items-center border-bottom">
                                            <div class="col d-flex justify-content-start mb-1 mt-1">
                                                <h5 class="text-inherit mb-0 me-3">Распорядитель фое</h5>
                                            </div>
                                            <div class="col-auto d-flex justify-content-end mb-1 mt-1">
                                                <dd class="text-body mb-0">
                                                    {{ $responsible_users['lobby_manager']->last_name }} {{ $responsible_users['lobby_manager']->first_name }}
                                                </dd>
                                            </div>
                                        </div>
                                        <div class="row d-flex justify-content-between align-items-center border-bottom">
                                            <div class="col d-flex justify-content-start mb-1 mt-1">
                                                <h5 class="text-inherit mb-0 me-3">Распорядитель зала</h5>
                                            </div>
                                            <div class="col-auto d-flex justify-content-end mb-1 mt-1">
                                                <dd class="text-body mb-0">
                                                    {{ $responsible_users['hall_manager']->last_name }} {{ $responsible_users['hall_manager']->first_name }}
                                                </dd>
                                            </div>
                                        </div>
                                        <div class="row d-flex justify-content-between align-items-center">
                                            <div class="col d-flex justify-content-start mb-1 mt-1">
                                                <h5 class="text-inherit mb-0 me-3">Распорядитель сцены</h5>
                                            </div>
                                            <div class="col-auto d-flex justify-content-end mb-1 mt-1">
                                                <dd class="text-body mb-0">
                                                    {{ $responsible_users['scene_manager']->last_name }} {{ $responsible_users['scene_manager']->first_name }}
                                                </dd>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li class="list-group-item fs-6">
                                    <a class="list-group-item-action border-warning">
                                        <div class="row d-flex justify-content-between align-items-center border-bottom">
                                            <div class="col d-flex justify-content-start mb-1 mt-1">
                                                <h5 class="text-inherit mb-0 me-3">Аппаратура 2 оператор (zoom)</h5>
                                            </div>
                                            <div class="col-auto d-flex justify-content-end mb-1 mt-1">
                                                <dd class="text-body mb-0">
                                                    {{ $responsible_users['equipment_1_operator']->last_name }} {{ $responsible_users['equipment_1_operator']->first_name }}
                                                </dd>
                                            </div>
                                        </div>
                                        <div class="row d-flex justify-content-between align-items-center border-bottom">
                                            <div class="col d-flex justify-content-start mb-1 mt-1">
                                                <h5 class="text-inherit mb-0 me-3">Распорядитель фое</h5>
                                            </div>
                                            <div class="col-auto d-flex justify-content-end mb-1 mt-1">
                                                <dd class="text-body mb-0">
                                                    {{ $responsible_users['equipment_2_operator_zoom']->last_name }} {{ $responsible_users['equipment_2_operator_zoom']->first_name }}
                                                </dd>
                                            </div>
                                        </div>
                                        <div class="row d-flex justify-content-between align-items-center border-bottom">
                                            <div class="col d-flex justify-content-start mb-1 mt-1">
                                                <h5 class="text-inherit mb-0 me-3">Микрофон 1</h5>
                                            </div>
                                            <div class="col-auto d-flex justify-content-end mb-1 mt-1">
                                                <dd class="text-body mb-0">
                                                    {{ $responsible_users['microphone_1']->last_name }} {{ $responsible_users['microphone_1']->first_name }}
                                                </dd>
                                            </div>
                                        </div>
                                        <div class="row d-flex justify-content-between align-items-center ">
                                            <div class="col d-flex justify-content-start mb-1 mt-1">
                                                <h5 class="text-inherit mb-0 me-3">Микрофон 2</h5>
                                            </div>
                                            <div class="col-auto d-flex justify-content-end mb-1 mt-1">
                                                <dd class="text-body mb-0">
                                                    {{ $responsible_users['microphone_2']->last_name }} {{ $responsible_users['microphone_2']->first_name }}
                                                </dd>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    <div class="card card-body">
                        <ul class="list-group list-group-flush list-group-start-bordered">
                            <li class="list-group-item fs-6">
                                <div class="row d-flex justify-content-between align-items-center border-bottom">
                                    <div class="col d-flex justify-content-start mb-1 mt-1">
                                        <h5 class="text-inherit mb-0 me-3">Председатель и молитва</h5>
                                    </div>
                                    <div class="col-auto d-flex justify-content-end mb-1 mt-1">
                                        <dd class="text-body mb-0">
                                            {{ $responsible_users['chairman']->last_name }} {{ $responsible_users['chairman']->first_name }}
                                        </dd>
                                    </div>
                                    <div class="col d-flex justify-content-start mb-1 mt-1">
                                        <h5 class="text-inherit mb-0 me-3">Песня</h5>
                                    </div>
                                    <div class="col-auto d-flex justify-content-end mb-1 mt-1">
                                        <dd class="text-body mb-0">
                                            {{ $responsible_users['song_1']->last_name }} {{ $responsible_users['song_1']->first_name }}
                                        </dd>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="card card-body">
                        <h3 class="fw-normal mb-1">
                            <div class="avatar text avatar-sm avatar-secondary">
                                <span class="avatar-initials"><i class="fa-regular fa-gem"></i></span>
                            </div>
                            СОКРОВИЩА ИЗ СЛОВА БОГА
                        </h3>
                            <ul class="list-group list-group-flush list-group-start-bordered">
                                <!-- Item -->
                                <li class="list-group-item">
                                    <a class="list-group-item-action border-secondary">
                                        <div class="row border-bottom mb-1 mt-1">
                                            <div class="col-sm mb-1 mt-1">
                                                <h5 class="text-inherit mb-0 me-3">«Радость, которую даёт Иегова, — ваша сила»</h5>
                                            </div>
                                            <div class="col-sm-auto mb-1 mt-1">
                                                <dd class="text-body mb-0">
                                                    {{ $responsible_users['Speech_10_min']->last_name }} {{ $responsible_users['Speech_10_min']->first_name }}
                                                </dd>
                                            </div>
                                        </div>
                                        <div class="row border-bottom">
                                            <div class="col-sm mb-1 mt-1">
                                                <h5 class="text-inherit mb-0 me-3">Духовные жемчужины (10 мин.)</h5>
                                            </div>
                                            <div class="col-sm-auto mb-1 mt-1">
                                                <dd class="text-body mb-0">
                                                    {{ $responsible_users['Spiritual_Pearls']->last_name }} {{ $responsible_users['Spiritual_Pearls']->first_name }}
                                                </dd>
                                            </div>
                                        </div>
                                        <div class="row border-bottom">
                                            <div class="col-sm mb-1 mt-1">
                                                <h5 class="text-inherit mb-0 me-3">Чтение Библии (4 мин.): Не 8:1—12 (th урок 10)</h5>
                                            </div>
                                            <div class="col-sm-auto mb-1 mt-1">
                                                <dd class="text-body mb-0">
                                                    {{ $responsible_users['Spiritual_Pearls']->last_name }} {{ $responsible_users['Spiritual_Pearls']->first_name }}
                                                </dd>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <!-- End Item -->
                            </ul>
                    </div>
                    <div class="card card-body">
                        <h2 class="fw-normal mb-1">
                            <div class="avatar text avatar-sm" style="background: #a99814">
                                <span class="avatar-initials"><i class="fa-solid fa-wheat-awn"></i></span>
                            </div>
                            ОТТАЧИВАЕМ НАВЫКИ СЛУЖЕНИЯ
                        </h2>
                        <ul class="list-group list-group-flush list-group-start-bordered">
                            <li class="list-group-item">
                                <a class="list-group-item-action" style="border-color: #a99814">
                                    <div class="row border-bottom mb-1 mt-1">
                                        <div class="col-sm mb-1 mt-1">
                                            <h5 class="text-inherit mb-0 me-3">Первый разговор (3 мин.).</h5>
                                        </div>
                                        <div class="col-sm-auto mb-1 mt-1">
                                            <dd class="text-body mb-0">
                                                {{ $responsible_users['main_hall_conversation_1']->last_name }} {{ $responsible_users['main_hall_conversation_1']->first_name }}
                                            </dd>
                                        </div>
                                    </div>
                                    <div class="row border-bottom">
                                        <div class="col-sm mb-1 mt-1">
                                            <h5 class="text-inherit mb-0 me-3">Второй разговор (4 мин.).</h5>
                                        </div>
                                        <div class="col-sm-auto mb-1 mt-1">
                                            <dd class="text-body mb-0">
                                                {{ $responsible_users['main_hall_conversation_2']->last_name }} {{ $responsible_users['main_hall_conversation_2']->first_name }}
                                            </dd>
                                        </div>
                                    </div>
                                    <div class="row border-bottom">
                                        <div class="col-sm mb-1 mt-1">
                                            <h5 class="text-inherit mb-0 me-3">Изучение Библии (5 мин.):</h5>
                                        </div>
                                        <div class="col-sm-auto mb-1 mt-1">
                                            <dd class="text-body mb-0">
                                                {{ $responsible_users['Spiritual_Pearls']->last_name }} {{ $responsible_users['Spiritual_Pearls']->first_name }}
                                            </dd>
                                            <dd class="text-body mb-0">
                                                {{ $responsible_users['Spiritual_Pearls']->last_name }} {{ $responsible_users['Spiritual_Pearls']->first_name }}
                                            </dd>
                                        </div>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="card card-body">
                        <h2 class="fw-normal mb-1">
                            <div class="avatar text avatar-sm avatar-danger">
                                <img class="avatar-img" src="{{ asset('front/img/sheep.jpg') }}" alt="Image Description">
                            </div>
                            ХРИСТИАНСКАЯ ЖИЗНЬ
                        </h2>
                        <ul class="list-group list-group-flush list-group-start-bordered">
                            <li class="list-group-item">
                                <a class="list-group-item-action border-danger">
                                    <div class="row border-bottom mb-1 mt-1">
                                        <div class="col-sm mb-1 mt-1">
                                            <h5 class="text-inherit mb-0 me-3">«Что делать, чтобы в семье царила радость» (15 мин.).</h5>
                                        </div>
                                        <div class="col-sm-auto mb-1 mt-1">
                                            <dd class="text-body mb-0">
                                                {{ $responsible_users['christian_life_item_1']->last_name }} {{ $responsible_users['christian_life_item_1']->first_name }}
                                            </dd>
                                        </div>
                                    </div>
                                    <div class="row border-bottom">
                                        <div class="col-sm mb-1 mt-1">
                                            <h5 class="text-inherit mb-0 me-3">Второй разговор (4 мин.).</h5>
                                        </div>
                                        <div class="col-sm-auto mb-1 mt-1">
                                            <dd class="text-body mb-0">
                                                {{ $responsible_users['christian_life_item_2']->last_name }} {{ $responsible_users['christian_life_item_2']->first_name }}
                                            </dd>
                                        </div>
                                    </div>
                                    <div class="row border-bottom">
                                        <div class="col-sm mb-1 mt-1">
                                            <h5 class="text-inherit mb-0 me-3">Изучение Библии в собрании (30 мин.): lff урок 54</h5>
                                        </div>
                                        <div class="col-sm-auto mb-1 mt-1">
                                            <dd class="text-body mb-0">
                                                {{ $responsible_users['bible_study_in_the_congregation']->last_name }} {{ $responsible_users['bible_study_in_the_congregation']->first_name }}
                                            </dd>
                                        </div>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

@endsection
