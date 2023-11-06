@extends('Mobile.layouts.front.app')
@section('title') Meeper | детали @endsection
@section('content')
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
    <div class="content container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-4 mb-lg-5 mx-auto">
        <div class="alert alert-info mb-5 mb-lg-7" role="alert">
            <div class="d-flex align-items-center">
                <div class="flex-grow-1 ms-3">
                    <h3 class="alert-heading mb-1">{{ __('text.Информация о записи') }}</h3>
                    <p class="mb-0">{{ __('text.Дата') }}:  {{ $standPublisher->date }}</p>
                    <p class="mb-0">{{ __('text.Время') }}:  {{ date('H:i', strtotime($standPublisher->time)) }}</p>
                </div>
            </div>
        </div>

        @for($i = 1; $i <= $settings['publishers_at_stand']; $i++)
            @php
                $userKey = "user_$i";
                $isUserEmpty = empty($publishers[$userKey]);
                $currentUser = auth()->id();
                $isCurrentUser = ($currentUser == $publishers[$userKey] && !$publishers[$userKey]);
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

                            <form id="changeForm{{ $i }}" method="post" action="{{ route('AddPublisherToStand', ['id' => $standPublisher->id]) }}">
                                @csrf
                                <div class="tom-select-custom">
                                        <select class="js-select form-select" autocomplete="off" name="user_id" id="user_id" @if($isUserEmpty) @else disabled readonly @endif>
                                            @php
                                                $currentUser = auth()->user();
                                            @endphp

                                            <option value="{{ $currentUser->id }}" {{ ($publishers[$userKey] == $currentUser->id || $isCurrentUser) ? 'selected' : '' }}>
                                                {{ $currentUser->last_name }} {{ $currentUser->first_name }}
                                            </option>

                                            @foreach ($users as $user)
                                                @if ($user->id != $currentUser->id)
                                                    <option value="{{ $user->id }}" {{ ($publishers[$userKey] == $user->id) ? 'selected' : '' }}>
                                                        {{ $user->last_name }} {{ $user->first_name }}
                                                    </option>
                                                @endif
                                            @endforeach
                                        </select>
                                </div>
                            </form>
                        </div>
                    </div>
                    @if($isUserEmpty)
                        @can('stand.make_entry')
                        <div class="col-12">
                            <div class="d-grid gap-2">
                                <a class="btn btn-success m-1" type="button" href="{{ route('AddPublisherToStand', ['id' => $standPublisher->id, 'stand' => $stand->id, 'user_id' => $user->id]) }}"
                                   onclick="event.preventDefault();
                                        document.getElementById('changeForm{{ $i }}').submit();
                                        document.getElementById('loadingOverlay').style.display = 'flex';">
                                    {{ __('text.Записать') }}
                                </a>
                            </div>
                        </div>
                        @endif
                    @else
                        <div class="row">
                            @can('stand.delete_entry')
                                <div class="col-12">
                                    <div class="d-grid gap-2">
                                        <a class="btn btn-outline-danger m-1" type="button" href="{{ route('recordRedactionDelete', ['id' => $standPublisher->id, 'stand' => $stand->id, 'user_id' => $publishers[$userKey]]) }}"
                                        onclick="document.getElementById('loadingOverlay').style.display = 'flex';">
                                            {{ __('text.Выписать') }}
                                        </a>
                                    </div>
                                </div>
                            @endcan
{{--                            @can('stand.change_entry')--}}
{{--                                <div class="col-6 gap-2">--}}
{{--                                    <div class="d-grid gap-2">--}}
{{--                                        <a class="btn btn-success m-1" type="button" href="{{ route('recordRedactionChange' . $i, ['id' => $standPublisher->id, 'stand' => $stand->id, 'user_id' => $currentUser->id]) }}"--}}
{{--                                           onclick="event.preventDefault();--}}
{{--                                            document.getElementById('changeForm{{ $i }}').submit();">--}}
{{--                                            Изменить--}}
{{--                                        </a>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            @endcan--}}
                        </div>
                    @endif

                </div>
            </div>
        @endfor
            </div>
        </div>
    </div>
@endsection
