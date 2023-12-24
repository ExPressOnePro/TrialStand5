

    <div class="card-header d-flex align-items-center">
        <h1 class="heading float-left card-title m-0">Активное время</h1>
    </div>
    <div class="card card-body mb-3">
        <form id="StandTimeNext" class="mb-4 stand-time-form">
            @csrf
            <div class="row">
            @foreach ($daysOfWeek as $dayNumber => $dayName)
                    <div class="col-md-4">
                        <input type="hidden" name="day" value="{{ $dayNumber }}">
                        <h5>{{ $dayName }}</h5>

                        @if (isset($scheduleData[$dayNumber]) && count($scheduleData[$dayNumber]) > 0)
                            @foreach ($scheduleData[$dayNumber] as $index => $time)
                                <div class="time-slot d-flex justify-content-between align-items-center mb-3">
                                    <input type="time" class="form-control" name="time[]" value="{{ $time }}" required>
                                    <button type="button" class="btn btn-outline-danger remove-time">Удалить</button>
                                </div>
                            @endforeach
                        @endif

                        <div class="row mb-3">
                            <button type="button" class="btn btn-primary add-time">Добавить время</button>
                        </div>
                    </div>
            @endforeach
            </div>
        </form>

{{--    @foreach ($daysOfWeek as $dayNumber => $dayName)--}}
{{--        <div class="col-lg-4">--}}
{{--            <div class="card card-body border-secondary mb-3">--}}
{{--                <form id="StandTimeNext{{ $dayNumber }}" class="mb-4">--}}
{{--                    @csrf--}}
{{--                    <input type="hidden" name="day" value="{{ $dayNumber }}">--}}
{{--                    <h2>{{ $dayName }}</h2>--}}
{{--                    @if (isset($scheduleData[$dayNumber]) && count($scheduleData[$dayNumber]) > 0)--}}
{{--                        @foreach ($scheduleData[$dayNumber] as $index => $time)--}}
{{--                            <div class="time-slot d-flex justify-content-between align-items-center mb-3">--}}
{{--                                <input type="time" class="form-control" name="time[]" value="{{ $time }}" required>--}}
{{--                                <button type="button" class="btn btn-outline-danger remove-time">Удалить</button>--}}
{{--                            </div>--}}
{{--                        @endforeach--}}
{{--                    @endif--}}
{{--                    <div class="row mb-3">--}}
{{--                        <button type="button" class="btn btn-primary add-time">Добавить время</button>--}}
{{--                    </div>--}}
{{--                </form>--}}
{{--            </div>--}}

