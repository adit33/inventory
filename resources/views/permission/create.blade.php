@extends('layout.master')

@section('content')

<section class="content">
<div class="box box-primary">

<div class="box-header"><h1>Tambah Role</h1></div> 	
<div class="box-body">
      <div class="col-md-9">
				{!! Form::open(['method'=>'post','class'=>'form-horizontal']) !!}
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

Nama Role: {!! Form::text('role',null,['class'=>'form-control']) !!}<br/>

<?php $prm=App\Permission::all(); ?>
	@foreach($prm as $pr)
		<input type="checkbox" name="permission[]" value="{!! $pr->namaPermission !!}">{!! $pr->namaPermission !!}<br/>
	@endforeach

	<!-- <table class="table table-bordered">
		<thead>
			<tr>
				<th>Nama</th>
				<th colspan="4" align="center"><center/> Permission</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<th>User</th>
				<td><input type="checkbox" name="akses[]" value="user.create">create</td>
				<td><input type="checkbox" name="akses[]" value="user.update">update</td>
				<td><input type="checkbox" name="akses[]" value="user.delete">delete</td>
				<td><input type="checkbox" name="akses[]" value="user.view">view</td>
			</tr>
			<tr>
				<td>Pelanggan</td>
				<td><input type="checkbox" name="akses[]">create</td>
				<td><input type="checkbox" name="akses[]">update</td>
				<td><input type="checkbox" name="akses[]">delete</td>
				<td><input type="checkbox" name="akses[]">view</td>
			</tr>
			<tr>
				<td>Suplier</td>
				<td><input type="checkbox" name="akses[]">create</td>
				<td><input type="checkbox" name="akses[]">update</td>
				<td><input type="checkbox" name="akses[]">delete</td>
				<td><input type="checkbox" name="akses[]">view</td>
			</tr>
			<tr>
				<th>Barang</th>
				<td><input type="checkbox" name="akses[]">create</td>
				<td><input type="checkbox" name="akses[]">update</td>
				<td><input type="checkbox" name="akses[]">delete</td>
				<td><input type="checkbox" name="akses[]">view</td>
			</tr>
			<tr>
				<td>Permission</td>
				<td><input type="checkbox" name="akses[]">create</td>
				<td><input type="checkbox" name="akses[]">update</td>
				<td><input type="checkbox" name="akses[]">delete</td>
				<td><input type="checkbox" name="akses[]">view</td>
			</tr>
			<tr>
				<td>Penjualan</td>
				<td><input type="checkbox" name="akses[]">create</td>
				<td></td>
				<td><input type="checkbox" name="akses[]">delete</td>
				<td><input type="checkbox" name="akses[]">view</td>
			</tr>
			<tr>
				<td>Pembelian</td>
				<td><input type="checkbox" name="akses[]">create</td>
				<td></td>
				<td><input type="checkbox" name="akses[]">delete</td>
				<td><input type="checkbox" name="akses[]">view</td>
			</tr>
			<tr>
				<th>Laporan</th>
				<td></td>
				<td></td>
				<td></td>
				<td><input type="checkbox" name="akses[]" value="laporan.view">view</td>
			</tr>
			<tr>
				<th>Grafik</th>
				<td></td>
				<td></td>
				<td></td>
				<td><input type="checkbox" name="akses[]" value="chart.view">view</td>
			</tr>
		</tbody>
	</table> -->
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

