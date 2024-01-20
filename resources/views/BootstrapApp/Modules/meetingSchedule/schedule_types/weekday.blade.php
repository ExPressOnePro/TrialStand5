<div class="row card mb-4">
    <div class="d-flex justify-content-between py-1">
        <div class="col">
            <h3>{{ \Carbon\Carbon::parse($ms->date)->isoFormat('MMMM D, YYYY') }}</h3>
        </div>
        <div class="col-auto">
            <a class="btn btn-outline-secondary" href="{{route('meetingSchedules.redaction', $ms->id)}}">
                <i class="bi bi-pencil"></i>
            </a>
        </div>
    </div>
    <div class="d-none d-md-block">
        <table class="table table-responsive-sm table-bordered table-sm table-warning lh-sm">
            <tbody>
            @foreach($data['responsible_users'] as $key => $value)
                @if ($loop->odd)
                    <tr>
                        @endif
                        <td>
                            <small>
                                @empty($value['name'])
                                    Название службы
                                @else
                                    {{ $value['name'] }}
                                @endempty
                            </small>
                        </td>

                        <td>
                            <small>
                                @empty($value['value'])
                                    Нет возвещателя
                                @else
                                    {{ $value['value'] }}
                                @endempty
                            </small>
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
            @foreach($data['responsible_users'] as $key => $value)
                <tr>
                    <td>
                                            <span>
                                                @empty($value['name'])
                                                    Название службы
                                                @else
                                                    {{ $value['name'] }}
                                                @endempty
                                            </span>
                    </td>
                    <td>
                                            <span>
                                                @empty($value['value'])
                                                    Нет возвещателя
                                                @else
                                                    {{ $value['value'] }}
                                                @endempty
                                            </span>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <div class="d-flex justify-content-between">
        <div class="col">
            <p class="lh-sm">
                <i class="bi bi-music-note-beamed"></i>
                Песня
                @empty($data['songs']['1']['name'])
                    <span class="badge bg-danger">НЕТ ПЕСНИ</span>
                @else
                    {{ $data['songs']['1']['name'] }}
                @endempty и молитва | Вступительные слова (1 мин.)</p>
        </div>
        <div class="col-auto">
            @empty($data['songs']['1']['value'])
                председатель
            @else
                {{ $data['songs']['1']['value'] }}
            @endempty
        </div>
    </div>
    <div class="treasures">
        <h4 class="pb-1 d-flex align-items-center" style="color: #2A6B77">
            <div class="icon-square d-flex align-items-center justify-content-center fs-4 flex-shrink-0 me-3 p-2 rounded-2" style="background-color: #2A6B77; width: 1.5em; height: 1.5em;">
                <img class="rounded-2" src="{{ asset('front/img/gem.svg') }}" style="width: 1.5em; height: 1.5em;">
            </div>
            СОКРОВИЩА ИЗ СЛОВА БОГА
        </h4>
        @foreach($data['treasures'] as $key => $value)
            <div class="d-flex justify-content-between align-items-center border-bottom">
                <div class="col">
                    <h6 style="color: #2A6B77">
                        @empty($value['name'])
                            название пункта программы
                        @else
                            {{ $value['name'] }}
                        @endempty
                    </h6>
                </div>
                <div class="col-auto">
                    <h6 class="text-muted">
                        @empty($value['value'])
                            ведущий пункта
                        @else
                            {{ $value['value'] }}
                        @endempty
                    </h6>
                </div>
            </div>
        @endforeach
    </div>
    <div class="field_ministry py-1">
        <h4 class="pb-1 mb-1 d-flex align-items-center" style="color: #D68F00">
            <div class="icon-square d-flex align-items-center justify-content-center fs-4 flex-shrink-0 me-3 p-2 rounded-2" style="background-color: #D68F00; width: 1.5em; height: 1.5em;">
                <img class="rounded-2" src="{{ asset('front/img/wheat.svg') }}" style="width: 1.5em; height: 1.5em;">
            </div>
            ОТТАЧИВАЕМ НАВЫКИ СЛУЖЕНИЯ
        </h4>
        @foreach($data['field_ministry'] as $key => $value)
            <div class="d-flex justify-content-between align-items-center border-bottom">
                <div class="col">
                    <h6 style="color: #D68F00">
                        @empty($value['name'])
                            название пункта программы
                        @else
                            {{ $value['name'] }}
                        @endempty
                    </h6>
                </div>
                <div class="col-auto d-sm-none">
                    <h6 class="text-muted">
                        @empty($value['value'])
                            ведущий пункта
                        @else
                            {{ $value['value'] }}
                        @endempty
                        @isset($value['value_2'])
                            @empty($value['value_2'])
                                <br> ведущий пункта
                            @else
                                <br> {{ $value['value_2'] }}
                            @endempty
                        @endisset
                    </h6>
                </div>
                <div class="col-auto d-none d-md-block">
                    <h6 class="text-muted"> @empty($value['value'])
                            ведущий пункта
                        @else
                            {{ $value['value'] }}
                        @endempty
                        @isset($value['value_2'])
                            @empty($value['value_2'])
                                | ведущий пункта
                            @else
                                | {{ $value['value_2'] }}
                            @endempty
                        @endisset  </h6>
                </div>
            </div>
        @endforeach
    </div>
    <div class="d-flex justify-content-between">
        <div class="col">
            <span class="lh-sm">
                <i class="bi bi-music-note-beamed"></i>
                Песня
                @empty($data['songs']['2']['name'])
                    <span class="badge bg-info">НЕТ ПЕСНИ</span>
                @else
                    {{ $data['songs']['2']['name'] }}
                @endempty
            </span>
        </div>
    </div>
    <div class="living py-1">
        <h4 class="pb-1 mb-1 d-flex align-items-center" style="color: #BF2F13">
            <div class="icon-square d-flex align-items-center justify-content-center fs-4 flex-shrink-0 me-3 p-2 rounded-2" style="background-color: #BF2F13; width: 1.5em; height: 1.5em;">
                <img class="rounded-2" src="{{ asset('front/img/sheep.svg') }}" style="width: 1.5em; height: 1.5em;">
            </div>
            ХРИСТИАНСКАЯ ЖИЗНЬ
        </h4>
        @foreach($data['living'] as $key => $value)
            <div class="d-flex justify-content-between align-items-center border-bottom">
                <div class="col">
                    <h6 style="color: #BF2F13">
                        @empty($value['name'])
                            название пункта программы
                        @else
                            {{ $value['name'] }}
                        @endempty
                    </h6>
                </div>
                <div class="col-auto">
                    <h6 class="text-muted">
                        @empty($value['value'])
                            ведущий пункта
                        @else
                            {{ $value['value'] }}
                        @endempty
                    </h6>
                </div>
            </div>
        @endforeach
    </div>
    <div class="d-flex justify-content-between">
        <div class="col justify-content-between">
            <p class="lh-sm">
                <i class="bi bi-music-note-beamed"></i>
                Заключительные слова (3 мин.) |
                Песня
                @empty($data['songs']['3']['name'])
                    <span class="badge bg-info">НЕТ ПЕСНИ</span>
                @else
                    {{$data['songs']['3']['name']}}
                @endempty и молитва
            </p>
        </div>
        <div class="col-auto">
            <h6 class="text-muted">
                @empty($data['songs']['3']['value'])
                    председатель
                @else
                    {{ $data['songs']['3']['value'] }}
                @endempty
            </h6>
        </div>
    </div>
</div>
