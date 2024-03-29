@extends('Mobile.layouts.front.auth')
@section('title') Meeper | Регистрация @endsection
@section('content')

    <div class="container-fluid px-3">
        @include('Mobile.includes.alerts.alerts')
        <div class="row">
            @include('Mobile.auth.components.switchButtons')
            <div class="col-lg-6 d-flex justify-content-center align-items-center min-vh-lg-100">
                <div class="w-100 content-space-t-1 content-space-t-lg-2 content-space-b-1" style="max-width: 25rem;">

                    <!-- Tab Content -->
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="nav-one-eg1" role="tabpanel" aria-labelledby="nav-one-eg1-tab">
                            @include('Mobile.auth.components.personalFormRegister')
                        </div>

                        <div class="tab-pane fade" id="nav-two-eg1" role="tabpanel" aria-labelledby="nav-two-eg1-tab">
                            @include('Mobile.auth.components.congregationFormRegister')
                        </div>

                    </div>
                    <!-- End Tab Content -->

                </div>
            </div>
        </div>
    </div>



    <script>
        document.getElementById('show-password').addEventListener('click', () => {
            const passwordInput = document.getElementById('password');

            if (passwordInput.getAttribute('type') === 'password') {
                passwordInput.setAttribute('type', 'text');
            } else {
                passwordInput.setAttribute('type', 'password');
            }
        });
    </script>


@endsection
