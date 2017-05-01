@extends('revenue.create')

@section('edtID', '/'.$revenue->id)
@section('entry_for', $revenue->entry_for)
@section('desktop_spend', $revenue->desktop_spend)
@section('desktop_mod', $revenue->desktop_mod)
@section('mobile_spend', $revenue->mobile_spend)
@section('mobile_mod', $revenue->mobile_mod)

@section('editMethod')

{{ method_field('PUT') }}

@endsection

@section('script')
<script>
    $(document).ready(function () {
        
        var ins_clndr = $('#full-clndr').clndr({
				            template: $('#fuck').html(),
				             clickEvents: {
				                click: function(target) {
				                    var theDate = target.date._i;
				                    $('#date').val(theDate);
				                  console.log(theDate);
				                },
				            }
				        });

        $('#full-clndr .day').on('click', function(){
            $('#full-clndr .day').removeClass('selected');
            $(this).addClass('selected');
        });

        $('title, .title').html('Edit Data of '+moment('{!! $revenue->entry_for !!}').format('MMM-DD-YYYY'))

        var year = moment('{!! $revenue->entry_for !!}').year();
        ins_clndr.setYear(year);
        var month = moment('{!! $revenue->entry_for !!}').month();
        ins_clndr.setMonth(month);
        var selected_date = '.day.calendar-day-{!! $revenue->entry_for !!}';        
        $(selected_date).addClass('selected');

    });

</script>


@endsection