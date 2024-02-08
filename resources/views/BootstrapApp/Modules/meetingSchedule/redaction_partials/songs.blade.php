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
                    <div class="row mb-2 d-flex justify-content-between align-items-end border p-1" data-key="{{ $key }}">
                        <div class="col-md-4">
                            <label for="song_name_{{ $key }}">Номер песни</label>
                            <select name="songs[{{ $key }}][name]" id="song_name_{{ $key }}" class="form-control" required>
                                <option value="" selected disabled>- Номер песни -</option>
                                @for ($i = 1; $i <= 151; $i++)
                                    <option value="{{ $i }}" @if($i == $song['name']) selected @endif>{{ $i }}</option>
                                @endfor
                            </select>
                        </div>
                        @if($key == 2)
                        @else
                            <div class="col-md-4">
                                <label for="song_value_{{ $key }}">
                                    @if($key == 1)
                                        Председатель
                                    @elseif($key == 3)
                                        Молитва
                                    @endif
                                </label>
                                <select name="songs[{{ $key }}][value]" id="song_value_{{ $key }}" class="form-control" required>
                                    <option value="" selected disabled>- Выберите пользователя -</option>
                                    @foreach ($users as $user)
                                        <option value="{{ $user['id'] }}" @if($user['id'] == ($song['value'] ?? null)) selected @endif>
                                            {{ $user['last_name'] }} {{ $user['first_name'] }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        @endif
                        <script>
                            $(document).ready(function() {
                                @if(isset($key))
                                $('#song_name_{{ $key }}').select2({
                                    placeholder: 'Номер песни',
                                    allowClear: true,
                                    tags: true,
                                });
                                $('#song_value_{{ $key }}').select2({
                                    placeholder: 'Введите имя пользователя',
                                    allowClear: true,
                                    tags: true,
                                });
                                @endif
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


