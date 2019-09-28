    <?php $this->load->view('admin/header.php'); ?>
    <div class="main">
        <center><span><?php echo $this->session->flashdata('msg');?></span></center>
        <h3> Reports List 
            <span class="pull-right" id="reportssearch">
                Filter: 
                        <select class="form-control" id="reportstype"> 
                            <option value=""> Filter By </option>
                            <option value="story"> Stories </option>
                            <option value="series"> Series </option>
                            <option value="life"> Life Events </option>
                            <option value="nano"> Nano Stories </option>
                        </select>
            </span>
        </h3>
        <table id="tblpagination" class="display table table-condensed table-striped table-hover">
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
                <?php if(isset($reports) && ($reports->num_rows() > 0)){ $i = 1; foreach($reports->result() as $reportrow){ ?>
                    <tr>
                        <td><?php echo $i;?></td>
                        <?php if(isset($reportrow->type) && (($reportrow->type == 'story') || ($reportrow->type == 'life'))){
                                $redirecturl = base_url().'index.php/'.$this->uri->segment(1).'/only_story_view?id='.$reportrow->story_id;
                            }elseif(isset($reportrow->type) && ($reportrow->type == 'series')){
                                 $redirecturl = base_url().'index.php/'.$this->uri->segment(1).'/new_series?id='.$reportrow->story_id.'&story_id='.$reportrow->story_id;
                            }else{ $redirecturl = '#'; } ?>
                        <td><a href="<?php echo $redirecturl;?>" target="_blank"><?php echo $reportrow->title;?></a></td>
                        <td><?php echo $reportrow->postedtoname.' '.$reportrow->postedtolastname;?></td>
                        <td><?php echo $reportrow->reported_by;?></td>
                        <td><?php echo $reportrow->type;?></td>
                        <td><?php echo $reportrow->report_msg;?></td>
                        <td><?php echo substr($reportrow->created_at,0,10);?></td>
                        <td>
                            <?php if(isset($reportrow->storystatus) && ($reportrow->storystatus == 'block')){ ?>
                                <?php if(isset($reportrow->type) && (($reportrow->type == 'story') || ($reportrow->type == 'life') || ($reportrow->type == 'nano'))){ ?>
                                    <a href="<?php echo base_url();?>index.php/<?php echo $this->uri->segment(1);?>/unblockstory/<?php echo $reportrow->story_id;?>"> Unblock </a>
                                <?php } elseif(isset($reportrow->type) && ($reportrow->type == 'series')){ ?>
                                    <a href="<?php echo base_url();?>index.php/<?php echo $this->uri->segment(1);?>/unblockseries/<?php echo $reportrow->story_id;?>"> Unblock </a>
                                <?php } else { ?>
                                    <a href="#"> Unblock </a>
                                <?php } ?>
                            <?php }else{ ?>
                                <?php if(isset($reportrow->type) && (($reportrow->type == 'story') || ($reportrow->type == 'life') || ($reportrow->type == 'nano'))){ ?>
                                    <a href="<?php echo base_url();?>index.php/<?php echo $this->uri->segment(1);?>/blockstory/<?php echo $reportrow->story_id;?>"> Block </a>
                                <?php } elseif(isset($reportrow->type) && ($reportrow->type == 'series')){ ?>
                                    <a href="<?php echo base_url();?>index.php/<?php echo $this->uri->segment(1);?>/blockseries/<?php echo $reportrow->story_id;?>"> Block </a>
                                <?php } else { ?>
                                    <a href="#"> Block </a>
                                <?php } ?>
                            <?php } ?>
                            
                            <?php if(isset($reportrow->type) && (($reportrow->type == 'story') || ($reportrow->type == 'life') || ($reportrow->type == 'nano'))){ ?>
                                <a href="<?php echo base_url();?>index.php/<?php echo $this->uri->segment(1);?>/deletestory/<?php echo $reportrow->id;?>" onclick="return confirm('Are you sure? Do you want to Delete?')"> Delete </a>
                            <?php } elseif(isset($reportrow->type) && ($reportrow->type == 'series')){ ?>
                                <a href="<?php echo base_url();?>index.php/<?php echo $this->uri->segment(1);?>/deleteseries/<?php echo $reportrow->id;?>" onclick="return confirm('Are you sure? Do you want to Delete?')"> Delete </a>
                            <?php } else { ?>
                                <a href="#" onclick="return confirm('Are you sure? Do you want to Delete?')"> Delete </a>
                            <?php } ?>
                        
                        <!--<?php if(isset($reportrow->type) && (($reportrow->type == 'story') || ($reportrow->type == 'life') || ($reportrow->type == 'nano'))){ ?>
                            <a href="<?php echo base_url();?>index.php/<?php echo $this->uri->segment(1);?>/blockstory/<?php echo $reportrow->story_id;?>"> Block </a>
                        <?php } elseif(isset($reportrow->type) && ($reportrow->type == 'series')){ ?>
                            <a href="<?php echo base_url();?>index.php/<?php echo $this->uri->segment(1);?>/blockseries/<?php echo $reportrow->story_id;?>"> Block </a>
                        <?php } else { ?>
                            <a href="#"> Block </a>
                        <?php } ?>
                        <?php if(isset($reportrow->type) && (($reportrow->type == 'story') || ($reportrow->type == 'life') || ($reportrow->type == 'nano'))){ ?>
                            <a href="<?php echo base_url();?>index.php/<?php echo $this->uri->segment(1);?>/deletestory/<?php echo $reportrow->id;?>" onclick="return confirm('Are you sure? Do you want to Delete?')"> Delete </a>
                        <?php } elseif(isset($reportrow->type) && ($reportrow->type == 'series')){ ?>
                            <a href="<?php echo base_url();?>index.php/<?php echo $this->uri->segment(1);?>/deleteseries/<?php echo $reportrow->id;?>" onclick="return confirm('Are you sure? Do you want to Delete?')"> Delete </a>
                        <?php } else { ?>
                            <a href="#" onclick="return confirm('Are you sure? Do you want to Delete?')"> Delete </a>
                        <?php } ?> -->
                        </td>
                    </tr>
                <?php $i++; } } ?>
            </tbody>
        </table>
    </div>
    <?php $this->load->view('admin/footer.php'); ?>