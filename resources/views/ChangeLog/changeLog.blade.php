@extends('Mobile.layouts.front.app')
@section('title') ChangeLog @endsection
@section('content')

    <div class="navbar-sidebar-aside-content content-space-1 content-space-md-2 px-lg-5 px-xl-10">
        <!-- Page Header -->
        <div class="docs-page-header">
            <div class="row col-6 mx-auto d-flex justify-content-center align-items-center">
                <div class="col-sm">
                    <h1 class="docs-page-header-title">Журнал изменений</h1>
                    <p class="docs-page-header-text">Посмотрите, что нового добавлено, изменено, исправлено, улучшено или обновлено в последних версиях Meeper.</p>
                </div>
            </div>
        </div>
        <div class="row col-6 mx-auto d-flex justify-content-center">
            <div id="version2_0_4" class="content-divider card mb-3">
                <div class="card-header">
                    <h2 class="hs-docs-heading"><code>v2.0.4</code> - 08 октября, 2023
                        <a class="anchorjs-link" href="#version2_1_1" aria-label="Anchor" data-anchorjs-icon="#"></a></h2>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <span class="badge bg-soft-primary text-primary py-2 px-3 me-2">Новое</span>
                        Теперь у вас есть возможность с легкостью объединять все таблицы в одну, обеспечивая более удобное и эффективное управление записями.
                    </div>

                    <div class="mb-3">
                        <span class="badge bg-soft-danger text-danger py-2 px-3 me-2">Исправлено</span>
                        Решены небольшие технические недочеты, повышающие стабильность и надежность работы Контактной Книги.
                    </div>
                    <div class="mb-3">
                        <span class="badge bg-soft-danger text-danger py-2 px-3 me-2">Исправлено</span>
                        Решены проблемы, связанные с некорректным отображением данных при объединении таблиц.
                    </div>
                    <div class="mb-3">
                        <span class="badge bg-soft-danger text-danger py-2 px-3 me-2">Исправлено</span>
                        Устранены возможные сбои, которые могли возникнуть при выполнении операций объединения.
                    </div>

                    <div class="mb-3">
                        <span class="badge bg-soft-info text-info py-2 px-3 me-2">Обновление</span>
                        Добавлен интуитивно понятный интерфейс, который позволяет пользователям легко выбирать и объединять таблицы.
                        Простые шаги помогут вам создать единое пространство для данных без лишних сложностей.
                    </div>
                </div>
            </div>
            <div id="version2_0_3" class="content-divider card mb-3">
                <div class="card-header">
                    <h2 class="hs-docs-heading"><code>v2.0.3</code> - 21 сентября, 2023</h2>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <span class="badge bg-soft-primary text-primary py-2 px-3 me-2">Новое</span>
                        <strong>Контактная Книга:</strong> Добавлена возможность просматривать контакты прямо внутри приложения.
                    </div>

                    <div class="mb-3">
                        <span class="badge bg-soft-danger text-danger py-2 px-3 me-2">Исправлено</span>
                        Решены небольшие технические недочеты, повышающие стабильность и надежность работы Контактной Книги.
                    </div>

                    <div class="mb-3">
                        <span class="badge bg-soft-info text-info py-2 px-3 me-2">Обновление</span>
                        Интерфейс Контактной Книги интуитивен и приятен в использовании.
                    </div>
                    <div class="mb-3">
                        <span class="badge bg-soft-info text-info py-2 px-3 me-2">Обновление</span>
                        Добавлена загрузка после нажатия кнопки записаться, чтобы избежать случайные или дублирующие нажатия
                    </div>
                </div>
            </div>
            <div id="version2_0_2" class="content-divider card mb-3">
                <div class="card-header">
                    <h2 class="hs-docs-heading"><code>v2.0.2</code> - 09 Сентября, 2023</h2>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <span class="badge bg-soft-primary text-primary py-2 px-3 me-2">Новое</span>
                        Ответсвенный имеет возможность помочь с авторизацией пользователей
                    </div>

                    <div class="mb-3">
                        <span class="badge bg-soft-primary text-primary py-2 px-3 me-2">Новое</span>
                        Добавлена функция запомнить меня
                    </div>


                    <div class="mb-3">
                        <span class="badge bg-soft-danger text-danger py-2 px-3 me-2">Исправлено</span>
                        Ошибки при записях в таблицу стенда
                    </div>
                    <div class="mb-3">
                        <span class="badge bg-soft-info text-info py-2 px-3 me-2">Обновление</span>
                        Вывод некоторых ошибок на страницу, связанных с использованием
                    </div>
                </div>
            </div>
            <div id="version2_0_1" class="content-divider card mb-3">
                <div class="card-header">
                    <h2 class="hs-docs-heading"><code>v2.0.1</code> - 06 сентября, 2023 <a class="anchorjs-link" href="#version2_1_1" aria-label="Anchor" data-anchorjs-icon="#"></a></h2>
                </div>

                <div class="card-body">
                    <div class="mb-3">
                        <span class="badge bg-soft-info text-info py-2 px-3 me-2">Обновление</span>
                        Интерфейса
                    </div>
                </div>

            </div>
            <div id="version2_0_0" class="content-divider card mb-3">
                <div class="card-header">
                    <h2 class="hs-docs-heading"><code>v2.0.0</code> - 04 сентября, 2023 <a class="anchorjs-link" href="#version2_1_1" aria-label="Anchor" data-anchorjs-icon="#"></a></h2>
                </div>
                <div class="card-body">
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
        </div>
    </div>

@endsection
