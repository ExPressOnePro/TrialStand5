@extends('Mobile.layouts.front.app')
@section('title') Meeper | новая запись @endsection
@section('content')

    <div class="content container-fluid">
        <div class="alert alert-soft-dark border-info mb-5 mb-lg-7" role="alert">
            <div class="d-flex align-items-center">
                <div class="flex-grow-1 ms-3">
                    <h3 class="alert-heading mb-1">Информация о записи</h3>
                    <p class="mb-0">Дата: {{ $date }}</p>
                    <p class="mb-0">Время:  {{ date('H:i', strtotime($time . ':00')) }}</p>
                </div>
            </div>
        </div>

        <div class="card card-hover-shadow border-secondary mt-4">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1">
                        <h3 class="text-inherit mb-4">Первый возвещатель</h3>

                        <form id="recordStandFirst" method="post" action="{{ route('NewRecordStand1') }}">
                            @csrf
                            <input type="hidden" name="time1" id="time" value="{{$time}}">
                            <input type="hidden" name="date1" id="date" value="{{$date}}">
                            <input type="hidden" name="day1" id="day" value="{{$day}}">
                            <input type="hidden" name="stand_template_id1" id="stand_template_id" value="{{$standTemplate->id}}">
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
                        </form>
                    </div>
                </div>
            </div>
            @can('stand.make_entry')
            <div class="card-footer">
                <div class="row">
                    <div class="col-12">
                        <div class="d-grid gap-2">
                            <a class="btn btn-success btn-sm" type="button" href="{{ route('NewRecordStand1') }}"
                               onclick="event.preventDefault();
                   document.getElementById('recordStandFirst').submit();">
                                Записать
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endcan
        </div>

@endsection
