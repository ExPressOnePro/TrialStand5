@extends('layouts.app')
@section('title') Meeper | Главная @endsection
@section('content')

    <div class="main-content pt-4">
        <div class="separator-breadcrumb border-top"></div>
        {{--<div class="row">
            <!-- ICON BG-->
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
                    <div class="card-body text-center"><i class="i-Add-User"></i>
                        <div class="content">
                            <p class="text-muted mt-2 mb-0">New Leads</p>
                            <p class="lead text-primary text-24 mb-2">205</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
                    <div class="card-body text-center"><i class="i-Financial"></i>
                        <div class="content">
                            <p class="text-muted mt-2 mb-0">Sales</p>
                            <p class="lead text-primary text-24 mb-2">4021</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
                    <div class="card-body text-center"><i class="i-Checkout-Basket"></i>
                        <div class="content">
                            <p class="text-muted mt-2 mb-0">Orders</p>
                            <p class="lead text-primary text-24 mb-2">80</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
                    <div class="card-body text-center"><i class="i-Money-2"></i>
                        <div class="content">
                            <p class="text-muted mt-2 mb-0">Expense</p>
                            <p class="lead text-primary text-24 mb-2">120</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>--}}
        <!-- CARD ICON-->
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="card mb-4">
                    <div class="card-body">
                        <h3 class="card-header-pills heading text-center text-primary">Добро пожаловать в Meeper</h3>
                        <p class="card-text heading text-center">На главной странице вы увидите основную информацию</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="col-md-6">
                    <div class="card mb-4 o-hidden">
                        <div class="card-body">
                            <h5 class="card-title heading text-center">Вы записались на стенд в следующие даты</h5>
                        </div>
                        <ul class="list-group list-group-flush">
                            @foreach ($standPublishers as $publisher)
                                <li class="list-group-item">
                                    @foreach ($publisher->standTemplates as $standTemplate)
                                        <div class="d-flex justify-content-between mt-3">
                                            <div class="flex-grow-1 text-left">
                                                <h7 class="heading">
                                                    {{ \App\Enums\WeekDaysEnum::getWeekDay($standTemplate->day) }}
                                                    <br>
                                                    {{ $standTemplate->Stand->location }}
                                                </h7>
                                            </div>
                                            <div class="flex-grow-1 mt-0 text-right">
                                                <h7 class="heading">
                                                    {{ $publisher->date }}
                                                    <br>
                                                    Время: {{ $standTemplate->time }}
                                                </h7>
                                            </div>
                                        </div>
                                    @endforeach
                                </li>
                            @endforeach

                        </ul>

                    </div>
                </div>
            </div>
        </div>
            {{--<div class="col-lg-6 col-md-12">
                <div class="row">
                    <!-- BG IMAGE CARDS-->
                    <div class="col-md-6">
                        <div class="card bg-dark text-white o-hidden mb-4"><img class="card-img" src="../../dist-assets/images/photo-long-1.jpg" alt="Card image">
                            <div class="card-img-overlay">
                                <div class="text-center pt-4">
                                    <h5 class="card-title mb-2 text-white">Card title</h5>
                                    <div class="separator border-top mb-2"></div>
                                    <p class="text-small font-italic">Last updated 3 mins ago</p>
                                </div>
                                <div class="p-1 text-left card-footer font-weight-light d-flex"><span class="mr-3 d-flex align-items-center"><i class="i-Speach-Bubble-6 mr-1"></i> 12</span><span class="d-flex align-items-center"><i class="i-Calendar-4 mr-2"></i>03.12.2018</span></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card bg-dark text-white o-hidden mb-4"><img class="card-img" src="../../dist-assets/images/photo-long-2.jpg" alt="Card image">
                            <div class="card-img-overlay">
                                <div class="text-center pt-4">
                                    <h5 class="card-title mb-2 text-white">Card title</h5>
                                    <div class="separator border-top mb-2"></div>
                                    <p class="text-small font-italic">Last updated 3 mins ago</p>
                                </div>
                                <div class="p-1 text-left card-footer font-weight-light d-flex"><span class="mr-3 d-flex align-items-center"><i class="i-Speach-Bubble-6 mr-1"></i> 12</span><span class="d-flex align-items-center"><i class="i-Calendar-4 mr-2"></i>03.12.2018</span></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card mb-4 o-hidden"><img class="card-img-top" src="../../dist-assets/images/photo-wide-2.jpg" alt="">
                            <div class="card-body">
                                <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Illum, cumque!</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card mb-4 o-hidden"><img class="card-img-top" src="../../dist-assets/images/photo-wide-3.jpg" alt="">
                            <div class="card-body">
                                <h5 class="card-title">Card title</h5>
                                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                            </div>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">Cras justo odio</li>
                                <li class="list-group-item">Dapibus ac facilisis in</li>
                                <li class="list-group-item">Vestibulum at eros</li>
                            </ul>
                            <div class="card-body"><a class="card-link" href="#">Card link</a><a class="card-link" href="#">Another link</a></div>
                        </div>
                    </div>
                </div>
            </div>--}}
        </div><!-- end of main-content -->
    </div>

@endsection
