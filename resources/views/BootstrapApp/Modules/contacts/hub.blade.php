@extends('BootstrapApp.layouts.bootstrapApp')
@section('title')
    Meeper
@endsection
@section('content')

<style>
    #datatableWithSearchInput {
        width: 300px; /* Замените на нужную ширину */
        height: 40px; /* Замените на нужную высоту */
    }
</style>


    <div class="content container-fluid mb-5">
        <div class="card-body table-responsive datatable-custom">
            <div class="row justify-content-between align-items-center flex-grow-1 mb-3">
                <div class="col">
                    <form>
                        <div class="input-group input-group-merge">
                            <div class="input-group-prepend input-group-text">
                                <i class="bi-search"></i>
                            </div>
                            <input id="datatableWithSearchInput" type="search" class="form-control form-control-lg" placeholder="Поиск">
                        </div>
                    </form>
                </div>
            </div>
            <table id="contact" class=" table table-nowrap border table-align-middle mb-5">
            <thead class="bg-light text-center">
                    <tr>
                        <th>Имя фамилия</th>
                    </tr>
                </thead>

                <tbody>
                @foreach($users as $user)
                    @if (isset($user->info) && $decodedInfo = json_decode($user->info, true))
                        @if (isset($decodedInfo['mobile_phone']) && !empty($decodedInfo['mobile_phone']))
                    <tr>
                        <td>
                            <div class="d-flex">
                                <div class="flex-grow-1">
                                    <div class="row align-items-center">
                                        <div class="col">
                                            <h5 class="mb-1">{{ $user->last_name }} {{ $user->first_name }}</h5>
                                            <div class="h3"><span class="badge text-decoration-none text-white bg-secondary">{{ $decodedInfo['mobile_phone'] }}</span></div>
                                        </div>
                                        <!-- End Col -->

                                        <div class="col-auto">
                                            <button class="btn btn-outline-primary" onclick="callNumber('{{$decodedInfo['mobile_phone']}}')">
                                                <i class="fa-solid fa-phone"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                        @endif
                    @endif
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

<script>

    $(document).ready(function() {
        $('#contact').DataTable( {
            dom: 'lt',
            paging: false, // Disable paging
            searching: true
        } );
        // Ваш поиск DataTables
        $('#datatableWithSearchInput').on('keyup', function () {
            $('#contact').DataTable().search($(this).val()).draw();
        });
    } );

</script>


<script>

    function callNumber(phoneNumber) {
        window.location.href = 'tel:' + phoneNumber;
    }
</script>



@endsection
