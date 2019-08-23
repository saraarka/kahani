    <?php $this->load->view('admin/header.php'); ?>
    <div class="main">
        <center><span><?php echo $this->session->flashdata('msg');?></span></center>
        <h3> Reports List 
            <span class="pull-right" id="reportssearch">
                Filter: 
                        <select class="form-control" id=" "> 
                            <option value=""> Filter By </option>
                            <option value="story"> Stories </option>
                            <option value="series"> Series </option>
                            <option value="life"> Life Events </option>
                            <option value="nano"> Nano Stories </option>
                        </select>
            </span>
        </h3>
        <table class="table table-condensed table-striped table-hover">
            <thead>
                <tr>
                    <th>S.No.</th>
                    <th>Title</th>
                    <th>Reported To</th>
                    <th>Reported By</th>
                    <th>Reported on</th>
                    <th>Message</th>
                    <th>Created Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="reportssearchresults">
                <?php if(isset($storiescmtreports) && ($storiescmtreports->num_rows() > 0)){ $i = 1; 
                    foreach($storiescmtreports->result() as $storiescmtreport){ ?>
                    <tr>
                        <td>#<?php echo $i;?></td>
                        <?php if(isset($storiescmtreport->type) && (($storiescmtreport->type == 'story') || ($storiescmtreport->type == 'life'))){
                                $redirecturl = base_url().'index.php/'.$this->uri->segment(1).'/only_story_view?id='.$storiescmtreport->story_id;
                            }elseif(isset($storiescmtreport->type) && ($storiescmtreport->type == 'series')){
                                 $redirecturl = base_url().'index.php/'.$this->uri->segment(1).'/new_series?id='.$storiescmtreport->story_id.'&story_id='.$storiescmtreport->story_id;
                            }else{ $redirecturl = '#'; } ?>
                        <td><a href="<?php echo $redirecturl;?>" target="_blank"><?php echo $storiescmtreport->title;?></a></td>
                        <td><?php echo $storiescmtreport->postedtoname.' '.$storiescmtreport->postedtolastname;?></td>
                        <td><?php echo $storiescmtreport->reported_by;?></td>
                        <td><?php echo $storiescmtreport->type;?></td>
                        <td><?php echo $storiescmtreport->report_msg;?></td>
                        <td><?php echo substr($storiescmtreport->created_at,0,10);?></td>
                        <td>
                            <a href="<?php echo base_url();?>index.php/<?php echo $this->uri->segment(1);?>/unblockstorycmtreport/<?php echo $storiescmtreport->story_id;?>"> Unblock </a>
                            <a href="<?php echo base_url();?>index.php/<?php echo $this->uri->segment(1);?>/blockstorycmtreport/<?php echo $storiescmtreport->story_id;?>"> Block </a>
                            <a href="<?php echo base_url();?>index.php/<?php echo $this->uri->segment(1);?>/deletestorycmtreport/<?php echo $storiescmtreport->id;?>" onclick="return confirm('Are you sure? Do you want to Delete?')"> Delete </a>
                        </td>
                    </tr>
                <?php $i++; } } ?>
            </tbody>
        </table>
    </div>
    <?php $this->load->view('admin/footer.php'); ?>