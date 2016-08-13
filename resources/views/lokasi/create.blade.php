@extends('layout.master')

@section('content')
{!! Form::open(['url'=>route('lokasi.store')]) !!}
<section class="content">
	<div class="box box-primary">
		<div class="box-body">
			<div class="form-group">
				<div class="col-sm-12">
					@include('lokasi._form')
					<br>
					{!! Form::submit('Simpan',['class'=>'btn btn-info']) !!}
				</div>
			</div>
		</div>
	</div>
</section>


{!! Form::close() !!}
@endsection