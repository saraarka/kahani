    <?php $this->load->view('admin/header.php'); ?>
    <div class="main">
        <center><span><?php echo $this->session->flashdata('msg');?></span></center>
        <table class="table table-condensed">
            <thead>
                <tr>
                    <th>S.No.</th>
                    <th>Slide Image</th>
                    <th>Caption</th>
                    <th>URL</th>
                    <th>Created At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if(isset($homeslides) && ($homeslides->num_rows() > 0)){ $i = 1; foreach($homeslides->result() as $homeslide){ ?>
                    <tr>
                        <td><?php echo $i;?></td>
                        <td><img src="<?php echo base_url().'assets/images/'.$homeslide->slideimage;?>" style="height:100px;"></td>
                        <td><?php echo $homeslide->caption;?></td>
                        <td><?php echo $homeslide->slideurl;?></td>
                        <td><?php echo substr($homeslide->created_at,0,10);?></td>
                        <td>
                            <a href="<?php echo base_url();?>index.php/<?php echo $this->uri->segment(1);?>/edithomeslide/<?php echo $homeslide->id;?>"> Edit </a>
                            <a href="<?php echo base_url();?>index.php/<?php echo $this->uri->segment(1);?>/deletehomeslide/<?php echo $homeslide->id;?>"  onclick="return confirm('Are you sure? Do you have to Delete')"> Delete </a>
                        </td>
                    </tr>
                <?php $i++; } } ?>
            </tbody>
        </table>
    </div>