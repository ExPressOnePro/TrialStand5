<div class="card">
    <div class="card-header">
        <h4 class="pb-1 d-flex align-items-center" style="color: #2A6B77">
            <div class="icon-square d-flex align-items-center justify-content-center fs-4 flex-shrink-0 me-3 p-2 rounded-2" style="background-color: #2A6B77; width: 1.5em; height: 1.5em;">
                <img class="rounded-2" src="{{ asset('images/public_speech.svg') }}" style="width: 1.5em; height: 1.5em;">
            </div>
            ПУБЛИЧНАЯ РЕЧЬ
        </h4>
    </div>
    <div class="card-body">
        <form action="{{ route('meetingSchedules.save_public_speech', $ms->id) }}" method="post">
            @csrf
            <div id="public-speech-container">
                @foreach($public_speech as $key => $speech)
                    <div class="row mb-2 d-flex justify-content-between align-items-end border p-1" data-key="{{ $key }}">
                        <div class="col-md-6">
                            <div class="form">
                                <label for="speech_name_{{ $key }}">Название:</label>
                                <input type="text" name="public_speech[{{ $key }}][name]" id="speech_name_{{ $key }}" class="form-control" value="{{ $speech['name'] }}" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form">
                                <label for="speech_value_{{ $key }}">Оратор:</label>

                                {{-- Радиокнопка для выбора между select и input --}}
                                <div class="form-check">
                                    <input type="radio" name="public_speech[{{ $key }}][use_select]" id="use_select_{{ $key }}" class="form-check-input" value="1" checked>
                                    <label class="form-check-label" for="use_select_{{ $key }}">Выбрать из списка</label>
                                </div>
                                <div class="form-check">
                                    <input type="radio" name="public_speech[{{ $key }}][use_select]" id="use_input_{{ $key }}" class="form-check-input" value="0">
                                    <label class="form-check-label" for="use_input_{{ $key }}">Ввести вручную</label>
                                </div>

                                {{-- Select --}}
                                <select name="public_speech[{{ $key }}][value]" id="speech_value_{{ $key }}" class="form-control row" required>
                                    <option value="" selected disabled>- Выберите пользователя -</option>
                                    @foreach ($users as $user)
                                        <option value="{{ $user['id'] }}" @if($user['id'] == $speech['value']) selected @endif>
                                            {{ $user['last_name'] }} {{ $user['first_name'] }}
                                        </option>
                                    @endforeach
                                </select>

                                {{-- Input --}}
                                <input type="text" name="public_speech[{{ $key }}][value_input]" id="speech_value_input_{{ $key }}" class="form-control mt-2" value="{{ $speech['value'] }}" style="display: none;" required>
                            </div>
                        </div>
                    </div>
                    <script>
                        $(document).ready(function() {
                            // Обработчик изменения радиокнопки
                            $('input[name="public_speech[{{ $key }}][use_select]"]').change(function() {
                                var useSelect = $(this).val() === '1';
                                $('#speech_value_{{ $key }}').toggle(useSelect);
                                $('#speech_value_input_{{ $key }}').toggle(!useSelect);

                                // Скрытие/отображение Select2
                                if (useSelect) {
                                    $('#speech_value_{{ $key }}').select2({
                                        placeholder: '- Выберите пользователя -',
                                        allowClear: true,
                                        tags: true,
                                    });
                                } else {
                                    $('#speech_value_{{ $key }}').select2('destroy');
                                }
                            });

                            // Выставление начального состояния
                            var initialUseSelect = $('input[name="public_speech[{{ $key }}][use_select]"]:checked').val() === '1';
                            $('#speech_value_{{ $key }}').toggle(initialUseSelect);
                            $('#speech_value_input_{{ $key }}').toggle(!initialUseSelect);

                            // Инициализация Select2
                            $('#speech_value_{{ $key }}').select2({
                                placeholder: '- Выберите пользователя -',
                                allowClear: true,
                                tags: true,
                            });
                        });
                    </script>
                @endforeach
            </div>

            <div class="row">
                <div class="col-6">
{{--                    <button type="button" class="col btn btn-success" onclick="addPublicSpeech()">Добавить</button>--}}
                </div>
                <div class="col-6">
                    <button type="submit" class="col btn btn-primary">Сохранить</button>
                </div>
            </div>
        </form>

    </div>
</div>

