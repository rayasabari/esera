@if(Auth::user()->isAdmin())
    <li class="kt-menu__item">
        <a href="{{ url('/objek') }}" class="kt-menu__link"><span class="kt-menu__link-text">Master Objek Lelang</span><i class="kt-menu__ver-arrow la la-angle-right"></i></a>
    </li>
    <li class="kt-menu__item">
        <a href="{{ url('/listing') }}" class="kt-menu__link"><span class="kt-menu__link-text">Listing Objek</span><i class="kt-menu__ver-arrow la la-angle-right"></i></a>
    </li>
    <li class="kt-menu__item">
        <a href="{{ url('/pemilik') }}" class="kt-menu__link"><span class="kt-menu__link-text">Master Pemilik Objek</span><i class="kt-menu__ver-arrow la la-angle-right"></i></a>
    </li>
    <li class="kt-menu__item">
        <a href="{{ url('/data_bidder') }}" class="kt-menu__link"><span class="kt-menu__link-text">Data Bidder</span><i class="kt-menu__ver-arrow la la-angle-right"></i></a>
    </li>
@else
@endif