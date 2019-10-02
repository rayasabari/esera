<?php

namespace App\Http\Controllers;

use App\Http\Requests\ErrorMessageRequest;
use App\Models\ObjekProperti;
use App\Models\SubKategori;
use App\Models\Pemilik;
use App\Models\IndonesiaProvinsi;
use Illuminate\Http\Request;
use Auth;

class ObjekPropertiController extends Controller
{
    public  $objek_properti,
            $sub_kategori,
            $pemilik,
            $master_provinsi;

        /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->objek_properti = New ObjekProperti;
        $this->sub_kategori = New SubKategori;
        $this->pemilik = New Pemilik;
        $this->master_provinsi = New IndonesiaProvinsi;
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();

        $subkategori = $this->sub_kategori
        ->where('id_kategori', 1)
        ->select('id','nama')
        ->get();

        $pemilik = $this->pemilik
        ->select('id','first_name','last_name')
        ->get();

        $provinsi = $this->master_provinsi
        ->select('id','text')
        ->orderBy('text', 'ASC')
        ->get();

        // return response()->json($provinsi);
        return view('pages.admin.objek.add-properti', compact('user','subkategori','pemilik','provinsi'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $objek = $this->objek_properti;
        $objek->id_kategori = 1;
        $objek->id_sub_kategori = $request->id_sub_kategori;
        $objek->nama = $request->nama;
        $objek->alamat = $request->alamat;
        $objek->id_provinsi = $request->provinsi;
        $objek->id_kota = $request->kota;
        $objek->id_kecamatan = $request->kecamatan;
        $objek->id_kelurahan = $request->kelurahan;
        $objek->kode_pos = $request->kode_pos;
        $objek->id_pemilik = $request->pemilik;
        $objek->tipe = $request->tipe;
        $objek->jumlah_lantai = $request->jumlah_lantai;
        $objek->luas_tanah = $request->luas_tanah;
        $objek->luas_bangunan = $request->luas_bangunan;
        $objek->kamar_tidur = $request->kamar_tidur;
        $objek->kamar_mandi = $request->kamar_mandi;
        $objek->harga_limit = $request->harga_limit;
        $objek->jaminan = $request->jaminan;
        $objek->deskripsi = $request->deskripsi;
        $objek->save();

        return redirect('/objek')->with('status','Objek Properti berhasil ditambah!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ObjekProperti  $objekProperti
     * @return \Illuminate\Http\Response
     */
    public function show(ObjekProperti $objekProperti)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ObjekProperti  $objekProperti
     * @return \Illuminate\Http\Response
     */
    public function edit(ObjekProperti $objekProperti)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ObjekProperti  $objekProperti
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ObjekProperti $objekProperti)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ObjekProperti  $objekProperti
     * @return \Illuminate\Http\Response
     */
    public function destroy(ObjekProperti $objekProperti)
    {
        //
    }
}
