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
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
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
                            <i class="flaticon2-plus"></i> Tambah
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
                <table class="table table-hover">
                    <thead class="">
                        <tr>
                            <th>#</th>
                            <th style="width: 25%">Nama Objek</th>
                            <th class="kt-align-left">Kategori</th>
                            <th class="kt-align-left">Sub Kategori</th>
                            <th class="kt-align-left">Pemilik</th>
                            <th class="kt-align-center">Harga Limit</th>
                            <th class="kt-align-center">Jaminan</th>
                            <th class="kt-align-center">Status</th>
                            <th class="kt-align-center" style="width: 8%"><i class="flaticon2-settings"></i></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($objek as $obj)
                        <tr>
                            <td scope="row" style="vertical-align: middle">{{ $loop->iteration	 }}</td>
                            <td style="vertical-align: middle"><a href="/edit/{{ strtolower($obj->kategori->nama). '/' .strtolower($obj->sub_kategori->nama). '/' .$obj->id }}" class="text-promary"> {{ $obj->nama }}</a></td>
                            <td class="kt-align-left" style="vertical-align: middle">{{ $obj->kategori->nama }}</td>
                            <td class="kt-align-left" style="vertical-align: middle">{{ $obj->sub_kategori->nama }}</td>
                            <td class="kt-align-left" style="vertical-align: middle">{{ $obj->pemilik->first_name. " ".$obj->pemilik->last_name }}</td>
                            <td class="kt-align-right" style="vertical-align: middle"><b>Rp {{ number_format($obj->harga_limit,0,",",".") }},-</b></td>
                            <td class="kt-align-right" style="vertical-align: middle"><b>Rp {{ number_format($obj->jaminan,0,",",".") }},-</b></td>
                            <td class="kt-align-center" style="vertical-align: middle">
                                @if($obj->status_objek->id == 1)
                                    <span style="width: 139px;"><span class="kt-badge kt-badge--unified-primary kt-badge--inline kt-badge--pill">{{ $obj->status_objek->nama }}</span></span>
                                @elseif($obj->status_objek->id == 2)
                                    <span style="width: 139px;"><span class="kt-badge kt-badge--unified-success kt-badge--inline kt-badge--pill">{{ $obj->status_objek->nama }}</span></span>
                                @elseif($obj->status_objek->id == 3)
                                    <span style="width: 139px;"><span class="kt-badge kt-badge--unified-danger kt-badge--inline kt-badge--pill">{{ $obj->status_objek->nama }}</span></span>
                                @endif
                            </td>
                            <td class="kt-align-center">
                                {{-- <a href="/edit/{{ strtolower($obj->kategori->nama). '/' .strtolower($obj->sub_kategori->nama). '/' .$obj->id }}" class="mr-n2 kt-font-brand btn-sm btn-icon btn-circle" data-skin="dark" data-toggle="kt-tooltip" data-placement="top" title="" data-original-title="Edit" >
                                    <i class="fa fa-edit"></i>
                                </a> --}}
                                @if($obj->id_status_objek == 1)
                                    <a href="/add/listing/{{ strtolower($obj->kategori->nama). '/' .strtolower($obj->sub_kategori->nama). '/' .$obj->id }}" class="mr-n2 text-primary btn btn-sm btn-icon btn-circle" data-skin="dark" data-toggle="kt-tooltip" data-placement="top" title="" data-original-title="Add to Listing" >
                                        <i class="fa fa-list-alt"></i>
                                    </a>
                                @else 
                                    <a class="mr-n2 text-black-50 btn btn-sm btn-icon btn-circle" data-skin="dark" data-toggle="kt-tooltip" data-placement="top" title="" data-original-title="" >
                                        <i class="fa fa-list-alt"></i>
                                    </a>
                                @endif
                                <form method="post" action="/delete/{{ strtolower($obj->kategori->nama). '/' .strtolower($obj->sub_kategori->nama). '/' .$obj->id }}" class="d-inline">
                                    @method('delete')
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-icon btn-circle" data-skin="dark" data-toggle="kt-tooltip" data-placement="top" title="" data-original-title="Delete">
                                        <i class="text-danger flaticon2-rubbish-bin-delete-button"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection