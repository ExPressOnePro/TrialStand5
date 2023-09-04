@extends('Mobile.layouts.front.app')
@section('title') ChangeLog @endsection
@section('content')

    <div class="navbar-sidebar-aside-content content-space-1 content-space-md-2 px-lg-5 px-xl-10">
        <!-- Page Header -->
        <div class="docs-page-header">
            <div class="row align-items-center">
                <div class="col-sm">
                    <h1 class="docs-page-header-title">Журнал изменений</h1>
                    <p class="docs-page-header-text">Посмотрите, что нового добавлено, изменено, исправлено, улучшено или обновлено в последних версиях Meeper.</p>
                </div>
            </div>
        </div>
        <!-- End Page Header -->

        <!-- Alert -->
{{--        <div class="alert alert-soft-dark" role="alert">--}}
{{--            <div class="d-flex align-items-baseline">--}}
{{--                <div class="flex-shrink-0">--}}
{{--                    <i class="bi-info-circle me-1"></i>--}}
{{--                </div>--}}

{{--                <div class="flex-grow-1 ms-2">--}}
{{--                    <h3>Read this before updating</h3>--}}
{{--                    Do <span class="text-dark fw-semibold">not</span> forget to <span class="text-dark fw-semibold">backup</span> your files and <span class="text-dark fw-semibold">read the changelog</span> before updating your Front copy. If you come across with any problems with Front template during the update and development processes, feel free to contact our support group at <a class="link" href="https://htmlstream.com/contact-us" target="_blank">htmlstream.com/contact-us <i class="fas fa-external-link-alt fa-xs"></i></a> and our team will assist you within a short time.--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
        <!-- End Alert -->

        <div id="version2_1_1" class="content-divider">
            <h2 class="hs-docs-heading"><code>v1.5.89</code> - 04 сентября, 2023 <a class="anchorjs-link" href="#version2_1_1" aria-label="Anchor" data-anchorjs-icon="#"></a></h2>

            <div class="mb-3">
                <span class="badge bg-soft-info text-info py-2 px-3 me-2">Обновление</span>
                Интерфейса
            </div>

            <div class="mb-3">
                <span class="badge bg-soft-info text-info py-2 px-3 me-2">Обновление</span>
                Логики
            </div>

            <div class="mb-3">
                <span class="badge bg-soft-info text-info py-2 px-3 me-2">Обновление</span>
                Безопасности
            </div>

            <div class="mb-3">
                <span class="badge bg-soft-info text-info py-2 px-3 me-2">Обновление</span>
                Структуры данных
            </div>

        </div>
    </div>

@endsection
