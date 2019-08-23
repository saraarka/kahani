    <?php $this->load->view('admin/header.php'); ?>
    <div class="main">
        <center><span><?php echo $this->session->flashdata('msg');?></span></center>
        <h3> User Writings List 
        <span class="pull-right" id="pstoriessearch">
            Filter: <select class="form-control" id="type"> 
                        <option value=""> -- Select Type -- </option>
                        <option value="story"> Stories </option>
                        <option value="series"> Series </option>
                        <option value="nano"> Nano Stories </option>
                        <option value="life"> Life Events </option>
                    </select>
                <input type="hidden" id="userid" value="<?php echo $this->uri->segment(3); ?>">
            </span>
        </h3>
        <table class="table table-condensed table-striped table-hover">
            <thead>
                <tr>
                    <th>S.No.</th>
                    <th>Title</th>
                    <th>Writer</th>
                    <th>Type</th>
                    <th>Genre</th>
                    <th>Language</th>
                    <th>Views</th>
                    <th>Unique Views</th>
                    <th>Draft</th>
                    <th>Monitize</th>
                    <th>Created Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="psearchresults">
                <?php if(isset($profilestories) && ($profilestories->num_rows() > 0)){ $i = 1; 
                    foreach($profilestories->result() as $profilestory){ 
                    if(($profilestory->type == 'series') && ($profilestory->sid == $profilestory->story_id)){ ?>
                    <tr>
                        <td>#<?php echo $i;?></td>
                        <?php $storyurl = base_url().'index.php/'.$this->uri->segment(1).'/new_series?id='.$profilestory->sid.'&story_id='.$profilestory->sid; ?>
                        <td><a href="<?php echo $storyurl; ?>" target="_blank"><?php echo $profilestory->title;?></a></td>
                        <td><?php echo $profilestory->name.' '.$profilestory->lastname;?></td>
                        <td><?php echo $profilestory->type;?></td>
                        <td><?php echo $profilestory->gener;?></td>
                        <td><?php echo $profilestory->language;?></td>
                        <td><?php echo $profilestory->views;?></td>
                        <td><?php echo $profilestory->uniqueviews;?></td>
                        <td><?php echo $profilestory->draft;?></td>
                        <td><?php echo $profilestory->pay_story;?></td>
                        <td><?php echo substr($profilestory->date,0,10);?></td>
                        <td>
                            <?php if($profilestory->type == 'story'){ ?>
                            <a href="javascript:void(0);" onClick="adminchoice(<?php echo $profilestory->sid;?>);"> Admin Choice </a>
                            <?php } ?>
                            <!--<a href="javascript:void(0);" onClick="storyreports(<?php echo $profilestory->sid;?>);"> Report </a> -->
                            <a href="<?php echo base_url();?>index.php/<?php echo $this->uri->segment(1);?>/deletestory/<?php echo $profilestory->sid;?>" onclick="return confirm('Are you sure? Do you want to Delete?')"> Delete </a>
                        </td>
                    </tr>
                <?php $i++; }else if(($profilestory->type == 'series') && ($profilestory->sid != $profilestory->story_id)){ ?>
                <?php } else{ ?>
                    <tr>
                        <td>#<?php echo $i;?></td>
                        <?php $storyurl = '#';   if(($profilestory->type == 'story') || ($profilestory->type == 'life')){
                            $storyurl = base_url().'index.php/'.$this->uri->segment(1).'/only_story_view?id='.$profilestory->sid; } ?>
                        <td><a href="<?php echo $storyurl; ?>" target="_blank"><?php echo $profilestory->title;?></a></td>
                        <td><?php echo $profilestory->name.' '.$profilestory->lastname;?></td>
                        <td><?php echo $profilestory->type;?></td>
                        <td><?php echo $profilestory->gener;?></td>
                        <td><?php echo $profilestory->language;?></td>
                        <td><?php echo $profilestory->views;?></td>
                        <td><?php echo $profilestory->uniqueviews;?></td>
                        <td><?php echo $profilestory->draft;?></td>
                        <td><?php echo $profilestory->pay_story;?></td>
                        <td><?php echo substr($profilestory->date,0,10);?></td>
                        <td>
                            <?php if($profilestory->type == 'story'){ ?>
                            <a href="javascript:void(0);" onClick="adminchoice(<?php echo $profilestory->sid;?>);"> Admin Choice </a>
                            <?php } ?>
                            <!--<a href="javascript:void(0);" onClick="storyreports(<?php echo $profilestory->sid;?>);"> Report </a> -->
                            <a href="<?php echo base_url();?>index.php/<?php echo $this->uri->segment(1);?>/deletestory/<?php echo $profilestory->sid;?>" onclick="return confirm('Are you sure? Do you want to Delete?')"> Delete </a>
                        </td>
                    </tr>
                <?php $i++; } } } ?>
            </tbody>
        </table>
    </div>
    
        <!--<div id="reportmsgslist" class="modal fade" role="dialog">
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
        </div> -->
    <?php $this->load->view('admin/footer.php'); ?>