@extends('layout.master')

@section('content')

<section class="content">
<div class="box box-primary">

<div class="box-header">Data Barang</div> 	
<!-- Button trigger modal -->
<div class="box-body pad table-responsive">
<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus"></i>
</button>
</div>
</div>

</div>
</section>
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Modal title</h4>
      </div>

      <div class="col-md-9">
      <div class="modal-body">
        
				{!! Form::open(['route'=>'barang.store','method'=>'post','class'=>'form-horizontal']) !!}
			 		{!! csrf_field() !!}
			<div class="form-group">
				<div class="row"> 
					<div class="col-xs-5">
					  Kode Barang :{!! Form::text('idBarang',$kodeBarang,array('class'=>'form-control','disabled')) !!}
					</div>
				</div>	  
				  Nama Barang :{!! Form::text('namaBarang',null,array('class'=>'form-control')) !!}
				  Jumlah Barang :{!! Form::text('jumlahBarang',null,array('class'=>'form-control')) !!}
				  Harga Barang :
			  <div class="input-group">
				<span class="input-group-addon">Rp</span>
			  		{!! Form::text('hargaBarang',null,array('class'=>'form-control')) !!}
			  </div>
			  <br>
				<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
       			 <button type="button" class="btn btn-primary">Simpan</button>
			</div>
		{!! Form::close() !!}
		</div>
      </div>

    
      <div class="modal-footer">
   
      </div>
   
    </div>
  </div>
</div>


@stop

