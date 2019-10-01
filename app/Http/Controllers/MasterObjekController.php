<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ObjekProperti;
use App\Models\ObjekKendaraan;
use App\Http\Requests\ErrorMessageRequest;
use Psy\Util\Json;
use Auth;

class MasterObjekController extends Controller
{
    public  $objekproperti, 
            $objekkendaraan;

    public function __construct()
    {
        $this->objekproperti = New ObjekProperti();
        $this->objekkendaraan = New ObjekKendaraan();
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
        
        $merged = array_merge($properti, $kendaraan);
        $objek = json_decode(json_encode($merged));
        return view('pages.admin.objek.index', compact('objek','user'));
        // return response()->json($objek);
    }
}
