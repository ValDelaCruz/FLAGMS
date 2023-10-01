@section('head')
    <title>Admin | Dashboard</title>

    <!-- fullCalendar -->
    <link href="adminLTE-3.2/plugins/fullcalendar/main.css" rel="stylesheet">

    <style>
        /*FOR CALENDAR*/
        .fc-header-toolbar {
            font-size: 12px;
            font-weight: bold;
        }

        .fc-header-toolbar.fc-toolbar.fc-toolbar-ltr button {
            font-size: 12px;
            font-weight: bold;
            background-color: transparent;
            border-color: transparent;
            color: #252525;
        }
    </style>
@endsection()


<div>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper" style="background-color:  rgb(253, 253, 253); padding-left: 2rem;">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6" style="padding: 1rem;">
                        <h1 style="font-weight: bold;">Overview</h1>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">

                <div class="row">
                    <div class="col-lg-7">
                        <div class="row">
                            <div class="col-lg-4 col-6">
                                <!-- small box -->
                                <div class="small-box bg-info" style="background-color: white !important; color: #252525 !important; box-shadow: 0 0 10px rgba(0, 0, 0, 0.5); border-radius: 10px; height: 100px;">
                                    <div class="inner">
                                        <p style="margin: 0;">Total # of Students</p>

                                        <p style="font-size: 26px; font-weight: bold; margin: 0;">5,656</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-6">
                                <!-- small box -->
                                <div class="small-box bg-info" style="background-color: white !important; color: #252525 !important; box-shadow: 0 0 10px rgba(0, 0, 0, 0.5); border-radius: 10px; height: 100px;">
                                    <div class="inner">
                                        <p style="margin: 0;"># of Junior High Students</p>

                                        <p style="font-size: 26px; font-weight: bold; margin: 0;">3,500</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-6">
                                <!-- small box -->
                                <div class="small-box bg-info" style="background-color: white !important; color: #252525 !important; box-shadow: 0 0 10px rgba(0, 0, 0, 0.5); border-radius: 10px; height: 100px;">
                                    <div class="inner">
                                        <p style="margin: 0;"># of Senior High Students</p>

                                        <p style="font-size: 26px; font-weight: bold; margin: 0;">2,156</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4 col-6">
                                <!-- small box -->
                                <div class="small-box bg-info" style="background-color: white !important; color: #252525 !important; box-shadow: 0 0 10px rgba(0, 0, 0, 0.5); border-radius: 10px; height: 100px;">
                                    <div class="inner">
                                        <p style="margin: 0;"># of Anecdotal Reports</p>

                                        <p style="font-size: 26px; font-weight: bold; margin: 0;">150</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-6">
                                <!-- small box -->
                                <div class="small-box bg-info" style="background-color: white !important; color: #252525 !important; box-shadow: 0 0 10px rgba(0, 0, 0, 0.5); border-radius: 10px; height: 100px;">
                                    <div class="inner">
                                        <p style="margin: 0;"># of Violation Reports</p>

                                        <p style="font-size: 26px; font-weight: bold; margin: 0;">200</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-6">
                                <!-- small box -->
                                <div class="small-box bg-info" style="background-color: white !important; color: #252525 !important; box-shadow: 0 0 10px rgba(0, 0, 0, 0.5); border-radius: 10px; height: 100px;">
                                    <div class="inner">
                                        <p style="margin: 0; font-size: 14px;"># of Home Visitation Reports</p>

                                        <p style="font-size: 26px; font-weight: bold; margin: 0;">123</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <p style="font-weight: bold; font-size: 26px;">Student Violations Analysis</p>
                        <div class="row">
                            <div class="col-lg-12 col-6">
                                <div class="card" style="background-color: white !important; color: #252525 !important; box-shadow: 0 0 10px rgba(0, 0, 0, 0.5); border-radius: 10px; ">
                                    <!--Violation PieChart-->
                                    <div class="tab-content p-0">
                                        <canvas id="pieChart" style="min-height: 250px; height: 400px; max-height: 400px; max-width: 100%; margin-bottom: 2rem; margin-top: 2rem;"></canvas>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="col-lg-5">
                        <div class="row">
                            <div class="col-lg-12 col-6">
                                <!-- CALENDAR -->
                                <div class="small-box bg-info" style="background-color: white !important; color: #252525 !important; box-shadow: 0 0 10px rgba(0, 0, 0, 0.5); border-radius: 10px; padding: 2px; margin-left: 2rem">
                                    <div id="calendar" style="width: auto; font-size: 10px; padding-left: 1rem; padding-bottom: 1rem; padding-right: 1rem;">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 col-6">
                                <!-- UPCOMING EVENTS -->
                                <div class="small-box bg-info" style="background-color: white !important; color: #252525 !important; box-shadow: 0 0 10px rgba(0, 0, 0, 0.5); border-radius: 10px; padding: 5px; margin-left: 2rem;">
                                    <div class="row">
                                        <div class="col-10" style="padding: 1rem;">
                                            <p style="font-size: 24px; font-weight: bold; color: #252525; float: left;">
                                                Upcoming Events</p>
                                        </div>
                                        <div class="col-2" style="padding: 1rem;">
                                            <p style="font-size: 14px; color: #252525; float: right;"> See All</p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-2 d-flex flex-column justify-content-center" style="padding: 1rem;">
                                            <p style="font-size: 14px; font-weight: bold; color: #6256AC; text-align: center;">
                                                <i class="fa fa-solid fa-circle"></i>
                                            </p>
                                        </div>
                                        <div class="col-8 d-flex flex-column justify-content-center" style="padding: 1rem;">
                                            <div class="row">
                                                <p style="font-size: 18px; color: #252525; float: left;"> Guidance
                                                    Career Program</p>
                                            </div>
                                            <div class="row">
                                                <p style="font-size: 14px; color: #252525; float: left;"> 10:00AM -
                                                    12:30PM</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-2 d-flex flex-column justify-content-center" style="padding: 1rem;">
                                            <p style="font-size: 14px; font-weight: bold; color: #FA4481; text-align: center;">
                                                <i class="fa fa-solid fa-circle"></i>
                                            </p>
                                        </div>
                                        <div class="col-8 d-flex flex-column justify-content-center" style="padding: 1rem;">
                                            <div class="row">
                                                <p style="font-size: 18px; color: #252525; float: right;"> Mental
                                                    Health Awareness Program</p>
                                            </div>
                                            <div class="row">
                                                <p style="font-size: 14px; color: #252525; float: right;"> 10:00AM
                                                    - 12:30PM</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-2 d-flex flex-column justify-content-center" style="padding: 1rem;">
                                            <p style="font-size: 14px; font-weight: bold; color: #FC993E; text-align: center;">
                                                <i class="fa fa-solid fa-circle"></i>
                                            </p>
                                        </div>
                                        <div class="col-8 d-flex flex-column justify-content-center" style="padding: 1rem;">
                                            <div class="row">
                                                <p style="font-size: 18px; color: #252525; float: right;"> Academic
                                                    Advising Session</p>
                                            </div>
                                            <div class="row">
                                                <p style="font-size: 14px; color: #252525; float: right;"> 10:00AM
                                                    - 12:30PM</p>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <!-- /.content -->
    <!-- /.content-wrapper -->
