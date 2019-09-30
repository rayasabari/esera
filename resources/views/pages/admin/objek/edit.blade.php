@extends('layouts.app')

@section('head')
    <title>Edit Data Objek - SRA</title>
@endsection

@section('menu')
    @include('pages.admin.menu')
@endsection

@section('sub_subheader')
    <span class="kt-subheader__breadcrumbs-separator"></span>
    <a href="{{ url('/data_objek') }}" class="kt-subheader__breadcrumbs-link">Edit Data Objek Lelang</a>
@endsection

@section('sub_sub_subheader')
    <span class="kt-subheader__breadcrumbs-separator"></span>
    <a href="{{ url('/data_objek/edit') }}" class="kt-subheader__breadcrumbs-link">Edit</a>
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
                        Edit Data Objek
                    </h3>
                </div>
            </div>
            <div class="kt-portlet__body">
                <form method="post" action="/data_objek/{{ $objek->id }}">
                    @method('patch')
                    @csrf
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Nama Objek</label>
                                <input type="text" class="form-control @error('nama') is-invalid @enderror" placeholder="" name="nama" value="{{ $objek->nama }}" >
                                @error('nama')
                                    <div class="invalid-feedback">{{ $message  }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Kategori</label>
                                    <input type="text" class="form-control @error('id_kategori') is-invalid @enderror" placeholder="" name="id_kategori" value="{{ $objek->id_kategori}}">
                                @error('id_kategori')
                                    <div class="invalid-feedback">{{ $message  }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Luas Tanah</label>
                                <input type="text" class="form-control" placeholder="" name="luas_tanah" value="{{ $objek->luas_tanah }}">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Luas Bangunan</label>
                                <input type="text" class="form-control" placeholder="" name="luas_bangunan" value="{{ $objek->luas_bangunan }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Harga Limit</label>
                                <input type="text" class="form-control" placeholder="" name="harga_limit" value="{{ $objek->harga_limit }}">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Jaminan</label>
                                <input type="text" class="form-control" placeholder="" name="jaminan" value="{{ $objek->jaminan }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Pemilik</label>
                                <input type="text" class="form-control" placeholder="" name="id_pemilik" value="{{ $objek->id_pemilik }}">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Deskripsi</label>
                                {{-- <input type="text" class="form-control" placeholder="" name="deskripsi" value="{{ $objek->deskripsi }}"> --}}
                                <textarea class="form-control" rows="3" name="deskripsi">{{ $objek->deskripsi }}</textarea>
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