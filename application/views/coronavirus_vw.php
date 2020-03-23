<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="description" content="Corona Virus Tracker by Furkan KAHVECİ">
    <meta name="keywords" content="Corona, COVID-19, Coronavirus, Coronavirus Tracker">
    <meta name="author" content="Furkan KAHVECİ">
    <meta http-equiv="X-UA-CompatibBle" content="IE=edge" />

    <title>Coronavirus Map</title>
    <link rel="shortcut icon" href="<?php echo base_url();?>assets/images/favicon.ico">

    <link href="<?php echo base_url();?>assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url();?>assets/css/icons.css" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url();?>assets/css/style.css" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url();?>assets/plugins/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo base_url();?>assets/plugins/datatables/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo base_url();?>assets/plugins/datatables/fixedHeader.bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo base_url();?>assets/plugins/datatables/responsive.bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo base_url();?>assets/plugins/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css"/>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

    <script type="text/javascript">
        google.charts.load('current', {
            'packages': ['geochart'],
            // Note: you will need to get a mapsApiKey for your project.
            // See: https://developers.google.com/chart/interactive/docs/basic_load_libs#load-settings
            'mapsApiKey': 'AIzaSyD-9tSrke72PouQMnMX-a7eZSW0jkFMBWY'
        });
        google.charts.setOnLoadCallback(drawRegionsMap);

        function drawRegionsMap() {
            var data = google.visualization.arrayToDataTable([
                ['Country', 'Confirmed Cases', ], <?php foreach($RESULT_DATA as $result) {
                    echo '["'.$result['country'].
                    '",'.$result['cases'].
                    '],';
                } ?>
            ]);

            var options = {
                colorAxis: {
                    colors: ['#D2E3FC', '#8AB4F8', '#4285F4', '#1967D2', '#174EA6', ]
                },
                backgroundColor: '#2A323C',
                legend: {
                    textStyle: {
                        color: '#000',
                        fontSize: 14
                    }
                }
            };

            var chart = new google.visualization.GeoChart(document.getElementById('regions_div'));

            chart.draw(data, options);
        }
    </script>

</head>


<body>

    <div id="content-page">
        <div class="content">
            <div class="row ">
                <div class=" col-lg-12">
                    <div class="page-header-title" style="margin-top:1px;">
                        <h4 class="page-title" style="text-align:center;">Coronavirus Tracker Application</h4>
                    </div>
                </div>
                
            </div>
            <div class="page-content-wrapper ">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-6 col-lg-3">
                            <div class="card text-center">
                                <div class="card-heading">
                                    <h4 class="card-title text-muted mb-0">Total Cases</h4>
                                </div>
                                <div class="card-body p-t-10">
                                    <h2 class="m-t-0 m-b-15"><i
                                            class="mdi mdi-arrow-up text-success m-r-10"></i><b><?php echo $TOTAL_CASE_REPORTED;?></b>
                                    </h2>
                                    <p class="text-muted m-b-0 m-t-20"><b>Reported as of Today</b></p>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6 col-lg-3">
                            <div class="card text-center">
                                <div class="card-heading">
                                    <h4 class="card-title text-muted mb-0">Total Deaths</h4>
                                </div>
                                <div class="card-body p-t-10">
                                    <h2 class="m-t-0 m-b-15"><i
                                            class="mdi mdi-arrow-up text-success m-r-10"></i><b><?php echo $TOTAL_DEATHS_REPORTED;?></b>
                                    </h2>
                                    <p class="text-muted m-b-0 m-t-20"><b>Reported as of Today</b></p>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6 col-lg-3">
                            <div class="card text-center">
                                <div class="card-heading">
                                    <h4 class="card-title text-muted mb-0">Total Recovered</h4>
                                </div>
                                <div class="card-body p-t-10">
                                    <h2 class="m-t-0 m-b-15"><i
                                            class="mdi mdi-arrow-up text-success m-r-10"></i><b><?php echo $TOTAL_RECOVERED_REPORTED;?></b>
                                    </h2>
                                    <p class="text-muted m-b-0 m-t-20"><b>Reported as of Today</b></p>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6 col-lg-3">
                            <div class="card text-center">
                                <div class="card-heading">
                                    <h4 class="card-title text-muted mb-0">New Cases</h4>
                                </div>
                                <div class="card-body p-t-10">
                                    <h2 class="m-t-0 m-b-15"><i
                                            class="mdi mdi-arrow-up text-success m-r-10"></i><b><?php echo $TOTAL_CASE_REPORTED_LASTDAY;?></b>
                                    </h2>
                                    <p class="text-muted m-b-0 m-t-20"><b>Since Previous Day</b></p>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-sm-12 col-lg-12">
                            <div id="regions_div"> </div>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="m-b-30 m-t-0">Statistics</h4>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="table-responsive">
                                                <table id="datatable"
                                                    class="table table-striped table-bordered dt-responsive nowrap"
                                                    cellspacing="0" width="100%">
                                                    <thead>
                                                        <tr>
                                                            <th>Location</th>
                                                            <th>Confirmed cases</th>
                                                            <th>Cases per 1M people</th>
                                                            <th>Deaths</th>
                                                            <th>Recovered</th>
                                                            <th>Changes since last day</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php foreach($RESULT_DATA as $result){ ?>
                                                        <tr>
                                                            <td><img src="https://www.gstatic.com/onebox/sports/logos/flags/<?php echo strtolower(str_replace(" ","_",$result['country'])); ?>_icon_square.svg" height="20" width="20"> <?php echo $result['country'];?></td>
                                                            <td><?php echo $result['cases'];?></td>
                                                            <td><?php echo $result['casesPerOneMillion'];?></td>
                                                            <td><?php echo $result['deaths'];?></td>
                                                            <td><?php echo $result['recovered'];?></td>
                                                            <td><?php echo $result['todayCases'];?></td>
                                                        </tr>
                                                        <?php } ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row ">
                            <div class=" col-lg-12">
                                    <div class="page-title footerchange" >© 2020 Coronavirus Tracker - Furkan KAHVECİ</div>
                                </div>
                            </div>
                            
                        </div>
                        </div>
                      
                    </div>
               
                </div>
                
            </div> 
            
           
        </div> 
    </div>
           
    <script src="<?php echo base_url();?>assets/js/jquery.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/popper.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/modernizr.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/detect.js"></script>
    <script src="<?php echo base_url();?>assets/js/fastclick.js"></script>
    <script src="<?php echo base_url();?>assets/js/jquery.slimscroll.js"></script>
    <script src="<?php echo base_url();?>assets/js/jquery.blockUI.js"></script>
    <script src="<?php echo base_url();?>assets/js/waves.js"></script>
    <script src="<?php echo base_url();?>assets/js/wow.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/jquery.nicescroll.js"></script>
    <script src="<?php echo base_url();?>assets/js/jquery.scrollTo.min.js"></script>

    <!-- Required datatable js-->
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.js"></script>
    <script src="<?php echo base_url();?>assets/plugins/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Responsive examples -->
    <script src="<?php echo base_url();?>assets/plugins/datatables/dataTables.responsive.min.js"></script>
    <script src="<?php echo base_url();?>assets/plugins/datatables/responsive.bootstrap4.min.js"></script>

    <script>
        $(document).ready(function () {
            $('table').DataTable({
                order: [],
                paging: true,
                "pageLength": 25,
            });
        });
    </script>
</body>
</html>