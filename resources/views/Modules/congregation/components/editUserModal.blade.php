<div class="modal fade mb-5" id="editUserModal{{$user->id}}" tabindex="-1" aria-labelledby="editUserModalLabel" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editUserModalLabel">Изменения пользователя</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- Body -->
            <div class="modal-body">
{{--                <!-- Nav Scroller -->--}}
{{--                <div class="js-nav-scroller hs-nav-scroller-horizontal">--}}
{{--            <span class="hs-nav-scroller-arrow-prev" style="display: none;">--}}
{{--              <a class="hs-nav-scroller-arrow-link" href="javascript:;">--}}
{{--                <i class="bi-chevron-left"></i>--}}
{{--              </a>--}}
{{--            </span>--}}

{{--                    <span class="hs-nav-scroller-arrow-next" style="display: none;">--}}
{{--              <a class="hs-nav-scroller-arrow-link" href="javascript:;">--}}
{{--                <i class="bi-chevron-right"></i>--}}
{{--              </a>--}}
{{--            </span>--}}

{{--                    <!-- Nav -->--}}
{{--                    <ul class="js-tabs-to-dropdown nav nav-segment nav-fill mb-5" id="editUserModalTab" role="tablist">--}}
{{--                        <li class="nav-item" role="presentation">--}}
{{--                            <a class="nav-link active" href="#profile" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" role="tab" aria-selected="true">--}}
{{--                                <i class="bi-person me-1"></i> Профиль--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                    </ul>--}}
{{--                    <!-- End Nav -->--}}
{{--                </div>--}}
{{--                <!-- End Nav Scroller -->--}}

                <!-- Tab Content -->
                <div class="tab-content" id="editUserModalTabContent">
                    <div class="tab-pane fade active show" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        <form action="{{ route('update.profile.congr', $user->id) }}" method="post">
                            @csrf
                            <!-- Form -->
                            <div class="row mb-4">
                                <label for="editFirstNameModalLabel" class="col-sm-3 col-form-label form-label">Полное имя <i class="tio-help-outlined text-body ms-1" data-bs-toggle="tooltip" data-bs-placement="top" aria-label="Displayed on public forums, such as Front." data-bs-original-title="Displayed on public forums, such as Front."></i></label>

                                <div class="col-sm-9">
                                    <div class="input-group input-group-sm-vertical">
                                        <input type="text" class="form-control" name="editLastNameModal" id="editLastNameModalLabel" placeholder="Your last name" aria-label="Your last name" value="{{$user->last_name}}">
                                        <input type="text" class="form-control" name="editFirstNameModal" id="editFirstNameModalLabel" placeholder="Your first name" aria-label="Your first name" value="{{$user->first_name}}">

                                    </div>
                                </div>
                            </div>
                            <!-- End Form -->

                            <div class="d-flex justify-content-end">
                                <div class="d-flex gap-3">
                                    <button type="button" class="btn btn-white" data-bs-dismiss="modal" aria-label="Close">Отменить</button>
                                    <button type="submit" class="btn btn-primary">Сохранить</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- End Tab Content -->
            </div>
            <!-- End Body -->
        </div>
    </div>
</div>
