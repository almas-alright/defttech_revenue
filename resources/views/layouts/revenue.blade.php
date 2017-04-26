
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Calender App</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="{{ asset('css/w3.css') }}">
        <link rel="stylesheet" href="{{ asset('vendors/jquery-ui/jquery-ui.css') }}">
        <link rel="stylesheet" href="{{ asset('css/clndr.css') }}">
        <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
        @yield('style')
    </head>
    <body>
        <div class="w3-sidebar w3-bar-block w3-card-2 w3-animate-left" style="display:none" id="mySidebar">
            <button class="w3-bar-item w3-button w3-large"
                    onclick="w3_close()">Close &times;</button>
            <a href="{{ route('revenue.index') }}" class="w3-bar-item w3-button">Show All</a>
            <a href="{{ route('revenue.create') }}" class="w3-bar-item w3-button">Add New</a>

            <div class="w3-card w3-margin">
            <header class="w3-container w3-green">
                <h5>Show Wickly Status</h5>
            </header>
                <div id="mini-clndr" class="w3-clearfix ">
                     <script id="mini-clndr-template" type="text/template">

            <div class="controls">
              <div class="clndr-previous-button">&lsaquo;</div><div class="month"><%= month %> <%= year %></div><div class="clndr-next-button">&rsaquo;</div>
            </div>

            <div class="days-container">
              <div class="days">
                <div class="headers">
                  <% _.each(daysOfTheWeek, function(day) { %><div class="day-header"><%= day %></div><% }); %>
                </div>
                <% for(var i = 0; i < numberOfRows; i++){ %>
                <div class="weekset">
                    <% for(var j = 0; j < 7; j++){ %>
                    <% var d = j + i * 7; %>
                        <div class="<%= days[d].classes %>" >
                        <%= days[d].day %>                            
                        </div>
                    <% } %>                
                </div>
                <% } %>
              </div>
              
            </div>

          </script>
           </div>
            </div>  

            <div class="w3-card w3-margin">
            <header class="w3-container w3-green">
                <h5>Show By Range</h5>
            </header>
                <div class="w3-container w3-padding">
                            <!-- <label>Mobile Spend</label> -->
                            <input class="w3-input w3-border-0 w3-light-grey" type="text" id="date_x" name="date_x" placeholder="From dd/mm/yyyy">
                            <!-- <label>Mobile Modifier</label> -->
                            <input class="w3-input w3-border-0 w3-light-grey w3-margin-top" type="text" id="date_y" name="date_y" placeholder="From dd/mm/yyyy">
                            <button class="w3-button w3-light-green w3-text-white w3-block w3-hover-green w3-margin-top" id="show_range">Show</button>
                </div>

            </div>

        </div>

        <div zclass="w3-main" id="main">

            <div class="w3-bar w3-white w3-box-shadow-bottom">
                <button class="w3-button w3-teal " onclick="w3_open()">&#9776;</button>
                <div class="w3-dropdown-hover w3-right">
                    <button class="w3-button w3-green w3-hover-red">Welcome! {{ Auth::user()->name }}</button>
                    <div class="w3-dropdown-content w3-bar-block w3-border">
                      <a href="{{ route('logout') }}"
                         onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();" 
                         class="w3-bar-item w3-button">Logout</a>

                    </div>
                  </div>
            </div>

        </div>


        <div class="w3-wrapper">
            @yield('content')
        </div>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            {{ csrf_field() }}
        </form>
        <div class="w3-container w3-black w3-center">
            <p>Copyright 2017. All Rights Reserved.</p>
        </div>


        <!-- MODAL -->
        <div id="id01" class="w3-modal">
            <div class="w3-modal-content">
              <div class="w3-container">
                <span onclick="document.getElementById('id01').style.display='none'" class="w3-button w3-display-topright">&times;</span>
                <p>Select Date First</p>                
              </div>
            </div>
        </div>
        <!-- Script -->
        <script
              src="https://code.jquery.com/jquery-1.12.4.min.js"
              integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ="
              crossorigin="anonymous"></script>
        <script src="{{ asset('vendors/jquery-ui/jquery-ui.min.js') }}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.8.3/underscore-min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/moment.min.js"></script>
        
        <script src="{{ asset('js/clndr.js') }}"></script>
        <script>
            
            $(document).ready(function(){
                moment.locale('en', {
                  week: { dow: 1 } // Monday is the first day of the week
                });

                $('#mini-clndr').clndr({
                    template: $('#mini-clndr-template').html(),
                     clickEvents: {
                        click: function(target) {
                            var theDate = target.date._i;
                            var value = theDate;
                            var firstDate = moment(value, "YYYY-MM-DD").day(1).format("YYYY-MM-DD");
                            var lastDate =  moment(value, "YYYY-MM-DD").day(7).format("YYYY-MM-DD");
                            window.location.href="{{ url('/') }}/week-of/"+firstDate+"/"+lastDate;
                          console.log(firstDate+" "+lastDate);
                        },
                    }
                });

                $('#date_x, #date_y').datepicker({
                    changeMonth: true,
                    changeYear: true,
                    dateFormat: 'yy-mm-dd',
                    firstDay: 1
                });

                $('#show_range').on('click', function(){
                    var from = $('#date_x').val(); 
                    var to = $('#date_y').val();

                    if(from && to){
                       window.location.href="{{ url('/') }}/week-of/"+from+"/"+to; 
                    } else{
                        $('#id01').css('display', 'block');
                    }

                });

            });

        </script>

        @yield('script')

        <script>
    function w3_open() {
        document.getElementById("main").style.marginLeft = "25%";
        document.getElementById("mySidebar").style.width = "auto";
        document.getElementById("mySidebar").style.display = "block";
        document.getElementById("openNav").style.display = 'none';
    }
    function w3_close() {
        document.getElementById("main").style.marginLeft = "0%";
        document.getElementById("mySidebar").style.display = "none";
        document.getElementById("openNav").style.display = "inline-block";
    }
</script>

    </body>
</html>

