@extends('layouts.app')

@section('head')
    <title>{{ $act == 'add' ? 'Tambah' : 'Edit' }} Listing - SRA</title>
@endsection

@section('menu')
    @include('pages.admin.menu')
@endsection

@section('sub_subheader')
    <span class="kt-subheader__breadcrumbs-separator"></span>
    <a href="{{ url('/objek') }}" class="kt-subheader__breadcrumbs-link">Listing</a>
@endsection

@section('sub_sub_subheader')
    <span class="kt-subheader__breadcrumbs-separator"></span>
    <a href="{{ url('/'.$act.'/listing/'.Request::segment(2).'/'.Request::segment(3)) }}" class="kt-subheader__breadcrumbs-link">{{ $act == 'add' ? 'Tambah' : 'Edit' }} Listing</a>
@endsection

@section('content')
    <div class="kt-container">
        @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
        @endif
        <div class="kt-portlet kt-portlet--tab">
            <div class="kt-portlet__head">
                <div class="kt-portlet__head-label">
                    <span class="kt-portlet__head-icon kt-hide">
                        <i class="la la-gear"></i>
                    </span>
                    <h3 class="kt-portlet__head-title">
                        {{ $act == 'add' ? 'Tambah' : 'Edit' }} Listing   
                    </h3>
                </div>
            </div>
            <div class="kt-portlet__body">
                <form method="post" action="/{{ $act }}/listing/{{ Request::segment(3)}}/{{ Request::segment(4)}}/{{ Request::segment(5) }}">
                    @if($act == 'edit') @method('patch') @endif
                    @csrf
                    <input type="hidden" name="id_kategori" value="{{ $objek->id_kategori }}">
                    <input type="hidden" name="id_sub_kategori" value="{{ $objek->id_sub_kategori }}">
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="kt-widget__body">
                                @include('pages.admin.listing.detail-'.Request::segment(4))
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label>Kode Lot <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('kode_lot') is-invalid @enderror" placeholder="" name="kode_lot" value="{{ $act == 'add' ? old('kode_lot') : old('kode_lot',$listing->kode_lot) }}">
                                @error('kode_lot')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Kelipatan Bid <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <div class="input-group-prepend"><span class="input-group-text">Rp</span></div>
                                    <input type="text" onkeyup="angka(this)" onblur="angka(this)" class="form-control font-weight-bold @error('kelipatan_bid') is-invalid @enderror" placeholder="" name="kelipatan_bid" value="{{ $act == 'add' ? old('kelipatan_bid') : old('kelipatan_bid', number_format($listing->kelipatan_bid,0,",",".")) }}">
                                </div>
                                @error('kelipatan_bid')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Tanggal Mulai Lelang <span class="text-danger">*</span></label>
                                <input type="datetime-local" class="form-control @error('tgl_mulai_lelang') is-invalid @enderror" placeholder="" name="tgl_mulai_lelang" value="{{ $act == 'add' ? old('tgl_mulai_lelang') : old('tgl_mulai_lelang', date('Y-m-d\TH:i', strtotime($listing->tgl_mulai_lelang))) }}">
                                @error('tgl_mulai_lelang')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Tanggal Berakhir Lelalng <span class="text-danger">*</span></label>
                                <input type="datetime-local" class="form-control @error('tgl_akhir_lelang') is-invalid @enderror" placeholder="" name="tgl_akhir_lelang" value="{{ $act == 'add' ? old('tgl_akhir_lelang') : old('tgl_akhir_lelang', date('Y-m-d\TH:i', strtotime($listing->tgl_akhir_lelang))) }}">
                                @error('tgl_akhir_lelang')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <a href="/listing" class="btn btn-secondary">Kembali</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
