@extends('Mobile.layouts.front.app')
@section('content')
    <div class="content container-fluid">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Reset Password') }}</div>

                <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <p>Для сброса пароля перейдите по следующей ссылке:</p>
                                <a class="btn btn-outline-primary" href="{{ $resetLink }}">Сбросить пароль</a>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
@endsection
