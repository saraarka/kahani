    <?php $this->load->view('admin/header.php'); ?>
    <div class="main">
        <center><span><?php echo $this->session->flashdata('msg');?></span></center>
        <?php if(isset($editblog) && ($editblog->num_rows() > 0)){ foreach($editblog->result() as $editblogrow) { ?>
        <form class="form-horizontal" action="<?php echo base_url();?>index.php/<?php echo $this->uri->segment(1);?>/updateblog/<?php echo $editblogrow->id;?>" method="POST" enctype="multipart/form-data">
            
            <div class="form-group">
                <label class="control-label col-sm-2" for="title">Title: </label>
                <div class="col-sm-10">
                    <input type="text" name="title" class="form-control" placeholder="Enter title" value="<?php echo $editblogrow->caption;?>">
                    <span class="text-danger"><?php echo form_error('title');?></span>
                </div>
            </div>
            
            <div class="form-group">
                <label class="control-label col-sm-2" for="blogimage">Blog Image: *</label>
                <div class="col-sm-7">
                    <input type="file" name="blogimage" class="form-control">
                    <span class="text-danger"><?php echo form_error('blogimage');?></span>
                </div>
                <div class="col-sm-3"><img src="<?php echo base_url().'assets/images/'.$editblogrow->slideimage;?>" style="height:80px;width:80px;"></div>
            </div>
            
            <div class="form-group">
                <label class="control-label col-sm-2" for="description">Description: </label>
                <div class="col-sm-10">
                    <textarea name="description" class="form-control" placeholder="Enter blog text" rows="5"><?php echo $editblogrow->description;?></textarea>
                    <span class="text-danger"><?php echo form_error('description');?></span>
                </div>
            </div>
            
            <div class="form-group"> 
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-danger">Submit</button>
                </div>
            </div>
            
        </form>
        <?php } } ?>
    </div>