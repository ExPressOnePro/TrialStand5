@extends('BootstrapApp.layouts.bootstrapApp')
@section('title') Meeper @endsection
@section('content')
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
    </style>

    @include('BootstrapApp.includes.loadingOverlay')
    @can('module.stand')
        <div class="content container-fluid">
            <div class="row">
                @foreach ($standPublishersRecords as $date => $times)
                    <div class="col-sm-12 col-md-6 col-lg-4 mb-5 mb-lg-5">
                        <div class="card card-header card-header-content-between rounded text-center" style="background: rgba(153,102,204,0.5)">
                            <p class="card-header-title h5 dd">{{$date}}</p>
                        </div>
                        @foreach ($times as $time => $users)
                            <div class="col-sm-12 mt-1">
                                <a class="card rounded-3 text-decoration-none shadow
                                    @if (isset($users) && (!empty($users['user_1']) && !empty($users['user_2'])))
                                    border-left-full
                                    @elseif(empty($users['user_1']) && !empty($users['user_2']) || !empty($users['user_1']) && empty($users['user_2']))
                                    border-left-half
                                    @elseif(empty($users) || isset($users['standPublishers']))
                                    border-left-empty
                                    @endif"
                                   style="
                                   @if (isset($users) && (!empty($users['user_1']) && !empty($users['user_2'])))
                                    background-color: rgba(30, 114, 227, 0.15);
                                    @elseif(empty($users['user_1']) && !empty($users['user_2']) || !empty($users['user_1']) && empty($users['user_2']))
                                    background-color: rgba(255, 210, 52, 0.29);@endif"
                                @isset($users['standPublishers']['standPublishers'])
                                       onclick="openModalRedaction('{{$users['standPublishers']['standPublishers']}}')"
                                @endisset
                                >
                                    <div class="d-flex align-items-center">
                                        <!-- date -->
                                        <div class="col-3 text-center">
                                            <p class="h4"><strong>{{ $time }}</strong></p>
                                        </div>
                                        <!-- times -->
                                        <div class="ms-0 me-2 d-flex" style="height: 50px;" data-max-width="1px">
                                            <div class="vr"></div>
                                        </div>
                                        <div class="col-8">
                                            <div class="mt-1 mb-0">
                                                @if (empty($users))
                                                    <p class="h5"><span class="badge bg-secondary">{{ __('text.Свободно') }}</span></p>
                                                    <p class="h5"><span class="badge bg-secondary">{{ __('text.Свободно') }}</span></p>
                                                @else
                                                    @foreach ($users as $userKey => $userData)
                                                        @if(!isset($users['user_1']) && !isset($users['user_2']))
                                                            <p class="h5"><span class="badge bg-secondary">{{ __('text.Свободно') }}</span></p>
                                                            <p class="h5"><span class="badge bg-secondary">{{ __('text.Свободно') }}</span></p>
                                                        @elseif(isset($userData['id']) && Auth()->user()->id == $userData['id'])
                                                            <p class="h5 dd">
                                                                <strong>
                                                                    {{ isset($userData['last_name']) ? $userData['last_name'] : '' }} {{ isset($userData['first_name']) ? $userData['first_name'] : '' }}
                                                                </strong>
                                                            </p>
                                                        @elseif(isset($userData['id']))
                                                            <p class="h5 dd">
                                                                {{ isset($userData['last_name']) ? $userData['last_name'] : '' }} {{ isset($userData['first_name']) ? $userData['first_name'] : '' }}
                                                            </p>
                                                        @elseif(empty($userData))
                                                            <p class="h5"><span class="badge bg-secondary">{{ __('text.Свободно') }}</span></p>
                                                        @endif
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            @isset($users['standPublishers']['standPublishers'])
                                <div class="modal fade" id="ModalFullscreenRedaction @isset($users['standPublishers']['standPublishers']){{$users['standPublishers']['standPublishers']}}@endisset" tabindex="-1" aria-labelledby="exampleModalFullscreenLabel"
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
                                                        {{--                                                    <h3 class="mb-0">{{$stand->name}}</h3>--}}
                                                        <h3 class="mb-0">{{ __('text.Дата') }}:  {{ $date }}</h3>
                                                        <h3 class="mb-0">{{ __('text.Время') }}:  {{ $time }}</h3>
                                                    </div>
                                                </div>
                                                @for ($i = 1; $i <= $standTemplateSettings['publishers_at_stand']; $i++)
                                                    @php
                                                        $userKey = "user_$i";
                                                        $isUserEmpty = empty($userKey ?? null);
                                                        $currentUser = auth()->id();
                                                        $userLabel = $isUserEmpty ?  __('text.Пусто')  : __('text.Записан');
                                                    @endphp

                                                    <div class="card card-hover-shadow border-secondary mt-4">
                                                        <div class="card-body">
                                                            <div class="d-flex align-items-center mb-2">
                                                                <div class="flex-grow-1">
                                                                    <h3 class="text-inherit mb-1">{{ $i === 1 ? __('text.Первый') : ($i === 2 ? __('text.Второй') : ($i === 3 ? __('text.Третий') : __('text.Четвертый') )) }} {{ __('text.возвещатель') }}
                                                                        @if($isUserEmpty)
                                                                            <span class="badge bg-secondary">{{ $userLabel }}</span>
                                                                        @else
                                                                            <span class="badge bg-info">{{ $userLabel }}</span>
                                                                        @endif
                                                                    </h3>

                                                                    {{--                                                                <form id="changeForm{{ $i }}" method="post" action="{{ route('AddPublisherToStand2', ['id' => {{$users['standPublishers']['standPublishers']}}]) }}">--}}
                                                                    @csrf
                                                                    <div class="tom-select-custom">
                                                                        <select class="select form-select" autocomplete="off" name="user_id" id="user_id" @if($isUserEmpty) @else disabled readonly @endif>
                                                                            @php
                                                                                $currentUser = auth()->user();
                                                                            @endphp

                                                                            <option value="{{ $currentUser->id }}" {{ (isset($publishers[$userKey]) && $publishers[$userKey] == auth()->user()->id) ? 'selected' : '' }}>
                                                                                {{ auth()->user()->last_name }} {{ auth()->user()->first_name }}
                                                                            </option>

                                                                            @foreach ($publishers as $publisher)
                                                                                @if ($publisher->id != auth()->user()->id)
                                                                                    <option value="{{ $publisher->id }}" {{ (isset($publisher[$userKey]) && $publisher[$userKey] == $publisher->id) ? 'selected' : '' }}>
                                                                                        {{ $publisher->last_name }} {{ $publisher->first_name }}
                                                                                    </option>
                                                                                @endif
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                    @if($isUserEmpty)
                                                                        <div class="col-12 mt-2">
                                                                            <div class="d-grid gap-2">
                                                                                <button class="btn btn-success" type="submit">
                                                                                    {{ __('text.Записать') }}
                                                                                </button>
                                                                            </div>
                                                                        </div>
                                                                    @endif
                                                                    </form>
                                                                </div>
                                                            </div>

                                                            @if($isUserEmpty)
                                                                @can('stand.make_entry')

                                                                @endif
                                                            @else
                                                                @can('stand.delete_entry')
                                                                    <div class="col-12">
                                                                        <div class="d-grid gap-2">
                                                                            {{--                                                                        <a class="btn btn-outline-danger" type="button" href="{{ route('recordRedactionDelete2', ['id' => $standPublisher->id, 'stand' => $stand->id, 'user_id' => $publishers[$userKey] ?? null]) }}"--}}
                                                                            {{--                                                                           onclick="document.getElementById('loadingOverlay').style.display = 'flex';">--}}
                                                                            {{--                                                                            {{ __('text.Выписать') }}--}}
                                                                            {{--                                                                        </a>--}}
                                                                        </div>
                                                                    </div>
                                                                @endcan
                                                            @endif
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
                            @endisset
                        @endforeach
                    </div>
                @endforeach

                            {{--                @foreach($standPublishersRecords as $standPublishersRecord => $time)--}}
{{--                    <div class="col-sm-12 col-md-6 col-lg-4 mb-5 mb-lg-5">--}}
{{--                        <div class="card card-header card-header-content-between rounded text-center" style="background: rgba(153,102,204,0.5)">--}}
{{--                            <p class="card-header-title h5 dd">--}}
{{--                                {{$standPublishersRecord}}--}}
{{--                            </p>--}}
{{--                        </div>--}}
{{--                        @foreach($time as $t => $r)--}}
{{--                            <div class="col-sm-12 mt-1">--}}
{{--                                <a class="card rounded-3 text-decoration-none shadow">--}}
{{--                                    <div class="d-flex align-items-center">--}}
{{--                                        <!-- time -->--}}
{{--                                        <div class="col-3 text-center">--}}
{{--                                            <p class="h5"><strong>{{ $t }}</strong></p>--}}
{{--                                        </div>--}}
{{--                                        <!-- publishers -->--}}
{{--                                        <div class="col ms-0 d-flex" style="height: 50px;" data-max-width="1px">--}}
{{--                                            <div class="vr"></div>--}}
{{--                                        </div>--}}
{{--                                        <div class="col-8">--}}
{{--                                            <div class="mt-1 mb-0">--}}
{{--                                                @foreach($r as $key => $value)--}}
{{--                                                    @foreach($value as $userkey => $userValue)--}}
{{--{{$userValue['last_name']}}--}}
{{--                                                    @if($userkey == Auth()->user()->id)--}}
{{--                                                        <p class="h5 dd">--}}
{{--                                                            <strong>--}}
{{--                                                                {{ $userkey['last_name'] }} {{ $userkey['first_name'] }}--}}
{{--                                                            </strong>--}}
{{--                                                        </p>--}}
{{--                                                    @else--}}
{{--                                                        <p class="h5 dd">--}}
{{--                                                            {{ $userkey['last_name'] }} {{ $userkey['first_name'] }}--}}
{{--                                                        </p>--}}
{{--                                                    @endif--}}
{{--                                                @endforeach--}}
{{--                                                @endforeach--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </a>--}}
{{--                            </div>--}}
{{--                        @endforeach--}}




{{--                    </div>--}}


{{--                @endforeach--}}
            </div>

        </div>
    @endcan


    <script>

        // function openModal(day, time, gwe) {
        //     var modalId = 'exampleModalFullscreen' + day + time + gwe;
        //     var myModal = new bootstrap.Modal(document.getElementById(modalId));
        //     myModal.show();
        // }

        function openModalRedaction(standPublisherId) {
            var modalId = 'ModalFullscreenRedaction' + ' ' + standPublisherId;
            var myModal = new bootstrap.Modal(document.getElementById(modalId));
            myModal.show();
        }
    </script>
@endsection
