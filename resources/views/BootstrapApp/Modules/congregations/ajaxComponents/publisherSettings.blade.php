<style>
    .user-box {
        width: 110px;
        margin: auto;
        margin-bottom: 20px;

    }

    .user-box img {
        width: 100%;
        border-radius: 50%;
        padding: 3px;
        background: #fff;
        -webkit-box-shadow: 0px 5px 25px 0px rgba(0, 0, 0, 0.2);
        -moz-box-shadow: 0px 5px 25px 0px rgba(0, 0, 0, 0.2);
        -ms-box-shadow: 0px 5px 25px 0px rgba(0, 0, 0, 0.2);
        box-shadow: 0px 5px 25px 0px rgba(0, 0, 0, 0.2);
    }
</style>

<div class="container">
    <div class="row">
        <div class="col-lg-4">
            <div class="profile-card-4 z-depth-3">
                <div class="card">
                    <div class="card-body text-center bg-primary rounded-top">
                        <div class="user-box">
                            <img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="user avatar">
                        </div>
                        <h5 class="mb-1 text-white">{{ $user->last_name }} {{ $user->first_name }}</h5>
                        <h6 class="text-light"></h6>
                    </div>
                    <div class="card-body">
                        <ul class="list-group shadow-none">
                            <li class="list-group-item">
                                <div class="list-icon">
                                    <i class="fa fa-phone-square"></i>
                                    <small>Номер телефона</small>
                                </div>
                                <div class="list-details">
                                    <span>{{$userInfo['mobile_phone']}}</span>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="list-icon">
                                    <i class="fa fa-envelope"></i>
                                    <small>Email</small>
                                </div>
                                <div class="list-details">
                                    <span>{{$user->email}}</span>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="list-icon">
                                    <i class="fa fa-globe"></i>
                                    <small>Login</small>
                                </div>
                                <div class="list-details">
                                    <span>{{$user->login}}</span>
                                </div>
                            </li>
                        </ul>
{{--                        <div class="row text-center mt-4">--}}
{{--                            <div class="col p-2">--}}
{{--                                <h4 class="mb-1 line-height-5">154</h4>--}}
{{--                                <small class="mb-0 font-weight-bold">Projects</small>--}}
{{--                            </div>--}}
{{--                            <div class="col p-2">--}}
{{--                                <h4 class="mb-1 line-height-5">2.2k</h4>--}}
{{--                                <small class="mb-0 font-weight-bold">Followers</small>--}}
{{--                            </div>--}}
{{--                            <div class="col p-2">--}}
{{--                                <h4 class="mb-1 line-height-5">9.1k</h4>--}}
{{--                                <small class="mb-0 font-weight-bold">Views</small>--}}
{{--                            </div>--}}
{{--                        </div>--}}
                    </div>
{{--                    <div class="card-footer text-center">--}}
{{--                        <a href="javascript:void()" class="btn-social btn-facebook waves-effect waves-light m-1"><i class="fa fa-facebook"></i></a>--}}
{{--                        <a href="javascript:void()" class="btn-social btn-google-plus waves-effect waves-light m-1"><i class="fa fa-google-plus"></i></a>--}}
{{--                        <a href="javascript:void()" class="list-inline-item btn-social btn-behance waves-effect waves-light"><i class="fa fa-behance"></i></a>--}}
{{--                        <a href="javascript:void()" class="list-inline-item btn-social btn-dribbble waves-effect waves-light"><i class="fa fa-dribbble"></i></a>--}}
{{--                    </div>--}}
                </div>
            </div>
        </div>
        <div class="col-lg-8">
            <div class="card z-depth-3">
                <div class="card-body">
                    <ul class="nav nav-pills nav-justified">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="true"><i class="icon-user"></i> <span class="hidden-xs">Profile</span></button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="nav-messages-tab" data-bs-toggle="tab" data-bs-target="#messages" type="button" role="tab" aria-controls="messages" aria-selected="false"><i class="icon-envelope-open"></i> <span class="hidden-xs">Messages</span></button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="nav-edit-tab" data-bs-toggle="tab" data-bs-target="#edit" type="button" role="tab" aria-controls="edit" aria-selected="false"><i class="icon-note"></i> <span class="hidden-xs">Редактирование</span></button>
                        </li>
                    </ul>
                    <div class="tab-content p-3">
                        <div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                            <h5 class="mb-3">User Profile</h5>
                            <div class="row">
                                <div class="col-md-6">
                                    <h6>About</h6>
                                    <p>
                                        Web Designer, UI/UX Engineer
                                    </p>
                                    <h6>Hobbies</h6>
                                    <p>
                                        Indie music, skiing and hiking. I love the great outdoors.
                                    </p>
                                </div>
                                <div class="col-md-6">
                                    <h6>Recent badges</h6>
                                    <a href="javascript:void();" class="badge badge-dark badge-pill">html5</a>
                                    <a href="javascript:void();" class="badge badge-dark badge-pill">react</a>
                                    <a href="javascript:void();" class="badge badge-dark badge-pill">codeply</a>
                                    <a href="javascript:void();" class="badge badge-dark badge-pill">angularjs</a>
                                    <a href="javascript:void();" class="badge badge-dark badge-pill">css3</a>
                                    <a href="javascript:void();" class="badge badge-dark badge-pill">jquery</a>
                                    <a href="javascript:void();" class="badge badge-dark badge-pill">bootstrap</a>
                                    <a href="javascript:void();" class="badge badge-dark badge-pill">responsive-design</a>
                                    <hr>
                                    <span class="badge badge-primary"><i class="fa fa-user"></i> 900 Followers</span>
                                    <span class="badge badge-success"><i class="fa fa-cog"></i> 43 Forks</span>
                                    <span class="badge badge-danger"><i class="fa fa-eye"></i> 245 Views</span>
                                </div>
                                <div class="col-md-12">
                                    <h5 class="mt-2 mb-3"><span class="fa fa-clock-o ion-clock float-right"></span> Recent Activity</h5>
                                    <table class="table table-hover table-striped">
                                        <tbody>
                                        <tr>
                                            <td>
                                                <strong>Abby</strong> joined ACME Project Team in <strong>`Collaboration`</strong>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <strong>Gary</strong> deleted My Board1 in <strong>`Discussions`</strong>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <strong>Kensington</strong> deleted MyBoard3 in <strong>`Discussions`</strong>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <strong>John</strong> deleted My Board1 in <strong>`Discussions`</strong>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <strong>Skell</strong> deleted his post Look at Why this is.. in <strong>`Discussions`</strong>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!--/row-->
                        </div>
                        <div class="tab-pane fade" id="messages" role="tabpanel" aria-labelledby="nav-messages-tab">
                            <div class="alert alert-info alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                <div class="alert-icon">
                                    <i class="icon-info"></i>
                                </div>
                                <div class="alert-message">
                                    <span><strong>Info!</strong> Lorem Ipsum is simply dummy text.</span>
                                </div>
                            </div>
                            <table class="table table-hover table-striped">
                                <tbody>
                                <tr>
                                    <td>
                                        <span class="float-right font-weight-bold">3 hrs ago</span> Here is your a link to the latest summary report from the..
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="float-right font-weight-bold">Yesterday</span> There has been a request on your account since that was..
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="float-right font-weight-bold">9/10</span> Porttitor vitae ultrices quis, dapibus id dolor. Morbi venenatis lacinia rhoncus.
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="float-right font-weight-bold">9/4</span> Vestibulum tincidunt ullamcorper eros eget luctus.
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="float-right font-weight-bold">9/4</span> Maxamillion ais the fix for tibulum tincidunt ullamcorper eros.
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane fade" id="edit" role="tabpanel" aria-labelledby="nav-edit-tab">
                            <form action="{{ route('users.update', $user->id) }}" method="post">
                                @csrf
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label form-control-label">Имя</label>
                                    <div class="col-lg-9">
                                        <input class="form-control" type="text" name="first_name" value="{{ $user->first_name }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label form-control-label">Фамилия</label>
                                    <div class="col-lg-9">
                                        <input class="form-control" type="text" name="last_name" value="{{ $user->last_name }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label form-control-label">Email</label>
                                    <div class="col-lg-9">
                                        <input class="form-control" type="email" name="email" value="{{ $user->email }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label form-control-label">Логин</label>
                                    <div class="col-lg-9">
                                        <input class="form-control" type="text" name="login" value="{{ $user->login }}">
                                    </div>
                                </div>
{{--                                <div class="form-group row">--}}
{{--                                    <label class="col-lg-3 col-form-label form-control-label">Change profile</label>--}}
{{--                                    <div class="col-lg-9">--}}
{{--                                        <input class="form-control" type="file">--}}
{{--                                    </div>--}}
{{--                                </div>--}}
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label form-control-label">Номер телефона</label>
                                    <div class="col-lg-9">
                                        <input class="form-control" type="text" name="phone" value="{{$userInfo['mobile_phone']}}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label form-control-label"></label>
                                    <div class="col-lg-9">
                                        <input type="reset" class="btn btn-secondary" value="Отмена">
                                        <input type="submit" class="btn btn-primary" value="Сохранить изменения">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

