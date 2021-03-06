@extends('layouts.app')

@section('head')
    <title>Listing Objek - SRA</title>
@endsection

@section('menu')
    @include('pages.admin.menu')
@endsection

@section('sub_subheader')
    <span class="kt-subheader__breadcrumbs-separator"></span>
    <a href="{{ url('/listing') }}" class="kt-subheader__breadcrumbs-link">Master Listing Objek</a>
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
                        Data Listing Objek
                    </div>                    
                </div>
                <div class="kt-portlet__head-toolbar">
                </div>
            </div>
            <div class="kt-portlet__body">
                <table class="table table-hover">
                    <thead class="t">
                        <tr>
                            <th>#</th>
                            <th>LOT</th>
                            <th>Nama Objek</th>
                            <th class="kt-align-center">Tgl Mulai Lelang</th>
                            <th class="kt-align-center">Tgl Akhir Lelang</th>
                            <th class="kt-align-center">Jaminan</th>
                            <th class="kt-align-center">Harga Limit</th>
                            <th class="kt-align-center">On going BID</th>
                            <th class="kt-align-center">Status</th>
                            <th class="kt-align-center" style="width: 7%"><i class="flaticon2-settings"></i></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($objek as $obj)
                        <tr>
                            <td scope="row" style="vertical-align: middle">{{ ($objek ->currentPage()-1) * $objek ->perPage() + $loop->index + 1 }}</td>
                            <td class="kt-align-left" style="vertical-align: middle">{{ $obj->kode_lot}}</td>
                            <td style="vertical-align: middle">
                                <a href="/edit/listing/{{ strtolower($obj->kategori->nama) }}/{{ strtolower($obj->sub_kategori->nama) }}/{{ $obj->id }}">{{ $obj->objek_properti->nama }}</a>
                                <span class="form-text text-muted text-small">
                                    Milik: <a class="text-danger">{{ $obj->objek_properti->pemilik->first_name .' '. $obj->objek_properti->pemilik->last_name }}</a>
                                </span>
                            </td>
                            <td class="kt-align-center" style="vertical-align: middle">{{ date("d F Y", strtotime( $obj->tgl_mulai_lelang)) }} <br> <b>{{ date("H:i", strtotime( $obj->tgl_mulai_lelang)) }}</b></td>
                            <td class="kt-align-center" style="vertical-align: middle">{{ date("d F Y", strtotime( $obj->tgl_akhir_lelang)) }} <br> <b>{{ date("H:i", strtotime( $obj->tgl_akhir_lelang)) }}</b></td>
                            <td class="kt-align-right" style="vertical-align: middle"><b>Rp {{ number_format($obj->objek_properti->jaminan,0,",",".") }},-</b></td>
                            <td class="kt-align-right" style="vertical-align: middle"><b>Rp {{ number_format($obj->objek_properti->harga_limit,0,",",".") }},-</b></td>
                            @if( isset($obj->last_bid))
                            <td class="kt-align-center kt-font-primary" style="vertical-align: middle"><b>Rp {{ number_format($obj->last_bid->jumlah_bid,0,",",".") }},-</b></td>
                            @else 
                                <td class="kt-align-center text-black-50" style="vertical-align: middle"><b>Rp {{ number_format($obj->objek_properti->harga_limit,0,",",".") }},-</b></td>
                            @endif
                            <td class="kt-align-center" style="vertical-align: middle">
                                @if(strtotime($obj->tgl_mulai_lelang) <= time() && strtotime($obj->tgl_akhir_lelang) >= time() )
                                    <span class="kt-badge kt-badge--unified-danger kt-badge--inline kt-badge--pill">Live! <span id="waktu{{ $obj->id }}"></span> </span>
                                @elseif(strtotime($obj->tgl_mulai_lelang) >= time())
                                    <span class="kt-badge kt-badge--unified-primary kt-badge--inline kt-badge--pill">Segera</span>
                                @elseif(strtotime($obj->tgl_akhir_lelang) <= time())
                                    <span class="kt-badge kt-badge--unified-success kt-badge--inline kt-badge--pill">Selesai</span>
                                @endif
                            </td>
                            <td style="vertical-align: middle" class="kt-align-center">
                                <a href="/edit/listing/{{ strtolower($obj->kategori->nama) }}/{{ strtolower($obj->sub_kategori->nama) }}/{{ $obj->id }}" class="text-primary" data-skin="dark" data-toggle="kt-tooltip" data-placement="top" title="" data-original-title="Edit" >
                                    <i class="fa fa-edit"></i>
                                </a>
                                <form method="post" action="/{{ $obj->status == 1 ? 'unpublish' : 'publish' }}/listing/{{ $obj->id }}" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-icon btn-circle" data-skin="dark" data-toggle="kt-tooltip" data-placement="top" title="" data-original-title="{{ $obj->status == 1 ? 'Click to Unpublish!' : 'Click to Publish!' }}">
                                        <i class="flaticon-eye {{ $obj->status == 1 ? 'text-danger' : 'text-black-50' }}"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="kt-pagination kt-pagination--primary mt-2 mb-2">
                    <p class="kt-section__desc"></p>
                    <div class="kt-pagination__toolbar">
                        {{ $objek->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection