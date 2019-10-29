{{-- <div class="kt-widget__contact">
    <span class="kt-widget__label kt-valign-top" style="vertical-align: top";>Alamat</span>
    <span class="kt-widget__data kt-valign-top text-left" style="max-width: 50%">
        {{ $objek->alamat .', '. ucwords(strtolower($objek->kelurahan->text)) .', '. ucwords(strtolower($objek->kecamatan->text)) .', '. ucwords(strtolower($objek->kota->text)) .', '. $objek->provinsi->text }}
    </span>
</div> --}}

<div class="kt-widget12">
    <div class="kt-widget12__content">
        <div class="kt-widget12__item">	
            <div class="kt-widget12__info">
                <span class="kt-widget12__desc">Kategori</span> 
                <span class="kt-widget12__value">{{ $objek->kategori->nama . ' (' . $objek->sub_kategori->nama . ')' }}</span>
            </div>		 	 
            <div class="kt-widget12__info">				 	 
                <span class="kt-widget12__desc">Nama</span> 
                <span class="kt-widget12__value">{{ $objek->nama }}</span>
            </div>
        </div>
        <div class="kt-widget12__item">	
            <div class="kt-widget12__info">				 	 
                <span class="kt-widget12__desc">Sertifikat</span> 
                <span class="kt-widget12__value">{{ $objek->sertifikat->nama .' ('. $objek->sertifikat->singkatan .')' }}</span>
            </div>
            <div class="kt-widget12__info">				 	 
                <span class="kt-widget12__desc">No. Sertifikat</span> 
                <span class="kt-widget12__value">{{ $objek->no_sertifikat }}</span>
            </div>	 	 
        </div>
        <div class="kt-widget12__item">	
            <div class="kt-widget12__info">				 	 
                <span class="kt-widget12__desc">Atas Nama Sertfikat</span> 
                <span class="kt-widget12__value">{{ $objek->atas_nama_sertifikat }}</span>
            </div>	 
            <div class="kt-widget12__info">
                <span class="kt-widget12__desc">Pemilik</span> 
                <span class="kt-widget12__value">{{ $objek->pemilik->first_name . ' ' . $objek->pemilik->last_name }}</span>
            </div>					 	 	 
        </div>
        <div class="kt-widget12__item">	
            <div class="kt-widget12__info">				 	 
                <span class="kt-widget12__desc">Harga Limit</span> 
                <span class="kt-widget12__value">Rp {{ number_format($objek->harga_limit,0,',','.') }},-</span>
            </div>
            <div class="kt-widget12__info">
                <span class="kt-widget12__desc">Jaminan</span> 
                <span class="kt-widget12__value">Rp {{ number_format($objek->jaminan,0,',','.') }},-</span>
            </div>					 	 	 
        </div>
    </div>
</div>