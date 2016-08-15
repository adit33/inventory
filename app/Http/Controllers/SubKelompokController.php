<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\DataTables\SubKelompokDataTable;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use App\SubKelompok;

class SubKelompokController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(SubKelompokDataTable $dataTable)
    {
       return $dataTable->render('sub_kelompok.index');
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

    public function getSubKelompok(Request $request)
    {
        $idSub=DB::table('subKelompok')
            ->where('kelompok_kode','=',$request->id_kelompok)
            ->get();

        return $idSub;
    }

    public function getDataSubKelompok(Request $request)
    {
        $subKelompok=SubKelompok::find($request->id_sub);

        return $subKelompok;
    }
}
