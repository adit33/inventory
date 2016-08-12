@extends('layout.master')

@section('content')

<section class="content">
	<div class="box box-primary">
      <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-tambah"><i class="fa fa-plus"></i> Tambah User
	  </button>
		{!! $dataTable->table() !!}
	</div>

<!-- modal tambah -->
<div class="modal fade" id="modal-tambah" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Tambah User</h4>
      </div>

      <div class="col-md-12">
      	<div class="modal-body">
		{!! Form::open(['id'=>'form-tambah','class'=>'form-horizontal','files'=>true,'enctype'=>'multipart/form-data']) !!}
		{!! csrf_field() !!}
		<div class="box-body">
      <div class="col-md-9">
			<div class="form-group">
				<div class="row"> 
					
				</div>	  
			
    <div class="alert alert-danger">
        <div id="error"></div>
    </div>

				@include('user._form')
			 	
				<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
       			 <button type="button" id="btn-tambah" class="btn btn-primary">Simpan</button>
			</div>
		
		</div>
</div>
    	{!! Form::close() !!}
    	</div>
      </div>

    
      <div class="modal-footer">
   
      </div>
   
    </div>
  </div>
</div>


<!--  -->

<!-- modal edit -->
<div class="modal fade" id="modal-edit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Tambah User</h4>
      </div>

      <div class="col-md-12">
      	<div class="modal-body">
		
		
<form name="form_edit" id="form_edit">

		{!! csrf_field() !!}
<div class="box-body">
      <div class="col-md-9">
			<div class="form-group">
				<div class="row"> 
					
				</div>	  
			
    <div class="alert alert-danger">
        <div id="error"></div>
    </div>
			
				@include('user._form')
				<input type="hidden" id="Id" name="Id">
				<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
       			 <button type="button" id="btn-edit" class="btn btn-primary">Simpan</button>
			</div>
		
		</div>
</div>
    		</form>
    	</div>
      </div>

    
      <div class="modal-footer">
   
      </div>
   
    </div>
  </div>
</div>
<!--  -->

@endsection

@push('scripts')  
{!! $dataTable->scripts() !!}
@endpush

