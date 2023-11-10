<div class="app-container app-theme-white body-tabs-shadow fixed-sidebar fixed-header">

    {{-- --------   Topbar   -------- --}}
    <div class="app-header header-shadow">
        <div class="app-header__logo">
            <a href="{{ url('home') }}" class="link-dark">
                <div class="logo-src ml-5">
                    <img width="45" class="img-responsive img-fluid" src="{{ asset('assets/img/dms.jpg') }}"
                        alt="Logo">
                </div>
            </a>
            <div class="header__pane ms-auto">
                <div>
                    <button type="button" class="hamburger close-sidebar-btn hamburger--elastic"
                        data-class="closed-sidebar">
                        <span class="hamburger-box">
                            <span class="hamburger-inner"></span>
                        </span>
                    </button>
                </div>
            </div>
        </div>
        <div class="app-header__mobile-menu">
            <div>
                <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                    <span class="hamburger-box">
                        <span class="hamburger-inner"></span>
                    </span>
                </button>
            </div>
        </div>
        <div class="app-header__menu">
            <span>
                <button type="button" class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                    <span class="btn-icon-wrapper">
                        <i class="fa fa-ellipsis-v fa-w-6"></i>
                    </span>
                </button>
            </span>
        </div>
        <div class="app-header__content">
            <div class="app-header-left"><i class="fa fa-car" aria-hidden="true"></i></h5></span>
            </div>

            <div class="app-header-right">
                <div class="header-btn-lg pr-0">
                    <div class="widget-content p-0">
                        <div class="widget-content-wrapper">
                            <div class="widget-content-left">
                                <div class="btn-group">
                                    <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                        class="p-0 btn">
                                        <img width="42" class="rounded-circle" src="{{ asset('assets/img/1.jpg') }}"
                                            alt>
                                        <i class="fa fa-angle-down ml-2 opacity-8"></i>
                                    </a>
                                    <div tabindex="-1" role="menu" aria-hidden="true"
                                        class="dropdown-menu dropdown-menu-right">
                                        <button type="button" tabindex="0" class="dropdown-item"> <i
                                                class="metismenu-icon fa-solid fa-user icon-xs">&nbsp;&nbsp;</i>Profile</button>
                                        <button type="button" tabindex="0" class="dropdown-item"> <i
                                                class="metismenu-icon fa-solid fa-lock icon-xs">&nbsp;&nbsp;</i>Change
                                            Password</button>
                                        <div tabindex="-1" class="dropdown-divider"></div>
                                        <a href="{{ route('logout') }}" class="dropdown-item" type="button">
                                            <i
                                                class="metismenu-icon fa-solid fa-right-from-bracket icon-xs">&nbsp;&nbsp;</i>
                                            Logout
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="widget-content-left  ml-3 header-user-info">
                                <div class="widget-heading">
                                    {{ session('full_name') }}
                                </div>
                                <div class="widget-subheading">
                                    {{ session('user_rights') }}
                                </div>
                            </div>
                            {{-- <div class="widget-content-right header-user-info ml-3">
                                <button type="button"
                                    class="btn-shadow p-1 btn btn-primary btn-sm show-toastr-example">
                                    <i class="fa text-white fa-calendar pr-1 pl-1"></i>
                                </button>
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Ui Theme Settings --}}
    @include('partials.uithemes')

    {{-- --------   Sidebar   -------- --}}

    <div class="app-main">

        <div class="app-sidebar sidebar-shadow">
            <div class="app-header__logo">
                <div class="logo-src"></div>
                <div class="header__pane ms-auto">
                    <div>
                        <button type="button" class="hamburger close-sidebar-btn hamburger--elastic"
                            data-class="closed-sidebar">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                        </button>
                    </div>
                </div>
            </div>
            <div class="app-header__mobile-menu">
                <div>
                    <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                        <span class="hamburger-box">
                            <span class="hamburger-inner"></span>
                        </span>
                    </button>
                </div>
            </div>
            <div class="app-header__menu">
                <span>
                    <button type="button"
                        class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                        <span class="btn-icon-wrapper">
                            <i class="fa fa-ellipsis-v fa-w-6"></i>
                        </span>
                    </button>
                </span>
            </div>
            <div class="scrollbar-sidebar">
                <div class="app-sidebar__inner">
                    <ul class="vertical-nav-menu">

                        <li class="app-sidebar__heading">Dashboards</li>
                        <li>
                            <a href="#">
                                <i class="metismenu-icon fa-solid fa-user icon-sm"></i>
                                Leads
                                <i class="metismenu-state-icon fa fa-angle-down icon-xs"></i>
                            </a>
                            <ul>
                                <li>
                                    {{-- {{ url('leads', ['lead_type' => 'I']) }} --}}
                                    <a href="{{ url('list-of-leads', ['lead_type' => 'I']) }}">
                                        <i class="metismenu-icon"></i>Individual
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ url('list-of-leads', ['lead_type' => 'C']) }}">
                                        <i class="metismenu-icon"></i>Company
                                    </a>
                                </li>
                            </ul>
                        </li>


                        <li>
                            <a href="{{ url('auto-loan-calculator') }}">
                                <i class="metismenu-icon fa-solid fa-computer icon-sm"></i>
                                Loan Calculator
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="metismenu-icon fa-solid fa-building icon-sm"></i>
                                Reports
                                <i class="metismenu-state-icon fa fa-angle-down icon-xs"></i>
                            </a>
                            <ul>
                                <li>
                                    <a href="{{ url('/reports/lead-summary') }}">
                                        <i class="metismenu-icon"></i>Leads Summary
                                    </a>
                                </li>
                            </ul>
                        </li>

                    </ul>
                </div>
            </div>
        </div>

        <div class="app-main__outer">
            <div class="app-main__inner">

                @yield('navbar')

            </div>
        </div>

    </div>

</div>
