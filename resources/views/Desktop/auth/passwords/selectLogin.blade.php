@extends('Mobile.layouts.front.auth')

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
    <div class="content container-fluid">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Reset Password') }}</div>

                    <div class="card-body">
                        <div>
                            <form method="POST" action="{{ route('password.selectLoginPass') }}">
                                @csrf

                                <div class="row mb-3">
                                    <label for="value" class="col-md-4 col-form-label text-md-end">Введите ваш Логин</label>

                                    <div class="col-md-6">
                                        <input id="value" type="value" class="form-control @error('value') is-invalid @enderror"
                                               name="value"
                                               autofocus>

                                        @error('value')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror

                                    </div>
                                </div>

                                <div class="row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Reset Password') }}
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
    </div>
@endsection
