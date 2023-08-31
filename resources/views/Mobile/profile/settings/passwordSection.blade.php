<div class="card-header">
    <h4 class="card-title">Измените ваш пароль</h4>
</div>

<div class="card-body">
    <!-- Form -->
    <form id="changePasswordForm" method="post" action="{{route('profile.settings.changePassword')}}">
        @csrf
        <!-- Form -->
        <div class="row mb-4">
            <label for="currentPasswordLabel" class="col-sm-3 col-form-label form-label">Текущий пароль</label>

            <div class="col-sm-9">
                <div class="input-group input-group-merge" data-hs-validation-validate-class>
                    <input type="password" class="js-toggle-password form-control form-control-lg" name="currentPassword" id="currentPassword" placeholder="Введите текущий пароль" aria-label="Введите текущий пароль" required minlength="6"
                           data-hs-toggle-password-options='{
                 "target": "#changePassTargetcurrentPassword",
                 "defaultClass": "bi-eye-slash",
                 "showClass": "bi-eye",
                 "classChangeTarget": "#changePassIconcurrentPassword"
               }'>
                    <a id="changePassTargetcurrentPassword" class="input-group-append input-group-text" href="javascript:;">
                        <i id="changePassIconcurrentPassword" class="bi-eye"></i>
                    </a>
                    <span class="invalid-feedback">Введите </span>
                </div>
            </div>
        </div>
        <!-- End Form -->

        <!-- Form -->
        <div class="row mb-4">
            <label for="newPassword" class="col-sm-3 col-form-label form-label">Новый пароль</label>

            <div class="col-sm-9">
                <div class="input-group input-group-merge" data-hs-validation-validate-class>
                    <input type="password" class="js-toggle-password form-control form-control-lg" name="newPassword" id="newPassword" placeholder="6+ символов" aria-label="8+ characters required" required minlength="6"
                           data-hs-toggle-password-options='{
             "target": "#changePassTargetnewPassword",
             "defaultClass": "bi-eye-slash",
             "showClass": "bi-eye",
             "classChangeTarget": "#changePassIconnewPassword"
           }'>
                    <a id="changePassTargetnewPassword" class="input-group-append input-group-text" href="javascript:;">
                        <i id="changePassIconnewPassword" class="bi-eye"></i>
                    </a>
                    <span class="invalid-feedback">Введите </span>
                </div>
            </div>
        </div>
        <!-- End Form -->

        <!-- Form -->
        <div class="row mb-4">
            <div class="col-sm-9">

                <h5>Требования к паролю:</h5>


                <ul class="fs-6">
                    <li>Минимум 6 символов - чем больше, тем лучше</li>
                </ul>
            </div>
        </div>
        <!-- End Form -->

        <div class="d-flex justify-content-end">
            <button type="submit" class="btn btn-primary">Сохранить настройки</button>
        </div>
    </form>
    <!-- End Form -->
</div>
