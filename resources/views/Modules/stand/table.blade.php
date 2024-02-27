<style>
    .border-left-full {
        border-left: 4px solid #28a745; /* Используйте нужный вам цвет вместо #28a745 */
    }
    .border-left-half {
        border-left: 4px solid #CAA830; /* Используйте нужный вам цвет вместо #28a745 */
    }
    .border-left-empty {
        border-left: 4px solid rgba(123, 123, 123, 0.7); /* Используйте нужный вам цвет вместо #28a745 */
    }
    .bg-full {
        background-color: rgba(30, 114, 227, 0.15); /* Используйте нужный вам цвет вместо #28a745 */
    }
    .bg-half {
        background-color: rgba(255, 210, 52, 0.29); /* Используйте нужный вам цвет вместо #28a745 */
    }
</style>

<div class="row">
@foreach ($schedule as $day)
    <div class="col-sm-12 col-md-6 col-lg-4 mb-5">
        <div class="card card-header card-header-content-between rounded text-center" style="background: rgba(153,102,204,0.5)">
            <p class="card-header-title h5 dd">{{ $day['date'] }}</p>
        </div>

        @foreach ($day['times'] as $time)
            <div class="col-sm-12 mt-1">
                <a class="card rounded-3 text-decoration-none shadow
                @if (count($time['users']) >= 2)
                    border-left-full bg-full
                    @elseif(count($time['users']) <= 2 && count($time['users']) >= 1)
                    border-left-half bg-half
                    @elseif(count($time['users']) == 0)
                    border-left-empty
                    @endif"
                @if (count($time['users']) >= 1)
                    onclick="openModalRedaction('{{$time['standPublisher_id']}}')"
                    @endif>
                    <div class="d-flex align-items-center">
                        <!-- time -->
                        <div class="col-3 text-center">
                            <p class="h5"><strong>{{ $time['time'] }}</strong></p>
                        </div>
                        <div class="col ms-0 d-flex" style="height: 50px;" data-max-width="1px">
                            <div class="vr"></div>
                        </div>
                        <div class="col-8">
                            <div class="mt-1 mb-0">
                                @if(count($time['users']) == 0 )
                                    <p class="h5 my-3"><span class="badge bg-secondary">{{ __('text.Свободно') }}</span></p>
                                @elseif( count($time['users']) == 1 )
                                    @foreach ($time['users'] as $user)
                                        @if($user['id'] == Auth::id())
                                            <p class="h5 dd">
                                                <strong>
                                                    {{ $user['user_name'] }}
                                                </strong>
                                            </p>
                                        @else
                                            <p class="h5 text-muted">{{ $user['user_name'] }}</p>
                                        @endif
                                    @endforeach
                                    <p class="h5"><span class="badge bg-secondary">{{ __('text.Свободно') }}</span></p>
                                @elseif( count($time['users']) > 1 )
                                    @foreach ($time['users'] as $user)
                                        @if($user['id'] == Auth::id())
                                            <p class="h5 dd">
                                                <strong>
                                                    {{ $user['user_name'] }}
                                                </strong>
                                            </p>
                                        @else
                                            <p class="h5 text-muted">{{ $user['user_name'] }}</p>
                                        @endif
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            @can('stand.make_entry')
{{--                <div class="modal fade" id="redaction{{$gwe}}" tabindex="-1" aria-labelledby="redaction"--}}
{{--                     aria-hidden="true">--}}
{{--                    <div class="modal-dialog modal-fullscreen-sm-down">--}}
{{--                        <div class="modal-content">--}}
{{--                            <div class="modal-header">--}}
{{--                                <h1 class="modal-title fs-4" id="exampleModalFullscreenLabel">{{ __('text.Информация о записи') }}</h1>--}}
{{--                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>--}}
{{--                            </div>--}}
{{--                            <div class="modal-body">--}}

{{--                                @include('Mobile.includes.loadingOverlay')--}}

{{--                                <style>--}}
{{--                                    .overlay {--}}
{{--                                        position: fixed;--}}
{{--                                        top: 0;--}}
{{--                                        left: 0;--}}
{{--                                        width: 100%;--}}
{{--                                        height: 100%;--}}
{{--                                        background: rgba(255, 255, 255, 0.7);--}}
{{--                                        display: flex;--}}
{{--                                        justify-content: center;--}}
{{--                                        align-items: center;--}}
{{--                                        z-index: 9999;--}}
{{--                                    }--}}

{{--                                    .spinner-border {--}}
{{--                                        width: 3rem;--}}
{{--                                        height: 3rem;--}}
{{--                                    }--}}
{{--                                </style>--}}

