@extends('layouts.app')

@section('content')


                        @if (session('status'))
                            <div class="alert alert-card alert-success" role="alert">
                                <strong class="text-capitalize">Success!</strong>
                                {{ session('status') }}
                                <button class="close" type="button" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                                {{ __('You are logged in!') }}
                            </div>
                        @endif

@endsection
