@extends('layouts.app')
@section('title') Meeper | Роли и Права@endsection
@section('content')

    <div class="main-content pt-4">
        <div class="breadcrumb">
            <h1 class="mr-2">Роли</h1>
            <ul>
                <li><a href="">страница</a></li>
                <li></li>
            </ul>
        </div>
        <div class="separator-breadcrumb border-top"></div>
        <div class="row">
                <div class="col-md-3">
                    <a  data-toggle="collapse" href="#collapse-link-collapsed" aria-expanded="true">
                        <div class="card card-body ul-border__bottom mb-4">
                            <div class="text-center">
                                <h1 class="heading"></h1>
                                <p class="mb-3 text-muted">Этот стенд находится - ""</p>
                            </div>
                            <div class="collapse" id="collapse-link-collapsed" style="">
                                <div class="mt-3">
                                </div>
                                <div class="mt-3">
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
        </div>
    </div>

@endsection
