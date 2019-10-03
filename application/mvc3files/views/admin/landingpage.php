    <?php $this->load->view('admin/header.php'); ?>
    <div class="main">
        <center><span><?php echo $this->session->flashdata('msg');?></span></center>
        <table class="table table-condensed">
            <thead>
                <tr>
                    <th>S.No.</th>
                    <th>Image</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Created At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if(isset($landingpages) && ($landingpages->num_rows() > 0)){ $i = 1; foreach($landingpages->result() as $landingpage){ ?>
                    <tr>
                        <td><?php echo $i;?></td>
                        <td><img src="<?php echo base_url().'assets/images/'.$landingpage->slideimage;?>" style="height:100px;width:100px;"></td>
                        <td><?php echo $landingpage->caption;?></td>
                        <td><?php echo $landingpage->description;?></td>
                        <td><?php echo substr($landingpage->created_at,0,10);?></td>
                        <td>
                            <a href="<?php echo base_url();?>index.php/<?php echo $this->uri->segment(1);?>/editlandingpage/<?php echo $landingpage->id;?>"> Edit </a>
                            <a href="<?php echo base_url();?>index.php/<?php echo $this->uri->segment(1);?>/deletelandingpage/<?php echo $landingpage->id;?>"  onclick="return confirm('Are you sure? Do you have to Delete')"> Delete </a>
                        </td>
                    </tr>
                <?php $i++; } } ?>
            </tbody>
        </table>
    </div>