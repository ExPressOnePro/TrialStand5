@extends('layouts.app')
@section('title')Stand | таблица@endsection
@section('content')

    <div class="main-content pt-4">
    <div class="breadcrumb">
        <h1 class="mr-2">Стенд</h1>
        <ul>
            <li><a href="">страница</a></li>
            <li></li>
        </ul>
    </div>
        <a href="{{ route('test') }}">
            <button class="btn btn-success m-1" type="button">
                тест</button>
        </a>
        <a href="{{ route('ExampleNext') }}">
            <button class="btn btn-danger m-1" type="button">
                Кнопка создания таблицы на следующую неделю</button>
        </a>

        <a href="{{ route('ExampleCurrent') }}">
            <button class="btn btn-success m-1" type="button">
                Кнопка создания таблицы на текущую неделю</button>
        </a>

    <div class="separator-breadcrumb border-top"></div>
        <div class="row">
            <div class="col-lg-10 col-md-10 col-xl-10  mb-4 mt-4 offset-md-1">
                <div class="col ul-widget__head ">
                    <div class="ul-widget__head-toolbar">
                        <ul class="nav nav-tabs nav-tabs-line nav-tabs-bold ul-widget-nav-tabs-line" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active show" data-toggle="tab" href="#__g-widget4-tab1-content" role="tab" aria-selected="true">Текущая неделя</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#__g-widget4-tab2-content" role="tab" aria-selected="false">Следующая неделя</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="ul-widget__body">
                    <div class="tab-content">
                        <div class="tab-pane active show" id="__g-widget4-tab1-content">
                            <div class="ul-widget1">
                                @foreach ($active_day as $actday)
                                    <div class='card o-hidden col-md-12 mb-4'>
                                        <div class="d-flex align-items-center mb-4 mt-4"><i class="i-ID-Card text-30 mr-2"></i>
                                            <h5 class="text-18 font-weight-600 card-title m-0">
                                                {{  $dayperweek = \App\Enums\WeekDaysEnum::getWeekDay($actday->day) }}
                                                {{  $gwe = \App\Enums\WeekDaysEnum::getWeekDayDate($actday->day) }}
                                            </h5>
                                            <h5 class="text-18 font-weight-700 card-title m-8">
                                                <span class="text-black text-22">{{ $actday->stand }} </span>
                                            </h5>
                                        </div>
                                        <div class='card-body pa-0'>
                                            <div class='table-wrap'>
                                                <div class='table-responsive'>
                                                    <table class='table table-sm table-hover mb-0'>
                                                        <thead>
                                                        <tr>
                                                            <th class='not-sortable'>Время</th>
                                                            <th class='not-sortable'>Возвещатель</th>
                                                            <th class='not-sortable'>Возвещатель</th>
                                                            {{--<th class='not-sortable'>Отчет</th>--}}
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @foreach($templates as $template)
                                                            @if (
                                                                    !empty($template->standPublishers)
                                                                    && $template->day === $actday->day
                                                                )
                                                                @foreach($template->standPublishers as $standPublishers)
                                                                    <tr class="elem">
                                                                        @if(
                                                                        $gwe === date('d.m.Y', strtotime($standPublishers->date))
                                                                        && $template->status === '1'
                                                                        && $template->type === 'current'
                                                                        )
                                                                            <th class="value1">
                                                                                <div class="mt-2">
                                                                                    <span class="text-mute text">{{ $tepmid =$template->id }}</span>
                                                                                    {{ $tepm = $template->time }}
                                                                                </div>
                                                                            </th>
                                                                            <th class="value2">
                                                                                @if(
                                                                                    is_null($standPublishers->user)
                                                                                )
                                                                                    {{--<a href="--}}{{--{{ route('recToStand') }}--}}{{--">--}}
                                                                                        <button class="btn btn-success m-1 editButton" type="button" data-toggle="modal" data-target="#ModalForRecord">
                                                                                            Записаться</button>
                                                                                    {{--</a>--}}
                                                                                @else
                                                                                    <div class="mt-2 ">{{$standPublishers->user->name}}</div>
                                                                                @endif
                                                                            </th>
                                                                            <th class="value3">
                                                                                @if(
                                                                                    is_null($standPublishers->user_2)
                                                                                )
                                                                                    <a href="{{--{{ route('recToStand') }}--}}">
                                                                                        <button class="btn btn-success m-1 editButton" type="button" data-toggle="modal" data-target="#ModalForRecord">
                                                                                            Записаться</button>
                                                                                    </a>
                                                                                @else
                                                                                    <div class="mt-2">{{$standPublishers->user2->name}}</div>
                                                                                @endif
                                                                            </th>
                                                                            <th class="value4">
                                                                                @if(
                                                                                    ($standPublishers->user === null)
                                                                                    && $standPublishers->user2 === null
                                                                                )

                                                                                @else
                                                                                    <a href="">
                                                                                        <button class="btn btn-outline-warning m-1" type="button">
                                                                                            :</button>
                                                                                    </a>
                                                                                @endif
                                                                            </th>
                                                                        @endif
                                                                    </tr>
                                                                @endforeach
                                                            @endif
                                                        @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="tab-pane" id="__g-widget4-tab2-content">
                            <div class="ul-widget1">
                                @foreach ($active_day as $actday)
                                    <div class='card o-hidden col-md-12 mb-4'>
                                        <div class="d-flex align-items-center mb-4 mt-4"><i class="i-ID-Card text-30 mr-2"></i>
                                            <h5 class="text-18 font-weight-600 card-title m-0">
                                                {{  $dayperweek = \App\Enums\WeekDaysEnum::getWeekDay($actday->day) }}
                                                {{  $gwe = \App\Enums\WeekDaysEnum::getNextWeekDayDate($actday->day) }}
                                            </h5>
                                            <h5 class="text-18 font-weight-700 card-title m-8">
                                                <span class="text-black text-22">{{ $actday->stand }} </span>
                                            </h5>
                                        </div>
                                        <div class='card-body pa-0'>
                                            <div class='table-wrap'>
                                                <div class='table-responsive'>
                                                    <table class='table table-sm table-hover mb-0'>
                                                        <thead>
                                                        <tr>
                                                            <th class='not-sortable'>Время</th>
                                                            <th class='not-sortable'>Возвещатель</th>
                                                            <th class='not-sortable'>Возвещатель</th>
                                                            {{--<th class='not-sortable'>Отчет</th>--}}
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @foreach($templates as $template)
                                                            @if (

                                                                    !empty($template->standPublishers)
                                                                    && $template->day === $actday->day
                                                                )
                                                                @foreach($template->standPublishers as $standPublishers)
                                                                    <tr>
                                                                        @if(
                                                                         $gwe === date('d.m.Y', strtotime($standPublishers->date))
                                                                        && $template->status === '1'
                                                                        )
                                                                            <th>
                                                                                <div class="mt-2">
                                                                                    {{ $tempTime = $template->time }}
                                                                                </div>
                                                                            </th>
                                                                            <th>
                                                                                @if(
                                                                                    is_null($standPublishers->user)
                                                                                )
                                                                                        <button class="btn btn-success m-1" type="button" data-toggle="modal" data-target="#exampleModalCenter">
                                                                                            Записаться</button>
                                                                                @else
                                                                                    <div class="mt-2 ">{{$standPublishers->user->name}}</div>
                                                                                @endif
                                                                            </th>
                                                                            <th>
                                                                                @if(
                                                                                    is_null($standPublishers->user_2)
                                                                                )
                                                                                        <button class="btn btn-success m-1" type="button" data-toggle="modal" data-target="#exampleModalCenter">
                                                                                            Записаться</button>
                                                                                @else
                                                                                    <div class="mt-2">{{$standPublishers->user2->name}}</div>
                                                                                @endif
                                                                            </th>
                                                                            <th>
                                                                                @if(
                                                                                    ($standPublishers->user === null)
                                                                                    && $standPublishers->user2 === null
                                                                                )

                                                                                @else
                                                                                        <button class="btn btn-outline-warning m-1" type="button">
                                                                                            Изменить</button>
                                                                                @endif
                                                                            </th>
                                                                        @endif
                                                                    </tr>
                                                                @endforeach
                                                            @endif
                                                        @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="ModalForRecord" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle-2" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle-2">Запись</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                </div>
                <form>
                    @csrf
                    <div class="modal-body">
                        <label for="picker1">Выберите из списка</label>
                        <h4 class="heading">Запись для cтенда {{ $StandID->name }}</h4>
                        <select class="form-control form-control-rounded" id="usernameID">
                            @foreach($user as $us)
                                <option>{{ $us->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-danger" type="button" data-dismiss="modal">Отменить</button>
                        <button class="btn btn-success saveUpd" type="submit" id="toast-close-button">Сохранить</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <button class="btn btn-outline-success btn-success" id="toast-close-button">Show Toast</button>
    <button class="btn btn-block btn-outline-info btn-info mb-3" id="toast-slow-duration">Hide Toast</button>
    <button class="btn btn-block btn-outline-info btn-info" id="toast-position-top-center">Top Center</button>

    <div id="toast-top-left" class="toast-top-left"></div>
    <div id="toast-top-center" class="toast-top-center"></div>
    <div id="toast-top-right" class="toast-top-right"></div>
    <div id="toast-top-full-width" class="toast-top-full-width"></div>
    <div id="toast-bottom-right" class="toast-bottom-right"></div>
    <div id="toast-bottom-full-width" class="toast-bottom-full-width"></div>
    <div id="toast-bottom-center" class="toast-bottom-center"></div>
    <div id="toast-bottom-left" class="toast-bottom-left"></div>


    <div id="sm-wrapper"></div>
    <script>
        /*$(document).ready(function() {
            $('.editButton').click(function() {
                var row = $(this).closest('tr'); // Получаем ближайшую строку таблицы
                var value1 = row.find('.value1').text(); // Получаем значение из ячейки с классом "value1"
                var value2 = row.find('.value2').text();// Получаем значение из ячейки с классом "value2"
                var value3 = row.find('.value3').text();// Получаем значение из ячейки с классом "value3"
                var value4 = row.find('.value4').text();// Получаем значение из ячейки с классом "value4"
                $('#ModalForRecord').modal('show');
                /!*$('#ModalForRecord').find('modal-body.newtrow').val(value1)*!/


                // Дальше вы можете использовать полученные значения по своему усмотрению,
                // например, передать их в другую функцию для дальнейшей обработки или отобразить в модальном окне редактирования.

                // Пример вывода значений в консоль:
                console.log( value1);
                console.log( value2);
                console.log( value3);
                console.log( value4);
            });
        });*/
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('.saveUpd').click(function(e) {
            e.preventDefault();

            var row = $(this).closest('tr'); // Получаем ближайшую строку таблицы
            var value1 = row.find('.value1').text(); // Получаем значение из ячейки с классом "value1"
            var value2 = row.find('.value2').text();// Получаем значение из ячейки с классом "value2"
            var value3 = row.find('.value3').text();// Получаем значение из ячейки с классом "value3"
            var value4 = row.find('.value4').text();// Получаем значение из ячейки с классом "value4"
            var username = $("#usernameID").val();

            /*$('#ModalForRecord{{--{{$template->id}}--}}').modal('show');*/

            $.ajax({
                type: 'POST',
                url: '{{ route('updateRecordStand') }}',  //Как пример, можно  просто /ajax. Тогда в роуте тоже исправь
                dataType: 'html',
                data: {
                    _token: '{{csrf_token()}}',
                    username:username,
                },
                success: function(data){
                    /*console.log(data);
                    location.reload();*/
                        data = JSON.parse(data);
                        if(data.statusCode)
                        {
                            window.location = "/stand";
                        }
                }
            });
        });

        /*// Update record
        $(document).on("click", ".update" , function() {
            var edit_id = $(this).data('id');

            var name = $('#name_'+edit_id).val();
            var email = $('#email_'+edit_id).val();

            if(name != '' && email != ''){
                $.ajax({
                    url: 'updateUser',
                    type: 'post',
                    data: {_token: CSRF_TOKEN,editid: edit_id,name: name,email: email},
                    success: function(response){
                        alert(response);
                    }
                });
            }else{
                alert('Fill all fields');
            }
        });*/
    </script>

@endsection
