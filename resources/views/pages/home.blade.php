@extends('layouts.app-user')

@section('head')
    <title>Home | SRA</title>
    <style>
        /* Extra small devices (phones, 600px and down) */
        @media only screen and (max-width: 600px) {
        .padsearch {padding: 5% 0% 5% 0%}
        }

        /* Small devices (portrait tablets and large phones, 600px and up) */
        @media only screen and (min-width: 600px) {
        .padsearch {padding: 5% 0% 5% 0%}
        }

        /* Medium devices (landscape tablets, 768px and up) */
        @media only screen and (min-width: 768px) {
        .padsearch {padding: 7% 15% 7% 15%; margin-bottom: 5%}
        } 

        /* Large devices (laptops/desktops, 992px and up) */
        @media only screen and (min-width: 992px) {
        .padsearch {padding: 7% 15% 7% 15%; margin-bottom: 5%}
        } 

        /* Extra large devices (large laptops and desktops, 1200px and up) */
        @media only screen and (min-width: 1200px) {
        .padsearch {padding: 7% 15% 7% 15%; margin-bottom: 5%}
        }
    </style>
@endsection

@section('menu')
    @include('pages.user.menu')
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="padsearch">
                <div class="kt-input-icon kt-input-icon--left">
                    <div class="input-group">
                        <input type="text" class="form-control form-control-lg" placeholder="Pencarian..." id="generalSearch">
                        {{-- <input type="text" class="form-control" placeholder="Search for..."> --}}
                        <div class="input-group-append">
                            <button class="btn btn-warning pl-5 pr-5" type="button">Cari</button>
                        </div>
                    </div>
                    <span class="kt-input-icon__icon kt-input-icon__icon--left">
                        <span><i class="la la-search"></i></span>
                    </span>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        @foreach($listing as $list)
        
        <div class="col-xl-3 col-lg-4 col-md-6 order-lg-2 order-xl-1">
            <input type="hidden" id="id_listing" value="{{ $list->id }}">
            <input type="hidden" id="batas_lelang{{ $list->id }}" value="{{ $list->tgl_akhir_lelang }}">
            <!--begin:: Widgets/Blog-->
            <div class="kt-portlet kt-portlet--height-fluid kt-widget19">
                <div class="kt-portlet__body kt-portlet__body--fit kt-portlet__body--unfill" style="cursor: pointer;" onclick="window.location='{{ url('/detail/objek/'.$list->id) }}';">
                    <div class="kt-widget19__pic kt-portlet-fit--top kt-portlet-fit--sides" style="min-height: 300px; background-image: url({{ '../../attachment/foto/'.$list->objek_properti->img }})">
                        <h4 class="kt-widget19__title kt-font-light">Lot. #{{ $list->kode_lot }}</h4>
                        <div class="kt-widget19__shadow"></div>
                        <div class="kt-widget19__labels">
                            @if($list->tgl_mulai_lelang <= date('Y-m-d') && $list->tgl_akhir_lelang >= date('Y-m-d') )
                                <a href="#" style="background: red;color:white" class="btn btn-bold">Live! <span id="waktu{{ $list->id }}"></span> </a>
                            @elseif($list->tgl_mulai_lelang >= date('Y-m-d'))
                                <a href="#" class="btn btn-brand btn-bold ">Segera</a>
                            @elseif($list->tgl_akhir_lelang <= date('Y-m-d'))
                                <a href="#" class="btn btn-success btn-bold ">Selesai</a>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="kt-portlet__body">
                    <div class="kt-widget19__wrapper mb-n1">
                        <div class="kt-widget19__content">
                            <div class="kt-widget19__info ml-n3">
                                <a href="/detail/objek/{{ $list->id }}" class="kt-widget19__username">
                                    {{ $list->objek_properti->nama }}
                                </a>
                                <span class="kt-widget19__time">
                                    LT: {{ $list->objek_properti->luas_tanah }} m<sup>2</sup> <a class="mr-4">&nbsp;</a>
                                    LB: {{ $list->objek_properti->luas_bangunan }} m<sup>2</sup>
                                </span>
                            </div>
                            <div class="kt-widget19__stats">
                                <span class="kt-widget19__number kt-font-brand">{{ count($list->bid) }}</span>
                                <a href="#" class="kt-widget19__comment">Bid</a>
                            </div>
                        </div>
                        <div class="kt-widget19__text">
                            <div class="kt-widget kt-widget--user-profile-3">
                                <div class="kt-widget__bottom mt-n2">
                                    <div class="kt-widget__item" style="padding: 2% 0% 0 0%; background:  ;">
                                        <div class="kt-widget__icon">
                                            <i class="flaticon-price-tag text-warning"></i>
                                        </div>
                                        <div class="kt-widget__details">
                                            <span class="kt-widget__title">Harga Limit</span>
                                            <span class="kt-widget__value"><a href="/detail/objek/{{ $list->id }}" class="text-body">Rp {{ number_format($list->objek_properti->harga_limit,0,',','.') }}</a></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end:: Widgets/Blog-->

        </div>
        @endforeach
    </div>
@endsection

@section('footer_script')
    <script>
        // Set the date we're counting down to
        var id_listing      = $('#id_listing').val()
        var jadwal          = $('#batas_lelang'+ id_listing ).val()
        var countDownDate   = new Date(jadwal).getTime();

        // Update the count down every 1 second
        var x = setInterval(function() {

        // Get today's date and time
        var now = new Date().getTime();
            
        // Find the distance between now and the count down date
        var distance = countDownDate - now;
            
        // Time calculations for days, hours, minutes and seconds
        var days = Math.floor(distance / (1000 * 60 * 60 * 24));
        var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((distance % (1000 * 60)) / 1000);
            
        // Output the result in an element with id="demo"
        document.getElementById("waktu"+id_listing).innerHTML = hours + " : " + minutes + " : " + seconds;
            
        // If the count down is over, write some text 
        if (distance < 0) {
            clearInterval(x);
            document.getElementById("waktu"+id_listing).innerHTML = "Refresh halaman!";
        }
        }, 1000);
    </script>
@endsection