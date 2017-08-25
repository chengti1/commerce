<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Gentellela Alela! | </title>

    <!-- Bootstrap -->
    {!! Html::style('dashboard/css/bootstrap.min.css') !!}
    <!-- Font Awesome -->
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.12/datatables.min.css"/>
    <!-- NProgress -->
    {!! Html::style('dashboard/css/nprogress.css') !!}
    <!-- NProgress -->
    {!! Html::style('dashboard/css/nprogress.css') !!}
    {!! Html::style('dashboard/css/green.css') !!}
    <!-- iCheck -->
    {!! Html::style('dashboard/css/bootstrap-progressbar-3.3.4.min.css') !!}
    <!-- bootstrap-progressbar -->
    {!! Html::style('dashboard/css/jqvmap.min.css') !!}
    <!-- JQVMap -->
    {!! Html::style('dashboard/css/custom.min.css') !!}
    {!! Html::style('dashboard/css/jquery.tagsinput.css') !!}

	{!! Html::style('css/chosen.css') !!}

	{{Html::style('dashboard/css/jquery.tagsinput.css')}}

    <!-- Custom Theme Style -->
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="{{Request::root()}}" class="site_title"><i class="fa fa-paw"></i> <span>BUBILAND</span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile">
              <div class="profile_pic">
                {!! Html::image('images/img.png','...', array('class' => 'img-circle profile_img')) !!}
              </div>
              <div class="profile_info">
                <span>Welcome,</span>
                <h2>{{ $adminData->admin_name }}</h2>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <ul class="nav side-menu">
                  <h2>Menu</h2>
                  <li><a href = "{{ Request::root() }}/admindashboard"><i class="fa fa-home"></i> Member Area </a>
                  </li>
                  <li><a href = "{{Request::root()}}/admindashboard/managecategories"><i class="fa fa-edit"></i> Manage Product Categories </a>
                  </li>
                  <li><a href="{{ Request::root() }}/admindashboard/managebrands"><i class="fa fa-desktop"></i> Manage Brands </a>
                  </li>
                  <li><a href = "{{ Request::root() }}/admindashboard/auctioncategories"><i class="fa fa-table"></i> Manage Auction Categories </a>
                  </li>
                  <li><a href = "{{ Request::root() }}/admindashboard/manage-coupons"><i class="fa fa-tags"></i> Manage Coupons </a>
                  </li>
                  <li><a href = "{{ Request::root() }}/admindashboard/manage-reports"><i class="fa fa-tags"></i> Manage Reports </a>
                  </li>
                  <li>
                    <a><i class="fa fa-bar-chart-o"></i> Manage Users <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="#">Sellers</a></li>
                      <li><a href="#">Buyers</a></li>
                    </ul>
                  </li>
                <ul class="nav side-menu">
                  <li><a href = "{{ Request::root() }}/admindashboard/manage-products"><i class="fa fa-bug"></i> Manage Products </a></li>
                  <li>
                    <a><i class="fa fa-windows"></i>Manage Commissions<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="{{ Request::root() }}/admindashboard/hunting-commission">Hunting</a></li>
                      <li><a href="{{ Request::root() }}/admindashboard/hunting-product">Product</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-sitemap"></i> My Banners <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                        <li><a href="#">Level One</a>
                        <li><a>Level One<span class="fa fa-chevron-down"></span></a>
                    </li>
                    </li>
                    </ul>
                    <li><a><i class="fa fa-sitemap"></i> Progress <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                        <li><a href="#">Level One</a>
                        <li><a>Level One<span class="fa fa-chevron-down"></span></a>
                    </li>
                    </li>
                    </ul>
                    <li><a><i class="fa fa-sitemap"></i> My Posts <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                        <li><a href="#">Level One</a>
                        <li><a>Level One<span class="fa fa-chevron-down"></span></a>
                    </li>
                    </li>
                    </ul>
                    <li><a><i class="fa fa-sitemap"></i> Messages <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                        <li><a href="#">Level One</a>
                        <li><a>Level One<span class="fa fa-chevron-down"></span></a>
                    </li>
                    </li>
                    </ul>
                    <!--<li><a><i class="fa fa-sitemap"></i> Manage Product Attributes <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                        <li><a href="#">Level One</a>
                        <li><a>Level One<span class="fa fa-chevron-down"></span></a>
                    </li>
                    </li>
                    </ul>-->
                    <li><a><i class="fa fa-sitemap"></i> Saved Seller <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                        <li><a href="#">Level One</a>
                        <li><a>Level One<span class="fa fa-chevron-down"></span></a>
                    </li>
                    </li>
                    </ul>
              </div>

            </div>
            <!-- /sidebar menu -->

            <!-- /menu footer buttons -->
            <div class="sidebar-footer hidden-small">
              <a data-toggle="tooltip" data-placement="top" title="Settings">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Lock">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Logout">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
              </a>
            </div>
            <!-- /menu footer buttons -->
          </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
            <nav>
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>

              <ul class="nav navbar-nav navbar-right">
                <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    {!! Html::image('images/img.png') !!}
                    {{ $adminData->admin_name }}
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    <li><a href="javascript:;"> Profile</a></li>
                    <li>
                      <a href="javascript:;">
                        <span class="badge bg-red pull-right">50%</span>
                        <span>Settings</span>
                      </a>
                    </li>
                    <li><a href="javascript:;">Help</a></li>
                    <li><a href="{{ Request::root() }}/logout"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                  </ul>
                </li>

                <li role="presentation" class="dropdown">
                  <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
                    <i class="fa fa-envelope-o"></i>
                    <span class="badge bg-green">6</span>
                  </a>
                  <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">
                    <li>
                      <a>
                        <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                      </a>
                    </li>
                    <li>
                      <a>
                        <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                      </a>
                    </li>
                    <li>
                      <a>
                        <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                      </a>
                    </li>
                    <li>
                      <a>
                        <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                      </a>
                    </li>
                    <li>
                      <div class="text-center">
                        <a>
                          <strong>See All Alerts</strong>
                          <i class="fa fa-angle-right"></i>
                        </a>
                      </div>
                    </li>
                  </ul>
                </li>
              </ul>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->

