
<div class="modal fade" id="ModalFullscreenRedaction{{$day}}{{$time}}{{$gwe}}{{$standPublisherId}}" tabindex="-1" aria-labelledby="exampleModalFullscreenLabel" aria-hidden="true">

    <div class="modal-dialog modal-fullscreen-sm-down">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-4" id="exampleModalFullscreenLabel">{{ __('text.Информация о записи') }}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                    <div class="col p-4 d-flex flex-column position-static">
                        <h3 class="mb-0">{{ __('text.Дата') }}:  {{ $gwe }}</h3>
                        <h3 class="mb-0">{{ __('text.Время') }}:  {{ date('H:i', strtotime($time)) }}</h3>
                    </div>
                </div>
                @for ($i = 1; $i <= $settings['publishers_at_stand']; $i++)
                    @php
                        $userKey = "user_$i";
                        $isUserEmpty = empty($publishers[$userKey] ?? null);
                        $currentUser = auth()->id();
                        $isCurrentUser = ($currentUser == ($publishers[$userKey] ?? null) && !$publishers[$userKey]);
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

                                    <form id="changeForm{{ $i }}" method="post" action="{{ route('AddPublisherToStand2', [$standPublisherId, 'stand' => $stand->id]) }}">
                                        @csrf
                                        <div class="tom-select-custom">
                                            <select class="js-select form-select" autocomplete="off" name="user_id" id="user_id" @if($isUserEmpty) @else disabled readonly @endif>
                                                @php
                                                    $currentUser = auth()->user();
                                                @endphp

                                                <option value="{{ $currentUser->id }}" {{ (isset($publishers[$userKey]) && $publishers[$userKey] == $currentUser->id || $isCurrentUser) ? 'selected' : '' }}>
                                                    {{ $currentUser->last_name }} {{ $currentUser->first_name }}
                                                </option>

                                                @foreach ($users as $user)
                                                    @if ($user->id != $currentUser->id)
                                                        <option value="{{ $user->id }}" {{ (isset($publishers[$userKey]) && $publishers[$userKey] == $user->id) ? 'selected' : '' }}>
                                                            {{ $user->last_name }} {{ $user->first_name }}
                                                        </option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                        @if($isUserEmpty)
                                            <div class="col-12 mt-2">
                                                <div class="d-grid gap-2">
                                                    <button class="btn btn-success" type="submit">
                                                        {{ __('text.Записать') }}
                                                    </button>
                                                </div>
                                            </div>
                                        @endif
                                    </form>
                                </div>
                            </div>

                            @if($isUserEmpty)
                                @can('stand.make_entry')

                                @endif
                            @else
                                @can('stand.delete_entry')
                                    <div class="col-12">
                                        <div class="d-grid gap-2">
                                            <a class="btn btn-outline-danger" type="button" href="{{ route('recordRedactionDelete2', ['id' => $standPublisher->id, 'stand' => $stand->id, 'user_id' => $publishers[$userKey] ?? null]) }}"
                                               onclick="document.getElementById('loadingOverlay').style.display = 'flex';">
                                                {{ __('text.Выписать') }}
                                            </a>
                                        </div>
                                    </div>
                                @endcan
                            @endif
                        </div>
                    </div>
                @endfor
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
            </div>
        </div>
    </div>
</div>
