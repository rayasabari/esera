<?php

namespace App\Http\Controllers;

use App\Models\Objek;
use Illuminate\Http\Request;
use Psy\Util\Json;

class ObjekController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $objek = Objek::all();
        return view('pages.admin.list-objek', compact('objek'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Objek  $objek
     * @return \Illuminate\Http\Response
     */
    public function show(Objek $objek)
    {
        //
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
