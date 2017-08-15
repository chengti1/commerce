@extends('layouts.buyerdashboardlayout')

@section('content')
       <div class = "box">
       <div class="box-heading">Weather</div>
        <div class="right_col" role="main">
        <div class="col-md-12 col-sm-12 col-xs-12">
                                    @if (session('error'))
                      <div class="alert alert-danger">
                        {{ session('error') }}
                      </div>
                    @endif
                    @if (session('success'))
                      <div class="alert alert-success">
                        {{ session('success') }}
                      </div>
                    @endif

 <a href="http://www.accuweather.com/en/us/new-york-ny/10007/weather-forecast/349727" class="aw-widget-legal">
<!--
By accessing and/or using this code snippet, you agree to AccuWeather’s terms and conditions (in English) which can be found at http://www.accuweather.com/en/free-weather-widgets/terms and AccuWeather’s Privacy Statement (in English) which can be found at http://www.accuweather.com/en/privacy.
-->
</a><div id="awcc1470033105269" class="aw-widget-current"  data-locationkey="" data-unit="f" data-language="en-us" data-useip="true" data-uid="awcc1470033105269"></div><script type="text/javascript" src="http://oap.accuweather.com/launch.js"></script>
             
                    
                    </div>
                  </div>
                </div>

                <div class = "box">
       <div class="box-heading">Calendar</div>
        <div class="right_col" role="main">
        <div class="col-md-12 col-sm-12 col-xs-12">
        <div id = "fullCalendar"></div>
             
                    </div>
                  </div>
                </div>
              </div>
</div>
</div>

        @stop

