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

            function checkAndUpdateContent(content) {
                $.ajax({
                    url: '{{ route('home-content', '') }}/' + content,
                    type: 'GET',
                    success: function(response) {
                        if (response.content !== localStorage.getItem('currentContent')) {
                            localStorage.setItem('currentContent', response.content);
                            $('#dynamic-content').html(response.content);
                        }
                    },
                    error: function(error) {
                        console.error(error);
                    }
                });
            }
            $(document).ready(function() {
                var homeContent = localStorage.getItem('homeContent');
                checkAndUpdateContent(homeContent);

                if (homeContent) {
                    checkAndUpdateContent(homeContent);
                } else {
                    checkAndUpdateContent('main');
                }

                setInterval(function() {
                    checkAndUpdateContent(localStorage.getItem('homeContent'));
                }, 5000); // Проверять изменения каждые 5 секунд
            });
        </script>

        {{--                @include('BootstrapApp.Modules.home.includes.MyCongregationResponsibilities')--}}
    </div>
    @include('BootstrapApp.Modules.home.includes.modal_all_records_with_stand')
</div>
