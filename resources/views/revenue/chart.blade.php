@extends('layouts.revenue')


@section('content')

<div id="w3-container">
    <div class="w3-row">
        <div class="w3-col s12 m12 l12">
            <div class="w3-card w3-padding w3-margin">
            	<canvas id="canvas"></canvas>
            </div>
        </div>
    </div>
</div>

@endsection


@section('script')
<script src="{{ asset('assets/chart/Chart.bundle.js') }}"></script>
<script>
	

	window.chartColors = {
	red: 'rgb(255, 99, 132)',
	orange: 'rgb(255, 159, 64)',
	yellow: 'rgb(255, 205, 86)',
	green: 'rgb(75, 192, 192)',
	blue: 'rgb(54, 162, 235)',
	purple: 'rgb(153, 102, 255)',
	grey: 'rgb(231,233,237)'
};


</script>

<script>
$(function(){

	var labels = [],data=[];
	
		$.getJSON( "{{ route('test.json') }}", function( json ) {
			
			for (var i = 0; i < json.length; i++) {
		        labels.push(json[i].entry_for);		       
		        data.push(json[i].desktop_spend);		       
		    }
		  
		 });

		var buyerData = {
	      labels : labels,
	      datasets : [
	        {
	          fillColor : "rgba(240, 127, 110, 0.3)",
	          strokeColor : "#f56954",
	          pointColor : "#A62121",
	          pointStrokeColor : "#741F1F",
	          data : data
	        }
	      ]
	    };

    var buyers = document.getElementById('canvas').getContext('2d');
    var myLineChart = new Chart(buyers, {
    type: 'line',
    data: buyerData,
	});
	
});    
    </script>
@endsection