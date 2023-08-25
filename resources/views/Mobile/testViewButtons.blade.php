@extends('Mobile.layouts.front.home')
@section('title') TEST_1 @endsection
@section('content')

    <div class="content container-fluid">
        <div class="row mb-4">
            <div class="col-12">
                <div class="d-grid gap-2">
                    <a type="button" class="btn btn-primary btn-lg" href="{{ route('test1button') }}">
                       Подключить модуль
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
