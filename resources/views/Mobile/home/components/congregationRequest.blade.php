@if($congregationRequestsCount > 0)
    @can('congregation.open_congregation')
        <a class="row justify-content-center"  href="{{route('congregation.requests', Auth()->user()->congregation_id)}}">
            <div class="col-lg-4 mb-3 mb-lg-5 mx-auto">
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
            </div>
        </a>
    @endcan
@else
@endif
