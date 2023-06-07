@extends('layouts.app')
@section('title')Stand | Создание@endsection
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
                                                <button class="btn btn-outline-primary btn-block mb-4" type="button" data-toggle="modal" data-target="#exampleModal">Новая роль</button>
                                                <!-- end:modal-->
                                                <div class="list-group" id="list-tab" role="tablist">
                                                    @foreach($roles as $role)
                                                        <div class="form-group">
                                                            <a href="{{ route('UCRole', $role->id) }}">
                                                                <button class="btn btn-outline list-group-item list-group-item-action border-info">
                                                                    <i class="nav-icon i-Business-Mens">
                                                                        {{ $role->name }}</i>
                                                                </button>
                                                            </a>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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

    <div class="row">
        <div class="col-lg-12 col-md-12 mb-4">
            <div class="form-group ul-form-group d-flex align-items-center">
                <input class="form-control ul-form-input" type="text" placeholder="Enter your name.....">
            </div>
        </div>
        <div class="col-lg-4 col-xl-4 mb-3">
            <div class="card">
                <div class="card-body">
                    <div class="ul-contact-page__profile">
                        <div class="user-profile"><img class="profile-picture mb-2" src="../../dist-assets/images/faces/1.png" alt="alt"></div>
                        <div class="ul-contact-page__info">
                            <p class="m-0 text-24">Timothy Carlson</p>
                            <p class="text-muted m-0">Digital Marketer</p>
                            <p class="text-muted mt-3">DieSachbearbeiter Choriner Straße 49 10435 Berlin</p>
                            <p class="text-muted mt-3">NO: 234-987-665-340</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
