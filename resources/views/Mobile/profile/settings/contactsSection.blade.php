<div class="card-header">
    <h4 class="card-title">Контактная информация</h4>
</div>

<!-- Body -->
<div class="card-body">


    <!-- Form -->
    <form method="post" action="{{ route('profile.contactsInfoSave') }}">
        @csrf
        <div class="row mb-4">
            <label for="countryLabel" class="col-sm-3 col-form-label form-label">Страна</label>
            <div class="col-sm-9">
                <select id="countrySelect" name="inputMergeCountrySelect" class="form-select">
                    <option>Не выбрана</option>
                    <option value="Moldova" {{ $country === 'Moldova' ? 'selected' : '' }}>Молдова</option>
                    <option value="Great Britain" {{ $country === 'Great Britain' ? 'selected' : '' }}>Великобритания</option>
                </select>
            </div>
        </div>

        <div class="row mb-4" id="cityRow" {{ empty($country) ? 'style=display:none;' : '' }}>
            <label for="cityLabel" class="col-sm-3 col-form-label form-label">Город</label>
            <div class="col-sm-9">
                <select id="citySelect" name="inputMergeCitySelect" class="form-select">
                    <option>Выберите страну, чтобы увидеть города</option>
                    @if (!empty($city))
                        <option value="{{ $city }}" selected>{{ $city }}</option>
                    @endif
                </select>
            </div>
        </div>
        <script>
            $(document).ready(function() {
                // Маппинг стран и их городов
                var citiesByCountry = {
                    'Moldova': ['Кишинев', 'Бельцы', 'Тирасполь'],
                    'Great Britain': ['Лондон', 'Манчестер', 'Бирмингем']
                };

                // При изменении выбранной страны
                $('#countrySelect').on('change', function() {
                    var selectedCountry = $(this).val();
                    var citySelect = $('#citySelect');
                    var cityRow = $('#cityRow');
                    citySelect.empty();

                    if (selectedCountry !== 'Не выбрана') {
                        var cities = citiesByCountry[selectedCountry];
                        cityRow.show();
                        citySelect.append('<option>Выберите город</option>');

                        cities.forEach(function(city) {
                            citySelect.append('<option>' + city + '</option>');
                        });
                    } else {
                        cityRow.hide();
                        citySelect.append('<option>Выберите страну, чтобы увидеть города</option>');
                    }
                });
            });
        </script>
            <!-- Form -->
        <div class="row mb-4">
            <label for="phoneLabel" class="col-sm-3 col-form-label form-label">Номер телефона <span class="form-label-secondary">( Действующий )</span></label>
            <div class="col-sm-9">
                <input type="tel" class="js-input-mask form-control" inputmode="numeric" name="mobile_phone" id="mobile_phone" placeholder="+(xxx)xx-xxx-xxx" value="{{ isset($mobile_phone) ? $mobile_phone : '' }}">
            </div>
        </div>

        <div class="row mb-4">
            <label for="phoneLabel" class="col-sm-3 col-form-label form-label">Номер телефона <span class="form-label-secondary">( Дополнительный )</span></label>
            <div class="col-sm-9">
                <input type="tel" class="js-input-mask form-control" name="additional_phone" id="additional_phone" placeholder="+(xxx)xx-xxx-xxx" aria-label="+x(xxx)xxx-xx-xx" value="{{ isset($additional_phone) ? $additional_phone : '' }}">
            </div>
        </div>

        <div class="d-flex justify-content-end">
            <button type="submit" class="btn btn-primary">Сохранить настройки</button>
        </div>
    </form>
    <!-- End Form -->
</div>
<script>
    (function() {
        // INITIALIZATION OF FLATPICKR
        // =======================================================
        HSCore.components.HSFlatpickr.init('.js-flatpickr')
    })();
</script>
<!-- End Body -->
