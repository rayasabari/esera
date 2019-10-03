@extends('layouts.app')

@section('head')
    <title>Master Objek Lelang - SRA</title>
@endsection

@section('menu')
    @include('pages.admin.menu')
@endsection

@section('sub_subheader')
    <span class="kt-subheader__breadcrumbs-separator"></span>
    <a href="{{ url('/data_objek') }}" class="kt-subheader__breadcrumbs-link">Master Objek Lelang</a>
@endsection

@section('content')
    <div class="kt-container">
        <div class="kt-portlet kt-portlet--tab">
            <div class="kt-portlet__head">
                <div class="kt-portlet__head-label">
                    <div class="kt-portlet__head-title">
                        Master Objek Lelang
                    </div>                    
                </div>
                <div class="kt-portlet__head-toolbar">
                    <div class="dropdown show">
                        <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                            <i class="flaticon2-plus-1"></i> Tambah
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 38px, 0px);">
                            {{-- <a class="dropdown-item" href="{{ url('/objek/properti/add') }}"><i class="fa fa-home"></i> Properti</a>
                            <a class="dropdown-item" href="#"><i class="fa fa-car"></i> Kendaraan</a> --}}
                            @foreach($subkategori as $item)
                                <a class="dropdown-item mt-1" href="/add/{{ strtolower($item->kategori->nama)."/".strtolower($item->nama) }}"><i class="flaticon-add"></i><span class="mt-1" > {{ $item->nama }}</span></a>
                            @endforeach
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
                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                            <th>#</th>
                            <th>Nama Objek</th>
                            <th class="kt-align-left">Kategori</th>
                            <th class="kt-align-left">Sub Kategori</th>
                            <th class="kt-align-left">Pemilik</th>
                            <th class="kt-align-center">Harga Limit</th>
                            <th class="kt-align-center ">Jaminan</th>
                            <th class="kt-align-center" style="width: 5%"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($objek as $obj)
                        <tr>
                            <th scope="row">{{ $loop->iteration	 }}</th>
                            <td>{{ $obj->nama }}</td>
                            <td class="kt-align-left">{{ $obj->kategori->nama }}</td>
                            <td class="kt-align-left">{{ $obj->sub_kategori->nama }}</td>
                            <td class="kt-align-left">{{ $obj->pemilik->first_name. " ".$obj->pemilik->last_name }}</td>
                            <td class="kt-align-right"><b>Rp {{ number_format($obj->harga_limit,0,",",".") }},-</b></td>
                            <td class="kt-align-right"><b>Rp {{ number_format($obj->jaminan,0,",",".") }},-</b></td>
                            <td><a href="/objek/properti/{{ $obj->id }}" class="kt-badge kt-badge--success kt-badge--inline kt-badge--pill kt-badge--rounded">Detail</a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    {{-- @include('pages.admin.objek.tes') --}}
@endsection