@extends('Mobile.layouts.front.auth')
@section('title') Meeper | Регистрация @endsection
@section('content')

    <div class="container-fluid px-3">
        <div class="row">
            @include('Mobile.includes.alerts.alerts')
            @include('Mobile.auth.components.switchButtons')
            <div class="col-lg-6 d-flex justify-content-center align-items-center min-vh-lg-100">
                <div class="w-100 content-space-t-1 content-space-t-lg-2 content-space-b-1" style="max-width: 25rem;">
                    @include('Mobile.auth.components.congregationFormRegister')
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
