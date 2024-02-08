@can('module.schedule')
    @if(empty($result['data']))
        <a class="text-muted text-decoration-none" href="{{route('meetingSchedules.schedule', $result['info']['schedule_id'])}}">
            <div class="my-3 p-3 bg-body rounded-4 shadow-sm">
                <h3 class="pb-2 mb-0">Расписание встречи собрания</h3>
                <p class="h5 pb-2 mb-0">неделя от {{$result['info']['week_from']}}</p>
                <p class="h6 text-muted pb-2 mb-0">нажмите чтобы просмотреть...</p>
            </div>
        </a>
        @elseif($result['data'] === 'NONE')
            <div class="my-3 p-3 bg-body rounded-4 shadow-sm">
                <h3 class="pb-2 mb-0">Расписание встречи собрания</h3>
                <p class="h5 pb-2 mb-0">для этой недели не составлено</p>
            </div>
        @else
        <div class="my-3 p-3 bg-body rounded-4 shadow-sm">
            <h3 class="pb-2 mb-0">Мои обязанности на встречах собрания</h3>
            <p class="h5 text-muted border-bottom pb-2 mb-0">неделя от {{$result['info']['week_from']}}</p>

            @foreach($result['data'] as $key => $res)
                <div class="d-flex pt-3">
                    <div class="pb-3 mb-0 small lh-sm border-bottom w-100">

                        <h3 class="d-block text-muted">
                            <strong class="d-inline-block">
                                @if (in_array('weekday', $result['data']))
                                    {{$result['info']['weekday_time']}}
                                @else
                                    {{$result['info']['weekend_time']}}
                                @endif
                            </strong>
                        </h3>
                        @if(in_array('field_ministry', $res['value']))
                            <h5 class="d-block" style="color: #D68F00;">
                                <strong class="d-inline-block">
                                    ОТТАЧИВАЕМ НАВЫКИ СЛУЖЕНИЯ
                                </strong>
                            </h5>
                        @elseif (in_array('treasures', $res['value']))
                            <h5 class="d-block" style="color: #2A6B77;">
                                <strong class="d-inline-block">
                                    СОКРОВИЩА ИЗ СЛОВА БОГА
                                </strong>
                            </h5>
                        @elseif (in_array('living', $res['value']))
                            <h5 class="d-block" style="color: #BF2F13;">
                                <strong class="d-inline-block">
                                    ХРИСТИАНСКАЯ ЖИЗНЬ
                                </strong>
                            </h5>
                        @elseif (in_array('songs', $res['value']) && in_array('1', $res['value']))
                            <h5 class="d-block" style="color: #2A6B77;">
                                <strong class="d-inline-block">
                                    ПРЕДСЕДАТЕЛЬ
                                </strong>
                            </h5>
                        @elseif (in_array('songs', $res['value']) && in_array('3', $res['value']))
                            <h5 class="d-block" style="color: #2A6B77;">
                                <strong class="d-inline-block">
                                    МОЛИТВА
                                </strong>
                            </h5>
                        @elseif (in_array('responsible_users', $res['value']))
                            <h5 class="d-block text-secondary">
                                <strong class="d-inline-block">
                                    ОТВЕТСТВЕННОСТЬ
                                </strong>
                            </h5>
                        @elseif (in_array('watchtower', $res['value']))
                            <h5 class="d-block" style="color: #2B3F60;">
                                <strong class="d-inline-block">
                                    ИЗУЧЕНИЕ СТАТЬИ ИЗ СТОРОЖЕВОЙ БАШНИ
                                </strong>
                            </h5>
                        @elseif (in_array('public_speech', $res['value']))
                            <h5 class="d-block" style="color: #2A6B77;">
                                <strong class="d-inline-block">
                                    ПУБЛИЧНАЯ РЕЧЬ
                                </strong>
                            </h5>
                        @endif
                        <h5 class="d-block">
                            <strong>
                                @if(in_array('songs', $res['value']) && in_array('1', $res['value']) || in_array('songs', $res['value']) && in_array('3', $res['value']) )
                                @else
                                {{$res['name']}}
                                @endif
                            </strong>
                        </h5>
                    </div>
                </div>
            @endforeach
            <div class="row mt-3">
                <a class="text-decoration-none btn " href="{{route('meetingSchedules.schedule', $result['info']['schedule_id'])}}">
                    открыть расписание
                </a>
            </div>
        </div>
    @endempty
{{--    @foreach($result as $key => $res)--}}
{{--        {{$res}}--}}

{{--    @endforeach--}}
@endcan
