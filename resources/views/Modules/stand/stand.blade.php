@extends('BootstrapApp.layouts.app')
@section('title') Meeper @endsection
@section('content')

    <div id="content-container"></div>

    <script>
        $(document).ready(function() {
            // Получаем ID стенда из переменной PHP
            var standId = {{ $id }};

            // Загружаем содержимое стенда при загрузке страницы
            loadStandContent('current', standId);
        });
        var standId = {{ $id }};
        function loadStandContent(content, standId) {
            $('#preloader').show();
            var url = '{{ route('stand.table_json', ['', '']) }}/' + content + '/' + standId;
            // window.history.pushState({ path: window.location.href }, '', `?content=${content}`);

            $.ajax({
                url: url,
                type: 'GET',
                success: function(response) {
                    $('#preloader').hide();
                    $('#content-container').html(response.content);
                },
                error: function(error) {
                    $('#preloader').hide();
                    console.error(error);
                }
            });
        }
    </script>


@endsection
