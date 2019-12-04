@extends('layouts.app-user')

@section('head')
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="lightcase/css/lightcase.css">
    <script type="text/javascript" src="lightcase/js/lightcase.js"></script>
    <script type="text/javascript">
        jQuery(document).ready(function($) {
            $('a[data-rel^=lightcase]').lightcase();
        });
    </script>
    <style>
    .table-hover-success tbody tr:hover td, .table-hover-success tbody tr:hover th {
        background-color: #8e9af6;
        color: #0e0d17;
    }
    </style>
    <title>Detail Objek - SRA</title>
@endsection

@section('menu')
    @include('pages.user.menu')
@endsection
    
@section('sub_subheader')
    <span class="kt-subheader__breadcrumbs-separator"></span>
    <a href="{{ url('/lelang') }}" class="kt-subheader__breadcrumbs-link">{{ $objek->kategori->nama }}</a>
    <span class="kt-subheader__breadcrumbs-separator"></span>
    <a href="#" class="kt-subheader__breadcrumbs-link"> {{ $objek->sub_kategori->nama }} </a>
    <span class="kt-subheader__breadcrumbs-separator"></span>
    <a href="/detail/objek/{{ $objek->id }}" class="kt-subheader__breadcrumbs-link"> Detail </a>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-8">
            <input id="timer" type="hidden" value="{{ $objek->tgl_akhir_lelang < time() ? $objek->tgl_akhir_lelang : $objek->tgl_mulai_lelang }}">
            <div class="kt-portlet">
                <div class="kt-portlet__head">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title">
                            LOT {{ $objek->kode_lot }}
                        </h3>
                    </div>
                </div>
                <div class="kt-portlet__body">
                    <div class="row">
                        <div class="col-lg-5 pr-3">
                            <div class="">
                                <a href="storage/foto/{{ $objek->objek_properti->foto[0]->nama_file }}" data-rel="lightcase:myCollection:slideshow"><img src="storage/foto/{{ $objek->objek_properti->foto[0]->nama_file }}" class="rounded img-thumbnail"></a>
                            </div>
                            <div class="row">
                                @foreach($objek->objek_properti->foto as $key => $foto)
                                    @if($key != 0)
                                        <div class="col-lg-4">
                                            <a href="storage/foto/{{ $foto->nama_file }}" data-rel="lightcase:myCollection:slideshow"><img src="storage/foto/{{ $foto->nama_file }}" class="rounded img-thumbnail mt-4" style="height: 90px; width: 90px"></a>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
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
                                            @if(isset($objek->last_bid))
                                                <span class="kt-widget12__desc">{{ strtotime($objek->tgl_akhir_lelang) <= time() ? 'Harga Terbentuk' : 'Harga Sementara' }}</span>
                                                <span id="min-bid" class="kt-widget12__value {{ strtotime($objek->tgl_akhir_lelang) <= time() ? 'text-success' : 'text-warning' }} ">Rp {{ number_format($objek->last_bid->jumlah_bid,0,',','.') }}</span>
                                            @else
                                                <span class="kt-widget12__desc">{{ strtotime($objek->tgl_mulai_lelang) >= time() ? 'Waktu Mulai Lelang' : 'Harga Sementara' }}</span>
                                                @if(strtotime($objek->tgl_mulai_lelang) >= time() )
                                                    {{-- <span class="kt-widget12__value text-success">{{ date('d F Y H:i', strtotime($objek->tgl_mulai_lelang)) }}</span> --}}
                                                    <span class="kt-widget12__value text-success">{{ $tanggal->indo($objek->tgl_mulai_lelang, '%d %b %Y') }}  <sup class="text-danger ml-1"><small>{{ $tanggal->indo($objek->tgl_mulai_lelang, '%H:%M') .' WIB' }}</small></sup></span>
                                                @else 
                                                    <span id="min-bid" class="kt-widget12__value text-black">Rp {{ number_format($objek->objek_properti->harga_limit,0,',','.') }}</span>
                                                @endif
                                            @endif
                                        </div>
                                        <div class="kt-widget12__info">
                                            <span class="kt-widget12__desc">
                                                {{ isset($objek->last_bid) && strtotime($objek->tgl_akhir_lelang) <= time() || strtotime($objek->tgl_akhir_lelang) <= time() ? 'Pemenang' :  'Waktu Berakhir Lelang' }}
                                            </span>
                                            @if( isset($objek->last_bid) && strtotime($objek->tgl_akhir_lelang) <= time() )
                                                <span class="kt-widget12__value text-danger">{{ $bid[0]->nipl->user->first_name .' '. $bid[0]->nipl->user->last_name}}</span>
                                            @elseif(strtotime($objek->tgl_akhir_lelang) <= time() )
                                                <span class="kt-widget12__value text-body">-</span>
                                            @elseif(strtotime($objek->tgl_mulai_lelang) <= time() && strtotime($objek->tgl_akhir_lelang) >= time() )
                                                <span class="kt-widget12__value" style="color:red">
                                                    <span hidden id="waktu-hari"></span>
                                                    <span id="waktu-jam"></span> :
                                                    <span id="waktu-menit"></span> :
                                                    <span id="waktu-detik"></span>
                                                </span>
                                            @elseif(strtotime($objek->tgl_akhir_lelang) >= time() )
                                                <span class="kt-widget12__value text-success">{{ $tanggal->indo($objek->tgl_akhir_lelang, '%d %b %Y') }}  <sup class="text-danger ml-1"><small>{{ $tanggal->indo($objek->tgl_akhir_lelang, '%H:%M') .' WIB' }}</small></sup></span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>

                            @if(strtotime($objek->tgl_akhir_lelang) <= time())
                            <div class="alert alert-solid-success alert-bold" role="alert">
                                <h5 class="alert-text text-center">Lelang Selesai</h5>
                            </div>
                            @elseif(strtotime($objek->tgl_mulai_lelang) >= time())
                            <div class="alert alert-solid-warning mt-2" role="alert">
                                <div class="col-lg-3 pt-3">
                                    <div class="alert-text">
                                        <span class="font-weight-bold text-center"><h2 id="waktu-hari"></h2></span>
                                        <span class="text-center"><h6>Hari</h6></span>
                                    </div>
                                </div>
                                <div class="col-lg-3 pt-3">
                                    <div class="alert-text">
                                        <span class="font-weight-bold text-center"><h2 id="waktu-jam"></h2></span>
                                        <span class="text-center"><h6>Jam</h6></span>
                                    </div>
                                </div>
                                <div class="col-lg-3 pt-3">
                                    <div class="alert-text">
                                        <span class="font-weight-bold text-center"><h2 id="waktu-menit"></h2></span>
                                        <span class="text-center"><h6>Menit</h6></span>
                                    </div>
                                </div>
                                <div class="col-lg-3 pt-3">
                                    <div class="alert-text">
                                        <span class="font-weight-bold text-center"><h2 id="waktu-detik"></h2></span>
                                        <span class="text-center"><h6>Detik</h6></span>
                                    </div>
                                </div>
                            </div>
                            @else
                                @if(isset($nipl))
                                    @if($nipl->deposite < $objek->objek_properti->jaminan)
                                        <div class="alert alert-solid-danger alert-bold" role="alert">
                                            <h6 class="alert-text text-center">Maaf, Anda <b>tidak</b> bisa melakukan bid pada lot ini! <b>Jumlah Deposit</b> Anda <b>kurang</b> dari harga jaminan</h6>
                                        </div>
                                    @else
                                        <form method="post" action="/bid/{{ $nipl->id }}/{{ $objek->id }}">
                                            @csrf
                                            <label for="jumlah_bid">Kelipatan Bid: <b id="kelipatan" class="text-black-50">Rp {{number_format($objek->kelipatan_bid,0,',','.') }} </b></label> 
                                            <div id="jml-bid" hidden>{{ count($bid) }}</div>
                                            <div class="kt-input-icon kt-input-icon--left">
                                                <div class="input-group">
                                                    <input readonly id="jumlah_bid" onkeyup="angka(this)" value="{{ number_format($next_bid,0,',','.') }}" name="jumlah_bid" type="text" class="form-control form-control-lg font-weight-bold" placeholder="">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text bg-white"><i class="flaticon2-up text-body" id="plus-bid"></i></span>
                                                        <span class="input-group-text bg-white"><i class="flaticon2-down text-body" id="minus-bid"></i></span>
                                                        <button class="btn btn-danger" type="submit">Submit Bid!</button>
                                                    </div>
                                                </div>
                                                <span class="kt-input-icon__icon kt-input-icon__icon--left">
                                                    <span class="font-weight-bold">Rp</span>
                                                </span>
                                            </div>
                                            <div id="fb-bid1" class="invalid-feedback">Harga yang Anda masukkan kurang dari {{ count($bid) == 0 ? 'Harga Limit' : 'harga penawaran terakhir' }}!</div>
                                            <div id="fb-bid2" class="invalid-feedback">Harga yang Anda masukkan tidak sesuai dengan kelipatan bid!</div>
                                        </form>
                                    @endif
                                @else 
                                    <div class="alert alert-solid-danger alert-bold" role="alert">
                                        <h6 class="alert-text text-center">Maaf, akun Anda tidak memiliki saldo Deposit, silahkan melakukan penyetoran jaminan!</h6>
                                    </div>
                                @endif
                                <div class="">
                                    @if (session('status'))
                                        <div class="alert alert-success mt-4 mb-n1">
                                            {{ session('status') }}
                                        </div>
                                    @endif
                                    @if (session('error'))
                                        <div class="alert alert-warning mt-4 mb-n1">
                                            {{ session('error') }}
                                        </div>
                                    @endif
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            
            <div class="kt-portlet">
                <div class="kt-portlet__head">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title">
                            Lokasi
                        </h3>
                    </div>
                    <div class="kt-portlet__head-toolbar">
                    </div>
                </div>
                <div class="kt-portlet__body">
                    <div id="map"></div>
                    <input type="hidden" id="latitude" value="{{ $objek->objek_properti->latitude }}">
                    <input type="hidden" id="longitude" value="{{ $objek->objek_properti->longitude }}">
                    <div class="text-body mt-2">
                        <b>Alamat:</b>
                        {{ 
                            $objek->objek_properti->alamat.', '.ucwords(strtolower($objek->objek_properti->kelurahan->text)).', '.
                            ucwords(strtolower($objek->objek_properti->kecamatan->text)).', '.ucwords(strtolower($objek->objek_properti->kota->text)).', '.
                            ucwords(strtolower($objek->objek_properti->provinsi->text_proper))
                        }}
                    </div>
                </div>
            </div>

            <div class="kt-portlet kt-portlet--tabs">
                <div class="kt-portlet__head">
                    <div class="kt-portlet__head-toolbar">
                        <ul class="nav nav-tabs nav-tabs-line nav-tabs-line-danger nav-tabs-line-2x nav-tabs-line-right" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#tab-detail" role="tab">
                                    <i class="" aria-hidden="true"></i>Detail
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tab-lampiran" role="tab">
                                    <i class="" aria-hidden="true"></i>Lampiran
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="kt-portlet__body">
                    <div class="tab-content text-body">
                        <div class="tab-pane fade show active" id="tab-detail" role="tabpanel">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <span class="text-black-50 d-block mb-1">Tipe</span>
                                        <span><h6>{{ $objek->objek_properti->tipe }}</h6></span>
                                        <hr>
                                    </div>
                                    <div class="form-group">
                                        <span class="text-black-50 d-block mb-1">Sertifikat</span>
                                        <span><h6>{{ $objek->objek_properti->sertifikat->nama .' ('. $objek->objek_properti->sertifikat->singkatan . ')' }}</h6></span>
                                        <hr>
                                    </div>
                                    <div class="form-group">
                                        <span class="text-black-50 d-block mb-1">Luas Tanah</span>
                                        <span><h6>{{ number_format($objek->objek_properti->luas_tanah,0,',','.') }} m<sup>2</sup></h6></span>
                                        <hr>
                                    </div>
                                    <div class="form-group">
                                        <span class="text-black-50 d-block mb-1">Luas Bangunan</span>
                                        <span><h6>{{ number_format($objek->objek_properti->luas_bangunan,0,',','.') }} m<sup>2</sup></h6></span>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <span class="text-black-50 d-block mb-1">Jumlah Lantai</span>
                                        <span><h6>{{ $objek->objek_properti->jumlah_lantai }}</h6></span>
                                        <hr>
                                    </div>
                                    <div class="form-group">
                                        <span class="text-black-50 d-block mb-1">Kamar Tidur</span>
                                        <span><h6>{{ $objek->objek_properti->kamar_tidur }}</h6></span>
                                        <hr>
                                    </div>
                                    <div class="form-group">
                                        <span class="text-black-50 d-block mb-1">Kamar Mandi</span>
                                        <span><h6>{{ $objek->objek_properti->kamar_mandi }}</h6></span>
                                        <hr>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="tab-lampiran" role="tabpanel">
                            <div class="row mt-2">
                                @foreach($objek->objek_properti->dokumen as $dok)
                                    <div class="col-lg-2">
                                        <div class="kt-widget__files">
                                            <a href="/storage/dokumen/{{ $dok->nama_file }}">
                                                <div class="kt-widget__media mb-4">
                                                    <img class="kt-widget__img kt-hidden-" src="assets/media/files/pdf.svg" alt="image">
                                                </div>
                                                <span class="text-center">
                                                    <h6>{{ $dok->nama_dokumen }}</h6>
                                                </span>
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="col-lg-4">
            <div class="kt-portlet">
                <div class="kt-portlet__head">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title">
                            Simulasi Pembayaran
                        </h3>
                    </div>
                    <div class="kt-portlet__head-toolbar">
                    </div>
                </div>
                <div class="kt-portlet__body">
                    <div class="kt-widget6">
                        <table class="table table-borderless table-hover">
                            <tr>
                                <td class="text-left" style="width: 60%">Total Harga Terbentuk</td>
                                <td class="text-left" style="width: 5%"><h6>Rp</h6></td>
                                <td class="text-right" style="width: 5%">
                                    <h6 id="harga-terbentuk">
                                        @if(isset($objek->last_bid))
                                            {{ number_format($objek->last_bid->jumlah_bid + $objek->kelipatan_bid,0,',','.') }}
                                        @else 
                                            {{ number_format($objek->objek_properti->harga_limit,0,',','.') }}
                                        @endif
                                    </h6>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-left">Uang Jaminan<</td>
                                <td class="text-left"><h6>Rp</h6></td>
                                <td class="text-right">
                                    <h6 id="jaminan">
                                        {{ number_format($objek->objek_properti->jaminan ,0,',','.') }}
                                    </h6>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-left">Kekurangan Pembayaran</td>
                                <td class="text-left" style="width: 5%"><h6>Rp</h6></td>
                                <td class="text-right">
                                    <h6 id="kekurangan-pembayaran">
                                        @if(isset($objek->last_bid))
                                            {{ number_format(($objek->last_bid->jumlah_bid + $objek->kelipatan_bid) - $objek->objek_properti->jaminan ,0,',','.') }}
                                        @else
                                            {{ number_format($objek->objek_properti->harga_limit - $objek->objek_properti->jaminan ,0,',','.') }}
                                        @endif
                                    </h6>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-left">Bea Lelang  Pembeli (0,4%)</td>
                                <td class="text-left" style="width: 5%"><h6>Rp</h6></td>
                                <td class="text-right font-weight-bold">
                                    <h6 id="bea-lelang">
                                        @if(isset($objek->last_bid))
                                            {{ number_format(($objek->last_bid->jumlah_bid + $objek->kelipatan_bid) * (0.4/100) ,0,',','.') }}
                                        @else
                                            {{ number_format($objek->objek_properti->harga_limit * (0.4/100) ,0,',','.') }}
                                        @endif
                                    </h6>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-left font-weight-bold">Total yang harus dibayarkan</td>
                                <td class="text-left font-weight-bold" style="width: 5%">Rp</td>
                                <td id="total-bayar" class="text-right font-weight-bold">
                                    @if(isset($objek->last_bid))
                                        {{ number_format( (($objek->last_bid->jumlah_bid + $objek->kelipatan_bid) - $objek->objek_properti->jaminan) + (($objek->last_bid->jumlah_bid + $objek->kelipatan_bid) * (0.4/100)) ,0,',','.') }}
                                    @else
                                        {{ number_format( ($objek->objek_properti->harga_limit - $objek->objek_properti->jaminan) + ($objek->objek_properti->harga_limit * (0.4/100)) ,0,',','.') }}
                                    @endif
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="kt-portlet kt-portlet--skin-solid kt-bg-primary">
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
                    <div class="kt-widget6">
                        <table class="table table-hover-success table-borderless text-white">
                            <thead class="">
                                <tr>
                                    <th style="width: 60%">Bidder</th>
                                    <th style="width: 10%"></th>
                                    <th style="width: 30%" class="text-right">Jumlah Bid</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($bid as $b)
                                    <tr data-skin="dark" data-toggle="kt-tooltip" data-placement="left" title="{{ $tanggal->indo($b->created_at,'%d %B %Y %H:%M:%S') }}">
                                        <td>{{ $b->nipl->user->first_name .' '. $b->nipl->user->last_name }}
                                            @if( strtotime($objek->tgl_akhir_lelang) <= time() && $b->jumlah_bid == $bid[0]->jumlah_bid )
                                                <i class="flaticon-medal text-warning ml-2"></i>
                                            @endif
                                        </td>
                                        <td class="text-right">Rp</td>
                                        <td class="text-right">{{ number_format($b->jumlah_bid,0,',','.') }} </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer_script')
    <style>
        #map {
            width: 100%;
            height: 300px;
            background-color: grey;
        }
    </style>
    <script type="text/javascript" async defer src="https://maps.googleapis.com/maps/api/js?key={{$apikey}}&callback=initMap"></script>
    <script>
        // Initialize and add the map
        function initMap() {
        // The location of Uluru
        var vlatitude = $('#latitude').val();
        var vlongitude = $('#longitude').val();
        var uluru = {lat: parseFloat(vlatitude), lng: parseFloat(vlongitude) };
        // The map, centered at Uluru
        var map = new google.maps.Map(
            document.getElementById('map'), {zoom: 12, center: uluru});
        // The marker, positioned at Uluru
        var marker = new google.maps.Marker({position: uluru, map: map});
        }

        $('#jumlah_bid').keyup(function(){
            var bid         = $(this).val().replace(/[^\d]/g, "");
            var kelipatan   = $('#kelipatan').text().replace(/[^\d]/g, "");
            if($('#jml-bid').text() == '0' ){
                var minbid  = $('#min-bid').text().replace(/[^\d]/g, "");
            }else{
                var minbid  = parseInt( $('#min-bid').text().replace(/[^\d]/g, "")) + parseInt(kelipatan);
            }

            if( parseInt(bid) < parseInt(minbid) ){
                $(this).addClass("is-invalid")
                $('#fb-bid1').show()
                $('#fb-bid2').hide()
            }else if( parseInt(bid) >= parseInt(minbid) ){
                var cek = (bid - minbid) / kelipatan;
                if(Number.isInteger(cek) == true ){
                    $(this).removeClass("is-invalid")
                    $(this).addClass("is-valid")
                    $('#fb-bid1').hide()
                }else{
                    $('#fb-bid1').hide()
                    $('#fb-bid2').show()
                }
            }
        });

        function format_number(x) {
            return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        }

        $('#plus-bid').click(function(){
            var nextbid     = $('#jumlah_bid');
            var jaminan     = $('#jaminan').text().replace(/[^\d]/g, "");
            var kelipatan   = $('#kelipatan').text().replace(/[^\d]/g, "");
            var result      = parseInt(nextbid.val().split('.').join('')) + parseInt(kelipatan);
            nextbid.val(result);
            nextbid.keyup();
            var kekurangan  = parseInt(result) - parseInt(jaminan);
            $('#harga-terbentuk').text(format_number(result));
            $('#kekurangan-pembayaran').text(format_number(kekurangan));
            var bealelang   = parseInt(result) * 0.004;
            $('#bea-lelang').text(format_number(bealelang));
            var total       = parseInt(bealelang) + parseInt(kekurangan);
            $('#total-bayar').text(format_number(total));
        });

        $('#minus-bid').click(function(){
            var bid         = $('#jumlah_bid');
            var jaminan     = $('#jaminan').text().replace(/[^\d]/g, "");
            var kelipatan   = $('#kelipatan').text().replace(/[^\d]/g, "");
            var minbid      = $('#min-bid').text().replace(/[^\d]/g, "");
            if($('#jml-bid').text() == '0' ){
                var nextbid = parseInt(minbid);
            }else{
                var nextbid = parseInt(minbid) + parseInt(kelipatan);
            }
            var result      = parseInt(bid.val().split('.').join('')) - parseInt(kelipatan);
            if( result >= nextbid ){
                bid.val(result);
                bid.keyup();

                var kekurangan  = parseInt(result) - parseInt(jaminan);
                $('#harga-terbentuk').text(format_number(result));
                $('#kekurangan-pembayaran').text(format_number(kekurangan));
                var bealelang   = parseInt(result) * 0.004;
                $('#bea-lelang').text(format_number(bealelang));
                var total       = parseInt(bealelang) + parseInt(kekurangan);
                $('#total-bayar').text(format_number(total));
            }
        });

        // Set the date we're counting down to
        var timer = $('#timer').val();
        var countDownDate = new Date(timer).getTime();

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
        document.getElementById("waktu-hari").innerHTML = days ;
        document.getElementById("waktu-jam").innerHTML = hours ;
        document.getElementById("waktu-menit").innerHTML = minutes ;
        document.getElementById("waktu-detik").innerHTML = seconds ;

        // If the count down is over, write some text 
        if (distance < 0) {
            clearInterval(x);
            // document.getElementById("waktu").innerHTML = "Refresh halaman!";
            location.reload();
        }
        }, 1000);
    </script>
@endsection