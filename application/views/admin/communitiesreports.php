    <?php $this->load->view('admin/header.php'); ?>
    <div class="main">
        <center><span><?php echo $this->session->flashdata('msg');?></span></center>
        <h3> Communities Reports List </h3>
        <table class="table table-condensed table-striped table-hover">
            <thead>
                <tr>
                    <th>S.No.</th>
                    <th>Community</th>
                    <th>Title</th>
                    <th>Reported To</th>
                    <th>Reported By</th>
                    <th>Message</th>
                    <th>Created Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="reportssearchresults">
                <?php if(isset($commreports) && ($commreports->num_rows() > 0)){ $i = 1; foreach($commreports->result() as $commreport){ ?>
                    <tr>
                        <td>#<?php echo $i;?></td>
                        <?php $redirecturl = '#'; ?>
                        <td><?php echo $commreport->gener;?></td>
                        <td><a href="<?php echo $redirecturl;?>">
                                <?php if(isset($commreport->title) && !empty($commreport->title)){ echo $commreport->title;
                                }else{ echo $commreport->typeoftype; } ?>
                            </a>
                        </td>
                        <td><?php echo $commreport->postedtoname.' '.$commreport->postedtolastname;?></td>
                        <td><?php echo $commreport->reported_by;?></td>
                        <td><?php echo $commreport->report_msg;?></td>
                        <td><?php echo substr($commreport->created_at,0,10);?></td>
                        <td>
                            <?php if($commreport->commstorystatus == 'block'){ ?>
                            <a href="<?php echo base_url();?>index.php/<?php echo $this->uri->segment(1);?>/unblockcommreportstory/<?php echo $commreport->comm_story_id;?>"> Unblock </a>
                            <?php }else{ ?>
                            <a href="<?php echo base_url();?>index.php/<?php echo $this->uri->segment(1);?>/blockcommreportstory/<?php echo $commreport->comm_story_id;?>"> Block </a>
                            <?php } ?>
                            <a href="<?php echo base_url();?>index.php/<?php echo $this->uri->segment(1);?>/deletecommreportstory/<?php echo $commreport->comm_story_id;?>" onclick="return confirm('Are you sure? Do you want to Delete?')"> Delete </a>
                        </td>
                    </tr>
                <?php $i++; } } ?>
            </tbody>
        </table>
    </div>
    <?php $this->load->view('admin/footer.php'); ?>