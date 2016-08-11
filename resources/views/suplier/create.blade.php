@extends('layout.master')

@section('content')

<section class="content">
<div class="box box-primary">

<div class="box-header"><h1>Tambah Suplier</h1></div> 	
<div class="box-body">
      <div class="col-md-9">
				{!! Form::open(['route'=>'user.store','method'=>'post','class'=>'form-horizontal']) !!}
			 		{!! csrf_field() !!}
			<div class="form-group">
				<div class="row"> 
					
				</div>	  
				  Nama Suplier :{!! Form::text('namaSuplier',null,array('class'=>'form-control')) !!}
				  Alamat Suplier :{!! Form::textarea('alamatSuplier',null,array('class'=>'form-control')) !!}
				  Telpon Suplier :
			  <div class="input-group col-md-3">
			  		{!! Form::text('telpSuplier',null,array('class'=>'form-control')) !!}
			  </div>
			  <br>
				<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
       			 <button type="submit" class="btn btn-primary">Simpan</button>
			</div>
		{!! Form::close() !!}
		</div>
     </div>
	  </div>
</section>
   
<script src="{{asset('/lib/angular/angular.min.js')}}" type="text/javascript"></script>   
@stop

