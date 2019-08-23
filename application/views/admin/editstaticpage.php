<?php $this->load->view('admin/header.php'); ?>
    <div class="main">
        <center><span><?php echo $this->session->flashdata('msg');?></span></center>
        <?php if(isset($editstaticpage) && ($editstaticpage->num_rows() == 1)){ foreach($editstaticpage->result() as $editrow) { ?>
        <form class="form-horizontal" action="<?php echo base_url();?>index.php/<?php echo $this->uri->segment(1);?>/updatestaticpage/<?php echo $editrow->id;?>" method="POST" enctype="multipart/form-data">
            
            <div class="form-group">
                <label class="control-label col-sm-2" for="pagetype">Title: </label>
                <div class="col-sm-10">
                    <select name="pagetype" class="form-control">
                        <option value="">-- Select Page --</option>
                        <option value="about" <?php if($editrow->pagetype == 'about'){ echo 'selected';} ?>> About Us</option>
                        <option value="privacy_policy" <?php if($editrow->pagetype == 'privacy_policy'){ echo 'selected';} ?>> Privacy Policy</option>
                        <option value="terms_cond" <?php if($editrow->pagetype == 'terms_cond'){ echo 'selected';} ?>> Terms & Conditions</option>
                        <option value="writing_tips" <?php if($editrow->pagetype == 'writing_tips'){ echo 'selected';} ?>>Writing Tips</option>
                    </select>
                    <span class="text-danger"><?php echo form_error('pagetype');?></span>
                </div>
            </div>
            
            <div class="form-group">
                <label class="control-label col-sm-2" for="description">Description: </label>
                <div class="col-sm-10">
                    <textarea name="description" class="form-control" placeholder="Enter description" rows="8"><?php echo $editrow->description;?></textarea>
                    <span class="text-danger"><?php echo form_error('description');?></span>
                </div>
            </div>
            
            <div class="form-group">
                <label class="control-label col-sm-2" for="image">Image: *</label>
                <div class="col-sm-10">
                    <input type="file" name="image" class="form-control">
                    <span class="text-danger"><?php echo form_error('image');?></span>
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