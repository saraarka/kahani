    <?php $this->load->view('admin/header.php'); ?>
    <div class="main">
        <center><span><?php echo $this->session->flashdata('msg');?></span></center>
        <?php if(isset($editgener) && ($editgener->num_rows() > 0)){ foreach($editgener->result() as $editrow) { ?>
        <form class="form-horizontal" action="<?php echo base_url();?>index.php/<?php echo $this->uri->segment(1);?>/geners/<?php echo $editrow->id;?>" method="POST">
            
            <div class="form-group">
                <label class="control-label col-sm-2" for="gener">Gener: </label>
                <div class="col-sm-10">
                    <input type="text" name="gener" class="form-control" placeholder="Enter Gener name" value="<?php echo $editrow->gener;?>">
                    <span class="text-danger"><?php echo form_error('gener');?></span>
                </div>
            </div>
            
            <div class="form-group"> 
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-danger">Update</button>
                </div>
            </div>
            
        </form>
        <?php } }else{ ?>
        <form class="form-horizontal" action="<?php echo base_url();?>index.php/<?php echo $this->uri->segment(1);?>/customnotifies" method="POST">
            
            <div class="form-group">
                <label class="control-label col-sm-3" for="title">Custom Notification Title: </label>
                <div class="col-sm-9">
                    <input type="text" name="title" class="form-control" placeholder="Enter Custom Notification Title" value="<?php echo set_value('title');?>" required>
                    <span class="text-danger"><?php echo form_error('title');?></span>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-sm-3" for="description">Custom Notification Description: </label>
                <div class="col-sm-9">
                    <textarea name="description" class="form-control" placeholder="Enter Custom Notification Description" required><?php echo set_value('description');?></textarea>
                    <span class="text-danger"><?php echo form_error('description');?></span>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-sm-3" for="redirect_uri">Redirect URL: </label>
                <div class="col-sm-9">
                    <input type="text" name="redirect_uri" class="form-control" placeholder="Enter URL to redirect" value="<?php echo set_value('redirect_uri');?>">
                    <span class="text-danger"><?php echo form_error('redirect_uri');?></span>
                </div>
            </div>
            
            <div class="form-group"> 
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-danger">Submit</button>
                </div>
            </div>
            
        </form>
        <?php } ?>
    </div>
    <div class="main">
        <table id="tblpagination" class="display table table-condensed table-striped table-hover">
            <thead>
                <tr>
                    <th>S.No.</th>
                    <th>Title</th>
                    <th>Description</th>
                </tr>
            </thead>
            <tbody>
                <?php if(isset($customnotifies) && ($customnotifies->num_rows() > 0)){ $i = 1; foreach($customnotifies->result() as $customnotify){ ?>
                    <tr>
                        <td><?php echo $i;?></td>
                        <td><?php echo ucfirst($customnotify->title);?></td>
                        <td><?php echo ucfirst($customnotify->description);?></td>
                        <td>
                            <!--<a href="<?php echo base_url();?>index.php/<?php echo $this->uri->segment(1);?>/geners/<?php echo $customnotify->id;?>"> Edit </a>-->
                            <a href="<?php echo base_url();?>index.php/<?php echo $this->uri->segment(1);?>/deletenotify/<?php echo $customnotify->id;?>"  onclick="return confirm('Are you sure? Do you have to Delete')"> Delete </a>
                        </td>
                    </tr>
                <?php $i++; } } ?>
            </tbody>
        </table>
    </div>
    <?php $this->load->view('admin/footer.php'); ?>