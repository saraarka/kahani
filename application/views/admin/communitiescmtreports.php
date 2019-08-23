    <?php $this->load->view('admin/header.php'); ?>
    <div class="main">
        <center><span><?php echo $this->session->flashdata('msg');?></span></center>
        <h3> Communities comments Reports List </h3>
        <table class="table table-condensed table-striped table-hover">
            <thead>
                <tr>
                    <th>S.No.</th>
                    <th>Comment</th>
                    <th>Reported To</th>
                    <th>Reported By</th>
                    <th>Message</th>
                    <th>Created Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="reportssearchresults">
                <?php if(isset($communitiescmtreports) && ($communitiescmtreports->num_rows() > 0)){ $i = 1; 
                    foreach($communitiescmtreports->result() as $communitycmtrow){ ?>
                    <tr>
                        <td>#<?php echo $i;?></td>
                        <?php $redirecturl = '#'; ?>
                        <td><?php echo $communitycmtrow->comment;?></td>
                        <td><?php echo $communitycmtrow->postedtoname.' '.$communitycmtrow->postedtolastname;?></td>
                        <td><?php echo $communitycmtrow->reported_by;?></td>
                        <td><?php echo $communitycmtrow->report_msg;?></td>
                        <td><?php echo substr($communitycmtrow->created_at,0,10);?></td>
                        <td>
                            <?php if(isset($communitycmtrow->cmtstatus) && ($communitycmtrow->cmtstatus == 'block')){ ?>
                            <a href="<?php echo base_url();?>index.php/<?php echo $this->uri->segment(1);?>/unblockcommcmtreport/<?php echo $communitycmtrow->comment_id;?>"> Unblock </a>
                            <?php }else { ?>
                            <a href="<?php echo base_url();?>index.php/<?php echo $this->uri->segment(1);?>/blockcommcmtreport/<?php echo $communitycmtrow->comment_id;?>"> Block </a>
                            <?php } ?>
                            <a href="<?php echo base_url();?>index.php/<?php echo $this->uri->segment(1);?>/deletecommcmtreport/<?php echo $communitycmtrow->comment_id;?>" onclick="return confirm('Are you sure? Do you want to Delete?')"> Delete </a>
                        </td>
                    </tr>
                <?php $i++; } } ?>
            </tbody>
        </table>
    </div>
    <?php $this->load->view('admin/footer.php'); ?>