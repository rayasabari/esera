<div class="kt-portlet">
    <div class="kt-portlet__head">
        <div class="kt-portlet__head-label">
            <h3 class="kt-portlet__head-title">Biodata Diri</h3>
        </div>
        <div class="kt-portlet__head-toolbar">
            <div class="kt-portlet__head-wrapper">
            </div>
        </div>
    </div>
    <form class="kt-form kt-form--label-right" method="post" action="profile/{{$user->id}}/{{ !empty($userinfo) ? 'edit' : 'add' }}/biodata">
        @csrf
        <div class="kt-portlet__body">
            <div class="kt-section kt-section--first">
                <div class="kt-section__body">
                    <div class="row">
                        <label class="col-xl-3"></label>
                        <div class="col-lg-9 col-xl-6">
                            <h3 class="kt-section__title kt-section__title-sm">Bidder Info:</h3>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-xl-3 col-lg-3 col-form-label">Avatar</label>
                        <div class="col-lg-9 col-xl-6">
                            <div class="kt-avatar kt-avatar--outline" id="kt_user_avatar">
                                <div class="kt-avatar__holder" style="background-image: url(assets/media/users/100_13.jpg)"></div>
                                <label class="kt-avatar__upload" data-toggle="kt-tooltip" title="" data-original-title="Change avatar">
                                    <i class="fa fa-pen"></i>
                                    <input type="file" name="profile_avatar" accept=".png, .jpg, .jpeg">
                                </label>
                                <span class="kt-avatar__cancel" data-toggle="kt-tooltip" title="" data-original-title="Cancel avatar">
                                    <i class="fa fa-times"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-xl-3 col-lg-3 col-form-label">Nama Depan</label>
                        <div class="col-lg-9 col-xl-6">
                            <input class="form-control" name="first_name" type="text" value="{{$user->first_name}}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-xl-3 col-lg-3 col-form-label">Nama Belakang</label>
                        <div class="col-lg-9 col-xl-6">
                            <input class="form-control" name="last_name" type="text" value="{{$user->last_name}}">
                        </div>
                    </div>
                    <div class="row">
                        <label class="col-xl-3"></label>
                        <div class="col-lg-9 col-xl-6">
                            <h3 class="kt-section__title kt-section__title-sm">Alamat:</h3>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-xl-3 col-lg-3 col-form-label">Nama Jalan</label>
                        <div class="col-lg-9 col-xl-6">
                            <input class="form-control @error('alamat') is-invalid @enderror" name="alamat" type="text" value="{{ !empty($userinfo) ? old('alamat', $userinfo->alamat) : old('alamat') }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-xl-3 col-lg-3 col-form-label">Provinsi</label>
                        <div class="col-lg-9 col-xl-6">
                            <select class="form-control @error('provinsi') is-invalid @enderror" id="provinsi" name="provinsi">
                                <option value="">- Pilih -</option>
                                @foreach ($provinsi as $item)
                                    <option value="{{ $item->id }}" {{ !empty($userinfo) ? $item->id == $userinfo->id_provinsi ? 'selected' : '' : old('provinsi') == $item->id ? 'selected' : '' }}>{{ $item->text }}</option>
                                @endforeach
                            </select>
                            @error('provinsi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-xl-3 col-lg-3 col-form-label">Kota</label>
                        <div class="col-lg-9 col-xl-6">
                            <select class="form-control @error('kota') is-invalid @enderror" id="kota" name="kota">
                                <option value="">- Pilih -</option>
                                @if(!empty($userinfo))
                                    @foreach($kota as $item)
                                        <option value="{{ $item->id }}" {{ $item->id == $userinfo->id_kota ? 'selected' : '' }}>{{ $item->text }}</option>
                                    @endforeach
                                @endif
                            </select>
                            @error('kota')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-xl-3 col-lg-3 col-form-label">Kecamatan</label>
                        <div class="col-lg-9 col-xl-6">
                            <select class="form-control @error('kecamatan') is-invalid @enderror" id="kecamatan" name="kecamatan">
                                <option value="">- Pilih -</option>
                                @if(!empty($userinfo))
                                    @foreach($kecamatan as $item)
                                        <option value="{{ $item->id }}" {{ $item->id == $userinfo->id_kecamatan ? 'selected' : '' }}>{{ $item->text }}</option>
                                    @endforeach
                                @endif
                            </select>
                            @error('kecamatan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-xl-3 col-lg-3 col-form-label">Kelurahan</label>
                        <div class="col-lg-9 col-xl-6">
                            <select class="form-control @error('kecamatan') is-invalid @enderror" id="kelurahan" name="kelurahan">
                                <option value="">- Pilih -</option>
                                @if(!empty($userinfo))
                                    @foreach($kelurahan as $item)
                                        <option value="{{ $item->id }}" {{ $item->id == $userinfo->id_kelurahan ? 'selected' : '' }}>{{ $item->text }}</option>
                                    @endforeach
                                @endif
                            </select>
                            @error('kelurahan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-xl-3 col-lg-3 col-form-label">Kode Pos</label>
                        <div class="col-lg-9 col-xl-6">
                            <input type="text" class="form-control @error('kode_pos') is-invalid @enderror" placeholder="" name="kode_pos" value="{{ !empty($userinfo) ? old('kode_pos', $userinfo->kode_pos) : old('kode_pos') }}">
                        </div>
                        @error('kode_pos')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="row">
                        <label class="col-xl-3"></label>
                        <div class="col-lg-9 col-xl-6">
                            <h3 class="kt-section__title kt-section__title-sm">Kontak:</h3>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-xl-3 col-lg-3 col-form-label">Nomor Telepon</label>
                        <div class="col-lg-9 col-xl-6">
                            <div class="input-group">
                                <div class="input-group-prepend"><span class="input-group-text"><i class="la la-phone"></i></span></div>
                                <input type="text" class="form-control @error('no_telepon') is-invalid @enderror" name="no_telepon" value="{{ !empty($userinfo) ? old('no_telepon', $userinfo->no_telepon) : old('no_telepon') }}" placeholder="Phone" aria-describedby="basic-addon1">
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-xl-3 col-lg-3 col-form-label">Nomor Fax.</label>
                        <div class="col-lg-9 col-xl-6">
                            <div class="input-group">
                                <div class="input-group-prepend"><span class="input-group-text"><i class="la la-fax"></i></span></div>
                                <input type="text" class="form-control @error('no_fax') is-invalid @enderror" name="no_fax" value="{{ !empty($userinfo) ? old('no_fax', $userinfo->no_fax) : old('no_fax') }}" placeholder="Phone" aria-describedby="basic-addon1">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="kt-portlet__foot">
            <div class="kt-form__actions">
                <div class="row">
                    <div class="col-lg-3 col-xl-3">
                    </div>
                    <div class="col-lg-9 col-xl-9">
                        <button type="submit" class="btn btn-success">Submit</button>&nbsp;
                        <button type="reset" class="btn btn-secondary">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

@section('footer_script')
    <script>
        $(document).ready(function(){

            $('.lock-nav').click(function(){
                swal.fire("Maaf!", "Lengkapi dan simpan info objek terlebih dahulu!", "error");
            })

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