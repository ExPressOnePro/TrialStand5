@extends('Mobile.layouts.front.app')
@section('title') Meeper | Таблица @endsection
@section('content')
    @can('Stand-Open stand table')
        <div class="content container-fluid">
            {{--<div class="main-content pt-4">--}}

            @if (session('error'))
                <div class="alert alert-soft-danger" role="alert">
                    {{ session('error') }}
                </div>
            @endif

            @if (session('success'))
                <div class="alert alert-soft-success" role="alert">
                    {{ session('success') }}
                </div>
            @endif

            <!-- текущая следующая неделя кнопки -->
            @include('Mobile.menu.modules.stand.front.components.switchWeek')

            <div class="row">
                @foreach ($week_schedule as $day => $times)
                    @php
                        $themes = [
                            'default' => [
                                'background' => '#ebdd9b',
                            ],
                            'dark' => [
                                'background' => '#8E9B97',
                            ],
                        ];
                    @endphp
                    <div class="col-12 mb-4">
                        <div class="card">
                            @foreach ($themes as $themeName => $theme)
                                <div class="card card-header d-flex align-items-center text-center" data-hs-theme-appearance="{{ $themeName }}" style="background: {{ $theme['background'] }}">
                                <h1>
                                    {{ \App\Enums\WeekDaysEnum::getWeekDay($day) }}
                                    {{ $gwe = \App\Enums\WeekDaysEnum::getWeekDayDate($day) }}
                                </h1>
                                </div>
                            @endforeach
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

                                <div class="col-12 mt-1">
                                    <a class="card card-hover-shadow h-100
                            @if(isset($publishers['user_1']) && isset($publishers['user_2']) && $publishers['user_1'] && $publishers['user_2'])
                                @if(!$standPublisher || $canEdit) is-editable @endif
                            @endif"
                                       @if($standPublisher && $canEdit)
                                           href="{{ route('recordRedactionPageMobile', ['stand_publishers_id'=> $standPublisher->id]) }}"
                                       @elseif(!$standPublisher && $canEdit)
                                           href="{{ route('recordRecordPage', ['day' => $day, 'time' => $time, 'date' => $gwe, 'stand_template_id'=> $StandTemplate->id]) }}"
                                       @endif
                                       style="background-color: @if(isset($publishers['user_1']) && isset($publishers['user_2']) && $publishers['user_1'] && $publishers['user_2']) #128277 @endif;">
                                        <div class="row align-items-center">
                                            <!-- time -->
                                            <div class="col-3 text-center">
                                                <div class="avatar avatar-soft-info avatar-circle">
                                                    <span class="avatar-initials text-dark">{{ date('H:i', strtotime($time . ':00')) }}</span>
                                                </div>
                                            </div>
                                            <!-- publishers -->
                                            <div class="col-9">
                                                <div class="mt-1 mb-0">
                                                    @if(isset($publishers['user_1']))
                                                        <h3>
                                                            @if ($publishers['user_1'])
                                                                {{ $users->where('id', $publishers['user_1'])->pluck('first_name')->first() }}
                                                                {{ $users->where('id', $publishers['user_1'])->pluck('last_name')->first() }}
                                                            @else
                                                                <span class="badge bg-success">Свободно</span>
                                                            @endif
                                                        </h3>
                                                    @else
                                                        <h3><span class="badge bg-success">Свободно</span></h3>
                                                    @endif

                                                    @if(isset($publishers['user_2']))
                                                        <h3>
                                                            @if ($publishers['user_2'] )
                                                                {{ $users->where('id', $publishers['user_2'])->pluck('first_name')->first() }}
                                                                {{ $users->where('id', $publishers['user_2'])->pluck('last_name')->first() }}
                                                            @else
                                                                <span class="badge bg-success">Свободно</span>
                                                            @endif
                                                        </h3>
                                                        @else
                                                            <h3><span class="badge bg-success">Свободно</span></h3>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endcan

    <script>
        function callNumber(phoneNumber) {
            window.location.href = 'tel:' + phoneNumber;
        }
    </script>
@endsection
