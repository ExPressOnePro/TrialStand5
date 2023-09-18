@if($congregationRequestsCount > 0)
    @can('congregation.open_congregation')
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <span class="fw-semibold">
                @if(Auth()->user()->hasRole('Developer'))
                    В собраниях новые запросы
                @else
                    В вашем собрании новый запрос
                @endif
            </span>
            <span class="badge bg-primary rounded-pill ms-1">{{$congregationRequestsCount}}</span>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endcan
@else
@endif
