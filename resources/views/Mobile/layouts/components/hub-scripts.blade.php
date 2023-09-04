<!-- JS Global Compulsory  -->
<script src="{{ asset('front/vendor/jquery/dist/jquery.min.js')}}"></script>
<script src="{{ asset('front/vendor/jquery-migrate/dist/jquery-migrate.min.js')}}"></script>
<script src="{{ asset('front/vendor/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>

<!-- JS Implementing Plugins -->
<script src="{{ asset('front/vendor/hs-navbar-vertical-aside/dist/hs-navbar-vertical-aside.min.js')}}"></script>
<script src="{{ asset('front/vendor/tom-select/dist/js/tom-select.complete.min.js') }}"></script>

<script src="{{ asset('front/vendor/hs-nav-scroller/dist/hs-nav-scroller.min.js')}}"></script>
<script src="{{ asset('front/vendor/flatpickr/dist/flatpickr.min.js')}}"></script>

<script src="{{ asset('front/vendor/clipboard/dist/clipboard.min.js')}}"></script>
<script src="{{ asset('front/vendor/tom-select/dist/js/tom-select.complete.min.js')}}"></script>

<!-- JS Front -->
<script src="{{ asset('front/js/theme.min.js')}}"></script>
<script src="{{ asset('front/js/hs.theme-appearance-charts.js')}}"></script>

<!-- JS Front -->


<script>
    $(document).on('ready', function () {
        // INITIALIZATION OF DATATABLES
        // =======================================================
        HSCore.components.HSDatatables.init($('#datatable'), {
            dom: 'Bfrtip',
            buttons: [
                {
                    extend: 'copy',
                    className: 'd-none'
                },
                {
                    extend: 'excel',
                    className: 'd-none'
                },
                {
                    extend: 'csv',
                    className: 'd-none'
                },
                {
                    extend: 'pdf',
                    className: 'd-none'
                },
                {
                    extend: 'print',
                    className: 'd-none'
                },
            ],
            select: {
                style: 'multi',
                selector: 'td:first-child input[type="checkbox"]',
                classMap: {
                    checkAll: '#datatableCheckAll',
                    counter: '#datatableCounter',
                    counterInfo: '#datatableCounterInfo'
                }
            },
            language: {
                zeroRecords: `<div class="text-center p-4">
              <img class="mb-3" src="./assets/svg/illustrations/oc-error.svg" alt="Image Description" style="width: 10rem;" data-hs-theme-appearance="default">
              <img class="mb-3" src="./assets/svg/illustrations-light/oc-error.svg" alt="Image Description" style="width: 10rem;" data-hs-theme-appearance="dark">
            <p class="mb-0">No data to show</p>
            </div>`
            }
        });

        const datatable = HSCore.components.HSDatatables.getItem(0)

        $('#export-copy').click(function() {
            datatable.button('.buttons-copy').trigger()
        });

        $('#export-excel').click(function() {
            datatable.button('.buttons-excel').trigger()
        });

        $('#export-csv').click(function() {
            datatable.button('.buttons-csv').trigger()
        });

        $('#export-pdf').click(function() {
            datatable.button('.buttons-pdf').trigger()
        });

        $('#export-print').click(function() {
            datatable.button('.buttons-print').trigger()
        });

        $('.js-datatable-filter').on('change', function() {
            var $this = $(this),
                elVal = $this.val(),
                targetColumnIndex = $this.data('target-column-index');

            datatable.column(targetColumnIndex).search(elVal).draw();
        });
    });
</script>

<!-- JS Plugins Init. -->
<script>
    (function() {
        window.onload = function () {

            // INITIALIZATION OF BOOTSTRAP DROPDOWN
            // =======================================================
            HSBsDropdown.init()


        }
    })()
</script>

