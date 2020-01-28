
                <div class="row">
                    <div class="col-12 mt-3">
                        <div class="card-box table-responsive">
                            <h4 class="m-t-0 header-title"><b>Transactions</b></h4>
                            <p class="text-muted font-13 m-b-30">
                                All your transactions are below.
                            </p>

                            <table id="datatable" class="table table-bordered">
                                <thead>
                                <tr>
                                    <th style="text-align: center;">#</th>
                                     <th style="text-align: center;">Product Name</th>
                                    <th style="text-align: center;">Invoice ID</th>
                                    <th style="text-align: center;">Amount($)</th>
                                    <th style="text-align: center;">Status</th>
                                    <th style="text-align: center;">Date created</th>
                                    <th style="text-align: center;">Action</th>
                                </tr>
                                </thead>


                                <tbody>
                    			<?php echo $transaction->myTransactions() ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div> <!-- end row -->
