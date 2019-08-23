<?php $this->load->view('admin/header.php'); ?>
    <div class="main">
        <center><span><?php echo $this->session->flashdata('msg');?></span></center>
        <form class="form-horizontal" action="<?php echo base_url();?>index.php/<?php echo $this->uri->segment(1);?>/addstaticpage" method="POST" enctype="multipart/form-data">
            
            <div class="form-group">
                <label class="control-label col-sm-2" for="pagetype">Title: </label>
                <div class="col-sm-10">
                    <select name="pagetype" class="form-control">
                        <option value="">-- Select Page --</option>
                        <option value="about"> About Us</option>
                        <option value="privacy_policy"> Privacy Policy</option>
                        <option value="terms_cond"> Terms & Conditions</option>
                        <option value="writing_tips">Writing Tips</option>
                    </select>
                    <span class="text-danger"><?php echo form_error('pagetype');?></span>
                </div>
            </div>
            
            <div class="form-group">
                <label class="control-label col-sm-2" for="description">Description: </label>
                <div class="col-sm-10">
                    <textarea name="description" class="form-control" placeholder="Enter description" rows="8"><?php echo set_value('description');?></textarea>
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
    </div>