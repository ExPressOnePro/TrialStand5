
<h4 class="pb-1 d-flex align-items-center" style="color: #2A6B77">
    <div
        class="icon-square d-flex align-items-center justify-content-center fs-4 flex-shrink-0 me-3 p-2 rounded-2"
        style="background-color: #2A6B77; width: 1.5em; height: 1.5em;">
        <img class="rounded-2" src="{{ asset('front/img/gem.svg') }}" style="width: 1.5em; height: 1.5em;">
    </div>
    СОКРОВИЩА ИЗ СЛОВА БОГА
</h4>
@foreach($datas['weekday']['treasures'] as $key => $value)
    <div class="d-flex justify-content-between align-items-center border-bottom">
        <div class="col-7">
            <h5 style="color: #2A6B77">
                @empty($value['name'])
                    название пункта программы
                @else
                    {{ $value['name'] }}
                @endempty
            </h5>
        </div>
        <div class="col-5 text-end">
            @empty($value['value'])
                <h6 class="text-muted lh-sm">ведущий пункта</h6>
            @else
                @if($value['value']['user_id'] == $AuthUserId)
                    <h5 class="text-primary ">{{$value['value']['user_name']}}</h5>
                @else
                    <h5 class="text-muted">{{ $value['value']['user_name'] }}</h5>
                @endempty
            @endempty
        </div>
    </div>
@endforeach

