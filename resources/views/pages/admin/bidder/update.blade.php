@extends('layouts.app')

@section('head')
    <title>Update Bidder - SRA</title>
@endsection

@section('menu')
    @include('pages.admin.menu')
@endsection

@section('sub_subheader')
    <span class="kt-subheader__breadcrumbs-separator"></span>
    <a href="{{ url('/bidder') }}" class="kt-subheader__breadcrumbs-link">Data Bidder</a>
@endsection

@section('sub_sub_subheader')
    <span class="kt-subheader__breadcrumbs-separator"></span>
    <a href="{{ url('/update/bidder'.$bidder->id) }}" class="kt-subheader__breadcrumbs-link">Update</a>
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
                        Update Bidder
                    </h3>
                </div>
            </div>
            <div class="kt-portlet__body">
                <form method="post" action="/update/bidder/{{ $bidder->id }}">
                    @csrf
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label>NIPL<span class="text-danger">*</span></label>
                                <input name="nipl" class="form-control @error('nipl') is-invalid @enderror" type="text" value="{{ $act == 'edit' ? old('nipl', $bidder->nipl->nipl) : old('nipl') }}">
                                @error('nipl')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label>Deposite<span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <div class="input-group-prepend"><span class="input-group-text">Rp</span></div>
                                    <input name="deposite" onkeyup="angka(this)" class="form-control text-right font-weight-bold @error('deposite') is-invalid @enderror" type="text" value="{{ $act == 'edit' ? old('deposite', number_format($bidder->nipl->deposite,0,',','.')) : old('deposite') }}">
                                </div>
                                @error('deposite')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label>Tanggal Deposite<span class="text-danger">*</span></label>
                                <input name="tgl_deposite" class="form-control @error('tgl_deposite') is-invalid @enderror" type="date" value="{{ $act == 'edit' ? old('tgl_deposite', $bidder->nipl->tgl_deposite) : old('tgl_deposite') }}">
                                @error('tgl_deposite')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label>StatusL<span class="text-danger">*</span></label>
                                <select class="form-control @error('id_status_nipl') is-invalid @enderror" name="id_status_nipl" id="id_status_nipl">
                                    <option value="" {{ $act == 'edit' ? $bidder->nipl->status == '' ? 'selected' : '' : old('id_status_nipl') == '' ? 'selected' : '' }}>- Pilih -</option>
                                    @foreach($status_nipl as $sn)
                                        <option value="{{ $sn->id }}" {{ $act == 'edit' ? $bidder->nipl->id_status_nipl == $sn->id ? 'selected' : '' : old('id_status_nipl') == 1 ? 'selected' : '' }}>{{ $sn->nama }}</option>
                                    @endforeach
                                </select>
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

@section('footer_script')
    <script>
        $(document).ready(function(){

            /* FORMAT ANGKA 3 titik*/
            function angka(objek) {
                objek = typeof(objek) != 'undefined' ? objek : 0;
                a = objek.value;
                b = a.replace(/[^\d]/g, "");
                c = "";
                panjang = b.length;
                j = 0;
                for (i = panjang; i > 0; i--) {
                    j = j + 1;
                    if (((j % 3) == 1) && (j != 1)) {
                        c = b.substr(i - 1, 1) + "." + c;
                    } else {
                        c = b.substr(i - 1, 1) + c;
                    }
                }
                objek.value = c;
            }

        }
    </script>
@endsection