@extends('Mobile.layouts.front.app')
@section('title') Meeper | Собрание @endsection
@section('content')

    <div class="content container-fluid">
        @inject('mobile_detect', 'Mobile_Detect')
        @if ($mobile_detect->isMobile())
            @include('Modules.congregation.components.MUsersTable')
        @else
            @include('Modules.congregation.components.DesktopUsersList')
        @endif
    </div>

    <script>
        function callNumber(phoneNumber) {
            window.location.href = 'tel:' + phoneNumber;
        }
    </script>


    <script>
        (function () {
            // INITIALIZATION OF DATATABLES
            // =======================================================
            HSCore.components.HSDatatables.init('.js-datatable')
            const exportDatatable = HSCore.components.HSDatatables.getItem('exportDatatable')

            document.getElementById('export-copy').addEventListener('click', function () {
                exportDatatable.button('.buttons-copy').trigger()
            })

            document.getElementById('export-excel').addEventListener('click', function () {
                exportDatatable.button('.buttons-excel').trigger()
            })

            document.getElementById('export-csv').addEventListener('click', function () {
                exportDatatable.button('.buttons-csv').trigger()
            })

            document.getElementById('export-pdf').addEventListener('click', function () {
                exportDatatable.button('.buttons-pdf').trigger()
            })

            document.getElementById('export-print').addEventListener('click', function () {
                exportDatatable.button('.buttons-print').trigger()
            })
        })()
    </script>

@endsection
