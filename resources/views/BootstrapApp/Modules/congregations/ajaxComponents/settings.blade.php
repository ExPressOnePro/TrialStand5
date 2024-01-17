
<div class="row">
    <div class="col-lg-4 mb-3">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Основная информация</h4>
            </div>
            <div class="card-body">
{{--                <form id="">--}}
{{--                    --}}
{{--                    <div class="form-floating mb-2">--}}
{{--                        <input type="text" class="form-control" name="name" id="name" placeholder="Введите название стенда" value="{{ $congregation->name }}">--}}
{{--                        <label for="name">Название Собрания</label>--}}
{{--                    </div>--}}
{{--                </form>--}}
                <h5 class="card-title">Встреча в будний день</h5>

                <form action="meeting-time">
                    @csrf
                    <div class="form-floating">

                        <select class="form-control" id="weekday" name="weekday">
                            <option value="monday">Понедельник</option>
                            <option value="tuesday">Вторник</option>
                            <option value="wednesday">Среда</option>
                            <option value="thursday">Четверг</option>
                            <option value="friday">Пятница</option>
                        </select>
                        <label for="weekday">День недели</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="time" class="form-control" id="weekdayTime" name="weekdayTime">
                        <label for="weekdayTime">Время встречи</label>
                    </div>
                    <h5 class="card-title">Встреча в выходной день</h5>
                    <div class="form-floating">

                        <select class="form-control" id="weekend" name="weekend">
                            <option value="saturday">Суббота</option>
                            <option value="sunday">Воскресенье</option>
                        </select>
                        <label for="weekend">День недели</label>
                    </div>

                    <div class="form-floating">
                        <input type="time" class="form-control" id="weekendTime" name="weekendTime">
                        <label for="weekendTime">Время встречи</label>
                    </div>

                    <button type="submit" class="btn btn-primary mt-3" onclick="saveMeetingTime(event)">Сохранить настройки</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>

    function saveMeetingTime(event) {
        const formElement = document.getElementById('meeting-time');
        var formData = new FormData(formElement);
        formData.append('_token', '{{ csrf_token() }}');
        event.preventDefault();
        $.ajax({
            type: 'POST',
            url: '{{ route('congregation.meetingTime', $congregation->id) }}',
            data: formData,
            processData: false,
            contentType: false,
            success: function (data) {  // Используйте переменную data, а не response
                if (data.error) {
                    console.log('Server error:', data.error);
                } else {
                    console.log('Success:', true);
                    window.location(reload);
                }
            },
            error: function (xhr) {
                var errors = xhr.responseJSON.errors;

                $(".form-error").remove();

                for (var error in errors) {
                    var input = $('[name=' + error + ']');
                    input.addClass('is-invalid');

                    input.parent('.form-floating').after('<span class="form-error text-danger">' + errors[error][0] + '</span>');
                }
            }
        });
    }

</script>
