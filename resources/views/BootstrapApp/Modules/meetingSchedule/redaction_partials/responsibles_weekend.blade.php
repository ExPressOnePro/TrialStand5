
    <div class="card">
        <div class="card-header">
            <h3>Службы ответственных</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('meetingSchedules.save_responsibles_weekend', $ms->id) }}" method="post">
                @csrf
                <div id="responsibles-weekend-container">
                    @foreach($responsibles_weekend as $key => $responsibleWeekend)
                        <div class="row mb-2 d-flex justify-content-between align-items-end border p-1" data-key="{{ $key }}">
                            <div class="col-md-4">
                                <div class="form">
                                    <label for="responsibles_weekend_name_{{ $key }}">Название:</label>
                                    <input type="text" name="responsibles_weekend[{{ $key }}][name]" id="responsibles_weekend_name_{{ $key }}" class="form-control" value="{{ $responsibleWeekend['name'] }}" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="responsibles_weekend_value_{{ $key }}">Ответственный</label>
                                <select name="responsibles_weekend[{{ $key }}][value]" id="responsibles_weekend_value_{{ $key }}" class="form-control" required>
                                    <option value="" selected disabled>- Выберите пользователя -</option>
                                    @foreach ($users as $user)
                                        <option value="{{ $user['id'] }}" @if($user['id'] == $responsibleWeekend['value']) selected @endif>
                                            {{ $user['last_name'] }} {{ $user['first_name'] }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4 mt-3">
                                <button type="button" class="col btn btn-outline-danger" onclick="removeResponsiblesWeekend(this)">Удалить</button>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="row">
                    <div class="col-6">
                        <button type="button" class="col btn btn-success" onclick="addResponsiblesWeekend()">Добавить</button>
                    </div>
                    <div class="col-6">
                        <button type="submit" class="col btn btn-primary">Сохранить</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        let nextResponsiblesWeekendKey = {{ count($responsibles_weekend) }};

        function addResponsiblesWeekend() {
            nextResponsiblesWeekendKey++;
            const container = document.getElementById('responsibles-weekend-container');
            const newRow = document.createElement('div');
            newRow.className = 'row mb-2 align-items-end border p-1';
            newRow.setAttribute('data-key', nextResponsiblesWeekendKey);
            newRow.innerHTML = `
            <div class="col-md-4">
                <div class="form">
                    <label for="responsibles_weekend_name_${nextResponsiblesWeekendKey}">Название:</label>
                    <input type="text" name="responsibles_weekend[${nextResponsiblesWeekendKey}][name]" id="responsibles_weekend_name_${nextResponsiblesWeekendKey}" class="form-control" required>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form">
                    <label for="responsibles_weekend_value_${nextResponsiblesWeekendKey}">Ответственный</label>
                   <select name="responsibles_weekend[${nextResponsiblesWeekendKey}][value]" id="responsibles_weekend_value_${nextResponsiblesWeekendKey}" class="form-control" required>
                    <option value="" selected disabled>- Выберите пользователя -</option>
                    @foreach ($users as $user)
            <option value="{{ $user['id'] }}">
                            {{ $user['last_name'] }} {{ $user['first_name'] }}
            </option>
@endforeach
            </select>
        </div>
                    </div>
                </div>
                <div class="col-md-4 mt-3">
                    <button type="button" class="col btn btn-outline-danger" onclick="removeResponsiblesWeekend(this)">Удалить</button>
                </div>
`;
            container.appendChild(newRow);
        }

        function removeResponsiblesWeekend(button) {
            const container = document.getElementById('responsibles-weekend-container');
            const rowToRemove = button.closest('.row');
            container.removeChild(rowToRemove);
        }
    </script>

    <script>
        $(document).ready(function() {
            @if(isset($key))
            $('#responsibles_weekend_value_{{ $key }}').select2({
                placeholder: 'Введите имя пользователя',
                allowClear: true,
                tags: true,
            });
            @endif
        });
    </script>
    <script>
        $(document).ready(function() {
            // Инициализация Select2 для существующих элементов при загрузке страницы
            $('[id^="responsibles_weekend_value_"]').each(function() {
                $(this).select2({
                    placeholder: 'Введите имя пользователя',
                    allowClear: true,
                    tags: true,
                });
            });
        });
    </script>

