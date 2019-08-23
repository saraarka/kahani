    <?php $this->load->view('admin/header.php'); ?>
    <div class="main">
        <center><span><?php echo $this->session->flashdata('msg');?></span></center>
        <table class="table table-condensed">
            <thead>
                <tr>
                    <th>S.No.</th>
                    <th>Image</th>
                    <th>Community</th>
                    <th>Description</th>
                    <th>Created At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if(isset($communities) && ($communities->num_rows() > 0)){ $i = 1; foreach($communities->result() as $community){ ?>
                    <tr>
                        <td><?php echo $i;?></td>
                        <td><img src="<?php echo base_url().'assets/images/'.$community->comm_image;?>" style="height:100px;width:100px;"></td>
                        <td><?php echo $community->gener;?></td>
                        <td><?php echo $community->about_communities;?></td>
                        <td><?php echo substr($community->created_at,0,10);?></td>
                        <td>
                            <a href="<?php echo base_url();?>index.php/<?php echo $this->uri->segment(1);?>/editcommunity/<?php echo $community->id;?>"> Edit </a>
                            <a href="<?php echo base_url();?>index.php/<?php echo $this->uri->segment(1);?>/deletecommunity/<?php echo $community->id;?>"  onclick="return confirm('Are you sure? Do you have to Delete')"> Delete </a>
                        </td>
                    </tr>
                <?php $i++; } } ?>
            </tbody>
        </table>
    </div>