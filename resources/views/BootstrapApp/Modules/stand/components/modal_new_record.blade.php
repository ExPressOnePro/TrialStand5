<div class="modal fade" id="exampleModalFullscreen{{$day}}{{$time}}{{$gwe}}" tabindex="-1" aria-labelledby="exampleModalFullscreenLabel"
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
                        <h3 class="mb-0">{{ __('text.Дата') }}:  {{ $gwe }}</h3>
                        <h3 class="mb-0">{{ __('text.Время') }}:  {{ date('H:i', strtotime($time)) }}</h3>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-lg-12 mb-3 mb-lg-5 mx-auto">
                        <div class="card card-hover-shadow border-secondary mt-4">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="flex-grow-1">
                                        <h3 class="text-inherit mb-4">{{ __('text.возвещатель') }}</h3>

                                        <form id="recordStandFirst" method="post" action="{{ route('NewRecordStand2') }}">
                                            @csrf
                                            <input type="hidden" name="time1" id="time" value="{{ $time }}">
                                            <input type="hidden" name="date1" id="date" value="{{$gwe}}">
                                            <input type="hidden" name="day1" id="day" value="{{$day}}">
                                            <input type="hidden" name="stand_template_id1" id="stand_template_id" value="{{$StandTemplate->id}}">
                                            <div class="tom-select-custom">
                                                <select class="js-select form-select border-secondary" autocomplete="off" name="user_1" id="user_1"
                                                        data-hs-tom-select-options='{
              "placeholder": "<div><i class=\"bi-person me-2\"></i> Select member</div>",
              "hideSearch": true,
              "width": "20rem"
            }'>
                                                    @foreach ($users as $user)
                                                        @if (auth()->user()->id == $user->id)
                                                            <option value="{{ $user->id }}" selected>{{ $user->last_name }} {{ $user->first_name }}</option>
                                                        @else
                                                            <option value="{{ $user->id }}">{{ $user->last_name }} {{ $user->first_name }}</option>
                                                        @endif
                                                    @endforeach

                                                </select>
                                            </div>

                                            <div class="row mt-4">
                                                <div class="col-12">
                                                    <div class="d-grid gap-2">
                                                        <button class="btn btn-success" type="submit">
                                                            {{ __('text.Записать') }}
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
            </div>
        </div>
    </div>
</div>
