@extends('BootstrapApp.layouts.guest')
@section('title') Meeper @endsection
@section('content')


    <div class="container mt-5">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Важное уведомление!</h5>
                <p class="card-text" style="font-size: 18px;">Пожалуйста, передайте следующий код ответственному:</p>
                <code style="font-size: 24px;">{{$user->code}}</code>
                <hr>
                <div class="mt-3">
                    <button class="btn btn-secondary rounded-4" onclick="shareContent()">
                        <i class="fas fa-share"></i> Поделиться
                    </button>

                    <!-- Кнопка "Поделиться в Telegram" с иконкой -->
                    <a href="tg://msg?text=Ваш_код_здесь" class="btn btn-info rounded-4 ml-2">
                        <i class="fa fa-telegram"></i> Telegram
                    </a>
                </div>
            </div>
        </div>
    </div>
    <script>
        function shareContent() {
            if (navigator.share) {
                navigator.share({
                    title: 'Заголовок вашего контента',
                    text: 'Ваш текст для поделиться',
                    url: 'https://ваша-ссылка-для-поделиться'
                })
                    .then(() => console.log('Successful share'))
                    .catch((error) => console.log('Error sharing:', error));
            } else {
                alert('Ваш браузер не поддерживает функцию поделиться.');
            }
        }
    </script>

    <div class="content container-fluid">
        <div class="heading text-center">
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <span class="fw-semibold">Информация!</span> Передайте код ниже ответсвенному
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            {{$user->code}}
{{--            @foreach($congregations as $congregation)--}}
{{--            <div class="card card-body border-secondary mt-2">--}}
{{--                <div class="row justify-content-between align-items-center">--}}
{{--                    <div class="col-6 py-1">--}}
{{--                        <span class="d-block h2 text-inherit mb-0">{{$congregation->name}}</span>--}}
{{--                    </div>--}}

{{--                    <div class="col-6 py-1">--}}
{{--                        <form method="POST" action="{{ route('joinCongregation', $congregation->id) }}">--}}
{{--                            @csrf--}}
{{--                                @if(DB::table('congregation_requests')--}}
{{--                                ->where('user_id', '=', Auth::id())--}}
{{--                                ->where('congregation_id', '=', $congregation->id)--}}
{{--                                ->count() > 0)--}}
{{--                                    <span class="text-success">--}}
{{--                                        <i class="fa-solid fa-circle-check"></i>--}}
{{--                                        Запрос отправлен--}}
{{--                                    </span>--}}
{{--                                @else--}}
{{--                                <button class="btn btn-primary">Присоединиться</button>--}}
{{--                                @endif--}}
{{--                        </form>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            @endforeach--}}

        </div>
        {{--<div class="text-center mt-4">
            <a class="btn btn-lg btn-outline-primary btn-rounded " href="{{ URL::previous() }}">Вернуться назад</a>
        </div>--}}
    </div>
@endsection
