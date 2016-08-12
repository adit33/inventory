@extends('layout.master')

@section('content')

<section class="content">
	<div class="box box-primary">
	<div class="box-body">
      <a type="button" href="{{ route('user.create') }}" class="btn btn-primary btn-sm" data-toggle="modal"><i class="fa fa-plus"></i> Tambah User
	  </a>
	  <hr>
	  <div class="col-sm-12">
		{!! $dataTable->table() !!}
		</div>
	</div>
	</div>
</section>

<!--  -->

@endsection

@push('scripts')  
{!! $dataTable->scripts() !!}
@endpush

