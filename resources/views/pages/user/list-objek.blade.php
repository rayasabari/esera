@extends('layouts.app')

@section('head')
    <title>List Objek Lelang - SRA</title>
@endsection

@section('menu')
    @include('pages.user.menu')
@endsection

@section('sub_subheader')
    <span class="kt-subheader__breadcrumbs-separator"></span>
    <a href="{{ url('/lelang') }}" class="kt-subheader__breadcrumbs-link">List Objek Lelang</a>
@endsection

@section('content')
    <div class="kt-container">
        @foreach($objek as $obj)
            <div class="kt-portlet">
                <div class="kt-portlet__body">
                    <div class="kt-widget kt-widget--user-profile-3">
                        <div class="kt-widget__top">
                            <div class="kt-widget__media kt-hidden-">
                                <img src="https://1.bp.blogspot.com/-uJMphbPemCU/VuZNtOFkIZI/AAAAAAAATGE/jCeiX29Ae28cGIt0ElK3eMQbg7TFSop-g/s1600/PENJELASAN%2BTIPE%2BRUMAH%2B21%2Bdenah1.jpg" alt="image">
                            </div>
                            <div class="kt-widget__content">
                                <div class="kt-widget__head">
                                    <a href="/detail/objek/{{ $obj->id }}" class="kt-widget__username">
                                        {{ $obj->objek_properti->nama }}    
                                        <i class="flaticon2-correct kt-font-success"></i>                       
                                    </a>

                                    <div class="kt-widget__action">
                                        <a href="/detail/objek/{{ $obj->id }}" class="kt-widget__username">LOT {{ $obj->kode_lot }}</a>
                                    </div>
                                </div>

                                <div class="kt-widget__subhead">
                                    <a href="#"><i class="flaticon2-location"></i>{{ $obj->objek_properti->provinsi->text }}</a>
                                    <a href="#"><i class="flaticon2-calendar-3"></i>{{ $obj->kategori->nama }}</a>
                                    <a href="#"><i class="flaticon2-placeholder"></i>{{ $obj->objek_properti->pemilik->first_name .' '. $obj->objek_properti->pemilik->last_name }}</a>
                                </div>

                                <div class="kt-widget__info">
                                    <div class="kt-widget__desc">
                                        {{ $obj->objek_properti->deskripsi }}
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="kt-widget__bottom">
                            <div class="kt-widget__item col-lg-3">
                                <div class="kt-widget__icon">
                                    <i class="flaticon-price-tag text-black-50"></i>
                                </div>
                                <div class="kt-widget__details">
                                    <span class="kt-widget__title">Harga Limit</span>
                                    <span class="kt-widget__value text-danger">Rp {{ number_format($obj->objek_properti->harga_limit,0,',','.') }}</span>
                                </div>
                            </div>

                            <div class="kt-widget__item col-lg-3">
                                <div class="kt-widget__icon">
                                    <i class="flaticon-safe-shield-protection text-black-50"></i>
                                </div>
                                <div class="kt-widget__details">
                                    <span class="kt-widget__title">Jaminan</span>
                                    <span class="kt-widget__value kt-font-brand">Rp {{ number_format($obj->objek_properti->jaminan,0,',','.') }}</span>
                                </div>
                            </div>

                            <div class="kt-widget__item col-lg-3">
                                <div class="kt-widget__icon">
                                    <i class="flaticon2-poll-symbol text-black-50"></i>
                                </div>
                                <div class="kt-widget__details">
                                    <span class="kt-widget__title">On going Bid</span>
                                    @if(isset($obj->bid))
                                        <span class="kt-widget__value text-warning">Rp {{ number_format($obj->bid->jumlah_bid,0,',','.') }}</span>
                                    @else 
                                        <span class="kt-widget__value text-success">Open Bid</span>
                                    @endif
                                </div>
                            </div>

                            <div class="kt-widget__item col-lg-3">
                                <div class="kt-widget__details" style="position: absolute; right: 45px">
                                    <span class="kt-widget__title">{{ count($obj->bid_count) }} Bid</span>
                                    <a href="#" class="kt-widget__value kt-font-brand">View</a>
                                </div>
                                <div class="kt-widget__icon" style="position: absolute; right: 0">
                                    <i class="flaticon-users text-black-50 ml-3"></i>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection