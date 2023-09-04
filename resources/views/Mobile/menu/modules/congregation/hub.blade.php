@extends('Mobile.layouts.front.app')
@section('title') Stand | Выбор собрания @endsection
@section('content')

    <div class="main-content pt-4">
        <div class="row">
            @foreach($congregation as $con)
                <div class="col-md-3">
                    <a href="{{ route('congregationView', $con->id) }}" aria-expanded="true">
                        <div class="card card-body ul-border__bottom mb-4">
                            <div class="text-center">
                                <h3 class="heading">{{ $con->name }}</h3>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>

@endsection
