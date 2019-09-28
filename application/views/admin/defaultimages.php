    <?php $this->load->view('admin/header.php'); ?>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css" rel="stylesheet">
    <style type="text/css">
        .bootstrap-tagsinput{
            width: 100%;
        }
    </style>
    <div class="main">
        <center><span><?php echo $this->session->flashdata('msg');?></span></center>
        <?php if(isset($edit_dimages) && ($edit_dimages->num_rows() == 1)) { 
            foreach($edit_dimages->result() as $edit_dimage) { ?>
            <form class="form-horizontal" action="<?php echo base_url();?>index.php/<?php echo $this->uri->segment(1);?>/edit_dimage/<?php echo $edit_dimage->id;?>" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label class="control-label col-sm-3" for="defaultimage">Blog Image: *</label>
                    <div class="col-sm-6">
                        <input type="file" name="defaultimage" class="form-control">
                        <span class="text-danger"><?php echo form_error('defaultimage');?></span>
                    </div>
                    <div class="col-sm-3"><img src="<?php echo base_url();?>assets/images/<?php echo $edit_dimage->dimage;?>" style="width: 70px;"></div>
                </div>
                 <div class="form-group">
                    <label class="control-label col-sm-3" for="search_keywords">Image search keywords: </label>
                    <div class="col-sm-9">
                        <input type="text" id="tags-input" name="search_keywords" class="form-control" placeholder="Key words related to Image" value="<?php echo $edit_dimage->search_keywords;?>">
                        <span class="text-danger"><?php echo form_error('search_keywords');?></span>
                    </div>
                </div>
                <div class="form-group"> 
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-danger">Update</button>
                    </div>
                </div>
            </form>
        <?php } } else { ?>
        <form class="form-horizontal" action="<?php echo base_url();?>index.php/<?php echo $this->uri->segment(1);?>/defaultimages" method="POST" enctype="multipart/form-data">
            
            <div class="form-group">
                <label class="control-label col-sm-3" for="defaultimage">Blog Image: *</label>
                <div class="col-sm-9">
                    <!--<input type="file" name="defaultimage[]" class="form-control" multiple="">-->
                    <input type="file" name="defaultimage" class="form-control">
                    <span class="text-danger"><?php echo form_error('defaultimage');?></span>
                </div>
            </div>

             <div class="form-group">
                <label class="control-label col-sm-3" for="search_keywords">Image search keywords: </label>
                <div class="col-sm-9">
                    <input type="text" id="tags-input" name="search_keywords" class="form-control" placeholder="Key words related to Image" value="<?php echo set_value('search_keywords');?>">
                    <span class="text-danger"><?php echo form_error('search_keywords');?></span>
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
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>S.No.</th>
                    <th>Image</th>
                    <th>Keywords</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if(isset($dimages) && ($dimages->num_rows() > 0)){ $i = 1; foreach($dimages->result() as $dimage){ ?>
                    <tr>
                        <td><?php echo $i;?></td>
                        <td><img src="<?php echo base_url();?>assets/images/<?php echo $dimage->dimage;?>" style="width: 100px;"></td>
                        <td><?php echo $dimage->search_keywords;?></td>
                        <td>
                            <a href="<?php echo base_url();?>index.php/<?php echo $this->uri->segment(1);?>/edit_dimage/<?php echo $dimage->id;?>"> Edit </a>
                            <a href="<?php echo base_url();?>index.php/<?php echo $this->uri->segment(1);?>/delete_dimage/<?php echo $dimage->id;?>"  onclick="return confirm('Are you sure? Do you have to Delete')"> Delete </a>
                        </td>
                    </tr>
                <?php $i++; } } ?>
            </tbody>
        </table>
    </div>
    <script src="<?php echo base_url();?>assets/bootstrap-tagsinput.min.js"></script>
    <script>
        $('#tags-input').tagsinput({});
    </script>