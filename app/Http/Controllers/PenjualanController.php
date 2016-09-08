<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repository\BarangRepository;
use Datatables;
use App\Barang;
use App\Library\Autonumber;
use Cart;
use URL;
use Validator;
use DB;
use Pelanggan;
use App\Penjualan;
use App\Detailjual;
use Auth;
use App\Library\Dateindo;
use PDF;
class PenjualanController extends Controller
{

    public function __construct(BarangRepository $barang){
        $this->barang=$barang;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $barangs=$this->barang->apiBarang();
        $kodeJual=$this->getKodeJual();
        return View('penjualan.index',compact('barangs','kodeJual'));
        
    }

    public function apiBarang(){
        $barangs=$this->barang->apiBarang();
         return Datatables::of($barangs)
          ->addColumn('action', function ($barangs) {
            if($barangs->jumlahBarang==0){
                return '<button type="button" disabled onclick="getId('."'$barangs->idBarang'".')" id="btn_id" class="btn btn-xs btn-primary" value="'.$barangs->idBarang.'"><i class="glyphicon glyphicon-plus"></i>Add To Cart</button>';
            }
            else{
                return '<button type="button" onclick="getId('."'$barangs->idBarang'".')" id="btn_id" class="btn btn-xs btn-primary" value="'.$barangs->idBarang.'"><i class="glyphicon glyphicon-plus"></i>Add To Cart</button>';    
            }
            })
         ->make(true);
    }

    public function getId(Request $request){
        $id=$request->input('id');
        $barang=Barang::where('idBarang','=',$id)->first();
        $kode=$barang->idBarang;
        $nama=$barang->namaBarang;
        $jumlah='1';
        $harga=$barang->hargaBarang;
        Cart::add($kode,$nama,$jumlah,$harga);
    }

    public function getTotal(){
        return Cart::total();
    }

    public function datacart(){
         $cart=Cart::content();
         $total=Cart::total();
         return Datatables::of($cart)
          ->addColumn('jumlahbeli', function ($cart) {
                return '<div class="col-xs-5"><input type="number" class="form-control" onkeypress="return isNumberKey(event)" min="1"  size="6" step="1" id="jumlah" name="jumlah['.$cart->id.']" value="'.$cart->qty.'"></input></div>&nbsp<span id="errmsg"></span>';
            })
          ->addColumn('Action',function($cart){
                return '<a href="#" id="btnhapus-'.$cart->id.'" class="btnhapus" value="'.$cart->rowid.'">Hapus</a>|<input type="hidden" name="rowid['.$cart->id.']" value="'.$cart->rowid.'"></input><input type="hidden" name="id['.$cart->id.']" value="'.$cart->id.'"></input>';
          })
         ->make(true);
    }

    public function deletecart(Request $request){
        $rowId=$request->input('rowid');
        Cart::remove($rowId);
       // return redirect('penjualan/create');
    }

    public function editcart(Request $request){
        $id=$request->input('id');
        $rowid=$request->input('rowid');
        $jumlah=$request->input('jumlah');
        $barang=DB::table('barang');
        $stok=$barang->whereIn('idBarang',$id)->lists('jumlahBarang');
            foreach($jumlah as $key => $val)
              {           
                $jumlah['jumlah'.$key]=$jumlah[$key];
                $idx=array_search($key, $stok);
                $stok['stok'.$idx]=$stok[$idx];          
                $rules['jumlah'.$key] = 'required|numeric|max:'.$stok[$idx];
                $messages['jumlah'.$key.'.max'] = 'jumlah beli barang dengan "kode '.$key.'" melebihi stok yang ada.';
                $messages['jumlah'.$key.'.required'] = 'jumlah beli barang dengan "kode '.$key.'" harus di isi.';
             }
  
        $validator = Validator::make($jumlah,$rules,$messages);
       if ($validator->fails())
        {
           return redirect('penjualan/create')->withErrors($validator)->withInput();
        }
        else{
            foreach($rowid as $key => $val)
          {
            $jumlah['jumlah'.$key]=$jumlah[$key];
            $rowid['rowid'.$key]=$rowid[$key];          
                Cart::update($rowid[$key],array('qty'=>$jumlah[$key]));
            }
            return redirect('penjualan/create');
        }       
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kodeJual=$this->getKodeJual();
        return View('penjualan.create',compact('kodeJual'));
    }

