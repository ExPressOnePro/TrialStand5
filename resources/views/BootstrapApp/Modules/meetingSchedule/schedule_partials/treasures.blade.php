
<h4 class="pb-1 d-flex align-items-center" style="color: #2A6B77">
    <div
        class="icon-square d-flex align-items-center justify-content-center fs-4 flex-shrink-0 me-3 p-2 rounded-2"
        style="background-color: #2A6B77; width: 1.5em; height: 1.5em;">
        <img class="rounded-2" src="{{ asset('front/img/gem.svg') }}" style="width: 1.5em; height: 1.5em;">
    </div>
    СОКРОВИЩА ИЗ СЛОВА БОГА
</h4>
@php $count = count($datas['weekday']['treasures']); @endphp

@foreach($datas['weekday']['treasures'] as $key => $value)
    <div class="no-select d-flex justify-content-between align-items-center @if($loop->index != $count - 1)
        border-bottom
    @endif" id="program-item-{{$loop->index}}"
         onmouseover="highlightItem('{{$loop->index}}')"
         onmouseout="removeHighlight('{{$loop->index}}')"
         onclick="handleClick({{$value['value']['user_id']}}, '{{$value['value']['user_name']}}')">
        <div class="col ms-0">
            <h6 style="color: #2A6B77; overflow: hidden; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical;">
                @empty($value['name'])
                    название пункта программы
                @else
                    {{ $value['name'] }}
                @endempty
            </h6>
        </div>
        <div class=" text-end">
            @empty($value['value'])
                <h6 class="text-muted lh-sm">ведущий пункта</h6>
            @else
                @if($value['value']['user_id'] == $AuthUserId)
                    <h6 class="text-primary ">{{$value['value']['user_name']}}</h6>
                @else
                    <h6 class="text-muted">{{ $value['value']['user_name'] }}</h6>
                @endempty
            @endempty
        </div>
    </div>
@endforeach
<script>
    function highlightItem(index) {
        var item = document.getElementById('program-item-' + index);
        item.classList.add('highlight');
    }

    function removeHighlight(index) {
        var item = document.getElementById('program-item-' + index);
        item.classList.remove('highlight');
    }

    function handleClick(userId, userName) {
        // Выполните здесь ваш AJAX-запрос, используя userId и userName
        // Например:
        // $.ajax({
        //     type: 'POST',
        //     url: '/your-endpoint',
        //     data: {userId: userId, userName: userName},
        //     success: function(response) {
        //         // Обработка успешного ответа
        //     },
        //     error: function(xhr, status, error) {
        //         // Обработка ошибки
        //     }
        // });
    }
</script>
<style>
    .highlight {
        background-color: #e9ecef; /* Цвет выделения при наведении */
    }
    .no-select {
        user-select: none;
    }
</style>

