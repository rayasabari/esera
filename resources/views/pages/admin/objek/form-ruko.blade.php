<div class="row">
    <div class="col-lg-6">
        <div class="form-group">
            <label>Luas Unit <span class="text-danger">*</span></label>
            <div class="input-group">
                <input type="text" class="form-control @error('luas_unit') is-invalid @enderror" placeholder="" name="luas_unit" id="luas_unit" value="{{ old('luas_unit') }}">
                <div class="input-group-prepend"><span class="input-group-text">m<sup>2</sup></span></div>
            </div>
            @error('luas_unit')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="col-lg-6">
        <div class="form-group">
            <label>Jumlah Lantai <span class="text-danger">*</span></label>
            <input type="number" class="form-control @error('jumlah_lantai') is-invalid @enderror" placeholder="" name="jumlah_lantai" value="{{ old('jumlah_lantai') }}">
            @error('jumlah_lantai')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror  
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-6">
        <div class="form-group">
            <label>Harga Limit <span class="text-danger">*</span></label>
            <div class="input-group">
                <div class="input-group-prepend"><span class="input-group-text">Rp</span></div>
                <input type="text" onkeyup="angka(this)" onblur="angka(this)" class="form-control text-right font-weight-bold @error('harga_limit') is-invalid @enderror" placeholder="" name="harga_limit" value="{{ old('harga_limit') }}">
            </div>
            @error('harga_limit')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="col-lg-6">
        <div class="form-group">
            <label>Jaminan <span class="text-danger">*</span></label>
            <div class="input-group">
                <div class="input-group-prepend"><span class="input-group-text">Rp</span></div>
                <input type="text" onkeyup="angka(this)" onblur="angka(this)" class="form-control text-right font-weight-bold @error('jaminan') is-invalid @enderror" placeholder="" name="jaminan" value="{{ old('jaminan') }}">
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
                    <option value="{{ $js->id }}" {{ old('sertifikat') == $js->id ? 'selected' : '' }} >
                        @if($js->singkatan == '')
                            {{ $js->nama }}
                        @else 
                            {{ $js->nama." (".$js->singkatan.")" }}
                        @endif
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
                    <option value="{{ $plk->id }}" {{ old('pemilik') == $plk->id ? 'selected' : '' }} >{{ $plk->first_name." ".$plk->last_name }}</option>
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
    <textarea class="form-control" @error('deskripsi') is-invalid @enderror name="deskripsi" rows="3">{{ old('deskripsi') }}</textarea>
</div>
@error('deskripsi')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror