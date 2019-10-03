
    <?php $this->load->view('admin/header.php'); ?>
    <div class="main">
        <center><span><?php echo $this->session->flashdata('msg');?></span></center>
        <form class="form-horizontal" action="<?php echo base_url();?>index.php/<?php echo $this->uri->segment(1);?>/addhomeslide" method="POST" enctype="multipart/form-data">
            
            <div class="form-group">
                <label class="control-label col-sm-2" for="caption">Caption: </label>
                <div class="col-sm-10">
                    <input type="text" name="caption" class="form-control" placeholder="Enter caption on Slide" value="<?php echo set_value('caption');?>">
                    <span class="text-danger"><?php echo form_error('caption');?></span>
                </div>
            </div>
            
            <div class="form-group">
                <label class="control-label col-sm-2" for="slideimage">Slide Image: *</label>
                <div class="col-sm-10">
                    <input type="file" name="slideimage" class="form-control">
                    <span class="text-danger"><?php echo form_error('slideimage');?></span>
                </div>
            </div>
            
            <div class="form-group">
                <label class="control-label col-sm-2" for="slideurl">Slide URL: </label>
                <div class="col-sm-10">
                    <input type="url" name="slideurl" class="form-control" placeholder="Enter URL to redirect" value="<?php echo set_value('slideurl');?>">
                    <span class="text-danger"><?php echo form_error('slideurl');?></span>
                </div>
            </div>
            
            <div class="form-group"> 
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-danger">Submit</button>
                </div>
            </div>
            
        </form>
    </div>