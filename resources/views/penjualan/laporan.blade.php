@extends('layout.master')

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
<body>
<!-- {!! Form::open(['url' => URL::to('getlaporan'), 'method' => 'post','class'=>'ui form']) !!} -->
<div class="box box-info">
                <div class="box-header with-border">
                  <h3 class="box-title">Laporan Penjualan</h3>
                  <div class="box-tools pull-right">
                 
                  </div>
                </div>
                <div class="box-body">
                <input type="hidden" name="_token" value="{!! csrf_token() !!}">
               <!-- {!! Form::open(['url' => URL::to('getlaporan'), 'method' => 'post','class'=>'ui form']) !!} -->
               		<div class="input-daterange input-group" id="datepicker">
					    <input type="text" class="input-sm form-control" id="start" name="start" />
					    	<span class="input-group-addon">Sampai</span>
					    <input type="text" class="input-sm form-control" id="end" name="end" />
					</div>

					<select class="form-control" name="jenisLaporan">
						<option value="penjualan">Penjualan</option>
						<option value="pembelian">Pembelian</option>
					</select>
					
					<center><img src="{{asset('/lib/img/loading.gif')}}"  id="loading"></img></center>
					<div id="data"></div>

                  	<input type="submit" id="btnsimpan" value="Ok">
                  	<!-- {!! form::close() !!} -->
                  	<!-- <div class="chart">
                   		 <canvas id="canvas" height="260" width="510" style="width: 510px; height: 260px;"></canvas>
                  	</div> -->
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
$("#loading").hide();
	$('#datepicker').datepicker({
		format: 'yyyy-mm-dd'
	});



	$.ajaxSetup(
	{
	    headers:
	    {
	        'X-CSRF-Token': $('input[name="_token"]').val()
	    }
	});

	
 
	$(document).ready(function(){
	  $("#btnsimpan").click(function(){
	  	$("#data").html("");
	  	var $iframe = $('#iframe');
	    var start=$("#start").val();
	    var end=$("#end").val();
	    $.ajax({
	      type:"GET",	
	      data:{"start":start,
	      		"end":end,
	      		"_token":"{{ csrf_token() }}"
	  			},
	      url:"{!! URL::to('getlaporan') !!}",
	      beforeSend:function(){
	      	$('#loading').show();
	  	  },
	      success:function(data){

    		$("#loading").hide();
	      	$("#data").append("<iframe src="+this.url+" height='100%' width='100%'></iframe>");
// 	      	$iframe.ready(function() {
//     $iframe.contents().find("body").html(data);
// });
	      }
	    });
	  });
	});

		</script>

<script>
	var nowTemp = new Date();
	var now = new Date(nowTemp.getFullYear(), nowTemp.getMonth(), nowTemp.getDate(), 0, 0, 0, 0);
	 
	var checkin = $('#dpd1').datepicker({
	  onRender: function(date) {
	    return date.valueOf() < now.valueOf() ? 'disabled' : '';
	  }
	}).on('changeDate', function(ev) {
	  if (ev.date.valueOf() > checkout.date.valueOf()) {
	    var newDate = new Date(ev.date)
	    newDate.setDate(newDate.getDate() + 1);
	    checkout.setValue(newDate);
	  }
	  checkin.hide();
	  $('#dpd2')[0].focus();
	}).data('datepicker');
	var checkout = $('#dpd2').datepicker({
	  onRender: function(date) {
	    return date.valueOf() <= checkin.date.valueOf() ? 'disabled' : '';
	  }
	}).on('changeDate', function(ev) {
	  checkout.hide();
	}).data('datepicker');

</script>

		</body>

@stop