{{--                                <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">--}}
{{--                                    <div class="col p-4 d-flex flex-column position-static">--}}
{{--                                        <h3 class="mb-0">{{$stand->name}}</h3>--}}
{{--                                        <h3 class="mb-0">{{ __('text.Дата') }}:  {{ \Carbon\Carbon::parse($gwe)->format('d.m.Y') }}</h3>--}}
{{--                                        <h3 class="mb-0">{{ __('text.Время') }}:  {{ date('H:i', strtotime($time)) }}</h3>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="row justify-content-center">--}}
{{--                                    <div class="col-lg-12 mb-3 mb-lg-5 mx-auto">--}}
{{--                                        <div class="card card-hover-shadow border-secondary mt-4">--}}
{{--                                            <div class="card-body">--}}
{{--                                                <div class="d-flex align-items-center">--}}
{{--                                                    <div class="flex-grow-1">--}}
{{--                                                        <h3 class="text-inherit mb-4">{{ __('text.возвещатель') }}</h3>--}}
{{--                                                        <form id="recordStandFirst" method="post" action="{{ route('NewRecordStand2') }}">--}}
{{--                                                            @csrf--}}
{{--                                                            <input type="hidden" name="time1" id="time" value="{{ $time }}">--}}
{{--                                                            <input type="hidden" name="date1" id="date" value="{{$gwe}}">--}}
{{--                                                            <input type="hidden" name="day1" id="day" value="{{$day}}">--}}
{{--                                                            <input type="hidden" name="stand_template_id1" id="stand_template_id" value="{{$StandTemplate->id}}">--}}
{{--                                                            <div class="tom-select-custom">--}}
{{--                                                                <select class="js-select form-select border-secondary" autocomplete="off" name="user_1" id="user_1"--}}
{{--                                                                        data-hs-tom-select-options='{--}}
{{--              "placeholder": "<div><i class=\"bi-person me-2\"></i> Select member</div>",--}}
{{--              "hideSearch": true,--}}
{{--              "width": "20rem"--}}
{{--            }'>--}}
{{--                                                                    @foreach ($users as $user)--}}
{{--                                                                        @if (auth()->user()->id == $user->id)--}}
{{--                                                                            <option value="{{ $user->id }}" selected>{{ $user->last_name }} {{ $user->first_name }}</option>--}}
{{--                                                                        @else--}}
{{--                                                                            <option value="{{ $user->id }}">{{ $user->last_name }} {{ $user->first_name }}</option>--}}
{{--                                                                        @endif--}}
{{--                                                                    @endforeach--}}

{{--                                                                </select>--}}
{{--                                                            </div>--}}

{{--                                                            <div class="row mt-4">--}}
{{--                                                                <div class="col-12">--}}
{{--                                                                    <div class="d-grid gap-2">--}}
{{--                                                                        <button class="btn btn-success" type="submit">--}}
{{--                                                                            {{ __('text.Записать') }}--}}
{{--                                                                        </button>--}}
{{--                                                                    </div>--}}
{{--                                                                </div>--}}
{{--                                                            </div>--}}
{{--                                                        </form>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="modal-footer">--}}
{{--                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
                @isset($time['standPublisher_id'])
                    <div class="modal fade" id="Redaction{{$time['standPublisher_id']}}" tabindex="-1" aria-labelledby="exampleModalFullscreenLabel"
                         aria-hidden="true">
                        <div class="modal-dialog modal-fullscreen-sm-down">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-4" id="exampleModalFullscreenLabel">{{ __('text.Информация о записи') }}</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    @include('Mobile.includes.loadingOverlay')

                                    <style>
                                        .overlay {
                                            position: fixed;
                                            top: 0;
                                            left: 0;
                                            width: 100%;
                                            height: 100%;
                                            background: rgba(255, 255, 255, 0.7);
                                            display: flex;
                                            justify-content: center;
                                            align-items: center;
                                            z-index: 9999;
                                        }

                                        .spinner-border {
                                            width: 3rem;
                                            height: 3rem;
                                        }
                                    </style>

                                    <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                                        <div class="col p-4 d-flex flex-column position-static">
                                            <h3 class="mb-0">{{ __('text.Стенд') }}: {{$stand->name}}</h3>
                                            <h3 class="mb-0">{{ __('text.Дата') }}:  {{$day['date']}}</h3>
                                            <h3 class="mb-0">{{ __('text.Время') }}:  {{ $time['time'] }}</h3>
                                        </div>
                                    </div>
                                    @for ($i = 1; $i <= $valuePublishers_at_stand; $i++)
{{--                                        @php--}}
{{--                                            $userKey = "user_$i";--}}
{{--                                            $isUserEmpty = empty($publishers[$userKey] ?? null);--}}
{{--                                            $currentUser = auth()->id();--}}
{{--                                            $isCurrentUser = ($currentUser == ($publishers[$userKey] ?? null) && !$publishers[$userKey]);--}}
{{--                                            $userLabel = $isUserEmpty ?  __('text.Пусто')  : __('text.Записан');--}}
{{--                                        @endphp--}}

                                        <div class="card card-hover-shadow border-secondary mt-4">
                                            <div class="card-body">
                                                <div class="d-flex align-items-center mb-2">
                                                    <div class="flex-grow-1">
                                                        <h3 class="text-inherit mb-1">{{ $i === 1 ? __('text.Первый') : ($i === 2 ? __('text.Второй') : ($i === 3 ? __('text.Третий') : __('text.Четвертый') )) }} {{ __('text.возвещатель') }}
{{--                                                            @if($isUserEmpty)--}}
{{--                                                                <span class="badge bg-secondary">{{ $userLabel }}</span>--}}
{{--                                                            @else--}}
{{--                                                                <span class="badge bg-info">{{ $userLabel }}</span>--}}
{{--                                                            @endif--}}
                                                        </h3>

{{--                                                        <form id="changeForm{{ $i }}" method="post" action="{{ route('AddPublisherToStand2', ['id' => $standPublisher->id, 'stand' => $stand->id, 'user_id' => $user->id]) }}">--}}
{{--                                                            @csrf--}}
{{--                                                            <div class="tom-select-custom">--}}
{{--                                                                <select class="js-select form-select" autocomplete="off" name="user_id" id="user_id" @if($isUserEmpty) @else disabled readonly @endif>--}}
{{--                                                                    @php--}}
{{--                                                                        $currentUser = auth()->user();--}}
{{--                                                                    @endphp--}}

{{--                                                                    <option value="{{ $currentUser->id }}" {{ (isset($publishers[$userKey]) && $publishers[$userKey] == $currentUser->id || $isCurrentUser) ? 'selected' : '' }}>--}}
{{--                                                                        {{ $currentUser->last_name }} {{ $currentUser->first_name }}--}}
{{--                                                                    </option>--}}

{{--                                                                    @foreach ($users as $user)--}}
{{--                                                                        @if ($user->id != $currentUser->id)--}}
{{--                                                                            <option value="{{ $user->id }}" {{ (isset($publishers[$userKey]) && $publishers[$userKey] == $user->id) ? 'selected' : '' }}>--}}
{{--                                                                                {{ $user->last_name }} {{ $user->first_name }}--}}
{{--                                                                            </option>--}}
{{--                                                                        @endif--}}
{{--                                                                    @endforeach--}}
{{--                                                                </select>--}}
{{--                                                            </div>--}}
{{--                                                            @if($isUserEmpty)--}}
{{--                                                                <div class="col-12 mt-2">--}}
{{--                                                                    <div class="d-grid gap-2">--}}
{{--                                                                        <button class="btn btn-success" type="submit">--}}
{{--                                                                            {{ __('text.Записать') }}--}}
{{--                                                                        </button>--}}
{{--                                                                    </div>--}}
{{--                                                                </div>--}}
{{--                                                            @endif--}}
{{--                                                        </form>--}}
                                                    </div>
                                                </div>

{{--                                                @if($isUserEmpty)--}}
{{--                                                    @can('stand.make_entry')--}}

{{--                                                    @endif--}}
{{--                                                @else--}}
{{--                                                    @can('stand.delete_entry')--}}
{{--                                                        <div class="col-12">--}}
{{--                                                            <div class="d-grid gap-2">--}}
{{--                                                                <a class="btn btn-outline-danger" type="button" href="{{ route('recordRedactionDelete2', ['id' => $standPublisher->id, 'stand' => $stand->id, 'user_id' => $publishers[$userKey] ?? null]) }}"--}}
{{--                                                                   onclick="document.getElementById('loadingOverlay').style.display = 'flex';">--}}
{{--                                                                    {{ __('text.Выписать') }}--}}
{{--                                                                </a>--}}
{{--                                                            </div>--}}
{{--                                                        </div>--}}
{{--                                                    @endcan--}}
{{--                                                @endif--}}
                                            </div>
                                        </div>
                                    @endfor
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @endcan
            @endforeach
    </div>
@endforeach
</div>
<script>

    // function openModal(day, time, gwe) {
    //     var modalId = 'exampleModalFullscreen' + day + time + gwe;
    //     var myModal = new bootstrap.Modal(document.getElementById(modalId));
    //     myModal.show();
    // }

    function openModalRedaction(standPublisherId) {
        var modalId = 'Redaction' + standPublisherId;
        var myModal = new bootstrap.Modal(document.getElementById(modalId));
        myModal.show();
    }
</script>
