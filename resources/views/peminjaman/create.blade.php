@extends('layout.master')

@section('content')
	<section class="content">
	<div class="box box-primary">
		<div class="box-body">
			<div class="form-group">
				<div class="col-sm-12">
					Peminjam : {!! Form::select('id',App\Lokasi::lists('nama','id'),null,['class'=>'form-control js-example-basic-single','placeholder'=>'']) !!}

					Kelompok :{!! Form::select('id_kelompok',App\Kelompok::lists('nama_kelompok','id_kelompok'),null,['class'=>'form-control js-example-basic-single','placeholder'=>'']) !!} <br>

					Sub Kelompok :{!! Form::select('id_subkelompok',App\SubKelompok::lists('nama_sub','id_sub'),null,['class'=>'form-control js-example-basic-single','placeholder'=>'']) !!} <br>

					Jumlah :{!! Form::text('jumlah',null,['class'=>'form-control']) !!}
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
		  	placeholder: "Pilih Data"
		  });
		});
	</script>
@endpush