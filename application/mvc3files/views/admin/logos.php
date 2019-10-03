<?php $this->load->view('admin/header.php'); ?>
<div class="main">
    <h3>Logos</h3>
    <center><span><?php echo $this->session->flashdata('msg');?></span></center>
    <?php if(isset($editlogo) && ($editlogo->num_rows() > 0)){ foreach($editlogo->result() as $editrow) { ?>
    <form class="form-horizontal" action="<?php echo base_url();?>index.php/<?php echo $this->uri->segment(1);?>/editlogo/<?php echo $editrow->id;?>" method="POST" enctype="multipart/form-data">
        
        <div class="form-group">
            <label class="control-label col-sm-2" for="type">Logo For: </label>
            <div class="col-sm-10">
                <select type="text" name="type" class="form-control">
                    <option value=""> -- select Logo for -- </option>
                    <option value="landing_logo" <?php if($editrow->type == 'landing_logo'){ echo 'selected'; }?>> Landing Page Logo</option>
                    <option value="landing_mlogo" <?php if($editrow->type == 'landing_mlogo'){ echo 'selected'; }?>> Landing Page Mobile Logo</option>
                    <option value="site_logo" <?php if($editrow->type == 'site_logo'){ echo 'selected'; }?>> Site Logo</option>
                    <option value="site_mlogo" <?php if($editrow->type == 'site_mlogo'){ echo 'selected'; }?>> Site Mobile Logo</option>
                </select>
                <span class="text-danger"><?php echo form_error('type');?></span>
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-sm-2" for="logo">Logo: </label>
            <div class="col-sm-10">
                <input type="file" name="logo" id="logo" class="form-control" placeholder="Choose Logo">
                <span class="text-danger"><?php echo form_error('logo');?><?php echo $this->session->flashdata('nologo');?></span>
            </div>
        </div>
        <div id="image-holder"><img src="<?php echo base_url('assets/images/'.$editrow->slideimage);?>"></div>
        
        <div class="form-group"> 
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-danger">Update</button>
            </div>
        </div>
        
    </form>
    <?php } }else{ ?>
    <form class="form-horizontal" action="<?php echo base_url();?>index.php/<?php echo $this->uri->segment(1);?>/logos" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label class="control-label col-sm-2" for="type">Logo For: </label>
            <div class="col-sm-10">
                <select type="text" name="type" class="form-control" required="">
                    <option value=""> -- select Logo for -- </option>
                    <option value="landing_logo"> Landing Page Logo</option>
                    <option value="landing_mlogo"> Landing Page Mobile Logo</option>
                    <option value="site_logo"> Site Logo</option>
                    <option value="site_mlogo"> Site Mobile Logo</option>
                </select>
                <span class="text-danger"><?php echo form_error('type');?></span>
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-sm-2" for="logo">Logo: </label>
            <div class="col-sm-10">
                <input type="file" name="logo" id="logo" class="form-control" placeholder="Choose Logo" required="">
                <span class="text-danger"><?php echo form_error('logo');?><?php echo $this->session->flashdata('nologo');?></span>
            </div>
        </div>
        <div id="image-holder"></div>
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
                <th>Logo For</th>
                <th>Logo</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if(isset($logos) && ($logos->num_rows() > 0)){ $i = 1; foreach($logos->result() as $logo){ ?>
                <tr>
                    <td><?php echo $i;?></td>
                    <td><?php echo $logo->type;?></td>
                    <td><img src="<?php echo base_url('assets/images/'.$logo->slideimage);?>"></td>
                    <td>
                        <a href="<?php echo base_url();?>index.php/<?php echo $this->uri->segment(1);?>/editlogo/<?php echo $logo->id;?>"> Edit </a>
                        <a href="<?php echo base_url();?>index.php/<?php echo $this->uri->segment(1);?>/deletelogo/<?php echo $logo->id;?>" onclick="return confirm('Are you sure? Do you have to Delete')"> Delete </a>
                    </td>
                </tr>
            <?php $i++; } } ?>
        </tbody>
    </table>
</div>
<script type="text/javascript">
    $("#logo").on('change', function () {
        if (typeof (FileReader) != "undefined") {
            var image_holder = $("#image-holder");
            image_holder.empty();
            var reader = new FileReader();
            reader.onload = function (e) {
                $("<img />", {
                    "src": e.target.result,
                    "class": "thumb-image"
                }).appendTo(image_holder);
            }
            image_holder.show();
            reader.readAsDataURL($(this)[0].files[0]);
        } else {
            alert("This browser does not support FileReader.");
        }
    });
</script>