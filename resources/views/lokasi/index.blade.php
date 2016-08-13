@extends('layout.master')

@section('content')
<section class="content">
	<div class="box box-primary">
		<div class="box-body">
			<div class="form-group">
				<div class="col-sm-12">
					@include('lokasi._form')
				</div>
			</div>
		</div>
	</div>
</section>
@endsection