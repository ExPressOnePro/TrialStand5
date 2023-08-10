@extends('Mobile.layouts.edit')
@section('title') Meeper | Настройки @endsection
@section('content')

        @if (session('error'))
            <div class="alert alert-card alert-danger">
                {{ session('error') }}
            </div>
        @endif
        @if (session('success'))
            <div class="alert alert-card alert-success">
                {{ session('success') }}
            </div>
        @endif
        <header class="text-center position m-2 ">
            <div class="d-flex align-items-center">
                <div class="text-left">
                    <a class="btn btn-outline text-dark btn-rounded text-25" href="{{ URL::previous() }}">
                        <i class="fa-solid fa-arrow-left"></i>
                    </a>
                </div>
                <div class="text-center">
                    <h2 class="heading text-20 mt-3">
                        Настройки
                    </h2>
                </div>
                <span class="flex-grow-1"></span>
            </div>
        </header>
        <div class="row">

        </div>



@endsection
