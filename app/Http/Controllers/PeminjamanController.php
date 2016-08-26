<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Peminjaman;
use App\DataTables\SubKelompokDataTable;
use App\SubKelompok,Auth;
use Session,Cart,Validator;
use App\Library\Autonumber;
use DB;
use App\DataTables\PeminjamanDataTable;

class PeminjamanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   
    public function index(PeminjamanDataTable $dataTable)
    {
       return $dataTable->render('peminjaman.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(SubKelompokDataTable $dataTable)
    {
        return $dataTable->render('peminjaman.create');
    }

    public function getSubKelompok(Request $request)
    {
        $id=$request->input('id');
        $subkelompok=SubKelompok::find($id);
        $this->addCart($subkelompok);
    }

    public function addCart($data)
    {
        Cart::add($data->id_sub,$data->nama_sub,1,0);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $pinjam = new Peminjaman;
        $carts=Cart::content();
        $id=$request->input('id');
        $rowid=$request->input('rowid');
        $jumlah=$request->input('jumlah');
        $barang=DB::table('subKelompok');
        $kodePinjam=$pinjam->getKodePeminjaman();

        $stok=DB::table('subKelompok')->whereIn('id_sub',$id)->lists('stock');
        $nama=DB::table('subKelompok')->whereIn('id_sub',$id)->lists('nama_sub','id_sub');
            foreach($jumlah as $key => $val)
              {           
                $jumlah['jumlah'.$key]=$jumlah[$key];
                $idx=array_search($key, $stok);
                $stok['stok'.$idx]=$stok[$idx];          
                $rules['jumlah'.$key] = 'required|numeric|max:'.$stok[$idx];
                $messages['jumlah'.$key.'.max'] = 'jumlah pinjam barang "'.$nama[$key].'" melebihi stok yang ada.';
                $messages['jumlah'.$key.'.required'] = 'jumlah pinjam barang "'.$nama[$key].'" harus di isi.';
             }
  
        $validator = Validator::make($jumlah,$rules,$messages);
       if ($validator->fails())
        {
           return redirect()->back()->withErrors($validator)->withInput();
        }
        else{
           

                 Peminjaman::create([
                        'id'=>$kodePinjam,
                        'user_id'=>Auth::user()->userId,
                        'is_return'=>'false'
                    ]);

                 foreach($carts as $cart){
                    DB::table('detail_peminjaman')->insert(
                            ['id_sub'=>$cart->id,
                             'jumlah'=>$jumlah[$cart->id],
                             'id_peminjaman'=>$kodePinjam
                            ]
                        );

                    $barangs=DB::table('subKelompok')->where('id_sub','=',$cart->id)->get();       
                    foreach($barangs as $brg){
                        DB::table('subKelompok')->where('id_sub','=',$cart->id)->update(['stock'=>(($brg->stock)-($jumlah[$cart->id]))]);                  
                        }    
                    }
            Cart::destroy();
           
                } 
            return redirect()->back();    
            }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $peminjaman=Peminjaman::with('lokasi','detailPeminjaman','detailPeminjaman.subKelompok')->first();
        return View('peminjaman.view',compact('peminjaman'));
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