@extends('layouts.app')

@section('head')
    <title>Master Objek Lelang - SRA</title>
@endsection

@section('menu')
    @include('pages.admin.menu')
@endsection

@section('sub_subheader')
    <span class="kt-subheader__breadcrumbs-separator"></span>
    <a href="{{ url('/objek') }}" class="kt-subheader__breadcrumbs-link">Master Objek Lelang</a>
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
                        <button class="btn btn-primary dropdown-toggle btn-sm" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="false" aria-expanded="false">
                            <i class="flaticon2-plus-1"></i> Tambah
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 38px, 0px);">
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
                <table class="table table-hover">
                    <thead class="">
                        <tr>
                            <th>#</th>
                            <th>Nama Objek</th>
                            <th class="kt-align-left">Kategori</th>
                            <th class="kt-align-left">Sub Kategori</th>
                            <th class="kt-align-left">Pemilik</th>
                            <th class="kt-align-center">Harga Limit</th>
                            <th class="kt-align-center">Jaminan</th>
                            <th class="kt-align-center">Status</th>
                            <th class="kt-align-center" style="width: 5%"><i class="flaticon2-settings"></i></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($objek as $obj)
                        <tr>
                            <th scope="row" style="vertical-align: middle">{{ $loop->iteration	 }}</th>
                            <td style="vertical-align: middle"><a href="/detail/{{ strtolower($obj->kategori->nama). '/' .strtolower($obj->sub_kategori->nama). '/' .$obj->id }}" class="text-promary"> {{ $obj->nama }}</a></td>
                            <td class="kt-align-left" style="vertical-align: middle">{{ $obj->kategori->nama }}</td>
                            <td class="kt-align-left" style="vertical-align: middle">{{ $obj->sub_kategori->nama }}</td>
                            <td class="kt-align-left" style="vertical-align: middle">{{ $obj->pemilik->first_name. " ".$obj->pemilik->last_name }}</td>
                            <td class="kt-align-right" style="vertical-align: middle"><b>Rp {{ number_format($obj->harga_limit,0,",",".") }},-</b></td>
                            <td class="kt-align-right" style="vertical-align: middle"><b>Rp {{ number_format($obj->jaminan,0,",",".") }},-</b></td>
                            <td class="kt-align-center" style="vertical-align: middle">
                                @if($obj->status_objek->id == 1)
                                    <b class="text-warning">{{ $obj->status_objek->nama }}</b>
                                @elseif($obj->status_objek->id == 2)
                                    <b class="text-success">{{ $obj->status_objek->nama }}</b>
                                @elseif($obj->status_objek->id == 3)
                                    <b class="text-danger">{{ $obj->status_objek->nama }}</b>
                                @endif
                            </td>
                            <td class="kt-align-center">
                                <a href="/edit/{{ strtolower($obj->kategori->nama). '/' .strtolower($obj->sub_kategori->nama). '/' .$obj->id }}" class="text-primary" data-skin="dark" data-toggle="kt-tooltip" data-placement="top" title="" data-original-title="Edit" >
                                    <i class="fa fa-edit"></i>
                                </a>
                                <a href="/add/listing/{{ strtolower($obj->kategori->nama). '/' .strtolower($obj->sub_kategori->nama). '/' .$obj->id }}" class="text-success" data-skin="dark" data-toggle="kt-tooltip" data-placement="top" title="" data-original-title="Add to Listing" >
                                    <i class="fa fa-list-alt"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection