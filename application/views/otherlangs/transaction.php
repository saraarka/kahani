<link rel="stylesheet" href="<?php echo base_url();?>assets/css/transaction.css">
<div class="main-container">	
    <section class="mt-5">
		<div class="box box-widget boxv" style="box-shadow: 0 1px 1px 0 rgba(0,0,0,0.14), 0 2px 1px -1px rgba(0,0,0,0.12), 0 1px 3px 0 rgba(0,0,0,0.2);border-radius:3px;">
            <div class="title">
                <a href="#"  data-toggle="modal" data-target="#myModal"><i class="fa fa-question-circle"></i></a>
                <b>Monetisation :</b>
                
                <!-- /* Profile Monitize start */  -->
                <?php $defaultcheck =''; $monitize = 'Off'; $monetizereq = ''; $totalearnings = 0; $tobe_payamount = 0; $monitizestatus = '';
                if(isset($transactions) && ($transactions->num_rows() == 1)){
                    foreach($transactions->result() as $transrow) {
                        $totalearnings = $transrow->total_earnings;
                        $tobe_payamount = $transrow->tobe_payamount;
                        if(($transrow->mstatus == 'monitize') && ($transrow->monetisation == 'yes')){
                            $monitizestatus = 'yes';
                        }
                        if($transrow->monetisation == 'yes'){
                            $defaultcheck = 'checked';
                            $monitize = 'On';
                        }/*if(($transrow->mstatus == 'not_requested') && ($transrow->monetisation == 'no')){
                            $monetizereq = '(Not Requested)';
                        }else */if(($transrow->mstatus == 'monitize') && ($transrow->monetisation == 'no')){
                            $monetizereq = '';
                            //$monetizereq = '(Requested for Monetisation)';
                        }else if(($transrow->mstatus == 'unmonitize') && ($transrow->monetisation == 'yes')){
                            $monetizereq = '';
                            //$monetizereq = '(Request sent to remove Monetisation)';
                        }
                    }
                } ?>
                <label class="switch"> <input type="checkbox" id="monetisation" <?php echo $defaultcheck; ?>>
                    <span class="slider"></span></label> &nbsp; <span class="monetisation"><?php echo $monitize;?></span>
                    <span class="monetizereq"> <?php echo $monetizereq; ?> </span>
                <!-- /* Profile Monitize end */  -->
                    
                <span class="pull-right">
                  <!-- <a href="javascript:void(0)" onclick="viewtrans();"> <i class="fa fa-cogs"></i></a>-->
                   <a data-toggle="modal" href="" data-target="#cog" title="SUGGEST"> <i class="fa fa-cogs"></i></a>
                </span>
            </div><br>
		            
            <div class="">
                <p>STORIES <a href="#" data-toggle="modal" data-target="#myModal"><i class="fa fa-question-circle"></i></a>
                    <span class="pull-right">
                        TOTAL READS
                    </span>
                </p>
            </div><hr>
            <div>
	            <?php if(isset($transstories) && ($transstories->num_rows() > 0)){ 
	                foreach($transstories->result() as $transrowstory){ ?>
		                <?php if(($transrowstory->pay_story == "Y") && ($transrowstory->smonetisation == "yes") ){ ?>
        	            <label class="switch">
        	                    <input type="checkbox" class="checkrow" checked value="<?php echo $transrowstory->sid;?>" id="rowid<?php echo $transrowstory->sid;?>">
                                <span class="slider"></span>
                            </label>
                            <span class="titlet"> <?php echo $transrowstory->title;?> </span>
                            <span class="checkrow<?php echo $transrowstory->sid;?>" style="color:blue;font-size:10px;line-height: 2.3!important; margin:0; line-height:unset;"> ENABLE </span>
                        <?php } else if(($transrowstory->pay_story == "Y") && ($transrowstory->smonetisation == "no") ){ ?>
                            <label class="switch">
        	                    <input type="checkbox" class="checkrow" checked value="<?php echo $transrowstory->sid;?>" id="rowid<?php echo $transrowstory->sid;?>">
                                <span class="slider"></span>
                            </label>
                            <span> <?php echo $transrowstory->title;?> </span>
                            <span class="checkrow<?php echo $transrowstory->sid;?>" style="color:#ff0000;font-size:10px;line-height: 2.3!important; margin:0; line-height:unset;"> PROCESSING </span>
                        <?php } else if(($transrowstory->pay_story == "N") && ($transrowstory->smonetisation == "yes") ){ ?>
                            <label class="switch">
        	                    <input type="checkbox" class="checkrow" value="<?php echo $transrowstory->sid;?>" id="rowid<?php echo $transrowstory->sid;?>">
                                <span class="slider"></span>
                            </label>
                            <span  class="titlet"> <?php echo $transrowstory->title;?> </span>
                            <span class="checkrow<?php echo $transrowstory->sid;?>" style="color:#f39c12;font-size:10px;line-height: 2.3!important; margin:0; line-height:unset;"> DISABLE PROCESSING</span>
                        <?php } else { ?>
                        
                            <label class="switch">
        	                    <input type="checkbox" class="checkrow" value="<?php echo $transrowstory->sid;?>" id="rowid<?php echo $transrowstory->sid;?>">
                                <span class="slider"></span>
                            </label>
                            <span class="titlet"> <?php echo $transrowstory->title;?> </span>
                            <span class="checkrow<?php echo $transrowstory->sid;?>" style="color:#777;font-size:10px;line-height: 2.3!important; margin:0; line-height:unset;"> DISABLE </span>
                        <?php } ?>
                        <span class="pull-right"> <?php echo $transrowstory->uvcount;?> </span><hr>
    		    <?php } } ?>
            </div>
                            
            <div>
                <span class="pull-right">
                    <a href="#"  data-toggle="modal" data-target="#myModal"><i class="fa fa-question-circle"></i></a>
                    <span>TOTAL EARNINGS : <?php echo $totalearnings;?></span><br>
                    <a href="javascript:void(0);" class="pull-right" style="font-size:12px;" onclick="viewtrans();" data-toggle="modal" data-target="#viewtrans">
                        <small>VIEW TRANSACTIONS</small>
                    </a>
                </span><br><br>
	            
                <span class="pull-right">
                    <a href="#"  data-toggle="modal" data-target="#myModal"><i class="fa fa-question-circle"></i></a>
                    <span>BALANCE : <?php echo $tobe_payamount;?></span><br>
                </span>
            </div>
            <div style="margin-top:35px;">
                <center>
	                <span class="">
	                    <a href="#"  data-toggle="modal" data-target="#myModal"><i class="fa fa-question-circle" style="font-size:18px;"></i></a>
	                    <?php if(($tobe_payamount >= 100) && ($monitizestatus == 'yes')){ ?>
	                        <button class="btn btn-primary" onclick="receivemoneyreq();">RECEIVE MONEY</button>
	                    <?php }else if(($tobe_payamount >= 100) && ($monitizestatus != 'yes')){ ?>
	                        <button class="btn btn-primary" onclick="usernotmonitize();" style="opacity: 0.5;">RECEIVE MONEY</button>
	                    <?php }else { ?>
	                        <button class="btn btn-primary" onclick="minbalance();" style="opacity: 0.5;">RECEIVE MONEY</button>
	                    <?php } ?>
	                </span>
                </center>
            </div>
        </div>
        <div class="clearfix"></div>
    </section>
