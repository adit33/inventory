@extends('layout.master')

@section('content')
	<section class="content">
	<div class="box box-primary">
		<div class="box-body">
			<div class="form-group">
				<div class="col-sm-12">
					{!! Form::open(['url'=>route('cart.add'),'method'=>'POST']) !!}
					<div>
					Kelompok :{!! Form::select('id_kelompok',App\Kelompok::lists('nama_kelompok','id_kelompok'),null,['class'=>'form-control js-example-basic-single','id'=>'id_kelompok','placeholder'=>'Pilih']) !!} </div>
				
					<div>
						Sub Kelompok :{!! Form::select('id_sub',[],null,['id'=>'id_sub','class'=>'form-control js-example-basic-single','placeholder'=>'Pilih']) !!} 
					</div>
					

					<div id="stok"
					>
	
					</div>

					<div>

					Jumlah :{!! Form::text('jumlah',null,['class'=>'form-control']) !!}
					</div>
			
<hr>
				<input type="submit" class='btn btn-info' value="Simpan"></input>
	{!! Form::close() !!}
				</div>

				<div class="col-sm-12">
					@if(Session::get('barang'))

						<table class="table table-striped">
							<thead>
							<tr>
								<th>Nama</th>
								<th>Jumlah</th>
							</tr>
							</thead>
							<tbody>
								<tr>
									@foreach(Session::get('barang') as $barang)
										<td>{!! $barang['id_sub'] !!}</td>
										<td>{!! $barang['jumlah'] !!}</td>
									@endforeach
								</tr>
							</tbody>
						</table>

					@endif
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

		$("#append").click( function() {
        $(".inc").append("<div class='controls'><input type='text'><a href='#' class='remove_this btn btn-danger'>remove</a><br><br></div>");
        return false;
    	});
    
		$(document).on('click','a.remove_this',function() {
		    $(this).parent().remove();
		    return false;
		});
	</script>
@endpush