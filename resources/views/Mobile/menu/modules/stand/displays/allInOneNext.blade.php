@extends('Mobile.layouts.front.app')
@section('title') Meeper | Стенд @endsection
@section('content')
{{--    @can('module.stand')--}}
{{--        <div class="content container-fluid">--}}
{{--            @include('Mobile.includes.alerts.alerts')--}}
{{--            @include('Mobile.menu.modules.stand.components.switchWeek')--}}
{{--            <div class="row">--}}
{{--                @php--}}
{{--                    // Создаем временный массив для хранения данных о сортировке--}}
{{--                    $sortedData = [];--}}

{{--                    // Обходим все StandTemplate--}}
{{--                    foreach ($StandTemplates as $StandTemplate) {--}}
{{--                        // Инициализируем массив для текущего StandTemplate--}}
{{--                        $standTemplateData = [];--}}

{{--                        // Обходим week_schedule внутри каждого StandTemplate--}}
{{--                        foreach ($StandTemplate->week_schedule as $day => $times) {--}}
{{--                            // Если ключа нет в $standTemplateData, добавляем его--}}
{{--                            if (!isset($standTemplateData[$day])) {--}}
{{--                                $standTemplateData[$day] = [];--}}
{{--                            }--}}

{{--                            // Добавляем временной интервал в $standTemplateData--}}
{{--                            $standTemplateData[$day] = array_merge($standTemplateData[$day], $times);--}}
{{--                        }--}}

{{--                        // Добавляем данные текущего StandTemplate в основной массив--}}
{{--                        $sortedData[] = [--}}
{{--                            'stand_name' => $StandTemplate->stand->name,--}}
{{--                            'data' => $standTemplateData,--}}
{{--                        ];--}}
{{--                    }--}}
{{--                @endphp--}}

{{--                 Выводим отсортированные данные --}}
{{--                @foreach ($sortedData as $day => $times)--}}
{{--                    <div class="col-sm-12 col-lg-3 mb-6 mb-lg-5">--}}
{{--                        <div class="card card-header card-header-content-between rounded text-center" style="background: #749FBA">--}}
{{--                            <div class="flex-grow-1 card-header-title">--}}
{{--                                <h2 class="dd">--}}
{{--                                    {{ \App\Enums\WeekDaysEnum::getWeekDay($day) }}--}}
{{--                                    {{ $gwe = \App\Enums\WeekDaysEnum::getWeekDayDate($day) }}--}}
{{--                                </h2>--}}
{{--                                <h3>{{$StandTemplate->stand->name}}</h3>--}}
{{--                            </div>--}}
{{--                            @php--}}
{{--                                $standPublishers = App\Models\StandPublishers::where('day', $day)--}}
{{--                                    ->where('date', $gwe)--}}
{{--                                    ->where('stand_template_id', $StandTemplate->id)--}}
{{--                                    ->get();--}}

{{--                                $canEdit = auth()->user()->can('stand.make_entry');--}}
{{--                                $hasUserIcon = false; // Флаг для отслеживания, был ли уже выведен значок--}}
{{--                            @endphp--}}

{{--                            @foreach ($standPublishers as $standPublisher)--}}
{{--                                @php--}}
{{--                                    $publishers = json_decode($standPublisher->publishers, true);--}}

{{--                                    foreach (['user_1', 'user_2', 'user_3', 'user_4'] as $userKey) {--}}
{{--                                        if (isset($publishers[$userKey]) && $publishers[$userKey] == auth()->user()->id) {--}}
{{--                                            $hasUserIcon = true; // Устанавливаем флаг в true--}}
{{--                                            break;--}}
{{--                                        }--}}
{{--                                    }--}}
{{--                                @endphp--}}
{{--                            @endforeach--}}
{{--                        </div>--}}
{{--                        @foreach ($times as $time)--}}
{{--                            @php--}}
{{--                                $standPublisher = App\Models\StandPublishers::where('day', $day)--}}
{{--                                    ->where('time', $time)--}}
{{--                                    ->where('date', $gwe)--}}
{{--                                    ->where('stand_template_id', $StandTemplate->id)--}}
{{--                                    ->first();--}}

{{--                                $publishers = [];--}}
{{--                                if ($standPublisher) {--}}
{{--                                    $publishers = json_decode($standPublisher->publishers, true);--}}
{{--                                }--}}
{{--                                $canEdit = auth()->user()->can('stand.make_entry');--}}
{{--                            @endphp--}}

{{--                            <div class="col-sm-12 mt-1">--}}
{{--                                <a class="card card-hover-shadow border border-secondary h-100 {{ isset($publishers['user_1']) && isset($publishers['user_2']) && $publishers['user_1'] && $publishers['user_2'] && (!$standPublisher || $canEdit) ? 'is-editable' : '' }}"--}}
{{--                                   @if($standPublisher && $canEdit)--}}
{{--                                       href="{{ route('recordRedactionPageMobile', ['stand_publishers_id'=> $standPublisher->id]) }}"--}}
{{--                                   @elseif(!$standPublisher && $canEdit)--}}
{{--                                       href="{{ route('recordRecordPage', ['day' => $day, 'time' => $time, 'date' => $gwe, 'stand_template_id'=> $StandTemplate->id]) }}"--}}
{{--                                   @endif--}}
{{--                                   style="background-color: @if(isset($publishers['user_1']) && isset($publishers['user_2']) && $publishers['user_1'] && $publishers['user_2']) #5BB5A9 @elseif($standPublisher && $canEdit) #D5976B @endif;">--}}
{{--                                    <div class="row align-items-center">--}}
{{--                                        <!-- time -->--}}
{{--                                        <div class="col-3 text-center">--}}
{{--                                            <span class="text-dark h2">{{ $time }}</span>--}}
{{--                                        </div>--}}
{{--                                        <!-- publishers -->--}}
{{--                                        <div class="col-9">--}}
{{--                                            <div class="mt-1 mb-0">--}}
{{--                                                @for($i = 1; $i <= $valuePublishers_at_stand; $i++)--}}
{{--                                                    @php--}}
{{--                                                        $userKey = 'user_' . $i;--}}
{{--                                                        $user = $publishers[$userKey] ?? null;--}}
{{--                                                    @endphp--}}

{{--                                                    @if ($user)--}}
{{--                                                        @if ($user == Auth()->user()->id)--}}
{{--                                                            <h3 class="text-primary">--}}
{{--                                                                {{ $users->where('id', $user)->pluck('last_name')->first() }}--}}
{{--                                                                {{ $users->where('id', $user)->pluck('first_name')->first() }}--}}
{{--                                                            </h3>--}}
{{--                                                        @else--}}
{{--                                                            <h3>--}}
{{--                                                                {{ $users->where('id', $user)->pluck('last_name')->first() }}--}}
{{--                                                                {{ $users->where('id', $user)->pluck('first_name')->first() }}--}}
{{--                                                            </h3>--}}
{{--                                                        @endif--}}
{{--                                                    @else--}}
{{--                                                        <h3><span class="badge bg-secondary">Свободно</span></h3>--}}
{{--                                                    @endif--}}
{{--                                                @endfor--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </a>--}}
{{--                            </div>--}}
{{--                        @endforeach--}}
{{--                    </div>--}}

{{--                @endforeach--}}

{{--            </div>--}}
{{--        </div>--}}
{{--    @endcan--}}

{{--    @can('module.stand')--}}
{{--        <div class="content container-fluid">--}}
{{--            <div class="row">--}}
{{--                @php--}}
{{--                    // Создаем временный массив для хранения данных о сортировке--}}
{{--                    $sortedData = [];--}}

{{--                    // Обходим все StandTemplate--}}
{{--                    foreach ($StandTemplates as $StandTemplate) {--}}
{{--                        // Обходим week_schedule внутри каждого StandTemplate--}}
{{--                        foreach ($StandTemplate->week_schedule as $day => $times) {--}}
{{--                            // Если ключа нет в $sortedData, добавляем его--}}
{{--                            if (!isset($sortedData[$day])) {--}}
{{--                                $sortedData[$day] = [];--}}
{{--                            }--}}

{{--                            // Добавляем временной интервал в $sortedData--}}
{{--                            $sortedData[$day][] = [--}}
{{--                                'stand_name' => $StandTemplate->stand->name,--}}
{{--                                'times' => $times,--}}
{{--                            ];--}}
{{--                        }--}}
{{--                    }--}}
{{--                @endphp--}}

{{--                 Выводим отсортированные данные--}}
{{--                @foreach ($sortedData as $day => $entries)--}}
{{--                    <div class="col-sm-12 col-lg-3 mb-6 mb-lg-5">--}}
{{--                        <div class="card card-header card-header-content-between rounded text-center" style="background: #749FBA">--}}
{{--                        <h2 class="dd">--}}
{{--                            {{ \App\Enums\WeekDaysEnum::getWeekDay($day) }}--}}
{{--                            {{ $gwe = \App\Enums\WeekDaysEnum::getWeekDayDate($day) }}--}}
{{--                        </h2>--}}
{{--                        </div>--}}

{{--                        @foreach ($entries as $entry)--}}
{{--                            <div class="card">--}}
{{--                                <h3>{{ $entry['stand_name'] }}</h3>--}}
{{--                                @foreach ($entry['times'] as $time)--}}
{{--                                    @php--}}
{{--                                                                    $standPublisher = App\Models\StandPublishers::where('day', $day)--}}
{{--                                                                        ->where('time', $time)--}}
{{--                                                                        ->where('date', $gwe)--}}
{{--                                                                        ->where('stand_template_id', $StandTemplate->id)--}}
{{--                                                                        ->first();--}}

{{--                                                                    $publishers = [];--}}
{{--                                                                    if ($standPublisher) {--}}
{{--                                                                        $publishers = json_decode($standPublisher->publishers, true);--}}
{{--                                                                    }--}}
{{--                                                                    $canEdit = auth()->user()->can('stand.make_entry');--}}
{{--                                                                @endphp--}}
{{--                                    <div class="col-sm-12 mt-1">--}}
{{--                                        <a class="card card-hover-shadow border border-secondary h-100 {{ isset($publishers['user_1']) && isset($publishers['user_2']) && $publishers['user_1'] && $publishers['user_2'] && (!$standPublisher || $canEdit) ? 'is-editable' : '' }}"--}}
{{--                                                                           @if($standPublisher && $canEdit)--}}
{{--                                                                               href="{{ route('recordRedactionPageMobile', ['stand_publishers_id'=> $standPublisher->id]) }}"--}}
{{--                                                                           @elseif(!$standPublisher && $canEdit)--}}
{{--                                                                               href="{{ route('recordRecordPage', ['day' => $day, 'time' => $time, 'date' => $gwe, 'stand_template_id'=> $StandTemplate->id]) }}"--}}
{{--                                                                           @endif--}}
{{--                                                                           style="background-color: @if(isset($publishers['user_1']) && isset($publishers['user_2']) && $publishers['user_1'] && $publishers['user_2']) #5BB5A9 @elseif($standPublisher && $canEdit) #D5976B @endif;">--}}
{{--                                                                            <div class="row align-items-center">--}}
{{--                                                                                <!-- time -->--}}
{{--                                                                                <div class="col-3 text-center">--}}
{{--                                                                                    <span class="text-dark h2">{{ $time }}</span>--}}
{{--                                                                                </div>--}}
{{--                                                                                <!-- publishers -->--}}
{{--                                                                                <div class="col-9">--}}
{{--                                                                                    <div class="mt-1 mb-0">--}}
{{--                                                                                        @for($i = 1; $i <= $valuePublishers_at_stand; $i++)--}}
{{--                                                                                            @php--}}
{{--                                                                                                $userKey = 'user_' . $i;--}}
{{--                                                                                                $user = $publishers[$userKey] ?? null;--}}
{{--                                                                                            @endphp--}}

{{--                                                                                            @if ($user)--}}
{{--                                                                                                @if ($user == Auth()->user()->id)--}}
{{--                                                                                                    <h3 class="text-primary">--}}
{{--                                                                                                        {{ $users->where('id', $user)->pluck('last_name')->first() }}--}}
{{--                                                                                                        {{ $users->where('id', $user)->pluck('first_name')->first() }}--}}
{{--                                                                                                    </h3>--}}
{{--                                                                                                @else--}}
{{--                                                                                                    <h3>--}}
{{--                                                                                                        {{ $users->where('id', $user)->pluck('last_name')->first() }}--}}
{{--                                                                                                        {{ $users->where('id', $user)->pluck('first_name')->first() }}--}}
{{--                                                                                                    </h3>--}}
{{--                                                                                                @endif--}}
{{--                                                                                            @else--}}
{{--                                                                                                <h3><span class="badge bg-secondary">Свободно</span></h3>--}}
{{--                                                                                            @endif--}}
{{--                                                                                        @endfor--}}
{{--                                                                                    </div>--}}
{{--                                                                                </div>--}}
{{--                                                                            </div>--}}
{{--                                                                        </a>--}}
{{--                                        <!-- Ваш код для отображения времени -->--}}
{{--                                    </div>--}}
{{--                                @endforeach--}}
{{--                            </div>--}}
{{--                        @endforeach--}}
{{--                    </div>--}}
{{--                @endforeach--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    @endcan--}}

{{--@can('module.stand')--}}
{{--    <div class="content container-fluid">--}}
{{--        <div class="row">--}}
{{--            @php--}}
{{--                // Создаем временный массив для хранения данных о сортировке--}}
{{--                $sortedData = [];--}}

{{--                // Обходим все StandTemplate--}}
{{--                foreach ($StandTemplates as $StandTemplate) {--}}
{{--                    // Обходим week_schedule внутри каждого StandTemplate--}}
{{--                    foreach ($StandTemplate->week_schedule as $day => $times) {--}}
{{--                        // Если ключа нет в $sortedData, добавляем его--}}
{{--                        if (!isset($sortedData[$StandTemplate->id][$day])) {--}}
{{--                            $sortedData[$StandTemplate->id][$day] = [];--}}
{{--                        }--}}

{{--                        // Добавляем временной интервал в $sortedData--}}
{{--                        $sortedData[$StandTemplate->id][$day][] = [--}}
{{--                            'stand_name' => $StandTemplate->stand->name,--}}
{{--                            'times' => $times,--}}
{{--                        ];--}}
{{--                    }--}}
{{--                }--}}
{{--            @endphp--}}

{{--             Выводим отсортированные данные --}}
{{--            @foreach ($sortedData as $standTemplateId => $days)--}}
{{--                <div class="col-sm-12 col-lg-3 mb-6 mb-lg-5">--}}
{{--                    @foreach ($days as $day => $entries)--}}
{{--                        <h2 class="dd">--}}
{{--                            {{ \App\Enums\WeekDaysEnum::getWeekDay($day) }}--}}
{{--                            {{ $gwe = \App\Enums\WeekDaysEnum::getWeekDayDate($day) }}--}}
{{--                        </h2>--}}
{{--                        @foreach ($entries as $entry)--}}
{{--                            <div class="card">--}}
{{--                                <h3>{{ $entry['stand_name'] }}</h3>--}}
{{--                                @foreach ($entry['times'] as $time)--}}
{{--                                    @php--}}
{{--                                        $standPublisher = App\Models\StandPublishers::where('day', $day)--}}
{{--                                            ->where('time', $time)--}}
{{--                                            ->where('date', $gwe)--}}
{{--                                            ->where('stand_template_id', $StandTemplate->id)--}}
{{--                                            ->first();--}}

{{--                                        $publishers = [];--}}
{{--                                        if ($standPublisher) {--}}
{{--                                            $publishers = json_decode($standPublisher->publishers, true);--}}
{{--                                        }--}}
{{--                                        $canEdit = auth()->user()->can('stand.make_entry');--}}
{{--                                    @endphp--}}
{{--                                    <div class="col-sm-12 mt-1">--}}
{{--                                        <a class="card card-hover-shadow border border-secondary h-100 {{ isset($publishers['user_1']) && isset($publishers['user_2']) && $publishers['user_1'] && $publishers['user_2'] && (!$standPublisher || $canEdit) ? 'is-editable' : '' }}"--}}
{{--                                           @if($standPublisher && $canEdit)--}}
{{--                                               href="{{ route('recordRedactionPageMobile', ['stand_publishers_id'=> $standPublisher->id]) }}"--}}
{{--                                           @elseif(!$standPublisher && $canEdit)--}}
{{--                                               href="{{ route('recordRecordPage', ['day' => $day, 'time' => $time, 'date' => $gwe, 'stand_template_id'=> $StandTemplate->id]) }}"--}}
{{--                                           @endif--}}
{{--                                           style="background-color: @if(isset($publishers['user_1']) && isset($publishers['user_2']) && $publishers['user_1'] && $publishers['user_2']) #5BB5A9 @elseif($standPublisher && $canEdit) #D5976B @endif;">--}}
{{--                                            <div class="row align-items-center">--}}
{{--                                                <!-- time -->--}}
{{--                                                <div class="col-3 text-center">--}}
{{--                                                    <span class="text-dark h2">{{ $time }}</span>--}}
{{--                                                </div>--}}
{{--                                                <!-- publishers -->--}}
{{--                                                <div class="col-9">--}}
{{--                                                    <div class="mt-1 mb-0">--}}
{{--                                                        @for($i = 1; $i <= $valuePublishers_at_stand; $i++)--}}
{{--                                                            @php--}}
{{--                                                                $userKey = 'user_' . $i;--}}
{{--                                                                $user = $publishers[$userKey] ?? null;--}}
{{--                                                            @endphp--}}

{{--                                                            @if ($user)--}}
{{--                                                                @if ($user == Auth()->user()->id)--}}
{{--                                                                    <h3 class="text-primary">--}}
{{--                                                                        {{ $users->where('id', $user)->pluck('last_name')->first() }}--}}
{{--                                                                        {{ $users->where('id', $user)->pluck('first_name')->first() }}--}}
{{--                                                                    </h3>--}}
{{--                                                                @else--}}
{{--                                                                    <h3>--}}
{{--                                                                        {{ $users->where('id', $user)->pluck('last_name')->first() }}--}}
{{--                                                                        {{ $users->where('id', $user)->pluck('first_name')->first() }}--}}
{{--                                                                    </h3>--}}
{{--                                                                @endif--}}
{{--                                                            @else--}}
{{--                                                                <h3><span class="badge bg-secondary">Свободно</span></h3>--}}
{{--                                                            @endif--}}
{{--                                                        @endfor--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </a>--}}
{{--                                        <!-- Ваш код для отображения времени -->--}}
{{--                                    </div>--}}
{{--                                @endforeach--}}
{{--                                @endforeach--}}

{{--                    @endforeach--}}
{{--                </div>--}}
{{--            @endforeach--}}
{{--        </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--@endcan--}}

{{--@can('module.stand')--}}
{{--    <div class="content container-fluid">--}}
{{--        <div class="row">--}}
{{--            @php--}}
{{--                // Создаем временный массив для хранения данных о сортировке--}}
{{--                $sortedData = [];--}}

{{--                // Обходим все StandTemplate--}}
{{--                foreach ($StandTemplates as $StandTemplate) {--}}
{{--                    // Обходим week_schedule внутри каждого StandTemplate--}}
{{--                    foreach ($StandTemplate->week_schedule as $day => $times) {--}}
{{--                        // Если ключа нет в $sortedData, добавляем его--}}
{{--                        if (!isset($sortedData[$StandTemplate->id][$day])) {--}}
{{--                            $sortedData[$StandTemplate->id][$day] = [];--}}
{{--                        }--}}

{{--                        // Добавляем временной интервал в $sortedData--}}
{{--                        $sortedData[$StandTemplate->id][$day][] = [--}}
{{--                            'stand_name' => $StandTemplate->stand->name,--}}
{{--                            'times' => $times,--}}
{{--                        ];--}}
{{--                    }--}}
{{--                }--}}
{{--            @endphp--}}
{{--            @foreach ($sortedData as $standTemplateId => $days)--}}
{{--                <div class="col-3 mb-6 mb-lg-5">--}}
{{--                    @foreach ($days as $day => $entries)--}}
{{--                        @foreach ($entries as $entry)--}}
{{--                            <div class="card card-header card-header-content-between rounded text-center" style="background: #749FBA">--}}
{{--                                <div class="flex-grow-1">--}}
{{--                                    <h2 class="card-header-title dd">--}}
{{--                                        {{ \App\Enums\WeekDaysEnum::getWeekDay($day) }}--}}
{{--                                        {{ $gwe = \App\Enums\WeekDaysEnum::getWeekDayDate($day) }}--}}
{{--                                    </h2>--}}
{{--                                    <span class="h4 dd">{{ $entry['stand_name'] }}</span>--}}
{{--                                </div>--}}
{{--                                @php--}}
{{--                                    $standPublishers = App\Models\StandPublishers::where('day', $day)--}}
{{--                                        ->where('date', $gwe)--}}
{{--                                        ->where('stand_template_id', $StandTemplate->id)--}}
{{--                                        ->get();--}}

{{--                                    $canEdit = auth()->user()->can('stand.make_entry');--}}
{{--                                    $hasUserIcon = false; // Флаг для отслеживания, был ли уже выведен значок--}}
{{--                                @endphp--}}

{{--                                @foreach ($standPublishers as $standPublisher)--}}
{{--                                    @php--}}
{{--                                        $publishers = json_decode($standPublisher->publishers, true);--}}

{{--                                        foreach (['user_1', 'user_2', 'user_3', 'user_4'] as $userKey) {--}}
{{--                                            if (isset($publishers[$userKey]) && $publishers[$userKey] == auth()->user()->id) {--}}
{{--                                                $hasUserIcon = true; // Устанавливаем флаг в true--}}
{{--                                                break;--}}
{{--                                            }--}}
{{--                                        }--}}
{{--                                    @endphp--}}
{{--                                @endforeach--}}

{{--                                @if ($hasUserIcon)--}}
{{--                                    <a class="btn btn-ghost-secondary btn btn-icon btn-ghost-secondary rounded-circle text-black" type="button" href="{{ route('stand.reportPage', $standPublisher->id) }}">--}}
{{--                                        <span class="display-4"><i class="fa-solid fa-pen"></i></span>--}}
{{--                                    </a>--}}
{{--                                @endif--}}
{{--                            </div>--}}
{{--                            @foreach ($entry['times'] as $time)--}}
{{--                                @php--}}
{{--                                    $standPublisher = App\Models\StandPublishers::where('day', $day)--}}
{{--                                        ->where('time', $time)--}}
{{--                                        ->where('date', $gwe)--}}
{{--                                        ->where('stand_template_id', $standTemplateId)--}}
{{--                                        ->first();--}}

{{--                                    $publishers = [];--}}
{{--                                    if ($standPublisher) {--}}
{{--                                        $publishers = json_decode($standPublisher->publishers, true);--}}
{{--                                    }--}}
{{--                                    $canEdit = auth()->user()->can('stand.make_entry');--}}
{{--                                @endphp--}}
{{--                                <div class="col-sm-12 mt-1">--}}
{{--                                    <a class="card card-hover-shadow border border-secondary h-100 {{ isset($publishers['user_1']) && isset($publishers['user_2']) && $publishers['user_1'] && $publishers['user_2'] && (!$standPublisher || $canEdit) ? 'is-editable' : '' }}"--}}
{{--                                       @if($standPublisher && $canEdit)--}}
{{--                                           href="{{ route('recordRedactionPageMobile', ['stand_publishers_id'=> $standPublisher->id]) }}"--}}
{{--                                       @elseif(!$standPublisher && $canEdit)--}}
{{--                                           href="{{ route('recordRecordPage', ['day' => $day, 'time' => $time, 'date' => $gwe, 'stand_template_id'=> $standTemplateId]) }}"--}}
{{--                                       @endif--}}
{{--                                       style="background-color: @if(isset($publishers['user_1']) && isset($publishers['user_2']) && $publishers['user_1'] && $publishers['user_2']) #5BB5A9 @elseif($standPublisher && $canEdit) #D5976B @endif;">--}}
{{--                                        <div class="row align-items-center">--}}
{{--                                            <!-- time -->--}}
{{--                                            <div class="col-3 text-center">--}}
{{--                                                <span class="text-dark h2">{{ $time }}</span>--}}
{{--                                            </div>--}}
{{--                                            <!-- publishers -->--}}
{{--                                            <div class="col-9">--}}
{{--                                                <div class="mt-1 mb-0">--}}
{{--                                                    @for($i = 1; $i <= $valuePublishers_at_stand; $i++)--}}
{{--                                                        @php--}}
{{--                                                            $userKey = 'user_' . $i;--}}
{{--                                                            $user = $publishers[$userKey] ?? null;--}}
{{--                                                        @endphp--}}

{{--                                                        @if ($user)--}}
{{--                                                            @if ($user == Auth()->user()->id)--}}
{{--                                                                <h3 class="text-primary">--}}
{{--                                                                    {{ $users->where('id', $user)->pluck('last_name')->first() }}--}}
{{--                                                                    {{ $users->where('id', $user)->pluck('first_name')->first() }}--}}
{{--                                                                </h3>--}}
{{--                                                            @else--}}
{{--                                                                <h3>--}}
{{--                                                                    {{ $users->where('id', $user)->pluck('last_name')->first() }}--}}
{{--                                                                    {{ $users->where('id', $user)->pluck('first_name')->first() }}--}}
{{--                                                                </h3>--}}
{{--                                                            @endif--}}
{{--                                                        @else--}}
{{--                                                            <h3><span class="badge bg-secondary">Свободно</span></h3>--}}
{{--                                                        @endif--}}
{{--                                                    @endfor--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </a>--}}
{{--                                </div>--}}
{{--                            @endforeach--}}
{{--                        @endforeach--}}
{{--                    @endforeach--}}
{{--                </div>--}}
{{--            @endforeach--}}
{{--        </div>--}}
{{--    </div>--}}
{{--@endcan--}}

{{--@can('module.stand')--}}
{{--    <div class="content container-fluid">--}}
{{--        <div class="row">--}}
{{--            @php--}}
{{--                // Создаем временный массив для хранения данных о сортировке--}}
{{--                $sortedData = [];--}}
{{--                // Обходим все StandTemplate--}}
{{--                foreach ($StandTemplates as $StandTemplate) {--}}

{{--                    // Обходим week_schedule внутри каждого StandTemplate--}}
{{--                    foreach ($StandTemplate->week_schedule as $day => $times) {--}}

{{--                        // Если ключа нет в $sortedData, добавляем его--}}
{{--                        if (!isset($sortedData[$day])) {--}}
{{--                            $sortedData[$day] = [];--}}
{{--                        }--}}

{{--                        // Добавляем данные для текущего StandTemplate--}}
{{--                        $sortedData[$day][] = [--}}
{{--                            'stand_name' => $StandTemplate->stand->name,--}}
{{--                            'date' => \App\Enums\WeekDaysEnum::getWeekDayDate($day),--}}
{{--                            'day_of_week' => \App\Enums\WeekDaysEnum::getWeekDay($day),--}}
{{--                            'times' => $times,--}}
{{--                            'template_id' => $StandTemplate->id,--}}
{{--                        ];--}}
{{--                    }--}}
{{--                }--}}
{{--            @endphp--}}


{{--            @foreach (range(1, 7) as $day)--}}
{{--            <div class="col-sm-12 col-lg-3 mb-4">--}}
{{--                @if (isset($sortedData[$day]))--}}
{{--                    @foreach ($sortedData[$day] as $entry)--}}
{{--                        @php--}}
{{--                            $standTemplateId = $StandTemplate->id; // Получаем id текущего StandTemplate--}}
{{--                        @endphp--}}
{{--                        <div class="card card-header card-header-content-between rounded text-center" style="background: #749FBA">--}}
{{--                            <div class="flex-grow-1">--}}
{{--                                <h2 class="dd">--}}
{{--                                    {{ $entry['day_of_week'] }} {{ $entry['date'] }}--}}
{{--                                </h2>--}}
{{--                                <h4 class="dd">--}}
{{--                                    {{ $entry['stand_name'] }}--}}
{{--                                </h4>--}}
{{--                            </div>--}}
{{--                            @php--}}
{{--                                $standPublishers = App\Models\StandPublishers::where('day', $day)--}}
{{--                                    ->where('date', $entry['date'])--}}
{{--                                    ->where('stand_template_id', $StandTemplate->id)--}}
{{--                                    ->get();--}}

{{--                                $canEdit = auth()->user()->can('stand.make_entry');--}}
{{--                                $hasUserIcon = false; // Флаг для отслеживания, был ли уже выведен значок--}}
{{--                            @endphp--}}

{{--                            @foreach ($standPublishers as $standPublisher)--}}
{{--                                @php--}}
{{--                                    $publishers = json_decode($standPublisher->publishers, true);--}}

{{--                                    foreach (['user_1', 'user_2', 'user_3', 'user_4'] as $userKey) {--}}
{{--                                        if (isset($publishers[$userKey]) && $publishers[$userKey] == auth()->user()->id) {--}}
{{--                                            $hasUserIcon = true; // Устанавливаем флаг в true--}}
{{--                                            break;--}}
{{--                                        }--}}
{{--                                    }--}}
{{--                                @endphp--}}
{{--                            @endforeach--}}

{{--                            @if ($hasUserIcon)--}}
{{--                                                                        <a class="btn btn-ghost-secondary btn btn-icon btn-ghost-secondary rounded-circle text-black" type="button" href="{{ route('stand.reportPage', $standPublisher->id) }}">--}}
{{--                                                                            <span class="display-4"><i class="fa-solid fa-pen"></i></span>--}}
{{--                                                                        </a>--}}
{{--                            @endif--}}
{{--                        </div>--}}
{{--                        <div class="card-body mb-4">--}}
{{--                            @foreach ($entry['times'] as $time)--}}
{{--                                @php--}}
{{--                                    $standPublisher = App\Models\StandPublishers::where('day', $day)--}}
{{--                                        ->where('time', $time)--}}
{{--                                        ->where('date', $entry['date'])--}}
{{--                                        ->where('stand_template_id', $entry['template_id']) // Используем полученный id--}}
{{--                                        ->first();--}}

{{--                                    $publishers = [];--}}
{{--                                    if ($standPublisher) {--}}
{{--                                        $publishers = json_decode($standPublisher->publishers, true);--}}
{{--                                    }--}}
{{--                                    $canEdit = auth()->user()->can('stand.make_entry');--}}
{{--                                @endphp--}}
{{--                                <div class="col-sm-12 mt-1">--}}
{{--                                    <a class="card card-hover-shadow border border-secondary h-100 {{ isset($publishers['user_1']) && isset($publishers['user_2']) && $publishers['user_1'] && $publishers['user_2'] && (!$standPublisher || $canEdit) ? 'is-editable' : '' }}"--}}
{{--                                       @if($standPublisher && $canEdit)--}}
{{--                                           href="{{ route('recordRedactionPageMobile', ['stand_publishers_id'=> $standPublisher->id]) }}"--}}
{{--                                       @elseif(!$standPublisher && $canEdit)--}}
{{--                                           href="{{ route('recordRecordPage', ['day' => $day, 'time' => $time, 'date' => $entry['date'], 'stand_template_id'=> $entry['template_id']]) }}"--}}
{{--                                       @endif--}}
{{--                                       style="background-color: @if(isset($publishers['user_1']) && isset($publishers['user_2']) && $publishers['user_1'] && $publishers['user_2']) #5BB5A9 @elseif($standPublisher && $canEdit) #D5976B @endif;">--}}
{{--                                        <div class="row align-items-center">--}}
{{--                                            <!-- time -->--}}
{{--                                            <div class="col-3 text-center">--}}
{{--                                                <span class="text-dark h2">{{ $time }}</span>--}}
{{--                                            </div>--}}
{{--                                            <!-- publishers -->--}}
{{--                                            <div class="col-9">--}}
{{--                                                <div class="mt-1 mb-0">--}}
{{--                                                    @for($i = 1; $i <= $valuePublishers_at_stand; $i++)--}}
{{--                                                        @php--}}
{{--                                                            $userKey = 'user_' . $i;--}}
{{--                                                            $user = $publishers[$userKey] ?? null;--}}
{{--                                                        @endphp--}}

{{--                                                        @if ($user)--}}
{{--                                                            @if ($user == Auth()->user()->id)--}}
{{--                                                                <h3 class="text-primary">--}}
{{--                                                                    {{ $users->where('id', $user)->pluck('last_name')->first() }}--}}
{{--                                                                    {{ $users->where('id', $user)->pluck('first_name')->first() }}--}}
{{--                                                                </h3>--}}
{{--                                                            @else--}}
{{--                                                                <h3>--}}
{{--                                                                    {{ $users->where('id', $user)->pluck('last_name')->first() }}--}}
{{--                                                                    {{ $users->where('id', $user)->pluck('first_name')->first() }}--}}
{{--                                                                </h3>--}}
{{--                                                            @endif--}}
{{--                                                        @else--}}
{{--                                                            <h3><span class="badge bg-secondary">Свободно</span></h3>--}}
{{--                                                        @endif--}}
{{--                                                    @endfor--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </a>--}}
{{--                                    <!-- Ваш код для отображения времени -->--}}
{{--                                </div>--}}
{{--                            @endforeach--}}
{{--                        </div>--}}
{{--                    @endforeach--}}
{{--                @endif--}}
{{--            </div>--}}
{{--            @endforeach--}}
{{--        </div>--}}
{{--    </div>--}}
{{--@endcan--}}
@can('module.stand')
    <div class="content container-fluid">
        @include('Mobile.includes.alerts.alerts')
        @include('Mobile.menu.modules.stand.components.switchWeek')


        @if(date('N') . '-'. date('H:i') >= $activation)
        <div class="row">
            @php
                // Создаем временный массив для хранения данных о сортировке
                $sortedData = [];

                // Получаем все уникальные дни из week_schedule всех StandTemplate
                $allDays = collect($StandTemplates)->flatMap(function ($StandTemplate) {
                    return array_keys($StandTemplate->week_schedule);
                })->unique()->sort()->values()->all();

                // Сортируем дни по возрастанию
                ksort($allDays);

                // Обходим все StandTemplate
                foreach ($StandTemplates as $StandTemplate) {
                    // Обходим week_schedule внутри каждого StandTemplate
                    foreach ($StandTemplate->week_schedule as $day => $times) {
                        // Если ключа нет в $sortedData, добавляем его
                        if (!isset($sortedData[$day])) {
                            $sortedData[$day] = [];
                        }

                        // Если нет данных для текущего StandTemplate и текущего дня, создаем пустой массив
                        if (!isset($sortedData[$day][$StandTemplate->id])) {
                            $sortedData[$day][$StandTemplate->id] = [];
                        }

                        // Добавляем данные для текущего StandTemplate
                        $sortedData[$day][$StandTemplate->id][] = [
                            'stand_name' => $StandTemplate->stand->name,
                            'date' => \App\Enums\WeekDaysEnum::getNextWeekDayDate($day),
                            'day_of_week' => \App\Enums\WeekDaysEnum::getWeekDay($day),
                            'times' => $times,
                            'template_id' => $StandTemplate->id,
                        ];
                    }
                }
            @endphp

            {{-- Выводим отсортированные данные --}}
            @foreach ($allDays as $day) {{-- Перебираем все уникальные дни --}}
            <div class="col-sm-12 col-lg-3 mb-4">
                @foreach ($StandTemplates as $StandTemplate)
                    @if (isset($sortedData[$day][$StandTemplate->id]) && count($sortedData[$day][$StandTemplate->id]) > 0)
                        @php
                            $entry = $sortedData[$day][$StandTemplate->id][0]; // Берем первую запись, так как они все относятся к одному дню
                        @endphp
                        <div class="card card-header card-header-content-between rounded text-center" style="background: #749FBA">
                            <div class="flex-grow-1">
                                <h2 class="dd">
                                    {{ $entry['day_of_week'] }} {{ \Carbon\Carbon::parse($entry['date'])->format('d.m.Y') }}
                                </h2>
                                <h3 class="dd">
                                    {{ $entry['stand_name'] }}
                                </h3>
                            </div>
                            @php
                                $standPublishers = App\Models\StandPublishers::where('day', $day)
                                    ->where('date', $entry['date'])
                                    ->where('stand_template_id', $entry['template_id'])
                                    ->get();

                                $canEdit = auth()->user()->can('stand.make_entry');
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
                        <div class="card-body mb-4">
                            @foreach ($entry['times'] as $time)
                                @php
                                    $standPublisher = App\Models\StandPublishers::where('day', $day)
                                        ->where('time', $time)
                                        ->where('date', $entry['date'])
                                        ->where('stand_template_id', $entry['template_id'])
                                        ->first();

                                    $publishers = [];
                                    if ($standPublisher) {
                                        $publishers = json_decode($standPublisher->publishers, true);
                                    }
                                    $canEdit = auth()->user()->can('stand.make_entry');
                                @endphp
                                <div class="col-sm-12 mt-1">
                                    <a class="card card-hover-shadow border border-secondary h-100 {{ isset($publishers['user_1']) && isset($publishers['user_2']) && $publishers['user_1'] && $publishers['user_2'] && (!$standPublisher || $canEdit) ? 'is-editable' : '' }}"
                                       @if($standPublisher && $canEdit)
                                           href="{{ route('recordRedactionPageMobile', ['stand_publishers_id'=> $standPublisher->id]) }}"
                                       @elseif(!$standPublisher && $canEdit)
                                           href="{{ route('recordRecordPage', ['day' => $day, 'time' => $time, 'date' => $entry['date'], 'stand_template_id'=> $entry['template_id']]) }}"
                                       @endif
                                       style="background-color: @if(isset($publishers['user_1']) && isset($publishers['user_2']) && $publishers['user_1'] && $publishers['user_2']) #5BB5A9 @elseif($standPublisher && $canEdit) #D5976B @endif;">
                                        <div class="row align-items-center">
                                            <!-- time -->
                                            <div class="col-3 text-center">
                                                <span class="text-dark h2">{{ $time }}</span>
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
                                                                    {{ $users->where('id', $user)->pluck('last_name')->first() }}
                                                                    {{ $users->where('id', $user)->pluck('first_name')->first() }}
                                                                </h3>
                                                            @else
                                                                <h3>
                                                                    {{ $users->where('id', $user)->pluck('last_name')->first() }}
                                                                    {{ $users->where('id', $user)->pluck('first_name')->first() }}
                                                                </h3>
                                                            @endif
                                                        @else
                                                            <h3><span class="badge bg-secondary">Свободно</span></h3>
                                                        @endif
                                                    @endfor
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                    <!-- Ваш код для отображения времени -->
                                </div>
                            @endforeach
                        </div>
                    @endif
                @endforeach
            </div>
            @endforeach
        </div>
        @elseif($currentDateTime >= $activationDateTime)
                <div class="not-found-wrap text-center">
                    <h1 class="heading">Следующая неделя будет доступна</h1>
                    <h1 class="mb-5 text-muted text-20">{{ $dayName }} {{ $activation_value[1] }}</h1>
                </div>
        @endif

    </div>
@endcan




@endsection
