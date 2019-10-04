<div class="row">
    <div class="col-lg-6">
        <div class="form-group">
            <label>Tipe <span class="text-danger">*</span></label>
            <input type="text" class="form-control @error('tipe') is-invalid @enderror" placeholder="" name="tipe" value="{{ Request::segment(1)=='edit' ? old('tipe', $properti->tipe) : old('tipe') }}">
        </div>
        @error('tipe')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror   
    </div>
    <div class="col-lg-6">
        <div class="form-group">
            <label>Jumlah Lantai <span class="text-danger">*</span></label>
            <input type="number" class="form-control @error('jumlah_lantai') is-invalid @enderror" placeholder="" name="jumlah_lantai" value="{{ Request::segment(1)=='edit' ? old('jumlah_lantai', $properti->jumlah_lantai) : old('jumlah_lantai') }}">
        </div>
        @error('jumlah_lantai')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror  
    </div>
</div>
<div class="row">
    <div class="col-lg-6">
        <div class="form-group">
            <label>Luas Tanah <span class="text-danger">*</span></label>
            <div class="input-group">
                <input type="text" class="form-control @error('luas_tanah') is-invalid @enderror" placeholder="" name="luas_tanah" id="luas_tanah" value="{{ Request::segment(1)=='edit' ? old('luas_tanah', $properti->luas_tanah) : old('luas_tanah') }}">
                <div class="input-group-prepend"><span class="input-group-text">m<sup>2</sup></span></div>
            </div>
        </div>
        @error('luas_tanah')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror  
    </div>
    <div class="col-lg-6">
        <div class="form-group">
            <label>Luas Bangunan <span class="text-danger">*</span></label>
            <div class="input-group">
                <input type="text" class="form-control @error('luas_bangunan') is-invalid @enderror" placeholder="" name="luas_bangunan" id="luas_bangunan" value="{{ Request::segment(1)=="edit" ? old('luas_bangunan', $properti->luas_bangunan)  : old('luas_bangunan') }}">
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
            <label>Kamar Tidur <span class="text-danger">*</span></label>
            <input type="number" class="form-control @error('kamar_tidur') is-invalid @enderror" placeholder="" name="kamar_tidur" value="{{ Request::segment(1)=='edit' ? old('kamar_tidur',  $properti->kamar_tidur) : old('kamar_tidur') }}">
        </div>
        @error('kamar_tidur')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-lg-6">
        <div class="form-group">
            <label>Kamar Mandi <span class="text-danger">*</span></label>
            <input type="number" class="form-control @error('kamar_mandi') is-invalid @enderror" placeholder="" name="kamar_mandi" value="{{ Request::segment(1)=='edit' ? old('kamar_mandi', $properti->kamar_mandi) : old('kamar_mandi') }}">
        </div>
        @error('kamar_mandi')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>
<div class="row">
    <div class="col-lg-6">
        <div class="form-group">
            <label>Harga Limit <span class="text-danger">*</span></label>
            <div class="input-group">
                <div class="input-group-prepend"><span class="input-group-text">Rp</span></div>
                <input type="text" onkeyup="angka(this)" onblur="angka(this)" class="form-control text-right font-weight-bold @error('harga_limit') is-invalid @enderror" placeholder="" name="harga_limit" value="{{ Request::segment(1)=='edit' ? old('harga_limit', $properti->harga_limit) : old('harga_limit') }}">
            </div>
        </div>
        @error('harga_limit')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-lg-6">
        <div class="form-group">
            <label>Jaminan <span class="text-danger">*</span></label>
            <div class="input-group">
                <div class="input-group-prepend"><span class="input-group-text">Rp</span></div>
                <input type="text" onkeyup="angka(this)" onblur="angka(this)" class="form-control text-right font-weight-bold @error('jaminan') is-invalid @enderror" placeholder="" name="jaminan" value="{{ Request::segment(1)=='edit' ? old('jaminan', $properti->jaminan) : old('jaminan') }}">
            </div>
            @error('jaminan')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-6">
        <div class="form-group">
            <label for="sertifikat">Sertifikat <span class="text-danger">*</span></label>
            <select class="form-control @error('sertifikat') is-invalid @enderror" id="sertifikat" name="sertifikat">
                <option value="">- Pilih -</option>
                @foreach ($jenissertifikat as $js)
                    <option value="{{ $js->id }}" {{ Request::segment(1)=='edit' ? $js->id == $properti->id_sertifikat ? 'selected' : '' : old('id_sertifikat') == $js->id ? 'selected' : '' }}>
                        {{ $js->singkatan== '' || $js->singkatan==null ? $js->nama : $js->nama." (".$js->singkatan.")" }}
                    </option>
                @endforeach
            </select>
            @error('pemilik')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="col-lg-6">
        <div class="form-group">
            <label for="pemilik">Pemilik <span class="text-danger">*</span></label>
            <select class="form-control @error('pemilik') is-invalid @enderror" id="pemilik" name="pemilik">
                <option value="">- Pilih -</option>
                @foreach ($pemilik as $plk)
                    <option value="{{ $plk->id }}" {{ Request::segment(1)=='edit' ? $plk->id == $properti->id_pemilik ? 'selected' : '' : old('pemilik') == $plk->id ? 'selected' : '' }} >{{ $plk->first_name." ".$plk->last_name }}</option>
                @endforeach
            </select>
            @error('pemilik')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
</div>
<div class="form-group">
    <label>Deskripsi</label>
    <textarea class="form-control" @error('deskripsi') is-invalid @enderror name="deskripsi" rows="3">{{ Request::segment(1)=='edit' ? old('deskripsi', $properti->deskripsi) : old('deskripsi') }}</textarea>
</div>
@error('deskripsi')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror