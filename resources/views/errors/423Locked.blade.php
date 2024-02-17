@extends('BootstrapApp.layouts.app')
@section('title') Stand | нет прав @endsection
@section('content')

    <div class="content container-fluid">
    <div class="row justify-content-sm-center text-center py-10">
        <div class="col-sm-7 col-md-5">

            <h1>Доступ запрещен</h1>
            <p>У вашего аккаунта нет прав для просмотра страницы.</p>
            <p>Обратитесь к ответсвенному для получения прав!</p>


            <a class="btn btn-primary" onclick="goBack()">Вернуться назад</a>
        </div>
    </div>
    </div>

    <script>
        function goBack() {
            window.history.back();
        }
    </script>


@endsection
