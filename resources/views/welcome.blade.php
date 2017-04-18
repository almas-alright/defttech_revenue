<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <link rel="stylesheet"  href="{{ asset('css/app.css') }}">
        <link rel="stylesheet"  href="{{ asset('css/prism.css') }}">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @if (Auth::check())
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ url('/login') }}">Login</a>
                        <a href="{{ url('/register') }}">Register</a>
                    @endif
                </div>
            @endif

            <!-- <div class="content">
                <div class="title m-b-md">
                    Laravel
                </div>

                <div class="links">
                    <a href="https://laravel.com/docs">Documentation</a>
                    <a href="https://laracasts.com">Laracasts</a>
                    <a href="https://laravel-news.com">News</a>
                    <a href="https://forge.laravel.com">Forge</a>
                    <a href="https://github.com/laravel/laravel">GitHub</a>
                </div>
            </div>
        </div> -->

        <form method="post" action="{{ route('revenue.store') }}">
            {{ csrf_field() }}
            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
            <input id="date" type="hidden" name="entry_for" step="" value="">
            <fieldset> 
            <legend>Desktop:</legend>
            <input type="number" step="0.01" name="desktop_spend" value="" placeholder="Desktop Spend">
            <input type="number" step="0.01" name="desktop_mod" value="" placeholder="Desktop Modifier">
            </fieldset>
            <fieldset>
            <legend>Mobile:</legend>
            <input type="number" step="0.01" name="mobile_spend" value="" placeholder="Mobile Spend">
            <input type="number" step="0.01" name="mobile_mod" value="" placeholder="Mobile Modifier">
            </fieldset>

            <button type="submit">Save</button>
        </form>
        <div id="mini-clndr">
          <script id="mini-clndr-template" type="text/template">

            <div class="controls">
              <div class="clndr-previous-button">&lsaquo;</div><div class="month"><%= month %></div><div class="clndr-next-button">&rsaquo;</div>
            </div>

            <div class="days-container">
              <div class="days">
                <div class="headers">
                  <% _.each(daysOfTheWeek, function(day) { %><div class="day-header"><%= day %></div><% }); %>
                </div>
                <% _.each(days, function(day) { %><div class="<%= day.classes %>" id="<%= day.id %>"><%= day.day %></div><% }); %>
              </div>
              <div class="events">
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
              </div>
            </div>

          </script>
        </div>

        @if($errors->any())
        <div class="alert alert-danger">
            <ul style="list-style:square; margin-left:1.7rem">
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        

<script
              src="https://code.jquery.com/jquery-1.12.4.min.js"
              integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ="
              crossorigin="anonymous"></script>

<script type="text/javascript" src="{{ asset('js/prism.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/underscore-min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/moment.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/clndr.js') }}"></script>

<script type="text/javascript">

$(document).ready(function(){

        $('#mini-clndr').clndr({
            template: $('#mini-clndr-template').html(),
             clickEvents: {
                click: function(target) {
                    var theDate = target.date._i;
                    $('#date').val(theDate);
                  console.log(theDate);
                },
            }
        });

        $('#mini-clndr .day').on('click', function(){
            $('#mini-clndr .day').removeClass('selected');
            $(this).addClass('selected');
        });

});

</script>

    </body>
</html>
