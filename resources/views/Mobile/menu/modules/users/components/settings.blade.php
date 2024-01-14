<div class="col-lg-8">
    <div class="d-grid gap-3 gap-lg-5">
        <!-- Card -->
        <div class="card">
            <!-- Header -->
            <div class="card-header card-header-content-between">
                <h4 class="card-header-title">Настройки пользователя</h4>
            </div>
            <!-- End Header -->

            <!-- Body -->
            <div class="card-body">
                <div class="row mb-4">
                    <button class="btn btn-outline-primary" id="generateCode">Сгенерировать пароль</button>
                </div>
                <form method="post" action="{{ route('users.updateGeneratePassword', $user->id) }}">
                    @csrf
                    <label for="code">Сгенерированный пароль:</label>
                    <div class="input-group input-group-merge mb-4">
                        <input type="text" id="pinputfield" class="form-control" value="" readonly>
                        <a class="js-clipboard input-group-append input-group-text" href="javascript:;"
                           data-hs-clipboard-options='{
       "contentTarget": "#pinputfield",
       "classChangeTarget": "#iconExampleLinkIcon3",
       "defaultClass": "bi-clipboard",
       "successClass": "bi-check"
     }'>
                            <i id="iconExampleLinkIcon3" class="bi-clipboard"></i>
                        </a>
                    </div>
                    <div class="row mb-4">
                        <button class="btn btn-outline-success" type="submit">Cохранить</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    // Функция для генерации случайного 8-значного числа
    function generateRandomCode() {
        const min = 10000000;
        const max = 99999999;
        return Math.floor(Math.random() * (max - min + 1)) + min;
    }

    // Получаем ссылки на элементы button и input
    const generateCodeButton = document.getElementById("generateCode");
    const pinputfield = document.getElementById("pinputfield");

    // Добавляем обработчик события для кнопки "Сгенерировать пароль"
    generateCodeButton.addEventListener("click", function() {
        // Генерируем случайное число
        const randomCode = generateRandomCode();

        // Устанавливаем его значение в поле input
        pinputfield.value = randomCode;
    });
</script>

<script>
    // Функция для генерации случайного 8-значного числа
    function generateRandomCode() {
        const min = 10000000;
        const max = 99999999;
        return Math.floor(Math.random() * (max - min + 1)) + min;
    }

    // Получаем ссылку на элемент input
    const codeInput = document.getElementById("pinputfield");

    // Генерируем случайное число и устанавливаем его значение в input
    const randomCode = generateRandomCode();
    codeInput.value = randomCode;
</script>
