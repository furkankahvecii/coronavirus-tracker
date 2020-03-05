<!DOCTYPE html>

<head>
    <title>Coronavirus Tracker Application</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
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

        <nav class="navbar navbar-light bg-light">
            <h1>Coronavirus Tracker Application</h1>
            <a href="https://github.com/furkankahvecii/coronavirus-tracker" class="btn btn-primary btn-lg active btn-sm"
                role="button" aria-pressed="true" target="_blank">Source Code</a>
            <p>This application lists the current number of cases reported across the globe</p>

        </nav>


        <div class="jumbotron">
            <h1 class="display-4" th:text=""><?php echo $TOTAL_CASE_REPORTED;?></h1>
            <p class="lead">Total cases reported as of today</p>
            <hr class="my-4">
            <p>
                <span>New cases reported since previous day:</span>
                <span th:text=""><?php echo $TOTAL_CASE_REPORTED_LASTDAY;?></span>
            </p>
        </div>



        <div class="row">
            <div class="col-9"></div>
            <div class="col-3">
                <div class="form-group mb-4">
                    <input type="text" placeholder="Search" class="form-control border-dark" id="search">
                </div>
            </div>
        </div>

        <table class="table">
            <thead>
                <tr>
                    <th>State</th>
                    <th>Country</th>
                    <th>Total cases reported</th>
                    <th>Changes since last day</th>
                </tr>
            </thead>
            <tbody id="myTable">
                <?php foreach($results as $line){ ?>
                <tr>
                    <td><?php echo $line['STATE'];?></td>
                    <td><?php echo $line['COUNTRY'];?></td>
                    <td><?php echo $line['TOTAL_CASE'];?></td>
                    <td><?php echo $line['TOTAL_CASE'] - $line['TOTAL_CASE_LASTDAY'];?></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>

</html>

<?php }?>


<script>
    $(document).ready(function () {
        $("#search").on("keyup", function () {
            var value = $(this).val().toLowerCase();
            $("#myTable tr").filter(function () {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    });
</script>