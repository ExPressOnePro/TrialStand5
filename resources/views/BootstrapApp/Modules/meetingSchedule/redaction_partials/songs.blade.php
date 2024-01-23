
<div class="card">
        <div class="card-header">
            <h6 class="lh-sm">
                <i class="bi bi-music-note-beamed"></i>
                Песни, председатель и заключительная молитва
            </h6>
        </div>
        <div class="card-body">
            <form action="{{ route('meetingSchedules.save_songs', $ms->id) }}" method="post">
                @csrf
                <div id="songs-container">
                    @foreach($songs as $key => $song)
                        <div class="row mb-2 d-flex justify-content-between" data-key="{{ $key }}">
                            <div class="col-md-4">
                                <div class="form-floating mb-2">
                                    <select name="songs[{{ $key }}][name]" id="song_name_{{ $key }}" class="form-control" required>
                                        <option value="">-номер песни-</option>
                                        @for ($i = 1; $i <= 151; $i++)
                                            <option value="{{ $i }}" @if($i == $song['name']) selected @endif>{{ $i }}</option>
                                        @endfor
                                    </select>
                                    <label for="song_name_{{ $key }}">номер песни</label>
                                </div>
                            </div>

                        @if($key == 2)
                            @else
                            <div class="col-md-4">
                                <div class="form-floating mb-2">
                                    <input type="text" name="songs[{{ $key }}][value]" id="song_value_{{ $key }}" class="form-control" value="{{ $song['value'] }}" required>
                                    <label for="song_value_{{ $key }}">
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
{{--                                <button type="button" class="col btn btn-outline-danger" onclick="removeSong(this)">Удалить</button>--}}
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="row d-flex justify-content-end">
                    <div class="col-6">
                        <button type="submit" class="col btn btn-primary">Сохранить</button>
                    </div>
                </div>
{{--                <button type="button" class="btn btn-success" onclick="addSong()">Добавить песню</button>--}}
            </form>
        </div>
    </div>


<script>
    let nextSongKey = {{ count($songs) }};

    function addSong() {
        nextSongKey++;
        const container = document.getElementById('songs-container');
        const newRow = document.createElement('div');
        newRow.className = 'row mb-2';
        newRow.setAttribute('data-key', nextSongKey);
        newRow.innerHTML = `
             <div class="col-md-4">
                 <div class="form-floating mb-2">
                <input type="text" name="songs[${nextSongKey}][name]" id="song_name_${nextSongKey}" class="form-control" required>
                <label for="song_name_${nextSongKey}">Название:</label>
</div>
            </div>
             <div class="col-md-4">
                 <div class="form-floating mb-2">
                <input type="text" name="songs[${nextSongKey}][value]" id="song_value_${nextSongKey}" class="form-control" required>
                <label for="song_value_${nextSongKey}">Значение:</label>
            </div>
</div>
             <div class="col-md-4">
                <button type="button" class="col btn btn-outline-danger" onclick="removeSong(this)">Удалить</button>
            </div>
        `;
        container.appendChild(newRow);
    }

    function removeSong(button) {
        const container = document.getElementById('songs-container');
        const rowToRemove = button.closest('.row');
        container.removeChild(rowToRemove);
    }
</script>
