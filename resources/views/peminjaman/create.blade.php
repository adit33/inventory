@extends('layout.master')

@section('content')
	<section class="content">
	<div class="box box-primary">
		<div class="box-body">
			<div class="form-group">
				<div class="col-sm-12">
					
					<div class="col-sm-6">
					Kelompok :{!! Form::select('id_kelompok',App\Kelompok::lists('nama_kelompok','id_kelompok'),null,['class'=>'form-control js-example-basic-single','id'=>'id_kelompok','placeholder'=>'Pilih']) !!} <br>
					</div>

					<div class="col-sm-4">
					Sub Kelompok :{!! Form::select('id_sub',[],null,['id'=>'id_sub','class'=>'form-control js-example-basic-single','placeholder'=>'Pilih']) !!} <br>
					</div>

					<div id="stok" class="col-sm-2">
	
					</div>

					<div class="col-sm-6">
					Peminjam : {!! Form::select('id',App\Lokasi::lists('nama','id'),null,['class'=>'form-control js-example-basic-single','placeholder'=>'']) !!}
					</div>
					
					<div class="col-sm-2">
					Jumlah :{!! Form::text('jumlah',null,['class'=>'form-control']) !!}
					</div>

				</div>
			</div>
		</div>
	</div>
</section>
@endsection

@push('scripts')
	<script type="text/javascript">
		$(document).ready(function() {
		  $(".js-example-basic-single").select2({
		  	placeholder:"pilih",
		  	allowClear: true
		  });
		});

		$("#id_kelompok").change(function(){
			var id_kelompok=$("#id_kelompok").val();
			$.ajax({
				type:"GET",
				url:"{!! route('subkelompok.getid') !!}",
				data:{
					"id_kelompok":id_kelompok,
				},
				success:function(data){
					 $('#id_sub').empty();
					 $('#id_sub').append('<option value=""></option>');
					 $.each(data,function(index,val){
					 $('#id_sub').append('<option value="'+val.id_sub +'">'+ val.nama_sub +'</option>');
					})
				}
			})
		});

		$("#id_sub").change(function(){
			var id_sub=$("#id_sub").val();
			$.ajax({
				type:"GET",
				url:"{!! route('subkelompok.getdata') !!}",
				data:{
					"id_sub":id_sub
				},
				success:function(data){
					$("#stok").html('Stok :<input disabled="disabled" type="text" class="form-control" value="'+data.stock+'">');
				}
			})
		});


	</script>
@endpush