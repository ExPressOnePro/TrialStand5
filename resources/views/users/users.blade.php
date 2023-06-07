@extends('layouts.app')
@section('title')Stand | @endsection
@section('content')
    <div class="main-content pt-4">
            <section class="contact-list">
                <div class="row">
                    <div class="col-lg-12 mb-4">
                        <div class="card text-left">
                            <div class="card-header text-right bg-transparent">
                                <button class="btn btn-primary btn-md m-1" type="button" data-toggle="modal" data-target=".bd-example-modal-lg"><i class="i-Add-User text-white mr-2"></i> Add Contact</button>
                            </div>
                            <!-- begin::modal-->
                            <div class="ul-card-list__modal">
                                <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-body">
                                                <form>
                                                    <div class="form-group row">
                                                        <label class="col-sm-2 col-form-label" for="inputName">Name</label>
                                                        <div class="col-sm-10">
                                                            <input class="form-control" id="inputName" type="email" placeholder="Name">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-sm-2 col-form-label" for="inputEmail3">Email</label>
                                                        <div class="col-sm-10">
                                                            <input class="form-control" id="inputEmail3" type="email" placeholder="Email">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-sm-2 col-form-label" for="">Phone</label>
                                                        <div class="col-sm-10">
                                                            <input class="form-control" type="number" id="" placeholder="number....">
                                                        </div>
                                                    </div>
                                                    <fieldset class="form-group">
                                                        <div class="row">
                                                            <div class="col-form-label col-sm-2 pt-0">Radios</div>
                                                            <div class="col-sm-10">
                                                                <div class="form-check">
                                                                    <input class="form-check-input" id="gridRadios1" type="radio" name="gridRadios" value="option1" checked="">
                                                                    <label class="form-check-label ml-3" for="gridRadios1">First radio</label>
                                                                </div>
                                                                <div class="form-check">
                                                                    <input class="form-check-input" id="gridRadios2" type="radio" name="gridRadios" value="option2">
                                                                    <label class="form-check-label ml-3" for="gridRadios2">Second radio</label>
                                                                </div>
                                                                <div class="form-check disabled">
                                                                    <input class="form-check-input" id="gridRadios3" type="radio" name="gridRadios" value="option3" disabled="">
                                                                    <label class="form-check-label ml-3" for="gridRadios3">Third disabled radio</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </fieldset>
                                                    <div class="form-group row">
                                                        <div class="col-sm-2">Checkbox</div>
                                                        <div class="col-sm-10">
                                                            <div class="form-check">
                                                                <input class="form-check-input" id="gridCheck1" type="checkbox">
                                                                <label class="form-check-label ml-3" for="gridCheck1">Example checkbox</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <div class="col-sm-10">
                                                            <button class="btn btn-success" type="submit">Update</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end::modal-->
                            <div class="card-body">
                                <div class="table-responsive">
                                    <div id="ul-contact-list_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4 no-footer">
                                        <div class="row">
                                            <div class="col-sm-12 col-md-6">
                                                <div class="dataTables_length" id="ul-contact-list_length">
                                                    <label>Показать<select name="ul-contact-list_length" aria-controls="ul-contact-list" class="form-control form-control-sm">
                                                            <option value="10">10</option>
                                                            <option value="25">25</option>
                                                            <option value="50">50</option>
                                                            <option value="100">100</option>
                                                        </select></label>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-md-6">
                                                <div id="ul-contact-list_filter" class="dataTables_filter">
                                                    <label>Search:<input type="search" class="form-control form-control-sm" placeholder="" aria-controls="ul-contact-list"></label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <table class="display table dataTable no-footer" id="ul-contact-list" style="width: 100%;" role="grid" aria-describedby="ul-contact-list_info">
                                                    <thead>
                                                    <tr role="row">
                                                        <th class="sorting_asc" tabindex="0" aria-controls="ul-contact-list" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending" style="width: 123px;">Name</th>
                                                        <th class="sorting" tabindex="0" aria-controls="ul-contact-list" rowspan="1" colspan="1" aria-label="Email: activate to sort column ascending" style="width: 155px;">Email</th>
                                                        <th class="sorting" tabindex="0" aria-controls="ul-contact-list" rowspan="1" colspan="1" aria-label="Phone: activate to sort column ascending" style="width: 94px;">Phone</th>
                                                        <th class="sorting" tabindex="0" aria-controls="ul-contact-list" rowspan="1" colspan="1" aria-label="Role: activate to sort column ascending" style="width: 87px;">Role</th>
                                                        <th class="sorting" tabindex="0" aria-controls="ul-contact-list" rowspan="1" colspan="1" aria-label="Age: activate to sort column ascending" style="width: 34px;">Age</th>
                                                        <th class="sorting" tabindex="0" aria-controls="ul-contact-list" rowspan="1" colspan="1" aria-label="Joining Date: activate to sort column ascending" style="width: 92px;">Joining Date</th>
                                                        <th class="sorting" tabindex="0" aria-controls="ul-contact-list" rowspan="1" colspan="1" aria-label="Salary: activate to sort column ascending" style="width: 52px;">Salary</th>
                                                        <th class="sorting" tabindex="0" aria-controls="ul-contact-list" rowspan="1" colspan="1" aria-label="Action: activate to sort column ascending" style="width: 51px;">Action</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($user as $us)
                                                    <tr role="row" class="odd">
                                                        <td class="sorting_1">
                                                            <a href="{{ route('userCard', $us->id) }}">
                                                                <div class="ul-widget-app__profile-pic">{{ $us->name }}</div>
                                                            </a>
                                                        </td>
                                                        <td>{{ $us->email }}</td>
                                                        <td>{{ $us->login }}</td>
                                                        <td>
                                                            <a class="badge badge-danger m-2 p-2" href="#"></a>
                                                        </td>
                                                        <td>20</td>
                                                        <td>April 34, 2019</td>
                                                        <td>$320,800</td>
                                                        <td>
                                                            <a class="ul-link-action text-success" href="" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"><i class="i-Edit"></i></a>
                                                            <a class="ul-link-action text-danger mr-1" href="" data-toggle="tooltip" data-placement="top" title="" data-original-title="Want To Delete !!!"><i class="i-Eraser-2"></i></a>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12 col-md-5">
                                                <div class="dataTables_info" id="ul-contact-list_info" role="status" aria-live="polite">Showing 1 to 10 of 15 entries</div>
                                            </div>
                                            <div class="col-sm-12 col-md-7">
                                                <div class="dataTables_paginate paging_simple_numbers" id="ul-contact-list_paginate">
                                                    <ul class="pagination">
                                                        <li class="paginate_button page-item previous disabled" id="ul-contact-list_previous">
                                                            <a href="#" aria-controls="ul-contact-list" data-dt-idx="0" tabindex="0" class="page-link">Previous</a>
                                                        </li>
                                                        <li class="paginate_button page-item active">
                                                            <a href="#" aria-controls="ul-contact-list" data-dt-idx="1" tabindex="0" class="page-link">1</a>
                                                        </li>
                                                        <li class="paginate_button page-item ">
                                                            <a href="#" aria-controls="ul-contact-list" data-dt-idx="2" tabindex="0" class="page-link">2</a>
                                                        </li>
                                                        <li class="paginate_button page-item next" id="ul-contact-list_next">
                                                            <a href="#" aria-controls="ul-contact-list" data-dt-idx="3" tabindex="0" class="page-link">Next</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            {{--@foreach($user as $us)
                <div class="col-lg-4 col-xl-4 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="ul-contact-page__profile">
                                <div class="ul-contact-page__info">
                                    <p class="m-0 text-24">{{$us->name}}</p>
                                    <p class="text-muted m-0">{{ $us->email }}</p>
                                </div>
                                <a href="{{ route('UCRUser', $us->id) }}">
                                    <button class="btn btn-outline-success m-1" type="button">Информация</button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach--}}
        </div>
    </div>
@endsection
