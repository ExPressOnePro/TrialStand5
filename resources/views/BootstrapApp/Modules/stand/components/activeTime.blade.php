

    <div class="card-header d-flex align-items-center">
        <h1 class="heading float-left card-title m-0">Активное время</h1>
    </div>
    <div class="container mt-4">
        <h5 class="mb-3">Важная информация по вводу времени:</h5>
        <p>
            Для правильного функционирования системы ввода времени, убедитесь, что вы вводите время в следующем формате: <strong>ЧЧ:ММ</strong>.
        </p>
        <p>
            Примеры правильного формата:
        </p>
        <ul>
            <li>09:30</li>
            <li>14:15</li>
            <li>21:00</li>
        </ul>
        <p>
            Обратите внимание, что:
        </p>
        <ul>
            <li>Часы (ЧЧ) должны быть в диапазоне от 00 до 23.</li>
            <li>Минуты (ММ) должны быть в диапазоне от 00 до 59.</li>
        </ul>
        <p>
            Если формат не соблюден, система будет интерпретировать введенное значение как минуты, что может привести к некорректным результатам.
        </p>
        <p>
            <strong>Пожалуйста, проверьте синтаксис вашего ввода, чтобы избежать ошибок.</strong>
        </p>
        <p>
            Пример заполнения времени для одного дня:
        </p>
        <p>
            09:00, 10:00, 11:00, 12:00, 13:00, 14:00, 15:00, 16:00, 17:00
        </p>
    </div>


    <div class="card card-body mb-3">
        <form id="stand-time-form" class="mb-4 stand-time-form">
            @csrf
            <div class="row">
                @foreach ($daysOfWeek as $dayNumber => $dayName)
                    <div class="col-md-4">
                        <input type="hidden" name="day" value="{{ $dayNumber }}">
                        <h5>{{ $dayName }}</h5>
                        <textarea class="form-control border-dark" id="time_{{ $dayNumber }}" name="time_{{ $dayNumber }}" rows="4">@if (isset($scheduleData[$dayNumber]) && count($scheduleData[$dayNumber]) > 0){{ implode(', ', $scheduleData[$dayNumber]) }}@endif</textarea>
                        <button type="button" class="btn btn-primary update-button" data-day="{{ $dayNumber }}">Обновить</button>
                    </div>
                @endforeach
            </div>
        </form>
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
            $('.update-button').on('click', function () {
                var button = $(this);
                var day = button.data('day');
                var textarea = $('#time_' + day);
                var form = button.closest('form');
                var id = {{ $stand->id }};
                var url = "{{ route('StandTimeNext', ['id' => $stand->id, 'day' => ':day']) }}";
                url = url.replace(':day', day);

                var formData = {
                    '_token': form.find('[name="_token"]').val(),
                    'time': textarea.val()
                };

                $.ajax({
                    type: 'POST',
                    url: url,
                    data: formData,
                    success: function (data) {
                        console.log('success');
                    },
                    error: function (error) {
                        console.error(error);
                    }
                });
            });
        });
    </script>


    {{--    <script>--}}
{{--        $(document).ready(function () {--}}
{{--            // Event listener for adding a new time slot--}}
{{--            $('.stand-time-form .add-time').on('click', function () {--}}
{{--                var dayContainer = $(this).closest('.col-md-4');--}}
{{--                var dayNumberInput = dayContainer.find('input[name="day"]');--}}
{{--                var dayNumber = dayNumberInput.val();--}}

{{--                // Clone the time slot template for the specific day--}}
{{--                var timeSlotTemplate = dayContainer.find('.time-slot:first').clone();--}}

{{--                // Clear the value in the cloned time slot--}}
{{--                timeSlotTemplate.find('input[type="time"]').val('');--}}

{{--                // Append the cloned time slot before the add-time button--}}
{{--                dayContainer.find('.row.mb-3').before(timeSlotTemplate);--}}

{{--                // Update the "name" attribute of the cloned time slot with the new index--}}
{{--                timeSlotTemplate.find('input[type="time"]').attr('name', 'time[]');--}}

{{--                // If the day does not exist in the schedule data, create an entry for it--}}
{{--                var scheduleData = $('#StandTimeNext').data('scheduleData') || {};--}}
{{--                if (!scheduleData.hasOwnProperty(dayNumber)) {--}}
{{--                    scheduleData[dayNumber] = [];--}}
{{--                }--}}
{{--                $('#StandTimeNext').data('scheduleData', scheduleData);--}}
{{--            });--}}

{{--            // Event listener for removing a time slot--}}
{{--            $(document).on('click', '.remove-time', function () {--}}
{{--                $(this).closest('.time-slot').remove();--}}
{{--            });--}}

{{--            // Function to handle form submission--}}
{{--            function updateStandTimeNext(form) {--}}
{{--                // Serialize form data--}}
{{--                var formData = form.serialize();--}}

{{--                // Make AJAX request--}}
{{--                $.ajax({--}}
{{--                    type: 'POST',--}}
{{--                    url: '', // Update with your actual route--}}
{{--                    data: formData,--}}
{{--                    success: function (data) {--}}
{{--                        // Handle success, if needed--}}
{{--                        console.log(data);--}}
{{--                    },--}}
{{--                    error: function (error) {--}}
{{--                        // Handle error, if needed--}}
{{--                        console.error(error);--}}
{{--                    }--}}
{{--                });--}}
{{--            }--}}

{{--            // Event listener for form submission--}}
{{--            $('.stand-time-form').submit(function (event) {--}}
{{--                event.preventDefault();--}}

{{--                // Update scheduleData with input values--}}
{{--                var scheduleData = {};--}}
{{--                $('.col-md-4').each(function () {--}}
{{--                    var dayNumber = $(this).find('input[name="day"]').val();--}}
{{--                    var times = $(this).find('input[name^="time"]').map(function () {--}}
{{--                        return $(this).val();--}}
{{--                    }).get();--}}
{{--                    scheduleData[dayNumber] = times;--}}
{{--                });--}}
{{--                $('#StandTimeNext').data('scheduleData', scheduleData);--}}

{{--                updateStandTimeNext($(this));--}}
{{--            });--}}
{{--        });--}}


{{--    </script>--}}


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
</div>



