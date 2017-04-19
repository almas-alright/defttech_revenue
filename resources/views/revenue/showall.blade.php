@extends('layouts.revenue')

@section('style')
<link rel="stylesheet" href="http://cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">
@endsection

@section('content')

<div id="w3-container">
    <div class="w3-row">
        <div class="w3-col s12 m12 l12">
            <div class="w3-card w3-padding w3-margin">
                <h1>All Entry</h1> <a href="{{ route('revenue.create') }}" class="w3-button w3-cyan">Add New</a>
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
<script type="text/javascript">
$(document).ready(function() {
   $('#revenues').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": "{{ route('revenue-dttbl.showall') }}",
        "columns": [
            {data: 'ser', name: 'ser'},
            {data: 'dayname', name: 'dayname'},
            {data: 'date', name: 'date'},
            {data: 'desktop_spend', name: 'desktop_spend'},
            {data: 'desktop_mod', name: 'desktop_mod'},
            {data: 'mobile_spend', name: 'mobile_spend'},
            {data: 'mobile_mod', name: 'desktop_mod'},
        ]
    });

   $('#revenues_filter, #revenues_length').addClass('w3-margin-bottom');
});
</script>
@endsection