@extends('layouts.app')

@section('head')
    <title>Detail Objek - SRA</title>
@endsection

@section('menu')
    @include('pages.user.menu')
@endsection
    
@section('sub_subheader')
    <span class="kt-subheader__breadcrumbs-separator"></span>
    <a href="{{ url('/lelang') }}" class="kt-subheader__breadcrumbs-link">Detail Objek Lelang</a>
@endsection

@section('sub_sub_subheader')
    <span class="kt-subheader__breadcrumbs-separator"></span>
    <a href="#" class="kt-subheader__breadcrumbs-link"> LOT {{ $objek->kode_lot }}</a>
@endsection

@section('content')

<div class="kt-container">
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
    <div class="row">
        <div class="col-xl-8 col-lg-12 order-lg-3 order-xl-1">
            <!--begin:: Widgets/User Progress -->
            <div class="kt-portlet kt-portlet--height-fluid">
                <div class="kt-portlet__head">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title">
                            LOT {{ $objek->kode_lot }}
                        </h3>
                    </div>
                </div>
                <div class="kt-portlet__body">
                    <div class="row">
                        <div class="col-lg-5">
                            <img src="https://1.bp.blogspot.com/-uJMphbPemCU/VuZNtOFkIZI/AAAAAAAATGE/jCeiX29Ae28cGIt0ElK3eMQbg7TFSop-g/s1600/PENJELASAN%2BTIPE%2BRUMAH%2B21%2Bdenah1.jpg" alt="..." class="rounded img-thumbnail">
                        </div>
                        <div class="col-lg-7 pl-3">
                            <div class="mb-4">
                                <h3 class="text-body">{{ $objek->objek_properti->nama }}</h3>
                                <span class="text-muted"> {{ $objek->kategori->nama }} <i class="flaticon2-fast-next ml-2 mr-2"></i> {{ $objek->sub_kategori->nama }} </span>
                            </div>

                            <div class="kt-widget12" style="height: 160px;">
                                <div class="kt-widget12__content">
                                    <div class="kt-widget12__item">
                                        <div class="kt-widget12__info">
                                            <span class="kt-widget12__desc">Harga Limit</span>
                                            <span class="kt-widget12__value text-primary">Rp {{ number_format($objek->objek_properti->harga_limit,0,',','.') }}</span>
                                        </div>
                                        <div class="kt-widget12__info">
                                            <span class="kt-widget12__desc">Jaminan</span>
                                            <span class="kt-widget12__value text-black-50">Rp {{ number_format($objek->objek_properti->jaminan,0,',','.') }}</span>
                                        </div>
                                    </div>
                                    <div class="kt-widget12__item">
                                        <div class="kt-widget12__info">
                                            <span class="kt-widget12__desc">Harga Sementara</span>
                                            <span class="kt-widget12__value text-success">Rp {{ number_format($bid[0]->jumlah_bid,0,',','.') }}</span>
                                        </div>
                                        <div class="kt-widget12__info">
                                            <span class="kt-widget12__desc">Batas Akhir Lelang</span>
                                            <span class="kt-widget12__value text-danger">{{ date('d F Y', strtotime($objek->tgl_akhir_lelang)) }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <form method="post" action="/bid/{{ $nipl->id }}/{{ $objek->id }}">
                                @csrf
                                <label for="jumlah_bid">Kelipatan Bid: <b class="text-black-50">Rp {{number_format($objek->kelipatan_bid,0,',','.') }} </b></label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text font-weight-bold">Rp</span>
                                    </div>
                                    <input id="jumlah_bid" onkeyup="angka(this)" name="jumlah_bid" type="text" class="form-control font-weight-bold" placeholder="">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" type="submit">Submit Bid!</button>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
            <!--end:    : Widgets/User Progress -->
        </div>
        <div class="col-xl-4 col-lg-6 order-lg-3 order-xl-1">
    
            <!--begin:: Widgets/Sales States-->
            <div class="kt-portlet kt-portlet--height-fluid">
                <div class="kt-portlet__head">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title">
                            Info Objek
                        </h3>
                    </div>
                    <div class="kt-portlet__head-toolbar">
                    </div>
                </div>
                <div class="kt-portlet__body">
                    <div class="kt-widget6">
                        <table class="table table-borderless table-hover">
                            <tr>
                                <td class="text-left"><h6>Tipe</h6></td>
                                <td class="text-right">{{ $objek->objek_properti->tipe }}</td>
                            </tr>
                            <tr>
                                <td class="text-left"><h6>Sertifikat</h6></td>
                                <td class="text-right">{{ $objek->objek_properti->sertifikat->nama .' ('. $objek->objek_properti->sertifikat->singkatan . ')' }}</td>
                            </tr>
                            <tr>
                                <td class="text-left"><h6>Jumlah Lantai</h6></td>
                                <td class="text-right">{{ $objek->objek_properti->jumlah_lantai }}</td>
                            </tr>
                            <tr>
                                <td class="text-left"><h6>Kamar Tidur</h6></td>
                                <td class="text-right">{{ $objek->objek_properti->kamar_tidur }}</td>
                            </tr>
                            <tr>
                                <td class="text-left"><h6>Kamar Mandi</h6></td>
                                <td class="text-right">{{ $objek->objek_properti->kamar_mandi }}</td>
                            </tr>
                            <tr>
                                <td class="text-left"><h6>Luas Tanah</h6></td>
                                <td class="text-right">{{ $objek->objek_properti->luas_tanah }} m<sup>2</sup></td>
                            </tr>
                            <tr>
                                <td class="text-left"><h6>Luas Bangunan</h6></td>
                                <td class="text-right">{{ $objek->objek_properti->luas_bangunan }} m<sup>2</sup></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
    
            <!--end:: Widgets/Sales States-->
        </div>
    </div>
    <div class="row">
        <div class="col-xl-8 col-lg-12 order-lg-3 order-xl-1">
            <!--begin:: Widgets/User Progress -->
            <div class="kt-portlet kt-portlet--height-fluid">
                <div class="kt-portlet__head">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title">
                            Bid History
                        </h3>
                    </div>
                    <div class="kt-portlet__head-toolbar">
                    </div>
                </div>
                <div class="kt-portlet__body">
                    <table class="table table-striped">
                        <thead class="thead-dark">
                            <tr>
                                <th style="width: 30%">Waktu</th>
                                <th style="width: 10%">NIPL</th>
                                <th style="width: 30%">Bidder</th>
                                <th>Jumlah Bid</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($bid as $b)
                                <tr>
                                    <td class="text-muted">{{ $b->created_at }}</td>
                                    <td>{{ $b->nipl->nipl }}</td>
                                    <td>{{ $b->nipl->user->first_name .' '. $b->nipl->user->last_name }}</td>
                                    <td>Rp {{ number_format($b->jumlah_bid,0,',','.') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <!--end:    : Widgets/User Progress -->
        </div>
    </div>
</div>

@endsection