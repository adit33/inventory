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
use App\DetailPeminjaman;
use PDF;

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

    public function returnSub($id)
    {
        $peminjaman=Peminjaman::find($id);
        $peminjaman->is_return='true';
        $peminjaman->save();
        $pnjs=Peminjaman::with('detailPeminjaman')->where('id','=','PNJ-250816000001')->get();
  
    foreach($pnjs as $pnj){
        foreach ($pnj->detailPeminjaman as $sub) {
            DB::table('subKelompok')->where('id_sub','=',$sub->id_sub)->increment('stock',$sub->jumlah);                  
        }
    }

     return redirect()->back();   

    }

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
                        'is_return'=>'false',
                        'is_approve'=>'false',
                        'id_lokasi'=>Auth::user()->id_lokasi
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

    public function approve($id)
    {
        $peminjaman=Peminjaman::find($id);
        $peminjaman->is_approve='true';
        $peminjaman->save();
        // Peminjaman::update(['is_approve'=>'true'])
        // ->where('id','=',$id);

        return redirect()->back();

    }

    public function getlaporan(Request $request){
           $tgl1=$request->input('start');
           $tgl2=$request->input('end');
          // $tabel='jual';      
           $datas['datas']=Peminjaman::with('lokasi','detailPeminjaman.subKelompok')->whereBetween('created_at',[$tgl1,$tgl2])->get();
           $datas['tgl1']=$tgl1;
           $datas['tgl2']=$tgl2;
           $pdf = PDF::loadView('penjualan.datalaporan',$datas);
       return $pdf->download('laporan.pdf');
    }

    public function exportpdf(){
        $pdf = PDF::loadView('penjualan.datalaporan');
        return $pdf->download();
    }

    public function getdatachart(Request $request){
        $tahun=$request->input('tahun');
        $bulan=$request->input('bulan');    
        $nama=[];
        $jumlah=[];
        $barangs=DetailPeminjaman::with(['peminjaman'=>function($query) use ($tahun,$bulan){
                $query->where(DB::raw('YEAR(created_at)'),'=',$tahun)->whereMonth('created_at','=',$bulan); }])
                 ->get();        
       
        foreach ($barangs as $barang){
            array_push($nama,$barang->subKelompok->nama_sub);
            array_push($jumlah,DetailPeminjaman::with(['peminjaman'=>function($query) use ($tahun,$bulan){
                $query->where(DB::raw('YEAR(created_at)'),'=',$tahun)->whereMonth('created_at','=',$bulan);
            }])->where('id_peminjaman','=',$barang->id_peminjaman)->sum('jumlah'));
        }        
        return View('datachart',compact('jumlah','nama'));
    }
}