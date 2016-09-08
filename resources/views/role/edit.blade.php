@extends('layout.master')

@section('content')

<section class="content">
<div class="box box-primary">

<div class="box-header"><h1>Tambah Role</h1></div> 	
<div class="box-body">
      <div class="col-md-9">
				{!! Form::model($role,['method'=>'PUT','url'=>route('role.update',['role'=>$role->roleId]),'class'=>'form-horizontal']) !!}
			 		{!! csrf_field() !!}
			<div class="form-group">
				<div class="row"> 
					
				</div>	  
				@if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
Nama Role: {!! Form::text('namaRole',null,['class'=>'form-control']) !!}<br/>
	@foreach($permissions as $permission)
	<?php $checked = in_array($permission->id, $permission_role->lists('id')->toArray()); ?>
		<!-- <input type="checkbox" name="namaPermission[]" value="{!! $permission->id !!}">{!! $permission->namaPermission !!}<br/> -->
		{!! Form::checkbox('namaPermissions[]',$permission->id,$checked) !!}{!! $permission->namaPermission; !!}<br>
		
	@endforeach

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