</div>

@section('scripts')
    <!-- jQuery UI -->
    <script src="adminLTE-3.2/plugins/jquery-ui/jquery-ui.min.js"></script>

    <!-- fullCalendar 2.2.5 -->
    <script src="adminLTE-3.2/plugins/moment/moment.min.js"></script>
    <script src="adminLTE-3.2/plugins/fullcalendar/main.js"></script>

    <!-- overlayScrollbars -->
    <script src="adminLTE-3.2/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <!-- ChartJS -->
    <script src="adminLTE-3.2/plugins/chart.js/Chart.min.js"></script>


    <!----------------------------------------------------->

    <script>
        $(function() {
            var donutData = {
                labels: [
                    'Verbal Offense',
                    'Physical Offense',
                    'Social Media Offense'
                ],
                datasets: [{
                    data: [800, 500, 200],
                    backgroundColor: ['#0A0863', '#7684B9', '#F5C91A'],
                }]
            }
            //- PIE CHART -
            //-------------
            // Get context with jQuery - using jQuery's .get() method.
            var pieChartCanvas = $('#pieChart').get(0).getContext('2d')
            var pieData = donutData;
            var pieOptions = {
                maintainAspectRatio: false,
                responsive: true,
            }
            //Create pie or douhnut chart
            // You can switch between pie and douhnut using the method below.
            new Chart(pieChartCanvas, {
                type: 'pie',
                data: pieData,
                options: pieOptions
            })

            var Calendar = FullCalendar.Calendar;
            var Draggable = FullCalendar.Draggable;

            var containerEl = document.getElementById('external-events');
            var checkbox = document.getElementById('drop-remove');
            var calendarEl = document.getElementById('calendar');

            var calendar = new Calendar(calendarEl, {
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                themeSystem: 'bootstrap',
            });

            calendar.render();
            // $('#calendar').fullCalendar()


        })
    </script>
@endsection
