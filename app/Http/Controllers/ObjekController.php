<?php

namespace App\Http\Controllers;

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

        return view('pages.admin.objek.add', compact('objek','user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $objek = $this->objek;
        $objek->nama = $request->nama;
        $objek->id_kategori = $request->kategori;
        $objek->luas_tanah = $request->luas_tanah;
        $objek->luas_bangunan = $request->luas_bangunan;
        $objek->harga_limit = $request->harga_limit;
        $objek->jaminan = $request->jaminan;
        $objek->deskripsi = $request->deskripsi;
        $objek->id_pemilik = $request->pemilik;
        $objek->save();

        return redirect('/data_objek');
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
    public function edit(Objek $objek)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Objek  $objek
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Objek $objek)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Objek  $objek
     * @return \Illuminate\Http\Response
     */
    public function destroy(Objek $objek)
    {
        //
    }
}
