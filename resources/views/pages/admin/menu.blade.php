@if(Auth::user()->isAdmin())
    <li class="kt-menu__item  kt-menu__item--submenu kt-menu__item--rel" data-ktmenu-submenu-toggle="click" aria-haspopup="true"><a href="javascript:;" class="kt-menu__link kt-menu__toggle">
        <span class="kt-menu__link-text">Master Objek</span>
        <i class="kt-menu__ver-arrow la la-angle-right"></i></a>
        <div class="kt-menu__submenu kt-menu__submenu--classic kt-menu__submenu--left">
            <ul class="kt-menu__subnav">
                <li class="kt-menu__item " aria-haspopup="true">
                <a href=" {{ url('/objek/properti') }} " class="kt-menu__link ">
                        <i class="la la-home mr-4"></i>
                        <span class="kt-menu__link-text">Properti</span>
                    </a>
                </li>
                <li class="kt-menu__item " aria-haspopup="true">
                    <a href=" {{ url('/objek/kendaraan') }} " class="kt-menu__link ">
                        <i class="la la-car mr-4"></i>
                        <span class="kt-menu__link-text">Kendaraan</span>
                    </a>
                </li>
            </ul>
        </div>
    </li>
    <li class="kt-menu__item">
        <a href="{{ url('/listing') }}" class="kt-menu__link"><span class="kt-menu__link-text">Listing Objek</span><i class="kt-menu__ver-arrow la la-angle-right"></i></a>
    </li>
    <li class="kt-menu__item">
        <a href="{{ url('/pemilik') }}" class="kt-menu__link"><span class="kt-menu__link-text">Master Pemilik Objek</span><i class="kt-menu__ver-arrow la la-angle-right"></i></a>
    </li>
    <li class="kt-menu__item">
        <a href="{{ url('/bidder') }}" class="kt-menu__link"><span class="kt-menu__link-text">Data Bidder</span><i class="kt-menu__ver-arrow la la-angle-right"></i></a>
    </li>
    <li class="kt-menu__item">
        <a href="{{ url('/users') }}" class="kt-menu__link"><span class="kt-menu__link-text">Data User</span><i class="kt-menu__ver-arrow la la-angle-right"></i></a>
    </li>
@else
@endif