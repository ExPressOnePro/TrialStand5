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

        {{--<div class="row mb-4">
        --}}{{--<div class="col-md-3 col-lg-3">
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
        </div>--}}{{--
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
        </div>--}}


            {{--@foreach($collection as $i => $col)
                <li>{{ ${"$collection{$i}"} = $col }}</li>
                <a>{{ $row }}</a>
            @endforeach--}}



        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header gradient-purple-indigo 0-hidden pb-80">
                        <div class="pt-4">
                            <div class="row">
                                <h3 class="col-md-4 text-white">Управление пользователями</h3>
                                <input class="form-control form-control-rounded col-md-4 ml-3 mr-3" id="exampleFormControlInput1" type="text" placeholder="Search Contacts..." />
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="ul-contact-list-body">
                            <div class="ul-contact-main-content">
                                <div class="ul-contact-left-side">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="ul-contact-list">
                                                <div class="contact-close-mobile-icon float-right mb-2"><i class="i-Close-Window text-15 font-weight-600"></i></div>
                                                <!-- modal-->
                                                <button class="btn btn-outline-secondary btn-block mb-4" type="button" data-toggle="modal" data-target="#exampleModal">ADD CONTACT</button>
                                                <!-- end:modal-->
                                                <div class="list-group" id="list-tab" role="tablist">
                                                    @foreach($roles as $role )
                                                        <form id="my-form" method="POST" action="{{ route('my-route') }}">
                                                            @csrf
                                                                <a class="btn btn-outline list-group-item list-group-item-action border-0" id="list-home-list" data-toggle="list" href="#list-home" role="tab" aria-controls="home" type="submit">
                                                                    <i class="nav-icon i-Business-Mens"></i>
                                                                {{ $r_n = $role->name }}
                                                                </a>
                                                        </form>
                                                    @endforeach


                                                        {{--<form id="my-form" method="POST" action="{{ route('my-route') }}">
                                                            @csrf

                                                            <button class="btn btn-outline-secondary btn-block mb-4" type="submit" id="my-button">Отправить</button>

                                                        </form>--}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{--<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">New Contact</h5>
                                                <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            </div>
                                            <div class="modal-body">
                                                <form>
                                                    <div class="form-group">
                                                        <input class="form-control" type="text" placeholder="Name...." />
                                                    </div>
                                                    <div class="form-group">
                                                        <input class="form-control" id="exampleInputEmail1" type="email" aria-describedby="emailHelp" placeholder="Enter email...." />
                                                    </div>
                                                    <div class="form-group">
                                                        <input class="form-control" id="exampleInputPassword1" type="text" placeholder="phone...." />
                                                    </div>
                                                    <div class="form-group">
                                                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="notes...."></textarea>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="modal-footer">
                                                <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
                                                <button class="btn btn-primary" type="button">
                                                    Save
                                                    changes
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>--}}
                                <div class="ul-contact-content">
                                    <div class="card">
                                        <form id="my-form" method="GET" action="{{ route('my-route') }}">
                                            <a></a>
                                        </form>
                                        {{ $r_id = $role->id }}
                                        @foreach($users_roles as $user_role)
                                            @if($user_role->role_id == $role->id )
                                                <a>{{ $user_role->user_id }}</a>
                                            @endif
                                        @endforeach
                                        <div class="card-body">
                                            <div class="float-left"><i class="nav-icon i-Align-Justify-All text-25 ul-contact-mobile-icon"></i></div>
                                            <div class="tab-content ul-contact-list-table--label" id="nav-tabContent">
                                                <!-- all-contact-->
                                                <div class="tab-pane fade show active" id="list-home" role="tabpanel" aria-labelledby="list-home-list">
                                                    <div class="text-left">
                                                        <div class="ul-widget__body">
                                                            <div class="tab-content">
                                                                <div class="tab-pane active show" id="__g-widget4-tab1-content">
                                                                    <div class="ul-widget1">




                                                                        {{--@foreach($users as $user)
                                                                            @foreach($users_roles as $us_rs)
                                                                                @if($us_rs == '2' )
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

                                                                                @endif
                                                                            @endforeach
                                                                        @endforeach--}}
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

                      <div class="tab-pane fade" id="list-profile" role="tabpanel"
                      aria-labelledby="list-profile-list">...</div>
                      <!--
                      <div class="tab-pane fade" id="list-messages" role="tabpanel"
                      aria-labelledby="list-messages-list">...</div>
                      <div class="tab-pane fade" id="list-settings" role="tabpanel"
                      aria-labelledby="list-settings-list">...</div>

                      -->
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
