
<div class="row">
    @foreach($metrics as $metric)
        <div class="col-md-6">
            <div class="my-3 p-3 bg-body rounded shadow-sm mb-0 small lh-sm w-100 d-flex justify-content-between align-items-center">
                <div>
                    <a class="text-muted text-decoration-none h4" href="{{ $metric['route'] }}">
                        {{ $metric['title'] }}
                    </a>
                    <div class="d-flex align-items-center">
                        @if(isset($metric['count']))
                            <p class="h2 me-2">{{$metric['count']}}</p>
                        @endif
                        @if(isset($metric['percent']))
                            <span class="badge text-bg-primary">
                                            <i class="fa-solid fa-chart-line"></i>
                                            {{ number_format($metric['percent'], 2) }} %
                                        </span>
                        @endif
                    </div>
                </div>
                <a class="btn btn-outline-secondary" href="{{ $metric['route'] }}"><i class="bi-chevron-right text-body text-inherit"></i></a>
            </div>
        </div>
    @endforeach
</div>
