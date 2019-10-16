@if( Request::segment(1) == '' )
@else
<div class="kt-subheader   kt-grid__item" id="kt_subheader">
    <div class="kt-container">
        <div class="kt-subheader__main">
            <h3 class="kt-subheader__title">
                Home
            </h3>
            <div class="kt-subheader__breadcrumbs">
                <a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
                @yield('sub_subheader')
            </div>
        </div>
    </div>
</div>
@endif