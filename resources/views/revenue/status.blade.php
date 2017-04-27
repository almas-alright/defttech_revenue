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
<script type="text/javascript" src="http://cdn.datatables.net/plug-ins/1.10.15/api/sum().js"></script>
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
$(document).ready(function() {
   var from_date = localStorage.getItem("from_date"); 
   var to_date = localStorage.getItem("to_date");

   console.log('date range = '+from_date+'----'+to_date)
   var tbl = $('#revenues').DataTable({
        "processing": true,
        "serverSide": true,
        "ordering": false,
        "bLengthChange": false,
        "paging": false,
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
@endsection