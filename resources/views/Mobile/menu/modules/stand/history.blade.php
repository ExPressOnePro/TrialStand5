@extends('Mobile.layouts.app')
@section('title') Meeper | Стенды @endsection
@section('content')

    <div class="main-content pt-4">
        <div class="separator-breadcrumb border-top"></div>
        <div class="row">
            @empty($audits)
                <h2 class="heading">Значений нет</h2>
            @else

            <table class='table table-sm table-hover mb-0'>
                <thead>
                <tr>
                    <th>Кто</th>
                    <th>Инфо о записи</th>
                    <th>Старое значение</th>
                    <th>Новое значение</th>
                    <th >Время изменения</th>
                </tr>
                </thead>
                <tbody>
                @foreach($audits as $audites)
                    @foreach($audites as $audit)
                    <tr>
                        <th class="value1">
                            <div class="align-items-center">
                                <span class="text-center">
                                    {{ App\Models\User::find($audit->user_id)->first_name }}
                                    {{ App\Models\User::find($audit->user_id)->last_name }}
                                </span>
                            </div>
                        </th>
                        <th class="value4">
                            <div class="align-items-center">
                                @if(is_null(App\Models\StandPublishers::find($audit->auditable_id)))
                                    <span class="text-center">Дата: null</span><br>
                                    <span class="text-center">Время: null </span><br>
                                    <span class="text-center">День недели: null </span><br>
                                @else
                                <span class="text-center">Дата: {{App\Models\StandPublishers::find($audit->auditable_id)->date}} </span><br>
                                <span class="text-center">Время: {{App\Models\StandPublishers::find($audit->auditable_id)->time}} </span><br>
                                <span class="text-center">День недели: {{App\Models\StandPublishers::find($audit->auditable_id)->day}} </span><br>
                                @endif
                            </div>
                        </th>
                        <th class="value5">
                            <div class="align-items-center">
                                @foreach($audit->old_values as $key => $old_value)
                                    <span class="text-center">
                                        @if ($key == 'user_1')
                                            <span class="text-secondary">Первый Возвещатель</span><br>
                                        @elseif ($key == 'user_2')
                                            <span class="text-secondary">Второй Возвещатель</span><br>
                                        @endif
                                    <span class="text-center">
                                        @if (is_null($old_value))
                                            <span class="text-secondary">Пусто</span>
                                        @else
                                            @if(empty($old_value))
                                            @else
                                                {{ App\Models\User::find($old_value)->first_name }}
                                                {{ App\Models\User::find($old_value)->last_name }}
                                            @endempty
                                        @endif
                                    </span>
                                @endforeach
                            </div>
                        </th>
                        <th class="value6">
                            @if($audit->auditable_type == 'created')
                                @foreach($audit->new_values as $key => $new_value)
                                    @if ($key == 'user_1')
                                        @if (is_null($new_value))
                                            <span class="text-secondary">Первый Возвещатель</span><br>
                                            <span class="text-danger">вычеркнул</span><br>
                                        @else
                                            {{ App\Models\User::find($new_value)->first_name }}
                                            {{ App\Models\User::find($new_value)->last_name }}<br>
                                        @endif
                                    @elseif ($key == 'user_2')
                                        @if (is_null($new_value))
                                            <span class="text-secondary">Второй Возвещатель</span><br>
                                            <span class="text-danger">вычеркнул</span><br>
                                        @else
                                            {{ App\Models\User::find($new_value)->first_name }}
                                            {{ App\Models\User::find($new_value)->last_name }}<br>
                                        @endif
                                    @endif
                                @endforeach
                            @else ($audit->auditable_type == 'updated')
                                @foreach($audit->new_values as $key => $new_value)
                                    <span class="text-center">
                                        @if (is_null($key == 'user_1'))
                                        @elseif ($key == 'user_1')
                                            @if (is_null($new_value))
                                            @else
                                                <span class="text-secondary">Первый Возвещатель</span><br>
                                                {{ App\Models\User::find($new_value)->first_name }}
                                                {{ App\Models\User::find($new_value)->last_name }}<br>
                                            @endif
                                        @elseif (is_null($key == 'user_2'))
                                        @elseif ($key == 'user_2')
                                            @if (is_null($new_value))
                                            @else
                                                <span class="text-secondary">Второй Возвещатель</span><br>
                                                {{ App\Models\User::find($new_value)->first_name }}
                                                {{ App\Models\User::find($new_value)->last_name }}<br>
                                            @endif
                                        @endif
                                @endforeach
                            @endif
                        </th>
                        <th class="value7">
                            {{$audit->created_at}}
                        </th>
                    </tr>
                @endforeach
                @endforeach
                    @endempty
                </tbody>
            </table>
        </div>

    </div>


@endsection
