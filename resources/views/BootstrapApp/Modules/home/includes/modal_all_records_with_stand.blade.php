<div class="modal fade" id="exampleModalFullscreen" tabindex="-1" aria-labelledby="exampleModalFullscreenLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-fullscreen-sm-down">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-4" id="exampleModalFullscreenLabel">Все записи со стендом</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="tab-content mt-2" id="eventsTabContent">
                    <div class="tab-pane fade active show" id="this-week" role="tabpanel"
                         aria-labelledby="this-week-tab">
                        @foreach ($standPublishers as $standPublisher)
                            @foreach ($standPublisher->standTemplates as $standTemplate)


                                @php
                                    $link = isset($userInfo["stand_settings"]) && $userInfo["stand_settings"] == 1
                                        ? route('stand.current2', $standTemplate->stand_id)
                                        : route('stand.current2', $standTemplate->stand_id);
                                @endphp


                                <div class="d-flex list-group text-body-secondary pt-3">
                                    <div class="list-group-item align-items-center pb-3 mb-0 small lh-sm w-100">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="col p-1 d-flex flex-column position-static">
                                                <strong class="d-inline-block mb-2 text-success">Текущая неделя</strong>
                                                <h3 class="mb-0">
                                                    {{ trans('text.' . \App\Enums\WeekDaysEnum::getWeekDay($standPublisher->day)) }}
                                                    {{ \Carbon\Carbon::parse($standPublisher->time)->format('H:i') }}</h3>
                                                <div class="h5 mb-1 text-body-secondary">{{ \Carbon\Carbon::parse($standPublisher->date)->format('d.m.Y') }}</div>
                                                <p class="mb-auto">{{__('text.Стенд - ')}} {{ $standTemplate->Stand->location }}</p>
                                            </div>
                                            <a class="btn" href="{{$link}}"><i class="bi-chevron-right text-body text-inherit"></i></a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endforeach
                        @foreach ($standPublishersNextWeek as $standPublisherNextWeek)
                            @foreach ($standPublisherNextWeek->standTemplates as $standTemplate)


                                @php
                                    $link = isset($userInfo["stand_settings"]) && $userInfo["stand_settings"] == 1
                                        ? route('stand.next2', $standTemplate->stand_id)
                                        : route('stand.next2', $standTemplate->stand_id);
                                @endphp


                                <div class="d-flex list-group text-body-secondary pt-3">
                                    <div class="list-group-item pb-3 mb-0 small lh-sm w-100">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="col p-1 d-flex flex-column position-static">
                                                <strong class="d-inline-block mb-2 text-primary">Следующая неделя</strong>
                                                <h3 class="mb-0">
                                                    {{ trans('text.' . \App\Enums\WeekDaysEnum::getWeekDay($standPublisherNextWeek->day)) }}
                                                    {{ \Carbon\Carbon::parse($standPublisherNextWeek->time)->format('H:i') }}</h3>
                                                <div class="h5 mb-1 text-body-secondary">{{ \Carbon\Carbon::parse($standPublisherNextWeek->date)->format('d.m.Y') }}</div>
                                                <p class="mb-auto">{{__('text.Стенд - ')}} {{ $standTemplate->Stand->location }}</p>
                                            </div>
                                            <a class="btn" href="{{$link}}"><i
                                                    class="bi-chevron-right text-body text-inherit"></i></a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endforeach
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <div class="row col-12">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                </div>
            </div>
        </div>
    </div>
</div>
