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
                    <div class="row mb-2 d-flex justify-content-between" data-key="{{ $key }}">
                        <div class="col-md-4">
                            <div class="form-floating mb-2">
                                <input type="text" name="public_speech[{{ $key }}][name]" id="speech_name_{{ $key }}" class="form-control" value="{{ $speech['name'] }}" required>
                                <label for="speech_name_{{ $key }}">Название:</label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-floating mb-2">
                                <input type="text" name="public_speech[{{ $key }}][value]" id="speech_value_{{ $key }}" class="form-control" value="{{ $speech['value'] }}" required>
                                <label for="speech_value_{{ $key }}">Значение:</label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <button type="button" class="col btn btn-outline-danger" onclick="removePublicSpeech(this)">Удалить</button>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="row">
                <div class="col-6">
                    <button type="button" class="col btn btn-success" onclick="addPublicSpeech()">Добавить</button>
                </div>
                <div class="col-6">
                    <button type="submit" class="col btn btn-primary">Сохранить</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    let nextPublicSpeechKey = {{ count($public_speech) }};

    function addPublicSpeech() {
        nextPublicSpeechKey++;
        const container = document.getElementById('public-speech-container');
        const newRow = document.createElement('div');
        newRow.className = 'row mb-2';
        newRow.setAttribute('data-key', nextPublicSpeechKey);
        newRow.innerHTML = `
            <div class="col-md-4">
                <div class="form-floating mb-2">
                    <input type="text" name="public_speech[${nextPublicSpeechKey}][name]" id="speech_name_${nextPublicSpeechKey}" class="form-control" required>
                    <label for="speech_name_${nextPublicSpeechKey}">Название:</label>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-floating mb-2">
                    <input type="text" name="public_speech[${nextPublicSpeechKey}][value]" id="speech_value_${nextPublicSpeechKey}" class="form-control" required>
                    <label for="speech_value_${nextPublicSpeechKey}">Значение:</label>
                </div>
            </div>
            <div class="col-md-4">
                <button type="button" class="col btn btn-outline-danger" onclick="removePublicSpeech(this)">Удалить</button>
            </div>
        `;
        container.appendChild(newRow);
    }

    function removePublicSpeech(button) {
        const container = document.getElementById('public-speech-container');
        const rowToRemove = button.closest('.row');
        container.removeChild(rowToRemove);
    }
</script>
