<div class="col-lg-9">
    <div class="card">
        <div class="card-header d-flex align-items-center">
            <h1 class="heading float-left card-title m-0">Активное время</h1>
        </div>
        <div class="card-body align-items-center">
            <form id="StandTimeNext" action="{{ route('StandTimeNext', ['id' => $stand->id]) }}" method="post">
                @csrf
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th></th>
                            @foreach($daysOfWeek as $dayNumber => $dayName)
                                <th><center>{{ $dayName }}</center></th>
                            @endforeach
                        </tr>
                        @for($i = 6; $i <= 21; $i++)
                            <tr>
                                <td><center>{{ $i }}:00</center></td>
                                @foreach($daysOfWeek as $dayNumber => $dayName)
                                    <td>
                                        <label class="form-check form-switch m-1">
                                            <input type="checkbox" id="formSwitch1" class="form-check-input" name="schedule[{{ $dayNumber }}][]" value="{{ $i }}" {{ in_array($i, $template->week_schedule[$dayNumber] ?? []) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="formSwitch1"></label>
                                        </label>
                                    </td>
                                @endforeach
                            </tr>
                        @endfor
                    </table>
                </div>
                <div class="row col-12 mt-2">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModalCenterStandTimeNext">
                    {{ __('Изменения со следующей недели') }}
                </button>
                </div>
            </form>
            <div class="row col-12 mt-2">
                <button type="button" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#exampleModalCenterStandTimeNextToCurrent">
                    {{ __('Изменения с текущей недели') }}
                </button>
{{--                <a href="{{ route('StandTimeNextToCurrent', ['id' => $stand->id]) }}">--}}
{{--                    <button class="btn btn-danger mb-3" type="submit">{{ __('Изменения с текущей недели') }}</button>--}}
{{--                </a>--}}
            </div>
        </div>
    </div>
</div>


<!-- Modal -->
<div id="exampleModalCenterStandTimeNext" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterStandTimeNext" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">{{ __('Изменения со следующей недели') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="alert alert-soft-primary" role="alert">
                    <div class="d-flex">
                        <div class="flex-shrink-0">
                            <i class="bi-exclamation-triangle-fill"></i>
                        </div>
                        <div class="flex-grow-1 ms-2">
                            Информация: Пожалуйста прочтите
                        </div>
                    </div>
                </div>
                <p>Нажимая на кнопку сохранить изменения, график служения со стендом на следующую неделю будет обновлен в соответсвии с выбранными вами часами.</p>
                <p>Учтите! Если следующая неделя уже доступна для записей и возвещатели записывались они не увидят своих записей!</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Закрыть</button>
                <a type="button" class="btn btn-primary" href="{{ route('StandTimeNext',['id' => $stand->id] ) }}"
                   onclick="event.preventDefault();
                                   document.getElementById('StandTimeNext').submit();">
                    {{ __('Сохранить изменения') }}
                </a>
            </div>
        </div>
    </div>
</div><!-- End Modal -->
<div id="exampleModalCenterStandTimeNextToCurrent" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterStandTimeNextToCurrent" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">{{ __('Изменения с текущей недели') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="alert alert-soft-primary" role="alert">
                    <div class="d-flex">
                        <div class="flex-shrink-0">
                            <i class="bi-exclamation-triangle-fill"></i>
                        </div>
                        <div class="flex-grow-1 ms-2">
                            Информация: Пожалуйста прочтите
                        </div>
                    </div>
                </div>
                <p>Нажимая на кнопку сохранить изменения, график служения со стендом на Текущую неделю будет обновлен в соответсвии с выбранными вами часами.</p>
                <p>Учтите! На этой неделе уже есть записи возвещателей, изменив сейчас вы отключите все записи и возвещатели их не увидят!</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Закрыть</button>
                <a href="{{ route('StandTimeNextToCurrent', ['id' => $stand->id]) }}">
                    <button class="btn btn-primary" type="submit">{{ __('Сохранить изменения') }}</button>
                </a>
            </div>
        </div>
    </div>
</div><!-- End Modal -->
