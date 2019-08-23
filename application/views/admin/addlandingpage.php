    <?php $this->load->view('admin/header.php'); ?>
    <div class="main">
        <center><span><?php echo $this->session->flashdata('msg');?></span></center>
        <form class="form-horizontal" action="<?php echo base_url();?>index.php/<?php echo $this->uri->segment(1);?>/addlandingpage" method="POST" enctype="multipart/form-data">
            
            <div class="form-group">
                <label class="control-label col-sm-2" for="landimage">Landing page Image: *</label>
                <div class="col-sm-10">
                    <input type="file" name="landimage" class="form-control">
                    <span class="text-danger"><?php echo form_error('landimage'); if(isset($error)){ echo $error; } ?></span>
                    <span> ( Upload image height between 200 and 250 And width between 450 and 500 ) </span>
                </div>
            </div>
            
            <div class="form-group">
                <label class="control-label col-sm-2" for="title">Title: </label>
                <div class="col-sm-10">
                    <input type="text" name="title" class="form-control" placeholder="Enter title" value="<?php echo set_value('title');?>">
                    <span class="text-danger"><?php echo form_error('title');?></span>
                </div>
            </div>
            
            <div class="form-group">
                <label class="control-label col-sm-2" for="description">Description: </label>
                <div class="col-sm-10">
                    <textarea name="description" class="form-control" placeholder="Enter landing page text" rows="5"><?php echo set_value('description');?></textarea>
                    <span class="text-danger"><?php echo form_error('description');?></span>
                </div>
            </div>
            
            <div class="form-group"> 
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-danger">Submit</button>
                </div>
            </div>
            
        </form>
    </div>