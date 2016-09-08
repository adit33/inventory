@extends('layout.master')

@section('content')

<section class="content">
<div class="box box-primary">

<div class="box-header"><h1>Tambah Role</h1></div> 	
<div class="box-body">
      <div class="col-md-9">
			<div class="form-group">
	  
				@if (count($errors) > 0)
			    <div class="alert alert-danger">
			        <ul>
			            @foreach ($errors->all() as $error)
			                <li>{{ $error }}</li>
			            @endforeach
			        </ul>
			    </div>
				@endif

				{!! $dataTable->table() !!}


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


@push('scripts')
	{!! $dataTable->scripts() !!}
@endpush
