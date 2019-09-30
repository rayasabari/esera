<?php

namespace App\Http\Controllers;

use App\Http\Requests\ErrorMessageRequest;
use App\Models\Objek;
use Illuminate\Http\Request;
use Psy\Util\Json;
use Auth;

class ObjekController extends Controller
{
    public $objek;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->objek = New Objek();
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
        
        $objek = $this->objek
        ->get();

        return view('pages.admin.objek.index', compact('objek','user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();

        return view('pages.admin.objek.add', compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ErrorMessageRequest $request)
    {
        $request->validate([
            'nama' => 'required',
            'id_kategori' => 'required',
        ]);

        // $objek = $this->objek;
        // $objek->nama = $request->nama;
        // $objek->id_kategori = $request->kategori;
        // $objek->luas_tanah = $request->luas_tanah;
        // $objek->luas_bangunan = $request->luas_bangunan;
        // $objek->harga_limit = $request->harga_limit;
        // $objek->jaminan = $request->jaminan;
        // $objek->deskripsi = $request->deskripsi;
        // $objek->id_pemilik = $request->pemilik;
        // $objek->save();

        Objek::create($request->all());

        return redirect('/data_objek')->with('status','Data Objek berhasil ditambah!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Objek  $objek
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = Auth::user();

        $objek = $this->objek
        ->where('id', $id)
        ->first();

        return view('pages.admin.objek.details', compact('objek','user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Objek  $objek
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = Auth::user();

        $objek = $this->objek
        ->where('id', $id)
        ->first();

        return view('pages.admin.objek.edit', compact('objek','user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Objek  $objek
     * @return \Illuminate\Http\Response
     */
    public function update(ErrorMessageRequest $request, $id)
    {   
        Objek::where('id', $id)
        ->update([
            'nama' => $request->nama,
            'id_kategori' => $request->id_kategori,
            'id_pemilik' => $request->id_pemilik,
            'luas_tanah' => $request->luas_tanah,
            'luas_bangunan' => $request->luas_bangunan,
            'harga_limit' => $request->harga_limit,
            'deskripsi' => $request->deskripsi,
            'jaminan' => $request->jaminan
            ]);

        return redirect('/data_objek')->with('status','Data Objek berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Objek  $objek
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Objek::destroy($id);
        return redirect('/data_objek')->with('status','Data Objek berhasil dihapus!');
    }
}
