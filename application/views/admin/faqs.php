    <?php $this->load->view('admin/header.php'); ?>
    <div class="main">
        <h3> Faq's </h3>
        <center><span><?php echo $this->session->flashdata('msg');?></span></center>
        <?php if(isset($editfaqs) && ($editfaqs->num_rows() > 0)){ foreach($editfaqs->result() as $editrow) { ?>
        <form class="form-horizontal" action="<?php echo base_url();?>index.php/<?php echo $this->uri->segment(1);?>/editfaqs/<?php echo $editrow->id;?>" method="POST">
            
            <div class="form-group">
                <label class="control-label col-sm-2" for="caption">Faq: </label>
                <div class="col-sm-10">
                    <input type="text" name="caption" class="form-control" placeholder="Enter Faq" value="<?php echo $editrow->caption;?>">
                    <span class="text-danger"><?php echo form_error('caption');?></span>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-sm-2" for="description">Description: </label>
                <div class="col-sm-10">
                    <textarea name="description" class="form-control" placeholder="Enter Description"><?php echo $editrow->description;?></textarea>
                    <span class="text-danger"><?php echo form_error('description');?></span>
                </div>
            </div>
            
            <div class="form-group"> 
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-danger">Update</button>
                </div>
            </div>
            
        </form>
        <?php } }else{ ?>
        <form class="form-horizontal" action="<?php echo base_url();?>index.php/<?php echo $this->uri->segment(1);?>/faqs" method="POST">
            
            <div class="form-group">
                <label class="control-label col-sm-2" for="caption">Faq: </label>
                <div class="col-sm-10">
                    <input type="text" name="caption" class="form-control" placeholder="Enter Faq" value="<?php echo set_value('caption');?>">
                    <span class="text-danger"><?php echo form_error('caption');?></span>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-sm-2" for="description">Description: </label>
                <div class="col-sm-10">
                    <textarea name="description" class="form-control" placeholder="Enter Description"><?php echo set_value('description');?></textarea>
                    <span class="text-danger"><?php echo form_error('description');?></span>
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
        <table id="tblpagination" class="display table table-condensed table-striped table-hover">
            <thead>
                <tr>
                    <th>S.No.</th>
                    <th>Faq</th>
                    <th>Description</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if(isset($faqs) && ($faqs->num_rows() > 0)){ $i = 1; foreach($faqs->result() as $faq){ ?>
                    <tr>
                        <td><?php echo $i;?></td>
                        <td><?php echo ucfirst($faq->caption);?></td>
                        <td><?php echo ucfirst($faq->description);?></td>
                        <td>
                            <a href="<?php echo base_url();?>index.php/<?php echo $this->uri->segment(1);?>/editfaqs/<?php echo $faq->id;?>"> Edit </a>
                            <a href="<?php echo base_url();?>index.php/<?php echo $this->uri->segment(1);?>/deletefaq/<?php echo $faq->id;?>"  onclick="return confirm('Are you sure? Do you have to Delete')"> Delete </a>
                        </td>
                    </tr>
                <?php $i++; } } ?>
            </tbody>
        </table>
    </div>
<?php $this->load->view('admin/footer.php'); ?>