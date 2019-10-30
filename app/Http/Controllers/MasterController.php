<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ObjekProperti;
use App\Models\ObjekKendaraan;
use App\Models\Kategori;
use App\Models\SubKategori;
use App\Models\Pemilik;
use App\Models\User;
use App\Models\UserInfo;
use App\Models\Nipl;
use App\Models\StatusNipl;
use App\Models\IndonesiaProvinsi;
use App\Models\IndonesiaKota;
use App\Models\IndonesiaKecamatan;
use App\Models\IndonesiaKelurahan;
use App\Models\JenisSertifikat;
use App\Http\Requests\ErrorMessageRequest;
use Psy\Util\Json;
use Auth;

class MasterController extends Controller
{
    public  $objek_properti, 
            $objekk_endaraan,
            $kategori,
            $sub_kategori,
            $pemilik,
            $user,
            $user_info,
            $nipl,
            $statu_nipl,
            $master_provinsi,
            $master_kota,
            $master_kecamatan,
            $master_kelurahan,
            $jenis_sertifikat;

    public function __construct()
    {
        $this->objek_properti       = New ObjekProperti;
        $this->objek_kendaraan      = New ObjekKendaraan;
        $this->kategori             = New Kategori;
        $this->sub_kategori         = New SubKategori;
        $this->pemilik              = New Pemilik;
        $this->user                 = New User;
        $this->user_info            = New UserInfo;
        $this->nipl                 = New Nipl;
        $this->master_provinsi      = New IndonesiaProvinsi;
        $this->master_kota          = New IndonesiaKota;
        $this->master_kecamatan     = New IndonesiaKecamatan;
        $this->master_kelurahan     = New IndonesiaKelurahan;
        $this->jenis_sertifikat     = New JenisSertifikat;
        $this->status_nipl          = New StatusNipl;
        $this->middleware('auth');
    }

