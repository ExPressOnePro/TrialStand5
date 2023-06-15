@extends('layouts.app')
@section('title') Meeper | Мой аккаунт @endsection
@section('content')

    <div class="main-content pt-4">
        <div class="row">
            <!-- Основная информация пользователя-->
            <div class="col-md-4">
                <div class="card card-profile-1 mb-4">
                    <div class="card-body text-center">
                        <div class="avatar box-shadow-2 mb-3"><img src="../../dist-assets/images/faces/16.jpg" alt=""></div>
                        <h5 class="m-0">{{ $user->name }}</h5>
                        <p class="mt-0">{{ $user->Congregation->name }}</p>
                        <div class="row g-0 mb-2">
                            <div class="col text-left text-18">Логин:</div>
                            <div class="col text-left heading text-16">{{ $user->login }}</div>
                        </div>
                        <div class="row g-0 mb-2">
                            <div class="col text-left text-18">Почта:</div>
                            <div class="col text-left heading text-16">{{ $user->email }}</div>
                        </div>
                        <p> Дополнительная информация будет добавляться в зависимости от потребностей </p>
                        <button class="btn btn-outline-primary btn-rounded">Дополнительно</button>
                        {{--<div class="card-socials-simple mt-4">
                            <a href=""><i class="i-Linkedin-2"></i></a>
                            <a href=""><i class="i-Facebook-2"></i></a>
                            <a href=""><i class="i-Twitter"></i></a>
                        </div>--}}
                    </div>
                </div>
                {{--<div class="card mb-4">
                    <div class="card-header">Будущие разработки</div>
                    <div class="card-body">
                        <h5 class="card-title">Card title text</h5>
                        <p class="card-text">With supporting text below as a natural lead-in to additional content.</p><a class="btn btn-primary btn-rounded" href="#">Go somewhere</a>
                    </div>
                </div>--}}
            </div>
            <div class="col-md-4">
                <div class="card card-icon mb-4">
                    <div class="card-body text-center"><i class="fa-solid fa-passport text-40 text-primary"></i>
                        <div class="card-title">Доступные вам сервисы</div>
                        <div class="loader-bubble loader-bubble-primary m-5"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
