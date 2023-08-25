<th class="value5">
    @if(empty($standPublisher) || is_null($standPublisher->user) && is_null($standPublisher->user2)){{--если не создана запись--}}
    @else
        @if(auth()->user()->can('Stand-Entry in table'))
            @if(empty($standPublisher) || is_null($standPublisher->user) && is_null($standPublisher->user2)
            || is_null($standPublisher->user) && $standPublisher->user2->id != auth()->id()
            || is_null($standPublisher->user2) && $standPublisher->user->id != auth()->id())
            @else
                <div class="align-items-center">
                    <button class="btn btn-dark m-1" type="button" data-toggle="modal" data-target="#hourReportModal{{$standPublisher->id }}">
                        Отчет
                    </button>
                </div>
                <div class="modal fade" id="hourReportModal{{$standPublisher->id }}" tabindex="-1" role="dialog" aria-labelledby="" style="display: none;" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="personalReportModal-2">Отчет служения со стендом</h5>
                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>

                            <div class="modal-body">
                                {{--@if(is_null($StandReports) || $StandReports->StandPublishers_id != $StandPublishers->id)--}}
                                <form id="report" method="POST" action="{{ route('standReportSend', $StandTemplate->id) }}">
                                    @csrf
                                    <input type="hidden" name="day" id="day" value="{{$standPublisher->day }}">
                                    <input type="hidden" name="time" id="time" value="{{$standPublisher->time }}">
                                    <input type="hidden" name="date" id="date" value="{{$standPublisher->date }}">
                                    <h5 class="heading text-success font-weight-bold line-height-1 mb-1" >
                                        Дата {{$standPublisher->date }}
                                    </h5>
                                    <h5 class="heading text-success font-weight-bold line-height-1 mb-5">
                                        Время {{$standPublisher->time }}
                                    </h5>
                                    <div class="d-flex flex-column">
                                        <!-- Publications -->
                                        <div class="form-group mb-3">
                                            <h5 class="heading" >Публикации (печатные/электронные)</h5>
                                            <input class="form-control form-control-rounded @error('publications') is-invalid @enderror" name="publications" id="publications" type="text" value="0">
                                            @error('publications')
                                            <div class="alert alert-card alert-danger">Публикации не заполнены</div>
                                            @enderror
                                        </div>
                                        <!-- Videos -->
                                        <div class="form-group mb-3">
                                            <h4 class="heading" >Видеоролики</h4>
                                            <input class="form-control form-control-rounded @error('videos') is-invalid @enderror" name="videos" id="videos" type="text" value="0">
                                            @error('videos')
                                            <div class="alert alert-card alert-danger">Видеоролики не заполнены</div>
                                            @enderror
                                        </div>
                                        <!-- return visits -->
                                        <div class="form-group mb-3">
                                            <h4 class="heading">Повторные посещения</h4>
                                            <input class="form-control form-control-rounded @error('return_visits') is-invalid @enderror" name="return_visits" id="return_visits" type="text" value="0">
                                            @error('return_visits')
                                            <div class="alert alert-card alert-danger">Видео не заполнены</div>
                                            @enderror
                                        </div>
                                        <!-- bible studies -->
                                        <div class="form-group mb-3">
                                            <h4 class="heading">Изучения Библии</h4>
                                            <input class="form-control form-control-rounded @error('bible_studies') is-invalid @enderror" name="bible_studies" id="bible_studies" type="text" value="0">
                                            @error('bible_studies')
                                            <div class="alert alert-card alert-danger">Изучения Библии не заполнены</div>
                                            @enderror
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-secondary" type="submit" data-dismiss="modal">Закрыть</button>
                                <a class="btn btn-success" type="button" href="{{ route('standReportSend', $StandTemplate->id) }}"
                                   onclick="event.preventDefault(); document.getElementById('report').submit();">
                                    Отправить
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        @else
        @endif
    @endif
</th>
