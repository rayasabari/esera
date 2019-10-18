<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Listing;
use App\Models\ObjekProperti;
use App\Models\ObjekKendaraan;
use App\Models\Kategori;
use App\Models\SubKategori;
use App\Models\Pemilik;
use App\Models\Bid;
use App\Models\Nipl;
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
            $listing,
            $nipl,
            $bid;
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
        $this->bid                  = New Bid;
        $this->nipl                 = New Nipl;
        $this->middleware('auth');
    }

    public function home(){
        $listing    = $this->listing
        ->where('tgl_akhir_lelang', '>', date('Y-m-d').' 00:00:00' )
        ->with(array(
            'objek_properti'    => function($query){
                $query->select('id','id_kategori','id_sub_kategori', 'nama','id_provinsi','luas_tanah','luas_bangunan','harga_limit','img')
                ->with(array(
                    'provinsi'  => function($query){
                        $query->select('id','text_proper');
                    }
                ));
            },
            'last_bid'          => function($query){
                $query->select('id','id_listing','jumlah_bid')->orderBy('jumlah_bid', 'DESC');
            },
            'bid'               => function($query){
                $query->select('id','id_listing','jumlah_bid')->orderBy('jumlah_bid', 'DESC');
            }
        ))->orderBy('tgl_akhir_lelang', 'ASC')
        ->get();

        // return $listing;
        return view('pages.home', compact('listing'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
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
            },
            'last_bid' => function($query){
                $query->select('id','id_listing','jumlah_bid')->orderBy('jumlah_bid', 'DESC');
            }
        ))
        ->get();

        // return $objek;
        return view('pages.admin.listing.index', compact('objek'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($nm_kategori, $nm_subkategori, $id)
    {
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
        return view('pages.admin.listing.add', compact('objek'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $nm_kategori, $nm_subkategori, $id)
    {

        $listing                        = $this->listing;
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
        $nipl = $this->nipl->where('id_user', Auth::user()->id)->first();

        $objek = $this->listing
        ->where('id', $id)
        ->with(array(
            'objek_properti' => function($query){
                $query->with(array(
                    'pemilik' => function($query){
                        $query->select('id','first_name','last_name');
                    },
                    'provinsi' => function($query){
                        $query->select('id','text','text_proper');
                    },
                    'kota' => function($query){
                        $query->select('id','text');
                    },
                    'kecamatan' => function($query){
                        $query->select('id','text');
                    },
                    'kelurahan' => function($query){
                        $query->select('id','text');
                    },
                    'sertifikat' => function($query){
                        $query->select('id','nama','singkatan');
                    }
                ));
            },
            'kategori' => function($query){
                $query->select('id','nama');
            },
            'sub_kategori' => function($query){
                $query->select('id','nama');
            },
            'last_bid' => function($query){
                $query->select('id','id_listing','jumlah_bid')->orderBy('jumlah_bid', 'DESC');
            }
        ))
        ->first();

        $bid = $this->bid->where('id_listing', $id)
        ->with(array(
            'nipl'  => function ($query){
                $query->select('id','id_user','nipl')
                ->with(array(
                    'user' => function($query){
                        $query->select('id','first_name','last_name');
                    }
                ));
            }
        ))
        ->orderBy('jumlah_bid', 'DESC')->get();
        
        if(isset($objek->last_bid)){
            $next_bid = $objek->last_bid->jumlah_bid + $objek->kelipatan_bid;
        }else{
            $next_bid = $objek->objek_properti->harga_limit;
        }

        // return count($bid);
        return view('pages.user.detail-objek', compact('nipl','objek','bid','next_bid'));
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

    public function list_objek()
    {
        $objek = $this->listing
        ->with(array(
            'objek_properti' => function($query){
                $query->with(array(
                    'pemilik' => function($query){
                        $query->select('id','first_name','last_name');
                    },
                    'provinsi' => function($query){
                        $query->select('id','text','text_proper');
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
            },
            'last_bid' => function($query){
                $query->select('id','id_listing','jumlah_bid')->orderBy('jumlah_bid', 'DESC');
            },
            'bid' => function($query){
                $query->select('id','id_listing');
            }
        ))
        ->get();
        

        // return count($objek[0]->bid_count);
        return view('pages.user.list-objek', compact('objek'));
    }

    public function list_hasil()
    {
        $objek = $this->listing
        // ->whereHas("objek_properti", function($query){
        //     $query->where("id_status_objek",3);
        // })
        ->where('tgl_akhir_lelang','<=', date('Y-m-d').' 00:00:00' )
        ->with(array(
            'objek_properti' => function($query){
                $query->with(array(
                    'pemilik' => function($query){
                        $query->select('id','first_name','last_name');
                    },
                    'provinsi' => function($query){
                        $query->select('id','text','text_proper');
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
            },
            'last_bid' => function($query){
                $query->select('id','id_listing','id_nipl','jumlah_bid')->orderBy('jumlah_bid', "DESC")
                ->with(array(
                    'nipl' => function($query){
                        $query->select('id','id_user')
                        ->with(array(
                            'user'  => function($query){
                                $query->select('id','first_name','last_name');
                            }
                        ));
                    }
                ));
            },
            'bid' => function($query){
                $query->select('id','id_listing');
            }
        ))
        ->get();
        
        // return $objek;
        return view('pages.user.list-hasil', compact('objek'));
    }

    public function submit_bid(Request $request, $id_nipl, $id_listing)
    {
        $kelipatan  = $this->listing->where('id', $id_listing)->first()->kelipatan_bid;
        $submit     = str_replace(".","",$request->jumlah_bid);
        $bid        = $this->bid->where('id_listing', $id_listing)->select('jumlah_bid')->get();
        
        if( count($bid) == 0 ){
            $last_bid   = $this->listing
            ->where('id', $id_listing)->with(array(
                'objek_properti' => function($query){
                    $query->select('id', 'harga_limit');
                }
            ))->first()->objek_properti->harga_limit;

            if($submit < $last_bid){
                return redirect('/detail/objek/'.$id_listing)->with('error','Maaf, nilai Bid yang Anda masukkan harus lebih besar dari Harga Limit!');
                die;
            }
        }else{
            $last_bid   = $this->bid->where('id_listing', $id_listing)->select('jumlah_bid')->orderBy('jumlah_bid', 'DESC')->first()->jumlah_bid;
            
            if($submit < $last_bid){
                return redirect('/detail/objek/'.$id_listing)->with('error','Maaf, nilai Bid yang Anda masukkan harus lebih besar dari Harga Penawaran terakhir!');
                die;
            }
        }

        $gap = ((int)$submit - (int)$last_bid) / (int)$kelipatan;

        if(is_int($gap) == true ){
            
            $bid = $this->bid;
            $bid->id_listing     = $id_listing;
            $bid->id_nipl        = $id_nipl;
            $bid->jumlah_bid     = str_replace(".","",$request->jumlah_bid);
            $bid->save();

            return redirect('/detail/objek/'.$id_listing)->with('status','Terima kasih, Bid berhasil disubmit!');
        }else{
            return redirect('/detail/objek/'.$id_listing)->with('error','Maaf, nilai Bid yang dimasukan harus kelipatan Rp '.number_format($kelipatan,0,',','.'));
        }
    }

}
