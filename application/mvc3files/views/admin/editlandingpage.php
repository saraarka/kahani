<?php $this->load->view('admin/header.php'); ?>
    <div class="main">
        <center><span><?php echo $this->session->flashdata('msg');?></span></center>
        <?php if(isset($editlandpage) && ($editlandpage->num_rows() > 0)){ foreach($editlandpage->result() as $editlandrow) { ?>
        <form class="form-horizontal" action="<?php echo base_url();?>index.php/<?php echo $this->uri->segment(1);?>/updatelandingpage/<?php echo $editlandrow->id;?>" method="POST" enctype="multipart/form-data">
            
            <div class="form-group">
                <label class="control-label col-sm-2" for="title">Title: </label>
                <div class="col-sm-10">
                    <input type="text" name="title" class="form-control" placeholder="Enter title" value="<?php echo $editlandrow->caption;?>">
                    <span class="text-danger"><?php echo form_error('title');?></span>
                </div>
            </div>
            
            <div class="form-group">
                <label class="control-label col-sm-2" for="landimage">Landingpage Image: *</label>
                <div class="col-sm-7">
                    <input type="file" name="landimage" class="form-control">
                    <span class="text-danger"><?php echo form_error('landimage');?></span>
                </div>
                <div class="col-sm-3"><img src="<?php echo base_url().'assets/images/'.$editlandrow->slideimage;?>" style="height:80px;width:80px;"></div>
            </div>
            
            <div class="form-group">
                <label class="control-label col-sm-2" for="description">Description: </label>
                <div class="col-sm-10">
                    <textarea name="description" class="form-control" placeholder="Enter Landing page text" rows="5"><?php echo $editlandrow->description;?></textarea>
                    <span class="text-danger"><?php echo form_error('description');?></span>
                </div>
            </div>
            
            <div class="form-group"> 
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-danger">Update</button>
                </div>
            </div>
            
        </form>
        <?php } } ?>
    </div>