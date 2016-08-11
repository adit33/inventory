
                  	<div class="chart">
                   		 <canvas id="canvas" height="260" width="510" style="width: 510px; height: 260px;"></canvas>
                  	</div>
                   
<script>	
	$(document).ready(function(){

		
			var lineChartData = {
			labels : {!! json_encode($nama) !!},
			datasets : [
				{
					label: "My Second dataset",
					fillColor : "rgba(151,187,205,0.2)",
					strokeColor : "rgba(151,187,205,1)",
					pointColor : "rgba(151,187,205,1)",
					pointStrokeColor : "#fff",
					pointHighlightFill : "#fff",
					pointHighlightStroke : "rgba(151,187,205,1)",
					data : {!! json_encode($jumlah) !!}
				}
			]

		}

				var ctx = document.getElementById("canvas").getContext("2d");
				window.myLine = new Chart(ctx).Line(lineChartData, {
				responsive: true
				});

	});
	
		</script>

