<div class="kt-portlet">
    <div class="kt-portlet__head">
        <div class="kt-portlet__head-label">
            <h3 class="kt-portlet__head-title">Informasi Akun</h3>
        </div>
    </div>
    <form class="kt-form kt-form--label-right" method="post" action="profile/{{$user->id}}/{{ !empty($userinfo) ? 'edit' : 'add' }}/akuninfo">
        @csrf
        <div class="kt-portlet__body">
            <div class="kt-section kt-section--first">
                <div class="kt-section__body">
                    <div class="row">
                        <label class="col-xl-3"></label>
                        <div class="col-lg-9 col-xl-6">
                            <h3 class="kt-section__title kt-section__title-sm">Akun:</h3>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-xl-3 col-lg-3 col-form-label">Username</label>
                        <div class="col-lg-9 col-xl-6">
                            <input class="form-control @error('username') is-invalid @enderror"" name="username" type="text" value="{{ old('username', $user->name) }}">
                            @error('username')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-xl-3 col-lg-3 col-form-label">Email</label>
                        <div class="col-lg-9 col-xl-6">
                            <div class="input-group">
                                <div class="input-group-prepend"><span class="input-group-text"><i class="flaticon-mail-1"></i></span></div>
                                <input type="text" class="form-control" name="email" value="{{ $user->email }}" placeholder="Email" aria-describedby="basic-addon1">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="kt-section kt-section--first">
                <div class="kt-section__body">
                    <div class="row">
                        <label class="col-xl-3"></label>
                        <div class="col-lg-9 col-xl-6">
                            <h3 class="kt-section__title kt-section__title-sm">Identitas:</h3>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-xl-3 col-lg-3 col-form-label">No. KTP</label>
                        <div class="col-lg-9 col-xl-6">
                            <input class="form-control" name="no_ktp" type="text" value="{{ $userinfo->no_ktp }}" maxlength="16">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-xl-3 col-lg-3 col-form-label">NPWP</label></label>
                        <div class="col-lg-9 col-xl-6">
                            <input class="form-control" type="text" name="npwp" value="{{ $userinfo->npwp }}" maxlength="15">
                        </div>
                    </div>
                    <div class="row">
                        <label class="col-xl-3"></label>
                        <div class="col-lg-9 col-xl-6">
                            <h3 class="kt-section__title kt-section__title-sm">Rekening Bank:</h3>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-xl-3 col-lg-3 col-form-label">Bank</label>
                        <div class="col-lg-9 col-xl-6">
                            <select class="form-control @error('nama_bank') is-invalid @enderror" id="nama_bank" name="nama_bank">
                                <option value="">- Pilih -</option>
                                @foreach ($bank as $item)
                                    <option value="{{ $item->id }}" {{ !empty($userinfo) ? $item->id == $userinfo->nama_bank ? 'selected' : '' : old('nama_bank') == $item->id ? 'selected' : '' }}>{{ $item->nama }}</option>
                                @endforeach
                            </select>
                            @error('nama_bank')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-xl-3 col-lg-3 col-form-label">Nomor Rekening</label>
                        <div class="col-lg-9 col-xl-6">
                            <input class="form-control" type="text" name="no_rekening" value="{{ $userinfo->no_rekening }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-xl-3 col-lg-3 col-form-label">Cabang Bank</label>
                        <div class="col-lg-9 col-xl-6">
                            <input class="form-control" type="text" name="cabang_bank" value="{{ $userinfo->cabang_bank }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-xl-3 col-lg-3 col-form-label">Atas Nama</label>
                        <div class="col-lg-9 col-xl-6">
                            <input class="form-control" type="text" name="atas_nama_bank" value="{{ $userinfo->atas_nama_bank }}">
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
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>