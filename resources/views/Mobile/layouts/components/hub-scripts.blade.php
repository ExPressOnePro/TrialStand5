<!-- JS Global Compulsory  -->
<script src="{{ asset('front/vendor/jquery/dist/jquery.min.js')}}"></script>
<script src="{{ asset('front/vendor/jquery-migrate/dist/jquery-migrate.min.js')}}"></script>
<script src="{{ asset('front/vendor/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>

<!-- JS Implementing Plugins -->
<script src="{{ asset('front/vendor/hs-navbar-vertical-aside/dist/hs-navbar-vertical-aside.min.js')}}"></script>
<!-- JS Front -->
<script src="{{ asset('front/js/theme.min.js') }}"></script>
<script src="{{ asset('front/js/hs.theme-appearance-charts.js')}}"></script>

<!-- JS Plugins Init. -->
<script>
    (function() {
        window.onload = function () {


            // INITIALIZATION OF NAVBAR VERTICAL ASIDE
            // =======================================================
            new HSSideNav('.js-navbar-vertical-aside').init()


            // INITIALIZATION OF FORM SEARCH
            // =======================================================
            new HSFormSearch('.js-form-search')


            // INITIALIZATION OF BOOTSTRAP DROPDOWN
            // =======================================================
            HSBsDropdown.init()


            // INITIALIZATION OF NAV SCROLLER
            // =======================================================
            new HsNavScroller('.js-nav-scroller')


            // INITIALIZATION OF STICKY BLOCKS
            // =======================================================
            new HSStickyBlock('.js-sticky-block', {
                targetSelector: document.getElementById('header').classList.contains('navbar-fixed') ? '#header' : null
            })


            // INITIALIZATION OF FILE ATTACHMENT
            // =======================================================
            new HSFileAttach('.js-file-attach')
        }
    })()
</script>

<!-- Style Switcher JS -->
