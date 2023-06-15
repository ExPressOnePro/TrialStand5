@section('sidebar')
    <div class="sidebar-panel bg-white">
        <div class="gull-brand pr-3 text-center mt-4 mb-2 d-flex justify-content-center align-items-center">
            <a href="{{ route('home') }}">
                <img class="pl-3" src="../../dist-assets/images/logo.png" alt="alt" />
                <span class=" item-name text-20 text-primary font-weight-700">MEEPER</span>
            </a>
            {{--<img class="pl-3" src="../../dist-assets/images/logo.png" alt="alt" />
            <span class=" item-name text-20 text-primary font-weight-700">MEEPER</span>--}}
            <div class="sidebar-compact-switch ml-auto"><span></span></div>
        </div>
        <!--  Developer -->
        @role('Developer')
        <div class="scroll-nav ps ps--active-y" data-perfect-scrollbar="data-perfect-scrollbar" data-suppress-scroll-x="true">
            <div class="side-nav">
                <div class="main-menu">
                    <ul class="metismenu" id="menu">
                        {{--Users--}}
                        <li class="Ul_li--hover">
                            <a class="has-arrow" href="#">
                                <i class="text-20 mr-2 text-muted"></i>
                                <span class="item-name text-15 heading">Users</span>
                            </a>
                            <ul class="mm-collapse">
                                <li class="item-name">
                                    <a href="{{ route('pageUserControl') }}">
                                        <i class="nav-icon i-Business-Mens mr-2 text-muted"></i>
                                        <span class="t-font-bolder">Select</span>
                                    </a>
                                </li>
                                <li class="item-name">
                                    <a href="{{ route('users') }}">
                                        <i class="nav-icon i-Business-Mens mr-2 text-muted"></i>
                                        <span class="t-font-bolder">All users</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        {{--Stands--}}
                        <li class="Ul_li--hover">
                            <a class="has-arrow" href="#">
                                <i class="text-20 mr-2 text-muted"></i>
                                <span class="item-name text-15 heading">Stands</span>
                            </a>
                            <ul class="mm-collapse">
                                <li class="item-name">
                                    <a href="{{ route('createNewStandPage') }}">
                                        <i class="i-Add mr-2 text-muted"></i>
                                        <span class="t-font-bolder">Create</span>
                                    </a>
                                </li>
                                <li class="item-name">
                                    <a href="{{ route('stand') }}">
                                        <i class="i-Big-Data mr-2 text-muted"></i>
                                        <span class="t-font-bolder">Select</span>
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
                        {{--Congregations--}}
                        <li class="Ul_li--hover">
                            <a class="has-arrow" href="#">
                                <i class="text-20 mr-2 text-muted"></i>
                                <span class="item-name text-15 heading">Congregations</span>
                            </a>
                            <ul class="mm-collapse">
                                <li class="item-name">
                                    <a href="{{ route('congregationSelect') }}">
                                        <i class="i-Circular-Point mr-2 text-muted"></i>
                                        <span class="heading">Select</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        {{--Next--}}
                        <li class="Ul_li--hover">
                            <a class="has-arrow" href="#">
                                <i class="text-20 mr-2 text-muted"></i>
                                <span class="item-name text-15 heading">Roles-Permissions</span>
                            </a>
                            <ul class="mm-collapse">
                                <li class="item-name">
                                    <a href="{{ route('rolesPermissionsPage') }}">
                                        <i class="i-Circular-Point mr-2 text-muted"></i>
                                        <span class="heading">Main</span>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        {{--Documentations--}}
                        <li class="Ul_li--hover">
                            <a href=""/>
                                <i class="i-Safe-Box1 text-20 mr-2 text-muted"></i>
                                <span class="item-name text-15 text-muted">Doc</span>
                            </a>
                        </li>
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
        @endrole

        <!--  User -->
        @role('User')
        <div class="scroll-nav ps ps--active-y" data-perfect-scrollbar="data-perfect-scrollbar" data-suppress-scroll-x="true">
            <div class="side-nav">
                <div class="main-menu">
                    <ul class="metismenu" id="menu">
                        {{--Users--}}
                        <li class="Ul_li--hover">
                            <a class="has-arrow" href="#">
                                <i class="text-20 mr-2 text-muted"></i>
                                <span class="item-name text-15 heading">Users</span>
                            </a>
                            <ul class="mm-collapse">
                                <li class="item-name">
                                    <a href="{{ route('pageUserControl') }}">
                                        <i class="nav-icon i-Business-Mens mr-2 text-muted"></i>
                                        <span class="t-font-bolder">Select</span>
                                    </a>
                                </li>
                                <li class="item-name">
                                    <a href="{{ route('users') }}">
                                        <i class="nav-icon i-Business-Mens mr-2 text-muted"></i>
                                        <span class="t-font-bolder">All users</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        {{--Stands--}}
                        <li class="Ul_li--hover">
                            <a class="has-arrow" href="#">
                                <i class="text-20 mr-2 text-muted"></i>
                                <span class="item-name text-15 heading">Stands</span>
                            </a>
                            <ul class="mm-collapse">
                                <li class="item-name">
                                    <a href="{{ route('createNewStandPage') }}">
                                        <i class="i-Add mr-2 text-muted"></i>
                                        <span class="t-font-bolder">Create</span>
                                    </a>
                                </li>
                                <li class="item-name">
                                    <a href="{{ route('stand') }}">
                                        <i class="i-Big-Data mr-2 text-muted"></i>
                                        <span class="t-font-bolder">Select</span>
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
                        {{--Congregations--}}
                        <li class="Ul_li--hover">
                            <a class="has-arrow" href="#">
                                <i class="text-20 mr-2 text-muted"></i>
                                <span class="item-name text-15 heading">Congregations</span>
                            </a>
                            <ul class="mm-collapse">
                                <li class="item-name">
                                    <a href="{{ route('congregationSelect') }}">
                                        <i class="i-Circular-Point mr-2 text-muted"></i>
                                        <span class="heading">Select</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        {{--Next--}}
                        <li class="Ul_li--hover">
                            <a class="has-arrow" href="#">
                                <i class="text-20 mr-2 text-muted"></i>
                                <span class="item-name text-15 heading">Next</span>
                            </a>
                            <ul class="mm-collapse">
                                <li class="item-name">
                                    <a href="">
                                        <i class="text-20 mr-2 text-muted"></i>
                                        <span class="heading">Next</span>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        {{--Documentations--}}
                        <li class="Ul_li--hover">
                            <a href=""/>
                            <i class="i-Safe-Box1 text-20 mr-2 text-muted"></i>
                            <span class="item-name text-15 text-muted">Doc</span>
                            </a>
                        </li>
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
        @endrole
        <!--  side-nav-close -->
    </div>
    <div class="switch-overlay"></div>
