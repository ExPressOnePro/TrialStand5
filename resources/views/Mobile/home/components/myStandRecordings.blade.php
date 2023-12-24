<div class="row justify-content-center">
    <div class="col-lg-4 mb-3 mb-lg-5 mx-auto">
        @can('module.stand')
            @if($standPublishersCountAll > 0)
                <div class="list-group d-flex align-items-center border border-primary">
                    <a class="list-group-item list-group-item-action" href="{{ route('home.recordsWithStandPage') }}">
                        <div class="d-flex align-items-center">
                            <div class="avatar avatar-sm avatar-soft-primary avatar-circle">
                                <span class="avatar-initials">{{$standPublishersCountAll}}</span>
                            </div>
                            <div class="ms-3">
                                <span class="d-block h1 text-inherit mb-0">{{ __('text.Мои записи со стендом') }}</span>
                                <span class="d-block h5 text-inherit text-body mb-0">{{ __('text.Просмотрите когда вы записались') }}</span>
                            </div>
                        </div>
                    </a>
                </div>
            @else
                <div class="list-group d-flex align-items-center border border-primary">
                        <a class="list-group-item list-group-item-action" href="{{ route('stand.hub') }}">
{{--                        @if(isset($userInfo["stand_settings"]) && $userInfo["stand_settings"] == 1)--}}
{{--{{ route('stand.hub') }}--}}
{{--@else--}}
{{--    {{ route('stand.hub') }}--}}
{{--@endif">--}}
                            <div class="d-flex align-items-center">
                                <div class="ms-3">
                                    <span class="d-block h1 text-inherit mb-0">{{ __('text.Нет записей') }}</span>
                                    <span class="d-block h5 text-inherit text-body mb-0">{{ __('text.Запишитесь в служение со стендом') }}</span>
                                </div>
                            </div>
                        </a>
                </div>
            @endif
        @endcan
    </div>
</div>
