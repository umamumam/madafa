<!DOCTYPE html>
<html lang="en">
<!-- [Head] start -->

<head>
    <title>Dashboard</title>

    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description"
        content="Mantis is made using Bootstrap 5 design framework. Download the free admin template & use it for your project.">
    <meta name="keywords"
        content="Mantis, Dashboard UI Kit, Bootstrap 5, Admin Template, Admin Dashboard, CRM, CMS, Bootstrap Admin Template">
    <meta name="author" content="CodedThemes">

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('mantis/assets/images/favicon.svg') }}" type="image/x-icon">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@300;400;500;600;700&display=swap"
        rel="stylesheet" id="main-font-link">

    <!-- Icon Fonts -->
    <link rel="stylesheet" href="{{ asset('mantis/assets/fonts/tabler-icons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('mantis/assets/fonts/feather.css') }}">
    <link rel="stylesheet" href="{{ asset('mantis/assets/fonts/fontawesome.css') }}">
    <link rel="stylesheet" href="{{ asset('mantis/assets/fonts/material.css') }}">

    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('mantis/assets/css/style.css') }}" id="main-style-link">
    <link rel="stylesheet" href="{{ asset('mantis/assets/css/style-preset.css') }}">
</head>
<!-- [Head] end -->
<!-- [Body] Start -->

