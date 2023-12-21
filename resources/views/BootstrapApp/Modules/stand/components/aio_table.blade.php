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
                $standType = request()->is('*aio_current*') ? 'current' : 'next';
                // Добавляем данные для текущего StandTemplate
                $sortedData[$day][$StandTemplate->id][] = [
                    'stand_name' => $StandTemplate->stand->name,
                    'date' => ($standType === 'current') ? \App\Enums\WeekDaysEnum::getWeekDayDate($day) : \App\Enums\WeekDaysEnum::getNextWeekDayDate($day),
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
                            {{ trans('text.' . $entry['day_of_week']) }} {{ \Carbon\Carbon::parse($entry['date'])->format('d.m.Y') }}
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
                                   href="{{ route('stand.record_redaction', ['stand_publishers_id'=> $standPublisher->id]) }}"
                               @elseif(!$standPublisher && $canEdit)
                                   href="{{ route('stand.record_create', ['day' => $day, 'time' => $time, 'date' => $entry['date'], 'stand_template_id'=> $entry['template_id']]) }}"
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
                                                    <h3><span class="badge bg-secondary">{{ __('text.Свободно') }}</span></h3>
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
