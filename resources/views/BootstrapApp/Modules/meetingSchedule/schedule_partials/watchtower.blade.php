<h4 class="pb-1 mb-1 d-flex align-items-center" style="color: #2B3F60">
    <div class="icon-square d-flex align-items-center justify-content-center fs-4 flex-shrink-0 me-3 p-2 rounded-2" style="background-color: #2B3F60; width: 1.5em; height: 1.5em;">
        <img class="rounded-2" src="{{ asset('images/watchtower_icon.svg') }}" style="width: 1.5em; height: 1.5em;">
    </div>
    ИЗУЧЕНИЕ СТАТЬИ ИЗ СТОРОЖЕВОЙ БАШНИ
</h4>
@foreach($datas['weekend']['watchtower'] as $key => $value)
    <div class="d-flex justify-content-between align-items-center border-bottom">
        <div class="col">
            <h5 style="color: #2B3F60">
                @empty($value['name'])
                    название пункта программы
                @else
                    {{ $value['name'] }}
                @endempty
            </h5>
        </div>
        <div class="col-5 text-end">
            @empty($value['value'])
                <h6 class="text-muted lh-sm">ведущий</h6>
            @else
                @if($value['value']['user_id'] == $AuthUserId)
                    <h5 class="text-primary lh-1">{{$value['value']['user_name']}}</h5>
                @else
                    <h5 class="text-muted lh-1">{{ $value['value']['user_name'] }}</h5>
                @endempty
            @endempty
            @isset($value['value_2'])
                @empty($value['value_2'])
                    <h5>чтец</h5>
                @else
                    @if($value['value_2']['user_id'] == $AuthUserId)
                        <h5 class="border-top text-primary lh-1"><span class="h6">Чтец: </span> {{$value['value_2']['user_name']}}</h5>
                    @else
                        <h5 class="text-muted border-top lh-1"><span class="h6">Чтец: </span>  {{ $value['value_2']['user_name'] }}</h5>
                    @endempty
                @endempty
            @endisset
        </div>
    </div>
@endforeach
