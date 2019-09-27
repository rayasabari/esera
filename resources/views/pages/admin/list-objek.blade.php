@extends('layouts.app')

@section('head', 'Data Objek Lelang - SRA')

@section('subheader', 'Dashboard')

@section('sub_subheader')
<span class="kt-subheader__breadcrumbs-separator"></span>
<a href="{{ url('/data_objek') }}" class="kt-subheader__breadcrumbs-link">Data Objek Lelang</a>
@endsection

@section('content')
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
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th>#</th>
                    <th>Nama Objek</th>
                    <th>Kategori</th>
                    <th>Harga Limit</th>
                    <th>Jaminan</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($objek as $obj)
                <tr>
                    <th scope="row">{{ $loop->iteration	 }}</th>
                    <td>{{ $obj->nama }}</td>
                    <td>{{ $obj->id_kategori }}</td>
                    <td>{{ $obj->harga_limit }}</td>
                    <td>{{ $obj->jaminan }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection