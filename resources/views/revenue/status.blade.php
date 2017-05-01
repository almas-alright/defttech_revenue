@extends('layouts.revenue')

@section('style')
<link rel="stylesheet" href="http://cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">
@endsection

@section('content')

<div id="w3-container">
    <div class="w3-row">
        <div class="w3-col s12 m12 l12">
            <div class="w3-card w3-padding w3-margin">
                <h1 class="e-title">{{ $type }} Entry</h1> <a href="{{ route('revenue.create') }}" class="w3-button w3-cyan">Add New</a>
                <hr>

                <div class="w3-padding" style="width:100%;">
                    <canvas id="canvas"></canvas>
                </div>
                <hr>
                <table id="revenues" class="w3-table w3-bordered w3-striped w3-border test w3-hoverable">
                    <thead>
                        <tr class="w3-green ">
                            <th class="col-md-1">#</th>
                            <th class="col-md-1">Day</th>
                            <th class="col-md-1">Date</th>
                            <th class="col-md-1">Desktop Spend</th>
                            <th class="col-md-1">Desktop Modifier</th>
                            <th class="col-md-1">Mobile Spend</th>
                            <th class="col-md-1">Mobile Modifier</th>                   
                            <th class="col-md-1">*</th>                            
                        </tr>
                    </thead>
                </table>
            

                
            </div>

        </div>
        <!-- /.inner -->
    </div>
    <!-- /.outer -->
</div>

@endsection


@section('script')

<script type="text/javascript" src="http://cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="http://cdn.datatables.net/plug-ins/1.10.15/api/sum().js">    
</script>
<script src="{{ asset('assets/chart/Chart.bundle.js') }}"></script>
<script>   
    window.route = '{!! $type !!}';
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
    jQuery.fn.dataTable.Api.register( 'sum()', function ( ) {
            return this.flatten().reduce( function ( a, b ) {
                if ( typeof a === 'string' ) {
                    a = a.replace(/[^\d.-]/g, '') * 1;
                }
                if ( typeof b === 'string' ) {
                    b = b.replace(/[^\d.-]/g, '') * 1;
                }

                return a + b;
            }, 0 );
        } );
</script>
<script type="text/javascript">
var from_date = localStorage.getItem("from_date"); 
var to_date = localStorage.getItem("to_date");
$(document).ready(function() {
   

   console.log('date range = '+from_date+'----'+to_date)
   var tbl = $('#revenues').DataTable({
        "processing": true,
        "serverSide": true,
        "ordering": (window.route == "range"? true:false),
        "bLengthChange": (window.route == "range"? true:false),
        "searching": (window.route == "range"? true:false),
        "paging": (window.route == "range"? true:false),
        "ajax": "{{ url('/') }}/date-b2in/"+from_date+"/"+to_date,
        "lengthMenu": [ 7, 14, 21, 28, 35, 42, 49, 56],
        "columns": [
            {data: 'DT_Row_Index', name: 'DT_Row_Index'},
            {data: 'dayname', name: 'dayname'},
            {data: 'date', name: 'date'},
            {data: 'desktop_spend', name: 'desktop_spend'},
            {data: 'desktop_mod', name: 'desktop_mod'},
            {data: 'mobile_spend', name: 'mobile_spend'},
            {data: 'mobile_mod', name: 'desktop_mod'},
            {data: 'operations', name: 'operations'},
        ],
        "language": {
        "emptyTable": "No data found between: "+moment(from_date).format('MMM-DD-YYYY')+" to "+moment(to_date).format('MMM-DD-YYYY')
        }
        
    });

   $('#revenues').on( 'draw.dt', function (e) {
        e.preventDefault();
                var ds = (tbl.column(3).data().sum()).toFixed(2);
                var dm = (tbl.column(4).data().sum()).toFixed(2);
                var ms = (tbl.column(5).data().sum()).toFixed(2);
                var mm = (tbl.column(6).data().sum()).toFixed(2);
                
        var totalFoot = '<tfoot>'+
        '                <tr class="w3-light-green">'+
        '                    <th class="col-md-1">#</th>'+
        '                    <th class="col-md-1"></th>'+
        '                    <th class="col-md-1"></th>'+
        '                    <th class="col-md-1">D.S Total '+ds+'</th>'+
        '                    <th class="col-md-1">D.M Total '+dm+'</th>'+
        '                    <th class="col-md-1">M.S Total '+ms+'</th>'+
        '                    <th class="col-md-1">M.M Total '+mm+'</th>'+
        '                    <th class="col-md-1">*</th>'+
        '                </tr>'+
        '            </tfoot>';
        $('#revenues tfoot').remove();
        $(this).append(totalFoot);
    });
   
   

   $('#revenues_filter, #revenues_length').addClass('w3-margin-bottom');
});
</script>
<script>

window.onload = function() {

    var labels = [], ds = [], ms = [], dm = [], mm = [];
    
        $.getJSON( "{{ url('/') }}/date-b2in/"+from_date+"/"+to_date, function( json ) {
            
            for (var i = 0; i < json.data.length; i++) {
                labels.push(json.data[i].date);            
                ds.push(json.data[i].desktop_spend);            
                ms.push(json.data[i].mobile_spend);             
                dm.push(json.data[i].desktop_mod);              
                mm.push(json.data[i].mobile_mod);               
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