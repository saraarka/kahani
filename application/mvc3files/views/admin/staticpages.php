<?php $this->load->view('admin/header.php'); ?>
    <div class="main">
        <center><span><?php echo $this->session->flashdata('msg');?></span></center>
        <h3> Static Pages </h3>
        <table class="table table-condensed table-striped table-hover">
            <thead>
                <tr>
                    <th>Page Name</th>
                    <th>Description</th>
                    <th>Created Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if(isset($staticpages) && ($staticpages->num_rows() > 0)){
                    foreach($staticpages->result() as $staticpage){ ?>
                    <tr>
                        <td><?php echo $staticpage->pagetype;?></td>
                        <td><?php echo $staticpage->description;?></td>
                        <td><?php echo substr($staticpage->created_at,0,10);?></td>
                        <td>
                            <a href="<?php echo base_url();?>index.php/<?php echo $this->uri->segment(1);?>/editstaticpage/<?php echo $staticpage->id;?>"> Edit </a>
                            <a href="<?php echo base_url();?>index.php/<?php echo $this->uri->segment(1);?>/deletestaticpage/<?php echo $staticpage->id;?>" onclick="return confirm('Are you sure? Do you want to Delete?')"> Delete </a>
                        </td>
                    </tr>
                <?php } } ?>
            </tbody>
        </table>
    </div>
    <?php $this->load->view('admin/footer.php'); ?>