@extends('layouts.app')

@section('head')
    <title>Tambah Properti - SRA</title>
@endsection

@section('menu')
    @include('pages.admin.menu')
@endsection

@section('sub_subheader')
    <span class="kt-subheader__breadcrumbs-separator"></span>
    <a href="{{ url('/objek') }}" class="kt-subheader__breadcrumbs-link">Objek Properti</a>
@endsection

@section('sub_sub_subheader')
    <span class="kt-subheader__breadcrumbs-separator"></span>
    <a href="{{ url('/objek/properti/add') }}" class="kt-subheader__breadcrumbs-link">Tambah</a>
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
                        Tambah Objek Properti
                    </h3>
                </div>
            </div>
            <div class="kt-portlet__body">
                <form method="post" action="/objek/properti">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="id_sub_kategori">Jenis Properti</label>
                                <select class="form-control @error('id_sub_kategori') is-invalid @enderror" id="id_sub_kategori" name="id_sub_kategori">
                                    <option value="">- Pilih -</option>
                                    @foreach ($subkategori as $item)
                                        <option value="{{ $item->id }}" @if( old('id_sub_kategori') == '{{ $item->id }}' ) selected @endif >{{ $item->nama }}</option>
                                    @endforeach
                                </select>
                                @error('id_sub_kategori')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Nama Objek</label>
                                <input type="text" class="form-control @error('nama') is-invalid @enderror" placeholder="" name="nama" value="{{ old('nama') }}">
                                @error('nama')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Alamat</label>
                                <textarea name="alamat" class="form-control @error('alamat') is-invalid @enderror" placeholder="nama jalan" rows="1">{{ old('alamat') }}</textarea>
                                @error('alamat')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="provinsi">Provinsi</label>
                                        <select class="form-control @error('provinsi') is-invalid @enderror" id="provinsi" name="provinsi">
                                            <option value="0">- Pilih -</option>
                                            @foreach ($provinsi as $item)
                                                <option value="{{ $item->id }}" @if( old('provinsi') == '{{ $item->id }}' ) selected @endif >{{ $item->text }}</option>
                                            @endforeach
                                        </select>
                                        @error('provinsi')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="kota">Kota/Kabupaten</label>
                                        <select class="form-control @error('kota') is-invalid @enderror" id="kota" name="kota">
                                            <option value="">- Pilih -</option>
                                        </select>
                                        @error('kota')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="kecamatan">Kecamatan</label>
                                        <select class="form-control @error('kecamatan') is-invalid @enderror" id="kecamatan" name="kecamatan">
                                            <option value="">- Pilih -</option>
                                        </select>
                                        @error('kecamatan')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="kelurahan">Kelurahan/Desa</label>
                                        <select class="form-control @error('kecamatan') is-invalid @enderror" id="kelurahan" name="kelurahan">
                                            <option value="">- Pilih -</option>
                                        </select>
                                        @error('kelurahan')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Kode Pos</label>
                                        <input type="text" class="form-control @error('kode_pos') is-invalid @enderror" placeholder="" name="kode_pos" value="{{ old('kode_pos') }}">
                                    </div>
                                    @error('kode_pos')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-lg-6">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="pemilik">Pemilik</label>
                                <select class="form-control @error('pemilik') is-invalid @enderror" id="pemilik" name="pemilik">
                                    <option value="">- Pilih -</option>
                                    @foreach ($pemilik as $plk)
                                        <option value="{{ $plk->id }}" @if( old('pemilik') == '{{ $plk->id }}' ) selected @endif >{{ $plk->first_name." ".$plk->last_name }}</option>
                                    @endforeach
                                </select>
                                @error('pemilik')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Tipe</label>
                                        <input type="text" class="form-control @error('tipe') is-invalid @enderror" placeholder="" name="tipe" value="{{ old('tipe') }}">
                                    </div>
                                    @error('tipe')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror   
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Jumlah Lantai</label>
                                        <input type="number" class="form-control @error('jumlah_lantai') is-invalid @enderror" placeholder="" name="jumlah_lantai" value="{{ old('jumlah_lantai') }}">
                                    </div>
                                </div>
                                @error('jumlah_lantai')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror  
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Luas Tanah</label>
                                        <div class="input-group">
                                            <input type="number" class="form-control @error('luas_tanah') is-invalid @enderror" placeholder="" name="luas_tanah" value="{{ old('luas_tanah') }}">
                                            <div class="input-group-prepend"><span class="input-group-text">m<sup>2</sup></span></div>
                                        </div>
                                    </div>
                                    @error('luas_tanah')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror  
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Luas Bangunan</label>
                                        <div class="input-group">
                                            <input type="number" class="form-control @error('luas_bangunan') is-invalid @enderror" placeholder="" name="luas_bangunan" value="{{ old('luas_bangunan') }}">
                                            <div class="input-group-prepend"><span class="input-group-text">m<sup>2</sup></span></div>
                                        </div>
                                    </div>
                                    @error('luas_bangunan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Kamar Tidur</label>
                                        <input type="number" class="form-control @error('kamar_tidur') is-invalid @enderror" placeholder="" name="kamar_tidur" value="{{ old('kamar_tidur') }}">
                                    </div>
                                    @error('kamar_tidur')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Kamar Mandi</label>
                                        <input type="number" class="form-control @error('kamar_mandi') is-invalid @enderror" placeholder="" name="kamar_mandi" value="{{ old('kamar_mandi') }}">
                                    </div>
                                </div>
                                @error('kamar_mandi')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Harga Limit</label>
                                        <input type="text" class="form-control @error('harga_limit') is-invalid @enderror" placeholder="" name="harga_limit" value="{{ old('harga_limit') }}">
                                    </div>
                                    @error('harga_limit')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Jaminan</label>
                                        <input type="text" class="form-control @error('jaminan') is-invalid @enderror" placeholder="" name="jaminan" value="{{ old('jaminan') }}">
                                    </div>
                                    @error('jaminan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Deskripsi</label>
                                <textarea class="form-control" @error('deskripsi') is-invalid @enderror name="deskripsi" rows="3">{{ old('deskripsi') }}</textarea>
                            </div>
                            @error('deskripsi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
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
        $('#provinsi').change(function(){
            var $id = $(this).val();
            kota_by_propinsi($id);
            $('#kecamatan').val(0);
            kecamatan_by_kota($id);
            $('#kelurahan').val(0);
            kelurahan_by_kecamatan($id);
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

    </script>
@endsection