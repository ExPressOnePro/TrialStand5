@extends('Desktop.layouts.app')
@section('title') Meeper | Карточка @endsection
@section('content')

    <script src="{{ asset('front/js/hs.theme-appearance.js') }}"></script>
    <script src="{{ asset('front/vendor/hs-navbar-vertical-aside/dist/hs-navbar-vertical-aside-mini-cache.js') }}"></script>

    <aside class="js-navbar-vertical-aside navbar navbar-vertical-aside navbar-vertical
    navbar-vertical-fixed navbar-expand-xl navbar-bordered bg-white  ">
        <div class="navbar-vertical-container">
            <div class="navbar-vertical-footer-offset">
                <!-- Logo -->

                <a class="navbar-brand" href="./index.html" aria-label="Front">
                    <img class="navbar-brand-logo" src="./assets/svg/logos/logo.svg" alt="Logo" data-hs-theme-appearance="default">
                    <img class="navbar-brand-logo" src="./assets/svg/logos-light/logo.svg" alt="Logo" data-hs-theme-appearance="dark">
                    <img class="navbar-brand-logo-mini" src="./assets/svg/logos/logo-short.svg" alt="Logo" data-hs-theme-appearance="default">
                    <img class="navbar-brand-logo-mini" src="./assets/svg/logos-light/logo-short.svg" alt="Logo" data-hs-theme-appearance="dark">
                </a>

                <!-- End Logo -->

                <!-- Navbar Vertical Toggle -->
                <button type="button" class="js-navbar-vertical-aside-toggle-invoker navbar-aside-toggler">
                    <i class="bi-arrow-bar-left navbar-toggler-short-align" data-bs-template='<div class="tooltip d-none d-md-block" role="tooltip"><div class="arrow"></div><div class="tooltip-inner"></div></div>' data-bs-toggle="tooltip" data-bs-placement="right" title="Collapse"></i>
                    <i class="bi-arrow-bar-right navbar-toggler-full-align" data-bs-template='<div class="tooltip d-none d-md-block" role="tooltip"><div class="arrow"></div><div class="tooltip-inner"></div></div>' data-bs-toggle="tooltip" data-bs-placement="right" title="Expand"></i>
                </button>

                <!-- End Navbar Vertical Toggle -->

                <!-- Content -->
                <div class="navbar-vertical-content">
                    <div id="navbarVerticalMenu" class="nav nav-pills nav-vertical card-navbar-nav">
                        <!-- Collapse -->
                        <div class="nav-item">
                            <a class="nav-link dropdown-toggle " href="#navbarVerticalMenuDashboards" role="button" data-bs-toggle="collapse" data-bs-target="#navbarVerticalMenuDashboards" aria-expanded="false" aria-controls="navbarVerticalMenuDashboards">
                                <i class="bi-house-door nav-icon"></i>
                                <span class="nav-link-title">Dashboards</span>
                            </a>

                            <div id="navbarVerticalMenuDashboards" class="nav-collapse collapse " data-bs-parent="#navbarVerticalMenu">
                                <a class="nav-link " href="./index.html">Default</a>
                                <a class="nav-link " href="./dashboard-alternative.html">Alternative</a>
                            </div>
                        </div>
                        <!-- End Collapse -->

                        <span class="dropdown-header mt-4">Pages</span>
                        <small class="bi-three-dots nav-subtitle-replacer"></small>

                        <!-- Collapse -->
                        <div class="navbar-nav nav-compact">

                        </div>
                        <div id="navbarVerticalMenuPagesMenu">
                            <!-- Collapse -->
                            <div class="nav-item">
                                <a class="nav-link dropdown-toggle " href="#navbarVerticalMenuPagesUsersMenu" role="button" data-bs-toggle="collapse" data-bs-target="#navbarVerticalMenuPagesUsersMenu" aria-expanded="false" aria-controls="navbarVerticalMenuPagesUsersMenu">
                                    <i class="bi-people nav-icon"></i>
                                    <span class="nav-link-title">Users</span>
                                </a>

                                <div id="navbarVerticalMenuPagesUsersMenu" class="nav-collapse collapse " data-bs-parent="#navbarVerticalMenuPagesMenu">
                                    <a class="nav-link " href="./users.html">Overview</a>
                                    <a class="nav-link " href="./users-leaderboard.html">Leaderboard</a>
                                    <a class="nav-link " href="./users-add-user.html">Add User <span class="badge bg-info rounded-pill ms-1">Hot</span></a>
                                </div>
                            </div>
                            <!-- End Collapse -->

                            <!-- Collapse -->
                            <div class="nav-item">
                                <a class="nav-link dropdown-toggle active" href="#navbarVerticalMenuPagesUserProfileMenu" role="button" data-bs-toggle="collapse" data-bs-target="#navbarVerticalMenuPagesUserProfileMenu" aria-expanded="true" aria-controls="navbarVerticalMenuPagesUserProfileMenu">
                                    <i class="bi-person nav-icon"></i>
                                    <span class="nav-link-title">User Profile <span class="badge bg-primary rounded-pill ms-1">5</span></span>
                                </a>

                                <div id="navbarVerticalMenuPagesUserProfileMenu" class="nav-collapse collapse show" data-bs-parent="#navbarVerticalMenuPagesMenu">
                                    <a class="nav-link " href="./user-profile.html">Profile</a>
                                    <a class="nav-link " href="./user-profile-teams.html">Teams</a>
                                    <a class="nav-link " href="./user-profile-projects.html">Projects</a>
                                    <a class="nav-link " href="./user-profile-connections.html">Connections</a>
                                    <a class="nav-link active" href="./user-profile-my-profile.html">My Profile</a>
                                </div>
                            </div>
                            <!-- End Collapse -->

                            <!-- Collapse -->
                            <div class="nav-item">
                                <a class="nav-link dropdown-toggle " href="#navbarVerticalMenuPagesAccountMenu" role="button" data-bs-toggle="collapse" data-bs-target="#navbarVerticalMenuPagesAccountMenu" aria-expanded="false" aria-controls="navbarVerticalMenuPagesAccountMenu">
                                    <i class="bi-person-badge nav-icon"></i>
                                    <span class="nav-link-title">Account</span>
                                </a>

                                <div id="navbarVerticalMenuPagesAccountMenu" class="nav-collapse collapse " data-bs-parent="#navbarVerticalMenuPagesMenu">
                                    <a class="nav-link " href="./account-settings.html">Settings</a>
                                    <a class="nav-link " href="./account-billing.html">Billing</a>
                                    <a class="nav-link " href="./account-invoice.html">Invoice</a>
                                </div>
                            </div>
                            <!-- End Collapse -->

                            <!-- Collapse -->
                            <div class="nav-item">
                                <a class="nav-link dropdown-toggle " href="#navbarVerticalMenuPagesEcommerceMenu" role="button" data-bs-toggle="collapse" data-bs-target="#navbarVerticalMenuPagesEcommerceMenu" aria-expanded="false" aria-controls="navbarVerticalMenuPagesEcommerceMenu">
                                    <i class="bi-basket nav-icon"></i>
                                    <span class="nav-link-title">E-commerce</span>
                                </a>

                                <div id="navbarVerticalMenuPagesEcommerceMenu" class="nav-collapse collapse " data-bs-parent="#navbarVerticalMenuPagesMenu">
                                    <a class="nav-link " href="./ecommerce.html">Overview</a>

                                    <div id="navbarVerticalMenuPagesMenuEcommerce">
                                        <!-- Collapse -->
                                        <div class="nav-item">
                                            <a class="nav-link dropdown-toggle" href="#navbarVerticalMenuPagesEcommerceProductsMenu" role="button" data-bs-toggle="collapse" data-bs-target="#navbarVerticalMenuPagesEcommerceProductsMenu" aria-expanded="false" aria-controls="navbarVerticalMenuPagesEcommerceProductsMenu">
                                                Products
                                            </a>

                                            <div id="navbarVerticalMenuPagesEcommerceProductsMenu" class="nav-collapse collapse " data-bs-parent="#navbarVerticalMenuPagesMenuEcommerce">
                                                <a class="nav-link " href="./ecommerce-products.html">Products</a>
                                                <a class="nav-link " href="./ecommerce-product-details.html">Product Details</a>
                                                <a class="nav-link " href="./ecommerce-add-product.html">Add Product</a>
                                            </div>
                                        </div>
                                        <!-- End Collapse -->

                                        <!-- Collapse -->
                                        <div class="nav-item">
                                            <a class="nav-link dropdown-toggle" href="#navbarVerticalMenuPagesEcommerceOrdersMenu" role="button" data-bs-toggle="collapse" data-bs-target="#navbarVerticalMenuPagesEcommerceOrdersMenu" aria-expanded="false" aria-controls="navbarVerticalMenuPagesEcommerceOrdersMenu">
                                                Orders
                                            </a>

                                            <div id="navbarVerticalMenuPagesEcommerceOrdersMenu" class="nav-collapse collapse " data-bs-parent="#navbarVerticalMenuPagesMenuEcommerce">
                                                <a class="nav-link " href="./ecommerce-orders.html">Orders</a>
                                                <a class="nav-link " href="./ecommerce-order-details.html">Order Details</a>
                                            </div>
                                        </div>
                                        <!-- End Collapse -->

                                        <!-- Collapse -->
                                        <div class="nav-item">
                                            <a class="nav-link dropdown-toggle" href="#navbarVerticalMenuPagesEcommerceCustomersMenu" role="button" data-bs-toggle="collapse" data-bs-target="#navbarVerticalMenuPagesEcommerceCustomersMenu" aria-expanded="false" aria-controls="navbarVerticalMenuPagesEcommerceCustomersMenu">
                                                Customers
                                            </a>

                                            <div id="navbarVerticalMenuPagesEcommerceCustomersMenu" class="nav-collapse collapse " data-bs-parent="#navbarVerticalMenuPagesMenuEcommerce">
                                                <a class="nav-link " href="./ecommerce-customers.html">Customers</a>
                                                <a class="nav-link " href="./ecommerce-customer-details.html">Customer Details</a>
                                                <a class="nav-link " href="./ecommerce-add-customers.html">Add Customers</a>
                                            </div>
                                        </div>
                                        <!-- End Collapse -->
                                    </div>

                                    <a class="nav-link " href="./ecommerce-referrals.html">Referrals</a>
                                    <a class="nav-link " href="./ecommerce-manage-reviews.html">Manage Reviews</a>
                                    <a class="nav-link " href="./ecommerce-checkout.html">Checkout</a>
                                </div>
                            </div>
                            <!-- End Collapse -->

                            <!-- Collapse -->
                            <div class="nav-item">
                                <a class="nav-link dropdown-toggle " href="#navbarVerticalMenuPagesProjectsMenu" role="button" data-bs-toggle="collapse" data-bs-target="#navbarVerticalMenuPagesProjectsMenu" aria-expanded="false" aria-controls="navbarVerticalMenuPagesProjectsMenu">
                                    <i class="bi-stickies nav-icon"></i>
                                    <span class="nav-link-title">Projects</span>
                                </a>

                                <div id="navbarVerticalMenuPagesProjectsMenu" class="nav-collapse collapse " data-bs-parent="#navbarVerticalMenuPagesMenu">
                                    <a class="nav-link " href="./projects.html">Overview</a>
                                    <a class="nav-link " href="./projects-timeline.html">Timeline</a>
                                </div>
                            </div>
                            <!-- End Collapse -->

                            <!-- Collapse -->
                            <div class="nav-item">
                                <a class="nav-link dropdown-toggle " href="#navbarVerticalMenuPagesProjectMenu" role="button" data-bs-toggle="collapse" data-bs-target="#navbarVerticalMenuPagesProjectMenu" aria-expanded="false" aria-controls="navbarVerticalMenuPagesProjectMenu">
                                    <i class="bi-briefcase nav-icon"></i>
                                    <span class="nav-link-title">Project</span>
                                </a>

                                <div id="navbarVerticalMenuPagesProjectMenu" class="nav-collapse collapse " data-bs-parent="#navbarVerticalMenuPagesMenu">
                                    <a class="nav-link " href="./project.html">Overview</a>
                                    <a class="nav-link " href="./project-files.html">Files</a>
                                    <a class="nav-link " href="./project-activity.html">Activity</a>
                                    <a class="nav-link " href="./project-teams.html">Teams</a>
                                    <a class="nav-link " href="./project-settings.html">Settings</a>
                                </div>
                            </div>
                            <!-- End Collapse -->

                            <!-- Collapse -->
                            <div class="nav-item">
                                <a class="nav-link dropdown-toggle  collapsed" href="#" role="button" data-bs-toggle="collapse" data-bs-target="#navbarVerticalMenuAuthentication" aria-expanded="false" aria-controls="navbarVerticalMenuAuthentication">
                                    <i class="bi-shield-lock nav-icon"></i>
                                    <span class="nav-link-title">Authentication</span>
                                </a>

                                <div id="navbarVerticalMenuAuthentication" class="nav-collapse collapse " data-bs-parent="#navbarVerticalMenu">
                                    <div id="navbarVerticalMenuAuthenticationMenu">
                                        <!-- Collapse -->
                                        <div class="nav-item">
                                            <a class="nav-link dropdown-toggle " href="#navbarVerticalMenuAuthenticationLoginMenu" role="button" data-bs-toggle="collapse" data-bs-target="#navbarVerticalMenuAuthenticationLoginMenu" aria-expanded="false" aria-controls="navbarVerticalMenuAuthenticationLoginMenu">
                                                Log In
                                            </a>

                                            <div id="navbarVerticalMenuAuthenticationLoginMenu" class="nav-collapse collapse " data-bs-parent="#navbarVerticalMenuAuthenticationMenu">
                                                <a class="nav-link " href="./authentication-login-basic.html">Basic</a>
                                                <a class="nav-link " href="./authentication-login-cover.html">Cover</a>
                                            </div>
                                        </div>
                                        <!-- End Collapse -->

                                        <!-- Collapse -->
                                        <div class="nav-item">
                                            <a class="nav-link dropdown-toggle " href="#navbarVerticalMenuAuthenticationSignupMenu" role="button" data-bs-toggle="collapse" data-bs-target="#navbarVerticalMenuAuthenticationSignupMenu" aria-expanded="false" aria-controls="navbarVerticalMenuAuthenticationSignupMenu">
                                                Sign Up
                                            </a>

                                            <div id="navbarVerticalMenuAuthenticationSignupMenu" class="nav-collapse collapse " data-bs-parent="#navbarVerticalMenuAuthenticationMenu">
                                                <a class="nav-link " href="./authentication-signup-basic.html">Basic</a>
                                                <a class="nav-link " href="./authentication-signup-cover.html">Cover</a>
                                            </div>
                                        </div>
                                        <!-- End Collapse -->

                                        <!-- Collapse -->
                                        <div class="nav-item">
                                            <a class="nav-link dropdown-toggle " href="#navbarVerticalMenuAuthenticationResetPasswordMenu" role="button" data-bs-toggle="collapse" data-bs-target="#navbarVerticalMenuAuthenticationResetPasswordMenu" aria-expanded="false" aria-controls="navbarVerticalMenuAuthenticationResetPasswordMenu">
                                                Reset Password
                                            </a>

                                            <div id="navbarVerticalMenuAuthenticationResetPasswordMenu" class="nav-collapse collapse " data-bs-parent="#navbarVerticalMenuAuthenticationMenu">
                                                <a class="nav-link " href="./authentication-reset-password-basic.html">Basic</a>
                                                <a class="nav-link " href="./authentication-reset-password-cover.html">Cover</a>
                                            </div>
                                        </div>
                                        <!-- End Collapse -->

                                        <!-- Collapse -->
                                        <div class="nav-item">
                                            <a class="nav-link dropdown-toggle " href="#navbarVerticalMenuAuthenticationEmailVerificationMenu" role="button" data-bs-toggle="collapse" data-bs-target="#navbarVerticalMenuAuthenticationEmailVerificationMenu" aria-expanded="false" aria-controls="navbarVerticalMenuAuthenticationEmailVerificationMenu">
                                                Email Verification
                                            </a>

                                            <div id="navbarVerticalMenuAuthenticationEmailVerificationMenu" class="nav-collapse collapse " data-bs-parent="#navbarVerticalMenuAuthenticationMenu">
                                                <a class="nav-link " href="./authentication-email-verification-basic.html">Basic</a>
                                                <a class="nav-link " href="./authentication-email-verification-cover.html">Cover</a>
                                            </div>
                                        </div>
                                        <!-- End Collapse -->

                                        <!-- Collapse -->
                                        <div class="nav-item">
                                            <a class="nav-link dropdown-toggle " href="#navbarVerticalMenuAuthentication2StepVerificationMenu" role="button" data-bs-toggle="collapse" data-bs-target="#navbarVerticalMenuAuthentication2StepVerificationMenu" aria-expanded="false" aria-controls="navbarVerticalMenuAuthentication2StepVerificationMenu">
                                                2-step Verification
                                            </a>

                                            <div id="navbarVerticalMenuAuthentication2StepVerificationMenu" class="nav-collapse collapse " data-bs-parent="#navbarVerticalMenuAuthenticationMenu">
                                                <a class="nav-link " href="./authentication-2-step-verification-basic.html">Basic</a>
                                                <a class="nav-link " href="./authentication-2-step-verification-cover.html">Cover</a>
                                            </div>
                                        </div>
                                        <!-- End Collapse -->

                                        <a class="nav-link" href="javascript:;" data-bs-toggle="modal" data-bs-target="#welcomeMessageModal">Welcome Message</a>
                                        <a class="nav-link " href="./error-404.html">Error 404</a>
                                        <a class="nav-link " href="./error-500.html">Error 500</a>
                                    </div>
                                </div>
                            </div>
                            <!-- End Collapse -->

                            <div class="nav-item">
                                <a class="nav-link " href="./api-keys.html" data-placement="left">
                                    <i class="bi-key nav-icon"></i>
                                    <span class="nav-link-title">API Keys</span>
                                </a>
                            </div>

                            <div class="nav-item">
                                <a class="nav-link " href="./welcome-page.html" data-placement="left">
                                    <i class="bi-eye nav-icon"></i>
                                    <span class="nav-link-title">Welcome Page</span>
                                </a>
                            </div>

                            <div class="nav-item">
                                <a class="nav-link " href="./landing.html" data-placement="left">
                                    <i class="bi-box-seam nav-icon"></i>
                                    <span class="nav-link-title">Landing Page <span class="badge bg-info rounded-pill ms-1">New</span></span>
                                </a>
                            </div>
                        </div>
                        <!-- End Collapse -->

                        <span class="dropdown-header mt-4">Apps</span>
                        <small class="bi-three-dots nav-subtitle-replacer"></small>

                        <div class="nav-item">
                            <a class="nav-link " href="./apps-kanban.html" data-placement="left">
                                <i class="bi-kanban nav-icon"></i>
                                <span class="nav-link-title">Kanban</span>
                            </a>
                        </div>

                        <div class="nav-item">
                            <a class="nav-link " href="./apps-calendar.html" data-placement="left">
                                <i class="bi-calendar-week nav-icon"></i>
                                <span class="nav-link-title">Calendar</span>
                            </a>
                        </div>

                        <div class="nav-item">
                            <a class="nav-link " href="./apps-invoice-generator.html" data-placement="left">
                                <i class="bi-receipt nav-icon"></i>
                                <span class="nav-link-title">Invoice Generator</span>
                            </a>
                        </div>

                        <div class="nav-item">
                            <a class="nav-link " href="./apps-file-manager.html" data-placement="left">
                                <i class="bi-folder2-open nav-icon"></i>
                                <span class="nav-link-title">File Manager</span>
                            </a>
                        </div>

                        <span class="dropdown-header mt-4">Layouts</span>
                        <small class="bi-three-dots nav-subtitle-replacer"></small>

                        <div class="nav-item">
                            <a class="nav-link " href="./layouts/index.html" data-placement="left">
                                <i class="bi-grid-1x2 nav-icon"></i>
                                <span class="nav-link-title">Layouts</span>
                            </a>
                        </div>

                        <span class="dropdown-header mt-4">Documentation</span>
                        <small class="bi-three-dots nav-subtitle-replacer"></small>

                        <div class="nav-item">
                            <a class="nav-link " href="./documentation/index.html" data-placement="left">
                                <i class="bi-book nav-icon"></i>
                                <span class="nav-link-title">Documentation <span class="badge bg-primary rounded-pill ms-1">v2.1.1</span></span>
                            </a>
                        </div>

                        <div class="nav-item">
                            <a class="nav-link " href="./documentation/typography.html" data-placement="left">
                                <i class="bi-layers nav-icon"></i>
                                <span class="nav-link-title">Components</span>
                            </a>
                        </div>
                    </div>

                </div>
                <!-- End Content -->

                <!-- Footer -->
                <div class="navbar-vertical-footer">
                    <ul class="navbar-vertical-footer-list">
                        <li class="navbar-vertical-footer-list-item">
                            <!-- Style Switcher -->
                            <div class="dropdown dropup">
                                <button type="button" class="btn btn-ghost-secondary btn-icon rounded-circle" id="selectThemeDropdown" data-bs-toggle="dropdown" aria-expanded="false" data-bs-dropdown-animation>

                                </button>

                                <div class="dropdown-menu navbar-dropdown-menu navbar-dropdown-menu-borderless" aria-labelledby="selectThemeDropdown">
                                    <a class="dropdown-item" href="#" data-icon="bi-moon-stars" data-value="auto">
                                        <i class="bi-moon-stars me-2"></i>
                                        <span class="text-truncate" title="Auto (system default)">Auto (system default)</span>
                                    </a>
                                    <a class="dropdown-item" href="#" data-icon="bi-brightness-high" data-value="default">
                                        <i class="bi-brightness-high me-2"></i>
                                        <span class="text-truncate" title="Default (light mode)">Default (light mode)</span>
                                    </a>
                                    <a class="dropdown-item active" href="#" data-icon="bi-moon" data-value="dark">
                                        <i class="bi-moon me-2"></i>
                                        <span class="text-truncate" title="Dark">Dark</span>
                                    </a>
                                </div>
                            </div>

                            <!-- End Style Switcher -->
                        </li>

                        <li class="navbar-vertical-footer-list-item">
                            <!-- Other Links -->
                            <div class="dropdown dropup">
                                <button type="button" class="btn btn-ghost-secondary btn-icon rounded-circle" id="otherLinksDropdown" data-bs-toggle="dropdown" aria-expanded="false" data-bs-dropdown-animation>
                                    <i class="bi-info-circle"></i>
                                </button>

                                <div class="dropdown-menu navbar-dropdown-menu-borderless" aria-labelledby="otherLinksDropdown">
                                    <span class="dropdown-header">Help</span>
                                    <a class="dropdown-item" href="#">
                                        <i class="bi-journals dropdown-item-icon"></i>
                                        <span class="text-truncate" title="Resources &amp; tutorials">Resources &amp; tutorials</span>
                                    </a>
                                    <a class="dropdown-item" href="#">
                                        <i class="bi-command dropdown-item-icon"></i>
                                        <span class="text-truncate" title="Keyboard shortcuts">Keyboard shortcuts</span>
                                    </a>
                                    <a class="dropdown-item" href="#">
                                        <i class="bi-alt dropdown-item-icon"></i>
                                        <span class="text-truncate" title="Connect other apps">Connect other apps</span>
                                    </a>
                                    <a class="dropdown-item" href="#">
                                        <i class="bi-gift dropdown-item-icon"></i>
                                        <span class="text-truncate" title="What's new?">What's new?</span>
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <span class="dropdown-header">Contacts</span>
                                    <a class="dropdown-item" href="#">
                                        <i class="bi-chat-left-dots dropdown-item-icon"></i>
                                        <span class="text-truncate" title="Contact support">Contact support</span>
                                    </a>
                                </div>
                            </div>
                            <!-- End Other Links -->
                        </li>

                        <li class="navbar-vertical-footer-list-item">
                            <!-- Language -->
                            <div class="dropdown dropup">
                                <button type="button" class="btn btn-ghost-secondary btn-icon rounded-circle" id="selectLanguageDropdown" data-bs-toggle="dropdown" aria-expanded="false" data-bs-dropdown-animation>
                                    <img class="avatar avatar-xss avatar-circle" src="./assets/vendor/flag-icon-css/flags/1x1/us.svg" alt="United States Flag">
                                </button>

                                <div class="dropdown-menu navbar-dropdown-menu-borderless" aria-labelledby="selectLanguageDropdown">
                                    <span class="dropdown-header">Select language</span>
                                    <a class="dropdown-item" href="#">
                                        <img class="avatar avatar-xss avatar-circle me-2" src="./assets/vendor/flag-icon-css/flags/1x1/us.svg" alt="Flag">
                                        <span class="text-truncate" title="English">English (US)</span>
                                    </a>
                                    <a class="dropdown-item" href="#">
                                        <img class="avatar avatar-xss avatar-circle me-2" src="./assets/vendor/flag-icon-css/flags/1x1/gb.svg" alt="Flag">
                                        <span class="text-truncate" title="English">English (UK)</span>
                                    </a>
                                    <a class="dropdown-item" href="#">
                                        <img class="avatar avatar-xss avatar-circle me-2" src="./assets/vendor/flag-icon-css/flags/1x1/de.svg" alt="Flag">
                                        <span class="text-truncate" title="Deutsch">Deutsch</span>
                                    </a>
                                    <a class="dropdown-item" href="#">
                                        <img class="avatar avatar-xss avatar-circle me-2" src="./assets/vendor/flag-icon-css/flags/1x1/dk.svg" alt="Flag">
                                        <span class="text-truncate" title="Dansk">Dansk</span>
                                    </a>
                                    <a class="dropdown-item" href="#">
                                        <img class="avatar avatar-xss avatar-circle me-2" src="./assets/vendor/flag-icon-css/flags/1x1/it.svg" alt="Flag">
                                        <span class="text-truncate" title="Italiano">Italiano</span>
                                    </a>
                                    <a class="dropdown-item" href="#">
                                        <img class="avatar avatar-xss avatar-circle me-2" src="./assets/vendor/flag-icon-css/flags/1x1/cn.svg" alt="Flag">
                                        <span class="text-truncate" title="中文 (繁體)">中文 (繁體)</span>
                                    </a>
                                </div>
                            </div>

                            <!-- End Language -->
                        </li>
                    </ul>
                </div>
                <!-- End Footer -->
            </div>
        </div>
    </aside>

    <main id="content" role="main" class="main">
    <!-- Content -->
    <div class="content container-fluid">
        <div class="row justify-content-lg-center">
            <div class="col-lg-10">
                <!-- Profile Cover -->
                <div class="profile-cover">
                    <div class="profile-cover-img-wrapper">
                        <img class="profile-cover-img" src="{{ asset('front/img/1920x400/img1.jpg')}}" alt="Image Description">
                    </div>
                </div>

                <!-- Profile Header -->
                <div class="text-center mb-5">
                    <!-- Avatar -->
                    <div class="avatar avatar-xxl avatar-circle profile-cover-avatar">
                        <img class="avatar-img" src="{{ asset('front/img/160x160/img1.jpg')}}" alt="Image Description">
                        <span class="avatar-status avatar-status-success"></span>
                    </div>
                    <!-- End Avatar -->

                    <h1 class="page-header-title">{{ $user->first_name }} {{ $user->last_name }}
                        <i class="bi-patch-check-fill fs-2 text-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Top endorsed"></i>
                        @foreach($user->usersroles as $userRole)
                            @if($userRole->role->name === 'Developer')
                                <span class="badge bg-soft-danger text-danger">Разработчик</span>
                            @else
                            @endif
                        @endforeach
                    </h1>

                    <!-- List -->
                    <ul class="list-inline list-px-2">
                        <li class="list-inline-item">
                            <i class="bi-building me-1"></i>
                            <span>Htmlstream</span>
                        </li>

                        <li class="list-inline-item">
                            <i class="bi-geo-alt me-1"></i>
                            <a>{{ $user->city }}</a>

                        </li>

                        <li class="list-inline-item">
                            <i class="bi-calendar-week me-1"></i>
                            <span>Joined March 2017</span>
                        </li>
                    </ul>
                    <!-- End List -->
                </div>

                <!-- Nav -->
                <div class="js-nav-scroller hs-nav-scroller-horizontal mb-5">
                    <span class="hs-nav-scroller-arrow-prev" style="display: none;">
                      <a class="hs-nav-scroller-arrow-link" href="javascript:;">
                        <i class="bi-chevron-left"></i>
                      </a>
                    </span>
                    <span class="hs-nav-scroller-arrow-next" style="display: none;">
                      <a class="hs-nav-scroller-arrow-link" href="javascript:;">
                        <i class="bi-chevron-right"></i>
                      </a>
                    </span>
                    <ul class="nav nav-tabs align-items-center">
                        <li class="nav-item">
                            <a class="nav-link active"
                               id="nav-one-eg1-tab" href="#nav-one-eg1" data-bs-toggle="pill"
                               data-bs-target="#nav-one-eg1" role="tab" aria-controls="nav-one-eg1"
                               aria-selected="true">Профиль</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link"
                               id="nav-two-eg1-tab" href="#nav-two-eg1" data-bs-toggle="pill"
                               data-bs-target="#nav-two-eg1" role="tab" aria-controls="nav-two-eg1"
                               aria-selected="false" tabindex="-1">Права</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link"
                               id="nav-three-eg1-tab" href="#nav-three-eg1" data-bs-toggle="pill"
                               data-bs-target="#nav-three-eg1" role="tab" aria-controls="nav-three-eg1"
                               aria-selected="false" tabindex="-1">Tab two</a>
                        </li>

                        <li class="nav-item ms-auto">
                            <div class="d-flex gap-2">
                                <!-- Form Check -->
                                <div class="form-check form-check-switch">
                                    <input class="form-check-input" type="checkbox" value="" id="connectCheckbox">
                                    <label class="form-check-label btn btn-sm" for="connectCheckbox">
                      <span class="form-check-default">
                        <i class="bi-person-plus-fill"></i> Connect
                      </span>
                                        <span class="form-check-active">
                        <i class="bi-check-lg me-2"></i> Connected
                      </span>
                                    </label>
                                </div>
                                <!-- End Form Check -->

                                <a class="btn btn-icon btn-sm btn-white" href="#">
                                    <i class="bi-list-ul me-1"></i>
                                </a>

                                <!-- Dropdown -->
                                <div class="dropdown nav-scroller-dropdown">
                                    <button type="button" class="btn btn-white btn-icon btn-sm" id="profileDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="bi-three-dots-vertical"></i>
                                    </button>

                                    <div class="dropdown-menu dropdown-menu-end mt-1" aria-labelledby="profileDropdown">
                                        <span class="dropdown-header">Settings</span>

                                        <a class="dropdown-item" href="#">
                                            <i class="bi-share-fill dropdown-item-icon"></i> Share profile
                                        </a>
                                        <a class="dropdown-item" href="#">
                                            <i class="bi-slash-circle dropdown-item-icon"></i> Block page and profile
                                        </a>
                                        <a class="dropdown-item" href="#">
                                            <i class="bi-info-circle dropdown-item-icon"></i> Suggest edits
                                        </a>

                                        <div class="dropdown-divider"></div>

                                        <span class="dropdown-header">Feedback</span>

                                        <a class="dropdown-item" href="#">
                                            <i class="bi-flag dropdown-item-icon"></i> Report
                                        </a>
                                    </div>
                                </div>
                                <!-- End Dropdown -->
                            </div>
                        </li>
                    </ul>
                </div>


                <!-- Tab Content -->
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="nav-one-eg1" role="tabpanel" aria-labelledby="nav-one-eg1-tab">
                        <div class="row">
                            <div class="col-lg-4">

                                <!-- Sticky Block Start Point -->
                                <div id="accountSidebarNav"></div>

                                <!-- Card -->
                                <div class="js-sticky-block card mb-3 mb-lg-5" data-hs-sticky-block-options='{
                     "parentSelector": "#accountSidebarNav",
                     "breakpoint": "lg",
                     "startPoint": "#accountSidebarNav",
                     "endPoint": "#stickyBlockEndPoint",
                     "stickyOffsetTop": 20
                   }'>
                                    <!-- Header -->
                                    <div class="card-header">
                                        <h4 class="card-header-title">Профиль</h4>
                                    </div>
                                    <!-- End Header -->

                                    <!-- Body -->
                                    <div class="card-body">
                                        <ul class="list-unstyled list-py-2 text-dark mb-0">
                                            <li class="pb-0"><span class="card-subtitle">Информация</span></li>
                                            <li><i class="bi-person dropdown-item-icon"></i> {{ $user->first_name }} {{ $user->last_name }}</li>
                                            <li><i class="bi-briefcase dropdown-item-icon"></i> {{ $user->congregation->name }}</li>


                                            <li class="pt-4 pb-0"><span class="card-subtitle">Контакты</span></li>
                                            <li><i class="bi-at dropdown-item-icon"></i> {{ $user->email }}</li>
                                            <li><i class="bi-phone dropdown-item-icon"></i> {{ $user->mobile_phone }}</li>

                                            {{--                                    <li class="pt-4 pb-0"><span class="card-subtitle">Teams</span></li>--}}
                                            {{--                                    <li><i class="bi-people dropdown-item-icon"></i> Member of 7 teams</li>--}}
                                            {{--                                    <li><i class="bi-stickies dropdown-item-icon"></i> Working on 8 projects</li>--}}
                                        </ul>
                                    </div>
                                    <!-- End Body -->
                                </div>
                                <!-- End Card -->
                            </div>

                            <div class="col-lg-8">
                                <div class="d-grid gap-3 gap-lg-5">
                                    <!-- Card -->
                                    <div class="card">
                                        <!-- Header -->
                                        <div class="card-header card-header-content-between">
                                            <h4 class="card-header-title">Активность пользователя</h4>

                                            <!-- Dropdown -->
                                            <div class="dropdown">
                                                <button type="button" class="btn btn-ghost-secondary btn-icon btn-sm rounded-circle"
                                                        id="contentActivityStreamDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="bi-three-dots-vertical"></i>
                                                </button>

                                                <div class="dropdown-menu dropdown-menu-end mt-1" aria-labelledby="contentActivityStreamDropdown">
                                                    <span class="dropdown-header">Settings</span>

                                                    <a class="dropdown-item" href="#">
                                                        <i class="bi-share-fill dropdown-item-icon"></i> Share connections
                                                    </a>
                                                    <a class="dropdown-item" href="#">
                                                        <i class="bi-info-circle dropdown-item-icon"></i> Suggest edits
                                                    </a>

                                                    <div class="dropdown-divider"></div>

                                                    <span class="dropdown-header">Feedback</span>

                                                    <a class="dropdown-item" href="#">
                                                        <i class="bi-chat-left-dots dropdown-item-icon"></i> Report
                                                    </a>
                                                </div>
                                            </div>
                                            <!-- End Dropdown -->
                                        </div>
                                        <!-- End Header -->

                                        <!-- Body -->
                                        <div class="card-body card-body-height" style="height: 30rem;">
                                            <!-- Step -->
                                            <ul class="step step-icon-xs mb-0">

                                                <!-- Step Item -->
                                                <li class="step-item">
                                                    <div class="step-content-wrapper">
                                                        <span class="step-icon step-icon-pseudo step-icon-soft-dark"></span>

                                                        <div class="step-content">
                                                            <h5 class="step-title">
                                                                <a class="text-dark" href="#">Project status updated</a>
                                                            </h5>

                                                            <p class="fs-5 mb-1">Marked
                                                                <a class="text-uppercase" href="#">
                                                                    <i class="bi-journal-bookmark-fill"></i> Fr-6</a>
                                                                as <span class="badge bg-soft-success text-success rounded-pill">
                                                            <span class="legend-indicator bg-success"></span>"Completed"</span>
                                                            </p>

                                                            <span class="text-muted small text-uppercase">Today</span>
                                                        </div>
                                                    </div>
                                                </li>
                                                <!-- End Step Item -->


                                                <!-- Step Item -->
                                                <li class="step-item">
                                                    <div class="step-content-wrapper">
                                                        <span class="step-icon step-icon-pseudo step-icon-soft-dark"></span>

                                                        <div class="step-content">
                                                            <h5 class="step-title">
                                                                <a class="text-dark" href="#">Dean added a new team member</a>
                                                            </h5>

                                                            <p class="fs-5 mb-1">Added a new member to Front Dashboard</p>

                                                            <span class="text-muted small text-uppercase">May 15</span>
                                                        </div>
                                                    </div>
                                                </li>
                                                <!-- End Step Item -->

                                                <!-- Step Item -->
                                                <li class="step-item">
                                                    <div class="step-content-wrapper">
                                                        <span class="step-icon step-icon-pseudo step-icon-soft-dark"></span>

                                                        <div class="step-content">
                                                            <h5 class="step-title">
                                                                <a class="text-dark" href="#">Project status updated</a>
                                                            </h5>

                                                            <p class="fs-5 mb-1">Marked <a class="text-uppercase" href="#"><i class="bi-journal-bookmark-fill"></i> Fr-3</a> as <span class="badge bg-soft-primary text-primary rounded-pill"><span class="legend-indicator bg-primary"></span>"In progress"</span></p>

                                                            <span class="text-muted small text-uppercase">Apr 29</span>
                                                        </div>
                                                    </div>
                                                </li>
                                                <!-- End Step Item -->

                                                <!-- Step Item -->
                                                <li class="step-item">
                                                    <div class="step-content-wrapper">
                                                        <span class="step-icon step-icon-pseudo step-icon-soft-dark"></span>

                                                        <div class="step-content">
                                                            <h5 class="step-title">
                                                                <a class="text-dark" href="#">Achievements</a>
                                                            </h5>

                                                            <p class="fs-5 mb-1">Earned a "Top endorsed" <i class="tio-verified text-primary"></i> badge</p>

                                                            <span class="text-muted small text-uppercase">Apr 06</span>
                                                        </div>
                                                    </div>
                                                </li>
                                                <!-- End Step Item -->

                                                <!-- Step Item -->
                                                <li id="collapseActivitySection" class="step-item collapse">
                                                    <div class="step-content-wrapper">
                                                        <span class="step-icon step-icon-pseudo step-icon-soft-dark"></span>

                                                        <div class="step-content">
                                                            <h5 class="step-title">
                                                                <a class="text-dark" href="#">Project status updated</a>
                                                            </h5>

                                                            <p class="fs-5 mb-1">Updated <a class="text-uppercase" href="#"><i class="bi-journal-bookmark-fill"></i> Fr-3</a> as <span class="badge bg-soft-secondary text-secondary rounded-pill"><span class="legend-indicator bg-secondary"></span>"To do"</span></p>

                                                            <span class="text-muted small text-uppercase">Feb 10</span>
                                                        </div>
                                                    </div>
                                                </li>
                                                <!-- End Step Item -->
                                            </ul>
                                            <!-- End Step -->
                                        </div>
                                        <!-- End Body -->

                                        <!-- Footer -->
                                        <div class="card-footer">
                                            <a class="link link-collapse" data-bs-toggle="collapse" href="#collapseActivitySection" role="button" aria-expanded="false" aria-controls="collapseActivitySection">
                                                <span class="link-collapse-default">View more</span>
                                                <span class="link-collapse-active">View less</span>
                                            </a>
                                        </div>
                                        <!-- End Footer -->
                                    </div>
                                    <!-- End Card -->

                                    <div class="row">
                                        <div class="col-sm-6 mb-3 mb-sm-0">
                                            <!-- Card -->
                                            <div class="card h-100">
                                                <!-- Header -->
                                                <div class="card-header">
                                                    <h4 class="card-header-title">Connections</h4>
                                                </div>
                                                <!-- End Header -->

                                                <!-- Body -->
                                                <div class="card-body">
                                                    <ul class="list-unstyled list-py-3 mb-0">
                                                        <!-- Item -->
                                                        <li>
                                                            <div class="d-flex align-items-center">
                                                                <a class="d-flex align-items-center me-2" href="#">
                                                                    <div class="flex-shrink-0">
                                                                        <div class="avatar avatar-sm avatar-soft-primary avatar-circle">
                                                                            <span class="avatar-initials">R</span>
                                                                            <span class="avatar-status avatar-sm-status avatar-status-warning"></span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="flex-grow-1 ms-3">
                                                                        <h5 class="text-hover-primary mb-0">Rachel Doe</h5>
                                                                        <span class="fs-6 text-body">25 connections</span>
                                                                    </div>
                                                                </a>
                                                                <div class="ms-auto">
                                                                    <!-- Form Check -->
                                                                    <div class="form-check form-check-switch">
                                                                        <input class="form-check-input" type="checkbox" value="" id="connectionsCheckbox1" checked>
                                                                        <label class="form-check-label btn-icon btn-xs rounded-circle" for="connectionsCheckbox1">
                                    <span class="form-check-default">
                                      <i class="bi-person-plus-fill"></i>
                                    </span>
                                                                            <span class="form-check-active">
                                      <i class="bi-check-lg"></i>
                                    </span>
                                                                        </label>
                                                                    </div>
                                                                    <!-- End Form Check -->
                                                                </div>
                                                            </div>
                                                        </li>
                                                        <!-- End Item -->

                                                        <!-- Item -->
                                                        <li>
                                                            <div class="d-flex align-items-center">
                                                                <a class="d-flex align-items-center me-2" href="#">
                                                                    <div class="flex-shrink-0">
                                                                        <div class="avatar avatar-sm avatar-circle">
                                                                            <img class="avatar-img" src="./assets/img/160x160/img8.jpg" alt="Image Description">
                                                                            <span class="avatar-status avatar-sm-status avatar-status-success"></span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="flex-grow-1 ms-3">
                                                                        <h5 class="text-hover-primary mb-0">Isabella Finley</h5>
                                                                        <span class="fs-6 text-body">79 connections</span>
                                                                    </div>
                                                                </a>
                                                                <div class="ms-auto">
                                                                    <!-- Form Check -->
                                                                    <div class="form-check form-check-switch">
                                                                        <input class="form-check-input" type="checkbox" value="" id="connectionsCheckbox2">
                                                                        <label class="form-check-label btn-icon btn-xs rounded-circle" for="connectionsCheckbox2">
                                    <span class="form-check-default">
                                      <i class="bi-person-plus-fill"></i>
                                    </span>
                                                                            <span class="form-check-active">
                                      <i class="bi-check-lg"></i>
                                    </span>
                                                                        </label>
                                                                    </div>
                                                                    <!-- End Form Check -->
                                                                </div>
                                                            </div>
                                                        </li>
                                                        <!-- End Item -->

                                                        <!-- Item -->
                                                        <li>
                                                            <div class="d-flex align-items-center">
                                                                <a class="d-flex align-items-center me-2" href="#">
                                                                    <div class="flex-shrink-0">
                                                                        <div class="avatar avatar-sm avatar-circle">
                                                                            <img class="avatar-img" src="./assets/img/160x160/img3.jpg" alt="Image Description">
                                                                            <span class="avatar-status avatar-sm-status avatar-status-warning"></span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="flex-grow-1 ms-3">
                                                                        <h5 class="text-hover-primary mb-0">David Harrison</h5>
                                                                        <span class="fs-6 text-body">0 connections</span>
                                                                    </div>
                                                                </a>
                                                                <div class="ms-auto">
                                                                    <!-- Form Check -->
                                                                    <div class="form-check form-check-switch">
                                                                        <input class="form-check-input" type="checkbox" value="" id="connectionsCheckbox3" checked>
                                                                        <label class="form-check-label btn-icon btn-xs rounded-circle" for="connectionsCheckbox3">
                                    <span class="form-check-default">
                                      <i class="bi-person-plus-fill"></i>
                                    </span>
                                                                            <span class="form-check-active">
                                      <i class="bi-check-lg"></i>
                                    </span>
                                                                        </label>
                                                                    </div>
                                                                    <!-- End Form Check -->
                                                                </div>
                                                            </div>
                                                        </li>
                                                        <!-- End Item -->

                                                        <!-- Item -->
                                                        <li>
                                                            <div class="d-flex align-items-center">
                                                                <a class="d-flex align-items-center me-2" href="#">
                                                                    <div class="flex-shrink-0">
                                                                        <div class="avatar avatar-sm avatar-circle">
                                                                            <img class="avatar-img" src="./assets/img/160x160/img6.jpg" alt="Image Description">
                                                                            <span class="avatar-status avatar-sm-status avatar-status-danger"></span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="flex-grow-1 ms-3">
                                                                        <h5 class="text-hover-primary mb-0">Costa Quinn</h5>
                                                                        <span class="fs-6 text-body">9 connections</span>
                                                                    </div>
                                                                </a>
                                                                <div class="ms-auto">
                                                                    <!-- Form Check -->
                                                                    <div class="form-check form-check-switch">
                                                                        <input class="form-check-input" type="checkbox" value="" id="connectionsCheckbox4">
                                                                        <label class="form-check-label btn-icon btn-xs rounded-circle" for="connectionsCheckbox4">
                                    <span class="form-check-default">
                                      <i class="bi-person-plus-fill"></i>
                                    </span>
                                                                            <span class="form-check-active">
                                      <i class="bi-check-lg"></i>
                                    </span>
                                                                        </label>
                                                                    </div>
                                                                    <!-- End Form Check -->
                                                                </div>
                                                            </div>
                                                        </li>
                                                        <!-- End Item -->
                                                    </ul>
                                                </div>
                                                <!-- End Body -->

                                                <!-- Footer -->
                                                <a class="card-footer text-center" href="user-profile-connections.html">
                                                    View all connections <i class="bi-chevron-right"></i>
                                                </a>
                                                <!-- End Footer -->
                                            </div>
                                            <!-- End Card -->
                                        </div>

                                        <div class="col-sm-6">
                                            <!-- Card -->
                                            <div class="card h-100">
                                                <!-- Header -->
                                                <div class="card-header">
                                                    <h4 class="card-header-title">Teams</h4>
                                                </div>
                                                <!-- End Header -->

                                                <!-- Body -->
                                                <div class="card-body">
                                                    <ul class="nav nav-pills card-nav card-nav-vertical nav-pills">
                                                        <!-- Item -->
                                                        <li>
                                                            <a class="nav-link" href="#">
                                                                <div class="d-flex">
                                                                    <div class="flex-shrink-0">
                                                                        <i class="bi-people-fill nav-icon text-dark"></i>
                                                                    </div>
                                                                    <div class="flex-grow-1 ms-3">
                                                                        <span class="d-block text-dark">#digitalmarketing</span>
                                                                        <small class="d-block text-muted">8 members</small>
                                                                    </div>
                                                                </div>
                                                            </a>
                                                        </li>
                                                        <!-- End Item -->

                                                        <!-- Item -->
                                                        <li>
                                                            <a class="nav-link" href="#">
                                                                <div class="d-flex">
                                                                    <div class="flex-shrink-0">
                                                                        <i class="bi-people-fill nav-icon text-dark"></i>
                                                                    </div>
                                                                    <div class="flex-grow-1 ms-3">
                                                                        <span class="d-block text-dark">#ethereum</span>
                                                                        <small class="d-block text-muted">14 members</small>
                                                                    </div>
                                                                </div>
                                                            </a>
                                                        </li>
                                                        <!-- End Item -->

                                                        <!-- Item -->
                                                        <li>
                                                            <a class="nav-link" href="#">
                                                                <div class="d-flex">
                                                                    <div class="flex-shrink-0">
                                                                        <i class="bi-people-fill nav-icon text-dark"></i>
                                                                    </div>
                                                                    <div class="flex-grow-1 ms-3">
                                                                        <span class="d-block text-dark">#conference</span>
                                                                        <small class="d-block text-muted">3 members</small>
                                                                    </div>
                                                                </div>
                                                            </a>
                                                        </li>
                                                        <!-- End Item -->

                                                        <!-- Item -->
                                                        <li>
                                                            <a class="nav-link" href="#">
                                                                <div class="d-flex">
                                                                    <div class="flex-shrink-0">
                                                                        <i class="bi-people-fill nav-icon text-dark"></i>
                                                                    </div>
                                                                    <div class="flex-grow-1 ms-3">
                                                                        <span class="d-block text-dark">#supportteam</span>
                                                                        <small class="d-block text-muted">3 members</small>
                                                                    </div>
                                                                </div>
                                                            </a>
                                                        </li>
                                                        <!-- End Item -->

                                                        <!-- Item -->
                                                        <li>
                                                            <a class="nav-link" href="#">
                                                                <div class="d-flex">
                                                                    <div class="flex-shrink-0">
                                                                        <i class="bi-people-fill nav-icon text-dark"></i>
                                                                    </div>
                                                                    <div class="flex-grow-1 ms-3">
                                                                        <span class="d-block text-dark">#invoices</span>
                                                                        <small class="d-block text-muted">3 members</small>
                                                                    </div>
                                                                </div>
                                                            </a>
                                                        </li>
                                                        <!-- End Item -->
                                                    </ul>
                                                </div>
                                                <!-- End Body -->

                                                <!-- Footer -->
                                                <a class="card-footer text-center" href="user-profile-teams.html">
                                                    View all teams <i class="bi-chevron-right"></i>
                                                </a>
                                                <!-- End Footer -->
                                            </div>
                                            <!-- End Card -->
                                        </div>
                                    </div>
                                    <!-- End Row -->

                                    <!-- Card -->
                                    <div class="card">
                                        <!-- Header -->
                                        <div class="card-header card-header-content-between">
                                            <h4 class="card-header-title">Projects</h4>

                                            <!-- Dropdown -->
                                            <div class="dropdowm">
                                                <button type="button" class="btn btn-ghost-secondary btn-icon btn-sm rounded-circle" id="projectReportDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="bi-three-dots-vertical"></i>
                                                </button>

                                                <div class="dropdown-menu dropdown-menu-end mt-1" aria-labelledby="projectReportDropdown">
                                                    <span class="dropdown-header">Settings</span>

                                                    <a class="dropdown-item" href="#">
                                                        <i class="bi-share-fill dropdown-item-icon"></i> Share connections
                                                    </a>
                                                    <a class="dropdown-item" href="#">
                                                        <i class="bi-info-circle dropdown-item-icon"></i> Suggest edits
                                                    </a>

                                                    <div class="dropdown-divider"></div>

                                                    <span class="dropdown-header">Feedback</span>

                                                    <a class="dropdown-item" href="#">
                                                        <i class="bi-chat-left-dots dropdown-item-icon"></i> Report
                                                    </a>
                                                </div>
                                            </div>
                                            <!-- End Dropdown -->
                                        </div>
                                        <!-- End Header -->

                                        <!-- Table -->
                                        <div class="table-responsive">
                                            <table class="table table-borderless table-thead-bordered table-nowrap table-align-middle card-table">
                                                <thead class="thead-light">
                                                <tr>
                                                    <th>Project</th>
                                                    <th style="width: 40%;">Progress</th>
                                                    <th class="table-text-end">Hours spent</th>
                                                </tr>
                                                </thead>

                                                <tbody>
                                                <tr>
                                                    <td>
                                                        <div class="d-flex">
                              <span class="avatar avatar-xs avatar-soft-dark avatar-circle">
                                <span class="avatar-initials">U</span>
                              </span>
                                                            <div class="ms-3">
                                                                <h5 class="mb-0">UI/UX</h5>
                                                                <small>Updated 2 hours ago</small>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <span class="me-3">0%</span>
                                                            <div class="progress table-progress">
                                                                <div class="progress-bar" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="table-text-end">4:25</td>
                                                </tr>

                                                <tr>
                                                    <td>
                                                        <div class="d-flex">
                                                            <img class="avatar avatar-xs" src="./assets/svg/brands/spec-icon.svg" alt="Image Description">
                                                            <div class="ms-3">
                                                                <h5 class="mb-0">Get a complete audit store</h5>
                                                                <small>Updated 1 day ago</small>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <span class="me-3">45%</span>
                                                            <div class="progress table-progress">
                                                                <div class="progress-bar" role="progressbar" style="width: 45%" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100"></div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="table-text-end">18:42</td>
                                                </tr>

                                                <tr>
                                                    <td>
                                                        <div class="d-flex">
                                                            <img class="avatar avatar-xs" src="./assets/svg/brands/capsule-icon.svg" alt="Image Description">
                                                            <div class="ms-3">
                                                                <h5 class="mb-0">Build stronger customer relationships</h5>
                                                                <small>Updated 2 days ago</small>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <span class="me-3">59%</span>
                                                            <div class="progress table-progress">
                                                                <div class="progress-bar" role="progressbar" style="width: 59%" aria-valuenow="59" aria-valuemin="0" aria-valuemax="100"></div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="table-text-end">9:01</td>
                                                </tr>

                                                <tr>
                                                    <td>
                                                        <div class="d-flex">
                                                            <img class="avatar avatar-xs" src="./assets/svg/brands/mailchimp-icon.svg" alt="Image Description">
                                                            <div class="ms-3">
                                                                <h5 class="mb-0">Update subscription method</h5>
                                                                <small>Updated 2 days ago</small>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <span class="me-3">57%</span>
                                                            <div class="progress table-progress">
                                                                <div class="progress-bar bg-success" role="progressbar" style="width: 57%" aria-valuenow="57" aria-valuemin="0" aria-valuemax="100"></div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="table-text-end">0:37</td>
                                                </tr>

                                                <tr>
                                                    <td>
                                                        <div class="d-flex">
                                                            <img class="avatar avatar-xs" src="./assets/svg/brands/figma-icon.svg" alt="Image Description">
                                                            <div class="ms-3">
                                                                <h5 class="mb-0">Create a new theme</h5>
                                                                <small>Updated 1 week ago</small>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <span class="me-3">100%</span>
                                                            <div class="progress table-progress">
                                                                <div class="progress-bar bg-success" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="table-text-end">24:12</td>
                                                </tr>

                                                <tr>
                                                    <td>
                                                        <div class="d-flex">
                              <span class="avatar avatar-xs avatar-soft-info avatar-circle">
                                <span class="avatar-initials">I</span>
                              </span>
                                                            <div class="ms-3">
                                                                <h5 class="mb-0">Improve social banners</h5>
                                                                <small>Updated 1 week ago</small>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <span class="me-3">0%</span>
                                                            <div class="progress table-progress">
                                                                <div class="progress-bar" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="table-text-end">8:08</td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <!-- End Table -->

                                        <!-- Footer -->
                                        <a class="card-footer text-center" href="./projects.html">
                                            View all projects <i class="bi-chevron-right"></i>
                                        </a>
                                        <!-- End Footer -->
                                    </div>
                                    <!-- End Card -->
                                </div>

                                <!-- Sticky Block End Point -->
                                <div id="stickyBlockEndPoint"></div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="nav-two-eg1" role="tabpanel" aria-labelledby="nav-two-eg1-tab">
                        <div class="row align-items-center mb-5">
                            <div class="col">
                                <h3 class="mb-0">7 connections</h3>
                            </div>
                            <!-- End Col -->

                            <div class="col-auto">
                                <!-- Nav -->
                                <ul class="nav nav-segment" id="connectionsTab" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link" id="grid-tab" data-bs-toggle="tab" href="#grid" role="tab" aria-controls="grid" aria-selected="false" title="Column view" tabindex="-1">
                                            <i class="bi-grid"></i>
                                        </a>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link active" id="list-tab" data-bs-toggle="tab" href="#list" role="tab" aria-controls="list" aria-selected="true" title="List view">
                                            <i class="bi-list"></i>
                                        </a>
                                    </li>
                                </ul>
                                <!-- End Nav -->
                            </div>
                            <!-- End Col -->
                        </div>
                        <div class="tab-content" id="connectionsTabContent">
                            <div class="tab-pane fade" id="grid" role="tabpanel" aria-labelledby="grid-tab">
                                <!-- Connections -->
                                <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-3">
                                    @foreach($permissions as $permission)
                                    <div class="col mb-3 mb-lg-5">
                                        <!-- Card -->
                                        <div class="card h-100">
                                            <!-- Body -->
                                            <div class="card-body pb-0">
                                                <div class="row align-items-center mb-2">
                                                    <div class="col-9">
                                                        <h4 class="mb-1">
                                                            <a>{{$permission->name}}</a>
                                                        </h4>
                                                    </div>
                                                    <!-- End Col -->

                                                    <div class="col-3 text-end">
                                                        <!-- Dropdown -->
                                                        <div class="dropdowm">
                                                            <button type="button" class="btn btn-ghost-secondary btn-icon btn-sm rounded-circle" id="teamsDropdown1" data-bs-toggle="dropdown" aria-expanded="false">
                                                                <i class="bi-three-dots-vertical"></i>
                                                            </button>

                                                            <div class="dropdown-menu dropdown-menu-sm dropdown-menu-end" aria-labelledby="teamsDropdown1">
                                                                <a class="dropdown-item" href="#">Rename team</a>
                                                                <a class="dropdown-item" href="#">Add to favorites</a>
                                                                <a class="dropdown-item" href="#">Archive team</a>
                                                                <div class="dropdown-divider"></div>
                                                                <a class="dropdown-item text-danger" href="#">Delete</a>
                                                            </div>
                                                        </div>
                                                        <!-- End Dropdown -->
                                                    </div>
                                                    <!-- End Col -->
                                                </div>
                                                <!-- End Row -->

                                                <p>Our group promotes and sells products and services by leveraging online marketing tactics</p>
                                            </div>
                                            <!-- End Body -->

                                            <!-- Footer -->
                                            <div class="card-footer border-0 pt-0">
                                                <div class="list-group list-group-flush list-group-no-gutters">
                                                    <!-- List Item -->
                                                    <div class="list-group-item">
                                                        <div class="row align-items-center">
                                                            <div class="col">
                                                                <span class="card-subtitle">Industry:</span>
                                                            </div>
                                                            <!-- End Col -->

                                                            <div class="col-auto">
                                                                <a class="badge bg-soft-primary text-primary p-2" href="#">Marketing team</a>
                                                            </div>
                                                            <!-- End Col -->
                                                        </div>
                                                    </div>
                                                    <!-- End List Item -->

                                                </div>
                                            </div>
                                            <!-- End Footer -->
                                        </div>
                                        <!-- End Card -->
                                    </div>
                                    @endforeach
                                </div>
                                <!-- End Connections -->
                            </div>

                            <div class="tab-pane fade active show" id="list" role="tabpanel" aria-labelledby="list-tab">
                                <div class="row row-cols-1">
                                    @foreach($permissions as $permission)
                                    <div class="col mb-3">
                                        <!-- Card -->
                                        <div class="card card-body">
                                            <div class="d-flex align-items-md-center">
                                                <div class="flex-shrink-0">
                                                    <!-- Avatar -->
                                                    <div class="avatar avatar-lg avatar-soft-primary avatar-circle">
                                                        <span class="avatar-initials">P</span>
                                                    </div>
                                                    <!-- End Avatar -->
                                                </div>

                                                <div class="flex-grow-1 ms-3">
                                                    <div class="row align-items-md-center">
                                                        <div class="col-9 col-md-4 col-lg-3 mb-2 mb-md-0">
                                                            <h4 class="mb-1">
                                                                <a class="text-dark">{{$permission->name}}</a>
                                                            </h4>

                                                            <span class="d-block">
                              <i class="bi-building me-1"></i>
                              <span>Design</span>
                            </span>
                                                        </div>
                                                        <!-- End Col -->

                                                        <div class="col-3 col-md-auto order-md-last text-end ms-n3">
                                                            <!-- Dropdown -->
                                                            <div class="dropdown">
                                                                <button type="button" class="btn btn-ghost-secondary btn-icon btn-sm rounded-circle" id="connectionsListDropdown1" data-bs-toggle="dropdown" aria-expanded="false">
                                                                    <i class="bi-three-dots-vertical"></i>
                                                                </button>

                                                                <div class="dropdown-menu dropdown-menu-sm dropdown-menu-end" aria-labelledby="connectionsListDropdown1">
                                                                    <a class="dropdown-item" href="#">Rename project </a>
                                                                    <a class="dropdown-item" href="#">Add to favorites</a>
                                                                    <a class="dropdown-item" href="#">Archive project</a>
                                                                    <div class="dropdown-divider"></div>
                                                                    <a class="dropdown-item text-danger" href="#">Delete</a>
                                                                </div>
                                                            </div>
                                                            <!-- End Dropdown -->
                                                        </div>
                                                        <!-- End Col -->

                                                        <div class="col-sm mb-2">
                                                        </div>
                                                        <!-- End Col -->

                                                        <div class="col-sm-auto">
                                                            <!-- Form Check -->
                                                            @if(DB::table('users_permissions')
                    ->where('user_id', '=', $user->id)
                    ->where('permission_id', '=', $permission->id)
                    ->count() > 0)
                                                                <div class="col mb-3">
                                        <span class="text-success heading text-left">
                                            <i class="fa-solid fa-circle-check"></i> Доступная роль</span>
                                                                    <form method="post" action="{{ route('permissionDelete', $user->id) }}">
                                                                        @csrf
                                                                        <input type="hidden" name="delete_permission_id" value="{{ $permission->id }}">
                                                                        <button class="btn btn-danger btn-sm">Запретить</button>
                                                                    </form>
                                                                </div>
                                                            @else
                                                                <form method="post" action="{{ route('permissionAllow', $user->id) }}">
                                                                    @csrf
                                                                    <div class="col-md-6 mb-3">
                                                                        <input type="hidden" name="allow_permission_id" value="{{ $permission->id }}">
                                                                        <button class="btn btn-primary">Разрешить</button>
                                                                    </div>
                                                                </form>
                                                            @endif
                                                            <!-- End Form Check -->
                                                        </div>
                                                        <!-- End Col -->
                                                    </div>
                                                    <!-- End Row -->
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End Card -->
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="nav-three-eg1" role="tabpanel" aria-labelledby="nav-three-eg1-tab">
                        <p>Third tab content...</p>
                    </div>
                </div>
                    <!-- End Tab Content -->


            </div>
            <!-- End Col -->
        </div>
        <!-- End Row -->
    </div>
    <!-- End Content -->

    <!-- Footer -->

    <div class="footer">
        <div class="row justify-content-between align-items-center">
            <div class="col">
                <p class="fs-6 mb-0">&copy; Front. <span class="d-none d-sm-inline-block">2022 Htmlstream.</span></p>
            </div>
            <!-- End Col -->

            <div class="col-auto">
                <div class="d-flex justify-content-end">
                    <!-- List Separator -->
                    <ul class="list-inline list-separator">
                        <li class="list-inline-item">
                            <a class="list-separator-link" href="#">FAQ</a>
                        </li>

                        <li class="list-inline-item">
                            <a class="list-separator-link" href="#">License</a>
                        </li>

                        <li class="list-inline-item">
                            <!-- Keyboard Shortcuts Toggle -->
                            <button class="btn btn-ghost-secondary btn btn-icon btn-ghost-secondary rounded-circle" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasKeyboardShortcuts" aria-controls="offcanvasKeyboardShortcuts">
                                <i class="bi-command"></i>
                            </button>
                            <!-- End Keyboard Shortcuts Toggle -->
                        </li>
                    </ul>
                    <!-- End List Separator -->
                </div>
            </div>
            <!-- End Col -->
        </div>
        <!-- End Row -->
    </div>

    <!-- End Footer -->
    </main>

@endsection
