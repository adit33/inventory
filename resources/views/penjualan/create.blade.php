@extends('layout.master')

@section('content')

<section class="content">
<div class="box box-primary">
{!! Form::open(['url' => URL::to('penjualan/store'), 'method' => 'post','class'=>'ui form']) !!}
<div class="box-header"><h1>Tambah Penjualan</h1></div> 	
<div class="box-body">
      <div class="col-md-12">
NO Faktur :{!! $kodeJual !!}<br>
<input type="hidden" name="kodeJual" value="{!! $kodeJual !!}"></input>									
Nama Pelanggan : {!! Form::select('namaplg',App\Pelanggan::lists('namaPelanggan','idPelanggan'),null,array("id"=>"namaplg","class"=>"form-control")) !!} <br>
Alamat : <textarea type="textarea" id="alamatplg" class="form-control"></textarea><br>
No telp: <input type="text" id="telpplg" class="form-control"> <br>
<hr>

      <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal1"><i class="fa fa-plus"></i> Tambah Barang
	  </button>
    <hr>
   
        @if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

        <table class="table table-bordered" id="tabel-cart">
        <thead><tr>
          <th>Kode Barang</th>
          <th>Nama Barang</th>
          <th>Harga Barang</th>
          <th>Jumlah Beli</th>
          <th>Action</th>
    </tr></thead>
    <tfoot>
  <tr>
      <td colspan="4">Total</td>
      <td><p id="total"> {!! Cart::total(); !!}</p></td>
    </tr>
      
</tfoot>
        </table>
        <div id="btnsimpan">
        @if(Cart::total() > 0 )
        <input type="submit" value="Simpan" class="btn btn-primary btn-lg">
        @else
        <input type="submit" value="Simpan" class="btn btn-primary btn-lg disabled">
        @endif
        </div>

        {!! form::close() !!}
		</div>
     </div>
	  </div>
</section>



<div class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Modal title</h4>
      </div>

      <div class="col-md-12">
      <div class="modal-body">

		<table class="table table-bordered" id="tabel-barang">
      	<thead><tr>
      		<th>Kode Barang</th>
      		<th>Nama Barang</th>
      		<th>Jumlah Barang</th>
      		<th>Harga Barang</th>
       		<th>Action</th>
		</tr></thead>
    </table>
    </div>
      </div>

    
      <div class="modal-footer">
   
      </div>
   
    </div>
  </div>
</div>

<script src="{{asset('/lib/jquery/jquery-2.1.4.min.js')}}" type="text/javascript"></script>   
<script src="{{asset('/lib/angular/angular.min.js')}}" type="text/javascript"></script>
<script src="{{asset('/lib/datatables/media/js/jquery.dataTables.min.js')}}" type="text/javascript"></script>      

<script>
function reloadbtn(){
  $('#total').load('create ' +' #total');
  $('#btnsimpan').load('create '+' #btnsimpan');
}


function getId(id) {
  
   $.get('getId?id='+id,function(data){
    $("#myModal1").modal("hide");
      $('#tabel-cart').DataTable().ajax.reload();
       reloadbtn();
   });
}

  var rowid=$('#btnhapus').val();
$(document).ready(function(){
  $("#tabel-cart").on("click",'.btnhapus',function(){
     if (confirm("Anda yakin untuk menghapus data?") === true) {
    var id=$(this).attr('value');
    $.ajax({
      type :"GET",
      data:{"rowid":id},
      url  :"{!! URL::to('penjualan/deletecart/') !!}",
      success:function(){
        $('#tabel-cart').DataTable().ajax.reload();
        
      }
    }).done(function(){
           reloadbtn(); 
      });
  }
  });  
});


$(document).ready(function(){
  $("#namaplg").change(function(){
    var namaplg=$("#namaplg").val();
    $.ajax({
      data:{"namaplg":namaplg},
      url:"{!! URL::to('penjualan/getplg') !!}",
      success:function(data){
        $.each(data,function(index,plg){
          $("#alamatplg").val(plg.alamatPelanggan);

          $("#telpplg").val(plg.telpPelanggan);
        });
       
      }
    });
  });
});

</script>

<script>
$(function() {
    $('#tabel-barang').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{!! route('penjualan.data') !!}',
        columns: [
            { data: 'idBarang', name: 'idBarang' },
            { data: 'namaBarang', name: 'namaBarang' },
            { data: 'jumlahBarang', name: 'jumlahBarang' },
            { data: 'hargaBarang', name: 'hargaBarang' },
            { data: 'action', name: 'action', orderable: false, searchable: false}
        ]
    });
});

</script>

<script>
$(function() {
    $('#tabel-cart').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{!! route('cart.data') !!}',
        columns: [
            { data: 'id', name: 'id' },
            { data: 'name', name: 'name' },
            { data: 'price', name: 'price' },
            { data: 'jumlahbeli', name: 'jumlahbeli', orderable: false, searchable: false},
            { data: 'Action', name: 'Action', orderable: false, searchable: false}
        ]
    });
});
</script>

<script>
   function isNumberKey(evt)
      {
         var charCode = (evt.which) ? evt.which : event.keyCode
         if (charCode > 31 && (charCode < 48 || charCode > 57)){
              $("#errmsg").html("Hanya Angka").show().fadeOut("slow");
               return false;}
               else{
                   return true;        
               }
      }
</script>

@stop

