{{--@section('nav')--}}
{{--@inject('mobile_detect', 'Mobile_Detect')--}}
{{--@if ($mobile_detect->isMobile())--}}

<div class="d-lg-none fixed-bottom">
    <ul class="nav nav-pills nav-fill small bg-secondary shadow-sm" id="pillNav2" role="tablist" style="
    --bs-nav-link-color: var(--bs-black);
    --bs-nav-pills-link-active-color: var(--bs-white);
    --bs-nav-pills-link-active-bg: var(--bs-secondary);">
        <li class="nav-item" role="presentation">
            <a class="nav-link text-decoration-none {{ request()->is('home*') ? ' active' : '' }}" id="home-tab2" href="{{route('home')}}">
                <p class="h3"><i class="fa fa-home"></i></p>
            </a>
        </li>
{{--        <li class="nav-item" role="presentation">--}}

{{--            <a class="nav-link text-decoration-none" href="{{ route('stand.hub') }}">--}}
{{--                <i class="h3">--}}
{{--                    <img src="{{ request()->is('stand*') ? asset('front/img/stand_white.svg') : asset('front/img/stand_black.svg') }}" height="30" width="25" alt="Stand Icon">--}}
{{--                </i>--}}
{{--            </a>--}}
{{--        </li>--}}

        <li class="nav-item" role="presentation">
            <a class="nav-link text-decoration-none" id="home-tab2" href="{{route('menu.overview2')}}">
                <p class="h3"><i class="fa-solid fa-bars"></i></p>
            </a>
        </li>
        @role('Developer')
        <li class="nav-item" role="presentation">
            <a class="nav-link text-decoration-none" id="home-tab2" href="{{route('developer.hub')}}">
                <p class="h3"><i class="fa-solid fa-globe"></i></p>
            </a>
        </li>
        @endrole
{{--        <li class="nav-item position-relative">--}}
{{--            <a class="nav-link text-decoration-none position-relative {{ request()->is('congregation*') ? ' active' : '' }}" href="{{ route('congregationView', Auth()->user()->congregation_id) }}">--}}

{{--                    <i class="h3 fa-solid fa-handshake"></i>--}}
{{--                    <span class="position-absolute top-2 start-75 translate-middle badge rounded-pill bg-danger">--}}
{{--                    1</span>--}}
{{--            </a>--}}
{{--        </li>--}}

    </ul>
</div>
{{--@else--}}
{{--@endif--}}