{{--            <!-- Modal -->--}}
{{--            <div id="exampleModalCenterStandTimeNext{{ $dayNumber }}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterStandTimeNext" aria-hidden="true">--}}
{{--                <div class="modal-dialog modal-dialog-centered" role="document">--}}
{{--                    <div class="modal-content">--}}
{{--                        <div class="modal-header">--}}
{{--                            <h5 class="modal-title" id="exampleModalCenterTitle">{{ __('Изменения со следующей недели') }}</h5>--}}
{{--                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>--}}
{{--                        </div>--}}
{{--                        <div class="modal-body">--}}
{{--                            <div class="alert alert-soft-primary" role="alert">--}}
{{--                                <div class="d-flex">--}}
{{--                                    <div class="flex-shrink-0">--}}
{{--                                        <i class="bi-exclamation-triangle-fill"></i>--}}
{{--                                    </div>--}}
{{--                                    <div class="flex-grow-1 ms-2">--}}
{{--                                        Информация: Пожалуйста прочтите--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <p>Нажимая на кнопку сохранить изменения, график служения со стендом на следующую неделю будет обновлен в соответсвии с выбранными вами часами.</p>--}}
{{--                            <p>Учтите! Если следующая неделя уже доступна для записей и возвещатели записывались они не увидят своих записей!</p>--}}
{{--                            <p>Рекомендация! Изменяйте время до того момента как следующая неделя будет отображена.</p>--}}
{{--                        </div>--}}
{{--                        <div class="modal-footer">--}}
{{--                            <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Закрыть</button>--}}
{{--                            <a type="button" class="btn btn-primary" href="{{ route('StandTimeNext', ['id' => $stand->id, 'day' => $dayNumber] ) }}"--}}
{{--                               onclick="event.preventDefault();--}}
{{--                                       document.getElementById('StandTimeNext{{ $dayNumber }}').submit();">--}}
{{--                                {{ __('Сохранить изменения') }}--}}
{{--                            </a>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div><!-- End Modal -->--}}
{{--        </div>--}}
{{--    @endforeach--}}
    <div class="card-footer">
        <div class="row">
            <button type="button" class="btn btn-outline-warning" data-bs-toggle="modal" data-bs-target="#exampleModalCenterStandTimeNextToCurrent">
                {{ __('Изменения с текущей недели') }}
            </button>
        </div>
    </div>
</div>

    <script>


        $(document).ready(function () {
            // Event listener for adding a new time slot
            $('.stand-time-form .add-time').on('click', function () {
                var dayContainer = $(this).closest('.col-md-4');
                var dayNumber = dayContainer.find('input[name="day"]').val();

                // Clone the time slot template for the specific day
                var timeSlotTemplate = dayContainer.find('.time-slot:first').clone();

                // Clear the value in the cloned time slot
                timeSlotTemplate.find('input[type="time"]').val('');

                // Append the cloned time slot before the add-time button
                dayContainer.find('.row.mb-3').before(timeSlotTemplate);

                // Update the "name" attribute of the cloned time slot with the new index
                timeSlotTemplate.find('input[type="time"]').attr('name', 'time[]');

                // If the day does not exist in the schedule data, create an entry for it
                if (!$('#StandTimeNext').data('scheduleData').hasOwnProperty(dayNumber)) {
                    $('#StandTimeNext').data('scheduleData')[dayNumber] = [];
                }
            });

            // Event listener for removing a time slot
            $(document).on('click', '.remove-time', function () {
                $(this).closest('.time-slot').remove();
            });

            // Function to handle form submission
            function updateStandTimeNext(form) {
                // Serialize form data
                var formData = form.serialize();

                // Make AJAX request
                $.ajax({
                    type: 'POST',
                    url: '', // Update with your actual route
                    data: formData,
                    success: function (data) {
                        // Handle success, if needed
                        console.log(data);
                    },
                    error: function (error) {
                        // Handle error, if needed
                        console.error(error);
                    }
                });
            }

            // Event listener for form submission
            $('.stand-time-form').submit(function (event) {
                event.preventDefault();
                updateStandTimeNext($(this));
            });
        });
    </script>
<div id="exampleModalCenterStandTimeNextToCurrent" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterStandTimeNextToCurrent" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">{{ __('Изменения с текущей недели') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="alert alert-soft-primary" role="alert">
                    <div class="d-flex">
                        <div class="flex-shrink-0">
                            <i class="bi-exclamation-triangle-fill"></i>
                        </div>
                        <div class="flex-grow-1 ms-2">
                            Информация: Пожалуйста прочтите
                        </div>
                    </div>
                </div>
                <p>Нажимая на кнопку сохранить изменения, график служения со стендом на Текущую неделю будет обновлен в соответсвии с выбранными вами часами.</p>
                <p>Учтите! На этой неделе уже есть записи возвещателей, изменив сейчас вы отключите все записи и возвещатели их не увидят!</p>
                <p>Рекомендация! НЕ изменяйте текущую неделю (если нет острой необходимости), обновите только следующую неделю, дождитесь понедельника 00:00 и время автоматически обновится не нарушая работу.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Закрыть</button>
                <a href="{{ route('StandTimeNextToCurrent', ['id' => $stand->id]) }}">
                    <button class="btn btn-primary" type="submit">{{ __('Сохранить изменения') }}</button>
                </a>
            </div>
        </div>
    </div>
</div><!-- End Modal -->



