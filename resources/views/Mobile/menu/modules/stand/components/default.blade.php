
<div class="card-header">
    <h4 class="card-title">Стандартные настройки стенда</h4>
</div>

<!-- Body -->
<div class="card-body">
    <form action="{{ route('stand.default.update', $stand->id) }}" method="POST">
        @csrf
        <div class="row mb-4">
            <div class="col-sm-12">
                <div class="col-md-12 form-group mb-3">
                    <input class="form-control form-control-rounded" id="name" type="text" name="name" placeholder="Введите название стенда" value="{{ $stand->name }}">
                </div>
                <div class="col-md-12 form-group">
                    <input class="form-control form-control-rounded" id="location" type="text" name="location" placeholder="Местоположение стенда" value="{{  $stand->location }}">

                </div>
            </div>
        </div>
        <div class="d-flex justify-content-end">
            <button type="submit" class="btn btn-primary">Сохранить изменения</button>
        </div>
    </form>
</div>




