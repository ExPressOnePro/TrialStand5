<div class="d-none d-md-block">
    <table class="table table-responsive-sm table-bordered table-sm table-secondary lh-sm">
        <tbody>
        @foreach($datas['weekday']['responsible_users'] as $key => $value)
            @if ($loop->odd)
                <tr>
                    @endif
                    <td>
                        <dd>
                            @empty($value['name'])
                                Название службы
                            @else
                                {{ $value['name'] }}
                            @endempty
                        </dd>
                    </td>

                    <td>
                        @isset($value['value'])
                            @if($value['value']['user_id'] == $AuthUserId)
                                <h6 class="text-primary">{{ $value['value']['user_name'] }}</h6>
                            @else
                                <dd>{{ $value['value']['user_name'] }}</dd>
                            @endempty
                        @else
                            <dd>Нет ответственного</dd>
                        @endisset
                    </td>

                    @if ($loop->even || $loop->last)
                </tr>
            @endif
        @endforeach
        </tbody>
    </table>
</div>


<div class="table-responsive d-sm-none">
    <table class="table table-nowrap table-sm table-secondary lh-sm" style="overflow-x: auto;">
        <tbody>
        @foreach($datas['weekday']['responsible_users'] as $key => $value)
            <tr>
                <td>
                    @empty($value['name'])
                        <dd>Название службы</dd>
                    @else
                        <dd>{{ $value['name'] }}</dd>
                    @endempty
                </td>
                <td class="text-end">
                    @isset($value['value'])
                        @if($value['value']['user_id'] == $AuthUserId)
                            <h6 class="text-primary">{{ $value['value']['user_name'] }}</h6>
                        @else
                            <dd>{{ $value['value']['user_name'] }}</dd>
                        @endif
                    @else
                        <dd>Нет ответственного</dd>
                    @endisset
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
