@extends('layouts.app')

@section('head')
    <title>Data Objek Lelang - SRA</title>
@endsection

@section('menu')
    @include('pages.admin.menu')
@endsection

@section('sub_subheader')
    <span class="kt-subheader__breadcrumbs-separator"></span>
    <a href="{{ url('/data_objek') }}" class="kt-subheader__breadcrumbs-link">Data Objek Lelang</a>
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
                        List Objek Lelang
                    </h3>
                </div>
            </div>
            <div class="kt-portlet__body">
                <span class="mb-3 mt-n3">
                    <a href="{{ url('/data_objek/create') }}" class="btn btn-primary btn-sm">Tambah Objek</a>
                </span>
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif
                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                            <th>#</th>
                            <th>Nama Objek</th>
                            <th class="kt-align-center">Kategori</th>
                            <th class="kt-align-center">Harga Limit</th>
                            <th class="kt-align-center">Jaminan</th>
                            <th class="kt-align-center" style="width: 5%"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($objek as $obj)
                        <tr>
                            <th scope="row">{{ $loop->iteration	 }}</th>
                            <td>{{ $obj->nama }}</td>
                            <td class="kt-align-center">{{ $obj->id_kategori }}</td>
                            <td class="kt-align-center"><b>Rp {{ number_format($obj->harga_limit,0,",",".") }},-</b></td>
                            <td class="kt-align-center"><b>Rp {{ number_format($obj->jaminan,0,",",".") }},-</b></td>
                            <td><a href="/data_objek/{{ $obj->id }}" class="kt-badge kt-badge--success kt-badge--inline kt-badge--pill kt-badge--rounded">Detail</a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection