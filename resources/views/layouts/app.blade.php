<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required Meta Tags Always Come First -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Title -->
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- datatables -->
    {{--  @stack('stylesDataTables')  --}}
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.css">

    <!-- Favicon -->
    <link rel="shortcut icon" href="./favicon.ico">

    <!-- Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">

    <!-- CSS Implementing Plugins -->
    <link rel="stylesheet" href="{{ asset('dist') }}/assets/vendor/bootstrap-icons/font/bootstrap-icons.css">

    <link rel="stylesheet" href="{{ asset('dist') }}/assets/vendor/daterangepicker/daterangepicker.css">
    <link rel="stylesheet" href="{{ asset('dist') }}/assets/vendor/tom-select/dist/css/tom-select.bootstrap5.css">

    {{-- CSS flatpickr --}}
    @stack('flatpickr-css')

    {{-- datatables css --}}
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.css">


    {{-- ckeditor --}}
    <script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/classic/ckeditor.js"></script>



    <!-- CSS Front Template -->
    <link rel="stylesheet" href="./node_modules/tom-select/dist/css/tom-select.bootstrap5.css">
    <link rel="preload" href="{{ asset('dist') }}/assets/css/theme.min.css" data-hs-appearance="default"
        as="style">
    <link rel="preload" href="{{ asset('dist') }}/assets/css/theme-dark.min.css" data-hs-appearance="dark"
        as="style">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/ckeditor.scss') }}" rel="stylesheet">
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/ckeditor.js') }}" defer></script>


    <style data-hs-appearance-onload-styles>
        * {
            transition: unset !important;
        }

        body {
            opacity: 0;
        }
    </style>

    <script>
        window.hs_config = {
            "autopath": "@@autopath",
            "deleteLine": "hs-builder:delete",
            "deleteLine:build": "hs-builder:build-delete",
            "deleteLine:dist": "hs-builder:dist-delete",
            "previewMode": false,
            "startPath": "/index.html",
            "vars": {
                "themeFont": "https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap",
                "version": "?v=1.0"
            },
            "layoutBuilder": {
                "extend": {
                    "switcherSupport": true
                },
                "header": {
                    "layoutMode": "default",
                    "containerMode": "container-fluid"
                },
                "sidebarLayout": "default"
            },
            "themeAppearance": {
                "layoutSkin": "default",
                "sidebarSkin": "default",
                "styles": {
                    "colors": {
                        "primary": "#377dff",
                        "transparent": "transparent",
                        "white": "#fff",
                        "dark": "132144",
                        "gray": {
                            "100": "#f9fafc",
                            "900": "#1e2022"
                        }
                    },
                    "font": "Inter"
                }
            },
            "languageDirection": {
                "lang": "en"
            },
            "skipFilesFromBundle": {
                "dist": ["assets/js/hs.theme-appearance.js", "assets/js/hs.theme-appearance-charts.js",
                    "assets/js/demo.js"
                ],
                "build": ["assets/css/theme.css",
                    "assets/vendor/hs-navbar-vertical-aside/dist/hs-navbar-vertical-aside-mini-cache.js",
                    "assets/js/demo.js", "assets/css/theme-dark.css", "assets/css/docs.css",
                    "assets/vendor/icon-set/style.css", "assets/js/hs.theme-appearance.js",
                    "assets/js/hs.theme-appearance-charts.js",
                    "node_modules/chartjs-plugin-datalabels/dist/chartjs-plugin-datalabels.min.js",
                    "assets/js/demo.js"
                ]
            },
            "minifyCSSFiles": ["assets/css/theme.css", "assets/css/theme-dark.css"],
            "copyDependencies": {
                "dist": {
                    "*assets/js/theme-custom.js": ""
                },
                "build": {
                    "*assets/js/theme-custom.js": "",
                    "node_modules/bootstrap-icons/font/*fonts/**": "assets/css"
                }
            },
            "buildFolder": "",
            "replacePathsToCDN": {},
            "directoryNames": {
                "src": "./src",
                "dist": "./dist",
                "build": "./build"
            },
            "fileNames": {
                "dist": {
                    "js": "theme.min.js",
                    "css": "theme.min.css"
                },
                "build": {
                    "css": "theme.min.css",
                    "js": "theme.min.js",
                    "vendorCSS": "vendor.min.css",
                    "vendorJS": "vendor.min.js"
                }
            },
            "fileTypes": "jpg|png|svg|mp4|webm|ogv|json"
        }
        window.hs_config.gulpRGBA = (p1) => {
            const options = p1.split(',')
            const hex = options[0].toString()
            const transparent = options[1].toString()

            var c;
            if (/^#([A-Fa-f0-9]{3}){1,2}$/.test(hex)) {
                c = hex.substring(1).split('');
                if (c.length == 3) {
                    c = [c[0], c[0], c[1], c[1], c[2], c[2]];
                }
                c = '0x' + c.join('');
                return 'rgba(' + [(c >> 16) & 255, (c >> 8) & 255, c & 255].join(',') + ',' + transparent + ')';
            }
            throw new Error('Bad Hex');
        }
        window.hs_config.gulpDarken = (p1) => {
            const options = p1.split(',')

            let col = options[0].toString()
            let amt = -parseInt(options[1])
            var usePound = false

            if (col[0] == "#") {
                col = col.slice(1)
                usePound = true
            }
            var num = parseInt(col, 16)
            var r = (num >> 16) + amt
            if (r > 255) {
                r = 255
            } else if (r < 0) {
                r = 0
            }
            var b = ((num >> 8) & 0x00FF) + amt
            if (b > 255) {
                b = 255
            } else if (b < 0) {
                b = 0
            }
            var g = (num & 0x0000FF) + amt
            if (g > 255) {
                g = 255
            } else if (g < 0) {
                g = 0
            }
            return (usePound ? "#" : "") + (g | (b << 8) | (r << 16)).toString(16)
        }
        window.hs_config.gulpLighten = (p1) => {
            const options = p1.split(',')

            let col = options[0].toString()
            let amt = parseInt(options[1])
            var usePound = false

            if (col[0] == "#") {
                col = col.slice(1)
                usePound = true
            }
            var num = parseInt(col, 16)
            var r = (num >> 16) + amt
            if (r > 255) {
                r = 255
            } else if (r < 0) {
                r = 0
            }
            var b = ((num >> 8) & 0x00FF) + amt
            if (b > 255) {
                b = 255
            } else if (b < 0) {
                b = 0
            }
            var g = (num & 0x0000FF) + amt
            if (g > 255) {
                g = 255
            } else if (g < 0) {
                g = 0
            }
            return (usePound ? "#" : "") + (g | (b << 8) | (r << 16)).toString(16)
        }
    </script>

    @stack('styles')
    @stack('stylesDataTables')
</head>

