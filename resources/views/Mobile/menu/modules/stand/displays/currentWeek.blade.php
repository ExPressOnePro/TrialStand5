@extends('Mobile.layouts.front.app')
@section('title')
    Meeper | Таблица
@endsection
@section('content')
    @can('Stand-Open stand table')
        <div class="content container-fluid">
            @include('Mobile.includes.alerts.alerts')
            @include('Mobile.menu.modules.stand.components.switchWeek')
            <div class="row">
                @foreach ($week_schedule as $day => $times)
                    <div class="col-sm-12 col-lg-3 mb-6 mb-lg-5">

                            <div class="card card-header card-header-content-between rounded text-center" style="background: #749FBA">
                                <h2 class="card-header-title">
                                    {{ \App\Enums\WeekDaysEnum::getWeekDay($day) }}
                                    {{ $gwe = \App\Enums\WeekDaysEnum::getWeekDayDate($day) }}
                                </h2>
                                @php
                                    $standPublishers = App\Models\StandPublishers::where('day', $day)
                                        ->where('date', $gwe)
                                        ->where('stand_template_id', $StandTemplate->id)
                                        ->get();

                                    $canEdit = auth()->user()->can('Stand-Entry in table');
                                    $hasUserIcon = false; // Флаг для отслеживания, был ли уже выведен значок
                                @endphp

                                @foreach ($standPublishers as $standPublisher)
                                    @php
                                        $publishers = json_decode($standPublisher->publishers, true);

                                        foreach (['user_1', 'user_2', 'user_3', 'user_4'] as $userKey) {
                                            if (isset($publishers[$userKey]) && $publishers[$userKey] == auth()->user()->id) {
                                                $hasUserIcon = true; // Устанавливаем флаг в true
                                                break;
                                            }
                                        }
                                    @endphp
                                @endforeach

                                @if ($hasUserIcon)
                                    {{--                                        <a class="btn btn-ghost-secondary btn btn-icon btn-ghost-secondary rounded-circle text-black" type="button" href="{{ route('stand.reportPage', $standPublisher->id) }}">--}}
                                    {{--                                            <span class="display-4"><i class="fa-solid fa-pen"></i></span>--}}
                                    {{--                                        </a>--}}
                                @endif
                            </div>
                            @foreach ($times as $time)
                                @php
                                    $standPublisher = App\Models\StandPublishers::where('day', $day)
                                        ->where('time', $time)
                                        ->where('date', $gwe)
                                        ->where('stand_template_id', $StandTemplate->id)
                                        ->first();

                                    $publishers = [];
                                    if ($standPublisher) {
                                        $publishers = json_decode($standPublisher->publishers, true);
                                    }
                                    $canEdit = auth()->user()->can('Stand-Entry in table');
                                @endphp

                                <div class="col-sm-12 mt-1">
                                    <a class="card card-hover-shadow border border-secondary h-100 {{ isset($publishers['user_1']) && isset($publishers['user_2']) && $publishers['user_1'] && $publishers['user_2'] && (!$standPublisher || $canEdit) ? 'is-editable' : '' }}"
                                       @if($standPublisher && $canEdit)
                                           href="{{ route('recordRedactionPageMobile', ['stand_publishers_id'=> $standPublisher->id]) }}"
                                       @elseif(!$standPublisher && $canEdit)
                                           href="{{ route('recordRecordPage', ['day' => $day, 'time' => $time, 'date' => $gwe, 'stand_template_id'=> $StandTemplate->id]) }}"
                                       @endif
                                       style="background-color: @if(isset($publishers['user_1']) && isset($publishers['user_2']) && $publishers['user_1'] && $publishers['user_2']) #5BB5A9 @elseif($standPublisher && $canEdit) #D5976B @endif;">
                                        <div class="row align-items-center">
                                            <!-- time -->
                                            <div class="col-3 text-center">
                                                <span class="text-dark h2">{{ date('H:i', strtotime($time . ':00')) }}</span>
                                            </div>
                                            <!-- publishers -->
                                            <div class="col-9">
                                                <div class="mt-1 mb-0">
                                                    @for($i = 1; $i <= $valuePublishers_at_stand; $i++)
                                                        @php
                                                            $userKey = 'user_' . $i;
                                                            $user = $publishers[$userKey] ?? null;
                                                        @endphp

                                                        @if ($user)
                                                            @if ($user == Auth()->user()->id)
                                                                <h3 class="text-primary">
                                                                    {{ $users->where('id', $user)->pluck('first_name')->first() }}
                                                                    {{ $users->where('id', $user)->pluck('last_name')->first() }}
                                                                </h3>
                                                            @else
                                                                <h3>
                                                                    {{ $users->where('id', $user)->pluck('first_name')->first() }}
                                                                    {{ $users->where('id', $user)->pluck('last_name')->first() }}
                                                                </h3>
                                                            @endif
                                                        @else
                                                            <h3><span class="badge bg-success">Свободно</span></h3>
                                                        @endif
                                                    @endfor
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>

                @endforeach
            </div>
        </div>
    @endcan
@endsection
