@extends('layout.master')

@section('content')

<section class="content">
<div class="box box-primary">
{!! Form::open(['url' => route('peminjaman.store'), 'method' => 'post','class'=>'ui form']) !!}
<div class="box-header"><h1>Peminjaman Barang</h1></div>     
<div class="box-body">
      <div class="col-md-12">
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
          <th>Nama Barang</th>
          <th>Jumlah Pinjam</th>
          <th>Action</th>
         
    </tr></thead>
    <tfoot>
 <!--  <tr>
      <td colspan="4">Total</td>
      <td><p id="total"> {!! Cart::total(); !!}</p></td>
    </tr>  -->
</tfoot>
        </table>

      
        <div id="btnsimpan">
        @if(Cart::count() > 0 )
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
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Modal title</h4>
      </div>

      <div class="col-md-12">
      <div class="modal-body">

     	    {!!  $dataTable->table()  !!}

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
  
	$.ajax({
		type:"GET",
		url:"{!! route('get.sub') !!}",
		data:{
			"id":id
		},
		success:function(){
			$("#myModal1").modal("hide");
      		$('#tabel-cart').DataTable().ajax.reload();
       		reloadbtn();
		}
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


</script>

@push('scripts')
{!! $dataTable->scripts() !!}
@endpush
<script>
$(function() {
    $('#tabel-cart').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{!! route('cart.data') !!}',
        columns: [
            { data: 'name', name: 'name' },
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
              // $("#errmsg").html("Hanya Angka").show().fadeOut("slow");
               return false;}
               else{
                   return true;        
               }
      }
</script>

@stop

