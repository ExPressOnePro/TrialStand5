@can('module.stand')
    @php
        $link2 = (isset($userInfo["stand_settings"]) && $userInfo["stand_settings"] == 1)
            ? route('stand.hub2')
            : route('stand.hub2');
    @endphp

    @if($standPublishersCountAll > 0)
            <div class="col-md-6 mt-5 mb-5">
                <div class="my-3 p-3 bg-body rounded shadow-sm">
                    <h3 class="border-bottom pb-2 mb-0">{{ __('text.Мои записи со стендом') }}</h3>
                    @empty($standPublishersToday)
                        @else
                        @foreach ($standPublishersToday as $standPublisher)
                            @foreach ($standPublisher->standTemplates as $standTemplate)
                                @php
                                    $link = isset($userInfo["stand_settings"]) && $userInfo["stand_settings"] == 1
                                        ? route('stand.aio_current2')
                                        : route('stand.current2', $standTemplate->stand_id);
                                @endphp
                                <div class="d-flex text-body-secondary pt-3">
                                    <div class="pb-3 mb-0 small lh-sm border-bottom w-100">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>
                                                <a class="text-gray-dark text-decoration-none h4" href="{{$link}}">
                                                    <strong class="d-inline-block text-success">Сегодня</strong>

                                                    {{ \Carbon\Carbon::parse($standPublisher->time)->format('H:i') }}
                                                </a>
                                                <span class="d-block">{{__('text.Стенд - ')}} {{ $standTemplate->Stand->location }}</span>
                                            </div>
                                            <a class="btn" href="{{$link}}"><i class="bi-chevron-right text-body text-inherit"></i></a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endforeach
                    @endif
                    <div class="row col d-block text-end mt-3">
                        <a class="text-decoration-none btn" data-bs-toggle="modal" data-bs-target="#exampleModalFullscreen">
                            Все записи
                            <span class="badge bg-primary bg-opacity-50 rounded-2 ms-2">{{ $standPublishersCountAll }}</span>
                        </a>
                    </div>
                </div>
            </div>
    @else
        <div class="col-md-6 mt-5">
            <a class="list-group-item list-group-item-action" href="{{$link2}}">
            <div class="my-3 p-3 bg-body rounded shadow-sm border">
                    <h1 class="text-body-emphasis">{{ __('text.Нет записей') }}</h1>
                    <p class="lead">
                        {{ __('text.Запишитесь в служение со стендом') }}
                    </p>
            </div>
            </a>
        </div>
    @endif
@endcan
