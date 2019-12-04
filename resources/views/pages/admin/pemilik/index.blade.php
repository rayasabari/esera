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
                        Master Data Pmeilik
                    </div>                    
                </div>
                <div class="kt-portlet__head-toolbar">
                    <div class="dropdown show">
                        <a href="/add/pemilik" class="btn btn-primary btn-sm" style=""><i class="flaticon2-plus"></i>Tambah</a>
                    </div>
                </div>
            </div>
            <div class="kt-portlet__body">
                <table class="table table-hover">
                    <thead class="">
                        <tr>
                            <th>#</th>
                            <th>Nama Pemilik</th>
                            <th class="kt-align-left">Alamat</th>
                            <th class="kt-align-left">No. Telepon</th>
                            <th class="kt-align-left">Email</th>
                            <th class="kt-align-center" style="width: 5%"><i class="flaticon2-settings"></i></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pemilik as $plk)
                        <tr>
                            <th scope="row" style="vertical-align: middle">{{ $loop->iteration	 }}</th>
                            <td class="kt-align-left" style="vertical-align: middle"><a href="/edit/pemilik/{{ $plk->id }}"> {{ $plk->first_name .' '. $plk->last_name }}</a></td>
                            <td class="kt-align-left" style="vertical-align: middle">
                                @if(isset($plk->user_info))
                                    {{ $plk->user_info->alamat .', '. ucwords(strtolower($plk->user_info->kelurahan->text)) .', '. ucwords(strtolower($plk->user_info->kecamatan->text)) .', '. ucwords(strtolower($plk->user_info->kota->text)) .', '. ucwords(strtolower($plk->user_info->provinsi->text)) }}
                                @else 
                                    -
                                @endif
                            </td>
                            <td class="kt-align-left" style="vertical-align: middle">{{ isset($plk->user_info) ? $plk->user_info->no_telepon : '-'}}</td>
                            <td class="kt-align-left" style="vertical-align: middle">{{ $plk->email }}</td>
                            <td class="kt-align-center">
                                <form method="post" action="/delete/pemilik/{{ $plk->id }}">
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
                <div class="kt-pagination kt-pagination--primary mt-2 mb-2">
                    <p class="kt-section__desc"></p>
                    <div class="kt-pagination__toolbar">
                        {{ $pemilik->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection