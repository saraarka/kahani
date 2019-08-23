    <?php $this->load->view('admin/header.php'); ?>
    <div class="main">
        <center><span><?php echo $this->session->flashdata('msg');?></span></center>
        <?php if(isset($editcommunity) && ($editcommunity->num_rows() > 0)){ foreach($editcommunity->result() as $editrow){ ?>
        <form class="form-horizontal" action="<?php echo base_url();?>index.php/<?php echo $this->uri->segment(1);?>/updatecommunity/<?php echo $editrow->id;?>" method="POST" enctype="multipart/form-data">
            
            <div class="form-group">
                <label class="control-label col-sm-2" for="gener">Select Gener: </label>
                <div class="col-sm-10">
                    <select name="gener" class="form-control" value="<?php echo set_value('gener');?>">
                        <option value=""> -- Select Gener -- </option>
                        <?php if(isset($geners) && ($geners->num_rows() > 0)){ foreach($geners->result() as $gener){ ?>
                            <option value="<?php echo $gener->id;?>" <?php if($editrow->gener == $gener->gener){ echo 'selected'; } ?>> <?php echo ucfirst($gener->gener);?></option>
                        <?php } } ?>
                    </select>
                    <span class="text-danger"><?php echo form_error('gener');?></span>
                </div>
            </div>
            
            <div class="form-group">
                <label class="control-label col-sm-2" for="comm_image">Community Image: *</label>
                <div class="col-sm-10">
                    <input type="file" name="comm_image" class="form-control">
                    <span class="text-danger"><?php echo form_error('comm_image');?></span>
                </div>
            </div>
            
            <div class="form-group">
                <label class="control-label col-sm-2" for="about_communities">Description: </label>
                <div class="col-sm-10">
                    <textarea name="about_communities" class="form-control" placeholder="Enter Description" rows="5"><?php echo $editrow->about_communities;?></textarea>
                    <span class="text-danger"><?php echo form_error('about_communities');?></span>
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