<header class="navbar-fixed navbar-height navbar-bordered bg-white navbar-shadow">
    <div class="container">
        <div class="navbar-nav-wrap mt-2">
            <div class="navbar">
                <h1>
                    Meeper
                </h1>
            </div>

            <div class="navbar ms-auto">
                <div class="form-check form-switch form-switch-dark">
                    <input class="form-check-input me-0" type="checkbox" id="darkSwitch">
                </div>
            </div>
        </div>
    </div>
</header>


<script>
    // SWITHCER THEME APPEARANCE
    // =======================================================
    const $swithcer = document.querySelector('#darkSwitch')

    if (HSThemeAppearance.getOriginalAppearance() === 'dark') {
        $swithcer.checked = true
    }

    $swithcer.addEventListener('change', e => {
        HSThemeAppearance.setAppearance(e.target.checked ? 'dark' : 'default')
    })
</script>
