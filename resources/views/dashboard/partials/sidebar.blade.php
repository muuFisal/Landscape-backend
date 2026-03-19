<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
            @php
                $setting = \App\Models\Setting::first();
            @endphp
            <li class="nav-item me-auto"><a class="navbar-brand" href="{{ route('dashboard.home') }}"><span
                        class="brand-logo"><img src="{{ asset($setting->logo) }}"></span>
                    <h2 class="brand-text">{{ $setting->site_name }}</h2>
                </a></li>
            <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pe-0" data-bs-toggle="collapse"><i
                        class="d-block d-xl-none text-primary toggle-icon font-medium-4 fa-solid fa-xmark"></i><i
                        class="d-none d-xl-block collapse-toggle-icon font-medium-4 text-primary fa-solid fa-circle-dot"
                        data-ticon="disc"></i></a></li>
        </ul>
    </div>
    <div class="shadow-bottom"></div>
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li class="nav-item @yield('dashboard-active')"><a class="d-flex align-items-center"
                    href="{{ route('dashboard.home') }}"><i class="fa-solid fa-house"></i><span
                        class="menu-title text-truncate" data-i18n="Email">{{ __('dashboard.home') }}</span></a>
            </li>
            <li class=" navigation-header"><span data-i18n="Apps &amp; Pages">Apps &amp; Pages</span><i
                    class="fa-solid fa-ellipsis"></i>
            </li>

            @can('roles')
                <li class="nav-item @yield('roles-open') @yield('createRole-open')"><a class="d-flex align-items-center"
                        href="#"><i class="fa-solid fa-bars"></i><span class="menu-title text-truncate"
                            data-i18n="Roles &amp; Permission">{{ __('dashboard.roles') }}</span></a>
                    <ul class="menu-content">
                        <li><a class="@yield('roles-active') d-flex align-items-center"
                                href="{{ route('dashboard.roles.index') }}"><i class="fa-solid fa-circle font-small-3"></i><span
                                    class="menu-item text-truncate" data-i18n="Roles">{{ __('dashboard.roles') }}</span></a>
                        </li>
                        <li><a class="@yield('createRole-active') d-flex align-items-center"
                                href="{{ route('dashboard.roles.create') }}"><i class="fa-solid fa-circle font-small-3"></i><span
                                    class="menu-item text-truncate"
                                    data-i18n="Permission">{{ __('dashboard.create-role') }}</span></a>
                        </li>
                    </ul>
                </li>
            @endcan

            @can('admins')
                <li class="nav-item @yield('admins-open') @yield('createAdmin-open')"><a class="d-flex align-items-center"
                        href="#"><i class="fa-solid fa-users"></i><span class="menu-title text-truncate">
                            {{ __('dashboard.admins') }}</span>
                        <span
                            class="badge badge-light-warning rounded-pill ms-auto me-1">{{ App\Models\Admin::count() }}</span>
                    </a>
                    <ul class="menu-content">
                        <li><a class="@yield('admins-active') d-flex align-items-center"
                                href="{{ route('dashboard.admins.index') }}"><i class="fa-solid fa-circle font-small-3"></i><span
                                    class="menu-item text-truncate"
                                    data-i18n="Roles">{{ __('dashboard.admins') }}</span></a>
                        </li>
                        <li><a class="@yield('createAdmin-active') d-flex align-items-center"
                                href="{{ route('dashboard.admins.create') }}"><i class="fa-solid fa-circle font-small-3"></i><span
                                    class="menu-item text-truncate"
                                    data-i18n="Permission">{{ __('dashboard.create-admin') }}</span></a>
                        </li>
                    </ul>
                </li>
            @endcan

            @can('users')
                <li class="nav-item @yield('users-open') @yield('createUser-open')"><a class="d-flex align-items-center"
                        href="#"><i class="fa-solid fa-users"></i><span class="menu-title text-truncate">
                            {{ __('dashboard.users') }}</span>
                        <span class="badge badge-light-warning rounded-pill ms-auto me-1"> {{ App\Models\User::count() }}
                        </span>
                    </a>
                    <ul class="menu-content">
                        <li><a class="@yield('users-active') d-flex align-items-center"
                                href="{{ route('dashboard.users.index') }}"><i class="fa-solid fa-circle font-small-3"></i><span
                                    class="menu-item text-truncate"
                                    data-i18n="Roles">{{ __('dashboard.users') }}</span></a>
                        </li>
                    </ul>
                </li>
            @endcan


                        @if(auth()->user()->can('gallery_page') || auth()->user()->can('gallery_items'))
                        <li class="nav-item @yield('gallery-open')">
                            <a class="d-flex align-items-center" href="#">
                                <i class="fa-solid fa-image"></i>
                                <span class="menu-title text-truncate">{{ __('dashboard.gallery') }}</span></a>
                            <ul class="menu-content">
                                @can('gallery_page')
                                <li><a class="@yield('gallery-page-active') d-flex align-items-center"
                                        href="{{ route('dashboard.gallery-page') }}"><i class="fa-solid fa-circle font-small-3"></i><span
                                            class="menu-item text-truncate">{{ __('dashboard.gallery-page') }}</span></a>
                                </li>
                                @endcan
                                @can('gallery_items')
                                <li><a class="@yield('gallery-items-active') d-flex align-items-center"
                                        href="{{ route('dashboard.gallery-items') }}"><i class="fa-solid fa-circle font-small-3"></i><span
                                            class="menu-item text-truncate">{{ __('dashboard.gallery-items') }}</span></a>
                                </li>
                                @endcan
                            </ul>
                        </li>
                        @endif


            @if(auth()->user()->can('services_page') || auth()->user()->can('services'))
                <li class="nav-item @yield('services-open')">
                    <a class="d-flex align-items-center" href="#"><i class="fa-solid fa-grip"></i><span
                            class="menu-title text-truncate">{{ __('dashboard.services') }}</span></a>
                    <ul class="menu-content">
                        @can('services_page')
                        <li><a class="@yield('services-page-active') d-flex align-items-center"
                                href="{{ route('dashboard.services-page') }}"><i class="fa-solid fa-circle font-small-3"></i><span
                                    class="menu-item text-truncate">{{ __('dashboard.services-page') }}</span></a>
                        </li>
                        @endcan
                        @can('services')
                        <li><a class="@yield('services-active') d-flex align-items-center"
                                href="{{ route('dashboard.services') }}"><i class="fa-solid fa-circle font-small-3"></i><span
                                    class="menu-item text-truncate">{{ __('dashboard.services-items') }}</span></a>
                        </li>
                        @endcan
                    </ul>
                </li>
            @endif

            @if(auth()->user()->can('work_page') || auth()->user()->can('projects'))
                <li class="nav-item @yield('projects-open')">
                    <a class="d-flex align-items-center" href="#"><i class="fa-solid fa-layer-group"></i><span
                            class="menu-title text-truncate">{{ __('dashboard.projects') }}</span></a>
                    <ul class="menu-content">
                        @can('work_page')
                        <li><a class="@yield('work-page-active') d-flex align-items-center"
                                href="{{ route('dashboard.work-page') }}"><i class="fa-solid fa-circle font-small-3"></i><span
                                    class="menu-item text-truncate">{{ __('dashboard.work-page') }}</span></a>
                        </li>
                        @endcan
                        @can('projects')
                        <li><a class="@yield('projects-active') d-flex align-items-center"
                                href="{{ route('dashboard.projects') }}"><i class="fa-solid fa-circle font-small-3"></i><span
                                    class="menu-item text-truncate">{{ __('dashboard.projects-items') }}</span></a>
                        </li>
                        @endcan
                    </ul>
                </li>
            @endif


            @can('settings')
                <li class="nav-item @yield('settings-open')"><a class="d-flex align-items-center" href="#">
                        <i class="fa-solid fa-gear"></i><span class="menu-title text-truncate"
                            data-i18n="Roles &amp; Permission">{{ __('dashboard.settings') }}</span>
                    </a>
                    <ul class="menu-content">
                        <li><a class="@yield('settings-active') d-flex align-items-center"
                                href="{{ route('dashboard.settings') }}"><i class="fa-solid fa-circle font-small-3"></i><span
                                    class="menu-item text-truncate">{{ __('dashboard.general-settings') }}</span></a>
                        </li>
                        <li><a class="@yield('banners-active') d-flex align-items-center"
                                href="{{ route('dashboard.banners') }}"><i class="fa-solid fa-circle font-small-3"></i><span
                                    class="menu-item text-truncate">{{ __('dashboard.banners') }}</span></a>
                        </li>
                        <li><a class="@yield('about-active') d-flex align-items-center"
                                href="{{ route('dashboard.about.setting') }}"><i class="fa-solid fa-circle font-small-3"></i><span
                                    class="menu-item text-truncate">{{ __('dashboard.about-settings') }}</span></a>
                        </li>
                        <li><a class="@yield('privacy-active') d-flex align-items-center"
                                href="{{ route('dashboard.privacy.setting') }}"><i class="fa-solid fa-circle font-small-3"></i><span
                                    class="menu-item text-truncate">{{ __('dashboard.privacy-settings') }}</span></a>
                        </li>
                        <li><a class="@yield('terms-active') d-flex align-items-center"
                                href="{{ route('dashboard.terms.setting') }}"><i class="fa-solid fa-circle font-small-3"></i><span
                                    class="menu-item text-truncate">{{ __('dashboard.terms-settings') }}</span></a>
                        </li>
                        <li><a class="@yield('faqs-active') d-flex align-items-center"
                                href="{{ route('dashboard.faqs.setting') }}"><i class="fa-solid fa-circle font-small-3"></i><span
                                    class="menu-item text-truncate">{{ __('dashboard.faqs-settings') }}</span></a>
                        </li>
                        @can('why_choose')
                        <li><a class="@yield('why-choose-active') d-flex align-items-center"
                                href="{{ route('dashboard.why-choose') }}"><i class="fa-solid fa-circle font-small-3"></i><span
                                    class="menu-item text-truncate">{{ __('dashboard.why-choose-section') }}</span></a>
                        </li>
                        @endcan
                        @can('request_service')
                        <li><a class="@yield('request-service-active') d-flex align-items-center"
                                href="{{ route('dashboard.request-service') }}"><i class="fa-solid fa-circle font-small-3"></i><span
                                    class="menu-item text-truncate">{{ __('dashboard.request-service-section') }}</span></a>
                        </li>
                        @endcan
                    </ul>
                </li>
            @endcan

        </ul>
    </div>
</div>
