<div class="d-flex justify-content-between">
    <div class="col">
        <p class="h6 lh-sm">
            <i class="bi bi-music-note-beamed"></i>
            @if($key == 1)
                Песня {{ $song['name'] }} и молитва | Вступительные слова (1 мин.)
            @elseif($key == 2)
                Песня {{ $song['name'] }}
            @elseif($key == 3)
                Заключительные слова (3 мин.) | Песня
                @empty($song['name'])
                    <span class="badge bg-danger">НЕТ ПЕСНИ</span>
                @else
                    {{ $song['name'] }}
                @endempty и молитва
            @endif
        </p>
    </div>
    @if($key != 2)
        <div class="col-auto">
            @empty($song['value']['user_name'])
                @if($key == 1)
                    <p class="h6 text-muted lh-sm">председатель</p>
                @elseif($key == 3)
                    <p class="h6 text-muted lh-sm">молитва</p>
                @endif
            @else
                @if($song['value']['user_id'] == $AuthUserId)
                    <h5 class="text-primary  lh-1"> {{ $song['value']['user_name'] }}</h5>
                @else
                    <h5 class="text-muted">{{ $song['value']['user_name'] }}</h5>
                @endempty
            @endempty
        </div>
    @endif
</div>
