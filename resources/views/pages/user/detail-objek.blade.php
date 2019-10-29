@extends('layouts.app-user')

@section('head')
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
            <input id="jadwal_lelang" type="hidden" value="{{ $objek->tgl_mulai_lelang }}">
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
                        <div class="col-lg-5">
                            <img src="../../attachment/foto/{{ $objek->objek_properti->img }}" alt="..." class="rounded img-thumbnail">
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
                                                <span class="kt-widget12__desc">Harga Sementara</span>
                                                <span id="min-bid" class="kt-widget12__value text-black">Rp {{ number_format($objek->objek_properti->harga_limit,0,',','.') }}</span>
                                            @endif
                                        </div>
                                        <div class="kt-widget12__info">
                                            <span class="kt-widget12__desc">Batas Akhir Lelang</span>
                                            <span class="kt-widget12__value text-danger">{{ date('d F Y', strtotime($objek->tgl_akhir_lelang)) }}</span>
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
                                <form method="post" action="/bid/{{ $nipl->id }}/{{ $objek->id }}">
                                    @csrf
                                    <label for="jumlah_bid">Kelipatan Bid: <b id="kelipatan" class="text-black-50">Rp {{number_format($objek->kelipatan_bid,0,',','.') }} </b></label> 
                                    <div id="jml-bid" hidden>{{ count($bid) }}</div>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text font-weight-bold">Rp</span>
                                        </div>
                                        <input id="jumlah_bid"  onkeyup="angka(this)" value="{{ number_format($next_bid,0,',','.') }}" name="jumlah_bid" type="text" class="form-control font-weight-bold" placeholder="">
                                        <div class="input-group-append">
                                            <span class="input-group-text bg-white"><i class="flaticon2-up text-body" id="plus-bid"></i></span>
                                            <span class="input-group-text bg-white"><i class="flaticon2-down text-body" id="minus-bid"></i></span>
                                            <button class="btn btn-danger" type="submit">Submit Bid!</button>
                                        </div>
                                    </div>
                                    <div id="fb-bid1" class="invalid-feedback">Nilai yang Anda masukkan kurang dari {{ count($bid) == 0 ? 'Harga Limit' : 'harga penawaran terakhir' }}!</div>
                                    <div id="fb-bid2" class="invalid-feedback">Nilai yang Anda masukkan tidak sesuai dengan kelipatan bid!</div>
                                </form>
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
                            Simulasi Pembayaran
                        </h3>
                    </div>
                    <div class="kt-portlet__head-toolbar">
                    </div>
                </div>
                <div class="kt-portlet__body">
                    <table class="table">
                        <thead class="">
                            <tr>
                                <th>Deskripsi</th>
                                <th style="width: 20px;"></th>
                                <th style="width: 160px" class="text-right"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Total Harga Terbentuk</td>
                                <td class="font-weight-bold">Rp.</td>
                                <td class="text-right font-weight-bold">
                                    @if(isset($objek->last_bid))
                                        {{ number_format($objek->last_bid->jumlah_bid,0,',','.') }}
                                    @else 
                                        {{ number_format($objek->objek_properti->harga_limit,0,',','.') }}
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>Uang Jaminan</td>
                                <td class="font-weight-bold">Rp.</td>
                                <td class="text-right font-weight-bold">{{ number_format($objek->objek_properti->jaminan ,0,',','.') }}</td>
                            </tr>
                            <tr>
                                <td>Kekurangan Pembayaran</td>
                                <td class="font-weight-bold">Rp.</td>
                                <td class="text-right font-weight-bold">
                                    @if(isset($objek->last_bid))
                                        {{ number_format($objek->last_bid->jumlah_bid - $objek->objek_properti->jaminan ,0,',','.') }}
                                    @else
                                        {{ number_format($objek->objek_properti->harga_limit - $objek->objek_properti->jaminan ,0,',','.') }}
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>Bea Lelang  Pembeli (0,4%)</td>
                                <td class="font-weight-bold">Rp.</td>
                                <td class="text-right font-weight-bold">{{ number_format($objek->objek_properti->harga_limit * (0.4/100) ,0,',','.') }}</td>
                            </tr>
                            <tr>
                                <td style="font-size: 12pt" class="font-weight-bold">Total yang harus dibayarkan</td>
                                <td style="font-size: 12pt" class="font-weight-bold">Rp.</td>
                                <td style="font-size: 12pt" class="text-right font-weight-bold">
                                    @if(isset($objek->last_bid))
                                        {{ number_format( ($objek->last_bid->jumlah_bid - $objek->objek_properti->jaminan) + ($objek->objek_properti->harga_limit * (0.4/100)) ,0,',','.') }}
                                    @else
                                        {{ number_format( ($objek->objek_properti->harga_limit - $objek->objek_properti->jaminan) + ($objek->objek_properti->harga_limit * (0.4/100)) ,0,',','.') }}
                                    @endif
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="kt-portlet">
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
        </div>
        <div class="col-lg-4">
            <div class="kt-portlet">
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
                                <td class="text-left" style="width: 40%"><h6>Tipe</h6></td>
                                <td class="text-right" style="width: 60%">{{ $objek->objek_properti->tipe }}</td>
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
            <div class="kt-portlet">
                <div class="kt-portlet__head">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title">
                            Lokasi Objek
                        </h3>
                    </div>
                    <div class="kt-portlet__head-toolbar">
                    </div>
                </div>
                <div class="kt-portlet__body">
                    <div class="kt-widget6">
                        <div id="map"></div>
                        <input type="hidden" id="latitude" value="{{ $objek->objek_properti->latitude }}">
                        <input type="hidden" id="longitude" value="{{ $objek->objek_properti->longitude }}">
                    </div>
                    <div class="alert alert-elevate alert-light ">
                    {{ 
                        $objek->objek_properti->alamat.', '.ucwords(strtolower($objek->objek_properti->kelurahan->text)).', '.
                        ucwords(strtolower($objek->objek_properti->kecamatan->text)).', '.ucwords(strtolower($objek->objek_properti->kota->text)).', '.
                        ucwords(strtolower($objek->objek_properti->provinsi->text_proper))
                    }}
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
            height: 250px;
            background-color: grey;
        }
    </style>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key={{$apikey}}&callback=initMap"></script>
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

        $('#plus-bid').click(function(){
            var nextbid     = $('#jumlah_bid');
            var kelipatan   = $('#kelipatan').text().replace(/[^\d]/g, "");
            var result      = parseInt(nextbid.val().split('.').join('')) + parseInt(kelipatan);
            nextbid.val(result);
            nextbid.keyup();
        });

        $('#minus-bid').click(function(){
            var bid         = $('#jumlah_bid');
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
            }
        });

        // Set the date we're counting down to
        var jadwal = $('#jadwal_lelang').val()
        var countDownDate = new Date(jadwal).getTime();

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
            document.getElementById("waktu").innerHTML = "Refresh halaman!";
            document.getElementById("hari").innerHTML = "Refresh halaman";
        }
        }, 1000);
    </script>
@endsection