<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Listing;
use App\Models\ObjekProperti;
use App\Models\ObjekKendaraan;
use App\Models\Kategori;
use App\Models\SubKategori;
use App\Models\Pemilik;
use App\Models\IndonesiaProvinsi;
use App\Models\IndonesiaKota;
use App\Models\IndonesiaKecamatan;
use App\Models\IndonesiaKelurahan;
use App\Models\JenisSertifikat;
use Auth;

class ListingController extends Controller
{
    public  $objek_properti,
            $objek_kendaraan,
            $kategori,
            $sub_kategori,
            $pemilik,
            $master_provinsi,
            $master_kota,
            $master_kecamatan,
            $master_kelurahan,
            $jenis_sertifikat,
            $listing;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->objek_properti       = New ObjekProperti;
        $this->objek_kendaraan      = New ObjekKendaraan;
        $this->kategori             = New Kategori;
        $this->sub_kategori         = New SubKategori;
        $this->pemilik              = New Pemilik;
        $this->master_provinsi      = New IndonesiaProvinsi;
        $this->master_kota          = New IndonesiaKota;
        $this->master_kecamatan     = New IndonesiaKecamatan;
        $this->master_kelurahan     = New IndonesiaKelurahan;
        $this->jenis_sertifikat     = New JenisSertifikat;
        $this->listing              = New Listing;
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();

        $objek  = $this->listing
        ->with(array(
            'objek_properti' => function($query){
                $query->select('id','id_kategori','id_sub_kategori','id_pemilik','nama','harga_limit','jaminan')
                ->with(array(
                    'pemilik' => function($query){
                        $query->select('id','first_name','last_name');
                    },
                    'kategori' => function($query){
                        $query->select('id','nama');
                    },
                    'sub_kategori' => function($query){
                        $query->select('id','nama');
                    }
                ))->get();
            }
        ))
        ->get();

        // return $objek;
        return view('pages.admin.listing.index', compact('user','objek'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($nm_kategori, $nm_subkategori, $id)
    {
        $user = Auth::user();

        if($nm_kategori == 'properti'){
            $objek = $this->objek_properti
            ->where('id', $id)
            ->with(array(
                'pemilik' => function($query){
                    $query->select('id', 'first_name', 'last_name');
                },
                'provinsi' => function($query){
                    $query->select('id', 'text');
                },
                'kota' => function($query){
                    $query->select('id', 'text');
                },
                'kecamatan' => function($query){
                    $query->select('id', 'text');
                },
                'kelurahan' => function($query){
                    $query->select('id', 'text');
                },
                'sertifikat' => function($query){
                    $query->select('id', 'nama','singkatan');
                }
            ))
            ->first();
        }else{
            $objek = $this->objek_kendaraan
            ->where('id', $id)
            ->first();
        }

        // return $objek;
        return view('pages.admin.listing.add', compact('user','objek'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $nm_kategori, $nm_subkategori, $id)
    {

        $listing  = $this->listing;
        $listing->id_kategori           = $request->id_kategori;
        $listing->id_sub_kategori       = $request->id_sub_kategori;
        $listing->id_objek              = $id;
        $listing->kode_lot              = $request->kode_lot;
        $listing->kelipatan_bid         = str_replace(".","",$request->kelipatan_bid);
        $listing->tgl_mulai_lelang      = $request->tgl_mulai_lelang;
        $listing->tgl_akhir_lelang      = $request->tgl_akhir_lelang;
        $listing->save();

        if($nm_kategori == 'properti'){
            ObjekProperti::where('id', $id)
            ->update([
                'id_status_objek' => 2
            ]);
        }elseif($nm_kategori == 'kendaraan'){
            ObjekKendaraan::where('id', $id)
            ->update([
                'id_status_objek' => 2
            ]);
        }

        return redirect('/listing')->with('status','Listing Properti berhasil ditambah!');
        // return $id;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function listobjek()
    {
        $user = Auth::user();

        $objek = $this->listing
        ->with(array(
            'objek_properti' => function($query){
                $query->with(array(
                    'pemilik' => function($query){
                        $query->select('id','first_name','last_name');
                    },
                    'provinsi' => function($query){
                        $query->select('id','text');
                    },
                    'kota' => function($query){
                        $query->select('id','text');
                    },
                    'kecamatan' => function($query){
                        $query->select('id','text');
                    },
                    'kelurahan' => function($query){
                        $query->select('id','text');
                    }
                ));
            },
            'kategori' => function($query){
                $query->select('id','nama');
            },
            'sub_kategori' => function($query){
                $query->select('id','nama');
            }      
        ))
        ->get();

        // return $objek;
        return view('pages.user.list-objek', compact('user','objek'));

    }

}
