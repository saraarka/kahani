    <?php $this->load->view('admin/header.php'); ?>
    <style type="text/css">
        table {
            table-layout: fixed;
            word-wrap: break-word;
        }
    </style>
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
                            <option value="profile"> Profiles </option>
                            <option value="community"> communities </option>
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
                        <?php if(isset($reportrow->type) && ($reportrow->type == 'story')){
                                $redirecturl = base_url().'index.php/'.$this->uri->segment(1).'/only_story_view/'.$reportrow->story_id;
                            }elseif(isset($reportrow->type) && ($reportrow->type == 'series')){
                                 $redirecturl = base_url().'index.php/'.$this->uri->segment(1).'/new_series/'.$reportrow->story_id;
                            }else{ $redirecturl = '#'; } ?>
                        <td><a href="<?php echo $redirecturl;?>" target="_blank" style="word-break: break-word;"><?php echo $reportrow->title;?></a></td>
                        <td><?php echo $reportrow->postedtoname.' '.$reportrow->postedtolastname;?></td>
                        <td><?php echo $reportrow->reported_by;?></td>
                        <td><?php echo $reportrow->type;?></td>
                        <td style="word-break: break-word;"><?php echo $reportrow->report_msg;?></td>
                        <td><?php echo substr($reportrow->created_at,0,10);?></td>
                        <td>
                        <?php if(isset($reportrow->type) && ($reportrow->type == 'story')){ ?>
                            <a href="<?php echo base_url();?>index.php/<?php echo $this->uri->segment(1);?>/blockstory/<?php echo $reportrow->story_id;?>"> Block </a>
                        <?php } elseif(isset($reportrow->type) && ($reportrow->type == 'series')){ ?>
                            <a href="<?php echo base_url();?>index.php/<?php echo $this->uri->segment(1);?>/blockseries/<?php echo $reportrow->story_id;?>"> Block </a>
                        <?php } else { ?>
                            <a href="#"> Block </a>
                        <?php } ?>
                        <?php if(isset($reportrow->type) && ($reportrow->type == 'story')){ ?>
                            <a href="<?php echo base_url();?>index.php/<?php echo $this->uri->segment(1);?>/deletestory/<?php echo $reportrow->id;?>" onclick="return confirm('Are you sure? Do you want to Delete?')"> Delete </a>
                        <?php } elseif(isset($reportrow->type) && ($reportrow->type == 'series')){ ?>
                            <a href="<?php echo base_url();?>index.php/<?php echo $this->uri->segment(1);?>/deleteseries/<?php echo $reportrow->id;?>" onclick="return confirm('Are you sure? Do you want to Delete?')"> Delete </a>
                        <?php } else { ?>
                            <a href="#" onclick="return confirm('Are you sure? Do you want to Delete?')"> Delete </a>
                        <?php } ?>
                        </td>
                    </tr>
                <?php $i++; } } ?>
            </tbody>
        </table>
    </div>
    
        <div id="reportmsgslist" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Reports</h4>
                    </div>
                    <div class="modal-body">
                        <table class="table table-condensed table-striped table-hover" id="reportmsgsitems"> </table>
                    </div>
                </div>
            </div>
        </div>
    <?php $this->load->view('admin/footer.php'); ?>