</div>

<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" style="margin-top:4px;">&times;</button>
                <h4 class="modal-title">Header</h4>
            </div>
            <div class="modal-body">
                <p>Some text.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!--<div id="viewtrans" class="modal fade" role="dialog" style="padding-right:0!important">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" style="margin-top:4px; color:#000; opacity:initial;">&times;</button>
                <h4 class="modal-title">View Transactions</h4>
            </div>
            <div class="modal-body">
                <div style="display:flex;border-bottom: 1px solid #ddd;">
                    <div class="viewt">
                        <p class="pull-left"><b>PAYMENT SOURCE</b></p>
                    </div>
                    <div class="viewt" style="text-align:center;">
                        <b>DATE</b>
                    </div>
                    <div class="viewt">
                        <p class="pull-right"><b>AMOUNT</b></p>
                    </div>
                </div>
                <div style="display:flex;border-bottom: 1px solid #ddd; margin-top:9px;">
                    <div class="viewt">
                        <p class="pull-left">Payment Source</p>
                    </div>
                    <div class="viewt" style="text-align:center;">
                        Date
                    </div>
                    <div class="viewt">
                        <p class="pull-right">Amount</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> -->

<div id="receivemoneyreq" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" style="margin-top:4px;">&times;</button>
                <h4 class="modal-title">Receive Money Request</h4>
            </div>
            <div class="modal-body">
                <h4>Select Payment Type</h4>
                <label class="radio-inline"><input type="radio" name="paymenttype" value="paytm"> To Paytm </label>
                <label class="radio-inline"><input type="radio" name="paymenttype" value="bankaccount">To Bank Account</label>
                <label class="radio-inline"><input type="radio" name="paymenttype" value="googlepay">Google Pay</label>
                <div id="paymentdetails"></div>
            </div>
        </div>
    </div>
