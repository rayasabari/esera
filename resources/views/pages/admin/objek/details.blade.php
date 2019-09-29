@extends('layouts.app')

@section('head')
    <title>Details - SRA</title>
@endsection

@section('menu')
    @include('pages.admin.menu')
@endsection

@section('sub_subheader')
    <span class="kt-subheader__breadcrumbs-separator"></span>
    <a href="{{ url('/data_objek') }}" class="kt-subheader__breadcrumbs-link">Data Objek Lelang</a>
@endsection

@section('sub_sub_subheader')
    <span class="kt-subheader__breadcrumbs-separator"></span>
    <a href="{{ url('/data_objek/'.$objek->id) }}" class="kt-subheader__breadcrumbs-link">{{ $objek->nama }}</a>
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
                        {{ $objek->nama }}
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
                            {{ $objek->nama }}					 
                        </span>
                    </div>
                    <div class="kt-widget13__item">
                        <span class="kt-widget13__desc">
                            Katagori:
                        </span>
                        <span class="kt-widget13__text kt-widget13__text--bold">
                            Tanah & Bangunan {{-- nama katagorei --}}
                        </span>
                    </div>
                    <div class="kt-widget13__item">
                        <span class="kt-widget13__desc kt-align-right">
                            Deskripsi:
                        </span>
                        <span class="kt-widget13__text">
                            {{ $objek->deskripsi }}
                        </span>
                    </div>
                    <div class="kt-widget13__item">
                        <span class="kt-widget13__desc">
                            Luas Tanah:
                        </span>
                        <span class="kt-widget13__text kt-widget13__text--bold">
                            {{ $objek->luas_tanah }} m<sup>2</sup>
                        </span>
                    </div>
                    <div class="kt-widget13__item">
                        <span class="kt-widget13__desc">
                            Luas Bangunan:
                        </span>
                        <span class="kt-widget13__text kt-widget13__text--bold">
                            {{ $objek->luas_bangunan }} m<sup>2</sup>
                        </span>
                    </div>
                    <div class="kt-widget13__item">
                        <span class="kt-widget13__desc">
                            Pemilik:
                        </span>
                        <span class="kt-widget13__text kt-widget13__text--bold">
                            Dapenbun {{-- nama pemilik --}}
                        </span>
                    </div>
                    <div class="kt-widget13__item">
                        <span class="kt-widget13__desc">
                            Harga Limit:
                        </span>
                        <span class="kt-widget13__text kt-font-success kt-widget13__text--bold">
                            Rp {{ number_format($objek->harga_limit,"0",",",".") }},-
                        </span>
                    </div>
                    <div class="kt-widget13__item">
                        <span class="kt-widget13__desc">
                            Jaminan:
                        </span>
                        <span class="kt-widget13__text kt-font-brand kt-widget13__text--bold">
                           Rp {{ number_format($objek->jaminan,"0",",",".") }},-						 
                        </span>
                    </div>
                    <div class="mb-n4 kt-align-center">
                        <button type="submit" class="btn btn-primary">Edit</button>
                        <button type="submit" class="btn btn-danger">Delete</button>
                        <a href="{{ url('/data_objek') }}" class="btn btn-success">Back</a>
                    </div>
                </div>		
            </div>
        </div>
    </div>
@endsection