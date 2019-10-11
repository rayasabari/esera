@extends('layouts.app')

@section('head')
    <title>Tambah Pemilik - SRA</title>
@endsection

@section('menu')
    @include('pages.admin.menu')
@endsection

@section('sub_subheader')
    <span class="kt-subheader__breadcrumbs-separator"></span>
    <a href="{{ url('/pemilik') }}" class="kt-subheader__breadcrumbs-link">Master Data Pemilik</a>
@endsection

@section('sub_sub_subheader')
    <span class="kt-subheader__breadcrumbs-separator"></span>
    <a href="{{ url('/add/pemilik') }}" class="kt-subheader__breadcrumbs-link">Tambah</a>
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
                        Tambah Data Pemilik
                    </h3>
                </div>
            </div>
            <div class="kt-portlet__body">
                @php $act = Request::segment(1); @endphp
                <form method="post" {{ $act == 'add' ? 'action=/add/pemilik' : 'action=/edit/pemilik/'. $pemilik->id }} >
                    @if($act == 'edit') @method('patch') @endif
                    @csrf
                    <div class="row" style="height: auto">
                        <div class="col-lg-6">
                            <div class="form-group row">
                                <label class="col-xl-4 col-lg-4 col-form-label">Nama Depan <span class="text-danger">*</span></label>
                                <div class="col-lg-9 col-xl-6">
                                    <input name="first_name" class="form-control @error('first_name') is-invalid @enderror" type="text" value="{{ $act == 'edit' ? old('first_name', $pemilik->first_name) : old('first_name') }}">
                                    @error('first_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-xl-4 col-lg-4 col-form-label">Nama Belakang <span class="text-danger">*</span></label>
                                <div class="col-lg-9 col-xl-6">
                                    <input name="last_name" class="form-control @error('last_name') is-invalid @enderror" type="text" value="{{ $act == 'edit' ? old('last_name', $pemilik->last_name)  : old('last_name') }}">
                                    @error('last_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-xl-4 col-lg-4 col-form-label">Email <span class="text-danger">*</span></label>
                                <div class="col-lg-9 col-xl-6">
                                    <div class="input-group">
                                        <div class="input-group-prepend"><span class="input-group-text"><i class="la la-at"></i></span></div>
                                        <input name="email" class="form-control @error('email') is-invalid @enderror" type="text" value="{{ $act == 'edit' ? old('email', $pemilik->email) : old('email') }}">
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-xl-4 col-lg-4 col-form-label">Alamat <span class="text-danger">*</span></label>
                                <div class="col-lg-9 col-xl-6">
                                    <textarea name="alamat" class="form-control @error('alamat') is-invalid @enderror" placeholder="nama jalan" rows="3">{{ $act == 'edit' ? old('alamat', $pemilik->user_info->alamat)  : old('alamat') }}</textarea>
                                    @error('alamat')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-xl-4 col-lg-4 col-form-label">Provinsi <span class="text-danger">*</span></label>
                                <div class="col-lg-9 col-xl-6">
                                    <select class="form-control @error('provinsi') is-invalid @enderror" id="provinsi" name="provinsi">
                                        <option value="">- Pilih -</option>
                                        @foreach ($provinsi as $item)
                                            <option value="{{ $item->id }}" {{ $act =='edit' ? $item->id == $pemilik->user_info->id_provinsi ? 'selected' : '' : old('provinsi') == $item->id ? 'selected' : '' }}>{{ $item->text }}</option>
                                        @endforeach
                                    </select>
                                    @error('provinsi')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-xl-4 col-lg-4 col-form-label">Kota <span class="text-danger">*</span></label>
                                <div class="col-lg-9 col-xl-6">
                                    <select class="form-control @error('kota') is-invalid @enderror" id="kota" name="kota">
                                        <option value="">- Pilih -</option>
                                        @if( $act ==  'edit' )
                                            @foreach($kota as $item)
                                                <option value="{{ $item->id }}" {{ $item->id == $withdata['id_kota'] ? 'selected' : '' }}>{{ $item->text }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    @error('kota')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-xl-4 col-lg-4 col-form-label">kecamatan <span class="text-danger">*</span></label>
                                <div class="col-lg-9 col-xl-6">
                                    <select class="form-control @error('kecamatan') is-invalid @enderror" id="kecamatan" name="kecamatan">
                                        <option value="">- Pilih -</option>
                                        @if( $act ==  'edit' )
                                            @foreach($kecamatan as $item)
                                                <option value="{{ $item->id }}" {{ $item->id == $withdata['id_kecamatan'] ? 'selected' : '' }}>{{ $item->text }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    @error('kecamatan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-xl-4 col-lg-4 col-form-label">Kelurahan <span class="text-danger">*</span></label>
                                <div class="col-lg-9 col-xl-6">
                                    <select class="form-control @error('kecamatan') is-invalid @enderror" id="kelurahan" name="kelurahan">
                                        <option value="">- Pilih -</option>
                                        @if( $act ==  'edit' )
                                            @foreach($kelurahan as $item)
                                                <option value="{{ $item->id }}" {{ $item->id == $withdata['id_kelurahan'] ? 'selected' : '' }}>{{ $item->text }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    @error('kelurahan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-xl-4 col-lg-4 col-form-label">Kode Pos</label>
                                <div class="col-lg-9 col-xl-6">
                                    <input type="text" class="form-control @error('kode_pos') is-invalid @enderror" placeholder="" name="kode_pos" value="{{ $act =='edit' ? old('kode_pos', $pemilik->user_info->kode_pos) : old('kode_pos') }}">
                                    @error('kode_pos')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group row">
                                <label class="col-xl-4 col-lg-4 col-form-label">No. Telepon <span class="text-danger">*</span></label>
                                <div class="col-lg-9 col-xl-8">
                                    <div class="input-group">
                                        <div class="input-group-prepend"><span class="input-group-text"><i class="la la-phone"></i></span></div>
                                        <input name="no_telepon" class="form-control @error('no_telepon') is-invalid @enderror" type="text" value="{{ $act == 'edit' ? old('no_telepon', $pemilik->user_info->no_telepon) : old('no_telepon') }}">
                                        @error('no_telepon')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-xl-4 col-lg-4 col-form-label">No. Fax </label>
                                <div class="col-lg-9 col-xl-8">
                                    <div class="input-group">
                                        <div class="input-group-prepend"><span class="input-group-text"><i class="la la-fax"></i></span></div>
                                        <input name="no_fax" class="form-control @error('no_fax') is-invalid @enderror" type="text" value="{{ $act == 'edit' ? old('no_fax', $pemilik->user_info->no_fax) : old('no_fax') }}">
                                        @error('no_fax')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-xl-4 col-lg-4 col-form-label">No. KTP <span class="text-danger">*</span></label>
                                <div class="col-lg-9 col-xl-8">
                                    <input name="no_ktp" class="form-control @error('no_ktp') is-invalid @enderror" type="text" value="{{ $act == 'edit' ? old('no_ktp', $pemilik->user_info->no_ktp) : old('no_ktp') }}">
                                    @error('no_ktp')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-xl-4 col-lg-4 col-form-label">NPWP </label>
                                <div class="col-lg-9 col-xl-8">
                                    <input name="npwp" class="form-control @error('npwp') is-invalid @enderror" type="text" value="{{ $act == 'edit' ? old('npwp', $pemilik->user_info->npwp) : old('npwp') }}">
                                    @error('npwp')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-xl-4 col-lg-4 col-form-label">No. Rekening <span class="text-danger">*</span></label>
                                <div class="col-lg-9 col-xl-8">
                                    <input name="no_rekening" class="form-control @error('no_rekening') is-invalid @enderror" type="text" value="{{ $act == 'edit' ? old('no_rekening', $pemilik->user_info->no_rekening) : old('no_rekening') }}">
                                    @error('no_rekening')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-xl-4 col-lg-4 col-form-label">Bank <span class="text-danger">*</span></label>
                                <div class="col-lg-9 col-xl-8">
                                    <input name="nama_bank" class="form-control @error('nama_bank') is-invalid @enderror" type="text" value="{{ $act == 'edit' ? old('nama_bank', $pemilik->user_info->nama_bank) : old('nama_bank') }}">
                                    @error('nama_bank')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-xl-4 col-lg-4 col-form-label">Cabang Bank</label>
                                <div class="col-lg-9 col-xl-8">
                                    <input name="cabang_bank" class="form-control @error('cabang_bank') is-invalid @enderror" type="text" value="{{ $act == 'edit' ? old('cabang_bank', $pemilik->user_info->cabang_bank) : old('cabang_bank') }}">
                                    @error('cabang_bank')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-xl-4 col-lg-4 col-form-label">Atas Nama Bank <span class="text-danger">*</span></label>
                                <div class="col-lg-9 col-xl-8">
                                    <input name="atas_nama_bank" class="form-control @error('atas_nama_bank') is-invalid @enderror" type="text" value="{{ $act == 'edit' ? old('atas_nama_bank', $pemilik->user_info->atas_nama_bank) : old('atas_nama_bank') }}">
                                    @error('atas_nama_bank')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
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

            // if($('#provinsi').val() != 0 || $('#provinsi').val() != '') {
            //     var id_provinsi = $('#provinsi').val();
            //     kota_by_propinsi(id_provinsi);
            // }else if($('kota').val() != 0 || $('#kota').val() != ''){
            //     var id_kota = $('kota').val();
            //     $('#kecamatan').val(id_kota);
            //     kecamatan_by_kota(id_kota);
            // }else if($('kecamatan').val() !=  0 || $('kecamatan').val() != '' ){
            //     var id_kecamatan = $('kota').val();
            //     $('#kecamatan').val(id_kecamatan);
            //     kecamatan_by_kota(id_kecamatan);
            // };

            $('#provinsi').change(function(){
                var id = $(this).val();
                if($(this).val() == ''){
                    $('#kota').html();
                    $('#kecamatan').val(0);
                    $('#kelurahan').val(0);
                }else{
                    kota_by_propinsi(id);
                    $('#kecamatan').val(0);
                    kecamatan_by_kota(id);
                    $('#kelurahan').val(0);
                    kelurahan_by_kecamatan(id);
                }
            });

            function kota_by_propinsi(id){     
                $.ajax({
                    url         : "ajax/dropdown/kota/"+id,
                    data        : {id : id},
                    type        : "GET",
                    dataType    : "html",
                    cache       : false,
                    success   : function(response){
                        $('#kota').html(response);
                        // console.log(response);
                    }, 
                    error: function (x, e){
                    alert("Server side failed. " + x.responseText);
                    }
                });
            }

            $('#kota').change(function(){
                var $id = $(this).val();
                kecamatan_by_kota($id);
                $('#kelurahan').val(0);
                kelurahan_by_kecamatan($id);
            });

            function kecamatan_by_kota(id){     
                $.ajax({
                    url         : "ajax/dropdown/kecamatan/"+id,
                    data        : {id : id},
                    type        : "GET",
                    dataType    : "html",
                    cache       : false,
                    success   : function(response){
                        $('#kecamatan').html(response);
                        // console.log(response);
                    }, 
                    error: function (x, e){
                    alert("Server side failed. " + x.responseText);
                    }
                });
            }

            $('#kecamatan').change(function(){
                var $id = $(this).val();
                kelurahan_by_kecamatan($id);
            });

            function kelurahan_by_kecamatan(id){     
                $.ajax({
                    url         : "ajax/dropdown/kelurahan/"+id,
                    data        : {id : id},
                    type        : "GET",
                    dataType    : "html",
                    cache       : false,
                    success   : function(response){
                        $('#kelurahan').html(response);
                        // console.log(response);
                    }, 
                    error: function (x, e){
                    alert("Server side failed. " + x.responseText);
                    }
                });
            }

            $('#luas_tanah, #luas_bangunan').on('change, keyup', function() {
                var currentInput = $(this).val();
                var fixedInput = currentInput.replace(/[A-Za-z!,@#$%^&*(;:'"<>?{})|]/g, '');
                $(this).val(fixedInput);
            });
        });

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
    </script>
@endsection