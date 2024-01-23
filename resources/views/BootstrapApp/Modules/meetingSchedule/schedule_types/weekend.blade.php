<div class="row card shadow-lg rounded-4 mb-4">
    <div class="d-flex justify-content-between py-1">
        <div class="col">
            <h3><img class="rounded-2" src="{{ asset('images/watchtower.svg') }}" style="width: 1.5em; height: 1.5em;"> {{ \Carbon\Carbon::parse($ms->weekend_time)->isoFormat('MMMM D, YYYY') }}</h3>
        </div>

    </div>
    <div class="responsibles_users">
        @if(isset($data['weekend']['responsible_users']) && is_array($data['weekend']['responsible_users']) && count($data['weekend']['responsible_users']) > 0)
        <div class="d-none d-md-block">
            <table class="table table-responsive-sm table-bordered table-sm table-warning lh-sm">
                <tbody>
                @foreach($data['weekend']['responsible_users'] as $key => $value)
                    @if ($loop->odd)
                        <tr>
                            @endif
                            <td>
                                <dd>
                                    @empty($value['name'])
                                        Название службы
                                    @else
                                        {{ $value['name'] }}
                                    @endempty
                                </dd>
                            </td>

                            <td>
                                <dd>
                                    @empty($value['value'])
                                        Нет возвещателя
                                    @else
                                        {{ $value['value'] }}
                                    @endempty
                                </dd>
                            </td>

                            @if ($loop->even || $loop->last)
                        </tr>
                    @endif
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="d-sm-none">
            <table class="table table-responsive-sm table-bordered table-sm table-warning lh-sm">
                <tbody>
                @foreach($data['weekend']['responsible_users'] as $key => $value)
                    <tr>
                        <td>
                                            <dd>
                                                @empty($value['name'])
                                                    Название службы
                                                @else
                                                    {{ $value['name'] }}
                                                @endempty
                                            </dd>
                        </td>
                        <td>
                                            <dd>
                                                @empty($value['value'])
                                                    Нет возвещателя
                                                @else
                                                    {{ $value['value'] }}
                                                @endempty
                                            </dd>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        @else
            <p>Нет данных.</p>
        @endif
    </div>
    <div class="song_1">
        @if(isset($data['weekend']['songs']['1']) && is_array($data['weekend']['songs']['1']) && count($data['weekend']['songs']['1']) > 0)
        <div class="d-flex justify-content-between">
            <div class="col">
                <p class="h6 lh-sm">
                    <i class="bi bi-music-note-beamed"></i>
                    Песня
                    @empty($data['weekend']['songs']['1']['name'])
                        <span class="badge bg-danger">НЕТ ПЕСНИ</span>
                    @else
                        {{ $data['weekend']['songs']['1']['name'] }}
                    @endempty
                    и молитва | Вступительные слова (1 мин.)
                </p>
            </div>
            <div class="col-auto">
                @empty($data['weekend']['songs']['1']['value'])
                    <h5>председатель</h5>
                @else
                    <h5>{{ $data['weekend']['songs']['1']['value'] }}</h5>
                @endempty
            </div>
        </div>
        @else
            <p>Нет данных.</p>
        @endif
    </div>
    <div class="public_speech">
        @if(isset($data['weekend']['public_speech']) && is_array($data['weekend']['public_speech']) && count($data['weekend']['public_speech']) > 0)
        <h4 class="pb-1 d-flex align-items-center" style="color: #2A6B77">
            <div class="icon-square d-flex align-items-center justify-content-center fs-4 flex-shrink-0 me-3 p-2 rounded-2" style="background-color: #2A6B77; width: 1.5em; height: 1.5em;">
                <img class="rounded-2" src="{{ asset('images/public_speech.svg') }}" style="width: 1.5em; height: 1.5em;">
            </div>
           ПУБЛИЧНАЯ РЕЧЬ
        </h4>
        @foreach($data['weekend']['public_speech'] as $key => $value)
            <div class="d-flex justify-content-between align-items-center border-bottom">
                <div class="col">
                    <h5 style="color: #2A6B77">
                        @empty($value['name'])
                            название пункта программы
                        @else
                            {{ $value['name'] }}
                        @endempty
                    </h5>
                </div>
                <div class="col-auto">
                    <h5 class="text-muted">
                        @empty($value['value'])
                            ведущий пункта
                        @else
                            {{ $value['value'] }}
                        @endempty
                    </h5>
                </div>
            </div>
        @endforeach
        @else
            <p>Нет данных.</p>
        @endif
    </div>
    <div class="song_2">
        @if(isset($data['weekend']['songs']['2']) && is_array($data['weekend']['songs']['2']) && count($data['weekend']['songs']['2']) > 0)
        <div class="d-flex justify-content-between">
            <div class="col">
            <span class="h6 lh-sm">
                <i class="bi bi-music-note-beamed"></i>
                Песня
                @empty($data['weekend']['songs']['2']['name'])
                    <span class="badge bg-danger">НЕТ ПЕСНИ</span>
                @else
                    {{ $data['weekend']['songs']['2']['name'] }}
                @endempty
            </span>
            </div>
        </div>
        @else
            <p>Нет данных.</p>
        @endif
    </div>
    <div class="watchtower py-1">
        @if(isset($data['weekend']['public_speech']) && is_array($data['weekend']['public_speech']) && count($data['weekend']['public_speech']) > 0)
        <h4 class="pb-1 mb-1 d-flex align-items-center" style="color: #2B3F60">
            <div class="icon-square d-flex align-items-center justify-content-center fs-4 flex-shrink-0 me-3 p-2 rounded-2" style="background-color: #2B3F60; width: 1.5em; height: 1.5em;">
                <img class="rounded-2" src="{{ asset('images/watchtower_icon.svg') }}" style="width: 1.5em; height: 1.5em;">
            </div>
            ИЗУЧЕНИЕ СТАТЬИ ИЗ СТОРОЖЕВОЙ БАШНИ
        </h4>
        @foreach($data['weekend']['watchtower'] as $key => $value)
            <div class="d-flex justify-content-between align-items-center border-bottom">
                <div class="col">
                    <h5 style="color: #2B3F60">
                        @empty($value['name'])
                            название пункта программы
                        @else
                            {{ $value['name'] }}
                        @endempty
                    </h5>
                </div>
                <div class="col-auto">
                    <h5 class="text-muted">
                        @empty($value['value'])
                            ведущий пункта
                        @else
                            {{ $value['value'] }}
                        @endempty
                        @isset($value['value_2'])
                            @empty($value['value_2'])
                                <br> чтец
                            @else
                                <br> {{ $value['value_2'] }}
                            @endempty
                        @endisset
                    </h5>
                </div>
            </div>
        @endforeach
        @else
            <p>Нет данных.</p>
        @endif
    </div>
    <div class="song_3">
        @if(isset($data['weekend']['songs']['3']) && is_array($data['weekend']['songs']['3']) && count($data['weekend']['songs']['3']) > 0)
        <div class="d-flex justify-content-between">
            <div class="col justify-content-between">
                <p class="h6 lh-sm">
                    <i class="bi bi-music-note-beamed"></i>
                    Песня
                    @empty($data['weekend']['songs']['3']['name'])
                        <span class="badge bg-danger">НЕТ ПЕСНИ</span>
                    @else
                        {{$data['weekend']['songs']['3']['name']}}
                    @endempty и молитва
                </p>
            </div>
            <div class="col-auto">
                <h5 class="text-muted">
                    @empty($data['weekend']['songs']['3']['value'])
                        председатель
                    @else
                        {{ $data['weekend']['songs']['3']['value'] }}
                    @endempty
                </h5>
            </div>
        </div>
        @else
            <p>Нет данных.</p>
        @endif
    </div>
</div>
