<div class="kt-portlet">
    <div class="kt-portlet__head">
        <div class="kt-portlet__head-label">
            <h3 class="kt-portlet__head-title">Ganti Password</h3>
        </div>
    </div>
    <form class="kt-form kt-form--label-right" method="post" action="/changePassword">
        @csrf
        <div class="kt-portlet__body">
            <div class="kt-section kt-section--first">
                <div class="kt-section__body">
                    <div class="row">
                        <label class="col-xl-3"></label>
                        <div class="col-lg-9 col-xl-6">
                            <h3 class="kt-section__title kt-section__title-sm"></h3>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-xl-3 col-lg-3 col-form-label">Password Lama</label>
                        <div class="col-lg-9 col-xl-6">
                            <input class="form-control @error('password_lama') is-invalid @enderror" name="password_lama" type="password" value="{{ old('password_lama') }}">
                            @error('password_lama')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-xl-3 col-lg-3 col-form-label">Password Baru</label>
                        <div class="col-lg-9 col-xl-6">
                            <input class="form-control @error('password_baru') is-invalid @enderror" name="password_baru" type="password" value="{{ old('password_baru') }}">
                            @error('password_baru')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-xl-3 col-lg-3 col-form-label">Konfirmasi Password Baru</label>
                        <div class="col-lg-9 col-xl-6">
                            <input class="form-control @error('password_baru_konfirm') is-invalid @enderror" name="password_baru_konfirm" type="password" value="">
                            @error('password_baru_konfirm')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
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