    public function addToCart(){

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
       
        $carts=Cart::content();
        $id=$request->input('id');
        $rowid=$request->input('rowid');
        $jumlah=$request->input('jumlah');
        $barang=DB::table('barang');
        $stok=$barang->whereIn('idBarang',$id)->lists('jumlahBarang');
            foreach($jumlah as $key => $val)
              {           
                $jumlah['jumlah'.$key]=$jumlah[$key];
                $idx=array_search($key, $stok);
                $stok['stok'.$idx]=$stok[$idx];          
                $rules['jumlah'.$key] = 'required|numeric|max:'.$stok[$idx];
                $messages['jumlah'.$key.'.max'] = 'jumlah beli barang dengan "kode '.$key.'" melebihi stok yang ada.';
                $messages['jumlah'.$key.'.required'] = 'jumlah beli barang dengan "kode '.$key.'" harus di isi.';
             }
  
        $validator = Validator::make($jumlah,$rules,$messages);
       if ($validator->fails())
        {
           return redirect('penjualan/create')->withErrors($validator)->withInput();
        }
        else{
           
                 $jual=new Penjualan;
                 $jual->kodeJual=$request->input('kodeJual');
                 $jual->userId=Auth::user()->userId;
                 $jual->idPelanggan=$request->input('namaplg');
                 $jual->tgl=Dateindo::datenow();
                 $jual->save();

                 foreach($carts as $cart){
                   // foreach ($jumlah as $key => $value)
                    DB::table('detail_jual')->insert(
                            ['idBarang'=>$cart->id,
                             'jumlah'=>$jumlah[$cart->id],
                              
                             'kodeJual'=>$request->input('kodeJual')
                            ]
                        );
                    $barangs=DB::table('barang')->where('idBarang','=',$cart->id)->get();       
                    foreach($barangs as $brg){
                        DB::table('barang')->where('idBarang','=',$cart->id)->update(['jumlahBarang'=>(($brg->jumlahBarang)-($jumlah[$cart->id]))]);                  
                        }    
                    }
            Cart::destroy();
            return redirect('penjualan/create');
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

    public function getBarang(){

    }

    public function getPelanggan(Request $request){
        $nama=$request->input('namaplg');
        $plg=DB::table('pelanggan')->where('idPelanggan','=',$nama)->get();
        return $plg;
    }

    public function getKodeJual(){
        $table="jual";
        $primary="kodeJual";
        $prefix="JUAL-";
        $kodeJual=Autonumber::autonumber($table,$primary,$prefix);
        return $kodeJual;
    }

    public function getKodeBarang(Request $request){
    $id=$request->input('idBarang');
    $barang=Barang::where('idBarang','=',$id)->get();
    return $barang;
    }

    public function laporan(){
        return View('penjualan.laporan');
    }

    public function getlaporan(Request $request){
           $tgl1=$request->input('start');
           $tgl2=$request->input('end');
          // $tabel='jual';      
           $datas['datas']=Penjualan::with('r_pelanggan')->whereBetween('tgl',[$tgl1,$tgl2])->get();
           $datas['tgl1']=$tgl1;
           $datas['tgl2']=$tgl2;
           // $jumlah=DB::select('SELECT detail_jual.kodeJual,detail_jual.idBarang,sum(detail_jual.jumlah * barang.hargaBarang) FROM detail_jual JOIN jual ON detail_jual.kodeJual =jual.kodeJual JOIN barang on detail_jual.idBarang=barang.idBarang where jual.kodeJual="JUAL-111215000003"');
           $pdf = PDF::loadView('penjualan.datalaporan',$datas);
       return $pdf->stream('laporan.pdf',array('Attachment'=>0));
    }

    public function exportpdf(){
        $pdf = PDF::loadView('penjualan.datalaporan');
        return $pdf->stream();
    }

    public function getdatachart(Request $request){
        $tahun=$request->input('tahun');
        $bulan=$request->input('bulan');    
        $nama=[];
        $jumlah=[];
        $barangs=Detailjual::with(['r_jual'=>function($query) use ($tahun,$bulan){
                $query->where(DB::raw('YEAR(tgl)'),'=',$tahun)->whereMonth('tgl','=',$bulan); }])
                 ->get();        
       
        foreach ($barangs as $barang){
            array_push($nama,$barang->r_barang->namaBarang);
            array_push($jumlah,Detailjual::with(['r_jual'=>function($query) use ($tahun,$bulan){
                $query->where(DB::raw('YEAR(tgl)'),'=',$tahun)->whereMonth('tgl','=',$bulan);
            }])->where('idBarang','=',$barang->idBarang)->sum('jumlah'));
        }

        return View('datachart',compact('jumlah','nama'));
    }

    public function chart(){
           
    $thn=date('Y');
    return View('chart',compact('thn'));
    }
}
