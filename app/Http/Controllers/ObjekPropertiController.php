<?php

namespace App\Http\Controllers;

use App\Http\Requests\ErrorMessageRequest;
use App\Models\ObjekProperti;
use App\Models\Kategori;
use App\Models\SubKategori;
use App\Models\Pemilik;
use App\Models\IndonesiaProvinsi;
use App\Models\IndonesiaKota;
use App\Models\IndonesiaKecamatan;
use App\Models\IndonesiaKelurahan;
use App\Models\JenisSertifikat;
use Illuminate\Http\Request;
use Auth;

class ObjekPropertiController extends Controller
{
    public  $objek_properti,
            $kategori,
            $sub_kategori,
            $pemilik,
            $master_provinsi,
            $master_kota,
            $master_kecamatan,
            $master_kelurahan,
            $jenis_sertifikat;

        /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->objek_properti       = New ObjekProperti;
        $this->kategori             = New Kategori;
        $this->sub_kategori         = New SubKategori;
        $this->pemilik              = New Pemilik;
        $this->master_provinsi      = New IndonesiaProvinsi;
        $this->master_kota          = New IndonesiaKota;
        $this->master_kecamatan     = New IndonesiaKecamatan;
        $this->master_kelurahan     = New IndonesiaKelurahan;
        $this->jenis_sertifikat     = New JenisSertifikat;
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
    public function create($nm_kategori, $nm_subkategori)
    {
        $user = Auth::user();

        $kategori           = $this->kategori->where('nama', ucwords($nm_kategori))->select('id','nama')->first();
        $subkategori        = $this->sub_kategori->where('nama', ucwords($nm_subkategori))->select('id','nama')->first();
        $pemilik            = $this->pemilik->select('id','first_name','last_name')->get();
        $provinsi           = $this->master_provinsi->select('id','text')->orderBy('text', 'ASC')->get();
        $jenissertifikat    = $this->jenis_sertifikat->select('id','nama','singkatan')->orderBy('id','ASC')->get(); 
        $withdata           = [
            'id_sertifikat' => '',
            'id_pemilik'    => ''
        ];

        // return response()->json($kategoris);
        return view('pages.admin.objek.add-properti', compact('user','kategori','subkategori','pemilik','provinsi','jenissertifikat'))->with('withdata', $withdata);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $nm_kategori, $nm_subkategori)
    {
        if($nm_subkategori  == 'rumah'){
            $request->validate([
                'id_sub_kategori'       => 'required',
                'nama'                  => 'required',
                'alamat'                => 'required',
                'provinsi'              => 'required',
                'kota'                  => 'required',
                'kecamatan'             => 'required',
                'kelurahan'             => 'required',
                'sertifikat'            => 'required',
                'pemilik'               => 'required',
                'tipe'                  => 'required',
                'jumlah_lantai'         => 'required',
                'luas_tanah'            => 'required',
                'luas_bangunan'         => 'required',
                'kamar_tidur'           => 'required',
                'kamar_mandi'           => 'required',
                'harga_limit'           => 'required',
                'jaminan'               => 'required'
            ]);
        }else if($nm_subkategori == 'tanah'){
            $request->validate([
                'id_sub_kategori'       => 'required',
                'nama'                  => 'required',
                'alamat'                => 'required',
                'provinsi'              => 'required',
                'kota'                  => 'required',
                'kecamatan'             => 'required',
                'kelurahan'             => 'required',
                'sertifikat'            => 'required',
                'pemilik'               => 'required',
                'luas_tanah'            => 'required',
                'harga_limit'           => 'required',
                'jaminan'               => 'required'
            ]);
        }else if($nm_subkategori == 'ruko'){
            $request->validate([
                'nama'                  => 'required',
                'alamat'                => 'required',
                'provinsi'              => 'required',
                'kota'                  => 'required',
                'kecamatan'             => 'required',
                'kelurahan'             => 'required',
                'sertifikat'            => 'required',
                'pemilik'               => 'required',
                'jumlah_lantai'         => 'required',
                'luas_unit'             => 'required',
                'harga_limit'           => 'required',
                'jaminan'               => 'required'
            ]);
        }

        $objek = $this->objek_properti;
        $objek->id_kategori         = $request->id_kategori;
        $objek->id_sub_kategori     = $request->id_sub_kategori;
        $objek->nama                = $request->nama;
        $objek->alamat              = $request->alamat;
        $objek->id_provinsi         = $request->provinsi;
        $objek->id_kota             = $request->kota;
        $objek->id_kecamatan        = $request->kecamatan;
        $objek->id_kelurahan        = $request->kelurahan;
        $objek->kode_pos            = $request->kode_pos;
        $objek->id_sertifikat       = $request->sertifikat;
        $objek->id_pemilik          = $request->pemilik;
        $objek->jumlah_lantai       = $request->jumlah_lantai;
        $objek->harga_limit         = str_replace(".","",$request->harga_limit);
        $objek->jaminan             = str_replace(".","",$request->jaminan);
        $objek->deskripsi           = $request->deskripsi;
        $objek->id_status_objek     = 1;
        if($nm_subkategori == "rumah"){
            $objek->tipe                = $request->tipe;
            $objek->luas_tanah          = $request->luas_tanah;
            $objek->luas_bangunan       = $request->luas_bangunan;
            $objek->kamar_tidur         = $request->kamar_tidur;
            $objek->kamar_mandi         = $request->kamar_mandi;
        }else if($nm_subkategori == 'tanah'){
            $objek->luas_tanah          = $request->luas_tanah;
        }else if($nm_subkategori == "ruko"){
            $objek->luas_unit           = $request->luas_unit;
        }
        $objek->save();

        return redirect('/objek')->with('status','Objek Properti berhasil ditambah!');
        // return $request;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ObjekProperti  $objekProperti
     * @return \Illuminate\Http\Response
     */
    public function show($nm_subkategori, $id)
    {
        $user = Auth::user();

        $properti = $this->objek_properti
        ->where('id', $id)
        ->with(array
            (
                'kategori'      => function($query){
                    $query->select('id','nama');
                },
                'sub_kategori'  => function($query){
                    $query->select('id','nama');
                },
                'provinsi'  => function($query){
                    $query->select('id','text');
                },
                'kota'  => function($query){
                    $query->select('id','text');
                },
                'kecamatan'  => function($query){
                    $query->select('id','text');
                },
                'kelurahan'  => function($query){
                    $query->select('id','text');
                },
                'sertifikat'  => function($query){
                    $query->select('id','nama','singkatan');
                },
                'pemilik'  => function($query){
                    $query->select('id','first_name','last_name');
                }
            )
        )
        ->first();

        // return response()->json($properti);
        return view('pages.admin.objek.details', compact('user','properti'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ObjekProperti  $objekProperti
     * @return \Illuminate\Http\Response
     */
    public function edit($nm_subkategori, $id)
    {
        $user = Auth::user();

        $properti           = $this->objek_properti->where('id', $id)->first();
        $kategori           = $this->kategori->where('nama', 'Properti')->select('id','nama')->first();
        $subkategori        = $this->sub_kategori->where('nama', ucwords($nm_subkategori))->select('id','nama')->first();
        $pemilik            = $this->pemilik->select('id','first_name','last_name')->get();
        $provinsi           = $this->master_provinsi->select('id','text')->orderBy('text', 'ASC')->get();
        $kota               = $this->master_kota->where('id_provinsi', $properti->id_provinsi)->select('id','text')->orderBy('text', 'ASC')->get();
        $kecamatan          = $this->master_kecamatan->where('id_kota', $properti->id_kota)->select('id','text')->orderBy('text', 'ASC')->get();
        $kelurahan          = $this->master_kelurahan->where('id_kecamatan', $properti->id_kecamatan)->select('id','text')->orderBy('text', 'ASC')->get();
        $jenissertifikat    = $this->jenis_sertifikat->select('id','nama','singkatan')->orderBy('id','ASC')->get(); 
        $withdata           = [
            'id_provinsi'   => $properti->id_provinsi,
            'id_kota'       => $properti->id_kota,
            'id_kecamatan'  => $properti->id_kecamatan,
            'id_kelurahan'  => $properti->id_kelurahan,
            'id_sertifikat' => $properti->id_sertifikat,
            'id_pemilik'    => $properti->id_pemilik,
            'alamat'        => $properti->alamat,
            'kode_pos'      => $properti->kode_pos
        ];
        // return $id;
        return view('pages.admin.objek.edit-properti', compact('user','properti','kategori','subkategori','pemilik','provinsi','kota','kecamatan','kelurahan','jenissertifikat'))->with('withdata', $withdata);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ObjekProperti  $objekProperti
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $nm_subkategori, $id)
    {
        
            ObjekProperti::where('id', $id)
            ->update([
                'nama'          => $request->nama,
                'alamat'        => $request->alamat,
                'id_provinsi'   => $request->provinsi,
                'id_kota'       => $request->kota,
                'id_kecamatan'  => $request->kecamatan,
                'id_kelurahan'  => $request->kelurahan,
                'kode_pos'      => $request->kode_pos,
                'tipe'          => $request->tipe,
                'jumlah_lantai' => $request->jumlah_lantai,
                'luas_tanah'    => $request->luas_tanah,
                'luas_bangunan' => $request->luas_bangunan,
                'kamar_tidur'   => $request->kamar_tidur,
                'kamar_mandi'   => $request->kamar_mandi,
                'id_sertifikat' => $request->sertifikat,
                'id_pemilik'    => $request->pemilik,
                'harga_limit'   => str_replace(".","",$request->harga_limit),
                'jaminan'       => str_replace(".","",$request->jaminan),
                'deskripsi'     => $request->deskripsi
            ]);
        
        return redirect('/objek')->with('status','Data Objek berhasil diubah!');
        // return $request;

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ObjekProperti  $objekProperti
     * @return \Illuminate\Http\Response
     */
    public function destroy($nm_subkategori, $id)
    {
        ObjekProperti::destroy($id);
        return redirect('/objek')->with('status','Data Objek berhasil dihapus!');
        // return $id;
    }
}
