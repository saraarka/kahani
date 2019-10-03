<?php $this->load->view('admin/header.php'); ?>
    <div class="main">
        <center><span><?php echo $this->session->flashdata('msg');?></span></center>
        <table class="table table-condensed">
            <thead>
                <tr>
                    <th>Navbar Type</th>
                    <th>Menu Type</th>
                    <th>For Menu</th>
                    <th>Language Name</th>
                    <th>Created At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if(isset($menulist) && ($menulist->num_rows() > 0)){ foreach($menulist->result() as $menurow){ ?>
                    <tr>
                        <td><?php echo $menurow->navbartype;?></td>
                        <td><?php echo $menurow->menu_type;?></td>
                        <td><?php echo $menurow->for_menu;?></td>
                        <td><?php echo $menurow->menu_name;?></td>
                        <td><?php echo substr($menurow->created_at,0,10);?></td>
                        <td>
                            <a href="<?php echo base_url();?>index.php/<?php echo $this->uri->segment(1);?>/editheadmenu/<?php echo $menurow->id;?>"> Edit </a>
                            <a href="<?php echo base_url();?>index.php/<?php echo $this->uri->segment(1);?>/deleteheadmenu/<?php echo $menurow->id;?>"  onclick="return confirm('Are you sure? Do you have to Delete')"> Delete </a>
                        </td>
                    </tr>
                <?php } } ?>
            </tbody>
        </table>
    </div>