@yield('content')

        <!-- footer content -->
        <footer>
          <div class="pull-right">
            Bubiland <a href="{{Request::root()}}"></a>
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>

    <!-- jQuery -->
    {!! Html::script('dashboard/js/jquery.min.js') !!}
    <!-- Bootstrap -->
    {!! Html::script('dashboard/js/bootstrap.min.js') !!}
    <!-- FastClick -->
    {!! Html::script('dashboard/js/fastclick.js') !!}
    <!-- NProgress -->
    {!! Html::script('dashboard/js/nprogress.js') !!}
    <!-- Chart.js -->
    {!! Html::script('dashboard/js/Chart.min.js') !!}
    <!-- gauge.js -->
    {!! Html::script('dashboard/js/gauge.min.js') !!}
    <!-- bootstrap-progressbar -->
    {!! Html::script('dashboard/js/bootstrap-progressbar.min') !!}
    <!-- iCheck -->
    {!! Html::script('dashboard/js/icheck.min.js') !!}
    <!-- Skycons -->
    {!! Html::script('dashboard/js/skycons.js') !!}
    <!-- Flot -->
    {!! Html::script('dashboard/js/jquery.flot.js') !!}
    {!! Html::script('dashboard/js/jquery.flot.pie.js') !!}
    {!! Html::script('dashboard/js/jquery.flot.time.js') !!}
    {!! Html::script('dashboard/js/jquery.flot.stack.js') !!}
    {!! Html::script('dashboard/js/jquery.flot.resize.js') !!}
    <!-- Flot plugins -->
    {!! Html::script('dashboard/js/jquery.flot.orderBars.js') !!}
    {!! Html::script('dashboard/js/date.js') !!}
    {!! Html::script('dashboard/js/jquery.flot.spline.js') !!}
    {!! Html::script('dashboard/js/curvedLines.js') !!}
    <!-- JQVMap -->
    {!! Html::script('dashboard/js/jquery.vmap.js') !!}
    {!! Html::script('dashboard/js/jquery.vmap.world.js') !!}
    {!! Html::script('dashboard/js/jquery.vmap.sampledata.js') !!}
    <!-- bootstrap-daterangepicker -->
    {!! Html::script('dashboard/js/moment.min.js') !!}
    {!! Html::script('dashboard/js/daterangepicker.js') !!}
	{!! Html::script('js/chosen.jquery.js') !!}

    <!-- Custom Theme Scripts -->
    {!! Html::script('dashboard/js/custom.min.js') !!}
    {!! Html::script('dashboard/js/jquery.tagsinput.js') !!}

	{{Html::script('dashboard/js/jquery.tagsinput.js')}}

	{{Html::script('ckeditor/ckeditor.js')}}
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.12/datatables.min.js"></script>
	<script>
        $(document).ready(function () {
            var category = $('#categories option:selected').val();
            $.ajax({
                url: '{{ URL::asset('/')}}buyerdashboard/getsubcategory?category_id=' + category,
                type: 'get',
                success: function (subcategory) {
                    $('#scategory').html(subcategory);
                }
            })
        })
    </script>
    <script>
        $(document).ready(function () {
            $('#categories').change(function () {
                var category = $('#categories option:selected').val();
                $.ajax({
                    url: '{{ URL::asset('/')}}buyerdashboard/getsubcategory?category_id=' + category,
                    type: 'get',
                    success: function (subcategory) {
                        $('#scategory').html(subcategory);
                    }
                })
            })
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('#discount').keyup(function () {
                var sellprice = $('#sellprice').val();
                var discount = $('#discount').val();
                var dprice = (sellprice) - (sellprice / 100) * discount;
                $('#afterdiscount').val(dprice.toFixed(2));
            });
        });
    </script>
    <script>
        $(document).ready(function () {
            $('#keywords').tagsInput();
        });
    </script>

    <script>
      $(document).ready(function(){
        $('.myTable').DataTable();
      });

		$(document).ready(function(){
		  $('#attributes').chosen();
		})
    </script>

    <!-- Flot -->
    <script>
      $(document).ready(function() {
        var data1 = [
          [gd(2012, 1, 1), 17],
          [gd(2012, 1, 2), 74],
          [gd(2012, 1, 3), 6],
          [gd(2012, 1, 4), 39],
          [gd(2012, 1, 5), 20],
          [gd(2012, 1, 6), 85],
          [gd(2012, 1, 7), 7]
        ];

        var data2 = [
          [gd(2012, 1, 1), 82],
          [gd(2012, 1, 2), 23],
          [gd(2012, 1, 3), 66],
          [gd(2012, 1, 4), 9],
          [gd(2012, 1, 5), 119],
          [gd(2012, 1, 6), 6],
          [gd(2012, 1, 7), 9]
        ];
        $("#canvas_dahs").length && $.plot($("#canvas_dahs"), [
          data1, data2
        ], {
          series: {
            lines: {
              show: false,
              fill: true
            },
            splines: {
              show: true,
              tension: 0.4,
              lineWidth: 1,
              fill: 0.4
            },
            points: {
              radius: 0,
              show: true
            },
            shadowSize: 2
          },
          grid: {
            verticalLines: true,
            hoverable: true,
            clickable: true,
            tickColor: "#d5d5d5",
            borderWidth: 1,
            color: '#fff'
          },
          colors: ["rgba(38, 185, 154, 0.38)", "rgba(3, 88, 106, 0.38)"],
          xaxis: {
            tickColor: "rgba(51, 51, 51, 0.06)",
            mode: "time",
            tickSize: [1, "day"],
            //tickLength: 10,
            axisLabel: "Date",
            axisLabelUseCanvas: true,
            axisLabelFontSizePixels: 12,
            axisLabelFontFamily: 'Verdana, Arial',
            axisLabelPadding: 10
          },
          yaxis: {
            ticks: 8,
            tickColor: "rgba(51, 51, 51, 0.06)",
          },
          tooltip: false
        });

        function gd(year, month, day) {
          return new Date(year, month - 1, day).getTime();
        }
      });
    </script>
    <!-- /Flot -->

    <!-- JQVMap -->
    <script>
      $(document).ready(function(){
        $('#world-map-gdp').vectorMap({
            map: 'world_en',
            backgroundColor: null,
            color: '#ffffff',
            hoverOpacity: 0.7,
            selectedColor: '#666666',
            enableZoom: true,
            showTooltip: true,
            values: sample_data,
            scaleColors: ['#E6F2F0', '#149B7E'],
            normalizeFunction: 'polynomial'
        });
      });
    </script>
    <!-- /JQVMap -->

    <!-- Skycons -->
    <script>
      $(document).ready(function() {
        var icons = new Skycons({
            "color": "#73879C"
          }),
          list = [
            "clear-day", "clear-night", "partly-cloudy-day",
            "partly-cloudy-night", "cloudy", "rain", "sleet", "snow", "wind",
            "fog"
          ],
          i;

        for (i = list.length; i--;)
          icons.set(list[i], list[i]);

        icons.play();
      });
    </script>
    <!-- /Skycons -->

    <!-- Doughnut Chart -->
    <script>
      $(document).ready(function(){
        var options = {
          legend: false,
          responsive: false
        };

        new Chart(document.getElementById("canvas1"), {
          type: 'doughnut',
          tooltipFillColor: "rgba(51, 51, 51, 0.55)",
          data: {
            labels: [
              "Symbian",
              "Blackberry",
              "Other",
              "Android",
              "IOS"
            ],
            datasets: [{
              data: [15, 20, 30, 10, 30],
              backgroundColor: [
                "#BDC3C7",
                "#9B59B6",
                "#E74C3C",
                "#26B99A",
                "#3498DB"
              ],
              hoverBackgroundColor: [
                "#CFD4D8",
                "#B370CF",
                "#E95E4F",
                "#36CAAB",
                "#49A9EA"
              ]
            }]
          },
          options: options
        });
      });
    </script>
    <!-- /Doughnut Chart -->

    <!-- bootstrap-daterangepicker -->
    <script>
      $(document).ready(function() {

        var cb = function(start, end, label) {
          console.log(start.toISOString(), end.toISOString(), label);
          $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
        };

        var optionSet1 = {
          startDate: moment().subtract(29, 'days'),
          endDate: moment(),
          minDate: '01/01/2012',
          maxDate: '12/31/2015',
          dateLimit: {
            days: 60
          },
          showDropdowns: true,
          showWeekNumbers: true,
          timePicker: false,
          timePickerIncrement: 1,
          timePicker12Hour: true,
          ranges: {
            'Today': [moment(), moment()],
            'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Last 7 Days': [moment().subtract(6, 'days'), moment()],
            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
            'This Month': [moment().startOf('month'), moment().endOf('month')],
            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
          },
          opens: 'left',
          buttonClasses: ['btn btn-default'],
          applyClass: 'btn-small btn-primary',
          cancelClass: 'btn-small',
          format: 'MM/DD/YYYY',
          separator: ' to ',
          locale: {
            applyLabel: 'Submit',
            cancelLabel: 'Clear',
            fromLabel: 'From',
            toLabel: 'To',
            customRangeLabel: 'Custom',
            daysOfWeek: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'],
            monthNames: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
            firstDay: 1
          }
        };
        $('#reportrange span').html(moment().subtract(29, 'days').format('MMMM D, YYYY') + ' - ' + moment().format('MMMM D, YYYY'));
        $('#reportrange').daterangepicker(optionSet1, cb);
        $('#reportrange').on('show.daterangepicker', function() {
          console.log("show event fired");
        });
        $('#reportrange').on('hide.daterangepicker', function() {
          console.log("hide event fired");
        });
        $('#reportrange').on('apply.daterangepicker', function(ev, picker) {
          console.log("apply event fired, start/end dates are " + picker.startDate.format('MMMM D, YYYY') + " to " + picker.endDate.format('MMMM D, YYYY'));
        });
        $('#reportrange').on('cancel.daterangepicker', function(ev, picker) {
          console.log("cancel event fired");
        });
        $('#options1').click(function() {
          $('#reportrange').data('daterangepicker').setOptions(optionSet1, cb);
        });
        $('#options2').click(function() {
          $('#reportrange').data('daterangepicker').setOptions(optionSet2, cb);
        });
        $('#destroy').click(function() {
          $('#reportrange').data('daterangepicker').remove();
        });
      });
    </script>
    <!-- /bootstrap-daterangepicker -->

    <!-- gauge.js -->
    <script>
      var opts = {
          lines: 12,
          angle: 0,
          lineWidth: 0.4,
          pointer: {
              length: 0.75,
              strokeWidth: 0.042,
              color: '#1D212A'
          },
          limitMax: 'false',
          colorStart: '#1ABC9C',
          colorStop: '#1ABC9C',
          strokeColor: '#F0F3F3',
          generateGradient: true
      };
      var target = document.getElementById('foo'),
          gauge = new Gauge(target).setOptions(opts);

      gauge.maxValue = 6000;
      gauge.animationSpeed = 32;
      gauge.set(3200);
      gauge.setTextField(document.getElementById("gauge-text"));
    </script>
    <!-- /gauge.js -->
  </body>
</html>
