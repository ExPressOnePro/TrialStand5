@section('header')
    @inject('mobile_detect', 'Mobile_Detect')
    @if ($mobile_detect->isMobile())
        <div class="app-footer" style="padding-bottom: 30%">
            <div class="row">
                <div class="col-md-9">
                    <p><strong>{{--...--}}</strong></p>
                    <p>{{--...--}}
                        <sunt></sunt>
                    </p>
                </div>
            </div>
            <div class="footer-bottom border-top pt-3 d-flex flex-column flex-sm-row align-items-center">
                <span class="flex-grow-1"></span>
                <div class="d-flex align-items-center">
                    {{--<img class="logo" src="../../dist-assets/images/logo.png" alt="">
                    <div>
                        <p class="m-0">© 2023 Meeper</p>
                        <p class="m-0"></p>
                    </div>--}}
                </div>
            </div>
        </div>

    @else
        {{--<div class="app-footer" >
                <div class="row">
                    <div class="col-md-9">
                        <p><strong>Stand</strong></p>
                        <p>
                            <sunt></sunt>
                        </p>
                    </div>
                </div>
                <div class="footer-bottom border-top pt-3 d-flex flex-column flex-sm-row align-items-center">
                    <span class="flex-grow-1"></span>
                    <div class="d-flex align-items-center">
                        <img class="logo" src="../../dist-assets/images/logo.png" alt="">
                        <div>
                            <p class="m-0">© 2023 Stand</p>
                            <p class="m-0">All rights reserved</p>
                        </div>
                    </div>
                </div>
            </div>--}}
    @endif
