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
                <?php if(isset($leftmenulist) && ($leftmenulist->num_rows() > 0)){ foreach($leftmenulist->result() as $leftrow){ ?>
                    <tr>
                        <td><?php echo $leftrow->navbartype;?></td>
                        <td><?php echo $leftrow->menu_type;?></td>
                        <td><?php echo $leftrow->for_menu;?></td>
                        <td><?php echo $leftrow->menu_name;?></td>
                        <td><?php echo substr($leftrow->created_at,0,10);?></td>
                        <td>
                            <a href="<?php echo base_url();?>index.php/<?php echo $this->uri->segment(1);?>/editleftmenu/<?php echo $leftrow->id;?>"> Edit </a>
                            <a href="<?php echo base_url();?>index.php/<?php echo $this->uri->segment(1);?>/deleteleftmenu/<?php echo $leftrow->id;?>"  onclick="return confirm('Are you sure? Do you have to Delete')"> Delete </a>
                        </td>
                    </tr>
                <?php } } ?>
            </tbody>
        </table>
    </div>