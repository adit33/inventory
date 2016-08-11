@extends('layout.master')

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
<body>
<!-- {!! Form::open(['url' => URL::to('getlaporan'), 'method' => 'post','class'=>'ui form']) !!} -->

<div class="box box-info">

Barang Paling Laris tahun {!! $thn !!}

					{!! Form::selectMonth('bulan',null,['class'=>'form-control','id'=>'bulan']) !!}
					{!! Form::selectYear('tahun',2014,$thn,null,['class'=>'form-control','id'=>'tahun']) !!}
                  	<input type="submit" id="btnsimpan" value="Ok">
                  	<!-- {!! form::close() !!} -->
                  	<div class="chart">
                   		 <canvas id="canvas" height="260" width="510" style="width: 510px; height: 260px;"></canvas>
                  	</div>
                </div><!-- /.box-body -->
              </div>
    <!-- {!! Form::close() !!} -->
<style>

</style>
<script src="{{asset('/lib/jquery/jquery-2.1.4.min.js')}}" type="text/javascript"></script>   
<script src="{{asset('/lib/angular/angular.min.js')}}" type="text/javascript"></script>
<script src="{{asset('/lib/datatables/media/js/jquery.dataTables.min.js')}}" type="text/javascript"></script>
<script src="{{asset('/lib/chart.js')}}" type="text/javascript"></script>         
<script src="{{asset('/lib/datepicker/dist/js/bootstrap-datepicker.js')}}" type="text/javascript"></script>            
            
<script>	
	$(document).ready(function(){

			
		$("#btnsimpan").click(function(){
			var tahun=$('#tahun :selected').val();
			var bulan=$('#bulan :selected').val();

			$.ajax({
			type:"GET",
			url :"{!! URL::to('getdatachart') !!}",
			data:{
				"bulan":bulan,
				"tahun":tahun,
				"_token":"{{ csrf_token() }}"},
			success:function(data){
				$("#canvas").html(data);
				}
			});
		});
	});
	
		</script>

		</body>

@stop

