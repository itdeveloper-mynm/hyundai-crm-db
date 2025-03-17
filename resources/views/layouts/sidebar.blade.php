<div id="kt_app_sidebar" class="app-sidebar flex-column" data-kt-drawer="true" data-kt-drawer-name="app-sidebar"
    data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="225px"
    data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_app_sidebar_mobile_toggle">
    <!--begin::Logo-->
    <div class="app-sidebar-logo px-6" id="kt_app_sidebar_logo">
        <!--begin::Logo image-->
        <a href="{{ url('/dashboard') }}">
            <img alt="Logo" src="{{ asset('admin_asset') }}/assets/media/logos/hyundai-logo.png"
                class="h-25px app-sidebar-logo-default" />
            <img alt="Logo" src="{{ asset('admin_asset') }}/assets/media/logos/hyundai-logo.png"
                class="h-20px app-sidebar-logo-minimize" />
        </a>
        <!--end::Logo image-->
        <!--begin::Sidebar toggle-->
        <div id="kt_app_sidebar_toggle"
            class="app-sidebar-toggle btn btn-icon btn-shadow btn-sm btn-color-muted btn-active-color-primary body-bg h-30px w-30px position-absolute top-50 start-100 translate-middle rotate"
            data-kt-toggle="true" data-kt-toggle-state="active" data-kt-toggle-target="body"
            data-kt-toggle-name="app-sidebar-minimize">
            <!--begin::Svg Icon | path: icons/duotune/arrows/arr079.svg-->
            <span class="svg-icon svg-icon-2 rotate-180">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path opacity="0.5"
                        d="M14.2657 11.4343L18.45 7.25C18.8642 6.83579 18.8642 6.16421 18.45 5.75C18.0358 5.33579 17.3642 5.33579 16.95 5.75L11.4071 11.2929C11.0166 11.6834 11.0166 12.3166 11.4071 12.7071L16.95 18.25C17.3642 18.6642 18.0358 18.6642 18.45 18.25C18.8642 17.8358 18.8642 17.1642 18.45 16.75L14.2657 12.5657C13.9533 12.2533 13.9533 11.7467 14.2657 11.4343Z"
                        fill="currentColor" />
                    <path
                        d="M8.2657 11.4343L12.45 7.25C12.8642 6.83579 12.8642 6.16421 12.45 5.75C12.0358 5.33579 11.3642 5.33579 10.95 5.75L5.40712 11.2929C5.01659 11.6834 5.01659 12.3166 5.40712 12.7071L10.95 18.25C11.3642 18.6642 12.0358 18.6642 12.45 18.25C12.8642 17.8358 12.8642 17.1642 12.45 16.75L8.2657 12.5657C7.95328 12.2533 7.95328 11.7467 8.2657 11.4343Z"
                        fill="currentColor" />
                </svg>
            </span>
            <!--end::Svg Icon-->
        </div>
        <!--end::Sidebar toggle-->
    </div>
    <!--end::Logo-->
    <!--begin::sidebar menu-->
    <div class="app-sidebar-menu overflow-hidden flex-column-fluid">
        <!--begin::Menu wrapper-->
        <div id="kt_app_sidebar_menu_wrapper" class="app-sidebar-wrapper hover-scroll-overlay-y my-5"
            data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-height="auto"
            data-kt-scroll-dependencies="#kt_app_sidebar_logo, #kt_app_sidebar_footer"
            data-kt-scroll-wrappers="#kt_app_sidebar_menu" data-kt-scroll-offset="5px" data-kt-scroll-save-state="true">
            <!--begin::Menu-->
            <div class="menu menu-column menu-rounded menu-sub-indention px-3" id="#kt_app_sidebar_menu"
                data-kt-menu="true" data-kt-menu-expand="false">
                <div class="menu-item">
                    <!--begin:Menu link-->
                    @role('SuperAdmin')
                        <a class="menu-link" href="{{ url('/') }}">
                            <span class="menu-icon">
                                <!--begin::Svg Icon | path: icons/duotune/general/gen014.svg-->
                                <span class="svg-icon svg-icon-2">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <rect x="2" y="2" width="9" height="9" rx="2" fill="currentColor">
                                        </rect>
                                        <rect opacity="0.3" x="13" y="2" width="9" height="9" rx="2"
                                            fill="currentColor">
                                        </rect>
                                        <rect opacity="0.3" x="13" y="13" width="9" height="9" rx="2"
                                            fill="currentColor">
                                        </rect>
                                        <rect opacity="0.3" x="2" y="13" width="9" height="9" rx="2"
                                            fill="currentColor">
                                        </rect>
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->
                            </span>
                            <span class="menu-title">Dashboard</span>
                        </a>
                    @endrole
                    <!--end:Menu link-->
                </div>
                @can('sales-data-list')
                    <!--begin:Menu item-->
                    <div class="menu-item">
                        <!--begin:Menu link-->
                        <a class="menu-link {{ activeRoute(route('sales-data.index')) }} {{ activeRoute(route('sales-data.create')) }} {{ request()->is('sales-data/*/edit') ? 'active' : '' }}"
                            href="{{ route('sales-data.index') }}">
                            <span class="menu-icon">
                                <span class="svg-icon svg-icon-2">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M20 14H18V10H20C20.6 10 21 10.4 21 11V13C21 13.6 20.6 14 20 14ZM21 19V17C21 16.4 20.6 16 20 16H18V20H20C20.6 20 21 19.6 21 19ZM21 7V5C21 4.4 20.6 4 20 4H18V8H20C20.6 8 21 7.6 21 7Z"
                                            fill="currentColor" />
                                        <path opacity="0.3"
                                            d="M17 22H3C2.4 22 2 21.6 2 21V3C2 2.4 2.4 2 3 2H17C17.6 2 18 2.4 18 3V21C18 21.6 17.6 22 17 22ZM10 7C8.9 7 8 7.9 8 9C8 10.1 8.9 11 10 11C11.1 11 12 10.1 12 9C12 7.9 11.1 7 10 7ZM13.3 16C14 16 14.5 15.3 14.3 14.7C13.7 13.2 12 12 10.1 12C8.10001 12 6.49999 13.1 5.89999 14.7C5.59999 15.3 6.19999 16 7.39999 16H13.3Z"
                                            fill="currentColor" />
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->
                            </span>
                            <span class="menu-title">Sales Data</span>
                        </a>
                        <!--end:Menu link-->
                    </div>
                    <!--end:Menu item-->
                @endcan
                @canany(AllLeadsMenuPermissionArr())
                    <div data-kt-menu-trigger="click"
                        class="menu-item menu-accordion {{ activeMenuRoute(AllLeadsMenuArr()) }}">
                        {{-- <div data-kt-menu-trigger="click" class="menu-item menu-accordion hover show"> --}}
                        <!--begin:Menu link-->
                        <span class="menu-link {{ activeMenuRoute(AllLeadsMenuArr()) }}">
                            <span class="menu-icon">
                                <!--begin::Svg Icon | path: icons/duotune/communication/com005.svg-->
                                <span class="svg-icon svg-icon-2">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M20 14H18V10H20C20.6 10 21 10.4 21 11V13C21 13.6 20.6 14 20 14ZM21 19V17C21 16.4 20.6 16 20 16H18V20H20C20.6 20 21 19.6 21 19ZM21 7V5C21 4.4 20.6 4 20 4H18V8H20C20.6 8 21 7.6 21 7Z"
                                            fill="currentColor" />
                                        <path opacity="0.3"
                                            d="M17 22H3C2.4 22 2 21.6 2 21V3C2 2.4 2.4 2 3 2H17C17.6 2 18 2.4 18 3V21C18 21.6 17.6 22 17 22ZM10 7C8.9 7 8 7.9 8 9C8 10.1 8.9 11 10 11C11.1 11 12 10.1 12 9C12 7.9 11.1 7 10 7ZM13.3 16C14 16 14.5 15.3 14.3 14.7C13.7 13.2 12 12 10.1 12C8.10001 12 6.49999 13.1 5.89999 14.7C5.59999 15.3 6.19999 16 7.39999 16H13.3Z"
                                            fill="currentColor" />
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->
                            </span>
                            <span class="menu-title">Leads</span>
                            <span class="menu-arrow"></span>
                        </span>
                        <!--end:Menu link-->
                        @can('all-leads-list')
                            <!--begin:Menu sub-->
                            <div class="menu-sub menu-sub-accordion">
                                <!--begin:Menu item-->
                                <div class="menu-item">
                                    <!--begin:Menu link-->
                                    <a class="menu-link {{ activeRoute(route('allleads.index')) }}"
                                        href="{{ route('allleads.index') }}">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">All Leads</span>
                                    </a>
                                    <!--end:Menu link-->
                                </div>
                                <!--end:Menu item-->
                            </div>
                            <!--end:Menu sub-->
                        @endcan
                        @can('campaign-leads-list')
                            <!--begin:Menu sub-->
                            <div class="menu-sub menu-sub-accordion">
                                <!--begin:Menu item-->
                                <div class="menu-item">
                                    <!--begin:Menu link-->
                                    <a class="menu-link {{ activeRoute(route('lead.index')) }} {{ activeRoute(route('lead.create')) }} {{ request()->is('lead/*/edit') ? 'active' : '' }}"
                                        href="{{ route('lead.index') }}">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">Campaign Leads</span>
                                    </a>
                                    <!--end:Menu link-->
                                </div>
                                <!--end:Menu item-->
                            </div>
                            <!--end:Menu sub-->
                        @endcan
                        <!--end:Menu link-->
                        @can('after-sale-leads-list')
                            <!--begin:Menu sub-->
                            <div class="menu-sub menu-sub-accordion">
                                <!--begin:Menu item-->
                                <div class="menu-item">
                                    <!--begin:Menu link-->
                                    <a class="menu-link {{ activeRoute(route('after-sale.index')) }} {{ activeRoute(route('after-sale.create')) }} {{ request()->is('after-sale/*/edit') ? 'active' : '' }}"
                                        href="{{ route('after-sale.index') }}">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">After Sale Leads</span>
                                    </a>
                                    <!--end:Menu link-->
                                </div>
                                <!--end:Menu item-->
                            </div>
                            <!--end:Menu sub-->
                        @endcan
                        @can('test-drive-request-list')
                            <!--begin:Menu sub-->
                            <div class="menu-sub menu-sub-accordion">
                                <!--begin:Menu item-->
                                <div class="menu-item">
                                    <!--begin:Menu link-->
                                    <a class="menu-link {{ activeRoute(route('test-drive-request.index')) }}"
                                        href="{{ route('test-drive-request.index') }}">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">Request a Test Drive</span>
                                    </a>
                                    <!--end:Menu link-->
                                </div>
                                <!--end:Menu item-->
                            </div>
                            <!--end:Menu sub-->
                        @endcan
                        @can('quote-request-list')
                            <!--begin:Menu sub-->
                            <div class="menu-sub menu-sub-accordion">
                                <!--begin:Menu item-->
                                <div class="menu-item">
                                    <!--begin:Menu link-->
                                    <a class="menu-link {{ activeRoute(route('quote-request.index')) }}"
                                        href="{{ route('quote-request.index') }}">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">Request a Quote</span>
                                    </a>
                                    <!--end:Menu link-->
                                </div>
                                <!--end:Menu item-->
                            </div>
                            <!--end:Menu sub-->
                        @endcan
                        @can('used-car-leads-list')
                            <!--begin:Menu sub-->
                            <div class="menu-sub menu-sub-accordion">
                                <!--begin:Menu item-->
                                <div class="menu-item">
                                    <!--begin:Menu link-->
                                    <a class="menu-link {{ activeRoute(route('used-car.index')) }} {{ activeRoute(route('used-car.create')) }} {{ request()->is('used-car/*/edit') ? 'active' : '' }}"
                                        href="{{ route('used-car.index') }}">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">Used Car Leads</span>
                                    </a>
                                    <!--end:Menu link-->
                                </div>
                                <!--end:Menu item-->
                            </div>
                            <!--end:Menu sub-->
                        @endcan
                        @can('smo-leads-list')
                            <!--begin:Menu sub-->
                            <div class="menu-sub menu-sub-accordion">
                                <!--begin:Menu item-->
                                <div class="menu-item">
                                    <!--begin:Menu link-->
                                    <a class="menu-link {{ activeRoute(route('smo-lead.index')) }} {{ activeRoute(route('smo-lead.create')) }} {{ request()->is('smo-lead/*/edit') ? 'active' : '' }}"
                                        href="{{ route('smo-lead.index') }}">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">Smo Leads</span>
                                    </a>
                                    <!--end:Menu link-->
                                </div>
                                <!--end:Menu item-->
                            </div>
                            <!--end:Menu sub-->
                        @endcan
                        @can('hr-list')
                            <!--begin:Menu sub-->
                            <div class="menu-sub menu-sub-accordion">
                                <!--begin:Menu item-->
                                <div class="menu-item">
                                    <!--begin:Menu link-->
                                    <a class="menu-link {{ activeRoute(route('hr.index')) }}"
                                        href="{{ route('hr.index') }}">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">Hr Leads</span>
                                    </a>
                                    <!--end:Menu link-->
                                </div>
                                <!--end:Menu item-->
                            </div>
                            <!--end:Menu sub-->
                        @endcan
                        {{-- @can('google-business-list')
                            <!--begin:Menu sub-->
                            <div class="menu-sub menu-sub-accordion">
                                <!--begin:Menu item-->
                                <div class="menu-item">
                                    <!--begin:Menu link-->
                                    <a class="menu-link {{ activeRoute(route('google-business.index')) }} {{ activeRoute(route('google-business.create')) }} {{ request()->is('google-business/*/edit') ? 'active' : '' }}"
                                        href="{{ route('google-business.index') }}">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">Google Business</span>
                                    </a>
                                    <!--end:Menu link-->
                                </div>
                                <!--end:Menu item-->
                            </div>
                            <!--end:Menu sub-->
                        @endcan --}}
                        {{-- @can('old-leads-list')
                            <!--begin:Menu sub-->
                            <div class="menu-sub menu-sub-accordion">
                                <!--begin:Menu item-->
                                <div class="menu-item">
                                    <!--begin:Menu link-->
                                    <a class="menu-link {{ activeRoute(route('old-leads.index')) }} {{ activeRoute(route('old-leads.create')) }} {{ request()->is('old-leads/*/edit') ? 'active' : '' }}"
                                        href="{{ route('old-leads.index') }}">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">Old Leads</span>
                                    </a>
                                    <!--end:Menu link-->
                                </div>
                                <!--end:Menu item-->
                            </div>
                            <!--end:Menu sub-->
                        @endcan --}}
                        @can('social-data-list')
                            <!--begin:Menu sub-->
                            <div class="menu-sub menu-sub-accordion">
                                <!--begin:Menu item-->
                                <div class="menu-item">
                                    <!--begin:Menu link-->
                                    <a class="menu-link {{ activeRoute(route('social-data.index')) }} {{ activeRoute(route('social-data.create')) }} {{ request()->is('social-data/*/edit') ? 'active' : '' }}"
                                        href="{{ route('social-data.index') }}">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">Social Data</span>
                                    </a>
                                    <!--end:Menu link-->
                                </div>
                                <!--end:Menu item-->
                            </div>
                            <!--end:Menu sub-->
                        @endcan
                    </div>
                @endcanany

                @canany(AllCrmLeadsMenuPermissionArr())
                <!--begin:Menu item-->
                <div data-kt-menu-trigger="click" class="menu-item menu-accordion {{ activeMenuRoute(CRMLeadsDataAllMenuArr()) }}">
                    {{-- <div data-kt-menu-trigger="click" class="menu-item menu-accordion hover show"> --}}
                    <!--begin:Menu link-->
                    <span class="menu-link {{ activeMenuRoute(CRMLeadsDataAllMenuArr()) }}">
                        <span class="menu-icon">
                            <!--begin::Svg Icon | path: icons/duotune/communication/com005.svg-->
                            <span class="svg-icon svg-icon-2">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M20 14H18V10H20C20.6 10 21 10.4 21 11V13C21 13.6 20.6 14 20 14ZM21 19V17C21 16.4 20.6 16 20 16H18V20H20C20.6 20 21 19.6 21 19ZM21 7V5C21 4.4 20.6 4 20 4H18V8H20C20.6 8 21 7.6 21 7Z"
                                        fill="currentColor" />
                                    <path opacity="0.3"
                                        d="M17 22H3C2.4 22 2 21.6 2 21V3C2 2.4 2.4 2 3 2H17C17.6 2 18 2.4 18 3V21C18 21.6 17.6 22 17 22ZM10 7C8.9 7 8 7.9 8 9C8 10.1 8.9 11 10 11C11.1 11 12 10.1 12 9C12 7.9 11.1 7 10 7ZM13.3 16C14 16 14.5 15.3 14.3 14.7C13.7 13.2 12 12 10.1 12C8.10001 12 6.49999 13.1 5.89999 14.7C5.59999 15.3 6.19999 16 7.39999 16H13.3Z"
                                        fill="currentColor" />
                                </svg>
                            </span>
                            <!--end::Svg Icon-->
                        </span>
                        <span class="menu-title">CRM Leads</span>
                        <span class="menu-arrow"></span>
                    </span>
                    <!--end:Menu link-->
                    <!--begin:Menu sub-->
                    @can('crm-leads-list')
                        <!--begin:Menu sub-->
                        <div class="menu-sub menu-sub-accordion">
                            <!--begin:Menu item-->
                            <div class="menu-item">
                                <!--begin:Menu link-->
                                <a class="menu-link {{ activeRoute(route('crm-leads.index')) }} {{ activeRoute(route('crm-leads.create')) }} {{ request()->is('crm-leads/*/edit') ? 'active' : '' }}  {{ request()->is('crm-leads') && request()->has('mobile') ? 'active' : '' }}"
                                    href="{{ route('crm-leads.index') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">All CRM Leads</span>
                                </a>
                                <!--end:Menu link-->
                            </div>
                            <!--end:Menu item-->
                        </div>
                        <!--end:Menu sub-->
                        <!--begin:Menu sub-->
                        <div class="menu-sub menu-sub-accordion">
                            <!--begin:Menu item-->
                            <div class="menu-item">
                                <!--begin:Menu link-->
                                <a class="menu-link {{ activeRoute(route('qualified-crm-leads.index')) }} {{ request()->is('qualified-crm-leads') && request()->has('mobile') ? 'active' : '' }}"
                                    href="{{ route('qualified-crm-leads.index') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Qualified Leads</span>
                                </a>
                                <!--end:Menu link-->
                            </div>
                            <!--end:Menu item-->
                            <!--end:Menu item-->
                        </div>
                        <!--end:Menu sub-->
                           <!--begin:Menu sub-->
                           <div class="menu-sub menu-sub-accordion">
                            <!--begin:Menu item-->
                            <div class="menu-item">
                                <!--begin:Menu link-->
                                <a class="menu-link {{ activeRoute(route('non-qualified-crm-leads.index')) }} {{ request()->is('non-qualified-crm-leads') && request()->has('mobile') ? 'active' : '' }}"
                                    href="{{ route('non-qualified-crm-leads.index') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Non Qualified Leads</span>
                                </a>
                                <!--end:Menu link-->
                            </div>
                            <!--end:Menu item-->
                            <!--end:Menu item-->
                        </div>
                        <!--end:Menu sub-->
                           <!--begin:Menu sub-->
                           <div class="menu-sub menu-sub-accordion">
                            <!--begin:Menu item-->
                            <div class="menu-item">
                                <!--begin:Menu link-->
                                <a class="menu-link {{ activeRoute(route('general-inquiry-crm-leads.index')) }} {{ request()->is('general-inquiry-crm-leads') && request()->has('mobile') ? 'active' : '' }}"
                                    href="{{ route('general-inquiry-crm-leads.index') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">General Inquiry Leads</span>
                                </a>
                                <!--end:Menu link-->
                            </div>
                            <!--end:Menu item-->
                            <!--end:Menu item-->
                        </div>
                        <!--end:Menu sub-->
                    @endcan
                    <!--end:Menu sub-->
                </div>
                <!--end:Menu item-->
                @endcanany

                @canany(GraphMenuPermissionArr())
                    <div data-kt-menu-trigger="click"
                        class="menu-item menu-accordion {{ activeMenuRoute(GraphAllMenuArr()) }}">
                        {{-- <div data-kt-menu-trigger="click" class="menu-item menu-accordion hover show"> --}}
                        <!--begin:Menu link-->
                        <span class="menu-link {{ activeMenuRoute(GraphAllMenuArr()) }}">
                            <span class="menu-icon">
                                <!--begin::Svg Icon | path: icons/duotune/communication/com005.svg-->
                                <span class="svg-icon svg-icon-2">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M20 14H18V10H20C20.6 10 21 10.4 21 11V13C21 13.6 20.6 14 20 14ZM21 19V17C21 16.4 20.6 16 20 16H18V20H20C20.6 20 21 19.6 21 19ZM21 7V5C21 4.4 20.6 4 20 4H18V8H20C20.6 8 21 7.6 21 7Z"
                                            fill="currentColor" />
                                        <path opacity="0.3"
                                            d="M17 22H3C2.4 22 2 21.6 2 21V3C2 2.4 2.4 2 3 2H17C17.6 2 18 2.4 18 3V21C18 21.6 17.6 22 17 22ZM10 7C8.9 7 8 7.9 8 9C8 10.1 8.9 11 10 11C11.1 11 12 10.1 12 9C12 7.9 11.1 7 10 7ZM13.3 16C14 16 14.5 15.3 14.3 14.7C13.7 13.2 12 12 10.1 12C8.10001 12 6.49999 13.1 5.89999 14.7C5.59999 15.3 6.19999 16 7.39999 16H13.3Z"
                                            fill="currentColor" />
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->
                            </span>
                            <span class="menu-title">Reports</span>
                            <span class="menu-arrow"></span>
                        </span>
                        <!--end:Menu link-->
                        @can('sale-graph-list')
                            <!--begin:Menu sub-->
                            <div class="menu-sub menu-sub-accordion">
                                <!--begin:Menu item-->
                                <div class="menu-item">
                                    <!--begin:Menu link-->
                                    <a class="menu-link {{ newactiveRoute([route('sale-graph.index'), request()->is('sale-graph')]) }}"
                                        href="{{ route('sale-graph.index') }}">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">Sales</span>
                                    </a>
                                    <!--end:Menu link-->
                                </div>
                                <!--end:Menu item-->
                            </div>
                        @endcan
                        @can('crm-leads-graph-list')
                            <!--begin:Menu sub-->
                            <div class="menu-sub menu-sub-accordion">
                                <!--begin:Menu item-->
                                <div class="menu-item">
                                    <!--begin:Menu link-->
                                    <a class="menu-link {{ newactiveRoute([route('crm-leads-graph.index'), request()->is('crm-leads-graph')]) }}"
                                        href="{{ route('crm-leads-graph.index') }}">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">CRM Leads</span>
                                    </a>
                                    <!--end:Menu link-->
                                </div>
                                <!--end:Menu item-->
                            </div>
                        @endcan
                        @can('sale-graph-comparison-list')
                            <div class="menu-sub menu-sub-accordion">
                                <!--begin:Menu item-->
                                <div class="menu-item">
                                    <!--begin:Menu link-->
                                    <a class="menu-link {{ newactiveRoute([route('sale-graph-comparison.index'), request()->is('sale-graph-comparison')]) }}"
                                        href="{{ route('sale-graph-comparison.index') }}">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">Sales Comparison</span>
                                    </a>
                                    <!--end:Menu link-->
                                </div>
                                <!--end:Menu item-->
                            </div>
                        @endcan
                        @can('after-sale-graph-list')
                            <div class="menu-sub menu-sub-accordion">
                                <!--begin:Menu item-->
                                <div class="menu-item">
                                    <!--begin:Menu link-->
                                    <a class="menu-link {{ newactiveRoute([route('after-sale-graph.index'), request()->is('after-sale-graph')]) }}"
                                        href="{{ route('after-sale-graph.index') }}">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">After Sales</span>
                                    </a>
                                    <!--end:Menu link-->
                                </div>
                                <!--end:Menu item-->
                            </div>
                        @endcan
                        @can('after-sale-graph-comparison-list')
                            <div class="menu-sub menu-sub-accordion">
                                <!--begin:Menu item-->
                                <div class="menu-item">
                                    <!--begin:Menu link-->
                                    <a class="menu-link {{ newactiveRoute([route('after-sale-graph-comparison.index'), request()->is('after-sale-graph-comparison')]) }}"
                                        href="{{ route('after-sale-graph-comparison.index') }}">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">After Sales Comparison</span>
                                    </a>
                                    <!--end:Menu link-->
                                </div>
                                <!--end:Menu item-->
                            </div>
                        @endcan
                        @can('test-drive-list')
                            <div class="menu-sub menu-sub-accordion">
                                <!--begin:Menu item-->
                                <div class="menu-item">
                                    <!--begin:Menu link-->
                                    <a class="menu-link {{ newactiveRoute([route('test-drive-graph.index'), request()->is('test-drive-graph')]) }}"
                                        href="{{ route('test-drive-graph.index') }}">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">Test Drive</span>
                                    </a>
                                    <!--end:Menu link-->
                                </div>
                                <!--end:Menu item-->
                            </div>
                        @endcan
                        @can('online-service-booking-list')
                            <div class="menu-sub menu-sub-accordion">
                                <!--begin:Menu item-->
                                <div class="menu-item">
                                    <!--begin:Menu link-->
                                    <a class="menu-link {{ newactiveRoute([route('online-service-booking-graph.index'), request()->is('online-service-booking-graph')]) }}"
                                        href="{{ route('online-service-booking-graph.index') }}">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">Online Service Booking</span>
                                    </a>
                                    <!--end:Menu link-->
                                </div>
                                <!--end:Menu item-->
                            </div>
                        @endcan
                        @can('service-offers-graph-list')
                            <div class="menu-sub menu-sub-accordion">
                                <!--begin:Menu item-->
                                <div class="menu-item">
                                    <!--begin:Menu link-->
                                    <a class="menu-link {{ newactiveRoute([route('service-offers-graph.index'), request()->is('service-offers-graph')]) }}"
                                        href="{{ route('service-offers-graph.index') }}">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">Service Offers</span>
                                    </a>
                                    <!--end:Menu link-->
                                </div>
                                <!--end:Menu item-->
                            </div>
                        @endcan
                        @can('contact-us-graph-list')
                            <div class="menu-sub menu-sub-accordion">
                                <!--begin:Menu item-->
                                <div class="menu-item">
                                    <!--begin:Menu link-->
                                    <a class="menu-link {{ newactiveRoute([route('contact-us-graph.index'), request()->is('contact-us-graph')]) }}"
                                        href="{{ route('contact-us-graph.index') }}">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">Contact Us</span>
                                    </a>
                                    <!--end:Menu link-->
                                </div>
                                <!--end:Menu item-->
                            </div>
                        @endcan
                        @can('used-cars-graph-list')
                            <div class="menu-sub menu-sub-accordion">
                                <!--begin:Menu item-->
                                <div class="menu-item">
                                    <!--begin:Menu link-->
                                    <a class="menu-link {{ newactiveRoute([route('used-cars-graph.index'), request()->is('used-cars-graph')]) }}"
                                        href="{{ route('used-cars-graph.index') }}">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">Used Cars</span>
                                    </a>
                                    <!--end:Menu link-->
                                </div>
                                <!--end:Menu item-->
                            </div>
                        @endcan
                        @can('hr-graph-list')
                            <div class="menu-sub menu-sub-accordion">
                                <!--begin:Menu item-->
                                <div class="menu-item">
                                    <!--begin:Menu link-->
                                    <a class="menu-link {{ newactiveRoute([route('hr-graph.index'), request()->is('hr-graph')]) }}"
                                        href="{{ route('hr-graph.index') }}">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">Hr</span>
                                    </a>
                                    <!--end:Menu link-->
                                </div>
                                <!--end:Menu item-->
                            </div>
                        @endcan
                        @can('smo-graph-list')
                            <div class="menu-sub menu-sub-accordion">
                                <!--begin:Menu item-->
                                <div class="menu-item">
                                    <!--begin:Menu link-->
                                    <a class="menu-link {{ newactiveRoute([route('smo-graph.index'), request()->is('smo-graph')]) }}"
                                        href="{{ route('smo-graph.index') }}">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">Smo Leads</span>
                                    </a>
                                    <!--end:Menu link-->
                                </div>
                                <!--end:Menu item-->
                            </div>
                        @endcan
                        @can('events-graph-list')
                            <div class="menu-sub menu-sub-accordion">
                                <!--begin:Menu item-->
                                <div class="menu-item">
                                    <!--begin:Menu link-->
                                    <a class="menu-link {{ newactiveRoute([route('events-graph.index'), request()->is('events-graph')]) }}"
                                        href="{{ route('events-graph.index') }}">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">Events</span>
                                    </a>
                                    <!--end:Menu link-->
                                </div>
                                <!--end:Menu item-->
                            </div>
                        @endcan
                        @can('actualsales-graph-list')
                            <div class="menu-sub menu-sub-accordion">
                                <!--begin:Menu item-->
                                <div class="menu-item">
                                    <!--begin:Menu link-->
                                    <a class="menu-link {{ newactiveRoute([route('actualsales-graph.index'), request()->is('actualsales-graph')]) }}"
                                        href="{{ route('actualsales-graph.index') }}">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">Actual Sale Data</span>
                                    </a>
                                    <!--end:Menu link-->
                                </div>
                                <!--end:Menu item-->
                            </div>
                        @endcan
                    </div>
                @endcanany

                @can('contact-list')
                    <!--begin:Menu item-->
                    <div class="menu-item">
                        <!--begin:Menu link-->
                        <a class="menu-link {{ activeRoute(route('contact.index')) }} {{ activeRoute(route('contact.create')) }} {{ request()->is('contact/*/edit') ? 'active' : '' }}"
                            href="{{ route('contact.index') }}">
                            <span class="menu-icon">
                                <span class="svg-icon svg-icon-2">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M20 14H18V10H20C20.6 10 21 10.4 21 11V13C21 13.6 20.6 14 20 14ZM21 19V17C21 16.4 20.6 16 20 16H18V20H20C20.6 20 21 19.6 21 19ZM21 7V5C21 4.4 20.6 4 20 4H18V8H20C20.6 8 21 7.6 21 7Z"
                                            fill="currentColor" />
                                        <path opacity="0.3"
                                            d="M17 22H3C2.4 22 2 21.6 2 21V3C2 2.4 2.4 2 3 2H17C17.6 2 18 2.4 18 3V21C18 21.6 17.6 22 17 22ZM10 7C8.9 7 8 7.9 8 9C8 10.1 8.9 11 10 11C11.1 11 12 10.1 12 9C12 7.9 11.1 7 10 7ZM13.3 16C14 16 14.5 15.3 14.3 14.7C13.7 13.2 12 12 10.1 12C8.10001 12 6.49999 13.1 5.89999 14.7C5.59999 15.3 6.19999 16 7.39999 16H13.3Z"
                                            fill="currentColor" />
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->
                            </span>
                            <span class="menu-title">Contacts</span>
                        </a>
                        <!--end:Menu link-->
                    </div>
                    <!--end:Menu item-->
                @endcan
                @can('users-list')
                    <!--begin:Menu item-->
                    <div class="menu-item">
                        <!--begin:Menu link-->
                        <a class="menu-link {{ activeRoute(route('users.index')) }} {{ activeRoute(route('users.create')) }} {{ request()->is('users/*/edit') ? 'active' : '' }}"
                            href="{{ route('users.index') }}">
                            <span class="menu-icon">
                                <span class="svg-icon svg-icon-2">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M20 14H18V10H20C20.6 10 21 10.4 21 11V13C21 13.6 20.6 14 20 14ZM21 19V17C21 16.4 20.6 16 20 16H18V20H20C20.6 20 21 19.6 21 19ZM21 7V5C21 4.4 20.6 4 20 4H18V8H20C20.6 8 21 7.6 21 7Z"
                                            fill="currentColor" />
                                        <path opacity="0.3"
                                            d="M17 22H3C2.4 22 2 21.6 2 21V3C2 2.4 2.4 2 3 2H17C17.6 2 18 2.4 18 3V21C18 21.6 17.6 22 17 22ZM10 7C8.9 7 8 7.9 8 9C8 10.1 8.9 11 10 11C11.1 11 12 10.1 12 9C12 7.9 11.1 7 10 7ZM13.3 16C14 16 14.5 15.3 14.3 14.7C13.7 13.2 12 12 10.1 12C8.10001 12 6.49999 13.1 5.89999 14.7C5.59999 15.3 6.19999 16 7.39999 16H13.3Z"
                                            fill="currentColor" />
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->
                            </span>
                            <span class="menu-title">Users</span>
                        </a>
                        <!--end:Menu link-->
                    </div>
                    <!--end:Menu item-->
                @endcan
                @can('role-list')
                    <!--begin:Menu item-->
                    <div class="menu-item">
                        <!--begin:Menu link-->
                        <a class="menu-link {{ activeRoute(route('roles.index')) }} {{ activeRoute(route('roles.create')) }} {{ request()->is('roles/*/edit') ? 'active' : '' }}"
                            href="{{ route('roles.index') }}">
                            <span class="menu-icon">
                                <span class="svg-icon svg-icon-2">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M20 14H18V10H20C20.6 10 21 10.4 21 11V13C21 13.6 20.6 14 20 14ZM21 19V17C21 16.4 20.6 16 20 16H18V20H20C20.6 20 21 19.6 21 19ZM21 7V5C21 4.4 20.6 4 20 4H18V8H20C20.6 8 21 7.6 21 7Z"
                                            fill="currentColor" />
                                        <path opacity="0.3"
                                            d="M17 22H3C2.4 22 2 21.6 2 21V3C2 2.4 2.4 2 3 2H17C17.6 2 18 2.4 18 3V21C18 21.6 17.6 22 17 22ZM10 7C8.9 7 8 7.9 8 9C8 10.1 8.9 11 10 11C11.1 11 12 10.1 12 9C12 7.9 11.1 7 10 7ZM13.3 16C14 16 14.5 15.3 14.3 14.7C13.7 13.2 12 12 10.1 12C8.10001 12 6.49999 13.1 5.89999 14.7C5.59999 15.3 6.19999 16 7.39999 16H13.3Z"
                                            fill="currentColor" />
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->
                            </span>
                            <span class="menu-title">Roles</span>
                        </a>
                        <!--end:Menu link-->
                    </div>
                    <!--end:Menu item-->
                @endcan

                @can('email-sending-criteria-list')
                    <!--begin:Menu item-->
                    <div class="menu-item">
                        <!--begin:Menu link-->
                        <a class="menu-link {{ activeRoute(route('email-sending-criteria.index')) }} {{ activeRoute(route('email-sending-criteria.create')) }} {{ request()->is('email-sending-criteria/*/edit') ? 'active' : '' }}"
                            href="{{ route('email-sending-criteria.index') }}">
                            <span class="menu-icon">
                                <span class="svg-icon svg-icon-2">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M20 14H18V10H20C20.6 10 21 10.4 21 11V13C21 13.6 20.6 14 20 14ZM21 19V17C21 16.4 20.6 16 20 16H18V20H20C20.6 20 21 19.6 21 19ZM21 7V5C21 4.4 20.6 4 20 4H18V8H20C20.6 8 21 7.6 21 7Z"
                                            fill="currentColor" />
                                        <path opacity="0.3"
                                            d="M17 22H3C2.4 22 2 21.6 2 21V3C2 2.4 2.4 2 3 2H17C17.6 2 18 2.4 18 3V21C18 21.6 17.6 22 17 22ZM10 7C8.9 7 8 7.9 8 9C8 10.1 8.9 11 10 11C11.1 11 12 10.1 12 9C12 7.9 11.1 7 10 7ZM13.3 16C14 16 14.5 15.3 14.3 14.7C13.7 13.2 12 12 10.1 12C8.10001 12 6.49999 13.1 5.89999 14.7C5.59999 15.3 6.19999 16 7.39999 16H13.3Z"
                                            fill="currentColor" />
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->
                            </span>
                            <span class="menu-title">Email Sending Criteria</span>
                        </a>
                        <!--end:Menu link-->
                    </div>
                    <!--end:Menu item-->
                @endcan

                @canany(formDataPermissionArr())
                    <div class="menu-item pt-5">
                        <!--begin:Menu content-->
                        <div class="menu-content">
                            <span class="menu-heading fw-bold text-uppercase fs-7">Pages Data</span>
                        </div>
                        <!--end:Menu content-->
                    </div>
                    <!--end:Menu item-->
                    <!--begin:Menu item-->
                    <div data-kt-menu-trigger="click"
                        class="menu-item menu-accordion {{ activeMenuRoute(FormDataAllMenuArr()) }}">
                        {{-- <div data-kt-menu-trigger="click" class="menu-item menu-accordion hover show"> --}}
                        <!--begin:Menu link-->
                        <span class="menu-link {{ activeMenuRoute(FormDataAllMenuArr()) }}">
                            <span class="menu-icon">
                                <!--begin::Svg Icon | path: icons/duotune/communication/com005.svg-->
                                <span class="svg-icon svg-icon-2">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M20 14H18V10H20C20.6 10 21 10.4 21 11V13C21 13.6 20.6 14 20 14ZM21 19V17C21 16.4 20.6 16 20 16H18V20H20C20.6 20 21 19.6 21 19ZM21 7V5C21 4.4 20.6 4 20 4H18V8H20C20.6 8 21 7.6 21 7Z"
                                            fill="currentColor" />
                                        <path opacity="0.3"
                                            d="M17 22H3C2.4 22 2 21.6 2 21V3C2 2.4 2.4 2 3 2H17C17.6 2 18 2.4 18 3V21C18 21.6 17.6 22 17 22ZM10 7C8.9 7 8 7.9 8 9C8 10.1 8.9 11 10 11C11.1 11 12 10.1 12 9C12 7.9 11.1 7 10 7ZM13.3 16C14 16 14.5 15.3 14.3 14.7C13.7 13.2 12 12 10.1 12C8.10001 12 6.49999 13.1 5.89999 14.7C5.59999 15.3 6.19999 16 7.39999 16H13.3Z"
                                            fill="currentColor" />
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->
                            </span>
                            <span class="menu-title">Form Data</span>
                            <span class="menu-arrow"></span>
                        </span>
                        <!--end:Menu link-->
                        <!--begin:Menu sub-->
                        <div class="menu-sub menu-sub-accordion">
                            @can('city-list')
                                <!--begin:Menu item-->
                                <div class="menu-item">
                                    <!--begin:Menu link-->
                                    <a class="menu-link {{ activeRoute(route('city.index')) }}  {{ activeRoute(route('city.create')) }} {{ request()->is('city/*/edit') ? 'active' : '' }}"
                                        href="{{ route('city.index') }}">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">Cities</span>
                                    </a>
                                    <!--end:Menu link-->
                                </div>
                                <!--end:Menu item-->
                            @endcan
                            @can('branch-list')
                                <!--begin:Menu item-->
                                <div class="menu-item">
                                    <!--begin:Menu link-->
                                    <a class="menu-link {{ activeRoute(route('branch.index')) }} {{ activeRoute(route('branch.create')) }} {{ request()->is('branch/*/edit') ? 'active' : '' }}"
                                        href="{{ route('branch.index') }}">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">Branches</span>
                                    </a>
                                    <!--end:Menu link-->
                                </div>
                                <!--end:Menu item-->
                            @endcan
                            @can('vehicle-list')
                                <!--begin:Menu item-->
                                <div class="menu-item">
                                    <!--begin:Menu link-->
                                    <a class="menu-link {{ activeRoute(route('vehicle.index')) }} {{ activeRoute(route('vehicle.create')) }}  {{ activeRoute(route('vehicle.create')) }} {{ request()->is('vehicle/*/edit') ? 'active' : '' }}"
                                        href="{{ route('vehicle.index') }}">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">Vehicles</span>
                                    </a>
                                    <!--end:Menu link-->
                                </div>
                                <!--end:Menu item-->
                            @endcan
                            @can('source-list')
                                <!--begin:Menu item-->
                                <div class="menu-item">
                                    <!--begin:Menu link-->
                                    <a class="menu-link {{ activeRoute(route('source.index')) }} {{ activeRoute(route('source.create')) }} {{ request()->is('source/*/edit') ? 'active' : '' }}"
                                        href="{{ route('source.index') }}">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">Sources</span>
                                    </a>
                                    <!--end:Menu link-->
                                </div>
                                <!--end:Menu item-->
                            @endcan
                            @can('campaign-list')
                                <!--begin:Menu item-->
                                <div class="menu-item">
                                    <!--begin:Menu link-->
                                    <a class="menu-link {{ activeRoute(route('campaign.index')) }} {{ activeRoute(route('campaign.create')) }} {{ request()->is('campaign/*/edit') ? 'active' : '' }}"
                                        href="{{ route('campaign.index') }}">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">Campaigns</span>
                                    </a>
                                    <!--end:Menu link-->
                                </div>
                                <!--end:Menu item-->
                            @endcan
                            @can('bank-list')
                                <!--begin:Menu item-->
                                <div class="menu-item">
                                    <!--begin:Menu link-->
                                    <a class="menu-link {{ activeRoute(route('bank.index')) }} {{ activeRoute(route('bank.create')) }} {{ request()->is('bank/*/edit') ? 'active' : '' }}"
                                        href="{{ route('bank.index') }}">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">Banks</span>
                                    </a>
                                    <!--end:Menu link-->
                                </div>
                                <!--end:Menu item-->
                            @endcan
                        </div>
                        <!--end:Menu sub-->
                    </div>
                    <!--end:Menu item-->

                @endcanany
            </div>
            <!--end::Menu-->
        </div>
        <!--end::Menu wrapper-->
    </div>
    <!--end::sidebar menu-->
</div>
