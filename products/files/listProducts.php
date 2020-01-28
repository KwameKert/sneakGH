
                <div class="row m-b-30">
				<?php echo $product->listProducts(); ?>
                 
                </div> <!-- End row -->


                <div  class="modal fade myModal bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;" >
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title mt-0" id="myModalLabel">Enter card details</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                            		<div class="col-12">
    	   <div class="card">
            <div class="card-body">
                <form id="transactionForm">
                     <div align="center" id="loader" style="display:none" >
                        <img src="../assets/images/loader.gif" width="50px" height="50px"  alt=""> Please wait
                      </div>
                    <div class="form-group owner">
                        <label for="owner">Owner</label>
                        <input type="text" class="form-control" id="owner">
                    </div>
                    <div class="row">
                        <div class="col-8">
                           <div class="form-group" id="card-number-field">
                        <label for="cardNumber">Card Number</label>
                        <input type="text" class="form-control" id="cardNumber">
                    </div> 
                        </div>
                        <div class="col-4">
                         

                     <div class="form-group CVV">
                        <label for="cvv">CVV</label>
                        <input type="text" class="form-control" id="cvv">
                    </div>  
                        </div>
                    </div>
                    
                    
                    <div class="form-group" id="expiration-date">
                        <label>Expiration Date</label>
                        <div class="row">
                            <div class="col-6">
                               <select class="form-control">
                            <option value="01">January</option>
                            <option value="02">February </option>
                            <option value="03">March</option>
                            <option value="04">April</option>
                            <option value="05">May</option>
                            <option value="06">June</option>
                            <option value="07">July</option>
                            <option value="08">August</option>
                            <option value="09">September</option>
                            <option value="10">October</option>
                            <option value="11">November</option>
                            <option value="12">December</option>
                        </select> 
                            </div>
                            <div class="col-6">
                              <select class="form-control">
                            <option value="16"> 2016</option>
                            <option value="17"> 2017</option>
                            <option value="18"> 2018</option>
                            <option value="19"> 2019</option>
                            <option value="20"> 2020</option>
                            <option value="21"> 2021</option>
                        </select>  
                            </div>
                        </div>
                        
                        
                    </div>
                    <div class="row">
                        
                        

                        <div class="col-6 mt-4">
                            <div class="form-group" id="credit_cards">
                        <img src="../assets/images/visa.jpg" id="visa">
                        <img src="../assets/images/mastercard.jpg" id="mastercard">
                        <img src="../assets/images/amex.jpg" id="amex">
                    </div>
                        </div>
                    </div>
                    
                    <button class="btn btn-block btn-lg btn-primary waves-effect waves-light" type="" id="confirm-purchase">Deposit</button>
                    <input type="hidden" name="action" value="deposit">
                    <input type="hidden" name="product_id" id="product_id" value="">
                    <input type="hidden" name="amount" id="amount" value="">
                </form>

            </div>   
           </div>
          
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Cancel</button>
                                            
                                        </div>
                                    </div><!-- /.modal-content -->
                                </div><!-- /.modal-dialog -->
                            </div>