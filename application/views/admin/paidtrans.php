    <?php $this->load->view('admin/header.php'); ?>
    <div class="main">
        <center><span><?php echo $this->session->flashdata('msg');?></span></center>
        <h3> Paid Transaction List </h3>
        <table id="tblpagination" class="display table table-condensed table-striped table-hover">
            <thead>
                <tr>
                    <th>S.No.</th>
                    <th>Profile Name</th>
                    <th>Contact Details</th>
                    <th>Payment Type</th>
                    <th>Bank Details</th>
                    <th>Total Earnings</th>
                    <th>Paid Amount</th>
                    <th>Requested Amount</th>
                    <th>Requested Date</th>
                </tr>
            </thead>
            <tbody>
                <?php if(isset($transreqs) && ($transreqs->num_rows() > 0)){ $i=1; foreach($transreqs->result() as $transreqrow){ ?>
                    <tr>
                        <td>#<?php echo $i;?></td>
                        <td><?php echo $transreqrow->profile_name;?></td>
                        <td><?php echo '<b>Name :</b>'.$transreqrow->name.' '.$transreqrow->lastname.'<br>'.
                            '<b> Email :</b>'.$transreqrow->email.'<br><b> Phone :</b>'.$transreqrow->phone; ?>
                        </td>
                        <td><?php echo $transreqrow->paymenttype;?></td>
                        <td>
                            <?php if($transreqrow->paymenttype == 'bankaccount'){
                            echo '<b> Payment Type: </b>'.ucfirst($transreqrow->paymenttype).'<br>'.
                                '<b>Bank Account Number: </b>'.$transreqrow->accountno.'<br>'.
                                '<b>IFSC Code: </b>'.$transreqrow->ifsccode.'<br>'.
                                '<b>Bank Name Code: </b>'.$transreqrow->bankname.'<br>'.
                                '<b>Name of BAnk Account: </b>'.$transreqrow->accounteename;
                            }else if($transreqrow->paymenttype == 'paytm'){
                            echo '<b> Payment Type: </b>'.ucfirst($transreqrow->paymenttype).'<br>'.
                                '<b>Paytm Number: </b>'.$transreqrow->paytmphone.'<br>';
                            }else if($transreqrow->paymenttype== 'googlepay'){
                            echo '<b> Payment Type: </b>'.ucfirst($transreqrow->paymenttype).'<br>'.
                                '<b>Google pay Number: </b>'.$transreqrow->googlepayphone.'<br>';
                            } ?>
                        </td>
                        <td><?php echo $transreqrow->total_earnings;?></td>
                        <td><?php echo $transreqrow->paid_amount;?></td>
                        <td><?php echo $transreqrow->amount;?></td>
                        <td><?php echo substr($transreqrow->created_at,0,10);?></td>
                    </tr>
                <?php $i++; } } ?>
            </tbody>
        </table>
    </div>
    
    <?php $this->load->view('admin/footer.php'); ?>