</div>

<div id="viewtrans" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" style="margin-top:4px;">&times;</button>
                <h4 class="modal-title">View Transactions</h4>
            </div>
            <div class="modal-body">
                <table class="table table-striped table-hovered">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Payment Source</th>
                            <th>Amount</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody id="translist"></tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    $(function() {
        $('input[name="paymenttype"]').change(function() {
            var paymenttype = $(this).val();
            $.ajax({
                type: "POST",
                url: "<?php echo base_url().$this->uri->segment(1);?>/paymenttype",
                data: {'paymenttype': paymenttype},
                success: function(data) {
                    if(data){
                        $('#paymentdetails').html(data);
                    }else{
                        $('#snackbar').text('Please select Payment Type.').addClass('show');
    				    setTimeout(function(){ $('#snackbar').removeClass('show'); }, 4000);
                    }
                }
        	});
        });
    });
    function paymentdetailscheck(value){
        var paymenttype = $("input[name='paymenttype']:checked").val();
        if((paymenttype) && (value)){
            $.ajax({
                type: "POST",
                url: "<?php echo base_url().$this->uri->segment(1);?>/paymentdetailscheck",
                data: {'paymenttype': value},
                dataType: 'json',
                success: function(result) {
                    if((result.status == 1) && (result.response == 'success')){
                        $('#paymentdetails').html('<center><button class="btn btn-danger" onclick="requestformoney();">Request for Money</button></center>');
                    }else{
        			    $('#snackbar').text('Something wrong. Try Again').addClass('show');
                        setTimeout(function(){ $('#snackbar').removeClass('show'); }, 4000);
                        setTimeout(function(){ location.reload(); }, 3000);
        			}
                }
            });
        }else{
            $('#snackbar').text('Try Again').addClass('show');
            setTimeout(function(){ $('#snackbar').removeClass('show'); }, 3000);
            setTimeout(function(){ location.reload(); }, 3100);
        }
    }
    $( document ).ready(function() {
        $("form#paytmform").on( "submit", function( event ) {
            event.preventDefault();
            $.ajax({
                type: "POST",
                url: "<?php echo base_url().$this->uri->segment(1);?>/paymentdetails",
                data: $("form#paytmform").serialize(),
                dataType: 'json',
                success: function(result) {
                    $('span.text-danger').text('');
                    if(result.status == -1){
        				$.each(result.validations,function (p,q){
        					$('span.'+p).text(q);
        				});
        			}else if((result.status == 1) && (result.response == 'success')){
        			    $('#snackbar').text('Account details added successfully').addClass('show');
        				setTimeout(function(){ $('#snackbar').removeClass('show'); }, 5000);
        				setTimeout(function(){ location.reload(); }, 3000);
        			}else{
        			    $('#snackbar').text('Something wrong. Try Again').addClass('show');
                        setTimeout(function(){ $('#snackbar').removeClass('show'); }, 4000);
                        setTimeout(function(){ location.reload(); }, 3000);
        			}
                }
            });
        });
        $("form#googlepayform").on( "submit", function( event ) {
            event.preventDefault();
            $.ajax({
                type: "POST",
                url: "<?php echo base_url().$this->uri->segment(1);?>/paymentdetails",
                data: $("form#googlepayform").serialize(),
                dataType: 'json',
                success: function(result) {
                    $('span.text-danger').text('');
                    if(result.status == -1){
        				$.each(result.validations,function (p,q){
        					$('span.'+p).text(q);
        				});
        			}else if((result.status == 1) && (result.response == 'success')){
        			    $('#snackbar').text('Account details added successfully').addClass('show');
        				setTimeout(function(){ $('#snackbar').removeClass('show'); }, 5000);
        				setTimeout(function(){ location.reload(); }, 3000);
        			}else{
        			    $('#snackbar').text('Something wrong. Try Again').addClass('show');
                        setTimeout(function(){ $('#snackbar').removeClass('show'); }, 4000);
                        setTimeout(function(){ location.reload(); }, 3000);
        			}
                }
            });
        });
        $("form#bankaccountform").on( "submit", function( event ) {
            event.preventDefault();
            $.ajax({
                type: "POST",
                url: "<?php echo base_url().$this->uri->segment(1);?>/paymentdetails",
                data: $("form#bankaccountform").serialize(),
                dataType: 'json',
                success: function(result) {
                    $('span.text-danger').text('');
                    if(result.status == -1){
        				$.each(result.validations,function (p,q){
        					$('span.'+p).text(q);
        				});
        			}else if((result.status == 1) && (result.response == 'success')){
        			    $('#snackbar').text('Account details added successfully').addClass('show');
        				setTimeout(function(){ $('#snackbar').removeClass('show'); }, 5000);
        				setTimeout(function(){ location.reload(); }, 3000);
        			}else{
        			    $('#snackbar').text('Something wrong. Try Again').addClass('show');
                        setTimeout(function(){ $('#snackbar').removeClass('show'); }, 4000);
                        setTimeout(function(){ location.reload(); }, 3000);
        			}
                }
            });
        });
    });
    
    function requestformoney(){
        var paymenttype = $("input[name='paymenttype']:checked").val();
        $.ajax({
            type: "POST",
            url: "<?php echo base_url().$this->uri->segment(1);?>/requestformoney",
            data: {'paymenttype': paymenttype},
            success: function(data) {
                if(data == 1){
                    $('#snackbar').text('Request sent successfully').addClass('show');
			        setTimeout(function(){ $('#snackbar').removeClass('show'); }, 4000);
			        $('#receivemoneyreq').modal('hide');
                }else{
                    $('#snackbar').text('request sent already').addClass('show');
                    setTimeout(function(){ $('#snackbar').removeClass('show'); }, 4000);
                    $('#receivemoneyreq').modal('hide');
                }
            }
    	});
    }
    function minbalance(){
        $('#snackbar').text('You should have minimum balance 100 rupess to request').addClass('show');
		setTimeout(function(){ $('#snackbar').removeClass('show'); }, 8000);
    }
    function usernotmonitize(){
        $('#snackbar').text('You should Monitize to request').addClass('show');
		setTimeout(function(){ $('#snackbar').removeClass('show'); }, 4000);
    }
