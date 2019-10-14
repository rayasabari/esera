@extends('layouts.app')

@section('head')
    <title>Master Data Pemilik - SRA</title>
@endsection

@section('menu')
    @include('pages.admin.menu')
@endsection

@section('sub_subheader')
    <span class="kt-subheader__breadcrumbs-separator"></span>
    <a href="{{ url('/pemilik') }}" class="kt-subheader__breadcrumbs-link">Master Data Pemilik</a>
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
                        Master Data Bidder
                    </div>                    
                </div>
                <div class="kt-portlet__head-toolbar">
                </div>
            </div>
            <div class="kt-portlet__body">
                <table class="table table-hover">
                    <thead class="">
                        <tr>
                            <th>#</th>
                            <th class="kt-align-center">NIPL</th>
                            <th>Nama Bidder</th>
                            <th class="kt-align-left">Email</th>
                            <th class="kt-align-right">Deposit</th>
                            <th class="kt-align-left">Tanggal Deposite</th>
                            <th class="kt-align-center">Status</th>
                            <th class="kt-align-center" style="width: 5%"><i class="flaticon2-settings"></i></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($bidder as $bdr)
                        <tr>
                            <th scope="row" style="vertical-align: middle">{{ $loop->iteration	 }}</th>
                            <td class="kt-align-center" style="vertical-align: middle">{{ isset($bdr->nipl) ? $bdr->nipl->nipl : '-' }}</td>
                            <td class="kt-align-left" style="vertical-align: middle"><a href="/update/bidder/{{ $bdr->id }}"> {{ $bdr->first_name .' '. $bdr->last_name }}</a></td>
                            <td class="kt-align-left" style="vertical-align: middle">{{ $bdr->email }}</td>
                            <td class="kt-align-right" style="vertical-align: middle">{{ isset($bdr->nipl) ? 'Rp '.number_format($bdr->nipl->deposite,0,',','.') : 'unpaid' }}</td>
                            <td class="kt-align-left" style="vertical-align: middle">{{ isset($bdr->nipl) ? date('d F Y', strtotime($bdr->nipl->tgl_deposite) ) : '-' }}</td>
                            <td class="kt-align-center" style="vertical-align: middle">{{ isset($bdr->nipl) ? $bdr->nipl->status_nipl->nama : '-' }}</td>
                            <td class="kt-align-center">
                                <form method="post" action="/delete/bidder/{{ $bdr->id }}">
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