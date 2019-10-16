<div id="kt_header" class="kt-header  kt-header--fixed " data-ktheader-minimize="on">
    <div class="kt-container ">

        <!-- begin:: Brand -->
        <div class="kt-header__brand   kt-grid__item" id="kt_header_brand">
            <a class="kt-header__brand-logo" href="?page=index">
                <img alt="Logo" src="assets/media/logos/sra-logo.gif" height="37" class="kt-header__brand-logo-default" />
                <img alt="Logo" src="assets/media/logos/sra-logo.gif" width="38px" class="kt-header__brand-logo-sticky" />
            </a>
        </div>
        <!-- end:: Brand -->

        <!-- begin: Header Menu -->
        <button class="kt-header-menu-wrapper-close" id="kt_header_menu_mobile_close_btn"><i class="la la-close"></i></button>
        <div class="kt-header-menu-wrapper kt-grid__item kt-grid__item--fluid" id="kt_header_menu_wrapper">
            <div id="kt_header_menu" class="kt-header-menu kt-header-menu-mobile ">
                <ul class="kt-menu__nav ">
                    <li class="kt-menu__item">
                        <a href="{{ url('/') }}" class="kt-menu__link"><span class="kt-menu__link-text">Home</span><i class="kt-menu__ver-arrow la la-angle-right"></i></a>
                    </li>
                    @include('pages.user.menu')
                </ul>
            </div>
        </div>
        <!-- end: Header Menu -->

        <!-- begin:: Header Topbar -->
        @include('layouts.topbar')
        <!-- end:: Header Topbar -->

    </div>
</div>