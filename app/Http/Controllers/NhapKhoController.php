<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ChungLoai;
use App\PhanCapGiong;
use App\VuSanXuat;

class NhapKhoController extends Controller
{
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
        $DS_ChungLoai = ChungLoai::all();
        $DS_PhanCapGiong = PhanCapGiong::all();
        $DS_VuSanXuat = VuSanXuat::all();

        return view('backend.storemanagement.storeimport', ['DS_ChungLoai' => $DS_ChungLoai, 'DS_PhanCapGiong' => $DS_PhanCapGiong, 'DS_VuSanXuat' => $DS_VuSanXuat]);
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
}
