@extends('Mobile.layouts.front.home')
@section('title') Meeper @endsection
@section('content')



    <div class="content container-fluid">
        <div class="overflow-hidden gradient-radial-sm-primary">
            <div class="container-lg content-space-t-1 content-space-t-lg-1 content-space-b-1">
                <div class="w-lg-75 text-center mx-lg-auto text-center mx-auto">
                    <div class="mb-5 animated fadeInUp">
                        <h1 class="display-2 mb-3">Meeper</h1>
                        <p class="fs-2">Добро пожаловать в приложение</p>
                    </div>
                </div>
            </div>
        </div>
        @role('Developer')
        @include('Mobile.home.components.developer')
        @endrole

        <div class="row">
            <div class="col-lg-4 mb-3 mb-lg-5">
                <div class="d-grid gap-2 gap-lg-4">

                    <a class="card card-hover-shadow" href="{{ route('home.recordsWithStandPage') }}">
                        <div class="card-body">
                            <div class="d-flex align-items-center">

                                <div class="flex-grow-1 ms-4">
                                    <h3 class="text-inherit mb-1">Мои записи со стендом</h3>
                                    <span class="text-body"></span>
                                </div>

                                <div class="ms-2 text-end">
                                    <i class="bi-chevron-right text-body text-inherit"></i>
                                </div>
                            </div>
                        </div>
                    </a>

                </div>
            </div>
        </div>
    </div>

    <script>
        // SWITHCER THEME APPEARANCE
        // =======================================================
        const $swithcer = document.querySelector('#darkSwitch')

        if (HSThemeAppearance.getOriginalAppearance() === 'dark') {
            $swithcer.checked = true
        }

        $swithcer.addEventListener('change', e => {
            HSThemeAppearance.setAppearance(e.target.checked ? 'dark' : 'default')
        })
    </script>
@endsection
