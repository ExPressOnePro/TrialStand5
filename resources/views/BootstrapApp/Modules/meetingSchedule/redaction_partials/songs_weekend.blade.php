<div class="card">
    <div class="card-header">
        <h6 class="lh-sm">
            <i class="bi bi-music-note-beamed"></i>
            Песни, председатель и заключительная молитва (выходные)
        </h6>
    </div>
    <div class="card-body">
        <form action="{{ route('meetingSchedules.save_songs_weekend', $ms->id) }}" method="post">
            @csrf
            <div id="songs-weekend-container">
                @foreach($songs_weekend as $key => $song_weekend)
                    <div class="row mb-2 d-flex justify-content-between" data-key="{{ $key }}">
                        <div class="col-md-4">
                            <div class="form-floating mb-2">
                                <select name="songs_weekend[{{ $key }}][name]" id="song_weekend_name_{{ $key }}" class="form-control" required>
                                    <option value="">-номер песни-</option>
                                    @for ($i = 1; $i <= 151; $i++)
                                        <option value="{{ $i }}" @if($i == $song_weekend['name']) selected @endif>{{ $i }}</option>
                                    @endfor
                                </select>
                                <label for="song_weekend_name_{{ $key }}">номер песни</label>
                            </div>
                        </div>

                        @if($key == 2)
                        @else
                            <div class="col-md-4">
                                <div class="form-floating mb-2">
                                    <input type="text" name="songs_weekend[{{ $key }}][value]" id="song_weekend_value_{{ $key }}" class="form-control" value="{{ $song_weekend['value'] }}" required>
                                    <label for="song_weekend_value_{{ $key }}">
                                        @if($key == 1)
                                            Председатель
                                        @elseif($key == 3)
                                            Молитва
                                        @endif
                                    </label>
                                </div>
                            </div>
                        @endif
                        <div class="col-md-4">
{{--                            <button type="button" class="col btn btn-outline-danger" onclick="removeSongWeekend(this)">Удалить</button>--}}
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="row d-flex justify-content-end">
                <div class="col-6">
                    <button type="submit" class="col btn btn-primary">Сохранить</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    let nextSongWeekendKey = {{ count($songs_weekend) }};

    function addSongWeekend() {
        nextSongWeekendKey++;
        const container = document.getElementById('songs-weekend-container');
        const newRow = document.createElement('div');
        newRow.className = 'row mb-2';
        newRow.setAttribute('data-key', nextSongWeekendKey);
        newRow.innerHTML = `
             <div class="col-md-4">
                 <div class="form-floating mb-2">
                    <input type="text" name="songs_weekend[${nextSongWeekendKey}][name]" id="song_weekend_name_${nextSongWeekendKey}" class="form-control" required>
                    <label for="song_weekend_name_${nextSongWeekendKey}">Название:</label>
                 </div>
             </div>
             <div class="col-md-4">
                 <div class="form-floating mb-2">
                    <input type="text" name="songs_weekend[${nextSongWeekendKey}][value]" id="song_weekend_value_${nextSongWeekendKey}" class="form-control" required>
                    <label for="song_weekend_value_${nextSongWeekendKey}">Значение:</label>
                </div>
             </div>
             <div class="col-md-4">
                <button type="button" class="col btn btn-outline-danger" onclick="removeSongWeekend(this)">Удалить</button>
             </div>
        `;
        container.appendChild(newRow);
    }

    function removeSongWeekend(button) {
        const container = document.getElementById('songs-weekend-container');
        const rowToRemove = button.closest('.row');
        container.removeChild(rowToRemove);
    }
</script>