<body data-pc-preset="preset-1" data-pc-direction="ltr" data-pc-theme="light">
    <!-- [ Pre-loader ] start -->
    <div class="loader-bg">
        <div class="loader-track">
            <div class="loader-fill"></div>
        </div>
    </div>
    <!-- [ Pre-loader ] End -->
    <!-- [ Sidebar Menu ] start -->
    <nav class="pc-sidebar">
        <div class="navbar-wrapper">
            <div class="m-header">
                <a href="../dashboard/index.html" class="b-brand text-primary">
                    <!-- ========   Change your logo from here   ============ -->
                    <img src="../assets/images/logo-dark.svg" class="img-fluid logo-lg" alt="logo">
                </a>
            </div>
            <div class="navbar-content">
                <ul class="pc-navbar">
                    <li class="pc-item">
                        <a href="../dashboard/index.html" class="pc-link">
                            <span class="pc-micon"><i class="ti ti-dashboard"></i></span>
                            <span class="pc-mtext">Dashboard</span>
                        </a>
                    </li>

                    <li class="pc-item pc-caption">
                        <label>UI Components</label>
                        <i class="ti ti-dashboard"></i>
                    </li>
                    <li class="pc-item">
                        <a href="../elements/bc_typography.html" class="pc-link">
                            <span class="pc-micon"><i class="ti ti-typography"></i></span>
                            <span class="pc-mtext">Typography</span>
                        </a>
                    </li>
                    <li class="pc-item">
                        <a href="../elements/bc_color.html" class="pc-link">
                            <span class="pc-micon"><i class="ti ti-color-swatch"></i></span>
                            <span class="pc-mtext">Color</span>
                        </a>
                    </li>
                    <li class="pc-item">
                        <a href="../elements/icon-tabler.html" class="pc-link">
                            <span class="pc-micon"><i class="ti ti-plant-2"></i></span>
                            <span class="pc-mtext">Icons</span>
                        </a>
                    </li>

                    <li class="pc-item pc-caption">
                        <label>Pages</label>
                        <i class="ti ti-news"></i>
                    </li>
                    <li class="pc-item">
                        <a href="../pages/login-v3.html" class="pc-link">
                            <span class="pc-micon"><i class="ti ti-lock"></i></span>
                            <span class="pc-mtext">Login</span>
                        </a>
                    </li>
                    <li class="pc-item">
                        <a href="../pages/register-v3.html" class="pc-link">
                            <span class="pc-micon"><i class="ti ti-user-plus"></i></span>
                            <span class="pc-mtext">Register</span>
                        </a>
                    </li>

                    <li class="pc-item pc-caption">
                        <label>Other</label>
                        <i class="ti ti-brand-chrome"></i>
                    </li>
                    <li class="pc-item pc-hasmenu">
                        <a href="#!" class="pc-link"><span class="pc-micon"><i class="ti ti-menu"></i></span><span
                                class="pc-mtext">Menu
                                levels</span><span class="pc-arrow"><i data-feather="chevron-right"></i></span></a>
                        <ul class="pc-submenu">
                            <li class="pc-item"><a class="pc-link" href="#!">Level 2.1</a></li>
                            <li class="pc-item pc-hasmenu">
                                <a href="#!" class="pc-link">Level 2.2<span class="pc-arrow"><i
                                            data-feather="chevron-right"></i></span></a>
                                <ul class="pc-submenu">
                                    <li class="pc-item"><a class="pc-link" href="#!">Level 3.1</a></li>
                                    <li class="pc-item"><a class="pc-link" href="#!">Level 3.2</a></li>
                                    <li class="pc-item pc-hasmenu">
                                        <a href="#!" class="pc-link">Level 3.3<span class="pc-arrow"><i
                                                    data-feather="chevron-right"></i></span></a>
                                        <ul class="pc-submenu">
                                            <li class="pc-item"><a class="pc-link" href="#!">Level 4.1</a></li>
                                            <li class="pc-item"><a class="pc-link" href="#!">Level 4.2</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <li class="pc-item pc-hasmenu">
                                <a href="#!" class="pc-link">Level 2.3<span class="pc-arrow"><i
                                            data-feather="chevron-right"></i></span></a>
                                <ul class="pc-submenu">
                                    <li class="pc-item"><a class="pc-link" href="#!">Level 3.1</a></li>
                                    <li class="pc-item"><a class="pc-link" href="#!">Level 3.2</a></li>
                                    <li class="pc-item pc-hasmenu">
                                        <a href="#!" class="pc-link">Level 3.3<span class="pc-arrow"><i
                                                    data-feather="chevron-right"></i></span></a>
                                        <ul class="pc-submenu">
                                            <li class="pc-item"><a class="pc-link" href="#!">Level 4.1</a></li>
                                            <li class="pc-item"><a class="pc-link" href="#!">Level 4.2</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li class="pc-item">
                        <a href="../other/sample-page.html" class="pc-link">
                            <span class="pc-micon"><i class="ti ti-brand-chrome"></i></span>
                            <span class="pc-mtext">Sample page</span>
                        </a>
                    </li>
                </ul>
                <div class="card text-center">
                    <div class="card-body">
                        <img src="../assets/images/img-navbar-card.png" alt="images" class="img-fluid mb-2">
                        <h5>Help?</h5>
                        <p>Get to resolve query</p>
                        <button class="btn btn-success">Support</button>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    <!-- [ Sidebar Menu ] end -->
    <!-- [ Header Topbar ] start -->
    <header class="pc-header">
        <div class="header-wrapper">
            <!-- [Mobile Media Block] start -->
            <div class="me-auto pc-mob-drp">
                <ul class="list-unstyled">
                    <!-- ======= Menu collapse Icon ===== -->
                    <li class="pc-h-item pc-sidebar-collapse">
                        <a href="#" class="pc-head-link ms-0" id="sidebar-hide">
                            <i class="ti ti-menu-2"></i>
                        </a>
                    </li>
                    <li class="pc-h-item pc-sidebar-popup">
                        <a href="#" class="pc-head-link ms-0" id="mobile-collapse">
                            <i class="ti ti-menu-2"></i>
                        </a>
                    </li>
                    <li class="dropdown pc-h-item d-inline-flex d-md-none">
                        <a class="pc-head-link dropdown-toggle arrow-none m-0" data-bs-toggle="dropdown" href="#"
                            role="button" aria-haspopup="false" aria-expanded="false">
                            <i class="ti ti-search"></i>
                        </a>
                        <div class="dropdown-menu pc-h-dropdown drp-search">
                            <form class="px-3">
                                <div class="form-group mb-0 d-flex align-items-center">
                                    <i data-feather="search"></i>
                                    <input type="search" class="form-control border-0 shadow-none"
                                        placeholder="Search here. . .">
                                </div>
                            </form>
                        </div>
                    </li>
                    <li class="pc-h-item d-none d-md-inline-flex">
                        <form class="header-search">
                            <i data-feather="search" class="icon-search"></i>
                            <input type="search" class="form-control" placeholder="Search here. . .">
                        </form>
                    </li>
                </ul>
            </div>
            <!-- [Mobile Media Block end] -->
            <div class="ms-auto">
                <ul class="list-unstyled">
                    <li class="dropdown pc-h-item pc-mega-menu">
                        <a class="pc-head-link dropdown-toggle arrow-none me-0" data-bs-toggle="dropdown" href="#"
                            role="button" aria-haspopup="false" aria-expanded="false">
                            <i class="ti ti-layout-grid"></i>
                        </a>
                        <div class="dropdown-menu pc-h-dropdown pc-mega-dmenu">
                            <div class="row g-0">
                                <div class="col image-block">
                                    <h2 class="text-white">Explore Components</h2>
                                    <p class="text-white my-4">Try our pre made component pages to check how it feels
                                        and suits as per your need.</p>
                                    <div class="row align-items-end">
                                        <div class="col-auto">
                                            <div class="btn btn btn-light">View All <i
                                                    class="ti ti-arrow-narrow-right"></i></div>
                                        </div>
                                        <div class="col">
                                            <img src="../assets/images/mega-menu/chart.svg" alt="image"
                                                class="img-fluid img-charts">
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <h6 class="mega-title">UI Components</h6>
                                    <ul class="pc-mega-list">
                                        <li><a href="#!" class="dropdown-item"><i class="ti ti-circle"></i> Alerts</a>
                                        </li>
                                        <li><a href="#!" class="dropdown-item"><i class="ti ti-circle"></i>
                                                Accordions</a></li>
                                        <li><a href="#!" class="dropdown-item"><i class="ti ti-circle"></i> Avatars</a>
                                        </li>
                                        <li><a href="#!" class="dropdown-item"><i class="ti ti-circle"></i> Badges</a>
                                        </li>
                                        <li><a href="#!" class="dropdown-item"><i class="ti ti-circle"></i>
                                                Breadcrumbs</a></li>
                                        <li><a href="#!" class="dropdown-item"><i class="ti ti-circle"></i> Button</a>
                                        </li>
                                        <li><a href="#!" class="dropdown-item"><i class="ti ti-circle"></i> Buttons
                                                Groups</a></li>
                                    </ul>
                                </div>
                                <div class="col">
                                    <h6 class="mega-title">UI Components</h6>
                                    <ul class="pc-mega-list">
                                        <li><a href="#!" class="dropdown-item"><i class="ti ti-circle"></i> Menus</a>
                                        </li>
                                        <li><a href="#!" class="dropdown-item"><i class="ti ti-circle"></i> Media
                                                Sliders / Carousel</a></li>
                                        <li><a href="#!" class="dropdown-item"><i class="ti ti-circle"></i> Modals</a>
                                        </li>
                                        <li><a href="#!" class="dropdown-item"><i class="ti ti-circle"></i>
                                                Pagination</a></li>
                                        <li><a href="#!" class="dropdown-item"><i class="ti ti-circle"></i> Progress
                                                Bars &amp; Graphs</a></li>
                                        <li><a href="#!" class="dropdown-item"><i class="ti ti-circle"></i> Search
                                                Bar</a></li>
                                        <li><a href="#!" class="dropdown-item"><i class="ti ti-circle"></i> Tabs</a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col">
                                    <h6 class="mega-title">Advance Components</h6>
                                    <ul class="pc-mega-list">
                                        <li><a href="#!" class="dropdown-item"><i class="ti ti-circle"></i> Advanced
                                                Stats</a></li>
                                        <li><a href="#!" class="dropdown-item"><i class="ti ti-circle"></i> Advanced
                                                Cards</a></li>
                                        <li><a href="#!" class="dropdown-item"><i class="ti ti-circle"></i> Lightbox</a>
                                        </li>
                                        <li><a href="#!" class="dropdown-item"><i class="ti ti-circle"></i>
                                                Notification</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="dropdown pc-h-item">
                        <a class="pc-head-link dropdown-toggle arrow-none me-0" data-bs-toggle="dropdown" href="#"
                            role="button" aria-haspopup="false" aria-expanded="false">
                            <i class="ti ti-language"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end pc-h-dropdown">
                            <a href="#!" class="dropdown-item">
                                <i class="ti ti-user"></i>
                                <span>My Account</span>
                            </a>
                            <a href="#!" class="dropdown-item">
                                <i class="ti ti-settings"></i>
                                <span>Settings</span>
                            </a>
                            <a href="#!" class="dropdown-item">
                                <i class="ti ti-headset"></i>
                                <span>Support</span>
                            </a>
                            <a href="#!" class="dropdown-item">
                                <i class="ti ti-lock"></i>
                                <span>Lock Screen</span>
                            </a>
                            <a href="#!" class="dropdown-item">
                                <i class="ti ti-power"></i>
                                <span>Logout</span>
                            </a>
                        </div>
                    </li>
                    <li class="dropdown pc-h-item">
                        <a class="pc-head-link dropdown-toggle arrow-none me-0" data-bs-toggle="dropdown" href="#"
                            role="button" aria-haspopup="false" aria-expanded="false">
                            <i class="ti ti-bell"></i>
                            <span class="badge bg-success pc-h-badge">3</span>
                        </a>
                        <div class="dropdown-menu dropdown-notification dropdown-menu-end pc-h-dropdown">
                            <div class="dropdown-header d-flex align-items-center justify-content-between">
                                <h5 class="m-0">Notification</h5>
                                <a href="#!" class="pc-head-link bg-transparent"><i
                                        class="ti ti-circle-check text-success"></i></a>
                            </div>
                            <div class="dropdown-divider"></div>
                            <div class="dropdown-header px-0 text-wrap header-notification-scroll position-relative"
                                style="max-height: calc(100vh - 215px)">
                                <div class="list-group list-group-flush w-100">
                                    <a class="list-group-item list-group-item-action">
                                        <div class="d-flex">
                                            <div class="flex-shrink-0">
                                                <div class="user-avtar bg-light-success"><i class="ti ti-gift"></i>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1 ms-1">
                                                <span class="float-end text-muted">3:00 AM</span>
                                                <p class="text-body mb-1">It's <b>Cristina danny's</b> birthday today.
                                                </p>
                                                <span class="text-muted">2 min ago</span>
                                            </div>
                                        </div>
                                    </a>
                                    <a class="list-group-item list-group-item-action">
                                        <div class="d-flex">
                                            <div class="flex-shrink-0">
                                                <div class="user-avtar bg-light-primary"><i
                                                        class="ti ti-message-circle"></i></div>
                                            </div>
                                            <div class="flex-grow-1 ms-1">
                                                <span class="float-end text-muted">6:00 PM</span>
                                                <p class="text-body mb-1"><b>Aida Burg</b> commented your post.</p>
                                                <span class="text-muted">5 August</span>
                                            </div>
                                        </div>
                                    </a>
                                    <a class="list-group-item list-group-item-action">
                                        <div class="d-flex">
                                            <div class="flex-shrink-0">
                                                <div class="user-avtar bg-light-danger"><i class="ti ti-settings"></i>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1 ms-1">
                                                <span class="float-end text-muted">2:45 PM</span>
                                                <p class="text-body mb-1">Your Profile is Complete &nbsp;<b>60%</b></p>
                                                <span class="text-muted">7 hours ago</span>
                                            </div>
                                        </div>
                                    </a>
                                    <a class="list-group-item list-group-item-action">
                                        <div class="d-flex">
                                            <div class="flex-shrink-0">
                                                <div class="user-avtar bg-light-primary"><i class="ti ti-headset"></i>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1 ms-1">
                                                <span class="float-end text-muted">9:10 PM</span>
                                                <p class="text-body mb-1"><b>Cristina Danny </b> invited to join <b>
                                                        Meeting.</b></p>
                                                <span class="text-muted">Daily scrum meeting time</span>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="dropdown-divider"></div>
                            <div class="text-center py-2">
                                <a href="#!" class="link-primary">View all</a>
                            </div>
                        </div>
                    </li>
                    <li class="dropdown pc-h-item">
                        <a class="pc-head-link dropdown-toggle arrow-none me-0" data-bs-toggle="dropdown" href="#"
                            role="button" aria-haspopup="false" aria-expanded="false">
                            <i class="ti ti-mail"></i>
                        </a>
                        <div class="dropdown-menu dropdown-notification dropdown-menu-end pc-h-dropdown">
                            <div class="dropdown-header d-flex align-items-center justify-content-between">
                                <h5 class="m-0">Message</h5>
                                <a href="#!" class="pc-head-link bg-transparent"><i class="ti ti-x text-danger"></i></a>
                            </div>
                            <div class="dropdown-divider"></div>
                            <div class="dropdown-header px-0 text-wrap header-notification-scroll position-relative"
                                style="max-height: calc(100vh - 215px)">
                                <div class="list-group list-group-flush w-100">
                                    <a class="list-group-item list-group-item-action">
                                        <div class="d-flex">
                                            <div class="flex-shrink-0">
                                                <img src="../assets/images/user/avatar-2.jpg" alt="user-image"
                                                    class="user-avtar">
                                            </div>
                                            <div class="flex-grow-1 ms-1">
                                                <span class="float-end text-muted">3:00 AM</span>
                                                <p class="text-body mb-1">It's <b>Cristina danny's</b> birthday today.
                                                </p>
                                                <span class="text-muted">2 min ago</span>
                                            </div>
                                        </div>
                                    </a>
                                    <a class="list-group-item list-group-item-action">
                                        <div class="d-flex">
                                            <div class="flex-shrink-0">
                                                <img src="../assets/images/user/avatar-1.jpg" alt="user-image"
                                                    class="user-avtar">
                                            </div>
                                            <div class="flex-grow-1 ms-1">
                                                <span class="float-end text-muted">6:00 PM</span>
                                                <p class="text-body mb-1"><b>Aida Burg</b> commented your post.</p>
                                                <span class="text-muted">5 August</span>
                                            </div>
                                        </div>
                                    </a>
                                    <a class="list-group-item list-group-item-action">
                                        <div class="d-flex">
                                            <div class="flex-shrink-0">
                                                <img src="../assets/images/user/avatar-3.jpg" alt="user-image"
                                                    class="user-avtar">
                                            </div>
                                            <div class="flex-grow-1 ms-1">
                                                <span class="float-end text-muted">2:45 PM</span>
                                                <p class="text-body mb-1"><b>There was a failure to your setup.</b></p>
                                                <span class="text-muted">7 hours ago</span>
                                            </div>
                                        </div>
                                    </a>
                                    <a class="list-group-item list-group-item-action">
                                        <div class="d-flex">
                                            <div class="flex-shrink-0">
                                                <img src="../assets/images/user/avatar-4.jpg" alt="user-image"
                                                    class="user-avtar">
                                            </div>
                                            <div class="flex-grow-1 ms-1">
                                                <span class="float-end text-muted">9:10 PM</span>
                                                <p class="text-body mb-1"><b>Cristina Danny </b> invited to join <b>
                                                        Meeting.</b></p>
                                                <span class="text-muted">Daily scrum meeting time</span>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="dropdown-divider"></div>
                            <div class="text-center py-2">
                                <a href="#!" class="link-primary">View all</a>
                            </div>
                        </div>
                    </li>
                    <li class="dropdown pc-h-item">
                        <a class="pc-head-link me-0" href="#" data-bs-toggle="offcanvas"
                            data-bs-target="#offcanvas_pc_layout">
                            <i class="ti ti-settings"></i>
                        </a>
                    </li>
                    <li class="dropdown pc-h-item header-user-profile">
                        <a class="pc-head-link dropdown-toggle arrow-none me-0" data-bs-toggle="dropdown" href="#"
                            role="button" aria-haspopup="false" data-bs-auto-close="outside" aria-expanded="false">
                            <img src="../assets/images/user/avatar-2.jpg" alt="user-image" class="user-avtar">
                            <span>Stebin Ben</span>
                        </a>
                        <div class="dropdown-menu dropdown-user-profile dropdown-menu-end pc-h-dropdown">
                            <div class="dropdown-header">
                                <div class="d-flex mb-1">
                                    <div class="flex-shrink-0">
                                        <img src="../assets/images/user/avatar-2.jpg" alt="user-image"
                                            class="user-avtar wid-35">
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <h6 class="mb-1">Stebin Ben</h6>
                                        <span>UI/UX Designer</span>
                                    </div>
                                    <a href="#!" class="pc-head-link bg-transparent"><i
                                            class="ti ti-power text-danger"></i></a>
                                </div>
                            </div>
                            <ul class="nav drp-tabs nav-fill nav-tabs" id="mydrpTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="drp-t1" data-bs-toggle="tab"
                                        data-bs-target="#drp-tab-1" type="button" role="tab" aria-controls="drp-tab-1"
                                        aria-selected="true"><i class="ti ti-user"></i> Profile</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="drp-t2" data-bs-toggle="tab"
                                        data-bs-target="#drp-tab-2" type="button" role="tab" aria-controls="drp-tab-2"
                                        aria-selected="false"><i class="ti ti-settings"></i> Setting</button>
                                </li>
                            </ul>
                            <div class="tab-content" id="mysrpTabContent">
                                <div class="tab-pane fade show active" id="drp-tab-1" role="tabpanel"
                                    aria-labelledby="drp-t1" tabindex="0">
                                    <a href="#!" class="dropdown-item">
                                        <i class="ti ti-edit-circle"></i>
                                        <span>Edit Profile</span>
                                    </a>
                                    <a href="#!" class="dropdown-item">
                                        <i class="ti ti-user"></i>
                                        <span>View Profile</span>
                                    </a>
                                    <a href="#!" class="dropdown-item">
                                        <i class="ti ti-clipboard-list"></i>
                                        <span>Social Profile</span>
                                    </a>
                                    <a href="#!" class="dropdown-item">
                                        <i class="ti ti-wallet"></i>
                                        <span>Billing</span>
                                    </a>
                                    <a href="#!" class="dropdown-item">
                                        <i class="ti ti-power"></i>
                                        <span>Logout</span>
                                    </a>
                                </div>
                                <div class="tab-pane fade" id="drp-tab-2" role="tabpanel" aria-labelledby="drp-t2"
                                    tabindex="0">
                                    <a href="#!" class="dropdown-item">
                                        <i class="ti ti-help"></i>
                                        <span>Support</span>
                                    </a>
                                    <a href="#!" class="dropdown-item">
                                        <i class="ti ti-user"></i>
                                        <span>Account Settings</span>
                                    </a>
                                    <a href="#!" class="dropdown-item">
                                        <i class="ti ti-lock"></i>
                                        <span>Privacy Center</span>
                                    </a>
                                    <a href="#!" class="dropdown-item">
                                        <i class="ti ti-messages"></i>
                                        <span>Feedback</span>
                                    </a>
                                    <a href="#!" class="dropdown-item">
                                        <i class="ti ti-list"></i>
                                        <span>History</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </header>
    <!-- [ Header ] end -->



    <section class="pc-container">
        <div class="pc-content">
            <!-- [ breadcrumb ] start -->
            <div class="page-header">
                <div class="page-block">
                    <div class="row align-items-center">
                        <div class="col-md-12">
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="../dashboard/index.html">Home</a></li>
                                <li class="breadcrumb-item"><a href="javascript: void(0)">DataTable</a></li>
                                <li class="breadcrumb-item" aria-current="page">Responsive</li>
                            </ul>
                        </div>
                        <div class="col-md-12">
                            <div class="page-header-title">
                                <h2 class="mb-0">Responsive</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- [ breadcrumb ] end -->

            <!-- [ Main Content ] start -->
            <div class="row">
                <!-- Config table start -->
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h5>Configuration Option</h5>
                            <small>The Responsive extension for DataTables can be applied to a DataTable in one of two
                                ways; with a specific class name on
                                the table.</small>
                        </div>
                        <div class="card-body">
                            <table id="res-config" class="display table table-striped table-hover dt-responsive nowrap"
                                style="width: 100%">
                                <thead>
                                    <tr>
                                        <th>First name</th>
                                        <th>Last name</th>
                                        <th>Position</th>
                                        <th>Office</th>
                                        <th>Age</th>
                                        <th>Start date</th>
                                        <th>Salary</th>
                                        <th>Extn.</th>
                                        <th>E-mail</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Tiger</td>
                                        <td>Nixon</td>
                                        <td>System Architect</td>
                                        <td>Edinburgh</td>
                                        <td>61</td>
                                        <td>2011/04/25</td>
                                        <td>$320,800</td>
                                        <td>5421</td>
                                        <td>t.nixon@datatables.net</td>
                                    </tr>
                                    <tr>
                                        <td>Garrett</td>
                                        <td>Winters</td>
                                        <td>Chief Executive Officer (CEO)</td>
                                        <td>Tokyo</td>
                                        <td>63</td>
                                        <td>2011/07/25</td>
                                        <td>$170,750</td>
                                        <td>8422</td>
                                        <td>g.winters@datatables.net</td>
                                    </tr>
                                    <tr>
                                        <td>Ashton</td>
                                        <td>Cox</td>
                                        <td>Junior Technical Author</td>
                                        <td>San Francisco</td>
                                        <td>66</td>
                                        <td>2009/01/12</td>
                                        <td>$86,000</td>
                                        <td>1562</td>
                                        <td>a.cox@datatables.net</td>
                                    </tr>
                                    <tr>
                                        <td>Cedric</td>
                                        <td>Kelly</td>
                                        <td>Senior Javascript Developer</td>
                                        <td>Edinburgh</td>
                                        <td>22</td>
                                        <td>2012/03/29</td>
                                        <td>$433,060</td>
                                        <td>6224</td>
                                        <td>c.kelly@datatables.net</td>
                                    </tr>
                                    <tr>
                                        <td>Airi</td>
                                        <td>Satou</td>
                                        <td>Accountant</td>
                                        <td>Tokyo</td>
                                        <td>33</td>
                                        <td>2008/11/28</td>
                                        <td>$162,700</td>
                                        <td>5407</td>
                                        <td>a.satou@datatables.net</td>
                                    </tr>
                                    <tr>
                                        <td>Brielle</td>
                                        <td>Williamson</td>
                                        <td>Integration Specialist</td>
                                        <td>New York</td>
                                        <td>61</td>
                                        <td>2012/12/02</td>
                                        <td>$372,000</td>
                                        <td>4804</td>
                                        <td>b.williamson@datatables.net</td>
                                    </tr>
                                    <tr>
                                        <td>Herrod</td>
                                        <td>Chandler</td>
                                        <td>Sales Assistant</td>
                                        <td>San Francisco</td>
                                        <td>59</td>
                                        <td>2012/08/06</td>
                                        <td>$137,500</td>
                                        <td>9608</td>
                                        <td>h.chandler@datatables.net</td>
                                    </tr>
                                    <tr>
                                        <td>Rhona</td>
                                        <td>Davidson</td>
                                        <td>Integration Specialist</td>
                                        <td>Tokyo</td>
                                        <td>55</td>
                                        <td>2010/10/14</td>
                                        <td>$327,900</td>
                                        <td>6200</td>
                                        <td>r.davidson@datatables.net</td>
                                    </tr>
                                    <tr>
                                        <td>Colleen</td>
                                        <td>Hurst</td>
                                        <td>Javascript Developer</td>
                                        <td>San Francisco</td>
                                        <td>39</td>
                                        <td>2009/09/15</td>
                                        <td>$205,500</td>
                                        <td>2360</td>
                                        <td>c.hurst@datatables.net</td>
                                    </tr>
                                    <tr>
                                        <td>Sonya</td>
                                        <td>Frost</td>
                                        <td>Software Engineer</td>
                                        <td>Edinburgh</td>
                                        <td>23</td>
                                        <td>2008/12/13</td>
                                        <td>$103,600</td>
                                        <td>1667</td>
                                        <td>s.frost@datatables.net</td>
                                    </tr>
                                    <tr>
                                        <td>Jena</td>
                                        <td>Gaines</td>
                                        <td>Office Manager</td>
                                        <td>London</td>
                                        <td>30</td>
                                        <td>2008/12/19</td>
                                        <td>$90,560</td>
                                        <td>3814</td>
                                        <td>j.gaines@datatables.net</td>
                                    </tr>
                                    <tr>
                                        <td>Quinn</td>
                                        <td>Flynn</td>
                                        <td>Support Lead</td>
                                        <td>Edinburgh</td>
                                        <td>22</td>
                                        <td>2013/03/03</td>
                                        <td>$342,000</td>
                                        <td>9497</td>
                                        <td>q.flynn@datatables.net</td>
                                    </tr>
                                    <tr>
                                        <td>Charde</td>
                                        <td>Marshall</td>
                                        <td>Regional Director</td>
                                        <td>San Francisco</td>
                                        <td>36</td>
                                        <td>2008/10/16</td>
                                        <td>$470,600</td>
                                        <td>6741</td>
                                        <td>c.marshall@datatables.net</td>
                                    </tr>
                                    <tr>
                                        <td>Haley</td>
                                        <td>Kennedy</td>
                                        <td>Senior Marketing Designer</td>
                                        <td>London</td>
                                        <td>43</td>
                                        <td>2012/12/18</td>
                                        <td>$313,500</td>
                                        <td>3597</td>
                                        <td>h.kennedy@datatables.net</td>
                                    </tr>
                                    <tr>
                                        <td>Tatyana</td>
                                        <td>Fitzpatrick</td>
                                        <td>Regional Director</td>
                                        <td>London</td>
                                        <td>19</td>
                                        <td>2010/03/17</td>
                                        <td>$385,750</td>
                                        <td>1965</td>
                                        <td>t.fitzpatrick@datatables.net</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- Config table end -->
                <!-- `New` Constructor table start -->
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h5>New Constructor</h5>
                            <small>The third way of initialising Responsive is by manually creating a new instance using
                                the $.fn.dataTable.Responsive
                                class, as shown in this example (the other two methods are provided using this
                                constructor</small>
                        </div>
                        <div class="card-body">
                            <div class="dt-responsive table-responsive">
                                <table id="new-cons"
                                    class="display table table-striped table-hover dt-responsive nowrap"
                                    style="width: 100%">
                                    <thead>
                                        <tr>
                                            <th>First name</th>
                                            <th>Last name</th>
                                            <th>Position</th>
                                            <th>Office</th>
                                            <th>Age</th>
                                            <th>Start date</th>
                                            <th>Salary</th>
                                            <th>Extn.</th>
                                            <th>E-mail</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Tiger</td>
                                            <td>Nixon</td>
                                            <td>System Architect</td>
                                            <td>Edinburgh</td>
                                            <td>61</td>
                                            <td>2011/04/25</td>
                                            <td>$320,800</td>
                                            <td>5421</td>
                                            <td>t.nixon@datatables.net</td>
                                        </tr>
                                        <tr>
                                            <td>Garrett</td>
                                            <td>Winters</td>
                                            <td>Chief Executive Officer (CEO)</td>
                                            <td>Tokyo</td>
                                            <td>63</td>
                                            <td>2011/07/25</td>
                                            <td>$170,750</td>
                                            <td>8422</td>
                                            <td>g.winters@datatables.net</td>
                                        </tr>
                                        <tr>
                                            <td>Ashton</td>
                                            <td>Cox</td>
                                            <td>Junior Technical Author</td>
                                            <td>San Francisco</td>
                                            <td>66</td>
                                            <td>2009/01/12</td>
                                            <td>$86,000</td>
                                            <td>1562</td>
                                            <td>a.cox@datatables.net</td>
                                        </tr>
                                        <tr>
                                            <td>Cedric</td>
                                            <td>Kelly</td>
                                            <td>Senior Javascript Developer</td>
                                            <td>Edinburgh</td>
                                            <td>22</td>
                                            <td>2012/03/29</td>
                                            <td>$433,060</td>
                                            <td>6224</td>
                                            <td>c.kelly@datatables.net</td>
                                        </tr>
                                        <tr>
                                            <td>Airi</td>
                                            <td>Satou</td>
                                            <td>Accountant</td>
                                            <td>Tokyo</td>
                                            <td>33</td>
                                            <td>2008/11/28</td>
                                            <td>$162,700</td>
                                            <td>5407</td>
                                            <td>a.satou@datatables.net</td>
                                        </tr>
                                        <tr>
                                            <td>Brielle</td>
                                            <td>Williamson</td>
                                            <td>Integration Specialist</td>
                                            <td>New York</td>
                                            <td>61</td>
                                            <td>2012/12/02</td>
                                            <td>$372,000</td>
                                            <td>4804</td>
                                            <td>b.williamson@datatables.net</td>
                                        </tr>
                                        <tr>
                                            <td>Herrod</td>
                                            <td>Chandler</td>
                                            <td>Sales Assistant</td>
                                            <td>San Francisco</td>
                                            <td>59</td>
                                            <td>2012/08/06</td>
                                            <td>$137,500</td>
                                            <td>9608</td>
                                            <td>h.chandler@datatables.net</td>
                                        </tr>
                                        <tr>
                                            <td>Rhona</td>
                                            <td>Davidson</td>
                                            <td>Integration Specialist</td>
                                            <td>Tokyo</td>
                                            <td>55</td>
                                            <td>2010/10/14</td>
                                            <td>$327,900</td>
                                            <td>6200</td>
                                            <td>r.davidson@datatables.net</td>
                                        </tr>
                                        <tr>
                                            <td>Colleen</td>
                                            <td>Hurst</td>
                                            <td>Javascript Developer</td>
                                            <td>San Francisco</td>
                                            <td>39</td>
                                            <td>2009/09/15</td>
                                            <td>$205,500</td>
                                            <td>2360</td>
                                            <td>c.hurst@datatables.net</td>
                                        </tr>
                                        <tr>
                                            <td>Sonya</td>
                                            <td>Frost</td>
                                            <td>Software Engineer</td>
                                            <td>Edinburgh</td>
                                            <td>23</td>
                                            <td>2008/12/13</td>
                                            <td>$103,600</td>
                                            <td>1667</td>
                                            <td>s.frost@datatables.net</td>
                                        </tr>
                                        <tr>
                                            <td>Jena</td>
                                            <td>Gaines</td>
                                            <td>Office Manager</td>
                                            <td>London</td>
                                            <td>30</td>
                                            <td>2008/12/19</td>
                                            <td>$90,560</td>
                                            <td>3814</td>
                                            <td>j.gaines@datatables.net</td>
                                        </tr>
                                        <tr>
                                            <td>Quinn</td>
                                            <td>Flynn</td>
                                            <td>Support Lead</td>
                                            <td>Edinburgh</td>
                                            <td>22</td>
                                            <td>2013/03/03</td>
                                            <td>$342,000</td>
                                            <td>9497</td>
                                            <td>q.flynn@datatables.net</td>
                                        </tr>
                                        <tr>
                                            <td>Charde</td>
                                            <td>Marshall</td>
                                            <td>Regional Director</td>
                                            <td>San Francisco</td>
                                            <td>36</td>
                                            <td>2008/10/16</td>
                                            <td>$470,600</td>
                                            <td>6741</td>
                                            <td>c.marshall@datatables.net</td>
                                        </tr>
                                        <tr>
                                            <td>Haley</td>
                                            <td>Kennedy</td>
                                            <td>Senior Marketing Designer</td>
                                            <td>London</td>
                                            <td>43</td>
                                            <td>2012/12/18</td>
                                            <td>$313,500</td>
                                            <td>3597</td>
                                            <td>h.kennedy@datatables.net</td>
                                        </tr>
                                        <tr>
                                            <td>Tatyana</td>
                                            <td>Fitzpatrick</td>
                                            <td>Regional Director</td>
                                            <td>London</td>
                                            <td>19</td>
                                            <td>2010/03/17</td>
                                            <td>$385,750</td>
                                            <td>1965</td>
                                            <td>t.fitzpatrick@datatables.net</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- `New` Constructor table end -->
                <!-- Immediately Show Hidden Details table start -->
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h5>Immediately Show Hidden Details</h5>
                            <small>Responsive has the ability to display the details that it has hidden in a variety of
                                different ways. Its default is to
                                allow the end user to toggle the the display by clicking on a row and showing the
                                information in a DataTables child
                                row</small>
                        </div>
                        <div class="card-body">
                            <div class="dt-responsive table-responsive">
                                <table id="show-hide-res"
                                    class="display table table-striped table-hover dt-responsive nowrap"
                                    style="width: 100%">
                                    <thead>
                                        <tr>
                                            <th>First name</th>
                                            <th>Last name</th>
                                            <th>Position</th>
                                            <th>Office</th>
                                            <th>Age</th>
                                            <th>Start date</th>
                                            <th>Salary</th>
                                            <th>Extn.</th>
                                            <th>E-mail</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Tiger</td>
                                            <td>Nixon</td>
                                            <td>System Architect</td>
                                            <td>Edinburgh</td>
                                            <td>61</td>
                                            <td>2011/04/25</td>
                                            <td>$320,800</td>
                                            <td>5421</td>
                                            <td>t.nixon@datatables.net</td>
                                        </tr>
                                        <tr>
                                            <td>Garrett</td>
                                            <td>Winters</td>
                                            <td>Chief Executive Officer (CEO)</td>
                                            <td>Tokyo</td>
                                            <td>63</td>
                                            <td>2011/07/25</td>
                                            <td>$170,750</td>
                                            <td>8422</td>
                                            <td>g.winters@datatables.net</td>
                                        </tr>
                                        <tr>
                                            <td>Ashton</td>
                                            <td>Cox</td>
                                            <td>Junior Technical Author</td>
                                            <td>San Francisco</td>
                                            <td>66</td>
                                            <td>2009/01/12</td>
                                            <td>$86,000</td>
                                            <td>1562</td>
                                            <td>a.cox@datatables.net</td>
                                        </tr>
                                        <tr>
                                            <td>Cedric</td>
                                            <td>Kelly</td>
                                            <td>Senior Javascript Developer</td>
                                            <td>Edinburgh</td>
                                            <td>22</td>
                                            <td>2012/03/29</td>
                                            <td>$433,060</td>
                                            <td>6224</td>
                                            <td>c.kelly@datatables.net</td>
                                        </tr>
                                        <tr>
                                            <td>Airi</td>
                                            <td>Satou</td>
                                            <td>Accountant</td>
                                            <td>Tokyo</td>
                                            <td>33</td>
                                            <td>2008/11/28</td>
                                            <td>$162,700</td>
                                            <td>5407</td>
                                            <td>a.satou@datatables.net</td>
                                        </tr>
                                        <tr>
                                            <td>Brielle</td>
                                            <td>Williamson</td>
                                            <td>Integration Specialist</td>
                                            <td>New York</td>
                                            <td>61</td>
                                            <td>2012/12/02</td>
                                            <td>$372,000</td>
                                            <td>4804</td>
                                            <td>b.williamson@datatables.net</td>
                                        </tr>
                                        <tr>
                                            <td>Herrod</td>
                                            <td>Chandler</td>
                                            <td>Sales Assistant</td>
                                            <td>San Francisco</td>
                                            <td>59</td>
                                            <td>2012/08/06</td>
                                            <td>$137,500</td>
                                            <td>9608</td>
                                            <td>h.chandler@datatables.net</td>
                                        </tr>
                                        <tr>
                                            <td>Rhona</td>
                                            <td>Davidson</td>
                                            <td>Integration Specialist</td>
                                            <td>Tokyo</td>
                                            <td>55</td>
                                            <td>2010/10/14</td>
                                            <td>$327,900</td>
                                            <td>6200</td>
                                            <td>r.davidson@datatables.net</td>
                                        </tr>
                                        <tr>
                                            <td>Colleen</td>
                                            <td>Hurst</td>
                                            <td>Javascript Developer</td>
                                            <td>San Francisco</td>
                                            <td>39</td>
                                            <td>2009/09/15</td>
                                            <td>$205,500</td>
                                            <td>2360</td>
                                            <td>c.hurst@datatables.net</td>
                                        </tr>
                                        <tr>
                                            <td>Sonya</td>
                                            <td>Frost</td>
                                            <td>Software Engineer</td>
                                            <td>Edinburgh</td>
                                            <td>23</td>
                                            <td>2008/12/13</td>
                                            <td>$103,600</td>
                                            <td>1667</td>
                                            <td>s.frost@datatables.net</td>
                                        </tr>
                                        <tr>
                                            <td>Jena</td>
                                            <td>Gaines</td>
                                            <td>Office Manager</td>
                                            <td>London</td>
                                            <td>30</td>
                                            <td>2008/12/19</td>
                                            <td>$90,560</td>
                                            <td>3814</td>
                                            <td>j.gaines@datatables.net</td>
                                        </tr>
                                        <tr>
                                            <td>Quinn</td>
                                            <td>Flynn</td>
                                            <td>Support Lead</td>
                                            <td>Edinburgh</td>
                                            <td>22</td>
                                            <td>2013/03/03</td>
                                            <td>$342,000</td>
                                            <td>9497</td>
                                            <td>q.flynn@datatables.net</td>
                                        </tr>
                                        <tr>
                                            <td>Charde</td>
                                            <td>Marshall</td>
                                            <td>Regional Director</td>
                                            <td>San Francisco</td>
                                            <td>36</td>
                                            <td>2008/10/16</td>
                                            <td>$470,600</td>
                                            <td>6741</td>
                                            <td>c.marshall@datatables.net</td>
                                        </tr>
                                        <tr>
                                            <td>Haley</td>
                                            <td>Kennedy</td>
                                            <td>Senior Marketing Designer</td>
                                            <td>London</td>
                                            <td>43</td>
                                            <td>2012/12/18</td>
                                            <td>$313,500</td>
                                            <td>3597</td>
                                            <td>h.kennedy@datatables.net</td>
                                        </tr>
                                        <tr>
                                            <td>Tatyana</td>
                                            <td>Fitzpatrick</td>
                                            <td>Regional Director</td>
                                            <td>London</td>
                                            <td>19</td>
                                            <td>2010/03/17</td>
                                            <td>$385,750</td>
                                            <td>1965</td>
                                            <td>t.fitzpatrick@datatables.net</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Immediately Show Hidden Details table end -->
            </div>
            <!-- [ Main Content ] end -->
        </div>
    </section>
    <footer class="pc-footer">
        <div class="footer-wrapper container-fluid">
            <div class="row">
                <div class="col-sm my-1">
                    <p class="m-0">Mantis &#9829; crafted by Team <a href="https://themeforest.net/user/codedthemes"
                            target="_blank">Codedthemes</a> Distributed by <a
                            href="https://themewagon.com/">ThemeWagon</a>.</p>
                </div>
                <div class="col-auto my-1">
                    <ul class="list-inline footer-link mb-0">
                        <li class="list-inline-item"><a href="../index.html">Home</a></li>
                        <li class="list-inline-item"><a href="https://codedthemes.gitbook.io/mantis-bootstrap"
                                target="_blank">Documentation</a></li>
                        <li class="list-inline-item"><a href="https://codedthemes.authordesk.app/"
                                target="_blank">Support</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer> <!-- Required Js -->
    <script src="{{ asset('mantis/assets/js/plugins/apexcharts.min.js') }}"></script>
    <script src="{{ asset('mantis/assets/js/pages/dashboard-default.js') }}"></script>
    <!-- [Page Specific JS] end -->

    <!-- Required Js -->
    <script src="{{ asset('mantis/assets/js/plugins/popper.min.js') }}"></script>
    <script src="{{ asset('mantis/assets/js/plugins/simplebar.min.js') }}"></script>
    <script src="{{ asset('mantis/assets/js/plugins/bootstrap.min.js') }}"></script>
    <script src="{{ asset('mantis/assets/js/fonts/custom-font.js') }}"></script>
    <script src="{{ asset('mantis/assets/js/pcoded.js') }}"></script>
    <script src="{{ asset('mantis/assets/js/plugins/feather.min.js') }}"></script>





    <script>
        layout_change('light');
    </script>




    <script>
        change_box_container('false');
    </script>



    <script>
        layout_rtl_change('false');
    </script>


    <script>
        preset_change("preset-1");
    </script>


    <script>
        font_change("Public-Sans");
    </script>


    <div class="offcanvas pct-offcanvas offcanvas-end" tabindex="-1" id="offcanvas_pc_layout">
        <div class="offcanvas-header bg-primary">
            <h5 class="offcanvas-title text-white">Mantis Customizer</h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"
                aria-label="Close"></button>
        </div>
        <div class="pct-body" style="height: calc(100% - 60px)">
            <div class="offcanvas-body">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <a class="btn border-0 text-start w-100" data-bs-toggle="collapse" href="#pctcustcollapse1">
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0">
                                    <div class="avtar avtar-xs bg-light-primary">
                                        <i class="ti ti-layout-sidebar f-18"></i>
                                    </div>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h6 class="mb-1">Theme Layout</h6>
                                    <span>Choose your layout</span>
                                </div>
                                <i class="ti ti-chevron-down"></i>
                            </div>
                        </a>
                        <div class="collapse show" id="pctcustcollapse1">
                            <div class="pct-content">
                                <div class="pc-rtl">
                                    <p class="mb-1">Direction</p>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" role="switch"
                                            id="layoutmodertl">
                                        <label class="form-check-label" for="layoutmodertl">RTL</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <a class="btn border-0 text-start w-100" data-bs-toggle="collapse" href="#pctcustcollapse2">
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0">
                                    <div class="avtar avtar-xs bg-light-primary">
                                        <i class="ti ti-brush f-18"></i>
                                    </div>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h6 class="mb-1">Theme Mode</h6>
                                    <span>Choose light or dark mode</span>
                                </div>
                                <i class="ti ti-chevron-down"></i>
                            </div>
                        </a>
                        <div class="collapse show" id="pctcustcollapse2">
                            <div class="pct-content">
                                <label class="mb-2 fw-semibold d-block">Pilih Mode Tema</label>
                                <div class="theme-color themepreset-color theme-layout d-flex gap-3">
                                    <a href="#!" class="text-center active" onclick="layout_change('light')" data-value="false">
                                        <span>
                                            <img src="{{ asset('mantis/images/customization/default.svg') }}" alt="Light Mode" class="img-fluid" style="width: 40px;">
                                        </span>
                                        <span class="d-block mt-1">Light</span>
                                    </a>
                                    <a href="#!" class="text-center" onclick="layout_change('dark')" data-value="true">
                                        <span>
                                            <img src="{{ asset('mantis/images/customization/dark.svg') }}" alt="Dark Mode" class="img-fluid" style="width: 40px;">
                                        </span>
                                        <span class="d-block mt-1">Dark</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <a class="btn border-0 text-start w-100" data-bs-toggle="collapse" href="#pctcustcollapse3">
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0">
                                    <div class="avtar avtar-xs bg-light-primary">
                                        <i class="ti ti-color-swatch f-18"></i>
                                    </div>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h6 class="mb-1">Color Scheme</h6>
                                    <span>Choose your primary theme color</span>
                                </div>
                                <i class="ti ti-chevron-down"></i>
                            </div>
                        </a>
                        <div class="collapse show" id="pctcustcollapse3">
                            <div class="pct-content">
                                <div class="theme-color preset-color">
                                    <a href="#!" class="active" data-value="preset-1">
                                        <span><img src="{{ asset('mantis/images/customization/theme-color.svg') }}" alt="img"></span>
                                        <span>Theme 1</span>
                                    </a>
                                    <a href="#!" class="" data-value="preset-2">
                                        <span><img src="{{ asset('mantis/images/customization/theme-color.svg') }}" alt="img"></span>
                                        <span>Theme 2</span>
                                    </a>
                                    <a href="#!" class="" data-value="preset-3">
                                        <span><img src="{{ asset('mantis/images/customization/theme-color.svg') }}" alt="img"></span>
                                        <span>Theme 3</span>
                                    </a>
                                    <a href="#!" class="" data-value="preset-4">
                                        <span><img src="{{ asset('mantis/images/customization/theme-color.svg') }}" alt="img"></span>
                                        <span>Theme 4</span>
                                    </a>
                                    <a href="#!" class="" data-value="preset-5">
                                        <span><img src="{{ asset('mantis/images/customization/theme-color.svg') }}" alt="img"></span>
                                        <span>Theme 5</span>
                                    </a>
                                    <a href="#!" class="" data-value="preset-6">
                                        <span><img src="{{ asset('mantis/images/customization/theme-color.svg') }}" alt="img"></span>
                                        <span>Theme 6</span>
                                    </a>
                                    <a href="#!" class="" data-value="preset-7">
                                        <span><img src="{{ asset('mantis/images/customization/theme-color.svg') }}" alt="img"></span>
                                        <span>Theme 7</span>
                                    </a>
                                    <a href="#!" class="" data-value="preset-8">
                                        <span><img src="{{ asset('mantis/images/customization/theme-color.svg') }}" alt="img"></span>
                                        <span>Theme 8</span>
                                    </a>
                                    <a href="#!" class="" data-value="preset-9">
                                        <span><img src="{{ asset('mantis/images/customization/theme-color.svg') }}" alt="img"></span>
                                        <span>Theme 9</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item pc-boxcontainer">
                        <a class="btn border-0 text-start w-100" data-bs-toggle="collapse" href="#pctcustcollapse4">
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0">
                                    <div class="avtar avtar-xs bg-light-primary">
                                        <i class="ti ti-border-inner f-18"></i>
                                    </div>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h6 class="mb-1">Layout Width</h6>
                                    <span>Choose fluid or container layout</span>
                                </div>
                                <i class="ti ti-chevron-down"></i>
                            </div>
                        </a>
                        <div class="collapse show" id="pctcustcollapse4">
                            <div class="pct-content">
                                <div class="theme-color themepreset-color boxwidthpreset theme-container">
                                    <a href="#!" class="active" onclick="change_box_container('false')" data-value="false">
                                        <span>
                                            <img src="{{ asset('mantis/images/customization/default.svg') }}" alt="img">
                                        </span>
                                        <span>Fluid</span>
                                    </a>
                                    <a href="#!" class="" onclick="change_box_container('true')" data-value="true">
                                        <span>
                                            <img src="{{ asset('mantis/images/customization/container.svg') }}" alt="img">
                                        </span>
                                        <span>Container</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <a class="btn border-0 text-start w-100" data-bs-toggle="collapse" href="#pctcustcollapse5">
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0">
                                    <div class="avtar avtar-xs bg-light-primary">
                                        <i class="ti ti-typography f-18"></i>
                                    </div>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h6 class="mb-1">Font Family</h6>
                                    <span>Choose your font family.</span>
                                </div>
                                <i class="ti ti-chevron-down"></i>
                            </div>
                        </a>
                        <div class="collapse show" id="pctcustcollapse5">
                            <div class="pct-content">
                                <div class="theme-color fontpreset-color">
                                    <a href="#!" class="active" onclick="font_change('Public-Sans')"
                                        data-value="Public-Sans"><span>Aa</span><span>Public Sans</span></a>
                                    <a href="#!" class="" onclick="font_change('Roboto')"
                                        data-value="Roboto"><span>Aa</span><span>Roboto</span></a>
                                    <a href="#!" class="" onclick="font_change('Poppins')"
                                        data-value="Poppins"><span>Aa</span><span>Poppins</span></a>
                                    <a href="#!" class="" onclick="font_change('Inter')"
                                        data-value="Inter"><span>Aa</span><span>Inter</span></a>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="collapse show">
                            <div class="pct-content">
                                <div class="d-grid">
                                    <button class="btn btn-light-danger" id="layoutreset">Reset Layout</button>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <!-- [Page Specific JS] start -->
    <!-- datatable Js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="{{ asset('mantis/assets/js/plugins/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('mantis/assets/js/plugins/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('mantis/assets/js/plugins/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('mantis/assets/js/plugins/responsive.bootstrap5.min.js') }}"></script>

    <script>
      // [ Configuration Option ]
      $('#res-config').DataTable({
        responsive: true
      });

      // [ New Constructor ]
      var newcs = $('#new-cons').DataTable();
      new $.fn.dataTable.Responsive(newcs);

      // [ Immediately Show Hidden Details ]
      $('#show-hide-res').DataTable({
        responsive: {
          details: {
            display: $.fn.dataTable.Responsive.display.childRowImmediate,
            type: ''
          }
        }
      });
    </script>

    <!-- [Page Specific JS] end -->
</body>
<!-- [Body] end -->

</html>
