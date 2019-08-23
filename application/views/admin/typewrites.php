    <?php $this->load->view('admin/header.php'); ?>
    <div class="main">
        <center><span><?php echo $this->session->flashdata('msg');?></span></center>
        <?php if(isset($edittypewrite) && ($edittypewrite->num_rows() > 0 )){ foreach($edittypewrite->result() as $row){ ?>
        <form class="form-horizontal" action="<?php echo base_url();?>index.php/<?php echo $this->uri->segment(1);?>/edittypewrite/<?php echo $row->id;?>" method="POST">
            
            <div class="form-group">
                <label class="control-label col-sm-2" for="typewrite">Type Write: </label>
                <div class="col-sm-10">
                    <input type="text" name="typewrite" class="form-control" placeholder="Enter Type Write" value="<?php echo $row->caption;?>">
                    <span class="text-danger"><?php echo form_error('typewrite');?></span>
                </div>
            </div>
            
            <div class="form-group"> 
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-danger">Update</button>
                </div>
            </div>
            
        </form>
        <?php } } else{ ?>
        <form class="form-horizontal" action="<?php echo base_url();?>index.php/<?php echo $this->uri->segment(1);?>/typewrites" method="POST">
            
            <div class="form-group">
                <label class="control-label col-sm-2" for="typewrite">Type Write: </label>
                <div class="col-sm-10">
                    <input type="text" name="typewrite" class="form-control" placeholder="Enter Type Write" value="<?php echo set_value('typewrite');?>">
                    <span class="text-danger"><?php echo form_error('typewrite');?></span>
                </div>
            </div>
            
            <div class="form-group"> 
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-danger">Submit</button>
                </div>
            </div>
            
        </form>
        <?php } ?>
        
        <table class="table table-condensed">
            <thead>
                <tr>
                    <th>S.No.</th>
                    <th>Type Write</th>
                    <th>Created At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if(isset($typewrites) && ($typewrites->num_rows() > 0)){ $i = 1; foreach($typewrites->result() as $typewrite){ ?>
                    <tr>
                        <td><?php echo $i;?></td>
                        <td><?php echo $typewrite->caption;?></td>
                        <td><?php echo substr($typewrite->created_at,0,10);?></td>
                        <td>
                            <a href="<?php echo base_url();?>index.php/<?php echo $this->uri->segment(1);?>/edittypewrite/<?php echo $typewrite->id;?>"> Edit </a>
                            <a href="<?php echo base_url();?>index.php/<?php echo $this->uri->segment(1);?>/deletetypewrite/<?php echo $typewrite->id;?>"  onclick="return confirm('Are you sure? Do you have to Delete')"> Delete </a>
                        </td>
                    </tr>
                <?php $i++; } } ?>
            </tbody>
        </table>
        
    </div>