<style>
    .present-ms {
        user-select: none;
        background: linear-gradient(115deg, #3DA4F5, #5BC28C, #647BD9, #715fc2, #596AF1, #5fa8c2);
    }
</style>

<div class="container present-ms rounded-5 border align-items-center py-2 mb-2 mt-4">
    <a class="h2 fw-bold row col text-decoration-none text-white" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="true" aria-controls="collapseExample">
        Крупное обновление
    </a>
    <div class="collapse" id="collapseExample">
        <a class="row present no-select  align-items-center rounded-5 text-decoration-none" href="{{route('presentation.meetingSchedules')}}">
            <div class="col-lg-7 p-3 p-lg-5 pt-lg-3 text-white">
                <h1 class="display-4 fw-bold lh-1">Модуль Расписаний</h1>
                <p class="lead">"Расписания встреч без сложностей. Простое создание, управление с легкостью."</p>
            </div>
            <div class="col-lg-4 offset-lg-1 p-4 overflow-hidden" >
                <img src="{{ asset('images/present.png') }}" class=" rounded-4 mx-lg-auto img-fluid" width="350" height="200">
            </div>
        </a>
    </div>
</div>


