<head>
    <meta charset="utf-8">
    <!-- разрешение экрана -->
    <meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">

    <!-- Icon -->
{{--    <link rel="icon" href="{{ asset('public/favicon.ico') }}" sizes="any"><!-- 32×32 -->--}}
{{--    <link rel="apple-touch-icon" href="{{ asset('public/apple-touch-icon.png') }}"><!-- 180×180 -->--}}
{{--    <link rel="manifest" href="{{ asset('public/manifest.json') }}"> <!--Manifest -->--}}

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>


    <!-- CSS Implementing Plugins -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

{{--    <link rel="stylesheet" href="{{ asset('front/vendor/bootstrap-icons/font/bootstrap-icons.css') }}">--}}

{{--    <link rel="stylesheet" href="{{ asset('css/app.css') }}">--}}
{{--    <link rel="stylesheet" href="{{ asset('front/vendor/flatpickr/dist/flatpickr.min.css')}}">--}}
{{--    <link rel="stylesheet" href="{{ asset('front/vendor/tom-select/dist/css/tom-select.bootstrap5.css') }}">--}}
{{--    <link rel="stylesheet" href="{{ asset('front/vendor/datatables.net.extensions/fixedColumns.dataTables.min.css') }}">--}}
{{--    <link rel="stylesheet" href="{{ asset('front/vendor/datatables.net.extensions/dataTables.scroller.min.css') }}">--}}
{{--    <link rel="stylesheet" href="{{ asset('front/vendor/quill/dist/quill.snow.css') }}">--}}
{{--    <link rel="stylesheet" href="{{ asset('front/vendor/flatpickr/dist/flatpickr.min.css') }}">--}}
{{--    <link rel="stylesheet" href="{{ asset('front/vendor/hs-mega-menu/dist/hs-mega-menu.min.css') }}">--}}

{{--    <!-- CSS Front Template -->--}}
{{--    <link rel="stylesheet" href="{{ asset('front/css/theme.min.css') }}" data-hs-appearance="default" as="style">--}}
{{--    <link rel="stylesheet" href="{{ asset('front/css/theme-dark.min.css') }}" data-hs-appearance="dark" as="style">--}}



{{--    <style data-hs-appearance-onload-styles>--}}
{{--        *--}}
{{--        {--}}
{{--            transition: unset !important;--}}
{{--        }--}}

{{--        body--}}
{{--        {--}}
{{--            opacity: 0;--}}
{{--        }--}}
{{--    </style>--}}



