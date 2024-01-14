<div class="card-header">
    <h4 class="card-title">Email</h4>
</div>

<!-- Body -->
<div class="card-body">
    <p>Ваша текущая почта <h1><span class="badge bg-info ">{{$user->email}}</span></h1></p>

    <!-- Form -->
    <form>
        <!-- Form -->
        <div class="row mb-4">
            <label for="newEmailLabel" class="col-sm-3 col-form-label form-label">Новый почтовый адрес</label>

            <div class="col-sm-9">
                <input type="email" class="form-control" name="newEmail" id="newEmailLabel" placeholder="Введите новый почтовый адрес" aria-label="Введите новый почтовый адрес">
            </div>
        </div>
        <!-- End Form -->

        <div class="d-flex justify-content-end">
            <button type="submit" class="btn btn-primary">Сохранить настройки</button>
        </div>
    </form>
    <!-- End Form -->
</div>
<!-- End Body -->
