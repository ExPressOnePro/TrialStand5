
    <div class="card">
        <div class="card-header">
            <h3>Службы ответственных</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('meetingSchedules.save_responsibles_weekend', $ms->id) }}" method="post">
                @csrf
                <div id="responsibles-weekend-container">
                    @foreach($responsibles_weekend as $key => $responsibleWeekend)
                        <div class="row mb-2 d-flex justify-content-between" data-key="{{ $key }}">
                            <div class="col-md-4">
                                <div class="form-floating mb-2">
                                    <input type="text" name="responsibles_weekend[{{ $key }}][name]" id="responsibles_weekend_name_{{ $key }}" class="form-control" value="{{ $responsibleWeekend['name'] }}" required>
                                    <label for="responsibles_weekend_name_{{ $key }}">Название:</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-floating mb-2">
                                    <input type="text" name="responsibles_weekend[{{ $key }}][value]" id="responsibles_weekend_value_{{ $key }}" class="form-control" value="{{ $responsibleWeekend['value'] }}" required>
                                    <label for="responsibles_weekend_value_{{ $key }}">Значение:</label>
                                </div>
                            </div>
                            <div class="col-md-4">
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
            newRow.className = 'row mb-2';
            newRow.setAttribute('data-key', nextResponsiblesWeekendKey);
            newRow.innerHTML = `
            <div class="col-md-4">
                <div class="form-floating mb-2">
                    <input type="text" name="responsibles_weekend[${nextResponsiblesWeekendKey}][name]" id="responsibles_weekend_name_${nextResponsiblesWeekendKey}" class="form-control" required>
                    <label for="responsibles_weekend_name_${nextResponsiblesWeekendKey}">Название:</label>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-floating mb-2">
                    <input type="text" name="responsibles_weekend[${nextResponsiblesWeekendKey}][value]" id="responsibles_weekend_value_${nextResponsiblesWeekendKey}" class="form-control" required>
                    <label for="responsibles_weekend_value_${nextResponsiblesWeekendKey}">Значение:</label>
                </div>
            </div>
            <div class="col-md-4">
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