<body class="has-navbar-vertical-aside navbar-vertical-aside-show-xl footer-offset">

    <script src="{{ asset('dist') }}/assets/js/hs.theme-appearance.js"></script>

    <script src="{{ asset('dist') }}/assets/vendor/hs-navbar-vertical-aside/dist/hs-navbar-vertical-aside-mini-cache.js">
    </script>

    <!-- ========== HEADER ========== -->

    <header id="header"
        class="bg-white navbar navbar-expand-lg navbar-fixed navbar-height navbar-container navbar-bordered">
        <div class="navbar-nav-wrap">
            <!-- Logo -->
            <a class="navbar-brand" href="./index.html" aria-label="Front">
                <img class="navbar-brand-logo" src="{{ asset('dist') }}/assets/svg/logos/logo.svg" alt="Logo"
                    data-hs-theme-appearance="default">
                <img class="navbar-brand-logo" src="{{ asset('dist') }}/assets/svg/logos-light/logo.svg" alt="Logo"
                    data-hs-theme-appearance="dark">
                <img class="navbar-brand-logo-mini" src="{{ asset('dist') }}/assets/svg/logos/logo-short.svg"
                    alt="Logo" data-hs-theme-appearance="default">
                <img class="navbar-brand-logo-mini" src="{{ asset('dist') }}/assets/svg/logos-light/logo-short.svg"
                    alt="Logo" data-hs-theme-appearance="dark">
            </a>
            <!-- End Logo -->

            <div class="navbar-nav-wrap-content-start">
                <!-- Navbar Vertical Toggle -->
                <button type="button" class="js-navbar-vertical-aside-toggle-invoker navbar-aside-toggler">
                    <i class="bi-arrow-bar-left navbar-toggler-short-align"
                        data-bs-template='<div class="tooltip d-none d-md-block" role="tooltip"><div class="arrow"></div><div class="tooltip-inner"></div></div>'
                        data-bs-toggle="tooltip" data-bs-placement="right" title="Collapse"></i>
                    <i class="bi-arrow-bar-right navbar-toggler-full-align"
                        data-bs-template='<div class="tooltip d-none d-md-block" role="tooltip"><div class="arrow"></div><div class="tooltip-inner"></div></div>'
                        data-bs-toggle="tooltip" data-bs-placement="right" title="Expand"></i>
                </button>

                <!-- End Navbar Vertical Toggle -->
            </div>

            <div class="navbar-nav-wrap-content-end">
                <!-- Navbar -->
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <!-- Account -->
                        <div class="dropdown">
                            <a class="navbar-dropdown-account-wrapper" href="javascript:;" id="accountNavbarDropdown"
                                data-bs-toggle="dropdown" aria-expanded="false" data-bs-auto-close="outside"
                                data-bs-dropdown-animation>
                                <div class="avatar avatar-sm avatar-circle">
                                    <img class="avatar-img" src="{{ asset('dist') }}/assets/img/160x160/img6.jpg"
                                        alt="Image Description">
                                    <span class="avatar-status avatar-sm-status avatar-status-success"></span>
                                </div>
                            </a>

                            <div class="dropdown-menu dropdown-menu-end navbar-dropdown-menu navbar-dropdown-menu-borderless navbar-dropdown-account"
                                aria-labelledby="accountNavbarDropdown" style="width: 16rem;">
                                <div class="dropdown-item-text">
                                    <div class="d-flex align-items-center">
                                        <div class="avatar avatar-sm avatar-circle">
                                            <img class="avatar-img"
                                                src="{{ asset('dist') }}/assets/img/160x160/img6.jpg"
                                                alt="Image Description">
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <h5 class="mb-0">Mark Williams</h5>
                                            <p class="card-text text-body">mark@site.com</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="dropdown-divider"></div>

                                <a class="dropdown-item" href="#">Profile &amp; account</a>
                                <a class="dropdown-item" href="#">Settings</a>

                                <div class="dropdown-divider"></div>

                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                    this.closest('form').submit();">Sign
                                        out</button>
                                </form>
                            </div>
                        </div>
                        <!-- End Account -->
                    </li>
                </ul>
                <!-- End Navbar -->
            </div>
        </div>
    </header>

    <!-- ========== END HEADER ========== -->

    <!-- ========== MAIN CONTENT ========== -->
    <!-- Navbar Vertical -->

    <aside
        class="bg-white js-navbar-vertical-aside navbar navbar-vertical-aside navbar-vertical navbar-vertical-fixed navbar-expand-xl navbar-bordered ">
        <div class="navbar-vertical-container">
            <div class="navbar-vertical-footer-offset mt-3">
                <!-- Logo -->

                <a class="navbar-brand" href="{{route('admin.dashboard')}}" aria-label="Front">
                    <img class="navbar-brand-logo" src="{{ asset('dist') }}/assets/svg/logos/logoyhc.png"
                        alt="Logo" data-hs-theme-appearance="default">
                    <img class="navbar-brand-logo" src="{{ asset('dist') }}/assets/svg/logos-light/logoyhc.png"
                        alt="Logo" data-hs-theme-appearance="dark">

                    <img class="navbar-brand-logo-mini"
                        src="{{ asset('dist') }}/assets/svg/logos/logoyhcshort.png" alt="Logo"
                        data-hs-theme-appearance="default">

                    <img class="navbar-brand-logo-mini"
                        src="{{ asset('dist') }}/assets/svg/logos-light/logoyhcshort.png" alt="Logo"
                        data-hs-theme-appearance="dark">
                </a>

                <!-- End Logo -->

                <!-- Navbar Vertical Toggle -->
                <button type="button" class="js-navbar-vertical-aside-toggle-invoker navbar-aside-toggler">
                    <i class="bi-arrow-bar-left navbar-toggler-short-align"
                        data-bs-template='<div class="tooltip d-none d-md-block" role="tooltip"><div class="arrow"></div><div class="tooltip-inner"></div></div>'
                        data-bs-toggle="tooltip" data-bs-placement="right" title="Collapse"></i>
                    <i class="bi-arrow-bar-right navbar-toggler-full-align"
                        data-bs-template='<div class="tooltip d-none d-md-block" role="tooltip"><div class="arrow"></div><div class="tooltip-inner"></div></div>'
                        data-bs-toggle="tooltip" data-bs-placement="right" title="Expand"></i>
                </button>

                <!-- End Navbar Vertical Toggle -->

                <!-- Content -->
                <div class="navbar-vertical-content">
                    <div id="navbarVerticalMenu" class="nav nav-pills nav-vertical card-navbar-nav">

                        <span class="dropdown-header">Homepage</span>
                        <small class="bi-three-dots nav-subtitle-replacer"></small>

                        <div class="nav-item">
                            <a class="nav-link {{ Request()->routeIs('admin.dashboard') ? 'active' : '' }}"
                                href="{{ route('admin.dashboard') }}" data-placement="left">
                                <i class="bi-layers nav-icon"></i>
                                <span class="nav-link-title">Dashboard</span>
                            </a>
                        </div>

                        <div class="nav-item">
                            <a class="nav-link {{ Request()->routeIs('admin.gallery.*') ? 'active' : '' }}"
                                href="{{ route('admin.gallery.index') }}" data-placement="left">
                                <i class="bi-book nav-icon"></i>
                                <span class="nav-link-title">Gallery</span>
                            </a>
                        </div>

                        <div class="nav-item">
                            <a class="nav-link {{ Request()->routeIs('admin.event.*') ? 'active' : '' }}"
                                href="{{ route('admin.event.index') }}" data-placement="left">
                                <i class="bi-bell nav-icon"></i>
                                <span class="nav-link-title">Event</span>
                            </a>
                        </div>

                        <div class="nav-item">
                            <a class="nav-link {{ Request()->routeIs('admin.academic.*') ? 'active' : '' }}" href="{{ route('admin.academic.index') }}" data-placement="left">
                                <i class="bi-book nav-icon"></i>
                                <span class="nav-link-title">Academic</span>
                            </a>
                        </div>

                        <div class="nav-item">
                            <a class="nav-link dropdown-toggle" role="button" data-bs-toggle="collapse"
                                data-bs-target="#navbarVerticalMenuPagesUsersMenu" aria-expanded="truephp"
                                aria-controls="navbarVerticalMenuPagesUsersMenu">
                                <i class="bi  bi-newspaper nav-icon"></i>
                                <span class="nav-link-title">News</span>
                            </a>

                            <div id="navbarVerticalMenuPagesUsersMenu" class="nav-collapse collapse show"
                                data-bs-parent="#navbarVerticalMenuPagesMenu" hs-parent-area="#navbarVerticalMenu"
                                style="">
                                <a class="nav-link {{ Request()->routeIs('admin.news.*') ? 'active' : '' }}"
                                    href="{{ route('admin.news.index') }}">
                                    <i class="bi bi-caret-right-fill nav-icon"></i>
                                    View
                                </a>
                                <a class="nav-link {{ Request()->routeIs('admin.news-category.*') ? 'active' : '' }}"
                                    href="{{ route('admin.news-category.index') }}">
                                    <i class="bi bi-caret-right-fill nav-icon"></i>
                                    News Category
                                </a>


                            </div>
                        </div>

                        <span class="dropdown-header mt-4">Profile</span>
                      <small class="bi-three-dots nav-subtitle-replacer"></small>
                      <div class="navbar-nav nav-compact">

                      </div>
                      <div id="navbarVerticalMenuPagesMenu">
                        <!-- Collapse -->
                        <div class="nav-item">
                            <a class="nav-link {{ Request()->routeIs('admin.about.*') ? 'active' : '' }}" href="{{ route('admin.about.index') }}" data-placement="left" >
                                <i class="bi bi-person nav-icon"></i>
                                <span class="nav-link-title">About</span>
                            </a>
                        </div>

                        <!-- End Collapse -->

                        <!-- Collapse -->
                        <div class="nav-item">
                          <a class="nav-link {{ Request()->routeIs('admin.leader.*') ? 'active' : '' }}" href="{{ route('admin.leader.index') }}">
                            <i class="bi-person-badge nav-icon"></i>
                            <span class="nav-link-title">Leader</span>
                          </a>
                        </div>
                        <!-- End Collapse -->

                        <!-- Collapse -->
                        <div class="nav-item">
                          <a class="nav-link {{ Request()->routeIs('admin.staff.*') ? 'active' : '' }}  " href="{{ route('admin.staff.index') }}">
                            <i class="bi-people nav-icon"></i>
                            <span class="nav-link-title">Staff</span>
                          </a>
                        </div>
                        <div class="nav-item">
                          <a class="nav-link {{ Request()->routeIs('admin.campustour.*') ? 'active' : '' }}  " href="{{ route('admin.campustour.index') }}" >
                            <i class="bi bi-building nav-icon"></i>
                            <span class="nav-link-title">Campus Tour</span>
                          </a>
                        </div>
                    </div>



                        <span class="dropdown-header mt-3">Information</span>

                        <div class="nav-item">
                            <a class="nav-link {{ Request()->routeIs('admin.career.*') ? 'active' : '' }}" href="{{ route('admin.career.index') }}" data-placement="left">
                                <i class="bi bi-file-person nav-icon"></i>
                                <span class="nav-link-title">Career</span>
                            </a>
                        </div>

                        <div class="nav-item">
                            <a class="nav-link {{ Request()->routeIs('admin.job.*') ? 'active' : '' }}" href="{{ route('admin.job.index') }}" data-placement="left">
                                <i class="bi bi-briefcase nav-icon"></i>
                                <span class="nav-link-title">Job</span>
                            </a>
                        </div>

                        <span class="dropdown-header mt-3">Program</span>

                        <div class="nav-item">
                            <a class="nav-link {{ Request()->routeIs('admin.streams.*') ? 'active' : '' }}" href="{{ route('admin.streams.index') }}" data-placement="left">
                                <i class="bi-signpost-2 nav-icon"></i>
                                <span class="nav-link-title">Streams</span>
                            </a>
                        </div>
                        <div class="nav-item">
                            <a class="nav-link {{ Request()->routeIs('admin.excul.*') ? 'active' : '' }}" href="{{ route('admin.excul.index') }}" data-placement="left">
                                <i class="bi-kanban nav-icon"></i>
                                <span class="nav-link-title">Extracurricullar</span>
                            </a>
                        </div>

                        <div class="nav-item">
                            <a class="nav-link {{ Request()->routeIs('admin.achievement.*') ? 'active' : '' }}" href="{{ route('admin.achievement.index') }}" data-placement="left">
                                <i class="bi-trophy nav-icon"></i>
                                <span class="nav-link-title">Achievement</span>
                            </a>
                        </div>

                        <div class="nav-item">
                            <a class="nav-link {{ Request()->routeIs('admin.unggulan.*') ? 'active' : '' }}" href="{{ route('admin.unggulan.index') }}" data-placement="left">
                                <i class="bi-bookmark-check-fill nav-icon"></i>
                                <span class="nav-link-title">Program Unggulan</span>
                            </a>
                        </div>
                        
                        <div class="nav-item">
                            <a class="nav-link dropdown-toggle collapsed {{ Request()->routeIs('admin.article.*') || Request()->routeIs('admin.article-category.*') || Request()->routeIs('admin.comment') ? 'active bg-secondary bg-opacity-10 text-black' : '' }}"
                                href="#" role="button" data-bs-toggle="collapse"
                                data-bs-target="#shopCategoriesThree" aria-expanded="false"
                                aria-controls="shopCategoriesThree">
                                <i class="bi bi-layout-text-sidebar-reverse nav-icon"></i> Article
                            </a>

                            <div id="shopCategoriesThree"
                                class="nav-collapse collapse {{ Request()->routeIs('admin.article.*') || Request()->routeIs('admin.article-category.*') || Request()->routeIs('admin.comment') ? 'show' : '' }}"
                                data-bs-parent="#shopNavCategories">
                                <div id="shopNavCategoriesThree">
                                    <a class="nav-link {{ Request()->routeIs('admin.article.*') ? 'active' : '' }}"
                                        href="{{ route('admin.article.index') }}">Articles</a>

                                    <a class="nav-link {{ Request()->routeIs('admin.article-category.*') ? 'active' : '' }}"
                                        href="{{ route('admin.article-category.index') }}">Article Category</a>

                                    {{--  <a class="nav-link {{ Request()->routeIs('admin.comment') ? 'active' : '' }}"
                                        href="{{ route('admin.comment') }}">Article Comment</a>  --}}
                                </div>
                            </div>

                        </div>
                        <!-- End Content -->

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
                    <img class="avatar avatar-xss avatar-circle" src="{{asset('dist')}}/assets/vendor/flag-icon-css/flags/1x1/us.svg" alt="United States Flag">
                  </button>

                  <div class="dropdown-menu navbar-dropdown-menu-borderless" aria-labelledby="selectLanguageDropdown">
                    <span class="dropdown-header">Select language</span>
                    <a class="dropdown-item" href="#">
                      <img class="avatar avatar-xss avatar-circle me-2" src="{{asset('dist')}}/assets/vendor/flag-icon-css/flags/1x1/us.svg" alt="Flag">
                      <span class="text-truncate" title="English">English (US)</span>
                    </a>
                    <a class="dropdown-item" href="#">
                      <img class="avatar avatar-xss avatar-circle me-2" src="{{asset('dist')}}/assets/vendor/flag-icon-css/flags/1x1/gb.svg" alt="Flag">
                      <span class="text-truncate" title="English">English (UK)</span>
                    </a>
                    <a class="dropdown-item" href="#">
                      <img class="avatar avatar-xss avatar-circle me-2" src="{{asset('dist')}}/assets/vendor/flag-icon-css/flags/1x1/de.svg" alt="Flag">
                      <span class="text-truncate" title="Deutsch">Deutsch</span>
                    </a>
                    <a class="dropdown-item" href="#">
                      <img class="avatar avatar-xss avatar-circle me-2" src="{{asset('dist')}}/assets/vendor/flag-icon-css/flags/1x1/dk.svg" alt="Flag">
                      <span class="text-truncate" title="Dansk">Dansk</span>
                    </a>
                    <a class="dropdown-item" href="#">
                      <img class="avatar avatar-xss avatar-circle me-2" src="{{asset('dist')}}/assets/vendor/flag-icon-css/flags/1x1/it.svg" alt="Flag">
                      <span class="text-truncate" title="Italiano">Italiano</span>
                    </a>
                    <a class="dropdown-item" href="#">
                      <img class="avatar avatar-xss avatar-circle me-2" src="{{asset('dist')}}/assets/vendor/flag-icon-css/flags/1x1/cn.svg" alt="Flag">
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
        {{ $slot }}


        <div class="footer">
            <div class="row justify-content-between align-items-center">
                <div class="col">
                    <p class="mb-0 fs-6">&copy; Front. <span class="d-none d-sm-inline-block">2022
                            Htmlstream.</span></p>
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
                                <button class="btn btn-ghost-secondary btn-icon rounded-circle" type="button"
                                    data-bs-toggle="offcanvas" data-bs-target="#offcanvasKeyboardShortcuts"
                                    aria-controls="offcanvasKeyboardShortcuts">
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
    </main>

    <!-- Keyboard Shortcuts -->
    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasKeyboardShortcuts"
        aria-labelledby="offcanvasKeyboardShortcutsLabel">
        <div class="offcanvas-header">
            <h4 id="offcanvasKeyboardShortcutsLabel" class="mb-0">Keyboard shortcuts</h4>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <div class="mb-5 list-group list-group-sm list-group-flush list-group-no-gutters">
                <div class="list-group-item">
                    <h5 class="mb-1">Formatting</h5>
                </div>
                <div class="list-group-item">
                    <div class="row align-items-center">
                        <div class="col-5">
                            <span class="fw-semibold">Bold</span>
                        </div>
                        <!-- End Col -->

                        <div class="col-7 text-end">
                            <kbd class="mb-1 d-inline-block">Ctrl</kbd> <span class="text-muted small">+</span> <kbd
                                class="mb-1 d-inline-block">b</kbd>
                        </div>
                    </div>
                    <!-- End Row -->
                </div>

                <div class="list-group-item">
                    <div class="row align-items-center">
                        <div class="col-5">
                            <em>italic</em>
                        </div>
                        <!-- End Col -->

                        <div class="col-7 text-end">
                            <kbd class="mb-1 d-inline-block">Ctrl</kbd> <span class="text-muted small">+</span> <kbd
                                class="mb-1 d-inline-block">i</kbd>
                        </div>
                        <!-- End Col -->
                    </div>
                    <!-- End Row -->
                </div>

                <div class="list-group-item">
                    <div class="row align-items-center">
                        <div class="col-5">
                            <u>Underline</u>
                        </div>
                        <!-- End Col -->

                        <div class="col-7 text-end">
                            <kbd class="mb-1 d-inline-block">Ctrl</kbd> <span class="text-muted small">+</span> <kbd
                                class="mb-1 d-inline-block">u</kbd>
                        </div>
                        <!-- End Col -->
                    </div>
                    <!-- End Row -->
                </div>

                <div class="list-group-item">
                    <div class="row align-items-center">
                        <div class="col-5">
                            <s>Strikethrough</s>
                        </div>
                        <!-- End Col -->

                        <div class="col-7 text-end">
                            <kbd class="mb-1 d-inline-block">Ctrl</kbd> <span class="text-muted small">+</span> <kbd
                                class="mb-1 d-inline-block">Alt</kbd> <span class="text-muted small">+</span> <kbd
                                class="mb-1 d-inline-block">s</kbd>
                            <!-- End Col -->
                        </div>
                    </div>
                    <!-- End Row -->
                </div>

                <div class="list-group-item">
                    <div class="row align-items-center">
                        <div class="col-5">
                            <span class="small">Small text</span>
                        </div>
                        <!-- End Col -->

                        <div class="col-7 text-end">
                            <kbd class="mb-1 d-inline-block">Ctrl</kbd> <span class="text-muted small">+</span> <kbd
                                class="mb-1 d-inline-block">s</kbd>
                        </div>
                        <!-- End Col -->
                    </div>
                    <!-- End Row -->
                </div>

                <div class="list-group-item">
                    <div class="row align-items-center">
                        <div class="col-5">
                            <mark>Highlight</mark>
                        </div>
                        <!-- End Col -->

                        <div class="col-7 text-end">
                            <kbd class="mb-1 d-inline-block">Ctrl</kbd> <span class="text-muted small">+</span> <kbd
                                class="mb-1 d-inline-block">e</kbd>
                        </div>
                        <!-- End Col -->
                    </div>
                    <!-- End Row -->
                </div>

            </div>

            <div class="mb-5 list-group list-group-sm list-group-flush list-group-no-gutters">
                <div class="list-group-item">
                    <h5 class="mb-1">Insert</h5>
                </div>
                <div class="list-group-item">
                    <div class="row align-items-center">
                        <div class="col-5">
                            <span>Mention person <a href="#">(@Brian)</a></span>
                        </div>
                        <!-- End Col -->

                        <div class="col-7 text-end">
                            <kbd class="mb-1 d-inline-block">@</kbd>
                        </div>
                        <!-- End Col -->
                    </div>
                    <!-- End Row -->
                </div>

                <div class="list-group-item">
                    <div class="row align-items-center">
                        <div class="col-5">
                            <span>Link to doc <a href="#">(+Meeting notes)</a></span>
                        </div>
                        <!-- End Col -->

                        <div class="col-7 text-end">
                            <kbd class="mb-1 d-inline-block">+</kbd>
                        </div>
                        <!-- End Col -->
                    </div>
                    <!-- End Row -->
                </div>

                <div class="list-group-item">
                    <div class="row align-items-center">
                        <div class="col-5">
                            <a href="#">#hashtag</a>
                        </div>
                        <!-- End Col -->

                        <div class="col-7 text-end">
                            <kbd class="mb-1 d-inline-block">#hashtag</kbd>
                        </div>
                        <!-- End Col -->
                    </div>
                    <!-- End Row -->
                </div>

                <div class="list-group-item">
                    <div class="row align-items-center">
                        <div class="col-5">
                            <span>Date</span>
                        </div>
                        <!-- End Col -->

                        <div class="col-7 text-end">
                            <kbd class="mb-1 d-inline-block">/date</kbd>
                            <kbd class="mb-1 d-inline-block">Space</kbd>
                            <kbd class="mb-1 d-inline-block">/datetime</kbd>
                            <kbd class="mb-1 d-inline-block">/datetime</kbd>
                            <kbd class="mb-1 d-inline-block">Space</kbd>
                        </div>
                        <!-- End Col -->
                    </div>
                    <!-- End Row -->
                </div>

                <div class="list-group-item">
                    <div class="row align-items-center">
                        <div class="col-5">
                            <span>Time</span>
                        </div>
                        <!-- End Col -->

                        <div class="col-7 text-end">
                            <kbd class="mb-1 d-inline-block">/time</kbd>
                            <kbd class="mb-1 d-inline-block">Space</kbd>
                        </div>
                        <!-- End Col -->
                    </div>
                    <!-- End Row -->
                </div>

                <div class="list-group-item">
                    <div class="row align-items-center">
                        <div class="col-5">
                            <span>Note box</span>
                        </div>
                        <!-- End Col -->

                        <div class="col-7 text-end">
                            <kbd class="mb-1 d-inline-block">/note</kbd>
                            <kbd class="mb-1 d-inline-block">Enter</kbd>
                            <kbd class="mb-1 d-inline-block">/note red</kbd>
                            <kbd class="mb-1 d-inline-block">/note red</kbd>
                            <kbd class="mb-1 d-inline-block">Enter</kbd>
                        </div>
                        <!-- End Col -->
                    </div>
                    <!-- End Row -->
                </div>

            </div>

            <div class="mb-5 list-group list-group-sm list-group-flush list-group-no-gutters">
                <div class="list-group-item">
                    <h5 class="mb-1">Editing</h5>
                </div>
                <div class="list-group-item">
                    <div class="row align-items-center">
                        <div class="col-5">
                            <span>Find and replace</span>
                        </div>
                        <!-- End Col -->

                        <div class="col-7 text-end">
                            <kbd class="mb-1 d-inline-block">Ctrl</kbd> <span class="text-muted small">+</span> <kbd
                                class="mb-1 d-inline-block">r</kbd>
                        </div>
                        <!-- End Col -->
                    </div>
                    <!-- End Row -->
                </div>

                <div class="list-group-item">
                    <div class="row align-items-center">
                        <div class="col-5">
                            <span>Find next</span>
                        </div>
                        <!-- End Col -->

                        <div class="col-7 text-end">
                            <kbd class="mb-1 d-inline-block">Ctrl</kbd> <span class="text-muted small">+</span> <kbd
                                class="mb-1 d-inline-block">n</kbd>
                        </div>
                        <!-- End Col -->
                    </div>
                    <!-- End Row -->
                </div>

                <div class="list-group-item">
                    <div class="row align-items-center">
                        <div class="col-5">
                            <span>Find previous</span>
                        </div>
                        <!-- End Col -->

                        <div class="col-7 text-end">
                            <kbd class="mb-1 d-inline-block">Ctrl</kbd> <span class="text-muted small">+</span> <kbd
                                class="mb-1 d-inline-block">p</kbd>
                        </div>
                        <!-- End Col -->
                    </div>
                    <!-- End Row -->
                </div>

                <div class="list-group-item">
                    <div class="row align-items-center">
                        <div class="col-5">
                            <span>Indent</span>
                        </div>
                        <!-- End Col -->

                        <div class="col-7 text-end">
                            <kbd class="mb-1 d-inline-block">Tab</kbd>
                        </div>
                        <!-- End Col -->
                    </div>
                    <!-- End Row -->
                </div>

                <div class="list-group-item">
                    <div class="row align-items-center">
                        <div class="col-5">
                            <span>Un-indent</span>
                        </div>
                        <!-- End Col -->

                        <div class="col-7 text-end">
                            <kbd class="mb-1 d-inline-block">Shift</kbd> <span class="text-muted small">+</span>
                            <kbd class="mb-1 d-inline-block">Tab</kbd>
                        </div>
                        <!-- End Col -->
                    </div>
                    <!-- End Row -->
                </div>

                <div class="list-group-item">
                    <div class="row align-items-center">
                        <div class="col-5">
                            <span>Move line up</span>
                        </div>
                        <!-- End Col -->

                        <div class="col-7 text-end">
                            <kbd class="mb-1 d-inline-block">Ctrl</kbd> <span class="text-muted small">+</span> <kbd
                                class="mb-1 d-inline-block">Shift</kbd> <span class="text-muted small">+</span> <kbd
                                class="mb-1 d-inline-block"><i class="bi-arrow-up-short"></i></kbd>
                        </div>
                        <!-- End Col -->
                    </div>
                    <!-- End Row -->
                </div>

                <div class="list-group-item">
                    <div class="row align-items-center">
                        <div class="col-5">
                            <span>Move line down</span>
                        </div>
                        <!-- End Col -->

                        <div class="col-7 text-end">
                            <kbd class="mb-1 d-inline-block">Ctrl</kbd> <span class="text-muted small">+</span> <kbd
                                class="mb-1 d-inline-block">Shift</kbd> <span class="text-muted small">+</span> <kbd
                                class="mb-1 d-inline-block"><i class="bi-arrow-down-short fs-5"></i></kbd>
                        </div>
                        <!-- End Col -->
                    </div>
                    <!-- End Row -->
                </div>

                <div class="list-group-item">
                    <div class="row align-items-center">
                        <div class="col-5">
                            <span>Add a comment</span>
                        </div>
                        <!-- End Col -->

                        <div class="col-7 text-end">
                            <kbd class="mb-1 d-inline-block">Ctrl</kbd> <span class="text-muted small">+</span> <kbd
                                class="mb-1 d-inline-block">Alt</kbd> <span class="text-muted small">+</span> <kbd
                                class="mb-1 d-inline-block">m</kbd>
                        </div>
                        <!-- End Col -->
                    </div>
                    <!-- End Row -->
                </div>

                <div class="list-group-item">
                    <div class="row align-items-center">
                        <div class="col-5">
                            <span>Undo</span>
                        </div>
                        <!-- End Col -->

                        <div class="col-7 text-end">
                            <kbd class="mb-1 d-inline-block">Ctrl</kbd> <span class="text-muted small">+</span> <kbd
                                class="mb-1 d-inline-block">z</kbd>
                        </div>
                        <!-- End Col -->
                    </div>
                    <!-- End Row -->
                </div>

                <div class="list-group-item">
                    <div class="row align-items-center">
                        <div class="col-5">
                            <span>Redo</span>
                        </div>
                        <!-- End Col -->

                        <div class="col-7 text-end">
                            <kbd class="mb-1 d-inline-block">Ctrl</kbd> <span class="text-muted small">+</span> <kbd
                                class="mb-1 d-inline-block">y</kbd>
                        </div>
                        <!-- End Col -->
                    </div>
                    <!-- End Row -->
                </div>

            </div>

            <div class="list-group list-group-sm list-group-flush list-group-no-gutters">
                <div class="list-group-item">
                    <h5 class="mb-1">Application</h5>
                </div>
                <div class="list-group-item">
                    <div class="row align-items-center">
                        <div class="col-5">
                            <span>Create new doc</span>
                        </div>
                        <!-- End Col -->

                        <div class="col-7 text-end">
                            <kbd class="mb-1 d-inline-block">Ctrl</kbd> <span class="text-muted small">+</span> <kbd
                                class="mb-1 d-inline-block">Alt</kbd> <span class="text-muted small">+</span> <kbd
                                class="mb-1 d-inline-block">n</kbd>
                        </div>
                        <!-- End Col -->
                    </div>
                    <!-- End Row -->
                </div>

                <div class="list-group-item">
                    <div class="row align-items-center">
                        <div class="col-5">
                            <span>Present</span>
                        </div>
                        <!-- End Col -->

                        <div class="col-7 text-end">
                            <kbd class="mb-1 d-inline-block">Ctrl</kbd> <span class="text-muted small">+</span> <kbd
                                class="mb-1 d-inline-block">Shift</kbd> <span class="text-muted small">+</span> <kbd
                                class="mb-1 d-inline-block">p</kbd>
                        </div>
                        <!-- End Col -->
                    </div>
                    <!-- End Row -->
                </div>

                <div class="list-group-item">
                    <div class="row align-items-center">
                        <div class="col-5">
                            <span>Share</span>
                        </div>
                        <!-- End Col -->

                        <div class="col-7 text-end">
                            <kbd class="mb-1 d-inline-block">Ctrl</kbd> <span class="text-muted small">+</span> <kbd
                                class="mb-1 d-inline-block">Shift</kbd> <span class="text-muted small">+</span> <kbd
                                class="mb-1 d-inline-block">s</kbd>
                        </div>
                        <!-- End Col -->
                    </div>
                    <!-- End Row -->
                </div>

                <div class="list-group-item">
                    <div class="row align-items-center">
                        <div class="col-5">
                            <span>Search docs</span>
                        </div>
                        <!-- End Col -->

                        <div class="col-7 text-end">
                            <kbd class="mb-1 d-inline-block">Ctrl</kbd> <span class="text-muted small">+</span> <kbd
                                class="mb-1 d-inline-block">Shift</kbd> <span class="text-muted small">+</span> <kbd
                                class="mb-1 d-inline-block">o</kbd>
                        </div>
                        <!-- End Col -->
                    </div>
                    <!-- End Row -->
                </div>

                <div class="list-group-item">
                    <div class="row align-items-center">
                        <div class="col-5">
                            <span>Keyboard shortcuts</span>
                        </div>
                        <!-- End Col -->

                        <div class="col-7 text-end">
                            <kbd class="mb-1 d-inline-block">Ctrl</kbd> <span class="text-muted small">+</span> <kbd
                                class="mb-1 d-inline-block">Shift</kbd> <span class="text-muted small">+</span> <kbd
                                class="mb-1 d-inline-block">/</kbd>
                        </div>
                        <!-- End Col -->
                    </div>
                    <!-- End Row -->
                </div>

            </div>
        </div>
    </div>
    <!-- End Keyboard Shortcuts -->

    <!-- Activity -->
    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasActivityStream"
        aria-labelledby="offcanvasActivityStreamLabel">
        <div class="offcanvas-header">
            <h4 id="offcanvasActivityStreamLabel" class="mb-0">Activity stream</h4>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <!-- Step -->
            <ul class="step step-icon-sm step-avatar-sm">
                <!-- Step Item -->
                <li class="step-item">
                    <div class="step-content-wrapper">
                        <div class="step-avatar">
                            <img class="step-avatar" src="{{ asset('dist') }}/assets/img/160x160/img9.jpg"
                                alt="Image Description">
                        </div>

                        <div class="step-content">
                            <h5 class="mb-1">Iana Robinson</h5>

                            <p class="mb-1 fs-5">Added 2 files to task <a class="text-uppercase" href="#"><i
                                        class="bi-journal-bookmark-fill"></i> Fd-7</a></p>

                            <ul class="list-group list-group-sm">
                                <!-- List Item -->
                                <li class="list-group-item list-group-item-light">
                                    <div class="row gx-1">
                                        <div class="col-6">
                                            <!-- Media -->
                                            <div class="d-flex">
                                                <div class="flex-shrink-0">
                                                    <img class="avatar avatar-xs"
                                                        src="{{ asset('dist') }}/assets/svg/brands/excel-icon.svg"
                                                        alt="Image Description">
                                                </div>
                                                <div class="flex-grow-1 text-truncate ms-2">
                                                    <span class="d-block fs-6 text-dark text-truncate"
                                                        title="weekly-reports.xls">weekly-reports.xls</span>
                                                    <span class="d-block small text-muted">12kb</span>
                                                </div>
                                            </div>
                                            <!-- End Media -->
                                        </div>
                                        <!-- End Col -->

                                        <div class="col-6">
                                            <!-- Media -->
                                            <div class="d-flex">
                                                <div class="flex-shrink-0">
                                                    <img class="avatar avatar-xs"
                                                        src="{{ asset('dist') }}/assets/svg/brands/word-icon.svg"
                                                        alt="Image Description">
                                                </div>
                                                <div class="flex-grow-1 text-truncate ms-2">
                                                    <span class="d-block fs-6 text-dark text-truncate"
                                                        title="weekly-reports.xls">weekly-reports.xls</span>
                                                    <span class="d-block small text-muted">4kb</span>
                                                </div>
                                            </div>
                                            <!-- End Media -->
                                        </div>
                                        <!-- End Col -->
                                    </div>
                                    <!-- End Row -->
                                </li>
                                <!-- End List Item -->
                            </ul>

                            <span class="small text-muted text-uppercase">Now</span>
                        </div>
                    </div>
                </li>
                <!-- End Step Item -->

                <!-- Step Item -->
                <li class="step-item">
                    <div class="step-content-wrapper">
                        <span class="step-icon step-icon-soft-dark">B</span>

                        <div class="step-content">
                            <h5 class="mb-1">Bob Dean</h5>

                            <p class="mb-1 fs-5">Marked <a class="text-uppercase" href="#"><i
                                        class="bi-journal-bookmark-fill"></i> Fr-6</a> as <span
                                    class="badge bg-soft-success text-success rounded-pill"><span
                                        class="legend-indicator bg-success"></span>"Completed"</span></p>

                            <span class="small text-muted text-uppercase">Today</span>
                        </div>
                    </div>
                </li>
                <!-- End Step Item -->

                <!-- Step Item -->
                <li class="step-item">
                    <div class="step-content-wrapper">
                        <div class="step-avatar">
                            <img class="step-avatar-img" src="{{ asset('dist') }}/assets/img/160x160/img3.jpg"
                                alt="Image Description">
                        </div>

                        <div class="step-content">
                            <h5 class="mb-1 h5">Crane</h5>

                            <p class="mb-1 fs-5">Added 5 card to <a href="#">Payments</a></p>

                            <ul class="list-group list-group-sm">
                                <li class="list-group-item list-group-item-light">
                                    <div class="row gx-1">
                                        <div class="col">
                                            <img class="rounded img-fluid"
                                                src="{{ asset('dist') }}/assets/svg/components/card-1.svg"
                                                alt="Image Description">
                                        </div>
                                        <div class="col">
                                            <img class="rounded img-fluid"
                                                src="{{ asset('dist') }}/assets/svg/components/card-2.svg"
                                                alt="Image Description">
                                        </div>
                                        <div class="col">
                                            <img class="rounded img-fluid"
                                                src="{{ asset('dist') }}/assets/svg/components/card-3.svg"
                                                alt="Image Description">
                                        </div>
                                        <div class="col-auto align-self-center">
                                            <div class="text-center">
                                                <a href="#">+2</a>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>

                            <span class="small text-muted text-uppercase">May 12</span>
                        </div>
                    </div>
                </li>
                <!-- End Step Item -->

                <!-- Step Item -->
                <li class="step-item">
                    <div class="step-content-wrapper">
                        <span class="step-icon step-icon-soft-info">D</span>

                        <div class="step-content">
                            <h5 class="mb-1">David Lidell</h5>

                            <p class="mb-1 fs-5">Added a new member to Front Dashboard</p>

                            <span class="small text-muted text-uppercase">May 15</span>
                        </div>
                    </div>
                </li>
                <!-- End Step Item -->

                <!-- Step Item -->
                <li class="step-item">
                    <div class="step-content-wrapper">
                        <div class="step-avatar">
                            <img class="step-avatar-img" src="{{ asset('dist') }}/assets/img/160x160/img7.jpg"
                                alt="Image Description">
                        </div>

                        <div class="step-content">
                            <h5 class="mb-1">Rachel King</h5>

                            <p class="mb-1 fs-5">Marked <a class="text-uppercase" href="#"><i
                                        class="bi-journal-bookmark-fill"></i> Fr-3</a> as <span
                                    class="badge bg-soft-success text-success rounded-pill"><span
                                        class="legend-indicator bg-success"></span>"Completed"</span></p>

                            <span class="small text-muted text-uppercase">Apr 29</span>
                        </div>
                    </div>
                </li>
                <!-- End Step Item -->

                <!-- Step Item -->
                <li class="step-item">
                    <div class="step-content-wrapper">
                        <div class="step-avatar">
                            <img class="step-avatar-img" src="{{ asset('dist') }}/assets/img/160x160/img5.jpg"
                                alt="Image Description">
                        </div>

                        <div class="step-content">
                            <h5 class="mb-1">Finch Hoot</h5>

                            <p class="mb-1 fs-5">Earned a "Top endorsed" <i
                                    class="bi-patch-check-fill text-primary"></i> badge</p>

                            <span class="small text-muted text-uppercase">Apr 06</span>
                        </div>
                    </div>
                </li>
                <!-- End Step Item -->

                <!-- Step Item -->
                <li class="step-item">
                    <div class="step-content-wrapper">
                        <span class="step-icon step-icon-soft-primary">
                            <i class="bi-person-fill"></i>
                        </span>

                        <div class="step-content">
                            <h5 class="mb-1">Project status updated</h5>

                            <p class="mb-1 fs-5">Marked <a class="text-uppercase" href="#"><i
                                        class="bi-journal-bookmark-fill"></i> Fr-3</a> as <span
                                    class="badge bg-soft-primary text-primary rounded-pill"><span
                                        class="legend-indicator bg-primary"></span>"In progress"</span></p>

                            <span class="small text-muted text-uppercase">Feb 10</span>
                        </div>
                    </div>
                </li>
                <!-- End Step Item -->
            </ul>
            <!-- End Step -->

            <div class="d-grid">
                <a class="btn btn-white" href="javascript:;">View all <i class="bi-chevron-right"></i></a>
            </div>
        </div>
    </div>
    <!-- End Activity -->

    <!-- Welcome Message Modal -->
    <div class="modal fade" id="welcomeMessageModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <!-- Header -->
                <div class="modal-close">
                    <button type="button" class="btn btn-ghost-secondary btn-icon btn-sm" data-bs-dismiss="modal"
                        aria-label="Close">
                        <i class="bi-x-lg"></i>
                    </button>
                </div>
                <!-- End Header -->

                <!-- Body -->
                <div class="modal-body p-sm-5">
                    <div class="text-center">
                        <div class="mx-auto mb-4 w-75 w-sm-50">
                            <img class="img-fluid"
                                src="{{ asset('dist') }}/assets/svg/illustrations/oc-collaboration.svg"
                                alt="Image Description" data-hs-theme-appearance="default">
                            <img class="img-fluid"
                                src="{{ asset('dist') }}/assets/svg/illustrations-light/oc-collaboration.svg"
                                alt="Image Description" data-hs-theme-appearance="dark">
                        </div>

                        <h4 class="h1">Welcome to Front</h4>

                        <p>We're happy to see you in our community.</p>
                    </div>
                </div>
                <!-- End Body -->

                <!-- Footer -->
                <div class="text-center modal-footer d-block py-sm-5">
                    <small class="text-cap text-muted">Trusted by the world's best teams</small>

                    <div class="mx-auto w-85">
                        <div class="row justify-content-between">
                            <div class="col">
                                <img class="img-fluid" src="{{ asset('dist') }}/assets/svg/brands/gitlab-gray.svg"
                                    alt="Image Description">
                            </div>
                            <div class="col">
                                <img class="img-fluid" src="{{ asset('dist') }}/assets/svg/brands/fitbit-gray.svg"
                                    alt="Image Description">
                            </div>
                            <div class="col">
                                <img class="img-fluid" src="{{ asset('dist') }}/assets/svg/brands/flow-xo-gray.svg"
                                    alt="Image Description">
                            </div>
                            <div class="col">
                                <img class="img-fluid" src="{{ asset('dist') }}/assets/svg/brands/layar-gray.svg"
                                    alt="Image Description">
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Footer -->
            </div>
        </div>
    </div>

    <!-- End Welcome Message Modal -->

    <!-- Create a new user Modal -->
    <div class="modal fade" id="inviteUserModal" tabindex="-1" aria-labelledby="inviteUserModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="inviteUserModalLabel">Invite users</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <!-- Body -->
                <div class="modal-body">
                    <!-- Form -->
                    <div class="mb-4">
                        <div class="mb-2 input-group mb-sm-0">
                            <input type="text" class="form-control" name="fullName"
                                placeholder="Search name or emails" aria-label="Search name or emails">

                            <div class="input-group-append input-group-append-last-sm-down-none">
                                <!-- Select -->
                                <div class="tom-select-custom tom-select-custom-end">
                                    <select class="js-select form-select" autocomplete="off"
                                        data-hs-tom-select-options='{
                            "searchInDropdown": false,
                            "hideSearch": true,
                            "dropdownWidth": "11rem"
                          }'>
                                        <option value="guest" selected>Guest</option>
                                        <option value="can edit">Can edit</option>
                                        <option value="can comment">Can comment</option>
                                        <option value="full access">Full access</option>
                                    </select>
                                </div>
                                <!-- End Select -->

                                <a class="btn btn-primary d-none d-sm-inline-block" href="javascript:;">Invite</a>
                            </div>
                        </div>

                        <a class="btn btn-primary w-100 d-sm-none" href="javascript:;">Invite</a>
                    </div>
                    <!-- End Form -->

                    <div class="row">
                        <h5 class="col modal-title">Invite users</h5>

                        <div class="col-auto">
                            <a class="d-flex align-items-center small text-body" href="#">
                                <img class="avatar avatar-xss avatar-4x3 me-2"
                                    src="{{ asset('dist') }}/assets/svg/brands/gmail-icon.svg"
                                    alt="Image Description">
                                Import contacts
                            </a>
                        </div>
                    </div>

                    <hr class="mt-2">

                    <ul class="mb-0 list-unstyled list-py-2">
                        <!-- List Group Item -->
                        <li>
                            <div class="d-flex">
                                <div class="flex-shrink-0">
                                    <div class="avatar avatar-sm avatar-circle">
                                        <img class="avatar-img"
                                            src="{{ asset('dist') }}/assets/img/160x160/img10.jpg"
                                            alt="Image Description">
                                    </div>
                                </div>

                                <div class="flex-grow-1 ms-3">
                                    <div class="row align-items-center">
                                        <div class="col-sm">
                                            <h5 class="mb-0">Amanda Harvey <i
                                                    class="bi-patch-check-fill text-primary" data-toggle="tooltip"
                                                    data-placement="top" title="Top endorsed"></i></h5>
                                            <span class="d-block small">amanda@site.com</span>
                                        </div>

                                        <div class="col-sm-auto">
                                            <!-- Select -->
                                            <div class="tom-select-custom tom-select-custom-sm-end">
                                                <select
                                                    class="js-select form-select form-select-borderless tom-select-custom-form-select-invite-user tom-select-form-select-ps-0"
                                                    autocomplete="off"
                                                    data-hs-tom-select-options='{
                                  "searchInDropdown": false,
                                  "hideSearch": true,
                                  "dropdownWidth": "11rem"
                                }'>
                                                    <option value="guest" selected>Guest</option>
                                                    <option value="can edit">Can edit</option>
                                                    <option value="can comment">Can comment</option>
                                                    <option value="full access">Full access</option>
                                                    <option value="remove"
                                                        data-option-template='<div class="text-danger">Remove</div>'>
                                                        Remove</option>
                                                </select>
                                            </div>
                                            <!-- End Select -->
                                        </div>
                                    </div>
                                    <!-- End Row -->
                                </div>
                            </div>
                        </li>
                        <!-- End List Group Item -->

                        <!-- List Group Item -->
                        <li>
                            <div class="d-flex">
                                <div class="flex-shrink-0">
                                    <div class="avatar avatar-sm avatar-circle">
                                        <img class="avatar-img" src="{{ asset('dist') }}/assets/img/160x160/img3.jpg"
                                            alt="Image Description">
                                    </div>
                                </div>

                                <div class="flex-grow-1 ms-3">
                                    <div class="row align-items-center">
                                        <div class="col-sm">
                                            <h5 class="mb-0">David Harrison</h5>
                                            <span class="d-block small">david@site.com</span>
                                        </div>

                                        <div class="col-sm-auto">
                                            <!-- Select -->
                                            <div class="tom-select-custom tom-select-custom-sm-end">
                                                <select
                                                    class="js-select form-select form-select-borderless tom-select-custom-form-select-invite-user tom-select-form-select-ps-0"
                                                    autocomplete="off"
                                                    data-hs-tom-select-options='{
                                  "searchInDropdown": false,
                                  "hideSearch": true,
                                  "dropdownWidth": "11rem"
                                }'>
                                                    <option value="guest" selected>Guest</option>
                                                    <option value="can edit">Can edit</option>
                                                    <option value="can comment">Can comment</option>
                                                    <option value="full access">Full access</option>
                                                    <option value="remove"
                                                        data-option-template='<div class="text-danger">Remove</div>'>
                                                        Remove</option>
                                                </select>
                                            </div>
                                            <!-- End Select -->
                                        </div>
                                    </div>
                                    <!-- End Row -->
                                </div>
                            </div>
                        </li>
                        <!-- End List Group Item -->

                        <!-- List Group Item -->
                        <li>
                            <div class="d-flex">
                                <div class="flex-shrink-0">
                                    <div class="avatar avatar-sm avatar-circle">
                                        <img class="avatar-img" src="{{ asset('dist') }}/assets/img/160x160/img9.jpg"
                                            alt="Image Description">
                                    </div>
                                </div>

                                <div class="flex-grow-1 ms-3">
                                    <div class="row align-items-center">
                                        <div class="col-sm">
                                            <h5 class="mb-0">Ella Lauda <i class="bi-patch-check-fill text-primary"
                                                    data-toggle="tooltip" data-placement="top"
                                                    title="Top endorsed"></i></h5>
                                            <span class="d-block small">Markvt@site.com</span>
                                        </div>

                                        <div class="col-sm-auto">
                                            <!-- Select -->
                                            <div class="tom-select-custom tom-select-custom-sm-end">
                                                <select
                                                    class="js-select form-select form-select-borderless tom-select-custom-form-select-invite-user tom-select-form-select-ps-0"
                                                    autocomplete="off"
                                                    data-hs-tom-select-options='{
                                  "searchInDropdown": false,
                                  "hideSearch": true,
                                  "dropdownWidth": "11rem"
                                }'>
                                                    <option value="guest" selected>Guest</option>
                                                    <option value="can edit">Can edit</option>
                                                    <option value="can comment">Can comment</option>
                                                    <option value="full access">Full access</option>
                                                    <option value="remove"
                                                        data-option-template='<div class="text-danger">Remove</div>'>
                                                        Remove</option>
                                                </select>
                                            </div>
                                            <!-- End Select -->
                                        </div>
                                    </div>
                                    <!-- End Row -->
                                </div>
                            </div>
                        </li>
                        <!-- End List Group Item -->

                        <!-- List Group Item -->
                        <li>
                            <div class="d-flex">
                                <div class="flex-shrink-0">
                                    <div class="avatar avatar-sm avatar-soft-dark avatar-circle">
                                        <span class="avatar-initials">B</span>
                                    </div>
                                </div>

                                <div class="flex-grow-1 ms-3">
                                    <div class="row align-items-center">
                                        <div class="col-sm">
                                            <h5 class="mb-0">Bob Dean</h5>
                                            <span class="d-block small">bob@site.com</span>
                                        </div>

                                        <div class="col-sm-auto">
                                            <!-- Select -->
                                            <div class="tom-select-custom tom-select-custom-sm-end">
                                                <select
                                                    class="js-select form-select form-select-borderless tom-select-custom-form-select-invite-user tom-select-form-select-ps-0"
                                                    autocomplete="off"
                                                    data-hs-tom-select-options='{
                                  "searchInDropdown": false,
                                  "hideSearch": true,
                                  "dropdownWidth": "11rem"
                                }'>
                                                    <option value="guest" selected>Guest</option>
                                                    <option value="can edit">Can edit</option>
                                                    <option value="can comment">Can comment</option>
                                                    <option value="full access">Full access</option>
                                                    <option value="remove"
                                                        data-option-template='<div class="text-danger">Remove</div>'>
                                                        Remove</option>
                                                </select>
                                            </div>
                                            <!-- End Select -->
                                        </div>
                                    </div>
                                    <!-- End Row -->
                                </div>
                            </div>
                        </li>
                        <!-- End List Group Item -->
                    </ul>
                </div>
                <!-- End Body -->

                <!-- Footer -->
                <div class="modal-footer">
                    <div class="row align-items-center flex-grow-1 mx-n2">
                        <div class="mb-2 col-sm-9 mb-sm-0">
                            <input type="hidden" id="inviteUserPublicClipboard"
                                value="https://themes.getbootstrap.com/product/front-multipurpose-responsive-template/">

                            <p class="modal-footer-text">The public share <a href="#">link settings</a>
                                <i class="bi-question-circle" data-bs-toggle="tooltip" data-bs-placement="top"
                                    title="The public share link allows people to view the project without giving access to full collaboration features."></i>
                            </p>
                        </div>

                        <div class="col-sm-3 text-sm-end">
                            <a class="js-clipboard btn btn-white btn-sm text-nowrap" href="javascript:;"
                                data-bs-toggle="tooltip" data-bs-placement="top" title="Copy to clipboard!"
                                data-hs-clipboard-options='{
                  "type": "tooltip",
                  "successText": "Copied!",
                  "contentTarget": "#inviteUserPublicClipboard",
                  "container": "#inviteUserModal"
                 }'>
                                <i class="bi-link-45deg me-1"></i> Copy link</a>
                        </div>
                    </div>
                </div>
                <!-- End Footer -->
            </div>
        </div>
    </div>
    <!-- End Create a new user Modal -->
    <!-- ========== END SECONDARY CONTENTS ========== -->

    <!-- JS Global Compulsory  -->
    <script src="{{ asset('dist') }}/assets/vendor/jquery/dist/jquery.min.js"></script>
    <script src="{{ asset('dist') }}/assets/vendor/jquery-migrate/dist/jquery-migrate.min.js"></script>
    <script src="{{ asset('dist') }}/assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>

    <!-- JS Implementing Plugins -->
    <script src="{{ asset('dist') }}/assets/vendor/hs-navbar-vertical-aside/dist/hs-navbar-vertical-aside.min.js"></script>
    <script src="{{ asset('dist') }}/assets/vendor/hs-form-search/dist/hs-form-search.min.js"></script>

    <script src="{{ asset('dist') }}/assets/vendor/chart.js/dist/Chart.min.js"></script>
    <script src="{{ asset('dist') }}/assets/vendor/chartjs-chart-matrix/dist/chartjs-chart-matrix.min.js"></script>
    <script src="{{ asset('dist') }}/assets/vendor/chartjs-plugin-datalabels/dist/chartjs-plugin-datalabels.min.js">
    </script>
    <script src="{{ asset('dist') }}/assets/vendor/daterangepicker/moment.min.js"></script>
    <script src="{{ asset('dist') }}/assets/vendor/daterangepicker/daterangepicker.js"></script>
    <script src="{{ asset('dist') }}/assets/vendor/tom-select/dist/js/tom-select.complete.min.js"></script>
    <script src="{{ asset('dist') }}/assets/vendor/clipboard/dist/clipboard.min.js"></script>
    <script src="{{ asset('dist') }}/assets/vendor/datatables/media/js/jquery.dataTables.min.js"></script>
    <script src="{{ asset('dist') }}/assets/vendor/datatables.net.extensions/select/select.min.js"></script>

    <!-- JS Front -->
    <script src="{{ asset('dist') }}/assets/js/theme.min.js"></script>
    <script src="{{ asset('dist') }}/assets/js/hs.theme-appearance-charts.js"></script>


    <!-- JS Plugins Init. -->
    <script>
        $(document).on('ready', function() {
            // INITIALIZATION OF DATERANGEPICKER
            // =======================================================
            $('.js-daterangepicker').daterangepicker();

            $('.js-daterangepicker-times').daterangepicker({
                timePicker: true,
                startDate: moment().startOf('hour'),
                endDate: moment().startOf('hour').add(32, 'hour'),
                locale: {
                    format: 'M/DD hh:mm A'
                }
            });

            var start = moment();
            var end = moment();

            function cb(start, end) {
                $('#js-daterangepicker-predefined .js-daterangepicker-predefined-preview').html(start.format(
                    'MMM D') + ' - ' + end.format('MMM D, YYYY'));
            }

            $('#js-daterangepicker-predefined').daterangepicker({
                startDate: start,
                endDate: end,
                ranges: {
                    'Today': [moment(), moment()],
                    'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                    'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                    'This Month': [moment().startOf('month'), moment().endOf('month')],
                    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1,
                        'month').endOf('month')]
                }
            }, cb);

            cb(start, end);
        });


        // INITIALIZATION OF DATATABLES
        // =======================================================
        HSCore.components.HSDatatables.init($('#datatable'), {
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
                zeroRecords: `<div class="p-4 text-center">
              <img class="mb-3" src="{{ asset('dist') }}/assets/svg/illustrations/oc-error.svg" alt="Image Description" style="width: 10rem;" data-hs-theme-appearance="default">
              <img class="mb-3" src="{{ asset('dist') }}/assets/svg/illustrations-light/oc-error.svg" alt="Image Description" style="width: 10rem;" data-hs-theme-appearance="dark">
            <p class="mb-0">No data to show</p>
            </div>`
            }
        });

        const datatable = HSCore.components.HSDatatables.getItem(0)

        document.querySelectorAll('.js-datatable-filter').forEach(function(item) {
            item.addEventListener('change', function(e) {
                const elVal = e.target.value,
                    targetColumnIndex = e.target.getAttribute('data-target-column-index'),
                    targetTable = e.target.getAttribute('data-target-table');

                HSCore.components.HSDatatables.getItem(targetTable).column(targetColumnIndex).search(
                    elVal !== 'null' ? elVal : '').draw()
            })
        })
    </script>

    <!-- JS Plugins Init. -->
    <script>
        (function() {
            localStorage.removeItem('hs_theme')

            window.onload = function() {


                // INITIALIZATION OF NAVBAR VERTICAL ASIDE
                // =======================================================
                new HSSideNav('.js-navbar-vertical-aside').init()


                // INITIALIZATION OF FORM SEARCH
                // =======================================================
                const HSFormSearchInstance = new HSFormSearch('.js-form-search')

                if (HSFormSearchInstance.collection.length) {
                    HSFormSearchInstance.getItem(1).on('close', function(el) {
                        el.classList.remove('top-0')
                    })

                    document.querySelector('.js-form-search-mobile-toggle').addEventListener('click', e => {
                        let dataOptions = JSON.parse(e.currentTarget.getAttribute(
                                'data-hs-form-search-options')),
                            $menu = document.querySelector(dataOptions.dropMenuElement)

                        $menu.classList.add('top-0')
                        $menu.style.left = 0
                    })
                }


                // INITIALIZATION OF BOOTSTRAP DROPDOWN
                // =======================================================
                HSBsDropdown.init()


                // INITIALIZATION OF CHARTJS
                // =======================================================
                HSCore.components.HSChartJS.init('.js-chart')


                // INITIALIZATION OF CHARTJS
                // =======================================================
                HSCore.components.HSChartJS.init('#updatingBarChart')
                const updatingBarChart = HSCore.components.HSChartJS.getItem('updatingBarChart')

                // Call when tab is clicked
                document.querySelectorAll('[data-bs-toggle="chart-bar"]').forEach(item => {
                    item.addEventListener('click', e => {
                        let keyDataset = e.currentTarget.getAttribute('data-datasets')

                        const styles = HSCore.components.HSChartJS.getTheme('updatingBarChart',
                            HSThemeAppearance.getAppearance())

                        if (keyDataset === 'lastWeek') {
                            updatingBarChart.data.labels = ["Apr 22", "Apr 23", "Apr 24", "Apr 25",
                                "Apr 26", "Apr 27", "Apr 28", "Apr 29", "Apr 30", "Apr 31"
                            ];
                            updatingBarChart.data.datasets = [{
                                    "data": [120, 250, 300, 200, 300, 290, 350, 100, 125, 320],
                                    "backgroundColor": styles.data.datasets[0].backgroundColor,
                                    "hoverBackgroundColor": styles.data.datasets[0]
                                        .hoverBackgroundColor,
                                    "borderColor": styles.data.datasets[0].borderColor,
                                    "maxBarThickness": 10
                                },
                                {
                                    "data": [250, 130, 322, 144, 129, 300, 260, 120, 260, 245,
                                        110
                                    ],
                                    "backgroundColor": styles.data.datasets[1].backgroundColor,
                                    "borderColor": styles.data.datasets[1].borderColor,
                                    "maxBarThickness": 10
                                }
                            ];
                            updatingBarChart.update();
                        } else {
                            updatingBarChart.data.labels = ["May 1", "May 2", "May 3", "May 4",
                                "May 5", "May 6", "May 7", "May 8", "May 9", "May 10"
                            ];
                            updatingBarChart.data.datasets = [{
                                    "data": [200, 300, 290, 350, 150, 350, 300, 100, 125, 220],
                                    "backgroundColor": styles.data.datasets[0].backgroundColor,
                                    "hoverBackgroundColor": styles.data.datasets[0]
                                        .hoverBackgroundColor,
                                    "borderColor": styles.data.datasets[0].borderColor,
                                    "maxBarThickness": 10
                                },
                                {
                                    "data": [150, 230, 382, 204, 169, 290, 300, 100, 300, 225,
                                        120
                                    ],
                                    "backgroundColor": styles.data.datasets[1].backgroundColor,
                                    "borderColor": styles.data.datasets[1].borderColor,
                                    "maxBarThickness": 10
                                }
                            ]
                            updatingBarChart.update();
                        }
                    })
                })


                // INITIALIZATION OF CHARTJS
                // =======================================================
                HSCore.components.HSChartJS.init('.js-chart-datalabels', {
                    plugins: [ChartDataLabels],
                    options: {
                        plugins: {
                            datalabels: {
                                anchor: function(context) {
                                    var value = context.dataset.data[context.dataIndex];
                                    return value.r < 20 ? 'end' : 'center';
                                },
                                align: function(context) {
                                    var value = context.dataset.data[context.dataIndex];
                                    return value.r < 20 ? 'end' : 'center';
                                },
                                color: function(context) {
                                    var value = context.dataset.data[context.dataIndex];
                                    return value.r < 20 ? context.dataset.backgroundColor : context
                                        .dataset.color;
                                },
                                font: function(context) {
                                    var value = context.dataset.data[context.dataIndex],
                                        fontSize = 25;

                                    if (value.r > 50) {
                                        fontSize = 35;
                                    }

                                    if (value.r > 70) {
                                        fontSize = 55;
                                    }

                                    return {
                                        weight: 'lighter',
                                        size: fontSize
                                    };
                                },
                                formatter: function(value) {
                                    return value.r
                                },
                                offset: 2,
                                padding: 0
                            }
                        },
                    }
                })

                // INITIALIZATION OF SELECT
                // =======================================================
                HSCore.components.HSTomSelect.init('.js-select')


                // INITIALIZATION OF CLIPBOARD
                // =======================================================
                HSCore.components.HSClipboard.init('.js-clipboard')
            }
        })()
    </script>

    <!-- Style Switcher JS -->

    <script>
        (function() {
            // STYLE SWITCHER
            // =======================================================
            const $dropdownBtn = document.getElementById('selectThemeDropdown') // Dropdowon trigger
            const $variants = document.querySelectorAll(
                `[aria-labelledby="selectThemeDropdown"] [data-icon]`) // All items of the dropdown

            // Function to set active style in the dorpdown menu and set icon for dropdown trigger
            const setActiveStyle = function() {
                $variants.forEach($item => {
                    if ($item.getAttribute('data-value') === HSThemeAppearance.getOriginalAppearance()) {
                        $dropdownBtn.innerHTML = `<i class="${$item.getAttribute('data-icon')}" />`
                        return $item.classList.add('active')
                    }

                    $item.classList.remove('active')
                })
            }

            // Add a click event to all items of the dropdown to set the style
            $variants.forEach(function($item) {
                $item.addEventListener('click', function() {
                    HSThemeAppearance.setAppearance($item.getAttribute('data-value'))
                })
            })

            // Call the setActiveStyle on load page
            setActiveStyle()

            // Add event listener on change style to call the setActiveStyle function
            window.addEventListener('on-hs-appearance-change', function() {
                setActiveStyle()
            })
        })()
    </script>
    {{-- jquery --}}
    <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>

    {{-- datatables js --}}
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.js"></script>

    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.js"></script>

    <script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/classic/ckeditor.js"></script>

    {{--  @stack('scriptsDataTables')  --}}

    @include('sweetalert::alert')
    @stack('scripts')
    <!-- End Style Switcher JS -->


</body>

</html>
