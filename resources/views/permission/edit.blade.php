@extends('layout.master')

@section('content')

<section class="content">
<div class="box box-primary">

<div class="box-header"><h1>Edit Permission {!! $permission->nama_permission !!}</h1></div> 	
<div class="box-body">
      <div class="col-md-9">
				{!! Form::model($permission,['method'=>'post','url'=>route('permission.create'),'class'=>'form-horizontal']) !!}
			 		{!! csrf_field() !!}
			<div class="form-group">
				<div class="row"> 
					
				</div>	  
				@if (count($errors) > 0)
    
@endif

Nama Permission: {!! Form::text('nama_permission',null,['class'=>'form-control']) !!}<br/>

			  <br>
			    <button type="submit" class="btn btn-primary">Simpan</button>
			</div>
		{!! Form::close() !!}
		</div>
     </div>
	  </div>
</section>
   
<script src="{{asset('/lib/angular/angular.min.js')}}" type="text/javascript"></script>   
@stop

