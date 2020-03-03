<!DOCTYPE html>
<head>
    <title>Coronavirus Tracker Application</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
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
        <h1>Coronavirus Tracker Application</h1>
        <p>This application lists the current number of cases reported across the globe</p>

        <div class="jumbotron">
            <h1 class="display-4" th:text=""><?php echo $TOTAL_CASE_REPORTED;?></h1>
            <p class="lead">Total cases reported as of today</p>
            <hr class="my-4">
            <p>
                <span>New cases reported since previous day:</span>
                <span th:text=""><?php echo $TOTAL_CASE_REPORTED_LASTDAY;?></span>
            </p>

        </div>

        <table class="table">
            <tr>
                <th>State</th>
                <th>Country</th>
                <th>Total cases reported</th>
                <th>Changes since last day</th>
            </tr>
            <?php foreach($results as $line){ ?>
            <tr>
                <td><?php echo $line['STATE'];?></td>
                <td><?php echo $line['COUNTRY'];?></td>
                <td><?php echo $line['TOTAL_CASE'];?></td>
                <td><?php echo $line['TOTAL_CASE'] - $line['TOTAL_CASE_LASTDAY'];?></td>
            </tr>
            <?php } ?>
        </table>
</div>
</body>

</html>

<?php }?>