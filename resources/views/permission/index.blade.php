@extends('layout.master')

@section('content')

<section class="content">
<div class="box box-primary">

<div class="box-header"><h1>Permission</h1></div> 	
<div class="box-body">
	{!! $dataTable->table() !!}      
</div>
</div>
</section>
   
<script src="{{asset('/lib/angular/angular.min.js')}}" type="text/javascript"></script>   
@stop

@push('scripts')
	{!! $dataTable->scripts() !!}
@endpush
