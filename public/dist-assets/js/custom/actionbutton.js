$(function() {
    $(document).ready(function () {
        $('#my-button').click(function (event) {
            event.preventDefault(); // предотвращаем действие по умолчанию для кнопки
            var formData = $('#my-form').serialize(); // получаем данные формы
            $.ajax({
                url: "{{ route('my-route') }}", // адрес обработчика POST запроса
                type: "POST",
                data: formData,
                success: function (response) {
                    // обработка успешного ответа сервера
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    // обработка ошибки при отправке запроса
                }
            });
        });
    });
}
