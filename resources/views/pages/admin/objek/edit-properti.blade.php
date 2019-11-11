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
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

        @if(count($errors) > 0)
            <div class="alert alert-danger">
                @foreach($errors->all() as $error )
                    • {{ $error }}<br>
                @endforeach
            </div>
        @endif
        <div class="kt-portlet kt-portlet--tab">
            <div class="kt-portlet__head">
                <div class="kt-portlet__head-label">
                    <span class="kt-portlet__head-icon kt-hide">
                        <i class="la la-gear"></i>
                    </span>
                    <h3 class="kt-portlet__head-title">
                        Form Edit {{ $subkategori->nama }}
                    </h3>
                </div>
            </div>
            <div class="kt-portlet__body">
                <ul class="nav nav-tabs  nav-tabs-line nav-tabs-line-success" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active mr-2" data-toggle="tab" href="#tab_data" role="tab"><i class="flaticon2-list-2"></i> Info</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link mr-2" data-toggle="tab" href="#tab_foto" role="tab"><i class="flaticon2-photo-camera"></i> Foto</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#tab_dokumen" role="tab"><i class="flaticon2-file-1"></i> Dokumen</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="tab_data" role="tabpanel">
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
                                    @include('pages.admin.objek.form-'.Request::segment(3) )
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                    <a href="/objek" class="btn btn-outline-primary">Kembali</a>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="tab-pane" id="tab_foto" role="tabpanel">
                        <div class="row mb-4">
                            <div class="col-lg-12">
                                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal_upload_foto">Tambah</button>
                            </div>
                        </div>
                        <div class="row">
                            @foreach($foto as $key => $ft)
                                <div class="col-xl-3 col-lg-4 col-md-6 order-lg-2 order-xl-1 kt-img-rounded">
                                    <div class="kt-portlet kt-portlet--height-fluid kt-widget19">
                                        <div class="kt-portlet__body kt-portlet__body--fit kt-portlet__body--unfill" style="cursor: pointer;" >
                                            <div class="kt-widget19__pic kt-portlet-fit--top kt-portlet-fit--sides" style="min-height: 300px; background-image: url({{ '/storage/foto/'. $ft->nama_file }})">
                                                <h4 class="kt-widget19__title kt-font-light"></h4>
                                                <div class="kt-widget19__shadow"></div>
                                                <div class="kt-widget19__labels">
                                                    <form method="post" action="/delete/foto/{{ $ft->id }}" class="d-inline">
                                                        @method('delete')
                                                        @csrf
                                                        <button type="submit" class="btn btn-danger" data-skin="dark" data-toggle="kt-tooltip" data-placement="top" title="" data-original-title="Delete">
                                                            <i class="mr-n2 text-right flaticon-delete-1"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="kt-portlet__body">
                                            <div class="kt-widget19__wrapper mb-n1 mt-n2">
                                                <div class="kt-widget19__content mb-n2">
                                                    <div class="kt-widget19__info ml-n3">
                                                        <a class="kt-widget19__username text-center text-black-50">
                                                            {{ $ft->nama_file }}
                                                        </a>
                                                        <span class="kt-widget19__time">
                                                        </span>
                                                    </div>
                                                    <div class="kt-widget19__stats">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="tab-pane" id="tab_dokumen" role="tabpanel">
                        <div class="row mb-4">
                            <div class="col-lg-12">
                                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal_upload_dokumen">Tambah</button>
                            </div>
                        </div>
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th style="width: 8%">#</th>
                                    <th class="text-left">Nama Dokumen</th>
                                    <th class="text-left">File</th>
                                    <th style="width: 5%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($dokumen as $dok)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $dok->nama_dokumen }}</td>
                                        <td> <a href="storage/dokumen/{{ $dok->nama_file }}"><i class="flaticon2-download-2 mt-n1 mr-2" style="vertical-align: middle; display: inline-block  "></i> {{ $dok->nama_file }} </a></td>
                                        <td>
                                            <form method="post" action="/delete/dokumen/{{ $dok->id }}" class="d-inline">
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
        </div>
    </div>

    {{-- Modal Upload Foto--}}
    <div class="modal fade" id="modal_upload_foto" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Upload Foto</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <form action="/upload/foto/{{ $kategori->id }}/{{ $properti->id }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label>File Browser</label>
                                    <div class="custom-file">
                                        <input name="filefoto" type="file" class="custom-file-input @error('filefoto') is-invalid @enderror" id="filefoto">
                                        <label class="custom-file-label" for="customFile">Pilih file</label>
                                        @error('filefoto')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Upload</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Modal Upload Dokumen--}}
    <div class="modal fade" id="modal_upload_dokumen" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Upload Dokumen</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <form action="/upload/dokumen/{{ $kategori->id }}/{{ $properti->id }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label>Nama Dokumen <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('nama_dokumen') is-invalid @enderror" placeholder="contoh: Sertifikat, Peta, IMB, dll" name="nama_dokumen" value="{{ old('nama_dokumen',$properti->nama_dokumen ) }}">
                                    @error('nama_dokumen')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>File Browser</label>
                                    <div class="custom-file">
                                        <input name="filedokumen" type="file" class="custom-file-input @error('filedokumen') is-invalid @enderror" id="filedokumen">
                                        <label class="custom-file-label" for="customFile">Pilih file</label>
                                        @error('filedokumen')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Upload</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('footer_script')
    <!--begin::Page Scripts(used by this page) -->
    {{-- <script src="assets/js/pages/crud/file-upload/dropzonejs.js" type="text/javascript"></script> --}}
    <!--end::Page Scripts -->
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

        $('#harga_limit').keyup(function(){
            var jaminan = $('#jaminan');
            var limit   = $(this).val().replace(/[^\d]/g, "");
            jaminan.val( limit / 5 );
            jaminan.trigger('keyup');
        })
    </script>
@endsection