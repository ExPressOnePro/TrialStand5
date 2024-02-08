<div class="card">
    <div class="card-header">
        <h6 class="lh-sm">
            <i class="bi bi-music-note-beamed"></i>
            Песни, председатель и заключительная молитва
        </h6>
    </div>
    <style>
        .select2-container {
            width: 100% !important;
        }
    </style>
    <div class="card-body">
        <form action="{{ route('meetingSchedules.save_songs_weekend', $ms->id) }}" method="post">
            @csrf
            <div id="songs-weekend-container">
                @foreach($songs_weekend as $key_song_weekend => $song_weekend)
                    <div class="row mb-2 d-flex justify-content-between align-items-end border p-1" data-key="{{ $key_song_weekend }}">
                        <div class="col-md-4">
                            <label for="song_weekend_name_{{ $key_song_weekend }}">Номер песни</label>
                            <select name="songs_weekend[{{ $key_song_weekend }}][name]" id="song_weekend_name_{{ $key_song_weekend }}" class="form-control" required>
                                <option value="" selected disabled>- Номер песни -</option>
                                @for ($i = 1; $i <= 151; $i++)
                                    <option value="{{ $i }}" @if($i == $song_weekend['name']) selected @endif>{{ $i }}</option>
                                @endfor
                            </select>
                        </div>
                        @if($key_song_weekend == 2)
                        @else
                            <div class="col-md-4">
                                <label for="song_weekend_value_{{ $key_song_weekend }}">
                                    @if($key_song_weekend == 1)
                                        Председатель
                                    @elseif($key_song_weekend == 3)
                                        Молитва
                                    @endif
                                </label>
                                <select name="songs_weekend[{{ $key_song_weekend }}][value]" id="song_weekend_value_{{ $key_song_weekend }}" class="form-control row" required>
                                    <option value="" selected disabled>- Выберите пользователя -</option>
                                    @foreach ($users as $user)
                                        <option value="{{ $user['id'] }}" @if($user['id'] == $song_weekend['value']) selected @endif>
                                            {{ $user['last_name'] }} {{ $user['first_name'] }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        @endif
                        <script>
                            $(document).ready(function() {
                                $('#song_weekend_name_{{ $key_song_weekend }}').select2({
                                    placeholder: 'Номер песни',
                                    allowClear: true,
                                    tags: true,
                                });
                                $('#song_weekend_value_{{ $key_song_weekend }}').select2({
                                    placeholder: 'Введите имя пользователя',
                                    allowClear: true,
                                    tags: true,
                                });
                            });
                        </script>
                        <div class="col-md-4"></div>
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



