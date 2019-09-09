    <?php $this->load->view('admin/header.php'); ?>
    <div class="main">
        <h3>Logos</h3>
        <center><span><?php echo $this->session->flashdata('msg');?></span></center>
        <?php if(isset($editlogo) && ($editlogo->num_rows() > 0)){ foreach($editlogo->result() as $editrow) { ?>
        <form class="form-horizontal" action="<?php echo base_url();?>index.php/<?php echo $this->uri->segment(1);?>/logos/<?php echo $editrow->id;?>" method="POST">
            
            <div class="form-group">
                <label class="control-label col-sm-2" for="gener">Logos: </label>
                <div class="col-sm-10">
                    <select type="text" name="type" class="form-control">
                        <option value="landing_logo"> Landing Page Logo</option>
                        <option value="landing_mlogo"> Landing Page Mobile Logo</option>
                        <option value="site_logo"> Site Logo</option>
                        <option value="site_mlogo"> Site Mobile Logo</option>
                    </select>
                    <span class="text-danger"><?php echo form_error('type');?></span>
                </div>
            </div>

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
        <form class="form-horizontal" action="<?php echo base_url();?>index.php/<?php echo $this->uri->segment(1);?>/geners" method="POST">
            
            <div class="form-group">
                <label class="control-label col-sm-2" for="gener">Gener: </label>
                <div class="col-sm-10">
                    <input type="text" name="gener" class="form-control" placeholder="Enter Gener name" value="<?php echo set_value('gener');?>">
                    <span class="text-danger"><?php echo form_error('gener');?></span>
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
                    <th>Gener</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if(isset($logos) && ($logos->num_rows() > 0)){ $i = 1; foreach($logos->result() as $logo){ ?>
                    <tr>
                        <td><?php echo $i;?></td>
                        <td><?php echo ucfirst($logo->gener);?></td>
                        <td>
                            <a href="<?php echo base_url();?>index.php/<?php echo $this->uri->segment(1);?>/geners/<?php echo $logo->id;?>"> Edit </a>
                            <a href="<?php echo base_url();?>index.php/<?php echo $this->uri->segment(1);?>/deletegener/<?php echo $logo->id;?>"  onclick="return confirm('Are you sure? Do you have to Delete')"> Delete </a>
                        </td>
                    </tr>
                <?php $i++; } } ?>
            </tbody>
        </table>
    </div>