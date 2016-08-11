@extends('layout.master')

@section('content')

<section class="content">
	<div class="box box-primary">
      <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#modal-tambah"><i class="fa fa-plus"></i> Tambah Barang
	  </button>
		<table class="table table-bordered" id="table-user">
			<thead>
				<tr>
					<th>User Id</th>
					<th>Nama</th>
					<th>Action</th>
				</tr>
			</thead>
	@foreach($users as $user)
			<tbody>
				<tr>
					<td>{!! $user->userId !!}</td>
					<td>{!! $user->namaUser !!}</td>
					<td><input type="button" id="edit" value="edit" onclick="editUser('{!! $user->userId !!}')" ></td>
				</tr>
			</tbody>
	@endforeach
		</table>	
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

</section>
<script src="{{asset('/lib/jquery/jquery-2.1.4.min.js')}}" type="text/javascript"></script>   
<script src="{{asset('/lib/angular/angular.min.js')}}" type="text/javascript"></script>   
<script src="{{asset('/lib/jquery.form.js')}}"></script>
<script>
function editUser(userId){
	$.ajax({
		type:"GET",
		url:"edit/"+userId,
		data:{"_token":"{{ csrf_token() }}"},	
		success:function(data){
			$("#modal-edit").modal('show');
			document.form_edit.Id.value=data.user.userId;
			document.form_edit.userId.value=data.user.userId;
			document.form_edit.namaUser.value=data.user.namaUser;
			// document.form_edit.foto.value=data.user.foto;
			document.form_edit.namaRole.value=data.users.namaRole;
			}

		})
	}

	$(document).ready(function(){

		$("#btn-tambah").click(function(){
        	var file_data = $('#foto')[0].files[0];
        	var form_data = new FormData();
        	form_data.append('foto', file_data);//foto nama yg akan d kirim ke server
		    $.each($('#form-tambah').serializeArray(), function(a, b){
		    form_data.append(b.name, b.value);		     
		    });
			$.ajax({
				type:"POST",
				url:"{!! URL::to('user/store') !!}",
				data:form_data,
				contentType: false, 
		        processData: false,
		        dataType: 'JSON',
				success:function(data){
					if(data.errors){
						 $.each(data.errors, function(index, error){   
						 	$("#error").append("<li>"+error+"</li>")
						 })
					}
				}
			})
		})

		$("#btn-edit").click(function(e){
			e.preventDefault();	
			var id=$('#Id').val();	
        	var file_data = $('#form_edit input[id="foto"]')[0].files[0];
        	var form_data = new FormData();
        	var csrf_token="{!! csrf_token() !!}"
        	form_data.append('foto', file_data);//foto nama yg akan d kirim ke server
		    $.each($('#form_edit').serializeArray(), function(a, b){
		    form_data.append(b.name, b.value);		     
		    });

			console.log(id)
			$.ajax({
				type:"POST",
				url:"update/"+id,
				data:form_data,
				contentType: false, 
		        processData: false,
		        dataType: 'JSON',
				success:function(data){ 
					if(data.errors){
						 $.each(data.errors, function(index, error){   
						 	$('#form_edit div[id="error"]').append("<li>"+error+"</li>")
						 })
					}
				}
			})
		})


	})
</script>

@stop

