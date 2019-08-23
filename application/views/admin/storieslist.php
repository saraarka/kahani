    <?php $this->load->view('admin/header.php'); ?>
    <div class="main">
        <center><span><?php echo $this->session->flashdata('msg');?></span></center>
        <h3> Stories List 
        <span class="pull-right" id="storiessearch">
            Filter: <select class="form-control" id="type"> 
                        <option value=""> -- Select Type -- </option>
                        <option value="story"> Stories </option>
                        <option value="series"> Series </option>
                        <option value="nano"> Nano Stories </option>
                        <option value="life"> Life Events </option>
                    </select>
                    <select class="form-control" id="geners"> 
                        <option value=""> -- Select Gener -- </option>
                        <?php if(isset($geners) && ($geners->num_rows() > 0)){ foreach($geners->result() as $gener){ ?>
                        <option value="<?php echo $gener->id;?>"><?php echo $gener->gener;?> </option>
                        <?php } } ?>
                    </select>
                    <select class="form-control" id="publishedstatus"> 
                        <option value=""> -- Select Status -- </option>
                        <option value="not_draft"> Published </option>
                        <option value="draft"> Un Published </option>
                    </select>
                    <select class="form-control" id="monetisation"> 
                        <option value=""> -- By Monetisation -- </option>
                        <option value="Y">  Monetised </option>
                        <option value="N"> Not Monetised </option>
                    </select>
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
            <tbody id="storiessearchresults">
                <?php if(isset($storieslist) && ($storieslist->num_rows() > 0)){ $i = 1;  foreach($storieslist->result() as $storyrow){ 
                    if(($storyrow->type == 'series') && ($storyrow->sid == $storyrow->story_id)){ ?>
                    <tr>
                        <td>#<?php echo $i;?></td>
                        <?php $storyurl = base_url().'index.php/'.$this->uri->segment(1).'/new_series?id='.$storyrow->sid.'&story_id='.$storyrow->sid; ?>
                        <td><a href="<?php echo $storyurl; ?>" target="_blank"><?php echo $storyrow->title;?></a></td>
                        <td><?php echo $storyrow->name.' '.$storyrow->lastname;?></td>
                        <td><?php echo $storyrow->type;?></td>
                        <td><?php echo $storyrow->gener;?></td>
                        <td><?php echo $storyrow->language;?></td>
                        <td><?php echo $storyrow->views;?></td>
                        <td><?php echo $storyrow->uniqueviews;?></td>
                        <td><?php echo $storyrow->draft;?></td>
                        <td><?php echo $storyrow->pay_story;?></td>
                        <td><?php echo substr($storyrow->date,0,10);?></td>
                        <td>
                            <?php if($storyrow->type == 'story'){ ?>
                            <a href="javascript:void(0);" onClick="adminchoice(<?php echo $storyrow->sid;?>);"> Admin Choice </a>
                            <?php } ?>
                            <!--<a href="javascript:void(0);" onClick="storyreports(<?php echo $storyrow->sid;?>);"> Report </a> -->
                            <a href="<?php echo base_url();?>index.php/<?php echo $this->uri->segment(1);?>/deletestory/<?php echo $storyrow->sid;?>" onclick="return confirm('Are you sure? Do you want to Delete?')"> Delete </a>
                            <a href="javascript:void(0);" onClick="adsstory(<?php echo $storyrow->sid;?>);"> Ads </a>
                        </td>
                    </tr>
                <?php $i++; }else if(($storyrow->type == 'series') && ($storyrow->sid != $storyrow->story_id)){ ?>
                <?php } else{ ?>
                    <tr>
                        <td>#<?php echo $i;?></td>
                        <?php $storyurl = '#';   if(($storyrow->type == 'story') || ($storyrow->type == 'life')){
                            $storyurl = base_url().'index.php/'.$this->uri->segment(1).'/only_story_view?id='.$storyrow->sid; } ?>
                        <td><a href="<?php echo $storyurl; ?>" target="_blank"><?php echo $storyrow->title;?></a></td>
                        <td><?php echo $storyrow->name.' '.$storyrow->lastname;?></td>
                        <td><?php echo $storyrow->type;?></td>
                        <td><?php echo $storyrow->gener;?></td>
                        <td><?php echo $storyrow->language;?></td>
                        <td><?php echo $storyrow->views;?></td>
                        <td><?php echo $storyrow->uniqueviews;?></td>
                        <td><?php echo $storyrow->draft;?></td>
                        <td><?php echo $storyrow->pay_story;?></td>
                        <td><?php echo substr($storyrow->date,0,10);?></td>
                        <td>
                            <?php if($storyrow->type == 'story'){ ?>
                            <a href="javascript:void(0);" onClick="adminchoice(<?php echo $storyrow->sid;?>);"> Admin Choice </a>
                            <?php } ?>
                            <!--<a href="javascript:void(0);" onClick="storyreports(<?php echo $storyrow->sid;?>);"> Report </a> -->
                            <a href="<?php echo base_url();?>index.php/<?php echo $this->uri->segment(1);?>/deletestory/<?php echo $storyrow->sid;?>" onclick="return confirm('Are you sure? Do you want to Delete?')"> Delete </a>
                            <a href="javascript:void(0);" onClick="adsstory(<?php echo $storyrow->sid;?>);"> Ads </a>
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
        
        <div id="mstoryads" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Ads Script</h4>
                    </div>
                    <div class="modal-body">
                        <h5>Enter Ad Script</h5>
                        <input type="hidden" id="storyid" value="">
                        <textarea class="form-control" id="adstext" placeholder="Your ad script goes here" required></textarea><br>
                        <center><button type="submit" onclick="adsstoryscript();" class="btn btn-primary">Submit</button></center>
                    </div>
                </div>
            </div>
        </div>
    <?php $this->load->view('admin/footer.php'); ?>