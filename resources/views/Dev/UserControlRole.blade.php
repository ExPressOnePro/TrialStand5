@extends('layouts.app')
@section('title') Meeper | @endsection
@section('content')

    <div class="main-content pt-4">
        <div class="breadcrumb">
            <h1 class="mr-2">Управление пользователями</h1>
            <ul>
                <li><a href="">Dashboard</a></li>
                <li>Version 4</li>
            </ul>
        </div>
        <div class="separator-breadcrumb border-top"></div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header gradient-purple-indigo 0-hidden pb-80">
                        <div class="pt-4">
                            <div class="row">
                                <h3 class="col-md-4 text-white">{{ $id_role_to_name->first()->name }}</h3>
                                <input class="form-control form-control-rounded col-md-4 ml-3 mr-3" id="exampleFormControlInput1" type="text" placeholder="Search Contacts..." />
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="ul-contact-list-body">
                            <div class="ul-contact-main-content">
                                <div class="ul-contact-left-side">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="ul-contact-list">
                                                <div class="contact-close-mobile-icon float-right mb-2"><i class="i-Close-Window text-15 font-weight-600"></i></div>
                                                <!-- modal-->
                                                <button class="btn btn-outline-secondary btn-block mb-4" type="button" data-toggle="modal" data-target="#exampleModal">ADD CONTACT</button>
                                                <!-- end:modal-->
                                                <div class="list-group" id="list-tab" role="tablist">
                                                    @foreach($roles as $role)
                                                        <div class="form-group">
                                                            <a href="{{ route('UCRole', $role->id) }}">
                                                                <button class="btn btn-outline list-group-item list-group-item-action border-info heading">

                                                                        {{ $role->name }}

                                                                </button>
                                                            </a>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="ul-contact-content">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="float-left"><i class="nav-icon i-Align-Justify-All text-25 ul-contact-mobile-icon"></i></div>
                                            <div class="tab-content ul-contact-list-table--label" id="nav-tabContent">
                                                <!-- all-contact-->
                                                <div class="tab-pane fade show active" id="list-home" role="tabpanel" aria-labelledby="list-home-list">
                                                    <div class="text-left">
                                                        <div class="table-responsive">
                                                            <table class="display table table-borderless ul-contact-list-table" id="contact_list_table" style="width:100%">
                                                                <thead>
                                                                <tr class="border-bottom">
                                                                    <th>Name</th>
                                                                    <th>Email</th>
                                                                    <th>Action</th>
                                                                </tr>
                                                                </thead>
                                                                <tbody>
                                                                @foreach($users_role_id as $uri)
                                                                <tr>
                                                                    <td>
                                                                        {{ $uri->name }}</td>
                                                                    <td>{{ $uri->email }}</td>
                                                                    <td>
                                                                        <a href="{{ route('UCRUser', $uri->id) }}">
                                                                            <button class="btn btn-outline-success m-1" type="button">Информация</button>
                                                                        </a>
                                                                    </td>
                                                                </tr>
                                                                @endforeach
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--
                      <div class="tab-pane fade" id="list-profile" role="tabpanel"
                      aria-labelledby="list-profile-list">...</div>
                      <div class="tab-pane fade" id="list-messages" role="tabpanel"
                      aria-labelledby="list-messages-list">...</div>
                      <div class="tab-pane fade" id="list-settings" role="tabpanel"
                      aria-labelledby="list-settings-list">...</div>

                      -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
