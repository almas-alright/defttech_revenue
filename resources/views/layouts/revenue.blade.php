
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Calender App</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="{{ asset('css/w3.css') }}">
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
                <h3>Show Wickly Status</h3>
            </header>
                <div id="mini-clndr" class="w3-clearfix ">
                     <script id="mini-clndr-template" type="text/template">

            <div class="controls">
              <div class="clndr-previous-button">&lsaquo;</div><div class="month"><%= month %></div><div class="clndr-next-button">&rsaquo;</div>
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

              <!-- <div class="events">
                <div class="headers">
                  <div class="x-button">x</div>
                  <div class="event-header">EVENTS</div>
                </div>
                <div class="events-list">
                  <% _.each(eventsThisMonth, function(event) { %>
                    <div class="event">
                      <a href="<%= event.url %>"><%= moment(event.date).format('MMMM Do') %>: <%= event.title %></a>
                    </div>
                  <% }); %>
                </div>
              </div> -->
            </div>

          </script>
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
        <!-- Script -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
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
                            var firstDate = moment(value, "YYYY-MM-DD").day(1).format("MM-DD-YYYY");
                            var lastDate =  moment(value, "YYYY-MM-DD").day(7).format("MM-DD-YYYY");
                            window.location.href="{{ route('revenue.week', [firstDate,lastDate]) }}";
                          console.log(firstDate+" "+lastDate);
                        },
                    }
                });
            });

        </script>

        @yield('script')

        <script>
    function w3_open() {
        document.getElementById("main").style.marginLeft = "25%";
        document.getElementById("mySidebar").style.width = "25%";
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

