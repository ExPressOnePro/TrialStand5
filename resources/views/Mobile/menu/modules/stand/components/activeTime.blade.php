
        <div class="card-header d-flex align-items-center">
            <h1 class="heading float-left card-title m-0">Активное время</h1>
        </div>
{{--        $scheduleData    --}}
        @foreach ($daysOfWeek as $dayNumber => $dayName)
            <div class="card-body">
                <form id="StandTimeNext{{ $dayNumber }}" method="POST" action="{{ route('StandTimeNext', ['id' => $stand->id, 'day' => $dayNumber]) }}" class="mb-4">
                    @csrf
                    <input type="hidden" name="day" value="{{ $dayNumber }}">
                    <h2>День {{ $dayName }}</h2>
                    @if (isset($scheduleData[$dayNumber]) && count($scheduleData[$dayNumber]) > 0)
                        @foreach ($scheduleData[$dayNumber] as $index => $time)
                            <div class="time-slot d-flex justify-content-between align-items-center mb-3">
                                <input type="time" class="form-control" name="time[]" value="{{ $time }}" required>
                                <button type="button" class="btn btn-outline-danger remove-time">Удалить</button>
                            </div>
                        @endforeach
                    @endif
                    <div class="d-flex justify-content-between mb-3"> <!-- Перемещаем этот контейнер внутрь формы -->
                        <button type="button" class="btn btn-primary add-time">Добавить время</button>
                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModalCenterStandTimeNext{{ $dayNumber }}">Сохранить</button>
                    </div>
                </form>
            </div>
            <!-- Modal -->
            <div id="exampleModalCenterStandTimeNext{{ $dayNumber }}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterStandTimeNext" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalCenterTitle">{{ __('Изменения со следующей недели') }}</h5>
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
                            <p>Нажимая на кнопку сохранить изменения, график служения со стендом на следующую неделю будет обновлен в соответсвии с выбранными вами часами.</p>
                            <p>Учтите! Если следующая неделя уже доступна для записей и возвещатели записывались они не увидят своих записей!</p>
                            <p>Рекомендация! Изменяйте время до того момента как следующая неделя будет отображена.</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Закрыть</button>
                            <a type="button" class="btn btn-primary" href="{{ route('StandTimeNext', ['id' => $stand->id, 'day' => $dayNumber] ) }}"
                               onclick="event.preventDefault();
                                   document.getElementById('StandTimeNext{{ $dayNumber }}').submit();">
                                {{ __('Сохранить изменения') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div><!-- End Modal -->
        @endforeach
        <div class="card-footer">
            <div class="row">
                <button type="button" class="btn btn-outline-warning" data-bs-toggle="modal" data-bs-target="#exampleModalCenterStandTimeNextToCurrent">
                    {{ __('Изменения с текущей недели') }}
                </button>
            </div>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const addTimeButtons = document.querySelectorAll('.add-time');
                const removeTimeButtons = document.querySelectorAll('.remove-time');

                addTimeButtons.forEach(button => {
                    button.addEventListener('click', function() {
                        const form = button.parentElement.parentElement; // Получаем форму
                        const timeSlot = document.createElement('div');
                        timeSlot.className = 'time-slot d-flex justify-content-between align-items-center mb-3';
                        const timeInput = document.createElement('input');
                        timeInput.type = 'time';
                        timeInput.name = 'time[]';
                        timeInput.className = 'form-control'; // Добавляем класс для стилизации
                        const removeButton = document.createElement('button');
                        removeButton.type = 'button';
                        removeButton.className = 'btn btn-outline-danger remove-time'; // Добавляем классы для стилизации
                        removeButton.textContent = 'Удалить';

                        timeSlot.appendChild(timeInput);
                        timeSlot.appendChild(removeButton);
                        form.insertBefore(timeSlot, form.lastElementChild); // Вставляем перед последним элементом формы (перед кнопками)
                    });
                });

                removeTimeButtons.forEach(button => {
                    button.addEventListener('click', function() {
                        const timeSlot = button.parentElement;
                        const form = timeSlot.parentElement;
                        timeSlot.parentElement.removeChild(timeSlot);

                        // Проверяем, остались ли ещё временные поля для данного дня
                        const dayField = form.querySelector('input[name="day"]');
                        const day = dayField.value;
                        const timeFields = form.querySelectorAll('input[name="time[]"]');
                        if (timeFields.length === 0) {
                            // Если временных полей не осталось, удаляем день из массива и формы
                            delete scheduleData[day];
                            form.parentElement.removeChild(form);
                        }
                    });
                });
            });
        </script>






{{--        <!-- Modal -->--}}
{{--<div id="exampleModalCenterStandTimeNext" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterStandTimeNext" aria-hidden="true">--}}
{{--    <div class="modal-dialog modal-dialog-centered" role="document">--}}
{{--        <div class="modal-content">--}}
{{--            <div class="modal-header">--}}
{{--                <h5 class="modal-title" id="exampleModalCenterTitle">{{ __('Изменения со следующей недели') }}</h5>--}}
{{--                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>--}}
{{--            </div>--}}
{{--            <div class="modal-body">--}}
{{--                <div class="alert alert-soft-primary" role="alert">--}}
{{--                    <div class="d-flex">--}}
{{--                        <div class="flex-shrink-0">--}}
{{--                            <i class="bi-exclamation-triangle-fill"></i>--}}
{{--                        </div>--}}
{{--                        <div class="flex-grow-1 ms-2">--}}
{{--                            Информация: Пожалуйста прочтите--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <p>Нажимая на кнопку сохранить изменения, график служения со стендом на следующую неделю будет обновлен в соответсвии с выбранными вами часами.</p>--}}
{{--                <p>Учтите! Если следующая неделя уже доступна для записей и возвещатели записывались они не увидят своих записей!</p>--}}
{{--                <p>Рекомендация! Изменяйте время до того момента как следующая неделя будет отображена.</p>--}}
{{--            </div>--}}
{{--            <div class="modal-footer">--}}
{{--                <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Закрыть</button>--}}
{{--                <a type="button" class="btn btn-primary" href="{{ route('StandTimeNext', ['id' => $stand->id, 'day' => $dayNumber] ) }}"--}}
{{--                   onclick="event.preventDefault();--}}
{{--                                   document.getElementById('StandTimeNext{{ $dayNumber }}').submit();">--}}
{{--                    {{ __('Сохранить изменения') }}--}}
{{--                </a>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div><!-- End Modal -->--}}



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



