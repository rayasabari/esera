@extends('layouts.app')

@section('head')
    <title>Edit Objek {{ $kategori->nama }} - SRA</title>
@endsection

@section('menu')
    @include('pages.admin.menu')
@endsection

@section('sub_subheader')
    <span class="kt-subheader__breadcrumbs-separator"></span>
    <a href="{{ url('/objek') }}" class="kt-subheader__breadcrumbs-link">Master Objek Lelang</a>
@endsection

@section('sub_sub_subheader')
    <span class="kt-subheader__breadcrumbs-separator"></span>
    <a href="#" class="kt-subheader__breadcrumbs-link">{{ $kategori->nama  }}</a>
    <span class="kt-subheader__breadcrumbs-separator"></span>
    <a href="{{ url('/edit/'.Request::segment(2).'/'.Request::segment(3)) }}" class="kt-subheader__breadcrumbs-link">Edit</a>
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
                        Form Tambah {{ $subkategori->nama }}
                    </h3>
                </div>
            </div>
            <div class="kt-portlet__body">
                <form method="post" action="/edit/{{ Request::segment(2)}}/{{ Request::segment(3) }}/{{ $properti->id }}">
                    @method('patch')
                    @csrf
                    <input type="hidden" name="sub_kategori" value="{{ $subkategori->nama }}">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Nama Objek <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('nama') is-invalid @enderror" placeholder="" name="nama" value="{{ old('nama',$properti->nama ) }}">
                                @error('nama')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            @include('partials.alamat')
                        </div>
                        <div class="col-lg-6">
                            @include('pages.admin.objek.add-'.Request::segment(3) )
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