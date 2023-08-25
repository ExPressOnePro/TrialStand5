@if($congregationRequestsCountAll)
    <div class="alert alert-soft-info mb-5 mb-lg-7" role="alert">
        <div class="d-flex align-items-center">
            <div class="flex-grow-1 ms-3">
                <h3 class="alert-heading mb-1"></h3>
                <p class="mb-0">Новые запросы в собрания
                    <span class="badge bg-primary">{{$congregationRequestsCountAll}}</span>
                </p>
            </div>
        </div>
    </div>
@else
@endif

<div class="row">
    <div class="col-6 col-sm-4 col-sm-3 mb-5">
        <a class="card card-bordered h-100 text-center" href="{{ route('users') }}">

            <div class="card-body">
                <h3 class="card-title">Browse file</h3>
                <p class="card-text fs-6">Все Пользователи</p>
            </div>
        </a>
    </div>

    <div class="col-6 col-sm-4 col-sm-3 mb-5">
        <a class="card card-bordered h-100 text-center" href="{{ route('meetingSchedules.overview') }}">
            <div class="card-body">
                <h3 class="card-title">Test</h3>
                <p class="card-text fs-6">Meeting Schedules</p>
            </div>
        </a>
    </div>
    <div class="col-6 col-sm-4 col-sm-3 mb-5">
        <a class="card card-bordered h-100 text-center" href="{{ route('testViewButtons') }}">
            <div class="card-body">
                <h3 class="card-title">Test_1</h3>
            </div>
        </a>
    </div>
    <!-- End Col -->
</div>