    // INDEX MASTER OBJEK
    public function objek_index()
    {
        $properti   = $this->objek_properti
        ->select('id','id_kategori','id_sub_kategori','id_pemilik','nama','harga_limit','jaminan','id_status_objek')
        ->with(array
            (
                'kategori'      => function($query){
                    $query->select('id','nama');
                },
                'sub_kategori'  => function($query){
                    $query->select('id','nama');
                },
                'pemilik'       => function($query){
                    $query->select('id','first_name','last_name');
                },
                'status_objek'  => function($query){
                    $query->select('id','nama');
                }
            )
        )->get()->toArray();

        $kendaraan = $this->objek_kendaraan
        ->select('id','id_kategori','id_sub_kategori','id_pemilik','nama','harga_limit','jaminan','id_status_objek')
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
                },
                'status_objek'  => function($query){
                    $query->select('id','nama');
                }
            )
        )->get()->toArray();

        $subkategori = $this->sub_kategori
        ->where('id_kategori',1)
        ->select('id','id_kategori','nama')
        ->with(array
            (
                'kategori'      => function($query){
                    $query->select('id','nama');
                },
            )
        )->get();
        
        $merged = array_merge($properti, $kendaraan);
        $objek = json_decode(json_encode($merged));
        return view('pages.admin.objek.index', compact('objek','subkategori'));
    }

    // CREATE OBJEK PROPERTI
    public function objek_properti_create($nm_kategori, $nm_subkategori)
    {
        $user               = Auth::user();
        $kategori           = $this->kategori->where('nama', ucwords($nm_kategori))->select('id','nama')->first();
        $subkategori        = $this->sub_kategori->where('nama', ucwords($nm_subkategori))->select('id','nama')->first();
        $pemilik            = $this->pemilik->select('id','first_name','last_name')->get();
        $provinsi           = $this->master_provinsi->select('id','text')->orderBy('text', 'ASC')->get();
        $jenissertifikat    = $this->jenis_sertifikat->select('id','nama','singkatan')->orderBy('id','ASC')->get(); 
        $withdata           = [
            'id_sertifikat' => '',
            'id_pemilik'    => ''
        ];

        return view('pages.admin.objek.add-properti', compact('kategori','subkategori','pemilik','provinsi','jenissertifikat'))->with('withdata', $withdata);
    }

    // STORE OBJEK PROPERTI
    public function objek_properti_store(Request $request, $nm_kategori, $nm_subkategori)
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
                // 'tipe'                  => 'required',
                // 'jumlah_lantai'         => 'required',
                'luas_tanah'            => 'required',
                // 'luas_bangunan'         => 'required',
                // 'kamar_tidur'           => 'required',
                // 'kamar_mandi'           => 'required',
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

        $objek                      = $this->objek_properti;
        $objek->id_kategori         = $request->id_kategori;
        $objek->id_sub_kategori     = $request->id_sub_kategori;
        $objek->nama                = $request->nama;
        $objek->alamat              = $request->alamat;
        $objek->latitude            = $request->latitude;
        $objek->longitude           = $request->longitude;
        $objek->id_provinsi         = $request->provinsi;
        $objek->id_kota             = $request->kota;
        $objek->id_kecamatan        = $request->kecamatan;
        $objek->id_kelurahan        = $request->kelurahan;
        $objek->kode_pos            = $request->kode_pos;
        $objek->id_sertifikat       = $request->sertifikat;
        $objek->no_sertifikat       = $request->no_sertifikat;
        $objek->atas_nama_sertifikat= $request->atas_nama_sertifikat;
        $objek->jenis_pengikatan    = $request->jenis_pengikatan;
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
    }

    // SHOW OBJEK PROPERTI
    public function objek_properti_show($nm_subkategori, $id)
    {
        $properti   = $this->objek_properti
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
        )->first();

        return view('pages.admin.objek.details', compact('properti'));
    }

    // EDIT OBJEK PROPERTI
    public function objek_properti_edit($nm_subkategori, $id)
    {
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
            'latitude'      => $properti->latitude,
            'longitude'     => $properti->longitude,
            'kode_pos'      => $properti->kode_pos
        ];

        return view('pages.admin.objek.edit-properti', compact('properti','kategori','subkategori','pemilik','provinsi','kota','kecamatan','kelurahan','jenissertifikat'))->with('withdata', $withdata);
    }

    // UPDATE OBJEK PROPERTI
    public function objek_properti_update(Request $request, $nm_subkategori, $id)
    {
        ObjekProperti::where('id', $id)
        ->update([
            'nama'          => $request->nama,
            'alamat'        => $request->alamat,
            'latitude'      => $request->latitude,
            'longitude'     => $request->longitude,
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
    }

    // DESTROY OBJEK PROPERTI
    public function objek_properti_destroy($nm_subkategori, $id)
    {
        ObjekProperti::destroy($id);
        return redirect('/objek')->with('status','Data Objek berhasil dihapus!');
    }

    // INDEX PEMILIK
    public function pemilik_index(){

        $pemilik    = $this->pemilik
        ->with(array(
            'user_info' => function($query){
                $query->where('id_status_user', 1)
                ->with(array(
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
                    }
                ));
            }
        ))
        ->orderBy('id', 'ASC')->get();

        return view('pages.admin.pemilik.index', compact('pemilik'));
    }

    // CREATE PEMILIK
    public function pemilik_create(){

        $provinsi           = $this->master_provinsi->select('id','text')->orderBy('text', 'ASC')->get();

        return view('pages.admin.pemilik.add-or-edit', compact('provinsi'));
    }

    // STORE PEMILIK
    public function pemilik_store(Request $request)
    {
        $request->validate([
            'first_name'            => 'required',
            'last_name'             => 'required',
            'alamat'                => 'required',
            'provinsi'              => 'required',
            'kota'                  => 'required',
            'kecamatan'             => 'required',
            'kelurahan'             => 'required',
            'no_telepon'            => 'required',
            'no_ktp'                => 'required',
            'no_rekening'           => 'required',
            'nama_bank'             => 'required',
            'atas_nama_bank'        => 'required'
        ]);

        $pemilik                    = $this->pemilik;
        $pemilik->first_name        = $request->first_name;
        $pemilik->last_name         = $request->last_name;
        $pemilik->email             = $request->email;
        $pemilik->save();
        
        $id_pemilik = $this->pemilik->select('id')->orderBy('id', 'DESC')->first();

        $ui                         = $this->user_info;
        $ui->id_status_user         = 1;
        $ui->id_user                = $id_pemilik->id;
        $ui->alamat                 = $request->alamat;
        $ui->id_provinsi            = $request->provinsi;
        $ui->id_kota                = $request->kota;
        $ui->id_kecamatan           = $request->kecamatan;
        $ui->id_kelurahan           = $request->kelurahan;
        $ui->kode_pos               = $request->kode_pos;
        $ui->no_telepon             = $request->no_telepon;
        $ui->no_fax                 = $request->no_fax;
        $ui->no_ktp                 = $request->no_ktp;
        $ui->npwp                   = $request->npwp;
        $ui->no_rekening            = $request->no_rekening;
        $ui->nama_bank              = $request->nama_bank;
        $ui->cabang_bank            = $request->cabang_bank;
        $ui->atas_nama_bank         = $request->atas_nama_bank;
        $ui->save();

        return redirect('/pemilik')->with('status','Data Pemilik berhasil ditambah!');
    }

    // EDIT PEMILIK
    public function pemilik_edit($id)
    {
        $pemilik            = $this->pemilik->where('id', $id)
        ->with(array(
            'user_info'     => function($query){
                $query->where('id_status_user', 1)
                ->with(array(
                    'provinsi'      => function($query){
                        $query->select('id', 'text');
                    },
                    'kota'      => function($query){
                        $query->select('id', 'text');
                    },
                    'kecamatan'      => function($query){
                        $query->select('id', 'text');
                    },
                    'kelurahan'      => function($query){
                        $query->select('id', 'text');
                    }
                ));
            }
        ))->first();
        $provinsi           = $this->master_provinsi->select('id','text')->orderBy('text', 'ASC')->get();
        $kota               = $this->master_kota->where('id_provinsi', $pemilik->user_info->id_provinsi)->select('id','text')->orderBy('text', 'ASC')->get();
        $kecamatan          = $this->master_kecamatan->where('id_kota', $pemilik->user_info->id_kota)->select('id','text')->orderBy('text', 'ASC')->get();
        $kelurahan          = $this->master_kelurahan->where('id_kecamatan', $pemilik->user_info->id_kecamatan)->select('id','text')->orderBy('text', 'ASC')->get();
        $withdata           = [
            'id_provinsi'   => $pemilik->user_info->id_provinsi,
            'id_kota'       => $pemilik->user_info->id_kota,
            'id_kecamatan'  => $pemilik->user_info->id_kecamatan,
            'id_kelurahan'  => $pemilik->user_info->id_kelurahan,
            'id_sertifikat' => $pemilik->user_info->id_sertifikat,
            'id_pemilik'    => $pemilik->user_info->id_pemilik
        ];
        return view('pages.admin.pemilik.add-or-edit', compact('pemilik','provinsi','kota','kecamatan','kelurahan'))->with('withdata', $withdata);
        // return $withdata;
    }

    // UPDATE PEMILIK
    public function pemilik_update(Request $request, $id)
    {
        $request->validate([
            'first_name'            => 'required',
            'last_name'             => 'required',
            'alamat'                => 'required',
            'provinsi'              => 'required',
            'kota'                  => 'required',
            'kecamatan'             => 'required',
            'kelurahan'             => 'required',
            'no_telepon'            => 'required',
            'no_ktp'                => 'required',
            'no_rekening'           => 'required',
            'nama_bank'             => 'required',
            'atas_nama_bank'        => 'required'
        ]);

        Pemilik::where('id', $id)
        ->update([
            'first_name'            => $request->first_name,
            'last_name'             => $request->last_name,
            'email'                 => $request->email,
        ]);

        UserInfo::where([
            ['id_status_user', 1],
            ['id_user', $id]
        ])->update([
            'alamat'                => $request->alamat,
            'id_kelurahan'          => $request->kelurahan,
            'id_kecamatan'          => $request->kecamatan,
            'id_kota'               => $request->kota,
            'id_provinsi'           => $request->provinsi,
            'kode_pos'              => $request->kode_pos,
            'no_telepon'            => $request->no_telepon,
            'no_fax'                => $request->no_fax,
            'no_ktp'                => $request->no_ktp,
            'npwp'                  => $request->npwp,
            'no_rekening'           => $request->no_rekening,
            'nama_bank'             => $request->nama_bank,
            'cabang_bank'           => $request->cabang_bank,
            'atas_nama_bank'        => $request->atas_nama_bank
        ]);

        return redirect('/edit/pemilik/'.$id)->with('status','Data Pemilik berhasil dirubah!');
    }
    
    // DESTROY OBJEK PROPERTI
    public function pemilik_destroy($id)
    {
        Pemilik::destroy($id);
        UserInfo::where([
            ['id_status_user', 1],
            ['id_user', $id]
        ])->delete();
        
        return redirect('/pemilik')->with('status','Data Pemilik berhasil dihapus!');
    }

    // INDEX BIDDER
    public function bidder_index()
    {
        $bidder       = $this->user
        ->whereHas("roleuser", function($query){
            $query->where("role_id",2);
        })->with(array(
            'nipl'  => function($query){
                $query->select('id', 'id_user','nipl','deposite','tgl_deposite','id_status_nipl')
                ->with(array(
                    'status_nipl'   => function($query){
                        $query->select('id','nama');
                    }
                ));
            }
        ))->select('id','name','first_name','last_name','email')
        ->get();

        return view('pages.admin.bidder.index', compact('bidder'));
        // return $bidder;
    }

    // EDIT BIDDER
    public function bidder_edit($id)
    {
        $bidder = $this->user->where('id', $id)
        ->with(array(
            'nipl'  => function($query){
                $query->get();
            }
        ))
        ->first();

        $status_nipl    = $this->status_nipl->select('id','nama')->get();
        $act            = isset($bidder->nipl) ? 'edit' : 'add';

        return view('pages.admin.bidder.update', compact('bidder','act','status_nipl'));
        // return $bidder;
    }

    // STORE OR UPDATE BIDDER
    public function bidder_store_or_update(Request $request, $id)
    {
        $cek  = $this->nipl->where('id_user', $id)->select('id_user')->first();

        if(isset($cek->id_user)){
            $this->nipl->where('id_user', $cek->id_user)
            ->update([
                'nipl'              => $request->nipl,
                'deposite'          => str_replace('.','',$request->deposite),
                'tgl_deposite'      => $request->tgl_deposite,
                'id_status_nipl'    => $request->id_status_nipl
            ]);
        }else{
            $nipl                   = $this->nipl;
            $nipl->id_user          = $id;
            $nipl->nipl             = $request->nipl;    
            $nipl->deposite         = str_replace(".","",$request->deposite);
            $nipl->tgl_deposite     = $request->tgl_deposite;    
            $nipl->id_status_nipl   = $request->id_status_nipl;
            $nipl->save();  
        }

        return redirect('/bidder')->with('status','Data Bidder berhasil diupdate!');
    }
}
