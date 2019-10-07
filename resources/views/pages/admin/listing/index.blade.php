@extends('layouts.app')

@section('head')
    <title>Listing Objek - SRA</title>
@endsection

@section('menu')
    @include('pages.admin.menu')
@endsection

@section('sub_subheader')
    <span class="kt-subheader__breadcrumbs-separator"></span>
    <a href="{{ url('/listing') }}" class="kt-subheader__breadcrumbs-link">Master Listing Objek</a>
@endsection

@section('content')
    <div class="kt-container">
        <div class="kt-portlet kt-portlet--tab">
            <div class="kt-portlet__head">
                <div class="kt-portlet__head-label">
                    <div class="kt-portlet__head-title">
                        Data Listing Objek
                    </div>                    
                </div>
                <div class="kt-portlet__head-toolbar">
                    <div class="dropdown show">
                        <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="false" aria-expanded="false">
                            <i class="flaticon2-plus-1"></i> Tambah
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 38px, 0px);">
                            {{-- <a class="dropdown-item" href="{{ url('/objek/properti/add') }}"><i class="fa fa-home"></i> Properti</a>
                            <a class="dropdown-item" href="#"><i class="fa fa-car"></i> Kendaraan</a> --}}
                            {{-- @foreach($subkategori as $item)
                                <a class="dropdown-item mt-1" href="/add/{{ strtolower($item->kategori->nama)."/".strtolower($item->nama) }}"><i class="flaticon-add"></i><span class="mt-1" > {{ $item->nama }}</span></a>
                            @endforeach --}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="kt-portlet__body">
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif
                <table class="table table-striped">
                    <thead class="thead-dark">
                        <tr>
                            <th>#</th>
                            <th>Nama Objek</th>
                            <th class="kt-align-left">Pemilik</th>
                            <th class="kt-align-left">Kode Lot</th>
                            <th class="kt-align-center">Tgl Mulai Lelang</th>
                            <th class="kt-align-center">Tgl Akhir Lelang</th>
                            <th class="kt-align-center">Harga Limit</th>
                            <th class="kt-align-center">Jaminan</th>
                            <th class="kt-align-center">Status</th>
                            <th class="kt-align-center" style="width: 2%"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($objek as $obj)
                        <tr>
                            <th scope="row" style="vertical-align: middle">{{ $loop->iteration	 }}</th>
                            <td style="vertical-align: middle">{{ $obj->objek_properti->nama }}</td>
                            <td class="kt-align-left" style="vertical-align: middle">{{ $obj->objek_properti->pemilik->first_name .' '. $obj->objek_properti->pemilik->last_name }}</td>
                            <td class="kt-align-left" style="vertical-align: middle">{{ $obj->kode_lot}}</td>
                            <td class="kt-align-center" style="vertical-align: middle">{{ date("d F Y", strtotime( $obj->tgl_mulai_lelang)) }}</td>
                            <td class="kt-align-center" style="vertical-align: middle">{{ date("d F Y", strtotime( $obj->tgl_akhir_lelang)) }}</td>
                            <td class="kt-align-right" style="vertical-align: middle"><b>Rp {{ number_format($obj->objek_properti->harga_limit,0,",",".") }},-</b></td>
                            <td class="kt-align-right" style="vertical-align: middle"><b>Rp {{ number_format($obj->objek_properti->jaminan,0,",",".") }},-</b></td>

                            {{-- <td>
                                <a href="/edit/{{ strtolower($obj->kategori->nama). '/' .strtolower($obj->sub_kategori->nama). '/' .$obj->id }}" class="text-primary" data-skin="dark" data-toggle="kt-tooltip" data-placement="top" title="" data-original-title="Edit" >
                                    <i class="fa fa-edit"></i>
                                </a>
                            </td> --}}
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection