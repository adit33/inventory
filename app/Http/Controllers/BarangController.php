<?php

namespace App\Http\Controllers;

use App\DataTables\BarangDataTable;
use App\Barang;
use App\Events\BarangRegistrationEvent;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Validator;
use Response;
use App\Library\Autonumber;
use App\Repository\BarangRepository;
use App\Role;

class BarangController extends Controller
{

    public function __construct(BarangRepository $barang){
        $this->barang=$barang;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(BarangDataTable $dataTable)
    {   
        if (auth()->user()->can('user.create')){     
        
        $kodeBarang=$this->getKodeBarang();
        return $dataTable->render('barang.index',compact('barangs','kodeBarang'));}
        // else {
        // return auth()->user()->hasRole('user.create');
        // }
    }

    public function apiBarang(){
        $barangs=$this->barang->apiBarang();
        return $barangs;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (auth()->user()->can('create.user')){
        $kodeBarang=$this->getKodeBarang();
        return View('barang.create',compact('kodeBarang'));
        }
        return View('login');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $validator = Validator::make($request->all(),Barang::$rules,Barang::$pesan);
       if ($validator->fails())
        {
            return response()->Json(array('errors'=>$validator->errors()->toArray()));
        }
        else{
       Barang::create($request->all()); 
       $barang=Barang::where('jumlahBarang','<',20)->get()->toArray();
       event(new BarangRegistrationEvent($barang));

        }
       
       
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

    public function getKodeBarang(){
        $table="barang";
        $primary="idBarang";
        $prefix="BRG-";
        $kodeBarang=Autonumber::autonumber($table,$primary,$prefix);
        return $kodeBarang;
    }
       
}
