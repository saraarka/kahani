<?php if(isset($accountdetails, $paymenttype) && ($accountdetails->num_rows() == 1) && !empty($paymenttype)){
    if($paymenttype == 'paytm'){ foreach($accountdetails->result() as $accountdetail){ ?>
        <input type="number" name="paytmphone" value="<?php echo $accountdetail->paytmphone;?>" placeholder="Paytm Number" class="form-control" required minlength="10" readonly>
        <br>
        <center><button class="btn btn-primary" onclick="paymentdetailscheck('paytm')"> Send </button></center>
    <?php } } else if($paymenttype == 'bankaccount'){ foreach($accountdetails->result() as $accountdetail){ ?>
        <input type="text" value="<?php echo $accountdetail->accounteename;?>" name="accounteename" placeholder="Bank Account Holder Name" class="form-control" style="margin-bottom:6px;" required readonly>
        <input type="number" value="<?php echo $accountdetail->accountno;?>" name="accountno" placeholder="Bank Account Number" class="form-control" style="margin-bottom:6px;" required readonly>
        <input type="text" value="<?php echo $accountdetail->ifsccode;?>" name="ifsccode" placeholder="IFSC CODE" class="form-control" style="margin-bottom:6px;" required readonly>
        <input type="text" value="<?php echo $accountdetail->bankname;?>" name="bankname" placeholder="Bank Name" class="form-control"  style="margin-bottom:6px;" required readonly>
        <input type="text" value="<?php echo $accountdetail->branchname;?>" name="branchname" placeholder="Branch Name" class="form-control" style="margin-bottom:6px;" required readonly>
        <br>
        <center><button class="btn btn-primary" onclick="paymentdetailscheck('bankaccount')"> Send </button></center>
    <?php } } else if($paymenttype == 'googlepay'){ foreach($accountdetails->result() as $accountdetail){ ?>
        <input type="number" name="googlepayphone" value="<?php echo $accountdetail->googlepayphone;?>" placeholder="Google Pay Number" class="form-control" required minlength="10" readonly>
        <br>
        <center><button class="btn btn-primary" onclick="paymentdetailscheck('googlepay')"> Send </button></center>
    <?php } } ?>
<?php } ?>