</script>

<script>
    $("#monetisation").change(function() {
        if($(this).prop('checked')) {
            //monitize req alert("Checked Box Selected"); //check checkbox
            $.ajax({
                type: "POST",
                url: "<?php echo base_url().$this->uri->segment(1);?>/monitizeonreq",
                success: function(data) {
                    if(data == 2){
                        $('#monetisation').prop('checked','');
                        $('#snackbar').text('You Should have minimum 50 Followers and more than 3 writing to Monitize.').addClass('show');
    				    setTimeout(function(){ $('#snackbar').removeClass('show'); }, 8000);
                    }else if(data == 1){
                        $('.monetizereq').text('(Requested for Monetisation)');
                        $('#snackbar').text('Monitisation request sent Successfully.').addClass('show');
    				    setTimeout(function(){ $('#snackbar').removeClass('show'); }, 5000);
                    }else{
                        $('#monetisation').prop('checked','');
                        $('#snackbar').text('Already requested.').addClass('show');
    				    setTimeout(function(){ $('#snackbar').removeClass('show'); }, 3000);
                    }
                }
        	});
        } else {
            //unmonitize req // alert("Checked Box deselect"); //uncheck checkbox
            $.ajax({
                type: "POST",
                url: "<?php echo base_url().$this->uri->segment(1);?>/monitizeoffreq",
                success: function(data) {
                    if(data == 1){
                        $('.monetizereq').text('(Request sent to remove Monetisation)');
                        $('#snackbar').text('Request sent success to remove the Monitisation.').addClass('show');
    				    setTimeout(function(){ $('#snackbar').removeClass('show'); }, 6000);
                    }else{
                        $('#snackbar').text('Failed to sent request to remove Monitisation.').addClass('show');
    				    setTimeout(function(){ $('#snackbar').removeClass('show'); }, 6000);
                    }
                }
        	});
        }
    });
    
    $(".checkrow").click(function () {
        var storyid = $(this).val();
        if($(this).prop('checked')) {
            $.ajax({
                type: "POST",
                url: "<?php echo base_url().$this->uri->segment(1);?>/storymonitizeonreq",
                data: { 'storyid': storyid},
                success: function(data) {
                    if(data == 1){
                        $('.checkrow'+storyid).text('PROCESSING').css('color','#ff0000');
                        $('#snackbar').text('Story Monitisation requested successfully.').addClass('show');
    				    setTimeout(function(){ $('#snackbar').removeClass('show'); }, 5000);
                    }else{
                        $('#rowid'+storyid).prop('checked','');
                        $('#snackbar').text('Failed to request Story Monitisation').addClass('show');
    				    setTimeout(function(){ $('#snackbar').removeClass('show'); }, 5000);
                    }
                }
        	});
        }else{ // switch is on in blue color so uncheck checkbox goses here
            $.ajax({
                type: "POST",
                url: "<?php echo base_url().$this->uri->segment(1);?>/storymonitizeoffreq",
                data: { 'storyid': storyid},
                success: function(data) {
                    if(data == 1){
                        $('.checkrow'+storyid).text('DISABLE').css('color','#777');
                        $('#snackbar').text('Story Monitisation removed successfully.').addClass('show');
    				    setTimeout(function(){ $('#snackbar').removeClass('show'); }, 5000);
                    }else{
                        $('#snackbar').text('Failed to remove Story Monitisation').addClass('show');
    				    setTimeout(function(){ $('#snackbar').removeClass('show'); }, 4000);
                    }
                }
        	});
        }
    });
    
    function receivemoneyreq(){
        $('#receivemoneyreq').modal('show');
    }
    
    function viewtrans(){
        $.ajax({
            type: "POST",
            url: "<?php echo base_url().$this->uri->segment(1);?>/translist",
            dataType: 'json',
            success: function(data) {
                if(data != 0){
                    var trans = '';
                    $.each(data,function (p,q){
    					trans+='<tr><td>'+(q.created_at).substr(0,10)+'</td><td>'+q.paymenttype+'</td><td>'+q.amount+'</td><td>'+q.status+'</td></tr>';
    				});
                    $('#translist').html(trans);
                    $('#viewtrans').modal('show');
                }else{
                    $('#snackbar').text('No transactions were found').addClass('show');
    				setTimeout(function(){ $('#snackbar').removeClass('show'); }, 4000);
                }
            }
    	});
    }
