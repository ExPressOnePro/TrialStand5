<div class="col-lg-4">

    <!-- Sticky Block Start Point -->
    <div id="accountSidebarNav"></div>

    <!-- Card -->
    <div class="js-sticky-block card mb-3 mb-lg-5" data-hs-sticky-block-options='{
                             "parentSelector": "#accountSidebarNav",
                             "breakpoint": "lg",
                             "startPoint": "#accountSidebarNav",
                             "endPoint": "#stickyBlockEndPoint",
                             "stickyOffsetTop": 20
                           }'>
        <!-- Header -->
        <div class="card-header">
            <h4 class="card-header-title">Профиль</h4>
            @role('Developer')
            <i class="fa-solid fa-history"></i> Последний вход {{ $user->last_login }}
            @endrole
        </div>
        <!-- End Header -->

        <!-- Body -->
        <div class="card-body">
            <ul class="list-unstyled list-py-2 text-dark mb-0">
                <li class="pb-0"><span class="card-subtitle">Информация</span></li>
                <li><i class="bi-person dropdown-item-icon"></i> {{ $user->first_name }} {{ $user->last_name }}</li>
                <li><i class="bi-briefcase dropdown-item-icon"></i> {{ $user->congregation->name }}</li>
                <li>
                    <div class="row align-items-center">
                        <div class="col-sm mb-3 mb-sm-0">
                            <i class="bi-briefcase dropdown-item-icon"></i>
                            @if(!$user->usersGroups)
                                <span>Не в группе</span>
                            @else
                                @foreach($user->usersGroups as $usersGroups)
                                    <span>{{$usersGroups->group->name}}</span>
                                @endforeach
                            @endif
                        </div>
                        <div class="col-sm-auto">
                            <div class="d-flex">
                                <button type="button" class="btn btn-info btn-icon btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                    <i class="fa-solid fa-pencil"></i>
                                </button>
                            </div>
                        </div>

                    </div>
                </li>

                <li class="pt-4 pb-0"><span class="card-subtitle">Контакты</span></li>
                <li><i class="bi-at dropdown-item-icon"></i> {{ $user->email }}</li>
                <li><i class="bi-phone dropdown-item-icon"></i> {{ $user->mobile_phone }}</li>

                {{--                                    <li class="pt-4 pb-0"><span class="card-subtitle">Teams</span></li>--}}
                {{--                                    <li><i class="bi-people dropdown-item-icon"></i> Member of 7 teams</li>--}}
                {{--                                    <li><i class="bi-stickies dropdown-item-icon"></i> Working on 8 projects</li>--}}
            </ul>
        </div>
        <!-- End Body -->
    </div>
    <!-- End Card -->
</div>
