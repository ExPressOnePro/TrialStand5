@extends('layouts.app')

@section('content')

    <div class="main-content pt-4">
        <div class="breadcrumb">
            <h1 class="mr-2">Управление пользователями</h1>
            <ul>
                <li><a href="">Dashboard</a></li>
                <li>Version 4</li>
            </ul>
        </div>
        <div class="separator-breadcrumb border-top"></div>

        <div class="row mb-4">
        {{--<div class="col-md-3 col-lg-3">
            <div class="card mb-4 o-hidden">
                <div class="card-body ul-card__widget-chart">
                    <div class="ul-widget__chart-info">
                        <h5 class="heading">INCOME</h5>
                        <div class="ul-widget__chart-number">
                            <h2 class="t-font-boldest">$1000</h2><small class="text-muted">46% compared to last year</small>
                        </div>
                    </div>
                    <div id="basicArea-chart"></div>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-lg-3">
            <div class="card mb-4 o-hidden">
                <div class="card-body ul-card__widget-chart">
                    <div class="ul-widget__chart-info">
                        <h5 class="heading">APPROVE</h5>
                        <div class="ul-widget__chart-number">
                            <h2 class="t-font-boldest">$500</h2><small class="text-muted">46% compared to last year</small>
                        </div>
                    </div>
                    <div id="basicArea-chart2"></div>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-lg-3">
            <div class="card mb-4 o-hidden">
                <div class="card-body ul-card__widget-chart">
                    <div class="ul-widget__chart-info">
                        <h5 class="heading">transaction</h5>
                        <div class="ul-widget__chart-number">
                            <h2 class="t-font-boldest">$44,909</h2><small class="text-muted">46% compared to last year</small>
                        </div>
                    </div>
                    <div id="basicArea-chart3"></div>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-lg-3">
            <div class="card mb-4 o-hidden">
                <div class="card-body ul-card__widget-chart">
                    <div class="ul-widget__chart-info">
                        <h5 class="heading">SALES</h5>
                        <div class="ul-widget__chart-number">
                            <h2 class="t-font-boldest">$500</h2><small class="text-muted">46% compared to last year</small>
                        </div>
                    </div>
                    <div id="basicArea-chart4"></div>
                </div>
            </div>
        </div>--}}
        <!-- table-->
            <div class="col-lg-12 col-md-12 col-xl-12 mt-4">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="ul-widget__head">
                            <div class="ul-widget__head-label">
                                <h3 class="ul-widget__head-title">Users</h3>
                            </div>
                            <div class="ul-widget__head-toolbar">
                                <ul class="nav nav-tabs nav-tabs-line nav-tabs-bold ul-widget-nav-tabs-line" role="tablist">
                                    <li class="nav-item"><a class="nav-link active show" data-toggle="tab" href="#__g-widget4-tab1-content" role="tab" aria-selected="true">Today</a></li>
                                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#__g-widget4-tab2-content" role="tab" aria-selected="false">Month</a></li>
                                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#__g-widget4-tab3-content" role="tab" aria-selected="true">Today</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="ul-widget__body">
                            <div class="tab-content">
                                <div class="tab-pane active show" id="__g-widget4-tab1-content">
                                    <div class="ul-widget1">
                                        @foreach($users as $key => $user)
                                            <div class="ul-widget4__item ul-widget4__users">
                                                <div class="ul-widget4__img">
                                                    <img id="userDropdown" src="../../dist-assets/images/faces/1.png" alt="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" />
                                                </div>
                                                <div class="ul-widget2__info ul-widget4__users-info">
                                                    <a class="ul-widget2__title" href="#">{{ $user->name }}</a>
                                                    <span class="ul-widget2__username">{{ $user->email }}</span>
                                                </div>
                                                <div class="ul-widget4__actions">
                                                    <button class="btn btn-outline-success m-1" type="button">Информация</button>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="tab-pane" id="__g-widget4-tab2-content">
                                    <div class="ul-widget1">
                                        <div class="ul-widget4__item ul-widget4__users">
                                            <div class="ul-widget4__img"><img id="userDropdown" src="../../dist-assets/images/faces/2.jpg" alt="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" /></div>
                                            <div class="ul-widget2__info ul-widget4__users-info"><a class="ul-widget2__title" href="#">Anna Strong</a><span class="ul-widget2__username" href="#">Visual Designer,Google Inc</span></div>
                                            <div class="ul-widget4__actions">
                                                <button class="btn btn-outline-danger m-1" type="button">Follow</button>
                                            </div>
                                        </div>
                                        <div class="ul-widget4__item ul-widget4__users">
                                            <div class="ul-widget4__img"><img id="userDropdown" src="../../dist-assets/images/faces/1.jpg" alt="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" /></div>
                                            <div class="ul-widget2__info ul-widget4__users-info"><a class="ul-widget2__title" href="#">Anna Strong</a><span class="ul-widget2__username" href="#">Visual Designer,Google Inc</span></div>
                                            <div class="ul-widget4__actions">
                                                <button class="btn btn-outline-success m-1" type="button">Follow</button>
                                            </div>
                                        </div>
                                        <div class="ul-widget4__item ul-widget4__users">
                                            <div class="ul-widget4__img"><img id="userDropdown" src="../../dist-assets/images/faces/3.jpg" alt="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" /></div>
                                            <div class="ul-widget2__info ul-widget4__users-info"><a class="ul-widget2__title" href="#">Anna Strong</a><span class="ul-widget2__username" href="#">Visual Designer,Google Inc</span></div>
                                            <div class="ul-widget4__actions">
                                                <button class="btn btn-outline-warning m-1" type="button">Follow</button>
                                            </div>
                                        </div>
                                        <div class="ul-widget4__item ul-widget4__users">
                                            <div class="ul-widget4__img"><img id="userDropdown" src="../../dist-assets/images/faces/4.jpg" alt="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" /></div>
                                            <div class="ul-widget2__info ul-widget4__users-info"><a class="ul-widget2__title" href="#">Anna Strong</a><span class="ul-widget2__username" href="#">Visual Designer,Google Inc</span></div>
                                            <div class="ul-widget4__actions">
                                                <button class="btn btn-outline-info m-1" type="button">Follow</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="__g-widget4-tab3-content">
                                    <div class="ul-widget1">
                                        <div class="ul-widget4__item ul-widget4__users">
                                            <div class="ul-widget4__img"><img id="userDropdown" src="../../dist-assets/images/faces/2.jpg" alt="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" /></div>
                                            <div class="ul-widget2__info ul-widget4__users-info"><a class="ul-widget2__title" href="#">Anna Strong</a><span class="ul-widget2__username" href="#">Visual Designer,Google Inc</span></div>
                                            <div class="ul-widget4__actions">
                                                <button class="btn btn-outline-danger m-1" type="button">Follow</button>
                                            </div>
                                        </div>
                                        <div class="ul-widget4__item ul-widget4__users">
                                            <div class="ul-widget4__img"><img id="userDropdown" src="../../dist-assets/images/faces/1.jpg" alt="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" /></div>
                                            <div class="ul-widget2__info ul-widget4__users-info"><a class="ul-widget2__title" href="#">Anna Strong</a><span class="ul-widget2__username" href="#">Visual Designer,Google Inc</span></div>
                                            <div class="ul-widget4__actions">
                                                <button class="btn btn-outline-success m-1" type="button">Follow</button>
                                            </div>
                                        </div>
                                        <div class="ul-widget4__item ul-widget4__users">
                                            <div class="ul-widget4__img"><img id="userDropdown" src="../../dist-assets/images/faces/3.jpg" alt="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" /></div>
                                            <div class="ul-widget2__info ul-widget4__users-info"><a class="ul-widget2__title" href="#">Anna Strong</a><span class="ul-widget2__username" href="#">Visual Designer,Google Inc</span></div>
                                            <div class="ul-widget4__actions">
                                                <button class="btn btn-outline-warning m-1" type="button">Follow</button>
                                            </div>
                                        </div>
                                        <div class="ul-widget4__item ul-widget4__users">
                                            <div class="ul-widget4__img"><img id="userDropdown" src="../../dist-assets/images/faces/4.jpg" alt="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" /></div>
                                            <div class="ul-widget2__info ul-widget4__users-info"><a class="ul-widget2__title" href="#">Anna Strong</a><span class="ul-widget2__username" href="#">Visual Designer,Google Inc</span></div>
                                            <div class="ul-widget4__actions">
                                                <button class="btn btn-outline-info m-1" type="button">Follow</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <!-- end of row-->
        <!-- end of main-content -->
    </div>

@endsection