{{--    <script>--}}
{{--        window.hs_config = {"autopath":"@@autopath","deleteLine":"hs-builder:delete","deleteLine:build":"hs-builder:build-delete","deleteLine:dist":"hs-builder:dist-delete","previewMode":false,"startPath":"/index.html","vars":{"themeFont":"https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap","version":"?v=1.0"},"layoutBuilder":{"extend":{"switcherSupport":true},"header":{"layoutMode":"default","containerMode":"container-fluid"},"sidebarLayout":"default"},"themeAppearance":{"layoutSkin":"default","sidebarSkin":"default","styles":{"colors":{"primary":"#377dff","transparent":"transparent","white":"#fff","dark":"132144","gray":{"100":"#f9fafc","900":"#1e2022"}},"font":"Inter"}},"languageDirection":{"lang":"en"},"skipFilesFromBundle":{"dist":["assets/js/hs.theme-appearance.js","assets/js/hs.theme-appearance-charts.js","assets/js/demo.js"],"build":["assets/css/theme.css","assets/vendor/hs-navbar-vertical-aside/dist/hs-navbar-vertical-aside-mini-cache.js","assets/js/demo.js","assets/css/theme-dark.css","assets/css/docs.css","assets/vendor/icon-set/style.css","assets/js/hs.theme-appearance.js","assets/js/hs.theme-appearance-charts.js","node_modules/chartjs-plugin-datalabels/dist/chartjs-plugin-datalabels.min.js","assets/js/demo.js"]},"minifyCSSFiles":["assets/css/theme.css","assets/css/theme-dark.css"],"copyDependencies":{"dist":{"*assets/js/theme-custom.js":""},"build":{"*assets/js/theme-custom.js":"","node_modules/bootstrap-icons/font/*fonts/**":"assets/css"}},"buildFolder":"","replacePathsToCDN":{},"directoryNames":{"src":"./src","dist":"./dist","build":"./build"},"fileNames":{"dist":{"js":"theme.min.js","css":"theme.min.css"},"build":{"css":"theme.min.css","js":"theme.min.js","vendorCSS":"vendor.min.css","vendorJS":"vendor.min.js"}},"fileTypes":"jpg|png|svg|mp4|webm|ogv|json"}--}}
{{--        window.hs_config.gulpRGBA = (p1) => {--}}
{{--            const options = p1.split(',')--}}
{{--            const hex = options[0].toString()--}}
{{--            const transparent = options[1].toString()--}}

{{--            var c;--}}
{{--            if(/^#([A-Fa-f0-9]{3}){1,2}$/.test(hex)){--}}
{{--                c= hex.substring(1).split('');--}}
{{--                if(c.length== 3){--}}
{{--                    c= [c[0], c[0], c[1], c[1], c[2], c[2]];--}}
{{--                }--}}
{{--                c= '0x'+c.join('');--}}
{{--                return 'rgba('+[(c>>16)&255, (c>>8)&255, c&255].join(',')+',' + transparent + ')';--}}
{{--            }--}}
{{--            throw new Error('Bad Hex');--}}
{{--        }--}}
{{--        window.hs_config.gulpDarken = (p1) => {--}}
{{--            const options = p1.split(',')--}}

{{--            let col = options[0].toString()--}}
{{--            let amt = -parseInt(options[1])--}}
{{--            var usePound = false--}}

{{--            if (col[0] == "#") {--}}
{{--                col = col.slice(1)--}}
{{--                usePound = true--}}
{{--            }--}}
{{--            var num = parseInt(col, 16)--}}
{{--            var r = (num >> 16) + amt--}}
{{--            if (r > 255) {--}}
{{--                r = 255--}}
{{--            } else if (r < 0) {--}}
{{--                r = 0--}}
{{--            }--}}
{{--            var b = ((num >> 8) & 0x00FF) + amt--}}
{{--            if (b > 255) {--}}
{{--                b = 255--}}
{{--            } else if (b < 0) {--}}
{{--                b = 0--}}
{{--            }--}}
{{--            var g = (num & 0x0000FF) + amt--}}
{{--            if (g > 255) {--}}
{{--                g = 255--}}
{{--            } else if (g < 0) {--}}
{{--                g = 0--}}
{{--            }--}}
{{--            return (usePound ? "#" : "") + (g | (b << 8) | (r << 16)).toString(16)--}}
{{--        }--}}
{{--        window.hs_config.gulpLighten = (p1) => {--}}
{{--            const options = p1.split(',')--}}

{{--            let col = options[0].toString()--}}
{{--            let amt = parseInt(options[1])--}}
{{--            var usePound = false--}}

{{--            if (col[0] == "#") {--}}
{{--                col = col.slice(1)--}}
{{--                usePound = true--}}
{{--            }--}}
{{--            var num = parseInt(col, 16)--}}
{{--            var r = (num >> 16) + amt--}}
{{--            if (r > 255) {--}}
{{--                r = 255--}}
{{--            } else if (r < 0) {--}}
{{--                r = 0--}}
{{--            }--}}
{{--            var b = ((num >> 8) & 0x00FF) + amt--}}
{{--            if (b > 255) {--}}
{{--                b = 255--}}
{{--            } else if (b < 0) {--}}
{{--                b = 0--}}
{{--            }--}}
{{--            var g = (num & 0x0000FF) + amt--}}
{{--            if (g > 255) {--}}
{{--                g = 255--}}
{{--            } else if (g < 0) {--}}
{{--                g = 0--}}
{{--            }--}}
{{--            return (usePound ? "#" : "") + (g | (b << 8) | (r << 16)).toString(16)--}}
{{--        }--}}
{{--    </script>--}}

    <!-- Scripts -->
{{--    <script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>--}}
    <script src="https://kit.fontawesome.com/d19fab2cf2.js" crossorigin="anonymous"></script>

    <!-- PWA  -->
    <meta name="theme-color" content="#8ca3b4"/>
    <link rel="apple-touch-icon" href="{{ asset('logo.PNG') }}">
    <link rel="manifest" href="{{ asset('/manifest.json') }}">
    <script src="{{ asset('/sw.js') }}"></script>
    <script>
        if (!navigator.serviceWorker.controller) {
            navigator.serviceWorker.register("/sw.js").then(function (reg) {
                console.log("Service worker has been registered for scope: " + reg.scope);
            });
        }
    </script>

</head>
