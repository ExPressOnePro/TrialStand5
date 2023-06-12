@extends('layouts.app')
@section('title')Stand | Мой аккаунт @endsection
@section('content')

    <div class="main-content pt-4">
        <div class="page-title-container">
            <div class="row">
                <div class="col-12 col-md-7">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-5 mb-5">
                <h2 class="small-title">Общее</h2>
                <div class="card h-100-card">
                    <div class="card-header gradient-steel-gray text-center">
                        <div class="h2 text-white text-center m-4">{{ auth()->user()->name }}</div>
                    </div>
                    <div class="card-body">
                        <div class="d-flex align-items-center flex-column mb-4">
                            <div class="d-flex align-items-center flex-column">
                                <div class="sw-13 position-relative mb-3">
                                </div>
                            </div>
                        </div>
                        <div class="mb-5">
                            <p class="text-lg-center text-black text-20 mb-4">Основная информация</p>
                                <div class="row g-0 mb-2">
                                    <div class="col-md-3 text-18">Логин:</div>
                                    <div class="col text-16">{{ auth()->user()->login }}</div>
                                </div>
                                <div class="row g-0 mb-2">
                                    <div class="col-md-3 text-18">Почта:</div>
                                    <div class="col text-16">{{ auth()->user()->email }}</div>
                                </div>
                            {{--@foreach($citn as $c)
                                <div class="row g-0 mb-2">
                                    <div class="col-md-3 text-18">Собрание:</div>
                                    <div class="col text-16">{{ $c->name }}</div>
                                </div>
                            @endforeach--}}
                        </div>
                        <div class="mb-5">
                            <p class="text-lg-center text-black text-20 mb-4">Контактная информация</p>
                            <div class="row g-0 mb-2">
                                <div class="col text-alternate">

                                </div>
                            </div>
                            <div class="row g-0 mb-2">
                                <div class="col text-alternate"></div>
                            </div>
                            <div class="row g-0 mb-2">
                                <div class="col text-alternate"></div>
                            </div>
                        </div>
                        <div class="mb-5">
                            <p class="text-lg-center text-black text-20 mb-2">Управление</p>
                            <div class="row g-0 mb-2">
                                <div class="col-md-4 text-alternate align-middle">
                                    <span>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Architecto culpa dolor eligendi expedita iure optio sint tenetur voluptates. Alias asperiores aspernatur aut deleniti dolor nihil nisi optio sed, ut voluptatum?</span>
                                    <a href="">
                                        <button class="btn btn-outline-danger m-1" type="button">Permission</button>
                                    </a>
                                </div>
                                <div class="col-md-4 text-alternate align-middle">
                                    <span>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Architecto culpa dolor eligendi expedita iure optio sint tenetur voluptates. Alias asperiores aspernatur aut deleniti dolor nihil nisi optio sed, ut voluptatum?</span>
                                    <a href="">
                                        <button class="btn btn-outline-danger m-1" type="button">Permission</button>
                                    </a>
                                </div>
                                <div class="col-md-4 text-alternate align-middle">
                                    <span>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Architecto culpa dolor eligendi expedita iure optio sint tenetur voluptates. Alias asperiores aspernatur aut deleniti dolor nihil nisi optio sed, ut voluptatum?</span>
                                    <a href="">
                                        <button class="btn btn-outline-danger m-1" type="button">Permission</button>
                                    </a>
                                </div>
                            </div>
                            <div class="row g-0 mb-2">
                                <div class="col text-alternate">The Royal Melbourne Hospital City</div>
                            </div>
                        </div>
                        <div>
                            <p class="text-small text-muted mb-2">NOTES</p>
                            <div class="row g-0">
                                <div class="col text-alternate align-middle">Penicillin Allergy</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <h2 class="small-title">Доступы</h2>
                <div class="card card-icon mb-4">
                    <div class="card-body text-center"><i class="i-Data-Upload"></i>
                        <p class="text-muted mt-2 mb-2">Today's Upload</p>
                        <p class="lead text-22 m-0">21</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
