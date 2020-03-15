<!DOCTYPE html>

<head>
    <title>Coronavirus Tracker Application</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
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
                ['Country', 'TotalCase', 'TotalDeath'], 
                <?php foreach($maps as $each) {
                    echo '["'.$each['COUNTRY'].'",'.$each['TOTAL_CASE'].','.$each['TOTAL_DEATH'].'],';
                } ?>
            ]);

            var options = {
                colorAxis: {
                    colors: ['#eebe7c', '#ff9400', '#f37f13', '#87200F', '#eb640b', ]
                },
                backgroundColor: '#F8F9FA',
                datalessRegionColor: '#EEE',
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

<?php if(isset($error)){?>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="error-template">
                    <h1>
                        Oops!</h1>
                    <h2>
                        404 Not Found</h2>
                    <div class="error-details">
                        Sorry, an error has occured, Requested page not found!
                    </div>

                </div>
            </div>
        </div>
    </div>
</body>
<?php } else{?>

<body>

    <div class="container">
        <div class="row">
            <div class="col-sm-9" style="margin-top:10px;">
                <h2>Coronavirus Tracker Application</h2>
            </div>
            <div class="col-sm-3 my-auto">
                <a href="https://github.com/furkankahvecii/coronavirus-tracker" style="float:right;"
                    class="btn btn-primary btn active btn-sm " role="button" aria-pressed="true" target="_blank">Source
                    Code</a>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <p>This application lists the current number of cases reported across the globe</p>
            </div>
        </div>


        <div class="jumbotron">
            <div class="container">
                <div class="row">
                    <div class="col-sm-4">
                        <h1 class="display-4" th:text=""><?php echo $TOTAL_CASE_REPORTED;?></h1>
                        <p class="lead">Total cases reported as of today</p>
                    </div>
                    <div class="col-sm-4">
                        <h1 class="display-4" th:text=""><?php echo $TOTAL_DEATHS_REPORTED;?></h1>
                        <p class="lead">Total deaths reported as of today</p>
                    </div>
                    <div class="col-sm-4">
                        <h1 class="display-4" th:text=""><?php echo $TOTAL_RECOVERED_REPORTED;?></h1>
                        <p class="lead">Total recovered reported as of today</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <hr class="my-4">
                        <p>
                            <span>New cases reported since previous day:</span>
                            <span th:text=""><?php echo $TOTAL_CASE_REPORTED_LASTDAY;?></span>
                        </p>
                        <input id="toggle-event" type="checkbox" data-toggle="toggle" data-on="Table"
                            data-off="GeoChart" data-onstyle="success" data-offstyle="info">
                    </div>
                </div>
            </div>
        </div>

        <div id="datatable">
            <div class="row">
                <div class="col-9"></div>
                <div class="col-3">
                    <div class="form-group mb-4">
                        <input type="text" placeholder="Search" class="form-control border-dark" id="search">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-condensed table-hover table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">State</th>
                                    <th scope="col">Country</th>
                                    <th scope="col">Total cases</th>
                                    <th scope="col">Total death</th>
                                    <th scope="col">Total recovered</th>
                                    <th scope="col">Changes since last day</th>
                                </tr>
                            </thead>
                            <tbody id="myTable">
                                <?php foreach($results as $line){ ?>
                                <tr>
                                    <td><?php echo $line['STATE'];?></td>
                                    <td><?php echo $line['COUNTRY'];?></td>
                                    <td><?php echo $line['TOTAL_CASE'];?></td>
                                    <td><?php echo $line['TOTAL_DEATH'];?></td>
                                    <td><?php echo $line['TOTAL_RECOVERED'];?></td>
                                    <td><?php echo $line['TOTAL_CASE'] - $line['TOTAL_CASE_LASTDAY'];?></td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div id="maps">
            <div class="row">
                <div id="regions_div" style="width: 100%; height: 100%;"> </div>
            </div>
        </div>

    </div>
</body>

</html>

<?php }?>


<script>
    $(document).ready(function () {
        $('#datatable').hide();

        document.onkeyup = function (e) {
            if (e.which == 67) {
                $('#toggle-event').bootstrapToggle('toggle');
            }
        };

        $("#search").on("keyup", function () {
            var value = $(this).val().toLowerCase();
            $("#myTable tr").filter(function () {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    });
</script>

<script>
    $(function () {
        $('#toggle-event').change(function () {
            var isActive = ($(this).prop('checked'));
            if (isActive == true) {
                $('#datatable').show();
                $('#maps').hide();
            } else {
                $('#maps').show();
                $('#datatable').hide();
            }
        })
    })
</script>
