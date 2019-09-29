@if($user->isAdmin())
<li class="kt-menu__item">
    <a href="{{ url('/data_objek') }}" class="kt-menu__link"><span class="kt-menu__link-text">Data Objek Lelang</span><i class="kt-menu__ver-arrow la la-angle-right"></i></a>
</li>
<li class="kt-menu__item">
    <a href="{{ url('/data_listing') }}" class="kt-menu__link"><span class="kt-menu__link-text">Data Listing</span><i class="kt-menu__ver-arrow la la-angle-right"></i></a>
</li>
<li class="kt-menu__item">
    <a href="{{ url('/data_pemilik') }}" class="kt-menu__link"><span class="kt-menu__link-text">Data Pemilik Aset</span><i class="kt-menu__ver-arrow la la-angle-right"></i></a>
</li>
<li class="kt-menu__item">
    <a href="{{ url('/data_bidder') }}" class="kt-menu__link"><span class="kt-menu__link-text">Data Bidder</span><i class="kt-menu__ver-arrow la la-angle-right"></i></a>
</li>
@else
@endif