<div class="card-body">
    <form id="createUserForm">
        <div class="row mb-4">
            <label for="firstNameLabel" class="col-sm-3 col-form-label form-label">Имя Фамилия</label>
            <div class="col-sm-9">
                <input type="text" class="form-control mb-3" id="first_name" name="first_name" placeholder="имя" autocomplete="off">
            </div>
        </div>
        <div class="row mb-4">
            <label for="firstNameLabel" class="col-sm-3 col-form-label form-label">Фамилия</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" id="last_name" name="last_name" placeholder="фамилия" autocomplete="off">
            </div>
        </div>

        <div class="row mb-4">
            <label for="emailLabel" class="col-sm-3 col-form-label form-label">Email</label>
            <div class="col-sm-9">
                <input type="email" class="form-control" id="email" name="email" placeholder="ivanov@mail.com" autocomplete="off">
            </div>
        </div>

        <div class="row mb-4">
            <label for="emailLabel" class="col-sm-3 col-form-label form-label">Номер телефона (необязательно)</label>

            <div class="col-sm-9">
                <input type="tel" class="form-control" id="mobile_phone" name="mobile_phone" placeholder="012345678" autocomplete="off">
            </div>
        </div>


        <div class="row mb-4">
            <label for="departmentLabel" class="col-sm-3 col-form-label form-label">Логин</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" id="login" name="login" placeholder="Ivan" autocomplete="off">
            </div>
        </div>

        <div class="row mb-4">
            <label for="departmentLabel" class="col-sm-3 col-form-label form-label">Пароль</label>
            <div class="col-sm-9">
                <input type="password" class="form-control" id="password" name="password" autocomplete="off">
            </div>
        </div>

        <div class="col">
            <button type="submit" class="btn btn-primary w-100" onclick="createUser()">Создать пользователя</button>
        </div>
    </form>
</div>

<script>
    function createUser() {
        const formElement = document.getElementById('createUserForm');
        var formData = new FormData(formElement);

        // Save the password and then delete it from the form
        const password = formElement.password.value;
        formElement.password.value = '';

        formData.append('_token', '{{ csrf_token() }}');

        event.preventDefault();

        $.ajax({
            url: '{{ route('createPublisher', $congregation->id) }}',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                if (response.error) {
                    console.log('Server error:', response.error);
                } else {
                    console.log('Success:', true);
                    window.location.href = "{{ route('congregation.publishers', $congregation->id) }}";
                }
            },
            error: function(xhr) {
                var errors = xhr.responseJSON.errors;

                // Удаление предыдущих сообщений об ошибках
                $(".form-error").remove();

                for(error in errors) {
                    // Orderçplace the form item password back
                    formElement.password.value = password;

                    // Найдите соответствующее поле ввода и добавьте сообщение об ошибке
                    var input = $('input[name=' + error + ']');
                    input.after('<span class="form-error text-danger">' + errors[error][0] + '</span>');
                }
            }
        });
    }
</script>
