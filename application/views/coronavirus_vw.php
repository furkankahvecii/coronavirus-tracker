<?php $this->load->view("template/head_vw");?>
<?php $this->load->view("geochart_vw");?>
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
                                            class="mdi mdi-arrow-up text-success m-r-10"></i><b><?php echo number_format($RESULT_DATA_CONTİNENT[0]['cases']);?></b>
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
                                            class="mdi mdi-arrow-up text-success m-r-10"></i><b><?php echo number_format($RESULT_DATA_CONTİNENT[0]['deaths']);?></b>
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
                                            class="mdi mdi-arrow-up text-success m-r-10"></i><b><?php echo number_format($RESULT_DATA_CONTİNENT[0]['recovered']);?></b>
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
                                            class="mdi mdi-arrow-up text-success m-r-10"></i><b><?php echo number_format($RESULT_DATA_CONTİNENT[0]['todayCases']);?></b>
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
                                    <h4 class="m-b-30 m-t-0">Statistics Continent</h4>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="table-responsive">
                                                <table id="datatable" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                                    <thead>
                                                        <tr>
                                                            <th>Location</th>
                                                            <th>Confirmed cases</th>
                                                            <th>Deaths</th>
                                                            <th>Recovered</th>
                                                            <th>Total Tests</th>
                                                            <th>Changes since last day</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php foreach($RESULT_DATA_CONTİNENT as $result){ ?>
                                                        <tr>           
                                                            <td><?php echo $result['country'];?></td>
                                                            <td><?php echo number_format($result['cases']);?></td>
                                                            <td><?php echo number_format($result['deaths']);?></td>
                                                            <td><?php echo number_format($result['recovered']);?></td>
                                                            <td><?php echo number_format($result['totalTests']);?></td>
                                                            <td><?php echo number_format($result['todayCases']);?></td>
                                                        </tr>
                                                        <?php } ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="m-b-30 m-t-0">Statistics Country</h4>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="table-responsive">
                                                <table id="datatable" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                                    <thead>
                                                        <tr>
                                                            <th>Location</th>
                                                            <th>Confirmed cases</th>
                                                            <th>Deaths</th>
                                                            <th>Recovered</th>
                                                            <th>Total Tests</th>
                                                            <th>Changes since last day</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php foreach($RESULT_DATA_COUNTRY as $result){ ?>
                                                        <tr>           
                                                            <td><img src="<?php if(strpos($result['image'], 'gstatic') !== false) {echo $result['image'];}
                                                            else{ echo "https://www.gstatic.com/onebox/sports/logos/flags/".strtolower(str_replace(" ","_",$result['image']))."_icon_square.svg" ;}?>
                                                            " height="20" width="20"> <?php echo $result['country'];?></td>
                                                            <td><?php echo number_format($result['cases']);?></td>
                                                            <td><?php echo number_format($result['deaths']);?></td>
                                                            <td><?php echo number_format($result['recovered']);?></td>
                                                            <td><?php echo number_format($result['totalTests']);?></td>
                                                            <td><?php echo number_format($result['todayCases']);?></td>
                                                        </tr>
                                                        <?php } ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php $this->load->view("template/footer_vw");?>