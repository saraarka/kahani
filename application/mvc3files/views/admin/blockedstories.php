    <?php $this->load->view('admin/header.php'); ?>
    <div class="main">
        <center><span><?php echo $this->session->flashdata('msg');?></span></center>
        <h3> Blocked Stories
            <!--<span class="pull-right" id="reportssearch">
                Filter: 
                        <select class="form-control" id="reportstype"> 
                            <option value=""> Filter By </option>
                            <option value="story"> Stories </option>
                            <option value="series"> Series </option>
                            <option value="life"> Life Events </option>
                            <option value="nano"> Nano Stories </option>
                        </select>
            </span> -->
        </h3>
        <table id="tblpagination" class="display table table-condensed table-striped table-hover"
            <thead>
                <tr>
                    <th>S.No.</th>
                    <th>Title</th>
                    <th>Writer</th>
                    <th>Type</th>
                    <th>Genre</th>
                    <th>Language</th>
                    <th>Created Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="reportssearchresults">
                <?php if(isset($bstories) && ($bstories->num_rows() > 0)){ $i = 1; foreach($bstories->result() as $bstory){ ?>
                    <tr>
                        <td><?php echo $i;?></td>
                        <?php if(isset($bstory->type) && (($bstory->type == 'story') || ($bstory->type == 'life'))){
                                $redirecturl = base_url().'index.php/'.$this->uri->segment(1).'/only_story_view?id='.$bstory->story_id;
                            }elseif(isset($bstory->type) && ($bstory->type == 'series')){
                                 $redirecturl = base_url().'index.php/'.$this->uri->segment(1).'/new_series?id='.$bstory->story_id.'&story_id='.$bstory->story_id;
                            }else{ $redirecturl = '#'; } ?>
                        <td><a href="<?php echo $redirecturl;?>" target="_blank"><?php echo $bstory->title;?></a></td>
                        <td><?php echo $bstory->writerfname.' '.$bstory->writerlname;?></td>
                        <td><?php echo $bstory->type;?></td>
                        <td><?php echo $bstory->genre;?></td>
                        <td><?php echo $bstory->language;?></td>
                        <td><?php echo substr($bstory->date,0,10);?></td>
                        <td>
                            <?php if(isset($bstory->status) && ($bstory->status == 'block')){ ?>
                                <?php if(isset($bstory->type) && (($bstory->type == 'story') || ($bstory->type == 'life') || ($bstory->type == 'nano'))){ ?>
                                    <a href="<?php echo base_url();?>index.php/<?php echo $this->uri->segment(1);?>/unblockstory/<?php echo $bstory->sid;?>"> Unblock </a>
                                <?php } elseif(isset($bstory->type) && ($bstory->type == 'series')){ ?>
                                    <a href="<?php echo base_url();?>index.php/<?php echo $this->uri->segment(1);?>/unblockseries/<?php echo $bstory->sid;?>"> Unblock </a>
                                <?php } else { ?>
                                    <a href="#"> Unblock </a>
                                <?php } ?>
                            <?php }else{ ?>
                                <?php if(isset($bstory->type) && (($bstory->type == 'story') || ($bstory->type == 'life') || ($bstory->type == 'nano'))){ ?>
                                    <a href="<?php echo base_url();?>index.php/<?php echo $this->uri->segment(1);?>/blockstory/<?php echo $bstory->sid;?>"> Block </a>
                                <?php } elseif(isset($bstory->type) && ($bstory->type == 'series')){ ?>
                                    <a href="<?php echo base_url();?>index.php/<?php echo $this->uri->segment(1);?>/blockseries/<?php echo $bstory->sid;?>"> Block </a>
                                <?php } else { ?>
                                    <a href="#"> Block </a>
                                <?php } ?>
                            <?php } ?>
                        </td>
                    </tr>
                <?php $i++; } } ?>
            </tbody>
        </table>
    </div>
    <?php $this->load->view('admin/footer.php'); ?>