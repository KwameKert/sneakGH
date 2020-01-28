    <div class="row mt-3">
        <div class="col-xl-4"></div>
        <div class="col-lg-12 col-xl-4">
                        <div class="card-box">
                            <h4 class="text-dark header-title m-t-0 m-b-30 text-center">My transactions</h4>

                            <div class="widget-chart text-center">
                                <input class="knob" data-width="150" data-height="150" data-linecap=round data-fgColor="#fb6d9d" value="<?php echo $transactionDetails['percentage']?>" data-skin="tron" data-angleOffset="180" data-readOnly=true data-thickness=".15"/>
                                <h5 class="text-muted m-t-20 font-16">Successful transactions</h5>
                                <h2 class="font-600">$<b class="counter"><?php echo $transactionDetails['completed']?></b></h2>
                                <ul class="list-inline m-t-15">
                                    <li class="list-inline-item">
                                        <h5 class="text-muted m-t-20 font-16">No of Transactions</h5>
                                        <h4 class="m-b-0"><?php echo $transactionDetails['total']?></h4>
                                    </li>
                                    <li class="list-inline-item">
                                        <h5 class="text-muted m-t-20 font-16">Successful Transactions</h5>
                                        <h4 class="m-b-0">$<b class="counter"><?php echo $transactionDetails['completed']?></b></h4>
                                    </li>
                                    <li class="list-inline-item">
                                        <h5 class="text-muted m-t-20 font-16">Refunded Transactions</h5>
                                        <h4 class="m-b-0">$<b class="counter"><?php echo $transactionDetails['retracted']?></b></h4>
                                    </li>
                                </ul>
                            </div>
                        </div>

                    </div>
              <!--   <div class="col-md-6 col-lg-6 col-xl-3">
                        <div class="widget-bg-color-icon card-box">
                            <div class="bg-icon bg-icon-success pull-left">
                                <i class="md md-list text-success"></i>
                            </div>
                            <div class="text-right">
                                <h3 class="text-dark"><b class="counter"><?php echo $transactionDetails['total']?></b></h3>
                                <p class="text-muted mb-0">Total Transactions</p>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>


                    <div class="col-md-6 col-lg-6 col-xl-3">
                        <div class="widget-bg-color-icon card-box fadeInDown animated">
                            <div class="bg-icon bg-icon-info pull-left">
                                <i class="md  md-attach-money  text-info"></i>
                            </div>
                            <div class="text-right">
                                <h3 class="text-dark">$<b class="counter"><?php echo $transactionDetails['completed']?></b></h3>
                                <p class="text-muted mb-0">Successful Amount</p>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>


                    <div class="col-md-6 col-lg-6 col-xl-3">
                        <div class="widget-bg-color-icon card-box">
                            <div class="bg-icon bg-icon-danger pull-left">
                                <i class="md md-block text-danger"></i>
                            </div>
                            <div class="text-right">
                                <h3 class="text-dark">$<b class="counter"><?php echo $transactionDetails['retracted']?></b></h3>
                                <p class="text-muted mb-0">Retracted Amount</p>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div> -->

              <!--       <div class="col-md-6 col-lg-6 col-xl-3">
                        <div class="widget-bg-color-icon card-box">
                            <div class="bg-icon bg-icon-success pull-left">
                                <i class="md md-attach-money text-success"></i>
                            </div>
                            <div class="text-right">
                                <h3 class="text-dark"><b class="counter"><?php echo $transactionDetails['total']?></b></h3>
                                <p class="text-muted mb-0">Total Transactions</p>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div> -->
                </div>