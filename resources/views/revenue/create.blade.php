@extends('layouts.revenue')

@section('content')
<div class="w3-container">
    <div class="w3-row">
        <div class="w3-col s12 m12 l12 w3-padding">
            <h1 class="title">Add Data</h1>
        </div>
        <div class="w3-col s12 m6 l3">           

            <form method="post" action="{{ route('revenue.store') }}@yield('edtID')">
                {{ csrf_field() }}
                @section('editMethod')
                    @show
            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
            <input id="date" type="hidden" name="entry_for" step="" value="@yield('entry_for')">
                <div class="w3-card w3-margin w3-white w3-padding-16">
                    <div class="w3-container">
                        <!-- <label>Desktop Spend</label> -->
                        <input class="w3-input w3-border-0 w3-light-grey" type="number" step="0.01" name="desktop_spend" value="@yield('desktop_spend')" placeholder="Desktop Spend">
                        <!-- <label>Desktop Modifier</label> -->
                        <input class="w3-input w3-border-0 w3-light-grey w3-margin-top" type="number" step="0.01" name="desktop_mod" value="@yield('desktop_mod')" placeholder="Desktop Modifier">
                    </div>
                </div>
                <div class="w3-card w3-margin w3-white w3-padding-16">
                    <div class="w3-container">
                        <!-- <label>Mobile Spend</label> -->
                        <input class="w3-input w3-border-0 w3-light-grey" type="number" step="0.01" name="mobile_spend" value="@yield('mobile_spend')" placeholder="Mobile Spend">
                        <!-- <label>Mobile Modifier</label> -->
                        <input class="w3-input w3-border-0 w3-light-grey w3-margin-top" type="number" step="0.01" name="mobile_mod" value="@yield('mobile_mod')" placeholder="Mobile Modifier">
                    </div>
                </div>

                <div class="w3-card w3-margin w3-white w3-padding-16">
                    <div class="w3-container">
                        <button type="submit" class="w3-button w3-light-green w3-text-white w3-block w3-hover-green">SAVE</button> 
                    </div>
                </div>               


            </form>
            @if($errors->any())
            <div class="w3-container">
                <div class="w3-card">
                    <div class="w3-panel w3-red">
                        <ul class="w3-ul w3-red">
                            @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach 
                        </ul>
                    </div>
                </div>
            </div>
            @endif
        </div>

        <div class="w3-col s12 m6 l9">
            <div class="w3-card w3-margin">
                <div id="full-clndr" class="w3-clearfix ">
                    <script id="fuck" type="text/template">
                        <div class="clndr-grid w3-card w3-clearfix w3-margin-bottom">
                        <div class="clndr-controls">
                        <div class="w3-container">
                        <div class="w3-row">
                        <div class="w3-col s2 m1 l1">
                        <div class="clndr-previous-button">
                        <i class="fa fa-angle-left"></i>
                        </div>
                        </div>
                        <div class="w3-col s8 m10 l10">
                        <div class="month"><%= month %> <%= year %></div>
                        </div>
                        <div class="w3-col s2 m1 l1">
                        <div class="clndr-next-button">
                        <i class="fa fa-angle-right"></i>
                        </div>
                        </div>
                        </div>
                        </div>
                        </div>
                        <div class="days-of-the-week">
                        <% _.each(daysOfTheWeek, function (day) { %>
                        <div class="header-day"><%= day %></div>
                        <% }); %>
                        <div class="w3-clearfix"><hr></div>
                        <div class="days">
                        <% _.each(days, function (day) { %>
                        <div class="<%= day.classes %>"><%= day.day %></div>
                        <% }); %>

                        </div>

                        </div>

                        </div>
                    </script>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    $(document).ready(function () {
        
        $('#full-clndr').clndr({
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

        $('title').html('Add revenue data');
    });

</script>


@endsection