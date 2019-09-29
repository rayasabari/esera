@extends('layouts.app')

@section('head')
    <title>Tambah Data Objek - SRA</title>
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
    <a href="{{ url('/data_objek/create') }}" class="kt-subheader__breadcrumbs-link">Tambah</a>
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
                        Tambah Data Objek
                    </h3>
                </div>
            </div>
            <div class="kt-portlet__body">
                <form method="post" action="/data_objek">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Nama Objek</label>
                                <input type="text" class="form-control" placeholder="" name="nama">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Kategori</label>
                                <input type="text" class="form-control" placeholder="" name="kategori">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Luas Tanah</label>
                                <input type="text" class="form-control" placeholder="" name="luas_tanah">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Luas Bangunan</label>
                                <input type="text" class="form-control" placeholder="" name="luas_bangunan">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Harga Limit</label>
                                <input type="text" class="form-control" placeholder="" name="harga_limit">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Jaminan</label>
                                <input type="text" class="form-control" placeholder="" name="jaminan">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Pemilik</label>
                                <input type="text" class="form-control" placeholder="" name="pemilik">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Deskripsi</label>
                                <input type="text" class="form-control" placeholder="" name="deskripsi">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection