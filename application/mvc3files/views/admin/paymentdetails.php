    <?php $this->load->view('admin/header.php'); ?>
    <div class="main">
        <center><span><?php echo $this->session->flashdata('msg');?></span></center>
        <h3> Users Payment Details </h3>

        <table id="tblpagination" class="display table table-condensed table-striped table-hover">
            <thead>
                <tr>
                    <th>S.No.</th>
                    <th>Profile Name</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Payment Details</th>
                    <th>Language</th>
                    <th>Status</th>
                    <th>Monetisation</th>
                </tr>
            </thead>
            <tbody id="ausersearchsortresult">
                <?php $emaillist = array(); $i = 1; 
                    if(isset($paymentdetails) && ($paymentdetails->num_rows() > 0)){foreach($paymentdetails->result() as $paymentrow){ 
                        array_push($emaillist, $paymentrow->email);  ?>
                    <tr>
                        <td><?php echo $i;?></td>
                        <td><?php echo $paymentrow->profile_name; ?></td>
                        <td><?php echo $paymentrow->name.' '.$paymentrow->lastname; ?>
                        </td>
                        <td><?php echo $paymentrow->email;?></td>
                        <td><?php echo $paymentrow->phone;?></td>
                        <td>
                            <?php if($paymentrow->paymenttype1 == 'paytm'){
                                echo '<u>Paytm : </u>'.$paymentrow->paytmphone.'<br>';
                            }if($paymentrow->paymenttype2 == 'bankaccount'){
                            echo '<u>Bank Account : </u> Bank Name : '.$paymentrow->bankname,' , Account Number : '.$paymentrow->accountno.' , IFSC Code : '.$paymentrow->ifsccode.' , Branch Name : '.$paymentrow->branchname.' , Account holder Name : '.$paymentrow->accounteename.'<br>';
                            }if($paymentrow->paymenttype2 == 'googlepay'){
                                echo '<u>Google Pay: </u>'.$paymentrow->googlepayphone.'<br>';
                            } ?>
                        </td>
                        <td><?php echo $paymentrow->writer_language;?></td>
                        <td><?php echo $paymentrow->admin_verify; ?></td>
                        <td><?php echo $paymentrow->monetisation;?></td>
                        
                    </tr>
                <?php $i++; } } ?>
            </tbody>
        </table>
    </div>
    
    <?php $this->load->view('admin/footer.php'); ?>