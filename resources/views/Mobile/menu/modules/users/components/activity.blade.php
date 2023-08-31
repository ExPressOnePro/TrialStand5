<div class="col-lg-8">
    <div class="d-grid gap-3 gap-lg-5">
        <!-- Card -->
        <div class="card">
            <!-- Header -->
            <div class="card-header card-header-content-between">
                <h4 class="card-header-title">Активность пользователя</h4>
            </div>
            <!-- End Header -->

            <!-- Body -->
            <div class="card-body card-body-height" style="height: 30rem;">
                <!-- Step -->
                <ul class="step step-icon-xs mb-0">

{{--                    @foreach($user->audits as $audit)--}}
{{--                        <p>ID аудита: {{ $audit->orderBy("id", "desc")->first()->id }}</p>--}}
{{--                        <p>Отредактировано: {{ $audit->created_at }}</p>--}}
{{--                        <p>Изменения:</p>--}}
{{--                        <ul>--}}
{{--                            @foreach($audit->old_values as $attribute => $value)--}}
{{--                                <li>{{ $attribute }}: {{ $value }} &rarr; <br>{{ $audit->new_values[$attribute] }}</li>--}}
{{--                            @endforeach--}}
{{--                        </ul>--}}
{{--                    @endforeach--}}

                    <!-- Step Item -->

                    @foreach($user->audits() as $audit)
                        <li>
                            <h5>{{ $audit->user->name }}</h5>
                            <p>{{ $audit->created_at }}</p>
                            <p>{{ $audit->field }}</p>
                            <p>{{ $audit->old_values[$audit->field] }}</p>
                            <p>{{ $audit->new_values[$audit->field] }}</p>
                        </li>
                    @endforeach
                        @foreach($user->audits()->orderBy('id', 'desc')->limit(10)->get() as $audit)
                        <li class="step-item">
                            <div class="step-content-wrapper">
                                <span class="step-icon step-icon-pseudo step-icon-soft-dark"></span>

                                <div class="step-content">
                                    <h5 class="step-title">
                                        <a class="text-dark" href="#">Когда: {{ $audit->created_at }}</a>
                                        <span class="badge bg-soft-primary text-primary rounded-pill">
                                            {{ $audit->id }}
                                        </span>
                                    </h5>
                                    <ul>
                                        @foreach($audit->old_values as $attribute => $value)
                                            <li>{{ $attribute }}: {{ $value }} &rarr; <br>{{ $audit->new_values[$attribute] }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </li>
                        @endforeach
                    <!-- End Step Item -->

                    <!-- Step Item -->
                    <li id="collapseActivitySection" class="step-item collapse">
                        <div class="step-content-wrapper">
                            <span class="step-icon step-icon-pseudo step-icon-soft-dark"></span>

                            <div class="step-content">
                                <h5 class="step-title">
                                    <a class="text-dark" href="#">Project status updated</a>
                                </h5>

                                <p class="fs-5 mb-1">Updated <a class="text-uppercase" href="#"><i class="bi-journal-bookmark-fill"></i> Fr-3</a> as <span class="badge bg-soft-secondary text-secondary rounded-pill"><span class="legend-indicator bg-secondary"></span>"To do"</span></p>

                                <span class="text-muted small text-uppercase">Feb 10</span>
                            </div>
                        </div>
                    </li>
                    <!-- End Step Item -->
                </ul>
                <!-- End Step -->
            </div>
            <!-- End Body -->

            <!-- Footer -->
            <div class="card-footer">
                <a class="link link-collapse" data-bs-toggle="collapse" href="#collapseActivitySection" role="button" aria-expanded="false" aria-controls="collapseActivitySection">
                    <span class="link-collapse-default">View more</span>
                    <span class="link-collapse-active">View less</span>
                </a>
            </div>
            <!-- End Footer -->
        </div>
        <!-- End Card -->
    </div>

    <!-- Sticky Block End Point -->
    <div id="stickyBlockEndPoint"></div>
</div>
