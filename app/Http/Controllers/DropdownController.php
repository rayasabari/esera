<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\IndonesiaProvinsi;
use App\Models\IndonesiaKota;
use App\Models\IndonesiaKecamatan;
use App\Models\IndonesiaKelurahan;
use Auth;

class DropdownController extends Controller
{
    
    public  $provinsi,
            $kota,
            $kecamatan,
            $kelurahan;
    
    public function __construct()
    {
        $this->provinsi     = New IndonesiaProvinsi;
        $this->kota         = New IndonesiaKota;
        $this->kecamatan    = New IndonesiaKecamatan;
        $this->kelurahan    = New IndonesiaKelurahan;
        $this->middleware('auth');
    }

    public function kota($id_provinsi){
        $kota = $this->kota
        ->where('id_provinsi', $id_provinsi)
        ->select('id','text')
        ->orderBy('text', 'ASC')
        ->get();

        echo "<option value='0'>- Pilih -</option>";
        if($kota != NULL) {
			foreach($kota as $item) {
				echo "<option value='{$item->id}'>{$item->text}</option>";
			}
		}
    }

    public function kecamatan($id_kota){
        $kecamatan = $this->kecamatan
        ->where('id_kota', $id_kota)
        ->select('id','text')
        ->orderBy('text', 'ASC')
        ->get();

        echo "<option value='0'>- Pilih -</option>";
        if($kecamatan != NULL) {
			foreach($kecamatan as $item) {
				echo "<option value='{$item->id}'>{$item->text}</option>";
			}
		}
    }

    public function kelurahan($id_kecamatan){
        $kelurahan = $this->kelurahan
        ->where('id_kecamatan', $id_kecamatan)
        ->select('id','text')
        ->orderBy('text', 'ASC')
        ->get();

        echo "<option value='0'>- Pilih -</option>";
        if($kelurahan != NULL) {
			foreach($kelurahan as $item) {
				echo "<option value='{$item->id}'>{$item->text}</option>";
			}
		}
    }

}
