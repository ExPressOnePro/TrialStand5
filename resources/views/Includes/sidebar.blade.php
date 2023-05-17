@section('sidebar')
    <div class="sidebar-panel bg-white">
        <div class="gull-brand pr-3 text-center mt-4 mb-2 d-flex justify-content-center align-items-center"><img class="pl-3" src="../../dist-assets/images/logo.png" alt="alt" />
            <span class=" item-name text-20 text-primary font-weight-700">GULL</span>
            <div class="sidebar-compact-switch ml-auto"><span></span></div>
        </div>
        <!--  user -->
        <div class="scroll-nav ps ps--active-y" data-perfect-scrollbar="data-perfect-scrollbar" data-suppress-scroll-x="true">
            <div class="side-nav">
                <div class="main-menu">
                    <ul class="metismenu" id="menu">
                        <li class="Ul_li--hover"><a class="has-arrow" href="#"><i class="i-Bar-Chart text-20 mr-2 text-muted"></i><span class="item-name text-15 text-muted">Developer</span></a>
                            <ul class="mm-collapse">
                                <li class="Ul_li--hover"><a class="has-arrow" href="#"><i class="text-20 mr-2 text-muted"></i><span class="item-name text-15 heading">User
                                        </span></a>
                                    <ul class="mm-collapse">
                                        <li class="item-name">
                                            <a href="{{ route('pageUserControl') }}">
                                                <i class="nav-icon i-Business-Mens mr-2 text-muted"></i>
                                                <span class="t-font-bolder">Control</span>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="Ul_li--hover"><a class="has-arrow" href="#"><i class="text-20 mr-2 text-muted"></i><span class="item-name text-15 heading">Stand</span></a>
                                    <ul class="mm-collapse">
                                        <li class="item-name">
                                            <a href="{{ route('createNewStandPage') }}">{{--создать новый стенд--}}
                                                <i class="i-Add mr-2 text-muted"></i>
                                                <span class="t-font-bolder">Create</span>
                                            </a>
                                        </li>
                                        <li class="item-name">
                                            <a href="{{ route('stand') }}">
                                                <i class="i-Big-Data mr-2 text-muted"></i>
                                                <span class="t-font-bolder">Control</span>
                                            </a>
                                        </li>
                                        <li class="item-name">
                                            <a href="">
                                                <i class="i-Time-Backup mr-2 text-muted"></i>
                                                <span class="t-font-bolder">Time</span>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="Ul_li--hover"><a class="has-arrow" href="#"><i class="text-20 mr-2 text-muted"></i><span class="item-name text-15 text-muted">Congregation</span></a>
                                    <ul class="mm-collapse">
                                        <li class="item-name">
                                            <a href="">
                                                <i class="i-Circular-Point mr-2 text-muted"></i>
                                                <span class="text-muted">Control</span>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="item-name">
                                    <a href=""><i class="i-Circular-Point mr-2 text-muted"></i>
                                        <span class="text-muted">Version 4</span>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="Ul_li--hover"><a href=""/><i class="i-Safe-Box1 text-20 mr-2 text-muted"></i><span class="item-name text-15 text-muted">Doc</span></a></li>
                    </ul>
                </div>
            </div>
            <div class="ps__rail-x" style="left: 0px; bottom: 0px;">
                <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
            </div>
            <div class="ps__rail-y" style="top: 0px; height: 404px; right: 0px;">
                <div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 325px;"></div>
            </div>
            <div class="ps__rail-x" style="left: 0px; bottom: 0px;">
                <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
            </div>
            <div class="ps__rail-y" style="top: 0px; height: 404px; right: 0px;">
                <div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 325px;"></div>
            </div>
        </div>
        <!--  side-nav-close -->
    </div>
    <div class="switch-overlay"></div>
