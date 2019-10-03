<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ObjekProperti;
use App\Models\ObjekKendaraan;
use App\Models\Kategori;
use App\Models\SubKategori;
use App\Http\Requests\ErrorMessageRequest;
use Psy\Util\Json;
use Auth;

class MasterObjekController extends Controller
{
    public  $objekproperti, 
            $objekkendaraan,
            $kategori,
            $sub_kategori;

    public function __construct()
    {
        $this->objekproperti    = New ObjekProperti();
        $this->objekkendaraan   = New ObjekKendaraan();
        $this->kategori         = New Kategori();
        $this->sub_kategori     = New SubKategori();
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();
        
        $properti = $this->objekproperti
        ->select('id','id_kategori','id_sub_kategori','id_pemilik','nama','harga_limit','jaminan')
        ->with(array
            (
                'kategori'      => function($query){
                    $query->select('id','nama');
                },
                'sub_kategori'  => function($query){
                    $query->select('id','nama');
                },
                'pemilik'  => function($query){
                    $query->select('id','first_name','last_name');
                }
            )
        )
        ->get()
        ->toArray();

        $kendaraan = $this->objekkendaraan
        ->select('id','id_kategori','id_sub_kategori','id_pemilik','nama','harga_limit','jaminan')
        ->with(array
            (
                'kategori'      => function($query){
                    $query->select('id','nama');
                },
                'sub_kategori'  => function($query){
                    $query->select('id','nama');
                },
                'pemilik'  => function($query){
                    $query->select('id','first_name','last_name');
                }
            )
        )
        ->get()
        ->toArray();

        $subkategori = $this->sub_kategori
        ->where('id_kategori',1)
        ->select('id','id_kategori','nama')
        ->with(array
            (
                'kategori'      => function($query){
                    $query->select('id','nama');
                },
            )
        )
        ->get();

        
        $merged = array_merge($properti, $kendaraan);
        $objek = json_decode(json_encode($merged));
        return view('pages.admin.objek.index', compact('objek','user','subkategori'));
        // return response()->json($subkategori);
    }
}
