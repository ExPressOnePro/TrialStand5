@extends('Mobile.layouts.front.app')
@section('title') Meeper | Таблица @endsection
@section('content')



    <div class="content container-fluid">
        <div class="list-group d-flex align-items-center">
            @foreach($accessible_stands_for_the_user as $asfu)
                <a class="list-group-item list-group-item-action border-secondary" href="{{ route('currentWeekTableFront', $asfu->id) }}">
                    <div class="d-flex align-items-center">
                        <div class="ms-3">
                            <span class="d-block h1 text-inherit mb-0">{{ $asfu->name }}</span>
                            <span class="d-block h5 text-inherit text-body mb-0">{{ $asfu->location }}</span>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </div>

@endsection
