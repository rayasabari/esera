@extends('layouts.app-user')

@section('head')
    <title>List Hasil Lelang - SRA</title>
@endsection

@section('menu')
    @include('pages.user.menu')
@endsection

@section('sub_subheader')
    <span class="kt-subheader__breadcrumbs-separator"></span>
    <a href="{{ url('/lelang') }}" class="kt-subheader__breadcrumbs-link">List Hasil Lelang</a>
@endsection

@section('content')
    @foreach($objek as $obj)
        <div class="kt-portlet">
            <div class="kt-portlet__body">
                <div class="kt-widget kt-widget--user-profile-3">
                    <div class="kt-widget__top">
                        <div class="kt-widget__media kt-hidden-">
                            <img src="storage/foto/{{ $obj->objek_properti->foto_utama->nama_file }}" height="100" alt="image">
                        </div>
                        <div class="kt-widget__content">
                            <div class="kt-widget__head">
                                <a href="/detail/objek/{{ $obj->id }}" class="kt-widget__username">
                                    {{ $obj->objek_properti->nama }}
                                    
                                    @if (isset($obj->last_bid))
                                        <i class="flaticon2-correct kt-font-success" data-skin="dark" data-toggle="kt-tooltip" data-placement="top" title="" data-original-title="Terjual"></i>
                                    @else
                                        <i class="flaticon2-correct text-black-50" data-skin="dark" data-toggle="kt-tooltip" data-placement="top" title="" data-original-title="Belum Terjual"></i>
                                    @endif
                                    
                                </a>

                                <div class="kt-widget__action">
                                    <a href="/detail/objek/{{ $obj->id }}" class="kt-widget__username text-body">Lot. {{ $obj->kode_lot }}</a>
                                </div>
                            </div>

                            <div class="kt-widget__subhead">
                                <a href="/detail/objek/{{ $obj->id }}"><i class="flaticon2-location"></i>{{ $obj->objek_properti->provinsi->text_proper }}</a>
                                <a href="/detail/objek/{{ $obj->id }}"><i class="flaticon2-calendar-3"></i>{{ $obj->kategori->nama }}</a>
                                <a href="/detail/objek/{{ $obj->id }}"><i class="flaticon2-placeholder"></i>{{ $obj->objek_properti->pemilik->first_name .' '. $obj->objek_properti->pemilik->last_name }}</a>
                            </div>

                            <div class="kt-widget__info">
                                <div class="kt-widget__desc">
                                    {{ $obj->objek_properti->alamat.', '.ucwords(strtolower($obj->objek_properti->kelurahan->text)).', '.ucwords(strtolower($obj->objek_properti->kecamatan->text)).', '.ucwords(strtolower($obj->objek_properti->kota->text)) }}
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="kt-widget__bottom">
                        
                        <div class="kt-widget__item col-lg-3">
                            <div class="kt-widget__icon">
                                <i class="flaticon2-poll-symbol text-black-50"></i>
                            </div>
                            <div class="kt-widget__details">
                                <span class="kt-widget__title">Harga Terbentuk</span>
                                @if(isset($obj->last_bid))
                                    <span class="kt-widget__value text-success">Rp {{ number_format($obj->last_bid->jumlah_bid,0,',','.') }}</span>
                                @else 
                                    <span class="kt-widget__value text-body">-</span>
                                @endif
                            </div>
                        </div>

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
                                <i class="flaticon-medal text-black-50"></i>
                            </div>
                            <div class="kt-widget__details">
                                <span class="kt-widget__title">Pemenang</span>
                                @if(isset($obj->last_bid))
                                    <span class="kt-widget__value kt-font-brand">{{ $obj->last_bid->nipl->user->first_name.' '.$obj->last_bid->nipl->user->last_name }}</span>
                                @else 
                                    <span class="kt-widget__value text-body">-</span>
                                @endif
                            </div>
                        </div>

                        <div class="kt-widget__item col-lg-3">
                            <div class="kt-widget__details" style="position: absolute; right: 45px">
                                <span class="kt-widget__title">{{ count($obj->bid) }} Bid</span>
                                <a href="/detail/objek/{{ $obj->id }}" class="kt-widget__value kt-font-brand">View</a>
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
@endsection