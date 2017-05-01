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
	red_deff: 'rgb(255, 99, 132)',
	orange: 'rgb(255, 159, 64)',
	orange_deff: 'rgba(255, 159, 64, 0.5)',
	yellow: 'rgb(255, 205, 86)',
	green: 'rgb(75, 192, 192)',
	blue: 'rgb(54, 162, 235)',
	blue_deff: 'rgb(54, 162, 235, 0.5)',
	purple: 'rgb(153, 102, 255)',
	grey: 'rgb(231,233,237)'
};


</script>

<script>

window.onload = function() {

	var labels = [], ds = [], ms = [], dm = [], mm = [];
	
		$.getJSON( "{{ route('test.json') }}", function( json ) {
			
			for (var i = 0; i < json.length; i++) {
		        labels.push(json[i].entry_for);		       
		        ds.push(json[i].desktop_spend);		       
		        ms.push(json[i].mobile_spend);		       
		        dm.push(json[i].desktop_mod);		       
		        mm.push(json[i].mobile_mod);		       
		    }
		  
		 }).done(function(){ 

		var buyerData = {
	      labels : labels,
	      datasets : [
	        {
		    	label: "Desktop Spend",
		    	fill: false,
		        backgroundColor: window.chartColors.green,
                borderColor: window.chartColors.green,
                borderWidth: 1,
                // lineTension: 0.2,
		        data : ds
	        },{
		    	label: "Desktop Mod",
		    	fill: false,
		        backgroundColor: window.chartColors.blue,
                borderColor: window.chartColors.blue,
                borderWidth: 1,
                // lineTension: 0.2,
		        data : dm
	        },{
		    	label: "Mobile Spend",
		    	fill: false,
		        backgroundColor: window.chartColors.red,
                borderColor: window.chartColors.red,
                borderWidth: 1,
                // lineTension: 0.2,
		        data : ms
	        },{
		    	label: "Mobile Spend",
		    	fill: false,
		        backgroundColor: window.chartColors.orange,
                borderColor: window.chartColors.orange,
                borderWidth: 1,
                // lineTension: 0.2,
		        data : mm
	        }
	      ]
	    };

	var buyers = document.getElementById('canvas').getContext('2d');
    var myLineChart = new Chart(buyers, {
    type: 'line',
    data: buyerData,
	});

	 });
}
    </script>
@endsection