@extends('layouts.app')

@section('head')
    <title>Details - SRA</title>
@endsection

@section('menu')
    @include('pages.admin.menu')
@endsection

@section('sub_subheader')
    <span class="kt-subheader__breadcrumbs-separator"></span>
    <a href="{{ url('/objek') }}" class="kt-subheader__breadcrumbs-link">Master Objek Lelang</a>
@endsection

@section('sub_sub_subheader')
    <span class="kt-subheader__breadcrumbs-separator"></span>
    <a href="{{ url('/detail/'.Request::segment(2).'/'.Request::segment(3).'/'.$properti->id) }}" class="kt-subheader__breadcrumbs-link">Detail</a>
@endsection

@section('content')
    <div class="kt-container">
        <div class="kt-portlet kt-portlet--tab">
            <div class="kt-portlet__head">
                <div class="kt-portlet__head-label">
                    <span class="kt-portlet__head-icon kt-hide">
                        <i class="la la-gear"></i>
                    </span>
                    <h3 class="kt-portlet__head-title">
                        {{ $properti->nama }}
                    </h3>
                </div>
            </div>
            <div class="kt-portlet__body">
                <div class="kt-widget13">
                    <div class="kt-widget13__item">
                        <span class="kt-widget13__desc">
                            Nama Objek:
                        </span>
                        <span class="kt-widget13__text kt-widget13__text--bold">
                            {{ $properti->nama }}
                        </span>
                    </div>
                    <div class="kt-widget13__item">
                        <span class="kt-widget13__desc">
                            Katagori:
                        </span>
                        <span class="kt-widget13__text kt-widget13__text--bold">
                            {{ $properti->kategori->nama }} - {{ $properti->sub_kategori->nama }}
                        </span>
                    </div>
                    <div class="kt-widget13__item">
                        <span class="kt-widget13__desc kt-align-right">
                            Deskripsi:
                        </span>
                        <span class="kt-widget13__text kt-widget13__text--bold">
                            {{ $properti->deskripsi }}
                        </span>
                    </div>
                    <div class="kt-widget13__item">
                        <span class="kt-widget13__desc kt-align-right">
                            Alamat:
                        </span>
                        <span class="kt-widget13__text kt-widget13__text--bold">
                            {{ $properti->alamat.', '.$properti->kelurahan->text.', '.$properti->kecamatan->text.', '.$properti->kota->text.', '.$properti->provinsi->text }}
                        </span>
                    </div>
                    <div class="kt-widget13__item">
                        <span class="kt-widget13__desc kt-align-right">
                            Tipe:
                        </span>
                        <span class="kt-widget13__text kt-widget13__text--bold">
                            {{ $properti->tipe }}
                        </span>
                    </div>
                    <div class="kt-widget13__item">
                        <span class="kt-widget13__desc kt-align-right">
                            Sertifikat:
                        </span>
                        <span class="kt-widget13__text kt-widget13__text--bold">
                            {{ $properti->sertifikat->nama." (".$properti->sertifikat->singkatan.")" }}
                        </span>
                    </div>
                    <div class="kt-widget13__item">
                        <span class="kt-widget13__desc kt-align-right">
                            Jumlah Lantai:
                        </span>
                        <span class="kt-widget13__text kt-widget13__text--bold">
                            {{ $properti->jumlah_lantai }} lantai
                        </span>
                    </div>
                    <div class="kt-widget13__item">
                        <span class="kt-widget13__desc kt-align-right">
                            Jumlah Kamar Tidur:
                        </span>
                        <span class="kt-widget13__text kt-widget13__text--bold">
                            {{ $properti->kamar_tidur }} KT
                        </span>
                    </div>
                    <div class="kt-widget13__item">
                        <span class="kt-widget13__desc kt-align-right">
                            Jumlah Kamar Mandi:
                        </span>
                        <span class="kt-widget13__text kt-widget13__text--bold">
                            {{ $properti->kamar_mandi }} KM
                        </span>
                    </div>
                    <div class="kt-widget13__item">
                        <span class="kt-widget13__desc">
                            Luas Tanah:
                        </span>
                        <span class="kt-widget13__text kt-widget13__text--bold">
                            {{ $properti->luas_tanah }} m<sup>2</sup>
                        </span>
                    </div>
                    <div class="kt-widget13__item">
                        <span class="kt-widget13__desc">
                            Luas Bangunan:
                        </span>
                        <span class="kt-widget13__text kt-widget13__text--bold">
                            {{ $properti->luas_bangunan }} m<sup>2</sup>
                        </span>
                    </div>
                    <div class="kt-widget13__item">
                        <span class="kt-widget13__desc">
                            Pemilik:
                        </span>
                        <span class="kt-widget13__text kt-widget13__text--bold">
                            {{ $properti->pemilik->first_name }} {{ $properti->pemilik->last_name }}
                        </span>
                    </div>
                    <div class="kt-widget13__item">
                        <span class="kt-widget13__desc">
                            Harga Limit:
                        </span>
                        <span class="kt-widget13__text kt-font-success kt-widget13__text--bold">
                            Rp {{ number_format($properti->harga_limit,"0",",",".") }},-
                        </span>
                    </div>
                    <div class="kt-widget13__item">
                        <span class="kt-widget13__desc">
                            Jaminan:
                        </span>
                        <span class="kt-widget13__text kt-font-brand kt-widget13__text--bold">
                            Rp {{ number_format($properti->jaminan,"0",",",".") }},-						 
                        </span>
                    </div>
                    <div class="mb-n4 kt-align-center">
                        <a href="{{ url('/edit/'.strtolower($properti->kategori->nama).'/'.strtolower($properti->sub_kategori->nama).'/'.$properti->id) }}" type="submit" class="btn btn-primary">Edit</a>
                        <form action="{{ '/delete/'.strtolower($properti->kategori->nama).'/'.strtolower($properti->sub_kategori->nama).'/'.$properti->id }}" method="POST" class="d-inline">
                            @method('delete')
                            @csrf
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                        <a href="{{ url('/objek') }}" class="btn btn-success">Back</a>
                    </div>
                </div>		
            </div>
        </div>
    </div>
@endsection