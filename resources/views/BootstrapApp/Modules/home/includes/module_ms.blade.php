<style>
    /*.present-ms {*/
    /*    user-select: none;*/
    /*    background: linear-gradient(115deg, #3DA4F5, #5BC28C, #647BD9, #715fc2, #596AF1, #5fa8c2);*/
    /*}*/

    .gradient {
        background: linear-gradient(45deg, #30cfd0, #330867);
        background-size: 400%;
        animation: gradient 10s ease infinite;
        transform: translate3d(0, 0, 0);
        /*background-size: 400%; // Можно менять и подбирать интенсивность*/
    }

    @keyframes  gradient {
        0% {
            background-position: 80% 0%;
        }
        50% {
            background-position: 20% 100%;
        }
        100% {
            background-position: 80% 0%;
        }
    }
</style>


<div class="container gradient rounded-5 border align-items-center mt-4">
    <a class="col text-decoration-none text-white" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="true" aria-controls="collapseExample">
         <p class="h2 text-center fw-bold">Обновление <i class="fa fa-arrow-alt-circle-down"></i></p>
    </a>
    <div class="collapse" id="collapseExample">
        <a class="row no-select  align-items-center rounded-5 text-decoration-none" href="{{route('presentation.meetingSchedules')}}">
            <div class="col-lg-7 p-3 p-lg-5 pt-lg-3 text-white">
                <h1 class="display-4 fw-bold lh-1">Модуль Расписаний</h1>
                <p class="lead">"Расписания встреч без сложностей. Простое создание, управление с легкостью."</p>
                <small class="еуче">нажмите чтобы узнать детали</small>
            </div>
            <div class="col-lg-4 offset-lg-1 p-4 overflow-hidden" >
                <img src="{{ asset('images/present.png') }}" class=" rounded-4 mx-lg-auto img-fluid" width="350" height="200">
            </div>
        </a>
    </div>
</div>


