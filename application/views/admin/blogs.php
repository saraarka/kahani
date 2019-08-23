    <?php $this->load->view('admin/header.php'); ?>
    <div class="main">
        <center><span><?php echo $this->session->flashdata('msg');?></span></center>
        <table class="table table-condensed">
            <thead>
                <tr>
                    <th>S.No.</th>
                    <th>Blog Image</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Created At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if(isset($blogs) && ($blogs->num_rows() > 0)){ $i = 1; foreach($blogs->result() as $blog){ ?>
                    <tr>
                        <td><?php echo $i;?></td>
                        <td><img src="<?php echo base_url().'assets/images/'.$blog->slideimage;?>" style="height:100px;width:100px;"></td>
                        <td><?php echo $blog->caption;?></td>
                        <td><?php echo $blog->description;?></td>
                        <td><?php echo substr($blog->created_at,0,10);?></td>
                        <td>
                            <a href="<?php echo base_url();?>index.php/<?php echo $this->uri->segment(1);?>/editblog/<?php echo $blog->id;?>"> Edit </a>
                            <a href="<?php echo base_url();?>index.php/<?php echo $this->uri->segment(1);?>/deleteblog/<?php echo $blog->id;?>"  onclick="return confirm('Are you sure? Do you have to Delete')"> Delete </a>
                        </td>
                    </tr>
                <?php $i++; } } ?>
            </tbody>
        </table>
    </div>