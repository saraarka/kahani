    <?php $this->load->view('admin/header.php'); ?>
    <div class="main">
        <center><span><?php echo $this->session->flashdata('msg');?></span></center>
        <?php if(isset($editgener) && ($editgener->num_rows() > 0)){ foreach($editgener->result() as $editrow) { ?>
        <form class="form-horizontal" action="<?php echo base_url();?>index.php/<?php echo $this->uri->segment(1);?>/geners/<?php echo $editrow->id;?>" method="POST">
            
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
                <?php if(isset($geners) && ($geners->num_rows() > 0)){ $i = 1; foreach($geners->result() as $gener){ ?>
                    <tr>
                        <td><?php echo $i;?></td>
                        <td><?php echo ucfirst($gener->gener);?></td>
                        <td>
                            <a href="<?php echo base_url();?>index.php/<?php echo $this->uri->segment(1);?>/geners/<?php echo $gener->id;?>"> Edit </a>
                            <a href="<?php echo base_url();?>index.php/<?php echo $this->uri->segment(1);?>/deletegener/<?php echo $gener->id;?>"  onclick="return confirm('Are you sure? Do you have to Delete')"> Delete </a>
                        </td>
                    </tr>
                <?php $i++; } } ?>
            </tbody>
        </table>
    </div>