</script>
<style>
    .nav-tabs-custom>.nav-tabs>li>a, .nav-tabs-custom>.nav-tabs>li>a:hover {
    background: transparent;
    margin: 0;
    color: #000;
}
</style>
<div class="modal fade" id="cog" role="dialog" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
		    <div class="nav-tabs-custom" style="margin-bottom:0; border-radius:5px;">
				<ul class="nav nav-tabs">
					<li class="active"><a href="#paytm" data-toggle="tab">PAYTM</a></li>
					<li><a href="#google" data-toggle="tab">Google Pay</a></li>
					<li><a href="#bank" data-toggle="tab">Bank</a></li>
					<li style="float:right; padding-right:15px;"><button type="button" class="close" data-dismiss="modal" style="margin-top:10px;">&times;</button></li>
				</ul>
				<div class="tab-content" style="padding:0px;background: #ecf0f5;border-radius:5px;">
    			    <div class="tab-pane active" id="paytm" style="padding:10px;background:#fff;border-radius:5px;">
    			        <form id="paytmform">
        			        <h2>Paytm Details</h2>
        			        <div style="margin:10px 0">
        			            <input type="hidden" name="paymenttype" value="paytm">
        			            <input type="number" name="paytmphone" placeholder="Paytm Number" class="form-control" required minlength="10">
        			            <span class="text-danger paytmphone"></span>
        			        </div>
        			        <div style="margin:10px 0 0">
        			            <center>
        			                <button type="submit" class="btn btn-primary">Update</button>
        			            </center>
        			        </div>
    			        </form>
    			    </div>
    			    <div class="tab-pane" id="google" style="padding:10px;background:#fff;border-radius:5px;">
    			        <h2>Google Pay Details</h2>
    			        <form id="googlepayform">
        			        <div style="margin:10px 0">
        			            <input type="hidden" name="paymenttype" value="googlepay">
        			            <input type="number" name="googlepayphone" placeholder="Google Pay Number" class="form-control" required minlength="10">
        			            <span class="text-danger googlepayphone"></span>
        			        </div>
        			        <div style="margin:10px 0 0">
        			            <center>
        			                <button type="submit" class="btn btn-primary">Update</button>
        			            </center>
        			        </div>
        		        </form>
    			    </div>
    			    <div class="tab-pane" id="bank" style="padding:10px;background:#fff;border-radius:5px;">
    			        <h2>Bank Details</h2>
    			        <form id="bankaccountform">
        			        <div style="margin:10px 0">
        			            <input type="hidden" name="paymenttype" value="bankaccount">
        			            <input type="text" name="accounteename" placeholder="Bank Account Holder Name" class="form-control" style="margin-bottom:6px;" required>
        			            <span class="text-danger accounteename"></span>
        			            <input type="number" name="accountno" placeholder="Bank Account Number" class="form-control" style="margin-bottom:6px;" required>
        			            <span class="text-danger accountno"></span>
        			            <input type="text" name="ifsccode" placeholder="IFSC CODE" class="form-control" style="margin-bottom:6px;" required>
        			            <span class="text-danger ifsccode"></span>
        			            <input type="text" name="bankname" placeholder="Bank Name" class="form-control"  style="margin-bottom:6px;" required>
        			            <span class="text-danger bankname"></span>
        			            <input type="text" name="branchname" placeholder="Branch Name" class="form-control" required>
        			            <span class="text-danger branchname"></span>
        			        </div>
        			        <div style="margin:10px 0 0">
        			            <center>
        			                <button type="submit" class="btn btn-primary">Update</button>
        			            </center>
        			        </div>
        			    </form>
    			    </div>
    		    </div>
	        </div>
	    </div>
    </div>
</div>