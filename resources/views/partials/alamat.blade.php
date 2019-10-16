<div class="form-group">
    <label>Alamat <span class="text-danger">*</span></label>
    <textarea name="alamat" class="form-control @error('alamat') is-invalid @enderror" placeholder="nama jalan" rows="1">{{ Request::segment(1)=='edit' ? old('alamat', $withdata['alamat'])  : old('alamat') }}</textarea>
    @error('alamat')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
<div class="row">
    <div class="col-lg-6">
        <div class="form-group">
            <label for="provinsi">Provinsi <span class="text-danger">*</span></label>
            <select class="form-control @error('provinsi') is-invalid @enderror" id="provinsi" name="provinsi">
                <option value="">- Pilih -</option>
                @foreach ($provinsi as $item)
                    <option value="{{ $item->id }}" {{ Request::segment(1)=='edit' ? $item->id == $properti->id_provinsi ? 'selected' : '' : old('provinsi') == $item->id ? 'selected' : '' }}>{{ $item->text }}</option>
                @endforeach
            </select>
            @error('provinsi')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="col-lg-6">
        <div class="form-group">
            <label for="kota">Kota/Kabupaten <span class="text-danger">*</span></label>
            <select class="form-control @error('kota') is-invalid @enderror" id="kota" name="kota">
                <option value="">- Pilih -</option>
                @if(Request::segment(1) ==  'edit' )
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
</div>
<div class="row">
    <div class="col-lg-6">
        <div class="form-group">
            <label for="kecamatan">Kecamatan <span class="text-danger">*</span></label>
            <select class="form-control @error('kecamatan') is-invalid @enderror" id="kecamatan" name="kecamatan">
                <option value="">- Pilih -</option>
                @if(Request::segment(1) ==  'edit' )
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
    <div class="col-lg-6">
        <div class="form-group">
            <label for="kelurahan">Kelurahan/Desa <span class="text-danger">*</span></label>
            <select class="form-control @error('kecamatan') is-invalid @enderror" id="kelurahan" name="kelurahan">
                <option value="">- Pilih -</option>
                @if(Request::segment(1) ==  'edit' )
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
</div>
<div class="row">
    <div class="col-lg-6">
        <div class="form-group">
            <label>Kode Pos</label>
            <input type="text" class="form-control @error('kode_pos') is-invalid @enderror" placeholder="" name="kode_pos" value="{{ Request::segment(1)=='edit' ? old('kode_pos', $withdata['kode_pos']) : old('kode_pos') }}">
        </div>
        @error('kode_pos')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-lg-6">
    </div>
</div>