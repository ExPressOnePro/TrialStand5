@extends('Mobile.layouts.front.app')
@section('title') Meeper | @endsection
@section('content')
    @can('users.open_meetings_responsible_users')
        <div class="main-content pt-4">
            <div class="row mb-4">
                <div class="col-md-12 mb-4">
                    <div class="card text-left">
                        <div class="card-body">
                            <h4 class="card-title mb-3">Пользователи ответсвенность</h4>

                            <form action="{{ route('users.updateResponsibilities') }}" method="post">
                                @csrf
                                    <table class="table-responsive datatable-custom" >
                                        <thead class="thead-light">
                                    <tr>
                                        <th>Имя пользователя</th>
                                        <th>Ответственность</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($users as $user)
                                        <tr>
                                            <td>{{ $user->first_name }} {{ $user->last_name }}</td>
                                            <td class="mb-2">
                                                <div class="tom-select-custom">
                                                    @php
                                                        $info = json_decode($user->info, true);
                                                        $responsible = isset($info['responsible']) ? $info['responsible'] : '';
                                                    @endphp
                                                    <select class="js-select form-select" autocomplete="off"
                                                            data-hs-tom-select-options='{
          "placeholder": "Выберите ответсвенность",
          "hideSearch": true
        }'>
                                                        <option value=""></option>
                                                        <option value="Publisher" {{ $responsible === 'Publisher' ? 'selected' : '' }}>Возвещатель</option>
                                                        <option value="Auxiliary pioneer" {{ $responsible === 'Auxiliary pioneer' ? 'selected' : '' }}>Подсобный пионер</option>
                                                        <option value="Regular pioneer" {{ $responsible === 'Regular pioneer' ? 'selected' : '' }}>Общий пионер</option>
                                                        <option value="Ministerial servants" {{ $responsible === 'Ministerial servants' ? 'selected' : '' }}>Служебный помощник</option>
                                                        <option value="Overseer" {{ $responsible === 'Overseer' ? 'selected' : '' }}>Старейшина</option>
                                                    </select>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                <button class="btn btn-outline-success" type="submit">Применить</button>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endcan
@endsection
